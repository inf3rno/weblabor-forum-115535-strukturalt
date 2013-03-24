<?php

class Container
{

    protected $directory;
    protected $router;

    public function __construct($directory)
    {
        $this->directory = $directory;
        $this->router = new Router($this->controller());
    }

    public function router()
    {
        return $this->router;
    }

    protected function controller()
    {
        $controller = new Controller\AuthController($this->authModel());
        return $controller;
    }

    protected function authModel()
    {
        $authModel = new Model\AuthModel();
        $authModel->setSessionStore(new Model\SessionStore());
        $authModel->setPermanentStore(new Model\JsonStore($this->directory . DIRECTORY_SEPARATOR . 'store.json'));
        return $authModel;
    }


}