<?php
	if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Instantklik</title>

		<link rel="icon" href="images/IK-smalltransparent.png"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write('<script src="js\/jquery.min.js"><\/script>')</script>
    </head>

    <body>
        <?php
            include_once('connection.php');

            if(isset($_SESSION['username']))
            {
                echo "<form action='executeProfileUpdate.php' method='post'>";

                echo "Da bi ste obrisali neki link sa Vašeg profila, ostavite njegovo polje za unos teksta praznim pri kliku na dugme Unos podataka <br>";
    
                $username = $_SESSION['username'];
                $_SESSION['Nalozi'] = array();
    
    
                $Query = "SELECT Nalog.NalogID, TipNaloga.ImeTipa, Nalog.Link 
                    FROM Korisnik INNER JOIN Nalog ON Korisnik.KorisnikID = Nalog.KorisnikID 
                                  INNER JOIN TipNaloga ON nalog.TipID = TipNaloga.TipID 
                    WHERE korisnik.username = '$username'";
                $Result = mysqli_query($Connection, $Query);
    
                while($Row = mysqli_fetch_assoc($Result))
                {
                    $NalogID = $Row['NalogID'];
                    $ImeTipa = $Row['ImeTipa'];
                    $Link 	 = $Row['Link'];
    
                    array_push($_SESSION['Nalozi'], $NalogID);
                    
                    echo $ImeTipa;
                    echo "<input type='text' name='$NalogID' value='$Link'>";
                    echo "<br>";
                }
    
                echo "<input type='submit' value='Unos podataka'>";
                echo "</form>";
    
    
    
                echo "<form action='addNewProfile.php' method='post'>";
    
                $Query = "SELECT TipNaloga.TipID, TipNaloga.ImeTipa 
                    FROM TipNaloga";
                $Result = mysqli_query($Connection, $Query);
    
                echo "<select name='TipID'>";
    
                while($Row = mysqli_fetch_assoc($Result))
                {
                    $TipID   = $Row['TipID'];
                    $ImeTipa = $Row['ImeTipa'];
    
                    echo "<option value='$TipID'>$ImeTipa</option>";
                }
    
                echo "<input type='text' name='link' required='true'>";
                echo "<input type='submit' value='Dodaj novi link'>";
                echo "</form>";



                echo "<a href='logout.php'>Izlogujte se</a>";
                echo "<br>";
                echo "<a href='deleteAccount.php'>Obriši nalog</a>";
            }
            else
            {
                echo "Niste ulogovani! Vratite se na <a href='index.php'>glavnu stranicu</a> da bi ste se ulogovali.";
            }
        ?>
    </body>
</html>