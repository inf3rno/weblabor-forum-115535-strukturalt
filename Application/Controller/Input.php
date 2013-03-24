<?php

namespace Controller;

class Input
{
    static protected $passwordField = 'password';

    static public function password()
    {
        try {
            if (!isset($_POST[static::$passwordField]))
                throw new InputException();
            if (!is_string($_POST[static::$passwordField]))
                throw new InputException();
            return $_POST[static::$passwordField];
        } catch (InputException $e) {
            return false;
        }
    }
}

