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
              WHERE Korisnik.Username = ?";
    $stmt = $Connection->prepare($Query);
    $stmt->bind_param('s', $Username);
    $stmt->execute();
    $Result = $stmt->get_result();

    while($Row = mysqli_fetch_assoc($Result))
    {
        $KorisnikID = $Row['KorisnikID'];
    }



    $Query = "INSERT INTO Nalog(KorisnikID, TipID, Link) VALUES 
              (?, ?, ?)";
    $stmt = $Connection->prepare($Query);
    $stmt->bind_param('iis', $KorisnikID, $TipID, $Link);
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
?>