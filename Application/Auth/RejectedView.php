<?php

namespace Application\Auth;

class RejectedView extends View
{
    protected $message = 'Nem sikerült bejelentkezni a jelszóval.';

    public function build()
    {
        parent::build();
        $this->html->message($this->message);
    }
}