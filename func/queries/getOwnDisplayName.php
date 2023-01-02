<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_SESSION['username'];

    $query = "SELECT displayName 
              FROM user
              WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $displayName = $row['displayName'];

        echo "<form action='$cfg->ROOT_URL/func/queries/changeDisplayName.php' method='post'>";
        echo "  <input type='text' name='newDisplayName' required='true' value='$displayName'>";
        echo "  <input type='submit' value='".$lang[89]."'>";
        echo "</form>";
    }
?>