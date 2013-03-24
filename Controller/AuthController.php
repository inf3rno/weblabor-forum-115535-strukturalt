<?php

namespace Controller;

use Model\AuthModel;
use View\AuthView;
use View\Redirect;

class AuthController
{
    static public function index()
    {
        static::login();
    }

    static public function login()
    {
        if (AuthModel::authorized() || AuthModel::login(Input::password()))
            AuthView::toProfile();
        else
            AuthView::authPage();
    }

    static public function logout()
    {
        if (AuthModel::authorized())
            AuthModel::logout();
        AuthView::toAuth();
    }

    static public function profile()
    {
        if (AuthModel::authorized())
            AuthView::profilePage(AuthModel::update(Input::password()));
        else
            AuthView::toAuth();
    }
}

