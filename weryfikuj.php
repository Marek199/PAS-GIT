<?php
$user=$_POST['user']; // login z formularza
$pass=$_POST['pass']; // hasło z formularza
$cookie='user';
$cookie_wartosc=$user;
setcookie($cookie, $cookie_wartosc, time() + (86400*30), "/");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
<title>PLUTA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
		$dbhost='xxx'; 
		$dbuser="xxx"; 
		$dbpassword="xxx";
		$dbname="xxx";
		$port = 'xxx';
		

$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); // połączenie z BD – wpisać swoje parametry !!!
if(!$polaczenie) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
mysqli_query($polaczenie, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$result = mysqli_query($polaczenie, "SELECT * FROM Klient WHERE user='$user'"); // pobranie z BD wiersza, w którym login=login z formularza
$rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
{mysqli_close($polaczenie); // zamknięcie połączenia z BD
echo "Login lub hasło są nie poprawne"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
}
else
{ // Jeśli $rekord istnieje
if($rekord['pass']==$pass) // czy hasło zgadza się z BD
{
echo "<br> Logowanie Powiodło się </br>"; 

?>
<a href='panel.php'>Przejdz do panelu Klienta</a></br>
<?php

}
else
{
mysqli_close($polaczenie);
echo "Login lub hasło są nie poprawne"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
}
}
?>
</BODY>
</HTML>