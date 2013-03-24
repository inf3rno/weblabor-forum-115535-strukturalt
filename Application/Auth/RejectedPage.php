<?php

namespace Application\Auth;

class RejectedPage extends Page
{
    protected $message = 'Nem sikerült bejelentkezni a jelszóval.';

    public function build()
    {
        parent::build();
        $this->html->message($this->message);
    }
}