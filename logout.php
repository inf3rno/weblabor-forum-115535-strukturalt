<?php

require 'tools.php';

if (authorized())
    $_SESSION['authorized'] = false;
redirectToLogin();

