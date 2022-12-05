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
        <form action="createAccount.php" method="post">
            <input type="text"     name="username" required="true" placeholder="Korisničko ime">
            <input type="password" name="password" required="true" placeholder="Lozinka">
            <input type="submit" value="Kreiraj nalog">
		</form>
    </body>
</html>