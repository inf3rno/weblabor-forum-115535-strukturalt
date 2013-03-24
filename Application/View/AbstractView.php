<?php

namespace View;

abstract class AbstractView
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
        Html::skeleton(static::$title, static::$content);
    }

}