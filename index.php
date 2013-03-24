<?php

spl_autoload_register(function ($class) {
    $nodes = explode('\\', $class);
    $path = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $nodes) . '.php';
    if (file_exists($path))
        require_once($path);
}, true);

Router::dispatch();