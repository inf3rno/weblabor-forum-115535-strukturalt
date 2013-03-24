<?php

namespace Model;

class DataStore
{
    static public function save($data)
    {
        $json = json_encode($data);
        if ($json === false)
            return false;
        $file = 'config.json';
        $success = file_put_contents($file, $json);
        return $success;
    }

    static public function load()
    {
        $file = 'config.json';
        if (!file_exists($file))
            return false;
        $json = file_get_contents($file);
        if ($json === false)
            return false;
        $data = json_decode($json, true);
        if ($data === null)
            return false;
        return $data;
    }
}

