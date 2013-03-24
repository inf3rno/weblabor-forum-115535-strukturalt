<?php

if (login($_POST))
    redirectToProfile();
else
    displayLoginForm();

function login($data)
{
    if (empty($data))
        return false;
    if (!isset($data['password']))
        return false;
    if (!is_string($data['password']))
        return false;
    $password = $data['password'];
    $hash = createHash($password);

    $configFile = 'config.json';
    if (!file_exists($configFile))
        return false;
    $configJson = file_get_contents($configFile);
    if ($configJson === false)
        return false;
    $config = json_decode($configJson, true);
    if ($config === null)
        return false;
    $validHash = $config['hash'];

    return $hash === $validHash;
}

function redirectToProfile()
{
    header('location: profile.php');
}

function displayLoginForm ()
{
    header('content-type: text/html; charset=utf-8');
    ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>
    <head>
        <title>Példa - Bejelentkezés</title>
    </head>
    <body>
    <form action="index.php" method="post" enctype="application/x-www-form-urlencoded; charset=utf-8">
        <table>
            <thead>
            <tr>
                <td>Azonosító űrlap</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><label for="password">Jelszó</label></td>
                <td><input type="password" name="password" value=""></td>
            </tr>
            <tr>
                <td class="double" colspan="2">
                    <button>Bejelentkezés</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    </body>
    </html><?php
}

function createHash($password)
{
    $salt = 'titkos';
    return sha1(sha1($salt) . $password);
}