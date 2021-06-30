<?php

namespace App;

class DataUploader
{
    private $model;
    private $data = [];

    function __construct($model, $data)
    {
        $model = 'App\Model\\' . $model;
        $this->model = new $model;
        $this->data = $data;
    }

    function newRow()
    {
        foreach ($this->data as $key => $value) {
            $this->model->$key = $value;
        }

        return $this->model->save();
    }

    function rewrite($column, $value)
    {
        $this->model->where($column, $value)->update($this->data);
    }
}
