<?php

namespace View;

class AuthView
{
    static protected $locationUrl = '/';
    static protected $authTitle = 'Bejelentkezés';

    static protected $loginUrl = '/';
    static protected $loginFormHeader = 'Azonosító űrlap';
    static protected $loginFormButton = 'Bejelentkezés';

    static public function redirect()
    {
        Html::redirect(static::$locationUrl);
    }

    static public function display()
    {
        $params = array(static::$loginUrl, static::$loginFormHeader, static::$loginFormButton);

        Html::skeleton(static::$authTitle, function () use ($params) {
            Html::form($params[0], $params[1], $params[2]);
        });
    }

}

