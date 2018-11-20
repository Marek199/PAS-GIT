<?php
//unset($_COOKIE['user']);
$cookie='user';
$cookie_wartosc='';
setcookie($cookie, $cookie_wartosc, time() + (86400*30), "/");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<title>PLUTA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
Logowanie do panelu klienta
<form method="post" action="weryfikuj.php">
Login:<input type="text" name="user" maxlength="20" size="20"><br>
Hasło:<input type="password" name="pass" maxlength="20" size="20"><br>
<input type="submit" value="Send"/>
</form>
<a href="rejestracja.php">Rejestracja</a></br>
<a href='index.php'>Wstecz</a></br>
</BODY>
</HTML>