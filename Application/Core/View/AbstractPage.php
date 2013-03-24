<?php

namespace Application\Core\View;

abstract class AbstractPage extends AbstractView
{
    protected $title;
    protected $messages = array();
    protected $code;

    public function __construct($code = null)
    {
        parent::__construct();
        $this->code = $code;
    }

    public function display()
    {
        $this->html->skeleton($this->title, array($this, 'build'));
    }

    abstract public function build();

    public function message()
    {
        if (isset($this->messages[$this->code]))
            $this->html->message($this->messages[$this->code]);
    }
}