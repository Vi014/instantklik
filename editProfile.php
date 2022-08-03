<?php
	session_start();
	// session_unset();
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

            echo "<form action='executeProfileUpdate.php' method='post'>";

            $username = $_SESSION['username'];
            $_SESSION['Nalozi'] = array();


            $Query = "SELECT Nalog.NalogID, TipNaloga.ImeTipa, Nalog.Link 
                FROM Korisnik INNER JOIN Nalog ON Korisnik.KorisnikID = Nalog.KorisnikID 
                              INNER JOIN TipNaloga ON nalog.TipID = TipNaloga.TipID 
                WHERE korisnik.username = '$username'";
	        $Result   = mysqli_query($Connection, $Query);

            while($Row = mysqli_fetch_assoc($Result))
            {
                $NalogID = $Row['NalogID'];
                $ImeTipa = $Row['ImeTipa'];
                $Link 	 = $Row['Link'];

                array_push($_SESSION['Nalozi'], $NalogID);
                
                echo $ImeTipa;
                echo "<input type='text' name='$NalogID' required='true' value='$Link'>";
                echo "<input type='button' data-id='$NalogID' class='deleteButton' value='Obriši'>";
                echo "<br>";
            }

            echo "<input type='submit' value='Unos podataka'>";
            echo "</form>";
        ?>
        <!-- <input type='button' data-id='1' class='deleteButton' value='Obriši' onclick='amogus()'> -->

        <script language="javascript">
            $('.deleteButton').click(
                                        function (event) 
                                        {
                                            event.preventDefault();
                                            var id = $(this).data('id');
                                            // alert(id);
                                            $.ajax( // sve pre ovog radi kako valja // ??? sta ovde fali???
                                                    {
                                                        url: "removeLink.php",
                                                        method: "POST",
                                                        dataType: "text",
                                                        data: { 'id': id },
                                                        success: function (html) 
                                                        {
                                                            //$(this).parent().parent().remove();
                                                            // $(this).text(html);
                                                            alert(id);
                                                        },
                                                        error: function(xhr, status, error)
                                                        {
                                                            console.log(xhr);
                                                            console.log(status);
                                                            console.log(error);
                                                        }
                                                    }
                                                );
                                        }
                                    );
            /* function amogus(event)
            {
                event.preventDefault();
                var id = $(this).data('id');
                alert(id);
            } */
        </script>
    </body>
</html>