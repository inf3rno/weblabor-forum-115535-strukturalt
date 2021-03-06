<?php

namespace Application\Core\View;

class Html {
    public function redirect($url)
    {
        header('location: ' . $url);
    }

    public function skeleton($title, $content)
    {
        header('content-type: text/html; charset=utf-8');
        ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
            <title>Példa - <?php echo $title; ?></title>
        </head>
        <body>
        <h1><?php echo $title; ?></h1>
        <?php call_user_func($content); ?>
        </body>
        </html><?php
    }

    public function form($action, $header, $description)
    {
        ?>
        <form action="<?php echo $action ?>" method="post" enctype="application/x-www-form-urlencoded; charset=utf-8">
        <table>
            <thead>
            <tr>
                <td><?php echo $header ?></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><label for="password"> Jelszó</label></td>
                <td><input type="password" name="password" value=""></td>
            </tr>
            <tr>
                <td class="double" colspan="2">
                    <button><?php echo $description ?></button>
                </td>
            </tr>
            </tbody>
        </table>
        </form><?php
    }

    public function link($url, $label)
    {
        ?><a href="<?php echo $url ?>"><?php echo $label ?></a><?php
    }

    public function message($message)
    {
        echo $message;
    }
}
