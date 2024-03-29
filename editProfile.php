<?php
    if(!isset($cfg))
	{
		$cfg = include_once "cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php 
            echo "<title>".$lang[0]."</title>";
            
            echo "<link rel='icon' href='$cfg->ROOT_URL/images/IK-smalltransparent.png'/>";
		    echo "<link rel='stylesheet' type='text/css' href='$cfg->ROOT_URL/css/style.css'/>";

            $jQueryUrl = $cfg->ROOT_URL."/js/jquery.min.js";
            $jQueryUrl = str_replace("/", "\/", $jQueryUrl);
        ?>
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write('<script src="<?php echo $jQueryUrl; ?>"><\/script>')</script>

		<?php
			$scriptUrl = $cfg->ROOT_URL."/js/script.js";
            $scriptUrl = str_replace("/", "\/", $scriptUrl);

            echo "<script src=\"$scriptUrl\"></script>";
        ?>
    </head>

    <body>
        <?php
            include_once $cfg->ROOT_PATH."/func/listLanguages.php";

            if(isset($_SESSION['username']))
            {
                include_once $cfg->ROOT_PATH."/func/queries/listOwnLinkedProfiles.php";
                echo "<br><br>";
                include_once $cfg->ROOT_PATH."/func/queries/listProfileTypes.php";
                echo "<br><br>";

                echo "<form action='$cfg->ROOT_URL/func/queries/updateAvatar.php' method='post' enctype='multipart/form-data'>";
                echo "  $lang[77]";
                echo "  <br>";
                include_once $cfg->ROOT_PATH."/func/queries/getOwnAvatar.php";
                echo "  <br>";
                echo "  $lang[78]";
                echo "  <input type='file' name='avatarUpload' required='true' id='uploadBtn' onchange=\"checkSize(this.files[0].size/1024/1024, '".$lang[79]."', '".$lang[80]."')\" accept='image/x-png, image/gif, image/jpeg'>";
                echo "  <br>";
                echo "  <input type='submit' value='".$lang[81]."'>";
                echo "</form>";

                echo "<form action='$cfg->ROOT_URL/func/queries/removeAvatar.php' method='post'>";
                echo "  <input type='submit' value='".$lang[84]."'>";
                echo "</form>";

                echo "<br><br>";

                include_once $cfg->ROOT_PATH."/func/queries/getOwnDisplayName.php";

                echo "<br><br>";

                echo "<form action='$cfg->ROOT_URL/func/queries/updateAccount.php' method='post'>";
                echo "  <input type='password' name='confirmPass'  required='true' placeholder='".$lang[43]."'>";
                echo "  <input type='text'     name='newUsername'  placeholder='".$lang[44]."'>";
                echo "  <input type='password' name='newPassword'  placeholder='".$lang[45]."'>";
                echo "  <input type='password' name='confirm'      placeholder='".$lang[75]."'>";
                echo "  <input type='submit'   value='".$lang[46]."'>";
                echo "</form>";

                echo "<a href='$cfg->ROOT_URL/func/logout.php'>".$lang[5]."</a>";
                echo "<br>";
                echo "<a href='$cfg->ROOT_URL/deleteAccount.php'>".$lang[6]."</a>";
            }
            else
            {
                echo $lang[7]." <a href='$cfg->ROOT_URL/index.php'>".$lang[8]."</a> ".$lang[9];
            }
        ?>
    </body>
</html>