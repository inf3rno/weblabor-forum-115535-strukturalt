<?php

namespace Application\Model\Store;

interface Store
{
    public function save($data);

    public function load();
}