<?php

require_once 'access.php';

session_start();

function authorized()
{
    return !empty($_SESSION['authorized']) && $_SESSION['authorized'] === true;
}

function login()
{
    $password = passwordInput();
    if ($password === false)
        return false;
    if (!validate($password))
        return false;
    $_SESSION['authorized'] = true;
    return true;
}

function update()
{
    $password = passwordInput();
    if ($password === false)
        return false;
    $success = save($password);
    return $success;
}

function logout()
{
    $_SESSION['authorized'] = false;
}