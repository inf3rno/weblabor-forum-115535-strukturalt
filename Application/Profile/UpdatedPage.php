<?php

namespace Application\Profile;

class UpdatedPage extends Page
{
    protected $message = 'Sikeres jelszó csere.';

    public function build()
    {
        parent::build();
        $this->html->message($this->message);
    }

}

