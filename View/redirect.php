<?php

namespace View;

class Redirect
{
    static public function toProfile()
    {
        static::to('/profile.php');
    }

    static public function toLogin()
    {
        static::to('/');
    }

    static public function to($url)
    {
        header('location: ' . $url);
    }
}
