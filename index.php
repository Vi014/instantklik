<?php
	session_start();
	// session_unset();
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
	</head>

	<body>
		<a href="login.php">Login</a>
		<br>
		<a href="register.php">Registracija</a>

		<div id="links"></div>

		<script src="js/script.js"></script>

		<?php
			if(isset($_GET['profile']))
			{
				$_SESSION['profile'] = $_GET['profile'];
				include_once('query.php');
			}
		?>
	</body>
</html>
