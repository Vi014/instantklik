<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    $ServerName   = "localhost";
    $UIDServer    = "root";
    $PWDServer    = "";
    $DatabaseName = "instantklik";
   
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $Connection = new mysqli($ServerName, $UIDServer, $PWDServer, $DatabaseName);
    $Connection->set_charset('utf8mb4');
   
    if($Connection)
    {
        if(!isset($_SESSION['password']) && isset($_COOKIE['password']))
        {
            $cookieUsername = $_COOKIE['username'];
            $cookiePassword = $_COOKIE['password'];

            $Query = "SELECT * 
                      FROM Korisnik 
                      WHERE Korisnik.Username = ? AND Korisnik.Password = ?";
            $stmt = $Connection->prepare($Query);
            $stmt->bind_param('ss', $cookieUsername, $cookiePassword);
            $stmt->execute();
            $Result = $stmt->get_result();
            $RowCount = mysqli_num_rows($Result);

            if($RowCount > 0)
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
