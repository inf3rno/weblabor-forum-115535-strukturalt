<?php

namespace Model;

class Sha1Encryptor implements Encryptor
{
    protected $salt;

    public function __construct($salt)
    {
        $this->salt = $salt;
    }

    public function hash($string)
    {
        return sha1(sha1($this->salt) . $string);
    }
}
