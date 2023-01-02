<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $accountID = $_REQUEST['accountID'];

    
    $query = "DELETE FROM account 
              WHERE accountID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $accountID);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo $lang[28]." <br>";
        // header("Location: $cfg->ROOT_URL/editProfile.php");
    }
    else
    {
        echo $lang[29]." $errorCode <br>";
    }
?>