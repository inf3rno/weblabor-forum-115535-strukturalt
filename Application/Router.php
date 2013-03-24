<?php

class Router
{
    static protected $defaultHandler = 'index';
    static protected $urlPattern = '%^/([\w_-]+)\.php$%usD';

    static public function dispatch()
    {
        if (preg_match(static::$urlPattern, $_SERVER['REQUEST_URI'], $matches))
            $handler = $matches[1];
        else
            $handler = static::$defaultHandler;

        $controller = static::createController();
        if (!method_exists($controller, $handler))
            $handler = static::$defaultHandler;
        $controller->$handler();
    }

    static protected function createController()
    {
        $authModel = new Model\AuthModel();
        $authModel->setSessionStore(new Model\SessionStore());
        $authModel->setPermanentStore(new Model\JsonStore('Application/store.json'));
        $controller = new Controller\AuthController($authModel);
        return $controller;
    }

}
