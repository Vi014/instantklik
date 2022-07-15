<!Doctype HTML>

<html>
	<head>
		<meta charset="UTF-8"/>
		<title>AJAX - Albumi</title>
		<link rel="icon" href="Slike/layers-128.ico"/>
		<link rel="stylesheet" type="text/css" href="stil.css"/>
	</head>

	<body>
		</div id="okvir">	
			<div id="gornji">
				<div>IZVOĐAČ</div>
				<select id="izvodjaci" onchange="pronadjiAlbume()"></select>
				<div>ALBUM</div>
				<select id="albumi"    onchange="pronadjiPesme()"></select>
			</div>
			
			<div id="donji">
				<div id="albumi_tabela">
				</div>
			</div>
		</div>
	<script src="skripta.js"></script>
	</body>
</html>
