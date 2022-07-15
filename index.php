<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Instantklik</title>
		<link rel="icon" href="images/IK-smalltransparent.png"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
		<div id="links"></div>

		<script src="script.js"></script>

		<?php
			$profile = $_GET['profile'];

			// include_once('query.php');

			include_once('connection.php');
	
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
	</body>
</html>
