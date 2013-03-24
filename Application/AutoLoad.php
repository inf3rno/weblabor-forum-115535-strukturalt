<?php

class AutoLoad
{
    protected $extension = '.php';

    public function register($directory)
    {
        $extension = $this->extension;
        spl_autoload_register(function ($class) use ($directory, $extension) {
            $nodes = explode('\\', $class);
            $path = $directory . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $nodes) . $extension;
            if (file_exists($path))
                require_once($path);
        }, true);
    }
}