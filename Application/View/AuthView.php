<?php

namespace View;

class AuthView extends AbstractView
{
    static protected $url = '/';
    static protected $title = 'Bejelentkezés';

    static protected $loginUrl = '/';
    static protected $loginFormHeader = 'Azonosító űrlap';
    static protected $loginFormButton = 'Bejelentkezés';

    static public function display()
    {
        $params = array(static::$loginUrl, static::$loginFormHeader, static::$loginFormButton);
        static::$content = function () use ($params) {
            Html::form($params[0], $params[1], $params[2]);
        };
        parent::display();
    }
}

