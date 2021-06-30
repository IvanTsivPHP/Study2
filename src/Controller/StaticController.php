<?php

namespace App\Controller;

use App\Model\StaticPages;
use App\View\View;

class StaticController extends Controller
{
    public function run()
    {
        $page = StaticPages::select('*')
            ->where('href', $_SERVER['REQUEST_URI'])
            ->first();

        return new View('staticPage',
            [
                'title' => $page['title'],
                'data' => $page
            ]
        );
    }
}
