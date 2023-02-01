<?php
    if(!isset($cfg))
    {
        $cfg = include_once "../../cfg/config.php";
    }

    include_once $cfg->ROOT_PATH."/func/startup.php";

    $query = "SELECT administrator 
              FROM user
              WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        return $row['administrator'];
    }
?>