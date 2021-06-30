<?php

namespace App;

use App\Config;

class PicUpLoader
{
    private $picture;
    private $path;
    private $validList = [];
    private $pictureName;
    private $sizeLimit;

    public function __construct($path, $pictureName = null)
    {
        Config::getInstance();
        $this->picture = $_FILES;
        $this->path = APP_DIR . $path;
        $this->validList = Config::get('userPicValidTypes')['format'];
        $this->sizeLimit = Config::get('userPicValidTypes')['size'];
        if (is_array($pictureName)) {
            $this->pictureName = array_values($pictureName)[0];
        } else {
            $this->pictureName = $pictureName;
        }
    }

    public function run()
    {
        $error = $this->validate();
        if ($error) {
            return $error;
        }
        $this->checkDir();
        if (is_null($this->pictureName)) {
            $this->pictureName = $this->rename();
        } else {
            $this->pictureName = $this->pictureName . '.' . pathinfo($this->picture['img']['name'])['extension'];
        }
        move_uploaded_file($this->picture['img']['tmp_name'], $this->path . DIRECTORY_SEPARATOR . $this->pictureName);

        return false;
    }

    private function validate()
    {
        $extension = pathinfo($this->picture['img']['name'], PATHINFO_EXTENSION);
        if (!in_array($extension, $this->validList)) {
            $error = 'File must be following types: ';
            foreach ($this->validList as $item) {
                $error .= $item . ', ';
            }
            $error = rtrim($error, ", ");

            return $error;
        }
        if ($this->picture['img']['size'] > $this->sizeLimit) {

            return 'The file size must not exceed ' . $this->sizeLimit / 1048576 . ' Mb';
        }

        return false;
    }

    private function rename()
    {
        return $this->getLastFileName() + 1 . '.' . pathinfo($this->picture['img']['name'])['extension'];
    }

    public function getLastFileName()
    {
        $files = scandir($this->path);
        $file = end($files);
        $result = pathinfo($file)['filename'];
        if ($result == '.') {
            return 0;
        }

        return $result;
    }

    private function checkDir()
    {
        if (!file_exists($this->path)) {
            mkdir($this->path);
        }
    }

    public function getPicName()
    {
        return $this->pictureName;
    }
}
