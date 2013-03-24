<?php

namespace View;

class UpdatedProfileView extends ProfileView
{
    protected $message = 'Sikeres jelszó csere.';

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

