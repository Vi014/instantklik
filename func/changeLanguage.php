<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    $selectedLang = $_REQUEST['langName'];
    $_SESSION['selectedLang'] = $selectedLang;
    setcookie("selectedLang", $selectedLang, time()+60*60*24*30*6, "/");
?>