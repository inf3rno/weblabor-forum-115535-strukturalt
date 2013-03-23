<?php
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
</html>