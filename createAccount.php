<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    $username = $_POST['username'];
    $pwdHash  = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$Query = "SELECT * 
              FROM Korisnik 
              WHERE Korisnik.Username = ?";
    $stmt = $Connection->prepare($Query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $Result = $stmt->get_result();
	$RowCount = mysqli_num_rows($Result);

    if($RowCount == 0)
	{
		$Query = "INSERT INTO korisnik (username, password) VALUES 
              	  (?, ?)";
    	$stmt = $Connection->prepare($Query);
    	$stmt->bind_param('ss', $username, $pwdHash);
    	$stmt->execute();
		$errorCode = mysqli_stmt_errno($stmt);
		
		if(!$errorCode)
		{
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pwdHash;
			setcookie("username", $username, time()+60*60*24*30*6);
            setcookie("password", $pwdHash,  time()+60*60*24*30*6);

			echo "Kreiranje naloga uspešno obavljeno!";

			header("location: editProfile.php");
		}
		else
		{
			echo "Došlo je do greške pri kreiranju naloga: kod $errorCode";
		}
	}
	else
	{
		echo "Korisnik sa unetim imenom već postoji!";
	}
?>