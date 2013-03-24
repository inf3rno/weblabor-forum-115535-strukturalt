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
            throw new StoreException('Cannot encode json data.');
        if (!file_put_contents(static::$file, $json))
            throw new StoreException('Cannot write file: ' . static::$file);
    }

    static public function load()
    {
        if (!file_exists(static::$file))
            return;
        $json = file_get_contents(static::$file);
        if ($json === false)
            throw new StoreException('Cannot read file: ' . static::$file);
        $data = json_decode($json, true);
        if ($data === null)
            throw new StoreException('Cannot decode json data.');
        return $data;
    }
}

