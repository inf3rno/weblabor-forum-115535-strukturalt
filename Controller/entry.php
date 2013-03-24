<?php

require_once 'Controller/input.php';
require_once 'Model/session.php';
require_once 'View/document.php';
require_once 'View/redirect.php';

function wwwindex()
{
    if (authorized() || login(passwordInput()))
        redirectToProfile();
    else
        displayLoginForm();
}

function wwwlogout()
{
    if (authorized())
        logout();
    redirectToLogin();

}

function wwwprofile()
{
    if (authorized())
        displayUpdateForm(update(passwordInput()));
    else
        redirectToLogin();
}