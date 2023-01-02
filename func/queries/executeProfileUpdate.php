<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $linkedAccounts = $_SESSION['linkedAccounts'];

    for ($i=0; $i < count($linkedAccounts); $i++) 
    { 
        $currentID = $linkedAccounts[$i];
        $link = $_POST[$currentID];

        $query = "UPDATE account 
                  SET link = ? 
                  WHERE accountID = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('si', $link, $currentID);
        $stmt->execute();
        $errorCode = mysqli_stmt_errno($stmt);

        if (!$errorCode)
        {
            echo $lang[34]." <br>";
            header("Location: $cfg->ROOT_URL/editProfile.php");
        }
        else
        {
            echo $lang[35]." $errorCode <br>";
        }
    }
?>