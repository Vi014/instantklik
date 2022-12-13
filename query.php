<?php
	include_once('connection.php');

	$profile = $_SESSION['profile'];

	echo "<br>";

	$query = "SELECT * 
              FROM Korisnik 
              WHERE Korisnik.Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $profile);
    $stmt->execute();
    $result = $stmt->get_result();
	$rowCount = $result->num_rows;

	if($rowCount != 0)
	{
		$query = "SELECT TipNaloga.ImeTipa, TipNaloga.Slika, Nalog.Link 
              FROM Korisnik INNER JOIN Nalog ON Korisnik.KorisnikID = Nalog.KorisnikID 
              				INNER JOIN TipNaloga ON Nalog.TipID = TipNaloga.TipID 
			  WHERE Korisnik.Username = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('s', $profile);
		$stmt->execute();
		$result = $stmt->get_result();
		
		while($row = mysqli_fetch_assoc($result))
		{
			$imeTipa = $row['ImeTipa'];
			$slika   = $row['Slika'];
			$link 	 = $row['Link'];
			
			echo "<a href='$link'><img style='height: 50px; width: 50px;' src='../$slika'></a> <br>";
		}
	}
	else
	{
		echo "Korisnik sa traženim imenom ne posotoji.";
	}
?>