<?php

namespace Application\Core\View;

abstract class AbstractPage extends AbstractView
{
    protected $title;

    public function display()
    {
        $this->html->skeleton($this->title, array($this, 'build'));
    }

    abstract public function build();

}