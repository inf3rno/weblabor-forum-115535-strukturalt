<?php

namespace Controller;

use Model\AuthException;
use Model\AuthModel;
use Model\StoreException;
use View\AuthView;
use View\NoStoreAuthView;
use View\NoStoreProfileView;
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
            ProfileView::redirect();
        } catch (InputException $e) {
            AuthView::display();
        } catch (StoreException $e) {
            NoStoreAuthView::display();
        } catch (AuthException $e) {
            RejectedAuthView::display();
        }
    }

    static public function logout()
    {
        try {
            if (AuthModel::authorized())
                AuthModel::logout();
        } catch (StoreException $e) {
        }
        AuthView::redirect();
    }

    static public function profile()
    {
        try {
            if (!AuthModel::authorized())
                throw new AuthException('No permission.');
            AuthModel::update(Input::password());
            UpdatedProfileView::display();
        } catch (InputException $e) {
            ProfileView::display();
        } catch (StoreException $e) {
            NoStoreProfileView::display();
        } catch (AuthException $e) {
            AuthView::redirect();
        }
    }
}

