<?php

class Bootstrap
{
    static protected $extension = '.php';

    static public function run()
    {
        static::autoload(__DIR__, static::$extension);
        Router::dispatch();
    }

    static protected function autoload($directory, $extension)
    {
        spl_autoload_register(function ($class) use ($directory, $extension) {
            $nodes = explode('\\', $class);
            $path = $directory . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $nodes) . $extension;
            if (file_exists($path))
                require_once($path);
        }, true);
    }

}