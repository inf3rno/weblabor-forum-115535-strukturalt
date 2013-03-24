<?php

require 'tools.php';

if (authorized() || login($_POST))
    redirectToProfile();
else
    displayLoginForm();

