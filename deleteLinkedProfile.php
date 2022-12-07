<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    $NalogID = $_REQUEST['NalogID'];

    $Query    = "DELETE FROM Nalog WHERE NalogID = $NalogID";
    $Result   = mysqli_query($Connection, $Query);

    if ($Result)
    {
        echo "Povezan profil uspešno obrisan! Uskoro ćete biti vraćeni na stranicu za izmenu povezanih naloga... <br>";
        header("location: editProfile.php");
    }
    else
    {
        echo "Došlo je do greške! <br>";
    }
?>