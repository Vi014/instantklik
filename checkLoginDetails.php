<?php
    session_start();

    include_once('connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $Query    = "SELECT korisnik.username, korisnik.password FROM korisnik WHERE korisnik.username = '$username'";
	$Result   = mysqli_query($Connection, $Query);
	$RowCount = mysqli_num_rows($Result);

    if($RowCount > 0)
	{
        while($Row = mysqli_fetch_assoc($Result))
        {
            $pwdHash = $Row['password']; // sifra za sve placeholder naloge je "password"
        }

        if(password_verify($password, $pwdHash))
        {
            echo "Prijava uspešna!";

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pwdHash;
        }
        else
        {
            echo "Pogrešna šifra!";
        }
	}
	else
	{
		echo "Greška, ne postoji korisnik sa unetim imenom.";
	}
?>