<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    $NalogID = $_REQUEST['NalogID'];

    $Query = "DELETE FROM Nalog 
              WHERE NalogID = ?";
    $stmt = $Connection->prepare($Query);
    $stmt->bind_param('i', $NalogID);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo "Povezan profil uspešno obrisan! Uskoro ćete biti vraćeni na stranicu za izmenu povezanih naloga... <br>";
        header("location: editProfile.php");
    }
    else
    {
        echo "Došlo je do greške: kod $errorCode <br>";
    }
?>