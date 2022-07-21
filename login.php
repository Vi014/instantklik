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
    </head>

    <body>
        <form action="checkLoginDetails.php" method="post">
				<input type="text"     name="username" required="true" placeholder="Korisničko ime">
				<input type="password" name="password" required="true" placeholder="Lozinka">
				<input type="submit" value="Prijava">
		</form>
    </body>
</html>