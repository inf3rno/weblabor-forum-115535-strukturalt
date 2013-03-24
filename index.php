<?php

require_once 'Controller/input.php';
require_once 'Model/session.php';
require_once 'View/document.php';
require_once 'View/redirect.php';

if (authorized() || login(passwordInput()))
    redirectToProfile();
else
    displayLoginForm();

