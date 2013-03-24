<?php

namespace Application\Core\View;

abstract class AbstractRedirect extends AbstractView
{
    protected $url;

    public function display()
    {
        $this->html->redirect($this->url);
    }
}