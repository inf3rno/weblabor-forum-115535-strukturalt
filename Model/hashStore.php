<?php

namespace Model;

class HashStore
{
    static protected $hashKey = 'hash';

    static public function save($hash)
    {
        $data = array();
        $data[static::$hashKey] = $hash;
        return DataStore::save($data);
    }

    static public function load()
    {
        $config = DataStore::load();
        if ($config === false)
            return false;
        return $config[static::$hashKey];
    }
}

