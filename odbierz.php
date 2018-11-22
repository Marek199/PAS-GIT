
<?php
$file = $_POST['problemo'];
$user=$_COOKIE['user'];

$sciezka ="/".$user."/".$file;
$dbhost='xxx'; 
		$dbuser="xxx"; 
		$dbpassword="xxx";
		$dbname="xxx";
		$port = 'xxx';
		$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
		

//////////////////////////////////////////////////////////
//ograniczenie rozmiaru pliku
$max_rozmiar = 1000;
//pobieranie pliku na strone
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }
else
{
echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
$nazwa_pliku = $_FILES['plik']['name'];
//sprawdzenie plik o danej nazwie juz istnieje
if (file_exists("./$user/$file/".$nazwa_pliku)){echo "Plik o podanej nazwie znajduje się w tym folderze";exit();}
//umieszczenie danych w tabeli gdzie znajduje sie plik 
mysqli_query($polaczenie, "INSERT INTO pliki (nazwa_pliku,sciezka,user) values ('$nazwa_pliku','$sciezka','$user')");
if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; }
//zapis pliku do odpowiedniego folderu
move_uploaded_file($_FILES['plik']['tmp_name'],"./$user/$file/".$_FILES['plik']['name']);
}
}
else {echo 'Błąd przy przesyłaniu danych!';}


?>