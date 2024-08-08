<?php 

include ("conexion.php");
//crear Mascota controlador 
if (isset($_POST['crear'])) {
	// session_start();
	$nombre = $_POST['nombre'];
	$tipo = $_POST['tipo'];
	$raza = $_POST['raza'];
	$genero = $_POST['genero'];
	$idDueño = $_POST['idDueño'];
	$edad = $_POST['edad'];
	$Esterilisada = $_POST['Esterilisada'];
	$nombreDue = $_POST['nombreDue'];
	$telefono = $_POST['telefono'];
	$direccion = $_POST['direccion'];



	if(empty($_POST['nombre']) || empty($_POST['tipo']) || empty($_POST['raza']) || empty($_POST['genero']) || empty($_POST['idDueño']) || empty($_POST['edad']) || empty($_POST['Esterilisada']) || empty($_POST['nombreDue']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
		$mensaje = "Error: Alguno de los campos esta basio.";
	}else{
	
		$OperacioneSQL = new OperacioneSQL ();
		$mensaje = $OperacioneSQL->agregarMascota($nombre,$tipo,$raza,$genero,$idDueño,$edad,$Esterilisada,$nombreDue,$telefono,$direccion);
		
	}
}
//crear Cita controlador 
if (isset($_POST['crearCita'])) {
	// session_start();
	$idMascota = $_POST['idMascota'];
	$procedimiento = $_POST['procedimiento'];
	$duracion = $_POST['duracion'];
	$fecha = $_POST['fecha'];
	$comentarios = $_POST['comentarios'];



	if(empty($_POST['idMascota']) || empty($_POST['procedimiento']) || empty($_POST['duracion']) || empty($_POST['fecha']) || empty($_POST['comentarios'])) {
		$mensaje = "Error: Alguno de los campos esta basio.";
	}else{
		
		$OperacioneSQL = new OperacioneSQL ();
		$mensaje = $OperacioneSQL->agregarCitas($idMascota,$procedimiento,$duracion,$fecha,$comentarios);
		
	}
}

?>