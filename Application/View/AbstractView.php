<?php

namespace View;

abstract class AbstractView implements View
{
    static protected $url;
    static protected $title;
    static protected $content;

    static public function redirect()
    {
        Html::redirect(static::$url);
    }

    static public function display()
    {
        static::build();
        Html::skeleton(static::$title, static::$content);
    }

    abstract static protected function build();

}