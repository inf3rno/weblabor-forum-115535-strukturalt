<?php

namespace View;

class UpdatedProfileView extends ProfileView
{
    static protected $message = 'Sikeres jelszó csere.';

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

