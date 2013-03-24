<?php

namespace Application\Core\View;

abstract class AbstractView implements View
{
    protected $html;

    public function __construct()
    {
        $this->html = new Html();
    }
}