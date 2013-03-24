<?php

namespace Application\Core\Model\Store;

class JsonStore implements Store
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function save($data)
    {
        $json = json_encode($data);
        if ($json === false)
            throw new StoreException('Cannot encode json data.');
        if (!file_put_contents($this->file, $json))
            throw new StoreException('Cannot write file: ' . $this->file);
    }

    public function load()
    {
        if (!file_exists($this->file))
            return;
        $json = file_get_contents($this->file);
        if ($json === false)
            throw new StoreException('Cannot read file: ' . $this->file);
        $data = json_decode($json, true);
        if ($data === null)
            throw new StoreException('Cannot decode json data.');
        return $data;
    }
}

