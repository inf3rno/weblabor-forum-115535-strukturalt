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

    public function __construct(\Container $container)
    {
        $this->authModel = $container->authModel();
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        try {
            if (!$this->authModel->authorized())
                $this->authModel->login(Input::password());
            $view = new ProfileRedirect();
        } catch (InputException $e) {
            $view = new AuthView();
        } catch (StoreException $e) {
            $view = new NoStoreAuthView();
        } catch (AuthException $e) {
            $view = new RejectedAuthView();
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
        $view = new AuthRedirect();
        $view->display();
    }

    public function profile()
    {
        try {
            if (!$this->authModel->authorized())
                throw new AuthException('No permission.');
            $this->authModel->update(Input::password());
            $view = new UpdatedProfileView();
        } catch (InputException $e) {
            $view = new ProfileView();
        } catch (StoreException $e) {
            $view = new NoStoreProfileView();
        } catch (AuthException $e) {
            $view = new AuthRedirect();
        }
        $view->display();
    }
}

