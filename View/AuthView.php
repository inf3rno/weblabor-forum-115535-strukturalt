<?php

namespace View;

class AuthView
{
    static public function loginForm()
    {
        Html::skeleton('Bejelentkezés', function () {
            Html::form('/index.php', 'Azonosító űrlap', 'Bejelentkezés');
        });
    }

    static public function updateForm($updated = false)
    {
        Html::skeleton('Profil oldal', function () use ($updated) {
            Html::link('/logout.php', 'kijelentkezés');
            Html::form('/profile.php', 'Jelszó módosító űrlap', 'Módosítás');
            if ($updated)
                Html::message('Sikeres jelszó csere.');
        });
    }

}

