<?php

require 'tools.php';

if (authorized())
    displayUpdateForm(update($_POST));
else
    redirectToLogin();

