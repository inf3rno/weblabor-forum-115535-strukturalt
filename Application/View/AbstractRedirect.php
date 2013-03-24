<?php

namespace View;

abstract class AbstractRedirect implements View
{
    protected $url;

    public function display()
    {
        Html::redirect($this->url);
    }
}