<?php

require_once 'crypto.php';
require_once 'store.php';

function save($password)
{
    $config = array('hash' => createHash($password));
    return writeConfig($config);
}

function validate($password)
{
    $hash = createHash($password);
    $config = readConfig();
    if ($config === false)
        return false;
    if ($hash !== $config['hash'])
        return false;
    return true;
}
