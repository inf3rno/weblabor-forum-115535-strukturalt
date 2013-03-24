<?php

namespace Controller;

use Model\Session;
use View\Document;
use View\Redirect;

class AuthController
{
    static public function index()
    {
        if (Session::authorized() || Session::login(Input::password()))
            Redirect::redirectToProfile();
        else
            Document::displayLoginForm();
    }

    static public function logout()
    {
        if (Session::authorized())
            Session::logout();
        Redirect::redirectToLogin();

    }

    static public function profile()
    {
        if (Session::authorized())
            Document::displayUpdateForm(Session::update(Input::password()));
        else
            Redirect::redirectToLogin();
    }
}

