<?php

namespace View;

interface View
{
    /** átirányít http header-el a View-hoz tartozó oldalra */
    static public function redirect();

    /** megjeleníti a View-hoz tartozó oldalt */
    static public function display();
}