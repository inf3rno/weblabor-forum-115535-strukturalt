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
            Redirect::toProfile();
        else
            AuthView::loginForm();
    }

    static public function logout()
    {
        if (AuthModel::authorized())
            AuthModel::logout();
        Redirect::toLogin();

    }

    static public function profile()
    {
        if (AuthModel::authorized())
            AuthView::updateForm(AuthModel::update(Input::password()));
        else
            Redirect::toLogin();
    }
}

