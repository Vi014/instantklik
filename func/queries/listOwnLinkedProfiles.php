<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    echo "<form action='$cfg->ROOT_URL/func/queries/executeProfileUpdate.php' method='post'>";
    
    $username = $_SESSION['username'];
    $_SESSION['linkedAccounts'] = array();

    $query = "SELECT account.accountID, type.typeName, account.link 
              FROM user INNER JOIN account ON user.userID = account.userID 
                        INNER JOIN type    ON account.typeID = type.typeID 
              WHERE user.username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $accountID = $row['accountID'];
        $typeName  = $row['typeName'];
        $link 	   = $row['link'];

        array_push($_SESSION['linkedAccounts'], $accountID);
        
        echo $typeName;
        echo "<input type='text' name='$accountID' value='$link'>";
        echo "<input type='button' onclick=\"deleteLinkedProfile($accountID, '$cfg->ROOT_PATH', '$cfg->ROOT_URL', '".$lang[18]."')\" value='".$lang[38]."'>";
        echo "<br>";
    }

    echo "<input type='submit' value='".$lang[39]."'>";
    echo "</form>";
?>