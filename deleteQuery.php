<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    if(password_verify($_POST['password'], $_SESSION['password']))
	{
        echo "Uneta šifra je ispravna. Sledi brisanje naloga... <br>";
        
        $username = $_SESSION['username'];

        $query = "DELETE FROM Korisnik 
                  WHERE Korisnik.Username = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $errorCode = mysqli_stmt_errno($stmt);

        if (!$errorCode)
        {
            echo "Instantklik nalog uspešno obrisan. Uskoro ćete biti prebačeni na naslovnu stranu... <br>";

            unset($_SESSION['username']);
            unset($_SESSION['password']);

            setcookie('username', 'asdf', 1);
            setcookie('password', 'asdf', 1);

            header("location: index.php");
        }
        else
        {
            echo "Došlo je do greške: kod $errorCode <br>";
        }
	}
	else
	{
		echo "Pogrešno uneta šifra! Vratite se na <a href='deleteAccount.php'>prethodnu stranicu</a>.";
	}
?>