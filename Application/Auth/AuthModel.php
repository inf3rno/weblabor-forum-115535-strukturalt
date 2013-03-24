<?php

namespace Application\Auth;

use Application\Container;

class AuthModel
{
    /** @var \Application\Core\Model\Store\Store */
    protected $session;
    /** @var \Application\Core\Model\Store\Store */
    protected $permanent;
    /** @var \Application\Core\Model\Encryptor\Encryptor */
    protected $encryptor;

    public function __construct(Container $container)
    {
        $this->session = $container->sessionStore();
        $this->permanent = $container->permanentStore();
        $this->encryptor = $container->encryptor();
    }

    public function authorized()
    {
        return $this->session->load() === true;
    }

    public function login($password)
    {
        if ($this->encryptor->hash($password) === $this->permanent->load())
            $this->session->save(true);
        else
            throw new AuthException();
    }

    public function update($password)
    {
        $this->permanent->save($this->encryptor->hash($password));
    }

    public function logout()
    {
        $this->session->save(false);
    }


}

