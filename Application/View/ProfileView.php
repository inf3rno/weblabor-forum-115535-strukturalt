<?php

namespace View;

class ProfileView
{
    static protected $locationUrl = '/profile.php';

    static protected $profileTitle = 'Profil oldal';

    static protected $logoutUrl = '/logout.php';
    static protected $logoutLinkLabel = 'kijelentkezés';

    static protected $updateUrl = '/profile.php';
    static protected $updateFormHeader = 'Jelszó módosító űrlap';
    static protected $updateFormButton = 'Módosítás';
    static protected $updateSuccessMessage = 'Sikeres jelszó csere.';

    static public function redirect()
    {
        Html::redirect(static::$locationUrl);
    }

    static public function display($updated = false)
    {
        $linkParams = array(static::$logoutUrl, static::$logoutLinkLabel);
        $formParams = array(static::$updateUrl, static::$updateFormHeader, static::$updateFormButton);
        $messageParam = static::$updateSuccessMessage;

        Html::skeleton(static::$profileTitle, function () use ($updated, $linkParams, $formParams, $messageParam) {
            Html::link($linkParams[0], $linkParams[1]);
            Html::form($formParams[0], $formParams[1], $formParams[2]);
            if ($updated)
                Html::message($messageParam);
        });
    }


}

