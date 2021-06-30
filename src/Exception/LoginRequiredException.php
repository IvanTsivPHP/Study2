<?php

namespace App\Exception;

use App\Renderable;

class LoginRequiredException extends HttpException implements Renderable
{
    public function render()
    {
        echo 'You must be <a href="/signin">logged in</a> to post comments';
    }
}
