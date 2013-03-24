<?php

namespace Application\Auth;

use Application\Core\View\AbstractView;

class View extends AbstractView
{
    protected $title = 'Bejelentkezés';

    protected $loginUrl = '/';
    protected $loginFormHeader = 'Azonosító űrlap';
    protected $loginFormButton = 'Bejelentkezés';

    public function build()
    {
        $this->html->form($this->loginUrl, $this->loginFormHeader, $this->loginFormButton);
    }
}

