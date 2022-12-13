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

        <script src="js/deleteLinkedProfile.js"></script>
    </head>

    <body>
        <?php
            include_once('connection.php');

            if(isset($_SESSION['username']))
            {
                echo "<form action='executeProfileUpdate.php' method='post'>";
    
                $username = $_SESSION['username'];
                $_SESSION['Nalozi'] = array();
    
                $query = "SELECT Nalog.NalogID, TipNaloga.ImeTipa, Nalog.Link 
                          FROM Korisnik INNER JOIN Nalog ON Korisnik.KorisnikID = Nalog.KorisnikID 
                                        INNER JOIN TipNaloga ON nalog.TipID = TipNaloga.TipID 
                          WHERE Korisnik.Username = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $result = $stmt->get_result();
    
                while($row = mysqli_fetch_assoc($result))
                {
                    $nalogID = $row['NalogID'];
                    $imeTipa = $row['ImeTipa'];
                    $link 	 = $row['Link'];
    
                    array_push($_SESSION['Nalozi'], $nalogID);
                    
                    echo $imeTipa;
                    echo "<input type='text' name='$nalogID' value='$link'>";
                    echo "<input type='button' onclick='deleteLinkedProfile($nalogID)' value='Obriši'>";
                    echo "<br>";
                }
    
                echo "<input type='submit' value='Unos podataka'>";
                echo "</form>";
    
    
    
                echo "<form action='addNewProfile.php' method='post'>";
    
                $query = "SELECT TipNaloga.TipID, TipNaloga.ImeTipa 
                          FROM TipNaloga";
                $stmt = $connection->prepare($query);
                // $stmt->bind_param('s', $username);
                $stmt->execute();
                $result = $stmt->get_result();
    
                echo "<select name='TipID'>";
    
                while($row = mysqli_fetch_assoc($result))
                {
                    $tipID   = $row['TipID'];
                    $imeTipa = $row['ImeTipa'];
    
                    echo "<option value='$tipID'>$imeTipa</option>";
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