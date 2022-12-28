<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_SESSION['username'];
    $password = $_POST['confirmPass'];

    $query = "SELECT Korisnik.Password 
              FROM Korisnik 
              WHERE Korisnik.Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
	$rowCount = $result->num_rows;

    while($row = mysqli_fetch_assoc($result))
    {
        $pwdHash = $row['Password']; // sifra za sve placeholder naloge je "password"
    }

    if(password_verify($password, $pwdHash))
    {
        $updatesSuccessful = true;

        if($_POST['newUsername'] != "")
        {
            $newUsername = $_POST['newUsername']; 

            if(strlen($newUsername) >= 3 && strlen($newUsername) <= 15)
            {
                if(ctype_alnum(str_replace($aValid, '', $newUsername)))
                {
                    $query = "SELECT * 
                              FROM Korisnik 
                              WHERE Korisnik.Username = ?";
                    $stmt = $connection->prepare($query);
                    $stmt->bind_param('s', $newUsername);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $rowCount = $result->num_rows;
            
                    if($rowCount == 0)
                    {
                        $query = "UPDATE Korisnik 
                                  SET Username = ? 
                                  WHERE Username = ?";
                        $stmt = $connection->prepare($query);
                        $stmt->bind_param('ss', $newUsername, $username);
                        $stmt->execute();
                        $errorCode = mysqli_stmt_errno($stmt);
                        
                        if(!$errorCode)
                        {
                            $lang[49];

                            $_SESSION['username'] = $newUsername;
                            if(isset($_COOKIE['username']))
                            {
                                setcookie("username", $newUsername, time()+60*60*24*30*6, "/");
                            }
                        }
                        else
                        {
                            echo $lang[50]." $errorCode";
                            $updatesSuccessful = false;
                        }
                    }
                    else
                    {
                        echo $lang[48];
                        $updatesSuccessful = false;
                    }
                }
                else
                {
                    echo $lang[55];
                    $updatesSuccessful = false;
                }
            }
            else
            {
                echo $lang[57];
                $updatesSuccessful = false;
            }
        }

        if($_POST['newPassword'] != "")
        {
            $newPassword = $_POST['newPassword'];
            $newPwdHash  = password_hash($newPassword, PASSWORD_DEFAULT);

            if($newPassword == $_POST['confirm'])
            {
                if(!password_verify($newPassword, $pwdHash))
                {
                    $checkLength  = (strlen($newPassword) >= 8);
                    $checkNumber  = (preg_match("#[0-9]+#", $newPassword));
                    $checkUpper   = (preg_match("#[A-Z]+#", $newPassword));
                    $checkLower   = (preg_match("#[a-z]+#", $newPassword));
                    $checkSpecial = (preg_match("#[\W]+#", $newPassword));

                    if($checkLength && $checkNumber && $checkUpper && $checkLower && $checkSpecial)
                    {
                        $query = "UPDATE Korisnik 
                                  SET Password = ? 
                                  WHERE Username = ?";
                        $stmt = $connection->prepare($query);
                        $stmt->bind_param('ss', $newPwdHash, $_SESSION['username']);
                        $stmt->execute();
                        $errorCode = mysqli_stmt_errno($stmt);
                        
                        if(!$errorCode)
                        {
                            $lang[52];

                            $_SESSION['password'] = $newPwdHash;
                            if(isset($_COOKIE['username']))
                            {
                                setcookie("password", $newPwdHash, time()+60*60*24*30*6, "/");
                            }
                        }
                        else
                        {
                            echo $lang[53]." $errorCode";
                            $updatesSuccessful = false;
                        }
                    }
                    else
                    {
                        echo $lang[67]."<br>";

                        if($checkLength) echo $lang[73];
                        else echo $lang[74];
                        echo $lang[68]."<br>";

                        if($checkNumber) echo $lang[73];
                        else echo $lang[74];
                        echo $lang[69]."<br>";

                        if($checkUpper) echo $lang[73];
                        else echo $lang[74];
                        echo $lang[70]."<br>";

                        if($checkLower) echo $lang[73];
                        else echo $lang[74];
                        echo $lang[71]."<br>";

                        if($checkSpecial) echo $lang[73];
                        else echo $lang[74];
                        echo $lang[72]."<br>";

                        $updatesSuccessful = false;
                    }
                }
                else
                {
                    echo $lang[58];
                    $updatesSuccessful = false;
                }
            }
            else
            {
                echo $lang[76];
                $updatesSuccessful = false;
            }
        }

        if($updatesSuccessful)
        {
            echo $lang[51];
            header("Location: $cfg->ROOT_URL/editProfile.php");
        }
    }
    else
    {
        echo $lang[47];
    }
?>