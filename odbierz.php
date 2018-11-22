<?php
//header("Location: panel.php");
$file = $_POST['problemo'];
$user=$_COOKIE['user'];

$sciezka ="/".$user."/".$file;
$dbhost='localhost'; 
		$dbuser="xxx"; 
		$dbpassword="xxx";
		$dbname="xxx";
		$port = '8xxx0';
		$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
		

//////////////////////////////////////////////////////////
$max_rozmiar = 1000;
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }
else
{
echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
$nazwa_pliku = $_FILES['plik']['name'];
if (file_exists("./$user/$file/".$nazwa_pliku)){echo "Plik o podanej nazwie znajduje się w tym folderze";exit();}
mysqli_query($polaczenie, "INSERT INTO pliki (nazwa_pliku,sciezka,user) values ('$nazwa_pliku','$sciezka','$user')");
if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; }
move_uploaded_file($_FILES['plik']['tmp_name'],"./$user/$file/".$_FILES['plik']['name']);
}
}
else {echo 'Błąd przy przesyłaniu danych!';}


?>