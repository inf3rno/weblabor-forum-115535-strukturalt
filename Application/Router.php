<?php

class Router
{
    static protected $defaultHandler = 'index';
    static protected $urlPattern = '%^/([\w_-]+)\.php$%usD';
    static protected $controllerClass = 'Controller\AuthController';

    static public function dispatch()
    {
        if (preg_match(static::$urlPattern, $_SERVER['REQUEST_URI'], $matches))
            $handler = $matches[1];
        else
            $handler = static::$defaultHandler;

        if (!method_exists(static::$controllerClass, $handler))
            $handler = static::$defaultHandler;

        $controller = static::$controllerClass;
        $controller::$handler();
    }
}
