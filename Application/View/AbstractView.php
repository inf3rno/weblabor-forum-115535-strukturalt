<?php

namespace View;

abstract class AbstractView implements View
{
    protected $title;
    protected $content;

    public function display()
    {
        $this->build();
        Html::skeleton($this->title, $this->content);
    }

    abstract protected function build();

}