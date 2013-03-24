<?php

namespace Application\Auth;

use Application\Core\View\AbstractPage;

class Page extends AbstractPage
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

