<?php

namespace Controller;

class Input
{
    static protected $passwordField = 'password';

    static public function password()
    {
        if (!isset($_POST[static::$passwordField]))
            return false;
        if (!is_string($_POST[static::$passwordField]))
            return false;
        return $_POST[static::$passwordField];
    }
}

