<?php

namespace Application\Core\View;

abstract class AbstractPage extends AbstractView
{
    protected $title;
    protected $messages = array();
    protected $code;

    public function display()
    {
        $this->html->skeleton($this->title, array($this, 'build'));
    }

    abstract public function build();

    protected function flash($code)
    {
        $this->code = $code;
    }

    protected function message()
    {
        if (isset($this->messages[$this->code]))
            $this->html->message($this->messages[$this->code]);
    }
}