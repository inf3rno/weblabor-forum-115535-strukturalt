<?php

namespace Application\Profile;

class NoStorePage extends Page
{
    protected $message = 'Nem sikerült kapcsolatot létesíteni az adattárolóval.';

    public function build()
    {
        parent::build();
        $this->html->message($this->message);
    }

}

