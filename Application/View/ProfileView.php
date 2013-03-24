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

    static public function display()
    {
        static::content();
        parent::display();
    }

    static protected function content()
    {
        $linkParams = array(static::$logoutUrl, static::$logoutLinkLabel);
        $formParams = array(static::$updateUrl, static::$updateFormHeader, static::$updateFormButton);
        static::$content = function () use ($linkParams, $formParams) {
            Html::link($linkParams[0], $linkParams[1]);
            Html::form($formParams[0], $formParams[1], $formParams[2]);
        };
    }


}

