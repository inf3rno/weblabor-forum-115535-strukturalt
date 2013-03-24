<?php

namespace Model;

session_start();

class AuthModel
{
    static public function authorized()
    {
        return !empty($_SESSION['authorized']) && $_SESSION['authorized'] === true;
    }

    static public function login($password = false)
    {
        if ($password !== false && Crypto::hash($password) === HashStore::load())
            $_SESSION['authorized'] = true;
        return static::authorized();
    }

    static public function update($password = false)
    {
        if ($password !== false)
            return HashStore::save(Crypto::hash($password));
        return false;
    }

    static public function logout()
    {
        $_SESSION['authorized'] = false;
    }
}

