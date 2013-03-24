<?php

namespace Application;

class Container
{

    protected $directory;
    protected $router;
    protected $authController;
    protected $profileController;
    protected $authModel;
    protected $profileModel;
    protected $sessionStore;
    protected $permanentStore;
    protected $encryptor;
    protected $html;
    protected $storeFile = 'store.json';
    protected $salt = 'titkos';

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function router()
    {
        if (!isset($this->router))
            $this->router = new Core\Router($this);
        return $this->router;
    }

    public function authController()
    {
        if (!isset($this->authController))
            $this->authController = new Auth\Controller($this);
        return $this->authController;
    }

    public function profileController()
    {
        if (!isset($this->profileController))
            $this->profileController = new Profile\Controller($this);
        return $this->profileController;
    }

    public function authModel()
    {
        if (!isset($this->authModel))
            $this->authModel = new Auth\Model($this);
        return $this->authModel;
    }

    public function profileModel()
    {
        if (!isset($this->profileModel))
            $this->profileModel = new Profile\Model($this);
        return $this->profileModel;
    }

    public function sessionStore()
    {
        if (!isset($this->sessionStore))
            $this->sessionStore = new Core\Model\Store\SessionStore();
        return $this->sessionStore;
    }

    public function permanentStore()
    {
        if (!isset($this->permanentStore))
            $this->permanentStore = new Core\Model\Store\JsonStore($this->directory . DIRECTORY_SEPARATOR . $this->storeFile);
        return $this->permanentStore;
    }

    public function encryptor()
    {
        if (!isset($this->encryptor))
            $this->encryptor = new Core\Model\Encryptor\Sha1Encryptor($this->salt);
        return $this->encryptor;
    }

    public function html()
    {
        if (!$this->html)
            $this->html = new Core\View\Html();
        return $this->html;
    }

}