<?php

namespace App\Controller\User;

use App\Controller\Controller;
use App\Model\Subscribes;
use App\Model\User;
use App\View\View;

class AuthController extends Controller
{
    private $error = null;

    public function login()
    {
        if (!empty($_POST) && $this->passwordVerify()) {
            $_SESSION['access'] = $this->user['access_level'];
            $_SESSION['id'] = $this->user['id'];
            $_SESSION['email'] = $this->user['email'];
            $_SESSION['sub'] = !empty(Subscribes::select('*')->where('email', $_SESSION['email'])->first());

            header('Location: /');
        } else {
            return new View('signIn',
                [
                    'title' => 'Sign In',
                    'post' => $_POST,
                    'error' => $this->error
                ]);
        }
    }

    public function passwordVerify()
    {
        $this->user = User::where('email', $_POST['email'])->first();
        if (!empty($this->user)) {
            if (password_verify($_POST['password'], $this->user['password'])) {

                return true;
            }
        }
        $this->error = 'Wrong login or password';
        return false;
    }

    public  function logout()
    {
        $_SESSION['access'] = 0;
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        unset($_SESSION['sub']);

        header('Location: /');
    }
}

