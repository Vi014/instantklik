<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $typeID = $_POST['typeID'];
    $link = $_POST['link'];
    $username = $_SESSION['username'];

    $query = "SELECT user.userID 
              FROM user 
              WHERE user.username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $userID = $row['userID'];
    }



    $query = "INSERT INTO account (userID, typeID, link) VALUES 
              (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('iis', $userID, $typeID, $link);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo $lang[20]." <br>";
        header("Location: $cfg->ROOT_URL/editProfile.php");
    }
    else
    {
        echo $lang[21]." $errorCode <br>";
    }
?>