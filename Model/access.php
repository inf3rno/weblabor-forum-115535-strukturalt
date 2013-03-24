<?php

namespace Model;

class Access
{
    static public function validate($password)
    {
        return Crypto::createHash($password) === HashStore::loadHash();
    }

    static public function store($password)
    {
        return HashStore::saveHash(Crypto::createHash($password));
    }


}

