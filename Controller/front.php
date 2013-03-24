<?php

require_once 'Controller/entry.php';

function dispatch()
{
    $prefix = 'www';
    $defaultHandler = $prefix . 'index';
    if (preg_match('%^/([\w_-]+)\.php$%usD', $_SERVER['REQUEST_URI'], $matches))
        $handler = $prefix . $matches[1];
    else
        $handler = $defaultHandler;

    if (!function_exists($handler))
        $handler = $defaultHandler;

    $handler();
}