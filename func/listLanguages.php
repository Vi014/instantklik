<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    for ($i = 2; $i < count($langList); $i++) 
    {
        $langName = substr($langList[$i], 0, -4);

        echo "<div onclick=\"changeLanguage('$langName', '$cfg->ROOT_PATH', '$cfg->ROOT_URL', '".$_SESSION['lang'][$langName][17]."')\">";
        echo "  <img style='height: 1em; width: auto;' src='$cfg->ROOT_URL/images/flags/$langName.svg'>";
        echo $langName;
        echo "</div>";
    }

    echo "<br>";
?>