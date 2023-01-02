<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_SESSION['username'];

    $query = "SELECT avatar 
              FROM user
              WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $imgName = $row['avatar'];
        unlink($cfg->ROOT_PATH."/images/userAvatars/".$imgName);
    }

    $query = "UPDATE user 
              SET avatar = NULL 
              WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo $lang[85]." <br>";
        header("Location: $cfg->ROOT_URL/editProfile.php");
    }
    else
    {
        echo $lang[86]." $errorCode <br>";
    }
?>