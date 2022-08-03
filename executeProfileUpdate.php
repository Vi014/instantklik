<?php
    session_start();

    include_once('connection.php');

    $Nalozi = $_SESSION['Nalozi'];

    for ($i=0; $i < count($Nalozi); $i++) 
    { 
        $trenutanID = $Nalozi[$i];
        $Link = $_POST[$trenutanID];

        $Query = "UPDATE Nalog SET Link = '$Link' WHERE NalogID = $trenutanID";

        $Rezultat = mysqli_query($Connection, $Query);

        if ($Rezultat)
        {
            echo "Profil uspešno ažuriran! Uskoro ćete biti vraćeni na stranicu za izmenu povezanih naloga...";
            header("location: editProfile.php");
        }
        else
        {
            echo "Došlo je do greške!";
        }
    }
?>