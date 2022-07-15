<?php
	$izvodjac  = $_GET['a'];
	//echo "<option value='0'>----</option>";
	include_once('povezivanje.php');
	
	$Upit      = "SELECT * FROM albumi WHERE izvodjac = '$izvodjac'";
	$Rezultat  = mysqli_query($Veza, $Upit);
	
	while($Red = mysqli_fetch_assoc($Rezultat))
	{
		$album_id    = $Red['id'];
		$album_naziv = $Red['naziv'];
		
		echo "<option value='".$album_id."'>".$album_naziv."</option>";
 	}
?>