<?php

$user=$_POST['user']; // login z formularza
$pass=$_POST['pass']; // hasło z formularza
$cookie='user';
$cookie_wartosc=$user;
setcookie($cookie, $cookie_wartosc, time() + (86400*30), "/");
$czas_obecny = date("y:m:d:H:i:s", time());

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
$result = mysqli_query($polaczenie, "SELECT * FROM users WHERE user='$user'"); // pobranie z BD wiersza, w którym login=login z formularza
$rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
{mysqli_close($polaczenie); // zamknięcie połączenia z BD
echo "Login lub hasło są nie poprawne"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
}
else
{ // Jeśli $rekord istnieje

if($rekord['stan']==1)
{
	
	
	$rezultat = mysqli_query($polaczenie, "SELECT czas FROM users where user='$user'");
	if ($wiersz = mysqli_fetch_array ($rezultat)) 	
			{ 	
			
			$czas_blokowania=$wiersz[0];
			 $ts = strtotime($czas_blokowania);
			 $odblokowanie= time();
		
			
			
			
				if($odblokowanie > $ts + 60)
				{
					mysqli_query($polaczenie, "UPDATE users SET stan= '0',czas='now()' WHERE user='$user'") or die("Problem z czasem");
					
					echo "Konto zostalo odblokowane";
					echo "<a href='logowanie.php'>Wróc do logowania</a></br>";
					exit();
				}else
				{
			
					echo"Konto zablokowane na czas 1 minuty. Spróbuj ponownie później";
					exit();
				}
			
			}
	
}
if($rekord['pass']==$pass) // czy hasło zgadza się z BD
{	
	mysqli_query($polaczenie, "INSERT INTO logi (login,data,komunikat) values ('$user','$czas_obecny','0')") or die ("COs nie dziala");
 
echo "<br> Logowanie Powiodło się </br>"; 

?>
<a href='panel.php'>Przejdz do panelu Klienta</a></br>
<?php

}
else
{
mysqli_query($polaczenie, "INSERT INTO logi (login,data,komunikat) values ('$user','$czas_obecny','1')");
$rezultat = mysqli_query($polaczenie, "SELECT * FROM logi ORDER BY idlogi DESC LIMIT 0,3");
while ($wiersz = mysqli_fetch_array ($rezultat)) 	
			{ 	
				 $liczba = $wiersz[3];
				 $proby=$proby+$liczba;
				
				if($proby==3)
				{	
					echo"Konto zostało zablokowane. Popros Administratora o jego odblokowanie";
					
					mysqli_query($polaczenie, "UPDATE users SET stan= '1',czas='$czas_obecny' WHERE user='$user'") or die("Problem z czasem");
					
					exit();
				}
			}


mysqli_close($polaczenie);
echo "Login lub hasło są nie poprawne"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
}
}
?>
</BODY>
</HTML>