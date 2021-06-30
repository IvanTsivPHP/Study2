<?php

namespace App\Controller\Admin;

use App\Config;
use App\Controller\Controller;
use App\Model\Subscribes;
use App\Paginator;
use App\View\View;

class SubscribeAdminController extends Controller
{
    public function editSubscribes()
    {
        if (!empty($_POST)) {
            $keys = array_keys($_POST);
            Subscribes::whereIn('id', $keys)->delete();
        }
        $data = Subscribes::select('*')->get()->toArray();

        return new View('admin/subs',
            [
                'title' => 'Subscribes',
                'table' => $data,
                'pagination' => (new Paginator('Subscribes', Config::get('defaultPaginationLimit')))->run()
            ],
            'admin/header',
            'admin/footer'
        );
    }
}
