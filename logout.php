<?php
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    unset($_SESSION['username']);
    unset($_SESSION['password']);

    setcookie('username', 'asdf', 1);
    setcookie('password', 'asdf', 1);

    header("location: index.php");
?>