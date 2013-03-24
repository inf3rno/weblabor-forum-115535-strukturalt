<?php

namespace Model;

class HashStore
{
    static public function save($hash)
    {
        return DataStore::save(array('hash' => $hash));
    }

    static public function load()
    {
        $config = DataStore::load();
        if ($config === false)
            return false;
        return $config['hash'];
    }
}

