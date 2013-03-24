<?php

namespace Application\Core;

use Application\Container;

class Router
{
    protected $defaultAction = 'index';
    protected $urlPattern = '%^/([\w_-]+)\.php$%usD';
    protected $controller;

    public function __construct(Container $container)
    {
        $this->controller = $container->controller();
    }

    public function dispatch($url)
    {
        $action = $this->defaultAction;
        if (preg_match($this->urlPattern, $url, $matches))
            $action = $matches[1];
        if (!method_exists($this->controller, $action))
            $action = $this->defaultAction;
        $this->controller->$action();
    }
}
