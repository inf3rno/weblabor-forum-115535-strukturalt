<?php

require_once 'store.php';

function saveHash($hash)
{
    return writeConfig(array('hash' => $hash));
}

function loadHash()
{
    $config = readConfig();
    if ($config === false)
        return false;
    return $config['hash'];
}