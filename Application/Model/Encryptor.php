<?php

namespace Model;

interface Encryptor
{
    public function hash($string);
}