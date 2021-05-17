<?php
$i=-1;
$titulo="";
$estado="abierto";
$descripcion="";
if (!isset($_GET["adicionar"]) && isset($_GET["nota"])) {
	$misNotasFile = file_get_contents("misnotas.json");
	$misNotas = json_decode($misNotasFile,true);
	$i=$_GET["nota"];
	if (isset($_GET["eliminar"])) {
		unset($misNotas[$i]);
		$misNotasEncoded = json_encode($misNotas);
		file_put_contents('misNotas.json', $misNotasEncoded);
		header("Location: misnotas.php");
	}
	$titulo=$misNotas[$i]["titulo"];
	$estado=$misNotas[$i]["estado"];
	$descripcion=$misNotas[$i]["descripcion"];
	if (isset($_GET["actualizar"]) && $estado == "cerrado") {
		header("Location: misnotas.php");
	}
}
?>
<html lang="en">
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
			width: 35%;
			margin: 10em 12em;
		}
	</style>
	<body>
		<h1>Mis Notas</h1>
		<form method="get" action="misnotas.php">
			<input type="hidden" name="nota" id="nota" value="<?= $i ?>"/>
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" value="<?= $titulo ?>">
			</div>
			<div class="form-group">
				<label for="estado" class="form-label">Estado</label>
				<br/>
				<select name="estado" id="estado" class="form-control form-select-sm" aria-label=".form-select-sm example">
					<option <?= $estado=="abierto" ? "selected":"" ?>>abierto</option>
					<option <?= $estado=="en proceso" ? "selected":"" ?>>en proceso</option>
					<option <?= $estado=="cerrado" ? "selected":"" ?>>cerrado</option>
				</select>
			</div>
			<div class="form-group">
				<label for="descripcion" class="form-label">Descripción</label>
				<textarea class="form-control" maxlength="150" name="descripcion" id="descripcion" rows="3" placeholder="Descripción"><?= $descripcion ?></textarea>
			</div>
			<button type="submit" class="btn btn-default">Actualizar</button>
		</form>
	</body>
</html>