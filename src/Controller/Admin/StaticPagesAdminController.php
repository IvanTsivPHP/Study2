<?php

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\DataUploader;
use App\Exception\NotFoundException;
use App\Model\StaticPages;
use App\View\View;
use Illuminate\Database\QueryException;

class StaticPagesAdminController extends Controller
{
    public function staticPages()
    {
        if (!empty($_POST)) {
            $keys = array_keys($_POST);
            StaticPages::whereIn('id', $keys)->delete();
        }
        $model = StaticPages::select('id', 'title', 'href')->get()->toArray();

        return new View('admin/staticPages',
            [
                'title' => 'Static Pages',
                'tableHeader' => ['ID', 'Title', 'Href'],
                'table' => $model
            ],
            'admin/header',
            'admin/footer'
        );
    }

    public function newPage()
    {
        $error = null;
        try {
            $this->uploadNewPage();
        } catch (QueryException $e) {
            if (($e->getCode()) == 23000) {
                $error = 'This title or URL is already in use';
            }
        } finally {
            return new View('admin/staticPage',
                [
                    'title' => 'New page',
                    'button' => 'Create page',
                    'post' => $_POST,
                    'error' => $error
                ],
                'admin/header',
                'admin/footer'
            );
        }
    }

    public function editPage(array $propArray = null)
    {
        $error = null;
        try {
            $this->uploadPage($propArray);
        } catch (QueryException $e) {
            if (($e->getCode()) == 23000) {
                $error = 'This title or URL is already in use';
            }
        } finally {
            $model = StaticPages::select('*')->where('id', '=', $propArray)->first();

            if (empty($model)) {
                throw new NotFoundException();
            }

            return new View('admin/staticPage',
                [
                    'title' => $model['title'],
                    'button' => 'Save',
                    'post' => $model,
                    'error' => $error
                ],
                'admin/header',
                'admin/footer'
            );
        }
    }

    private function uploadNewPage()
    {
        if (!empty($_POST)) {
            if (substr($_POST['href'], 0, 1) != '/') {
                $_POST['href'] = '/' . $_POST['href'];
            }
            $model = new StaticPages();
            foreach ($this->prepData() as $key => $value) {
                $model->$key = $value;
            }
            $model->save();
        }
    }

    private function uploadPage($propArray)
    {
        if (!empty($_POST)) {
            if (substr($_POST['href'], 0, 1) != '/') {
                $_POST['href'] = '/' . $_POST['href'];
            }

            $model = new DataUploader('StaticPages', $this->prepData());
            $model->rewrite('id', $propArray);
        }
    }

    private function prepData()
    {
        return [
            'title' => $_POST['title'],
            'href' => $_POST['href'],
            'text' => $_POST['text']
        ];
    }
}
