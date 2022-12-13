<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT Korisnik.Username, Korisnik.Password 
              FROM Korisnik 
              WHERE Korisnik.Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
	$rowCount = $result->num_rows;

    if($rowCount > 0)
	{
        while($row = mysqli_fetch_assoc($result))
        {
            $pwdHash = $row['Password']; // sifra za sve placeholder naloge je "password"
        }

        if(password_verify($password, $pwdHash))
        {
            echo "Prijava uspešna!";

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pwdHash;
            
            if(isset($_POST['rememberMe']))
            {
                setcookie("username", $username, time()+60*60*24*30*6);
                setcookie("password", $pwdHash,  time()+60*60*24*30*6);
            }

            header("location: editProfile.php");
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