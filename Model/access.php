<?php

require_once 'crypto.php';
require_once 'hashStore.php';

function validate($password)
{
    return createHash($password) === loadHash();
}

function store($password)
{
    return saveHash(createHash($password));
}

