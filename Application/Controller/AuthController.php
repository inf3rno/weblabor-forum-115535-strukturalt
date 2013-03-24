<?php

namespace Controller;

use Model\AuthModel;
use View\AuthView;
use View\ProfileView;
use View\UpdatedProfileView;

class AuthController
{
    static public function index()
    {
        static::login();
    }

    static public function login()
    {
        if (AuthModel::authorized() || AuthModel::login(Input::password()))
            return ProfileView::redirect();
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
        if (!AuthModel::authorized())
            return AuthView::redirect();
        if (AuthModel::update(Input::password()))
            UpdatedProfileView::display();
        else
            ProfileView::display();
    }
}

