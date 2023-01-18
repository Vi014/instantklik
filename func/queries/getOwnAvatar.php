<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_SESSION['username'];

    $query = "SELECT avatar 
              FROM user
              WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $imgName = $row['avatar'];
        if(isset($imgName))
        {
            $imgUrl = $cfg->ROOT_URL."/images/userAvatars/".$imgName;
        } 
        else 
        {
            $imgUrl = $cfg->ROOT_URL."/images/userAvatars/"."default.svg"; // source: https://freesvg.org/users-profile-icon
        }
        echo "<img style='height: 150px; width: 150px; object-fit: cover;' src='$imgUrl'>";
    }
?>