<?php

namespace Application\Core\Model\Store;

interface Store
{
    public function save($data);

    public function load();
}