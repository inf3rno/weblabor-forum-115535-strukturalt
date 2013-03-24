<?php

namespace Application\Auth;

use Application\Container;
use Application\Core\Controller\InputException;
use Application\Core\Model\Store\StoreException;
use Application\Profile\NoStoreProfileView;
use Application\Profile\ProfileRedirect;
use Application\Profile\ProfileView;
use Application\Profile\UpdatedProfileView;

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

    public function profile()
    {
        try {
            if (!$this->authModel->authorized())
                throw new AuthException('No permission.');
            $this->authModel->update($this->input->password());
            $view = new UpdatedProfileView($this->container);
        } catch (InputException $e) {
            $view = new ProfileView($this->container);
        } catch (StoreException $e) {
            $view = new NoStoreProfileView($this->container);
        } catch (AuthException $e) {
            $view = new AuthRedirect($this->container);
        }
        $view->display();
    }
}

