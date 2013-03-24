<?php

namespace Controller;

class Input
{
    static public function password()
    {
        if (!isset($_POST['password']))
            return false;
        if (!is_string($_POST['password']))
            return false;
        return $_POST['password'];
    }
}

