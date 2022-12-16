<?php
    if(!isset($cfg))
	{
		$cfg = include_once "../cfg/config.php";
	}

	include_once $cfg->ROOT_PATH."/func/startup.php";

    unset($_SESSION['username']);
    unset($_SESSION['password']);

    setcookie('username', 'asdf', 1);
    setcookie('password', 'asdf', 1);

    header("location: $cfg->ROOT_URL/index.php");
?>