<?php
    session_start();

    include_once('connection.php');

    $username = $_POST['username'];
    $pwdHash  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $Query    = "SELECT * FROM korisnik WHERE korisnik.username = '$username'";
	$Result   = mysqli_query($Connection, $Query);
	$RowCount = mysqli_num_rows($Result);

    if($RowCount == 0)
	{
        $Query = "INSERT INTO korisnik (username, password) VALUES ('$username', '$pwdHash')";
		$Rezultat = mysqli_query($Connection, $Query);
		
		if($Rezultat)
		{
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pwdHash;
			echo "Kreiranje naloga uspešno obavljeno!";
		}
		else
		{
			echo "Došlo je do greške pri kreiranju naloga.";
		}
	}
	else
	{
		echo "Korisnik sa unetim imenom već postoji!";
	}
?>