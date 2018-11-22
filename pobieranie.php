<?php
$dbhost='xxx'; 
$dbuser="xxx"; 
$dbpassword="xxx";
$dbname="xxx";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
$port = '80';
$file = $_POST['pobieranie'];
$user=$_COOKIE['user'];
$sciezka ="/".$user."/".$file;
$cookie='sciezka';
$cookie_wartosc=$sciezka;
setcookie($cookie, $cookie_wartosc, time() + (86400*30), "/");
$_COOKIE['sciezka'];
if($file=='')
{
	echo "Katalog Główny ";
}else
{
	echo "Katalog: ".$file;
}


echo"<form method='POST' action='przerzut.php'>";
echo"<select name='pobieranie'>";

$result = mysqli_query($polaczenie, "SELECT nazwa_pliku FROM pliki where sciezka='$sciezka'");
while ($wiersz = mysqli_fetch_array ($result)) 	
			{ 	
				 $id=$wiersz[0];
			echo"<option value='$id'>$id</option>";
			}

echo"<input type='submit' name='nadus' value='Pobierz Wybrany Plik'/>";
echo"</form>";
?>
