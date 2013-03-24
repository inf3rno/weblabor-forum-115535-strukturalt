<?php

class Router
{
    static public function dispatch()
    {
        $defaultHandler = 'index';
        if (preg_match('%^/([\w_-]+)\.php$%usD', $_SERVER['REQUEST_URI'], $matches))
            $handler = $matches[1];
        else
            $handler = $defaultHandler;

        if (!method_exists('Controller\AuthController', $handler))
            $handler = $defaultHandler;

        Controller\AuthController::$handler();
    }
}
