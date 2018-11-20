

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<title>PLUTA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
PANEL KLIENTA
<form method="POST">
Problem
<select name="problemo">
<option  selected="selected" value="Pomoc Techniczna">Pomoc Techniczna</option>
<option  value="Nowe Usługi">Nowe Usługi </option>
<option  value="Przedłużenie Umowy">Przedłużenie Umowy</option>
<option  value="Rezygnacja z Usługi">Rezygnacja z Usługi </option>
<option  value="Inne">Inne </option>
<option  value="6">... </option>
</select>
<br>
Pytanie:<input type="text" name="pytanie" maxlength="500" size="100" ><br>
<input type="submit" value="Wybierz"/>
</select>

</form>
<a href="pytanie.php">Moje Pytania</a></br>
<a href="logowanie.php">Wyloguj</a></br>


<?php	
$dane=getBrowser();


function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
	
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    } 
	  return array(
       'userAgent' => $u_agent,
       'name'      => $bname,
      'platform'  => $platform
        
    );
	
}
$przegladarka=$dane['name'];
$system=$dane['platform'];
$ip_odwiedzajacego = $_SERVER["REMOTE_ADDR"];
$czas_obecny = date("y:m:d:H:i:s", time());
$user=$_COOKIE['user'];


$kategoria = $_POST['problemo'];
$zapytanie = $_POST['pytanie'];

echo 'Zalogowany jako: '.$_COOKIE['user'];
echo "<br></br>";
echo "IP:$ip_odwiedzajacego";
		
		$dbhost='xxxx'; 
		$dbuser="xxxx"; 
		$dbpassword="xxxx";
		$dbname="xxxx";
		$port = 'xx';
		
		$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
		if(!$polaczenie) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
		mysqli_query($polaczenie, "SET NAMES 'utf8'");
		mysqli_query($polaczenie, "INSERT INTO log_klient (nazwa_klienta,IP,przegladarka,datagodz,system) values ('$user','$ip_odwiedzajacego','$przegladarka','$czas_obecny','$system')"); 
		//mysql_close();
		$result = mysqli_query($polaczenie, "SELECT idKlient FROM Klient WHERE user='$user'");
		if ($wiersz = mysqli_fetch_array ($result)) 	
			{ 	
				
				echo $id=$wiersz[0];
				if (!empty($_POST['pytanie']))
				{
					mysqli_query($polaczenie, "INSERT INTO pytania (id_klienta,user,kategoria,pytanie) values ('$id','$user','$kategoria','$zapytanie')");
				}
			
			}
	
		 
		
		
		
			
		
		
		
?>
</BODY>
</HTML>