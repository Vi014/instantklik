<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    $ServerName   = "localhost";
    $UIDServer    = "root";
    $PWDServer    = "";
    $DatabaseName = "instantklik";
   
    $Connection = mysqli_connect($ServerName, $UIDServer, $PWDServer, $DatabaseName);
   
    if($Connection)
    {
        if(!isset($_SESSION['password']) && isset($_COOKIE['password']))
        {
            $cookieUsername = $_COOKIE['username'];
            $cookiePassword = $_COOKIE['password'];

            $Query = "SELECT *
                FROM Korisnik 
                WHERE Korisnik.Username = '$cookieUsername' AND Korisnik.Password = '$cookiePassword'";
            $Result = mysqli_query($Connection, $Query);
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
