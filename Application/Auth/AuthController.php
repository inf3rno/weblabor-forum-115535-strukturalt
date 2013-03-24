<?php

namespace Application\Auth;

use Application\Container;
use Application\Core\Controller\InputException;
use Application\Core\Model\Store\StoreException;
use Application\Profile\ProfileRedirect;

class AuthController
{
    protected $authModel;
    protected $input;
    protected $container;

    public function __construct(Container $container)
    {
        $this->authModel = $container->authModel();
        $this->container = $container;
        $this->input = new AuthInput();
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        try {
            if (!$this->authModel->authorized())
                $this->authModel->login($this->input->password());
            $view = new ProfileRedirect($this->container);
        } catch (InputException $e) {
            $view = new AuthView($this->container);
        } catch (StoreException $e) {
            $view = new NoStoreAuthView($this->container);
        } catch (AuthException $e) {
            $view = new RejectedAuthView($this->container);
        }
        $view->display();
    }

    public function logout()
    {
        try {
            if ($this->authModel->authorized())
                $this->authModel->logout();
        } catch (StoreException $e) {
        }
        $view = new AuthRedirect($this->container);
        $view->display();
    }

}

