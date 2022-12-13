<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    $serverName   = "localhost";
    $uidServer    = "root";
    $pwdServer    = "";
    $databaseName = "instantklik";
   
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = new mysqli($serverName, $uidServer, $pwdServer, $databaseName);
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
                setcookie('username', 'asdf', 1);
                setcookie('password', 'asdf', 1);
            }
        }
    }
    else
    {
        echo "Doslo je do greske pri povezivanju sa bazom! <br>";
        exit();
    }
?>
