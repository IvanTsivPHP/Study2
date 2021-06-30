<?php

namespace App;

class Paginator
{
    private $pages;
    private $model;
    private $limit;

    public function __construct($model, $defaultLimit)
    {
        $this->model = 'App\Model\\' . $model;
        $this->limit = $defaultLimit;
    }

    public function run()
    {
        $this->limitChange();
        $this->calcPages();

        return ['pages' => $this->pages, 'limit' => $this->limit];
    }

    private function calcPages()
    {
        if ($this->limit == 'all') {
            $this->pages = 1;
            return;
        }
        $items = $this->model::count();
        $this->pages = ceil($items / $this->limit);
    }

    public function limitChange()
    {
        if (isset($_GET['limit'])) {
            $this->limit = $_GET['limit'];
            return true;
        }

        return false;
    }
}
