<?php

namespace Controller;

class Input
{
    protected $passwordField = 'password';

    public function password()
    {
        if (!isset($_POST[$this->passwordField]))
            throw new InputException('Field not sent.');
        if (!is_string($_POST[$this->passwordField]))
            throw new InputException('Field is not string; it is an array.');
        return $_POST[$this->passwordField];
    }
}

