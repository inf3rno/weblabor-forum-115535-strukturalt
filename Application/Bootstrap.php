<?php

class Bootstrap
{
    public function __construct()
    {
        $this->autoLoad();
        $this->router()->dispatch($_SERVER['REQUEST_URI']);
    }

    protected function autoLoad()
    {
        require_once(__DIR__ . '/AutoLoad.php');
        $autoLoad = new AutoLoad();
        $autoLoad->register(__DIR__);
    }

    protected function authModel()
    {
        $authModel = new Model\AuthModel();
        $authModel->setSessionStore(new Model\SessionStore());
        $authModel->setPermanentStore(new Model\JsonStore(__DIR__ . '/store.json'));
        return $authModel;
    }

    protected function controller()
    {
        $controller = new Controller\AuthController($this->authModel());
        return $controller;
    }

    protected function router()
    {
        $router = new Router($this->controller());
        return $router;
    }

}