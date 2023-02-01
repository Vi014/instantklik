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
                if(include $cfg->ROOT_PATH."/func/queries/adminLogin.php")
                {
                    echo "Lookup user by ID in the database: ";
                    echo "<br>";
                    echo "(input fields go here)";
                    echo "<br>";
                    echo "Lookup user by username/@: ";
                    echo "<br>";
                    echo "(input fields go here)";
                }
                else
                {
                    echo $lang[95];
                }
            }
            else
            {
                echo $lang[7]." <a href='$cfg->ROOT_URL/index.php'>".$lang[8]."</a> ".$lang[9];
            }
        ?>
    </body>
</html>