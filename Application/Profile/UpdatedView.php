<?php

namespace Application\Profile;

class UpdatedView extends View
{
    protected $message = 'Sikeres jelszó csere.';

    public function build()
    {
        parent::build();
        $this->html->message($this->message);
    }

}

