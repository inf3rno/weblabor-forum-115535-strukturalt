<?php

namespace Application\Model\Store;

class SessionStore implements Store
{
    protected $dataKey = 'data';

    public function __construct()
    {
        if (!session_start())
            throw new StoreException('Cannot start session.');
    }

    public function save($data)
    {
        $_SESSION[$this->dataKey] = $data;
    }

    public function load()
    {
        if (!isset($_SESSION[$this->dataKey]))
            return;
        return $_SESSION[$this->dataKey];
    }
}