<?php

namespace Application\Model\Encryptor;

interface Encryptor
{
    public function hash($string);
}