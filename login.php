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
    </head>

    <body>
        <?php
            echo "<form action='$cfg->ROOT_URL/func/queries/checkLoginDetails.php' method='post'>";
            echo "  <input type='text'     name='username' required='true' placeholder='Korisničko ime'>";
            echo "  <input type='password' name='password' required='true' placeholder='Lozinka'>";
            echo "  <input type='checkbox' name='rememberMe'>Upamti me";
            echo "  <input type='submit' value='Prijava'>";
            echo "</form>";
        ?>
    </body>
</html>