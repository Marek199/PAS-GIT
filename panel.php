<?php
if ($_COOKIE['user']=='')
{
	exit();}	
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<title>PLUTA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
PANEL KLIENTA
<a href="logowanie.php">Wyloguj</a></br>


<?php

$przegladarka=$dane['name'];
$system=$dane['platform'];
$ip_odwiedzajacego = $_SERVER["REMOTE_ADDR"];
$czas_obecny = date("y:m:d:H:i:s", time());
$user=$_COOKIE['user'];


echo 'Zalogowany jako: '.$_COOKIE['user'];
echo "<br></br>";
echo "IP:$ip_odwiedzajacego";
		
		$dbhost='xxx'; 
		$dbuser="xxx"; 
		$dbpassword="xxx";
		$dbname="xxx";
		$port = 'xzxx';
		
		$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
		if(!$polaczenie) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
		mysqli_query($polaczenie, "SET NAMES 'utf8'");
		mysqli_query($polaczenie, "INSERT INTO log_klient (nazwa_klienta,IP,przegladarka,datagodz,system) values ('$user','$ip_odwiedzajacego','$przegladarka','$czas_obecny','$system')"); 
		//mysql_close();
	//	$result = mysqli_query($polaczenie, "SELECT idKlient FROM Klient WHERE user='$user'");
	//	if ($wiersz = mysqli_fetch_array ($result)) 	
	//		{ 	
	//			
	//			echo $id=$wiersz[0];
	//			if (!empty($_POST['pytanie']))
	//			{
	//				mysqli_query($polaczenie, "INSERT INTO pytania (id_klienta,user,kategoria,pytanie) values ('$id','$user','$kategoria','$zapytanie')");
	//			}
			
	//		}
	
		 
		
		
		
			
		
		
		
?>
</BODY>
</HTML>