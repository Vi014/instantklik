<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $tipID = $_POST['TipID'];
    $link = $_POST['link'];
    $username = $_SESSION['username'];

    $query = "SELECT Korisnik.KorisnikID 
              FROM Korisnik 
              WHERE Korisnik.Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $korisnikID = $row['KorisnikID'];
    }



    $query = "INSERT INTO Nalog(KorisnikID, TipID, Link) VALUES 
              (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('iis', $korisnikID, $tipID, $link);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo $lang[20]." <br>";
        header("Location: $cfg->ROOT_URL/editProfile.php");
    }
    else
    {
        echo $lang[21]." $errorCode <br>";
    }
?>