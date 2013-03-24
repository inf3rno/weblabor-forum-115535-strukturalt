<?php

namespace Model;

class Crypto
{
    static protected $salt = 'titkos';

    static public function hash($password)
    {
        return sha1(sha1(static::$salt) . $password);
    }
}
