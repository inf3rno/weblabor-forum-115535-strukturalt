<?php

namespace Application\Auth;

class NoStoreView extends View
{
    protected $message = 'Nem sikerült kapcsolatot létesíteni az adattárolóval.';

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