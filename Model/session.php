<?php

require_once 'access.php';

session_start();

function authorized()
{
    return !empty($_SESSION['authorized']) && $_SESSION['authorized'] === true;
}

function login($password = false)
{
    if ($password !== false && validate($password))
        $_SESSION['authorized'] = true;
    return authorized();
}

function update($password = false)
{
    if ($password !== false)
        return store($password);
    return false;
}

function logout()
{
    $_SESSION['authorized'] = false;
}