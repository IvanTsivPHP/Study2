<?php

namespace App\Controller;

use App\DataUploader;
use App\View\View;
use Illuminate\Database\QueryException;

class SignUpController extends Controller
{
    private $error = [];
    private $value = ['name' => '', 'email' => ''];

    public function signUp()
    {
        $file = 'signUp';
        if (!empty($_POST) && $this->formValidation()) {
            $file = $this->makeNewUser();
        }

        return new View($file,
            [
                'title' => 'Sign Up',
                'value' => $this->value,
                'error' => $this->error
            ]
        );
    }

    private function integrityErrorHandler($message)
    {
        if (stripos($message, "Integrity constraint violation:") !== false) {
            if (stripos($message, "for key 'email'") !== false) {
                $this->error['email'] = 'This email is already in use';
            } elseif (stripos($message, "for key 'username'") !== false) {
                $this->error['name'] = 'This name is already in use';
            }
        }
    }

    private function formValidation()
    {
        $this->nameValidation();
        $this->emailValidation();
        $this->passwordValidation();

        if (!empty($this->error)) {
            return false;
        }
        return true;
    }

    private function nameValidation()
    {
        if ((strlen($_POST['name']) < 4 || strlen($_POST['name']) > 64) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST['name'])) {
            $this->error['name'] = '4-64 chars. Only letters and white space allowed';
        } else {
            $this->value['name'] = $_POST['name'];
        }

    }

    private function emailValidation()
    {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = 'incorrect email';
        } else {
            $this->value['email'] = $_POST['email'];
        }
    }

    private function passwordValidation()
    {
        if (strlen($_POST["password"]) < 8) {
            $passwordErr = "Your Password Must Contain At Least 8 Characters!";
        } elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        } elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        } elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } elseif (strcmp($_POST["password"], $_POST["confirmPassword"]) !== 0) {
            $passwordErr = "Passwords must match!";
        }

        if (isset($passwordErr)) {
            $this->error['password'] = $passwordErr;
        }
    }

    private function makeNewUser()
    {
        try {
            $uploader = new DataUploader('User', $this->prepData());
            $uploader->newRow();
            return 'signUpSuccess';
        } catch (QueryException $ex) {
            $this->integrityErrorHandler($ex->getMessage());
            return 'signUp';
        }
    }

    private function hashPassword()
    {
        return password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    private function prepData()
    {
        return [
            'username' => $_POST['name'],
            'password' => $this->hashPassword(),
            'email' => $_POST['email']
        ];
    }
}
