<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $nalogID = $_REQUEST['NalogID'];

    $query = "DELETE FROM Nalog 
              WHERE NalogID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $nalogID);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo $lang[28]." <br>";
        header("Location: $cfg->ROOT_URL/editProfile.php");
    }
    else
    {
        echo $lang[29]." $errorCode <br>";
    }
?>