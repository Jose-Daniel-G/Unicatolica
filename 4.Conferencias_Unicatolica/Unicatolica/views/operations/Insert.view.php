<?php
include_once "../../config/env.php";
include_once "../../app/controller/operaciones.controller.php";

@session_start();
@session_destroy();


?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Insertar Estudiantes</title>
</head>
<body>
	<?php if(strlen($mensaje) > 0): ?>
		<h1><?=$mensaje?></h1>
	<?php endif ?>
		<form action="" method="post"  autocomplete="on">
			<table><tr>
				<td><label>ID</label><input type="text" name="id"></td>
			</tr>
			<tr>
				<td><label>Facultad</label><input type="text" name="facultad"></td>
			</tr>
			<tr>
				<td><label>Nombre</label><input type="text" name="nombre"></td>
			</tr>
			<tr>
				<td><label>Cedula</label><input type="text" name="cedula"></td>
			</tr>
		<!--	<tr>
				<td>Estado<input type="text" name="estado"></td>
			</tr>-->
			<tr>
				<td><button type="submit" name="ingresar">ingresar</button></td>
			
			</table>
		</form>
	

</body>
</html>