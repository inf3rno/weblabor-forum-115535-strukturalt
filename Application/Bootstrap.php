<?php

namespace Application;

class Bootstrap
{

    public function __construct()
    {
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'AutoLoad.php');

        $autoLoad = new Core\AutoLoad();
        $autoLoad->register(__DIR__ . DIRECTORY_SEPARATOR . '..');

        $container = new Container(__DIR__);
        $container->router()->dispatch($_SERVER['REQUEST_URI']);
    }

}