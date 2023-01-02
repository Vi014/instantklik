<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

	if($_POST['password'] == $_POST['confirm'])
	{
		$password = $_POST['password'];

		$checkLength  = (strlen($password) >= 8);
		$checkNumber  = (preg_match("#[0-9]+#", $password));
		$checkUpper   = (preg_match("#[A-Z]+#", $password));
		$checkLower   = (preg_match("#[a-z]+#", $password));
		$checkSpecial = (preg_match("#[\W]+#", $password));

		if($checkLength && $checkNumber && $checkUpper && $checkLower && $checkSpecial)
		{
			$username = $_POST['username'];
			$pwdHash  = password_hash($_POST['password'], PASSWORD_DEFAULT);

			if(strlen($username) >= 3 && strlen($username) <= 15)
			{
				if(ctype_alnum(str_replace($aValid, '', $username)))
				{
					$query = "SELECT * 
							  FROM user 
							  WHERE user.username = ?";
					$stmt = $connection->prepare($query);
					$stmt->bind_param('s', $username);
					$stmt->execute();
					$result = $stmt->get_result();
					$rowCount = $result->num_rows;
				
					if($rowCount == 0)
					{
						$displayName = $_POST['displayName'];

						if(strlen($displayName) >= 1 && strlen($displayName) <= 50)
						{
							$query = "INSERT INTO user (username, password, displayName) VALUES 
									  (?, ?, ?)";
							$stmt = $connection->prepare($query);
							$stmt->bind_param('sss', $username, $pwdHash, $displayName);
							$stmt->execute();
							$errorCode = mysqli_stmt_errno($stmt);
							
							if(!$errorCode)
							{
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $pwdHash;
								setcookie("username", $username, time()+60*60*24*30*6, "/");
								setcookie("password", $pwdHash,  time()+60*60*24*30*6, "/");
					
								echo $lang[25];
					
								header("Location: $cfg->ROOT_URL/editProfile.php");
							}
							else
							{
								echo $lang[26]." $errorCode";
							}
						}
						else
						{
							echo $lang[88];
						}
					}
					else
					{
						echo $lang[27];
					}
				}
				else 
				{
					echo $lang[54];
				}
			}
			else
			{
				echo $lang[56];
			}
		}
		else
		{
			echo $lang[59]."<br>";

			if($checkLength) echo $lang[65];
			else echo $lang[66];
			echo $lang[60]."<br>";

			if($checkNumber) echo $lang[65];
			else echo $lang[66];
			echo $lang[61]."<br>";

			if($checkUpper) echo $lang[65];
			else echo $lang[66];
			echo $lang[62]."<br>";

			if($checkLower) echo $lang[65];
			else echo $lang[66];
			echo $lang[63]."<br>";

			if($checkSpecial) echo $lang[65];
			else echo $lang[66];
			echo $lang[64]."<br>";
		}
	}
	else
	{
		echo $lang[42];
	}
?>