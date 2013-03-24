<?php

namespace Application\Auth;

use Application\Container;
use Application\Core\Controller\InputException;
use Application\Core\Model\Store\StoreException;
use Application\Profile\Redirect;

class Controller
{
    protected $authModel;
    protected $input;
    protected $container;

    public function __construct(Container $container)
    {
        $this->authModel = $container->authModel();
        $this->container = $container;
        $this->input = new Input();
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
            $view = new Redirect($this->container);
        } catch (InputException $e) {
            $view = new View($this->container);
        } catch (StoreException $e) {
            $view = new NoStoreView($this->container);
        } catch (AuthException $e) {
            $view = new RejectedView($this->container);
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
        $view = new Redirect($this->container);
        $view->display();
    }

}

