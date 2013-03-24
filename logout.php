<?php

require_once 'Model/session.php';
require_once 'View/redirect.php';

if (authorized())
    logout();
redirectToLogin();

