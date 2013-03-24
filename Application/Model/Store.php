<?php

namespace Model;

interface Store
{
    public function save($data);

    public function load();
}