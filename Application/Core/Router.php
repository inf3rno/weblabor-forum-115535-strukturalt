<?php

namespace Application\Core;

use Application\Container;

class Router
{
    protected $defaultAction = 'index';
    protected $urlPattern = '%^/([\w_-]+)\.php$%usD';
    protected $controllers = array();

    public function __construct(Container $container)
    {
        $this->controllers[] = $container->authController();
        $this->controllers[] = $container->profileController();
    }

    public function dispatch($url)
    {
        $action = $this->defaultAction;
        if (preg_match($this->urlPattern, $url, $matches))
            $action = $matches[1];
        $found = false;
        foreach ($this->controllers as $controller) {
            if (method_exists($controller, $action)) {
                $found = true;
                $controller->$action();
                break;
            }
        }
        if (!$found) {
            $controller = $this->controllers[0];
            $action = $this->defaultAction;
            $controller->$action();
        }
    }
}
