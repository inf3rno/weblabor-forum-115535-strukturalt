<?php

namespace Model;

session_start();

class Session
{
    static public function authorized()
    {
        return !empty($_SESSION['authorized']) && $_SESSION['authorized'] === true;
    }

    static public function login($password = false)
    {
        if ($password !== false && Access::validate($password))
            $_SESSION['authorized'] = true;
        return static::authorized();
    }

    static public function update($password = false)
    {
        if ($password !== false)
            return Access::store($password);
        return false;
    }

    static public function logout()
    {
        $_SESSION['authorized'] = false;
    }
}

