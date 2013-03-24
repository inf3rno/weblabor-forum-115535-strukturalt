<?php

//logika

//munkamenet kezelés, azonosítás

session_start();

function authorized(){
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

function update(){
    $password = passwordInput();
    if ($password === false)
        return false;
    $success = save($password);
    return $success;
}

function logout(){
    $_SESSION['authorized'] = false;
}

//űrlap adatok beolvasása

function passwordInput(){
    if (!isset($_POST['password']))
        return false;
    if (!is_string($_POST['password']))
        return false;
    return $_POST['password'];
}

//jelszó mentés és összehasonlítás

function save($password){
    $config = array('hash' => createHash($password));
    return writeConfig($config);
}

function validate($password){
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

function writeConfig($config){
    $configJson = json_encode($config);
    if ($configJson === false)
        return false;
    $configFile = 'config.json';
    $success = file_put_contents($configFile, $configJson);
    return $success;
}

function readConfig(){
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
    header('location: /profile.php');
}

function redirectToLogin()
{
    header('location: /');
}

//űrlapok

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
<a href="/logout.php">kijelentkezés</a>
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