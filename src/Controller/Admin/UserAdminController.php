<?php

namespace App\Controller\Admin;

use App\Config;
use App\Controller\Controller;
use App\DataUploader;
use App\Exception\NotFoundException;
use App\Model\AccessLevel;
use App\Model\User;
use App\Paginator;
use App\View\View;

class UserAdminController extends Controller
{
    public function listUsers(array $propArray = null)
    {
        $model = User::select('users.id', 'username', 'email', 'name')
            ->leftjoin('access_level', 'access_level.id', '=', 'users.access_level')
            ->skip(calcSkip(Config::get('defaultPaginationLimit')))
            ->take(getPaginationLimit(Config::get('defaultPaginationLimit')))
            ->get()
            ->toArray();

        return new View('admin/users',
            [
                'title' => 'Users management',
                'tableHeader' => ['ID', 'Username', 'Email', 'Role'],
                'tableContent' => $model,
                'pagination' => (new Paginator('User', Config::get('defaultPaginationLimit')))->run()
            ],
            'admin/header',
            'admin/footer'
        );
    }

    public  function userPage(array $propArray = null)
    {
        $uploadMessage =  'hidden';
        if (!empty($_POST)) {
            $model = new DataUploader('User', $this->prepData());
            $model->rewrite('id', $_POST['id']);
            $uploadMessage = '';
        }

        $userModel = User::select('*')
            ->where('id', '=', $propArray)
            ->first();

        if (empty($userModel)) {
            throw new NotFoundException();
        }

        $groupModel = AccessLevel::select('*')->get()->toArray();

        return new View('admin/userPage',
            [
                'title' => 'User Profile',
                'userData' => $userModel,
                'group' => $groupModel,
                'id' => $propArray,
                'uploadMessage' => $uploadMessage
            ],
            'admin/header',
            'admin/footer'
        );
    }

    public function prepData()
    {
        return [
            'access_level' => $_POST['access_level']
        ];
    }
}
