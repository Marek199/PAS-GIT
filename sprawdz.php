<head>
<title>PLUTA</title>
</head>
<body>
<?php
		//dane potrzebne do połączenie z bazą
		$dbhost='xxx'; 
		$dbuser="xxx"; 
		$dbpassword="xxx";
		$dbname="xxx";
		$port = 'xxx';

		//łączenie z bazą danych
		$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); 
		if (!$polaczenie) 
		{
			echo "Błąd połączenia z MySQL." . PHP_EOL;
			echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		$czas_obecny = date("y:m:d:H:i:s", time());
		$user = $_POST['uzytkownik'];
		$pass = $_POST['haslo'];
		$pass_again=$_POST['haslo_again'];
		
			
		
			
			if(!empty($user) && !empty($pass))
				{	
					$wynik=mysqli_query($polaczenie, "SELECT user FROM users WHERE user='$user'");
					$rekord = mysqli_fetch_array($wynik);
					if($rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
					{
						mysqli_close($polaczenie); // zamknięcie połączenia z BD
						echo "Dany uzytkownik istnieje"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
					}
				 
					
				 // pobranie z BD wiersza, w którym login=login z formularza
					else
					{	if($pass==$pass_again)
						{
							mysqli_query($polaczenie, "INSERT INTO users (user,pass,stan) values ('$user','$pass','0')"); 
							echo "<br>Utworzono nowego uzytkownika</br>";
							echo "Rejestracja przebiegla pomyslnie. Mozesz teraz przejsc do <a href='logowanie.php'>Logowania</a>";
							$katalog = $user;
							
							//zakładanie katalogu uzytkownika przy udanej rejestracji
								mkdir("./$katalog", 0777);
								echo "Folder uzytkownika został utworzony";
							
							
							mysqli_close($polaczenie);
						}else
						{
							echo "Hasła nie sa rowne";
						}
					}
				}
				else
				{
					echo "Conajmniej jedno pole zostało puste. Upewnij się ze uzupełniłeś wszystkie pola";
				}	

		//umieszczenie do bazy danych pobranych z formularza i daty
		
		
		
		
	
		

		

?>

</body>
</html>