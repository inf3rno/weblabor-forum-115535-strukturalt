<?php

session_start();

if (authorized())
    $_SESSION['authorized'] = false;
redirectToLogin();

function authorized()
{
    return !empty($_SESSION['authorized']) && $_SESSION['authorized'] === true;
}

function redirectToLogin()
{
    header('location: index.php');
}