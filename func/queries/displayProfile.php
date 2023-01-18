<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

	$profile = $_SESSION['profile'];

	echo "<br>";

	$query = "SELECT * 
              FROM user 
              WHERE user.username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $profile);
    $stmt->execute();
    $result = $stmt->get_result();
	$rowCount = $result->num_rows;

	if($rowCount != 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$username 	 = $row['username'];
			$displayName = $row['displayName'];
			$banned 	 = $row['banned'];
		}

		if(!$banned)
		{
			echo "<br>";
			echo "<h1 style='font-size: xx-large;'>$displayName</h1>";
			echo "<br>";
			echo "<h2 style='font-size: large;'>@$username</h2>";
			echo "<br>";

			$query = "SELECT avatar 
					  FROM user
					  WHERE username = ?";
			$stmt = $connection->prepare($query);
			$stmt->bind_param('s', $profile);
			$stmt->execute();
			$result = $stmt->get_result();

			while($row = mysqli_fetch_assoc($result))
			{
				$imgName = $row['avatar'];
				if(isset($imgName))
				{
					$imgUrl = $cfg->ROOT_URL."/images/userAvatars/".$imgName;
				} 
				else 
				{
					$imgUrl = $cfg->ROOT_URL."/images/userAvatars/"."default.svg"; // source: https://freesvg.org/users-profile-icon
				}
				echo "<img style='height: 150px; width: 150px; object-fit: cover;' src='$imgUrl'>";
			}

			echo "<br>";

			$query = "SELECT type.typeName, account.link 
					  FROM user INNER JOIN account ON user.userID	 = account.userID 
								INNER JOIN type    ON account.typeID = type.typeID 
					  WHERE user.username = ?";
			$stmt = $connection->prepare($query);
			$stmt->bind_param('s', $profile);
			$stmt->execute();
			$result = $stmt->get_result();
			
			while($row = mysqli_fetch_assoc($result))
			{
				$imeTipa = $row['typeName'];
				$link 	 = $row['link'];

				$imgUrl = $cfg->ROOT_URL."/images/sites/".$imeTipa.".svg";
				
				echo "<a href='$link'><img style='height: 50px; width: 50px;' src='$imgUrl'></a> <br>";
			}
		}
		else
		{
			echo "<br>";
			echo "<h2 style='font-size: large;'>@$username</h2>";
			echo "<br>";
			echo $lang[93];
		}
	}
	else
	{
		echo $lang[37];
	}
?>