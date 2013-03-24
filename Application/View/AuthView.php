<?php

namespace View;

class AuthView extends AbstractView
{
    static protected $url = '/';
    static protected $title = 'Bejelentkezés';

    static protected $loginUrl = '/';
    static protected $loginFormHeader = 'Azonosító űrlap';
    static protected $loginFormButton = 'Bejelentkezés';

    static protected function build()
    {
        $params = array(static::$loginUrl, static::$loginFormHeader, static::$loginFormButton);
        static::$content = function () use ($params) {
            Html::form($params[0], $params[1], $params[2]);
        };
    }
}

