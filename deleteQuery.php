<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    include_once('connection.php');

    if(password_verify($_POST['password'], $_SESSION['password']))
	{
        /* 
        $Query    = "DELETE FROM korisnik WHERE korisnik.username = '$username'";
        $Result   = mysqli_query($Connection, $Query);
        $RowCount = mysqli_num_rows($Result);

        while($Row = mysqli_fetch_assoc($Result))
        {
            $pwdHash = $Row['password']; // sifra za sve placeholder naloge je "password"
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
        } */
        echo "sifra tacna";
	}
	else
	{
		echo "Pogrešno uneta šifra! Vratite se na <a href='deleteAccount.php'>prethodnu stranicu</a>.";
	}
?>