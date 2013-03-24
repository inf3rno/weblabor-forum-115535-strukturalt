<?php

namespace Application\Profile;

use Application\Container;

class Model
{
    /** @var \Application\Core\Model\Store\Store */
    protected $permanent;
    /** @var \Application\Core\Model\Encryptor\Encryptor */
    protected $encryptor;

    public function __construct(Container $container)
    {
        $this->permanent = $container->permanentStore();
        $this->encryptor = $container->encryptor();
    }

    public function update($password)
    {
        $this->permanent->save($this->encryptor->hash($password));
    }
}