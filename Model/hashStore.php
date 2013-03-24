<?php

namespace Model;

class HashStore
{
    static public function saveHash($hash)
    {
        return Store::writeConfig(array('hash' => $hash));
    }

    static public function loadHash()
    {
        $config = Store::readConfig();
        if ($config === false)
            return false;
        return $config['hash'];
    }
}

