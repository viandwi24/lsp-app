<?php
namespace App\Services;

class Helper
{
    public static function load($path = null)
    {
        $path    = ($path == null) ? app_path() . '/Helpers/' : $path;

        $path = explode('/', $path);
        $path = implode('/', $path) . '/';

        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file)
        {
            require_once $path . $file;
        }
    } 
}