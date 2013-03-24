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

    public function __construct(Container $container)
    {
        $this->authModel = $container->authModel();
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
            $view = new Redirect();
        } catch (InputException $e) {
            $message = null;
        } catch (StoreException $e) {
            $message = 'noStore';
        } catch (AuthException $e) {
            $message = 'rejected';
        }
        if (!isset($view))
            $view = new Page($message);
        $view->display();
    }

    public function logout()
    {
        try {
            if ($this->authModel->authorized())
                $this->authModel->logout();
        } catch (StoreException $e) {
        }
        $view = new Redirect();
        $view->display();
    }

}

