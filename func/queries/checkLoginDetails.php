<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT user.username, user.password 
              FROM user 
              WHERE user.username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
	$rowCount = $result->num_rows;

    if($rowCount > 0)
	{
        while($row = mysqli_fetch_assoc($result))
        {
            $pwdHash = $row['password']; // the password for all placeholder accounts is either "password" or "P@ssword1"
        }

        if(password_verify($password, $pwdHash))
        {
            echo $lang[22];

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pwdHash;
            
            if(isset($_POST['rememberMe']))
            {
                setcookie("username", $username, time()+60*60*24*30*6, "/");
                setcookie("password", $pwdHash,  time()+60*60*24*30*6, "/");
            }

            header("Location: $cfg->ROOT_URL/editProfile.php");
        }
        else
        {
            echo $lang[23];
        }
	}
	else
	{
		echo $lang[24];
	}
?>