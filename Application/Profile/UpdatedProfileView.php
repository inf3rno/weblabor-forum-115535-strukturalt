<?php

namespace Application\Profile;

class UpdatedProfileView extends ProfileView
{
    protected $message = 'Sikeres jelszó csere.';

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

