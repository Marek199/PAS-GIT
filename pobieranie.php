<html>
<?php
$dbhost='xxx'; 
$dbuser="xxx"; 
$dbpassword="xxx";
$dbname="xxx";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
$port = 'xxx';
$file = $_POST['pobieranie'];
$user=$_COOKIE['user'];
$sciezka ="/".$user."/".$file;
$cookie='sciezka';
$cookie_wartosc=$sciezka;
setcookie($cookie, $cookie_wartosc, time() + (86400*30), "/");
$_COOKIE['sciezka'];
//wypisywanie nazwy katalogu w którym dany uzytkownik sie znajduje
if($file=='')
{
	echo "Katalog Główny ";
}else
{
	echo "Katalog: ".$file;
}

//formularz wysylajacy dane do przerzut.php
//tj. informacje o nazwie pliku, który ma zostać pobrany
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
</html>