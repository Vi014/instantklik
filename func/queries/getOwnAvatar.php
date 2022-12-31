<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $username = $_SESSION['username'];

    $query = "SELECT Avatar 
              FROM Korisnik
              WHERE Username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result))
    {
        $imgName = $row['Avatar'];
        if(isset($imgName))
        {
            $imgUrl = $cfg->ROOT_URL."/images/userAvatars/".$imgName;
        } 
        else 
        {
            $imgUrl = $cfg->ROOT_URL."/images/userAvatars/"."default.png";
        }
        echo "<img style='height: 150px; width: 150px; object-fit: cover;' src='$imgUrl'>";
    }
?>