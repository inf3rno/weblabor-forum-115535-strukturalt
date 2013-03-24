<?php

namespace View;

class UpdatedProfileView extends ProfileView
{
    static protected $updateSuccessMessage = 'Sikeres jelszó csere.';

    static protected function content()
    {
        parent::content();
        $content = static::$content;
        $messageParam = static::$updateSuccessMessage;
        static::$content = function () use ($content, $messageParam) {
            $content();
            Html::message($messageParam);
        };
    }

}

