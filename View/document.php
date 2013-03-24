<?php

namespace View;

class Document
{
    static public function displayLoginForm()
    {
        Html::displaySkeleton('Bejelentkezés', function () {
            Html::displayForm('/index.php', 'Azonosító űrlap', 'Bejelentkezés');
        });
    }

    static public function displayUpdateForm($updated = false)
    {
        Html::displaySkeleton('Profil oldal', function () use ($updated) {
            Html::displayLink('/logout.php', 'kijelentkezés');
            Html::displayForm('/profile.php', 'Jelszó módosító űrlap', 'Módosítás');
            if ($updated)
                Html::displayMessage('Sikeres jelszó csere.');
        });
    }

}

