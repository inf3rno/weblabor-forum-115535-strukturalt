<?php

namespace View;

class ProfileView extends AbstractView
{
    static protected $url = '/profile.php';
    static protected $title = 'Profil oldal';

    static protected $logoutUrl = '/logout.php';
    static protected $logoutLinkLabel = 'kijelentkezés';

    static protected $updateUrl = '/profile.php';
    static protected $updateFormHeader = 'Jelszó módosító űrlap';
    static protected $updateFormButton = 'Módosítás';
    static protected $updateSuccessMessage = 'Sikeres jelszó csere.';

    static protected $updated = false;

    static public function displayUpdated()
    {
        static::$updated = true;
        static::display();
    }

    static public function display()
    {
        $linkParams = array(static::$logoutUrl, static::$logoutLinkLabel);
        $formParams = array(static::$updateUrl, static::$updateFormHeader, static::$updateFormButton);
        $messageParam = static::$updateSuccessMessage;
        $updated = static::$updated;

        static::$content = function () use ($updated, $linkParams, $formParams, $messageParam) {
            Html::link($linkParams[0], $linkParams[1]);
            Html::form($formParams[0], $formParams[1], $formParams[2]);
            if ($updated)
                Html::message($messageParam);
        };
        parent::display();
    }


}

