<?php

require 'tools.php';

if (authorized() || login())
    redirectToProfile();
else
    displayLoginForm();

