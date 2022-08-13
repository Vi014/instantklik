<?php
	if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Instantklik</title>

		<link rel="icon" href="images/IK-smalltransparent.png"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write('<script src="js\/jquery.min.js"><\/script>')</script>
	</head>

	<body>
		<div id="links"></div>

		<script src="js/script.js"></script>

		<?php
			include_once('connection.php');

			if(isset($_SESSION['username']))
			{
				echo "<a href='editProfile.php'>Moj profil</a>";
			}
			else
			{
				echo "<a href='login.php'>Login</a>";
				echo "<br>";
				echo "<a href='register.php'>Registracija</a>";
			}

			if(isset($_GET['profile']))
			{
				$_SESSION['profile'] = $_GET['profile'];
				include_once('query.php');
			}
		?>
	</body>
</html>
