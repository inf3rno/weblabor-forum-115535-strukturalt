<?php

namespace Controller;

use Model\AuthException;
use Model\AuthModel;
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
    static public function index()
    {
        static::login();
    }

    static public function login()
    {
        try {
            if (!AuthModel::authorized())
                AuthModel::login(Input::password());
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

    static public function logout()
    {
        try {
            if (AuthModel::authorized())
                AuthModel::logout();
        } catch (StoreException $e) {
        }
        $view = new AuthRedirect();
        $view->display();
    }

    static public function profile()
    {
        try {
            if (!AuthModel::authorized())
                throw new AuthException('No permission.');
            AuthModel::update(Input::password());
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

