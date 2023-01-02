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
            unlink($cfg->ROOT_PATH."/images/userAvatars/".$imgName);
        } 
    }

    $tempname = $_FILES["avatarUpload"]["tmp_name"];
	$fileName = $_FILES["avatarUpload"]["name"];
	$extension = strrchr($fileName, ".");

    do
    {
        $newFilename = rand(0, 9999);
        $newFilename = str_pad($newFilename, 4, "0");
        $newFilename = $newFilename.$extension;
        $fullPath = $cfg->ROOT_PATH."/images/userAvatars/".$newFilename;
    } while(file_exists($fullPath));

    move_uploaded_file($tempname, $fullPath);

    $query = "UPDATE user 
              SET avatar = ? 
              WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('ss', $newFilename, $username);
    $stmt->execute();
    $errorCode = mysqli_stmt_errno($stmt);

    if (!$errorCode)
    {
        echo $lang[82]." <br>";
        header("Location: $cfg->ROOT_URL/editProfile.php");
    }
    else
    {
        echo $lang[83]." $errorCode <br>";
    }
?>