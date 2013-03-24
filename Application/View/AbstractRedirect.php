<?php

namespace View;

abstract class AbstractRedirect implements View
{
    protected $html;
    protected $url;

    public function __construct(\Container $container)
    {
        $this->html = $container->html();
    }

    public function display()
    {
        $this->html->redirect($this->url);
    }
}