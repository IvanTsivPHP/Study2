<?php

namespace App;

class TableMaker
{
    private $class;
    private $data;
    private $header = [];
    private $rowUrl;

    public function __construct($class, $header, $data, $rowUrl = null)
    {
        $this->class = $class;
        $this->header = $header;
        $this->rowUrl = $rowUrl;
        $this->data = $data;

    }

    private function prepRowUrl($row)
    {
        return ['<a href="' . strtok($_SERVER["REQUEST_URI"], '?') . '/' . $row[$this->rowUrl] . '">','</a>'];
    }

    private function makeHeader()
    {
        $result = null;
        foreach ($this->header as $columnHeader) {
            $result .= '<th scope="col">' . $columnHeader . '</th>';
        }

        return $result;
    }

    private function makeContent()
    {
        $result = null;
        foreach ($this->data as $row) {
            $result .= '<tr>';
            foreach ($row as $cell) {
                if ($this->rowUrl) {
                    $url = $this->prepRowUrl($row);
                } else {
                    $url = ['', ''];
                }
                $result .= '<td>' . $url[0] . $cell . $url[1] . '</td>';
            }
            $result .= '</tr>';
        }

        return $result;
    }

    public function run()
    {
        $result = '<table class="table table-striped"><thead><tr>';
        $result .= $this->makeHeader();
        $result .= $this->makeContent();
        $result .= '</tbody></table>';

        echo $result;
    }
}
