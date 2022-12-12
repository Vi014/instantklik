<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    $Nalozi = $_SESSION['Nalozi'];

    for ($i=0; $i < count($Nalozi); $i++) 
    { 
        $trenutanID = $Nalozi[$i];
        $Link = $_POST[$trenutanID];

        $Query = "UPDATE Nalog 
                  SET Link = ? 
                  WHERE NalogID = ?";
        $stmt = $Connection->prepare($Query);
        $stmt->bind_param('si', $Link, $trenutanID);
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