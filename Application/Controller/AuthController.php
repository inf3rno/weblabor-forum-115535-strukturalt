<?php

namespace Controller;

use Model\AuthException;
use Model\StoreException;
use View\AuthRedirect;
use View\AuthView;
use View\NoStoreAuthView;
use View\NoStoreProfileView;
use View\ProfileRedirect;
use View\ProfileView;
use View\RejectedAuthView;
use View\UpdatedProfileView;

class AuthController
{
    protected $authModel;
    protected $input;
    protected $container;

    public function __construct(\Container $container)
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

