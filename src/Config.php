<?php

namespace App;

final class Config
{
    private static $instance = null;
    private static $configs = [];

    private static function configScoop()
    {
        chdir($_SERVER['DOCUMENT_ROOT'] . "/configs");
        $files = glob( "*.ini");
        foreach ($files as $file) {
            static::$configs = array_merge(static::$configs,  parse_ini_file($file, true));
        }
    }

    public static function get($config, $default = null)
    {
        return array_get(static::$configs, $config);
    }

    public static function getInstance(): Config
    {
        if (static::$instance === null) {
            static::$instance = new static();
            static::configScoop();
        }

        return static::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
