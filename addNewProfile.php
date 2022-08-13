<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    $TipID = $_POST['TipID'];
    $Link = $_POST['link'];
    $Username = $_SESSION['username'];

    $Query = "SELECT Korisnik.KorisnikID 
                FROM Korisnik 
                WHERE Korisnik.username = '$Username'";
    $Result = mysqli_query($Connection, $Query);

    while($Row = mysqli_fetch_assoc($Result))
    {
        $KorisnikID = $Row['KorisnikID'];
    }



    $Query = "INSERT INTO Nalog(KorisnikID, TipID, Link) VALUES 
                ($KorisnikID, $TipID, '$Link')";
    $Result = mysqli_query($Connection, $Query);

    if ($Result)
    {
        echo "Profil uspešno ažuriran! Uskoro ćete biti vraćeni na stranicu za izmenu povezanih naloga... <br>";
        header("location: editProfile.php");
    }
    else
    {
        echo "Došlo je do greške! <br>";
    }
?>