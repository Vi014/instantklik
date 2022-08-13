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
        Da bi ste potvrdili brisanje naloga, unesite svoju šifru još jedanput:
        <form action="deleteQuery.php" method="post">
				<input type="password" name="password" required="true">
				<input type="submit" value="Obriši">
		</form>
    </body>
</html>