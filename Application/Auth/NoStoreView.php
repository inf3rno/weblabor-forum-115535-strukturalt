<?php

namespace Application\Auth;

class NoStoreView extends View
{
    protected $message = 'Nem sikerült kapcsolatot létesíteni az adattárolóval.';

    public function build()
    {
        parent::build();
        $this->html->message($this->message);
    }
}