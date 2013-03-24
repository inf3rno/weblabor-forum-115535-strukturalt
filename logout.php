<?php

require 'tools.php';

if (authorized())
    logout();
redirectToLogin();

