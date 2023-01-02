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

            echo "<form action='$cfg->ROOT_URL/func/queries/createAccount.php' method='post'>";
            echo "  <input type='text'     name='username'     required='true' placeholder='".$lang[14]."'>";
            echo "  <input type='password' name='password'     required='true' placeholder='".$lang[15]."'>";
            echo "  <input type='password' name='confirm'      required='true' placeholder='".$lang[41]."'>";
            echo "  <input type='text'     name='displayName'  required='true' placeholder='".$lang[87]."'>";
            echo "  <input type='submit' value='".$lang[16]."'>";
		    echo "</form>";
        ?>
    </body>
</html>