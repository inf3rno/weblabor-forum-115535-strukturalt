<?php

namespace Model;


class AuthModel
{
    protected $session;
    protected $permanent;

    public function __construct(\Container $container)
    {
        $this->session = $container->sessionStore();
        $this->permanent = $container->permanentStore();
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

