<?php

namespace View;

class NoStoreAuthView extends AuthView
{
    protected $message = 'Nem sikerült kapcsolatot létesíteni az adattárolóval.';

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