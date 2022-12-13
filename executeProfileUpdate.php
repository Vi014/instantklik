<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

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
            header("location: editProfile.php");
        }
        else
        {
            echo "Došlo je do greške: kod $errorCode <br>";
        }
    }
?>