<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $nalogID = $_REQUEST['NalogID'];

    $query = "DELETE FROM Nalog 
              WHERE NalogID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $nalogID);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo "Povezan profil uspešno obrisan! Uskoro ćete biti vraćeni na stranicu za izmenu povezanih naloga... <br>";
        header("location: $cfg->ROOT_URL/editProfile.php");
    }
    else
    {
        echo "Došlo je do greške: kod $errorCode <br>";
    }
?>