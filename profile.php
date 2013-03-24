<?php

$updated = update($_POST);
displayUpdateForm($updated);

function update($data){
    if (empty($data))
        return false;
    if (!isset($data['password']))
        return false;
    if (!is_string($data['password']))
        return false;
    $password = $data['password'];
    $hash = createHash($password);

    $config = array('hash' => $hash);
    $configJson = json_encode($config);
    if ($configJson === false)
        return false;
    $configFile = 'config.json';
    $success = file_put_contents($configFile, $configJson);
    return $success;
}

function displayUpdateForm ($updated = false)
{
    header('content-type: text/html; charset=utf-8');
    ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>
    <head>
        <title>Példa - Profil oldal</title>
    </head>
    <body>
    <h1>Profil oldal</h1>
    <form action="profile.php" method="post" enctype="application/x-www-form-urlencoded; charset=utf-8">
        <table>
            <thead>
            <tr>
                <td>Jelszó módosító űrlap</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><label for="password">Jelszó</label></td>
                <td><input type="password" name="password" value=""></td>
            </tr>
            <tr>
                <td class="double" colspan="2">
                    <button>Módosítás</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <?php if ($updated) { ?>
        Sikeres jelszó csere.
    <?php } ?>
    </body>
    </html><?php
}

function createHash($password)
{
    $salt = 'titkos';
    return sha1(sha1($salt) . $password);
}