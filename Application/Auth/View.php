<?php

namespace Application\Auth;

use Application\Core\View\AbstractView;

class View extends AbstractView
{
    protected $title = 'Bejelentkezés';

    protected $loginUrl = '/';
    protected $loginFormHeader = 'Azonosító űrlap';
    protected $loginFormButton = 'Bejelentkezés';

    protected function build()
    {
        $html = $this->html;
        $params = array($this->loginUrl, $this->loginFormHeader, $this->loginFormButton);
        $this->content = function () use ($html, $params) {
            $html->form($params[0], $params[1], $params[2]);
        };
    }
}

