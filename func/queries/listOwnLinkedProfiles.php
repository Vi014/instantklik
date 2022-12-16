<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    echo "<form action='$cfg->ROOT_URL/func/queries/executeProfileUpdate.php' method='post'>";
    
    $username = $_SESSION['username'];
    $_SESSION['Nalozi'] = array();

    $query = "SELECT Nalog.NalogID, TipNaloga.ImeTipa, Nalog.Link 
              FROM Korisnik INNER JOIN Nalog ON Korisnik.KorisnikID = Nalog.KorisnikID 
                            INNER JOIN TipNaloga ON nalog.TipID = TipNaloga.TipID 
              WHERE Korisnik.Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $nalogID = $row['NalogID'];
        $imeTipa = $row['ImeTipa'];
        $link 	 = $row['Link'];

        array_push($_SESSION['Nalozi'], $nalogID);
        
        echo $imeTipa;
        echo "<input type='text' name='$nalogID' value='$link'>";
        echo "<input type='button' onclick=\"deleteLinkedProfile($nalogID, '$cfg->ROOT_PATH', '$cfg->ROOT_URL')\" value='Obriši'>";
        echo "<br>";
    }

    echo "<input type='submit' value='Unos podataka'>";
    echo "</form>";
?>