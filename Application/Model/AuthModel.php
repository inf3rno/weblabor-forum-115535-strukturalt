<?php

namespace Model;


class AuthModel
{
    protected $session;
    protected $permanent;

    public function setSessionStore(Store $session)
    {
        $this->session = $session;
    }

    public function setPermanentStore(Store $permanent)
    {
        $this->permanent = $permanent;
    }

    public function authorized()
    {
        return $this->session->load() === true;
    }

    public function login($password)
    {
        if (Crypto::hash($password) === $this->permanent->load())
            $this->session->save(true);
        else
            throw new AuthException();
    }

    public function update($password)
    {
        $this->permanent->save(Crypto::hash($password));
    }

    public function logout()
    {
        $this->session->save(false);
    }


}

