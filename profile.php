<?php

require 'tools.php';

if (authorized())
    displayUpdateForm(update());
else
    redirectToLogin();

