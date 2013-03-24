<?php

namespace Application\Core\View;

use Application\Container;

abstract class AbstractView implements View
{
    protected $html;
    protected $title;

    public function __construct(Container $container)
    {
        $this->html = $container->html();
    }

    public function display()
    {
        $this->html->skeleton($this->title, array($this, 'build'));
    }

    abstract public function build();

}