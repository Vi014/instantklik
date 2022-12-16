<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    echo "<form action='$cfg->ROOT_URL/func/queries/addNewProfile.php' method='post'>";
    
    $query = "SELECT TipNaloga.TipID, TipNaloga.ImeTipa 
              FROM TipNaloga";
    $stmt = $connection->prepare($query);
    // $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<select name='TipID'>";

    while($row = mysqli_fetch_assoc($result))
    {
        $tipID   = $row['TipID'];
        $imeTipa = $row['ImeTipa'];

        echo "<option value='$tipID'>$imeTipa</option>";
    }

    echo "<input type='text' name='link' required='true'>";
    echo "<input type='submit' value='Dodaj novi link'>";
    echo "</form>";
?>