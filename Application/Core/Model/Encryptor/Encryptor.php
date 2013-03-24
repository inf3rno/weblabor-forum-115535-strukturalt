<?php

namespace Application\Core\Model\Encryptor;

interface Encryptor
{
    public function hash($string);
}