<?php

namespace Model;


class AuthModel
{

    static public function authorized()
    {
        return SessionStore::load() === true;
    }

    static public function login($password)
    {
        if (Crypto::hash($password) === JsonStore::load())
            SessionStore::save(true);
        else
            throw new AuthException();
    }

    static public function update($password)
    {
        JsonStore::save(Crypto::hash($password));
    }

    static public function logout()
    {
        SessionStore::save(false);
    }
}

