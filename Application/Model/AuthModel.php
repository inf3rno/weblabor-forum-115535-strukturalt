<?php

namespace Model;

session_start();

class AuthModel
{
    static protected $stateKey = 'authorized';

    static public function authorized()
    {
        return !empty($_SESSION[static::$stateKey]) && $_SESSION[static::$stateKey] === true;
    }

    static public function login($password = false)
    {
        if ($password !== false && Crypto::hash($password) === HashStore::load())
            $_SESSION[static::$stateKey] = true;
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
        $_SESSION[static::$stateKey] = false;
    }
}

