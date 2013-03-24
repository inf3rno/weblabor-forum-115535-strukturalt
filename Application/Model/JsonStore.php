<?php

namespace Model;

class JsonStore implements DataStore
{
    static protected $file;

    static public function configure($file)
    {
        static::$file = $file;
    }

    static public function save($data)
    {
        $json = json_encode($data);
        if ($json === false)
            return false;
        $success = file_put_contents(static::$file, $json);
        return $success;
    }

    static public function load()
    {
        if (!file_exists(static::$file))
            return false;
        $json = file_get_contents(static::$file);
        if ($json === false)
            return false;
        $data = json_decode($json, true);
        if ($data === null)
            return false;
        return $data;
    }
}
