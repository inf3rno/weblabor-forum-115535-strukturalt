<?php

namespace Controller;

use Model\AuthModel;
use View\AuthView;
use View\ProfileView;

class AuthController
{
    static public function index()
    {
        static::login();
    }

    static public function login()
    {
        if (AuthModel::authorized() || AuthModel::login(Input::password()))
            ProfileView::redirect();
        else
            AuthView::display();
    }

    static public function logout()
    {
        if (AuthModel::authorized())
            AuthModel::logout();
        AuthView::redirect();
    }

    static public function profile()
    {
        if (AuthModel::authorized()) {
            $updated = AuthModel::update(Input::password());
            ProfileView::display($updated);
        } else
            AuthView::redirect();
    }
}

