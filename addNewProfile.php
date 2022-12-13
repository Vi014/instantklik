<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    $tipID = $_POST['TipID'];
    $link = $_POST['link'];
    $username = $_SESSION['username'];

    $query = "SELECT Korisnik.KorisnikID 
              FROM Korisnik 
              WHERE Korisnik.Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $korisnikID = $row['KorisnikID'];
    }



    $query = "INSERT INTO Nalog(KorisnikID, TipID, Link) VALUES 
              (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('iis', $korisnikID, $tipID, $link);
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