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
        // we're checking if the account name and password stored in the session and/or cookie are valid (by seeing if querying the database for them returns a row)
        // because if the username in the cookie somehow happens to refer to an invalid account [e.g. account name changed from another device, or the account getting deleted] the site will break
        // also, we log the user out if they've changed their password from a different device
        // finally, we check if the user has gotten banned

        if(!isset($_SESSION['password']) && isset($_COOKIE['password'])) // the first check is if there is nothing in the session but there is something in the cookie, and if the account exists the data will be transfered to the session
        {
            $cookieUsername = $_COOKIE['username'];
            $cookiePassword = $_COOKIE['password'];

            $query = "SELECT * 
                      FROM user 
                      WHERE user.username = ? AND user.password = ?";
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
        
        if(isset($_SESSION['username'])) // next we check the session, first for account existence (necessary for the edge case of the user changing their username while they have a different browser where they're logged in open), and after that to see if the account is banned
        {
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];

            $query = "SELECT user.banned 
                      FROM user 
                      WHERE user.username = ? AND user.password = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('ss', $username, $password); // using bind_param and ?s instead of just inserting strings sanitizes input/prevents sql injection
            $stmt->execute();
            $result = $stmt->get_result();
            $rowCount = $result->num_rows;

            if($rowCount > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $banned = $row['banned'];
                }

                if($banned)
                {
                    unset($_SESSION['username']);
                    unset($_SESSION['password']);

                    setcookie('username', 'asdf', 1, "/");
                    setcookie('password', 'asdf', 1, "/");
                }
                // finally, if the user isn't banned, we let the session and cookie stay as is
            }
            else 
            {
                unset($_SESSION['username']);
                unset($_SESSION['password']);

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