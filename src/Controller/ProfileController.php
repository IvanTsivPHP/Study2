<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Subscribes;
use App\PicUpLoader;
use App\View\View;
use App\Model\User;
use App\DataUploader;
use Illuminate\Database\QueryException;

class ProfileController extends Controller
{
    public function profile(array $propArray = null)
    {
        $this->profilePostUpload();
        $status = $this->profileFileUpload();
        if (!empty($propArray)) {
            $id = $propArray;
            $hidden = 'hidden';
            $disabled = 'disabled';
        } else {
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
            } else {
                $id = '';
            }
            $hidden = '';
            $disabled = '';
        }

        $userModel = User::select('users.id', 'about','username', 'email', 'name', 'userpic')
            ->leftjoin('access_level', 'access_level.id', '=', 'users.access_level')
            ->where('users.id', '=', $id)
            ->first();

        if (empty($userModel)) {
            throw new NotFoundException();
        }

        return new View('profile',
            [
                'title' => 'Profile',
                'hidden' => $hidden,
                'disabled' => $disabled,
                'profile' => $userModel,
                'status' => $status
            ]
        );
    }

    private function profilePostUpload()
    {
        if (!empty($_POST)) {
            $model = new DataUploader('User', $this->prepData());
            $model->rewrite('id', $_SESSION['id']);
        }
    }

    private function profileFileUpload()
    {
        if (!empty($_FILES) && $_FILES['img']['error'] !== 4) {
            $loader = new PicUpLoader('/img/user/' . $_SESSION['id']);
            $status = $loader->run();
            if ($status == false) {
                $model = new DataUploader('User', ['userpic' => $_SESSION['id'] . '/' . $loader->getPicName()]);
                $model->rewrite('id', $_SESSION['id']);
                $status = 'Picture uploaded';
            }

            return $status;
        }
    }

    public function subscribeUser()
    {
        if ($_POST['action'] === 'Subscribe') {
            $model = new Subscribes();
            $model->email = $_POST['email'];
            try {
                $model->save();
            }
            catch (QueryException $e)
            {
                return new View('subscribe',
                    [
                        'title' => 'Error',
                        'sub' => 'This email is already subscribed '
                    ]
                );
            }
            $_SESSION['sub'] = true;
            $sub = 'You have successfully subscribed';
        } elseif ($_POST['action'] === 'Unsubscribe') {
            Subscribes::where('email', $_POST['email'])->delete();
            $_SESSION['sub'] = false;
            $sub = 'You have successfully unsubscribed';
        }

        return new View('subscribe',
            [
                'title' => 'Success',
                'sub' => $sub
            ]
        );
    }

    public function unsubscribeUser()
    {
        if (isset($_GET['id']) && isset($_GET['validation_hash'])) {
            $expected = md5($_GET['id'] . SECRET_STRING);
            if ($_GET['validation_hash'] == $expected) {
                Subscribes::where('id', $_GET['id'])->delete();
                if (isset($_SESSION['sub'])) {
                    $_SESSION['sub'] = false;
                }

                return new View('subscribe',
                    [
                        'title' => 'Success',
                        'sub' => 'You have successfully unsubscribed'
                    ]
                );
            }
        }
    }

    private function prepData()
    {
        return [
            'about' => $_POST['about']
        ];
    }
}
