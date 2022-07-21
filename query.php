<?php
	include_once('connection.php');

	$profile = $_SESSION['profile'];
	
	$Query  = "SELECT TipNaloga.ImeTipa, TipNaloga.Slika, Nalog.Link 
		FROM Korisnik INNER JOIN Nalog ON Korisnik.KorisnikID = Nalog.KorisnikID 
					  INNER JOIN TipNaloga ON Nalog.TipID = TipNaloga.TipID
		WHERE Korisnik.Username = $profile";
	
	$Result = mysqli_query($Connection, $Query);
	
	while($Row = mysqli_fetch_assoc($Result))
	{
		$ImeTipa = $Row['ImeTipa'];
		$Slika   = $Row['Slika'];
		$Link 	 = $Row['Link'];
		
		echo "<a href='$Link'><img style='height: 50px; width: 50px;' src='$Slika'></a> <br>";
 	}
?>