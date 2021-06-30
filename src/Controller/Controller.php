<?php

namespace App\Controller;

use App\Config;
use App\Exception\AccessDeniedException;

abstract class Controller
{
    protected  $user;

    public function __construct($accessLevel)
    {
        Config::getInstance();
        $this->user = $_SESSION;
        if ($this->user['access'] == 0 && $accessLevel > 0) {
            header('Location: /login');
        } elseif ($accessLevel > $this->user['access']) {
            throw new AccessDeniedException();
        }
    }
}
