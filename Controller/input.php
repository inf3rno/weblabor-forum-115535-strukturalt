<?php

function passwordInput()
{
    if (!isset($_POST['password']))
        return false;
    if (!is_string($_POST['password']))
        return false;
    return $_POST['password'];
}