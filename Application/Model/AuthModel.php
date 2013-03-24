<?php

namespace Model;


class AuthModel
{

    static public function authorized()
    {
        return SessionStore::load() === true;
    }

    static public function login($password = false)
    {
        if ($password !== false && Crypto::hash($password) === JsonStore::load())
            SessionStore::save(true);
        return static::authorized();
    }

    static public function update($password = false)
    {
        if ($password !== false)
            return JsonStore::save(Crypto::hash($password));
        return false;
    }

    static public function logout()
    {
        SessionStore::save(false);
    }
}

