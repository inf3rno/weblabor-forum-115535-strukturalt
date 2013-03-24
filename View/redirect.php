<?php

function redirectToProfile()
{
    redirect('/profile.php');
}

function redirectToLogin()
{
    redirect('/');
}

function redirect($url){
    header('location: '.$url);
}