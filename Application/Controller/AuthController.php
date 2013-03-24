<?php

namespace Controller;

use Model\AuthException;
use Model\AuthModel;
use Model\StoreException;
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
        try {
            if (!AuthModel::authorized())
                AuthModel::login(Input::password());
            ProfileView::redirect();
        } catch (InputException $e) {
            AuthView::display(); //nem küldtek űrlapot, vagy rossz űrlap
        } catch (StoreException $e) {
            //nem sikerült az adatok tárolása vagy kiolvasása
        } catch (AuthException $e) {
            AuthView::display(); //nem egyezik a jelszó a tárolttal
        }
    }

    static public function logout()
    {
        try {
            if (AuthModel::authorized())
                AuthModel::logout();
            AuthView::redirect();
        } catch (StoreException $e) {
            //nem sikerült az adatok tárolása vagy kiolvasása
        }
    }

    static public function profile()
    {
        try {
            if (!AuthModel::authorized())
                throw new AuthException('No permission.');
            AuthModel::update(Input::password());
            UpdatedProfileView::display();
        } catch (InputException $e) {
            ProfileView::display(); //nem küldtek űrlapot, vagy rossz űrlap
        } catch (StoreException $e) {
            //nem sikerült az adatok tárolása vagy kiolvasása
        } catch (AuthException $e) {
            AuthView::redirect(); //nincs jogosultság
        }
    }
}

