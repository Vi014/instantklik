<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_SESSION['username'];

    $newDisplayName = $_POST['newDisplayName'];

    if(strlen($newDisplayName) >= 1 && strlen($newDisplayName) <= 50)
    {
        $query = "UPDATE user 
                  SET displayName = ? 
                  WHERE username = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ss', $newDisplayName, $username);
        $stmt->execute();
        $errorCode = mysqli_stmt_errno($stmt);

        if (!$errorCode)
        {
            echo $lang[91]." <br>";
            header("Location: $cfg->ROOT_URL/editProfile.php");
        }
        else
        {
            echo $lang[92]." $errorCode <br>";
        }
    }
    else
    {
        echo $lang[90];
    }
?>