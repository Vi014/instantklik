<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    if(password_verify($_POST['password'], $_SESSION['password']))
	{
        echo $lang[30]." <br>";
        
        $username = $_SESSION['username'];

        $query = "DELETE FROM Korisnik 
                  WHERE Korisnik.Username = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $errorCode = mysqli_stmt_errno($stmt);

        if (!$errorCode)
        {
            echo $lang[31]." <br>";

            unset($_SESSION['username']);
            unset($_SESSION['password']);

            setcookie('username', 'asdf', 1, "/");
            setcookie('password', 'asdf', 1, "/");

            header("Location: $cfg->ROOT_URL/index.php");
        }
        else
        {
            echo $lang[32]." $errorCode <br>";
        }
	}
	else
	{
		echo $lang[33]." <a href='$cfg->ROOT_URL/deleteAccount.php'>".$lang[33]."</a>.";
	}
?>