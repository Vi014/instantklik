<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

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
        header("location: editProfile.php");
    }
    else
    {
        echo "Došlo je do greške: kod $errorCode <br>";
    }
?>