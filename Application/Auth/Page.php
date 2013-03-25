<?php

namespace Application\Auth;

use Application\Core\View\AbstractPage;

class Page extends AbstractPage
{
    protected $title = 'Bejelentkezés';

    protected $loginUrl = '/';
    protected $loginFormHeader = 'Azonosító űrlap';
    protected $loginFormButton = 'Bejelentkezés';

    protected $messages = array(
        'noStore' => 'Nem sikerült kapcsolatot létesíteni az adattárolóval.',
        'rejected' => 'Nem sikerült bejelentkezni a jelszóval.'
    );

    public function build()
    {
        $this->html->form($this->loginUrl, $this->loginFormHeader, $this->loginFormButton);
        $this->message();
    }

    public function noStore()
    {
        $this->flash('noStore');
    }

    public function rejected()
    {
        $this->flash('rejected');
    }
}

