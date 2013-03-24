<?php

function createHash($password)
{
    $salt = 'titkos';
    return sha1(sha1($salt) . $password);
}