<?php

namespace View;

class NoStoreAuthView extends AuthView
{
    static protected $message = 'Nem sikerült kapcsolatot létesíteni az adattárolóval.';

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