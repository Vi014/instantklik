<?php
    $ServerName   = "localhost";
    $UIDServer    = "root";
    $PWDServer    = "";
    $DatabaseName = "instantklik";
   
    $Connection = mysqli_connect($ServerName, $UIDServer, $PWDServer, $DatabaseName);
   
    if($Connection)
    {
        /*echo "Uspesno ste se povezali sa bazom.<br><br>";
        echo "Sledi prijava korisnika...";*/
    }
    else
    {
        echo "Doslo je do greske pri povezivanju sa bazom!<br>";
        echo "Kontaktirajte administratora servera.";
        exit();
    }
?>
