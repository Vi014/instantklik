<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_POST['username'];
    $pwdHash  = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$query = "SELECT * 
              FROM Korisnik 
              WHERE Korisnik.Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
	$rowCount = $result->num_rows;

    if($rowCount == 0)
	{
		$query = "INSERT INTO korisnik (username, password) VALUES 
              	  (?, ?)";
    	$stmt = $connection->prepare($query);
    	$stmt->bind_param('ss', $username, $pwdHash);
    	$stmt->execute();
		$errorCode = mysqli_stmt_errno($stmt);
		
		if(!$errorCode)
		{
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pwdHash;
			setcookie("username", $username, time()+60*60*24*30*6, "/");
            setcookie("password", $pwdHash,  time()+60*60*24*30*6, "/");

			echo "Kreiranje naloga uspešno obavljeno!";

			header("Location: $cfg->ROOT_URL/editProfile.php");
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