<?php
    if(!isset($cfg))
    {
        $cfg = include_once "../cfg/config.php";
    }

    // starting the session
	if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    // language
    $_SESSION['lang'] = array();

    $langList = scandir($cfg->ROOT_PATH."/func/lang"); 

    for ($i = 2; $i < count($langList); $i++) 
    {
        include_once $cfg->ROOT_PATH."/func/lang/".$langList[$i];
    }
    
    if(!isset($_SESSION['selectedLang']))
    {
        if(isset($_COOKIE['selectedLang']))
        {
            $_SESSION['selectedLang'] = $_COOKIE['selectedLang'];
        }
        else
        {
            $_SESSION['selectedLang'] = "English";
        }
    }

    $lang = $_SESSION['lang'][$_SESSION['selectedLang']];

    // connecting to the database
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = new mysqli($cfg->serverName, $cfg->uidServer, $cfg->pwdServer, $cfg->databaseName);
    $connection->set_charset('utf8mb4');
   
    if($connection)
    {
        if(!isset($_SESSION['password']) && isset($_COOKIE['password']))
        {
            $cookieUsername = $_COOKIE['username'];
            $cookiePassword = $_COOKIE['password'];

            $query = "SELECT * 
                      FROM Korisnik 
                      WHERE Korisnik.Username = ? AND Korisnik.Password = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('ss', $cookieUsername, $cookiePassword);
            $stmt->execute();
            $result = $stmt->get_result();
            $rowCount = $result->num_rows;

            if($rowCount > 0)
            {
                $_SESSION['username'] = $_COOKIE['username'];
                $_SESSION['password'] = $_COOKIE['password'];
            }
            else 
            {
                setcookie('username', 'asdf', 1, "/");
                setcookie('password', 'asdf', 1, "/");
            }
        }
    }
    else
    {
        echo $lang[19]." <br>";
        exit();
    }

    $aValid = array('-', '_', 'ć', 'Ć', 'č', 'Č', 'š', 'Š', 'đ', 'Đ', 'ž', 'Ž', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ä', 'Ä', 'ë', 'Ë', 'ï', 'Ï', 'ö', 'Ö', 'ü', 'Ü', 'ñ', 'Ñ');
?>