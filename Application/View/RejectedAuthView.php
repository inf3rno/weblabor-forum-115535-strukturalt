<?php

namespace View;

class RejectedAuthView extends AuthView
{
    protected $message = 'Nem sikerült bejelentkezni a jelszóval.';

    protected function build()
    {
        parent::build();
        $content = $this->content;
        $message = $this->message;
        $this->content = function () use ($content, $message) {
            $content();
            Html::message($message);
        };
    }
}