<?php

namespace View;

abstract class AbstractView implements View
{
    protected $html;
    protected $title;
    protected $content;

    public function __construct(\Container $container)
    {
        $this->html = $container->html();
    }

    public function display()
    {
        $this->build();
        $this->html->skeleton($this->title, $this->content);
    }

    abstract protected function build();

}