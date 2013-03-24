<?php

namespace View;

class RejectedAuthView extends AuthView
{
    static protected $message = 'Nem sikerült bejelentkezni a jelszóval.';

    static protected function build()
    {
        parent::build();
        $content = static::$content;
        $message = static::$message;
        static::$content = function () use ($content, $message) {
            $content();
            Html::message($message);
        };
    }
}