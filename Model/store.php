<?php

namespace Model;

class Store
{
    static public function writeConfig($config)
    {
        $configJson = json_encode($config);
        if ($configJson === false)
            return false;
        $configFile = 'config.json';
        $success = file_put_contents($configFile, $configJson);
        return $success;
    }

    static public function readConfig()
    {
        $configFile = 'config.json';
        if (!file_exists($configFile))
            return false;
        $configJson = file_get_contents($configFile);
        if ($configJson === false)
            return false;
        $config = json_decode($configJson, true);
        if ($config === null)
            return false;
        return $config;
    }
}

