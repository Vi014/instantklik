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

        $Query  = "DELETE FROM korisnik WHERE korisnik.username = '$username'";
        $Result = mysqli_query($Connection, $Query);

        if ($Result)
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
            echo "Došlo je do greške! <br>";
        }
	}
	else
	{
		echo "Pogrešno uneta šifra! Vratite se na <a href='deleteAccount.php'>prethodnu stranicu</a>.";
	}
?>