<?php

namespace Application\Auth;

class RejectedView extends View
{
    protected $message = 'Nem sikerült bejelentkezni a jelszóval.';

    protected function build()
    {
        parent::build();
        $html = $this->html;
        $content = $this->content;
        $message = $this->message;
        $this->content = function () use ($html, $content, $message) {
            $content();
            $html->message($message);
        };
    }
}