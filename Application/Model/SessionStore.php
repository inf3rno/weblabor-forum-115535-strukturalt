<?php

namespace Model;

class SessionStore implements DataStore
{
    static protected $started = false;
    static protected $dataKey = 'data';

    static public function save($data)
    {
        static::startIfNecessary();
        $_SESSION[static::$dataKey] = $data;
    }

    static public function load()
    {
        static::startIfNecessary();
        if (!isset($_SESSION[static::$dataKey]))
            return;
        return $_SESSION[static::$dataKey];
    }

    static protected function startIfNecessary()
    {
        if (!static::$started) {
            if (!session_start())
                throw new StoreException('Cannot start session.');
            static::$started = true;
        }
    }
}