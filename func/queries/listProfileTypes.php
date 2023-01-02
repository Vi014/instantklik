<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    echo "<form action='$cfg->ROOT_URL/func/queries/addNewProfile.php' method='post'>";
    
    $query = "SELECT type.typeID, type.typeName 
              FROM type";
    $stmt = $connection->prepare($query);
    // $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<select name='typeID'>";

    while($row = mysqli_fetch_assoc($result))
    {
        $typeID   = $row['typeID'];
        $typeName = $row['typeName'];

        echo "<option value='$typeID'>$typeName</option>";
    }

    echo "<input type='text' name='link' required='true'>";
    echo "<input type='submit' value='".$lang[40]."'>";
    echo "</form>";
?>