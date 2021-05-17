<?php
	$color = array("abierto" => "green","en proceso" => "yellow","cerrado" => "red");

	$misNotasFile = file_get_contents("misnotas.json");
	$misNotas = json_decode($misNotasFile,true);

	if (isset($_GET["nota"])) {
		$i = $_GET["nota"];
		if ($i < 0)
			$i = count($misNotas)+1;
		$misNotas[$i]["titulo"] = $_GET["titulo"];
		$misNotas[$i]["descripcion"] = $_GET["descripcion"];
		$misNotas[$i]["estado"] = $_GET["estado"];
		$misNotasEncoded = json_encode($misNotas);
		file_put_contents('misNotas.json', $misNotasEncoded);
	}

	$misNotasFile = file_get_contents("misnotas.json");
	$misNotas = json_decode($misNotasFile,true);
?>
<html lang="es"> 
	<head>
		<title>Mis Notas - Nicolás Poblete</title>
		<script src="js/bootstrap.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery-3.6.0.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<style type="text/css">
		body {
			width: 85%;
			margin: 10em 12em;
		}
	</style>
	<body>
		<h1>Mis Notas</h1>
		<form method="get" action="index.php">
		<table class="border=0">
		<?php
			$columna = 1;

			foreach ($misNotas as $i => $datos) {
				$estado = $datos["estado"];
				$titulo = $datos["titulo"];
				$descripcion = $datos["descripcion"];
				if ($columna==1) {
		?>
			<tr><td colspan="3">&nbsp;&nbsp;</td></tr>
			<tr>
		<?php
				}
		?>
				<td style="background-color:<?= $color[$estado] ?>">
					<input type="radio" name="nota" id="nota" value="<?= $i ?>" onclick="document.getElementById('actualizar').style.visibility='visible';document.getElementById('eliminar').style.visibility='visible';"/>
					<b><?= $titulo ?></b>
					<br/>
					<?= $descripcion ?>
				</td>
		<?php
				if (++$columna==4) {
		?>
			</tr>
		<?php
					$columna = 1;
				} else {
		?>
			<td>&nbsp;&nbsp;</td>
		<?php
				}
			}
		?>
	</table>
	<br/><br/>
	<input type="submit" name="adicionar" value="Adicionar"/>
	<input type="submit" name="actualizar" id="actualizar" value="Actualizar"style="visibility:hidden" />
	<input type="submit" name="eliminar" id="eliminar" value="Eliminar" style="visibility:hidden" />
</form>	
</div>
</body></html>