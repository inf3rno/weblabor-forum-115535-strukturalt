<?php

namespace View;

class NoStoreProfileView extends ProfileView
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

