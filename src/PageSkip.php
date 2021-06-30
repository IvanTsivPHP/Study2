<?php

namespace App;

class PageSkip
{
    private $page;
    private $limit;

    public function __construct($page, $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    private function calcSkip()
    {
        return 0 + $this->limit * ($this->page - 1);
    }
}
