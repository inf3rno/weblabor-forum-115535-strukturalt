<?php

namespace Model;


class AuthModel
{
    static protected $session;
    static protected $json;

    static public function authorized()
    {
        return static::sessionStore()->load() === true;
    }

    static public function login($password)
    {
        if (Crypto::hash($password) === static::jsonStore()->load())
            static::sessionStore()->save(true);
        else
            throw new AuthException();
    }

    static public function update($password)
    {
        static::jsonStore()->save(Crypto::hash($password));
    }

    static public function logout()
    {
        static::sessionStore()->save(false);
    }

    static protected function sessionStore()
    {
        if (!isset(static::$session))
            static::$session = new SessionStore();
        return static::$session;
    }

    static protected function jsonStore()
    {
        if (!isset(static::$json))
            static::$json = new JsonStore('Application/store.json');
        return static::$json;
    }
}

