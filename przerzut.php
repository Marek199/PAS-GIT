<?php	
//pobieranie pliku na podstawie
//folderu w którym się uzytkownik
//znajduje oraz wybranej nazwy pliku
//z pliku pobieranie.php
$sciezka=$_COOKIE['sciezka'];
$file = $_POST['pobieranie'];
$droga= "$sciezka/$file";
if (file_exists(".$droga")) {
	header("Content-length: .$droga");
    header("Content-type: .$droga");
    header("Content-Disposition: attachment; filename=$file");
    readfile(".$droga");
    exit;
}else
{
	echo "pliku nie ma";
}

?>
