<?php

//logika

//munkamenet kezelés, azonosítás

session_start();

function authorized()
{
    return !empty($_SESSION['authorized']) && $_SESSION['authorized'] === true;
}

function login()
{
    $password = passwordInput();
    if ($password === false)
        return false;
    if (!validate($password))
        return false;
    $_SESSION['authorized'] = true;
    return true;
}

function update()
{
    $password = passwordInput();
    if ($password === false)
        return false;
    $success = save($password);
    return $success;
}

function logout()
{
    $_SESSION['authorized'] = false;
}

//űrlap adatok beolvasása

function passwordInput()
{
    if (!isset($_POST['password']))
        return false;
    if (!is_string($_POST['password']))
        return false;
    return $_POST['password'];
}

//jelszó mentés és összehasonlítás

function save($password)
{
    $config = array('hash' => createHash($password));
    return writeConfig($config);
}

function validate($password)
{
    $hash = createHash($password);
    $config = readConfig();
    if ($config === false)
        return false;
    if ($hash !== $config['hash'])
        return false;
    return true;
}

//hash készítés a jelszóból

function createHash($password)
{
    $salt = 'titkos';
    return sha1(sha1($salt) . $password);
}

//jelszó tároló fájl mentése és beolvasása

function writeConfig($config)
{
    $configJson = json_encode($config);
    if ($configJson === false)
        return false;
    $configFile = 'config.json';
    $success = file_put_contents($configFile, $configJson);
    return $success;
}

function readConfig()
{
    $configFile = 'config.json';
    if (!file_exists($configFile))
        return false;
    $configJson = file_get_contents($configFile);
    if ($configJson === false)
        return false;
    $config = json_decode($configJson, true);
    if ($config === null)
        return false;
    return $config;
}

//megjelenítés

//átirányítás

function redirectToProfile()
{
    redirect('/profile.php');
}

function redirectToLogin()
{
    redirect('/');
}

function redirect($url){
    header('location: '.$url);
}

//űrlapok

function displayLoginForm()
{
    displaySkeleton('Bejelentkezés', function () {
        displayForm('/index.php', 'Azonosító űrlap', 'Bejelentkezés');
    });
}


function displayUpdateForm($updated = false)
{
    displaySkeleton('Profil oldal', function () use ($updated) {
        displayLink('/logout.php', 'kijelentkezés');
        displayForm('/profile.php', 'Jelszó módosító űrlap', 'Módosítás');
        if ($updated)
            displayMessage('Sikeres jelszó csere.');
    });
}

//komponensek

function displaySkeleton($title, $displayContent)
{
    header('content-type: text/html; charset=utf-8');
    ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>
    <head>
        <title>Példa - <?php echo $title; ?></title>
    </head>
    <body>
    <h1><?php echo $title; ?></h1>
    <?php $displayContent(); ?>
    </body>
    </html><?php
}

function displayForm($action, $header, $description)
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

function displayLink($url, $label){
    ?><a href="<?php echo $url ?>"><?php echo $label ?></a><?php
}

function displayMessage($message){
    echo $message;
}