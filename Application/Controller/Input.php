<?php

namespace Controller;

class Input
{
    static protected $passwordField = 'password';

    static public function password()
    {
        if (!isset($_POST[static::$passwordField]))
            throw new InputException('Field not sent.');
        if (!is_string($_POST[static::$passwordField]))
            throw new InputException('Field is not string; it is an array.');
        return $_POST[static::$passwordField];
    }
}

