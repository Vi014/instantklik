<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $nalozi = $_SESSION['Nalozi'];

    for ($i=0; $i < count($nalozi); $i++) 
    { 
        $trenutanID = $nalozi[$i];
        $link = $_POST[$trenutanID];

        $query = "UPDATE Nalog 
                  SET Link = ? 
                  WHERE NalogID = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('si', $link, $trenutanID);
        $stmt->execute();
        $errorCode = mysqli_stmt_errno($stmt);

        if (!$errorCode)
        {
            echo "Profil uspešno ažuriran! Uskoro ćete biti vraćeni na stranicu za izmenu povezanih naloga... <br>";
            header("Location: $cfg->ROOT_URL/editProfile.php");
        }
        else
        {
            echo "Došlo je do greške: kod $errorCode <br>";
        }
    }
?>