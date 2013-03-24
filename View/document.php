<?php

require_once 'html.php';

function displayLoginForm()
{
    displaySkeleton('Bejelentkezés', function () {
        displayForm('/index.php', 'Azonosító űrlap', 'Bejelentkezés');
    });
}

function displayUpdateForm($updated = false)
{
    displaySkeleton('Profil oldal', function () use ($updated) {
        displayLink('/logout.php', 'kijelentkezés');
        displayForm('/profile.php', 'Jelszó módosító űrlap', 'Módosítás');
        if ($updated)
            displayMessage('Sikeres jelszó csere.');
    });
}
