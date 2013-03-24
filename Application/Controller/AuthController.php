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
            ProfileView::toProfile();
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
            ProfileView::profilePage(AuthModel::update(Input::password()));
        else
            AuthView::toAuth();
    }
}

