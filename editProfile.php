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
        
        <title>Instantklik</title>

		<?php 
            echo "<link rel='icon' href='$cfg->ROOT_URL/images/IK-smalltransparent.png'/>";
		    echo "<link rel='stylesheet' type='text/css' href='$cfg->ROOT_URL/css/style.css'/>";

            $jQueryUrl = $cfg->ROOT_URL."/js/jquery.min.js";
            $jQueryUrl = str_replace("/", "\/", $jQueryUrl);
        ?>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write('<script src="<?php echo $jQueryUrl; ?>"><\/script>')</script>

        <?php
            echo "<script src='$cfg->ROOT_URL/js/deleteLinkedProfile.js'></script>";
        ?>
    </head>

    <body>
        <?php
            if(isset($_SESSION['username']))
            {
                include_once $cfg->ROOT_PATH."/func/queries/listOwnLinkedProfiles.php";
                include_once $cfg->ROOT_PATH."/func/queries/listProfileTypes.php";

                echo "<a href='$cfg->ROOT_URL/func/logout.php'>Izlogujte se</a>";
                echo "<br>";
                echo "<a href='$cfg->ROOT_URL/deleteAccount.php'>Obriši nalog</a>";
            }
            else
            {
                echo "Niste ulogovani! Vratite se na <a href='$cfg->ROOT_URL/index.php'>glavnu stranicu</a> da bi ste se ulogovali.";
            }
        ?>
    </body>
</html>