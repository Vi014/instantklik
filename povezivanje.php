<?php
    $ImeServera = "localhost";
    $UIDServer  = "root";
    $PWDServer  = "";
    $ImeBaze    = "cd_kolekcija";
   
    $Veza = mysqli_connect($ImeServera, $UIDServer, $PWDServer, $ImeBaze);
   
    if($Veza)
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
