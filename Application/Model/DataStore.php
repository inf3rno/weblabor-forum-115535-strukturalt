<?php

namespace Model;

interface DataStore
{
    /** menti a megadott adatot */
    static public function save($data);

    /** visszaadja az előzőleg mentett adatot */
    static public function load();
}