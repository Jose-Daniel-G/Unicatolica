<?php
include_once "../../config/configuracion.php";

$mensaje = "";

session_start();

if (isset($_POST['ingresar'])) {
	if (empty($_POST['doc']) || empty($_POST['facultad']) || empty($_POST['nombre']) || empty($_POST['cedula'])) {
		$mensaje = "Error: Usuario y Contraseña inválidos.";
	} else {
        
		$mysqli = new mysqli($server, $user, $password, $database);

		if ($mysqli->connect_errno) {
			die("Error al conectarse con MySQL: " . $mysqli->connect_error);
		}

		$id = $mysqli->real_escape_string($_POST['doc']);
		$facultad = $mysqli->real_escape_string($_POST['facultad']);
		$nombre = $mysqli->real_escape_string($_POST['nombre']);
		$cedula = $mysqli->real_escape_string($_POST['cedula']);
		echo "$id"."$facultad"."$nombre"."$cedula";
			
		$sql = "INSERT INTO estudiantes values ( '$id', '$facultad', '$nombre', '*', '*', '$cedula', '*', 'A' )";
		

	//$sql = "INSERT INTO estudiantes (primaria, Id_Estudiante, Facultad, Nombres, Apellido1, Apellido2, Cedula, Email, Estado_Estudiante) values ( null, '$id', '$facultad', '$nombre', '*', '*', '$cedula', '*', 'A')";


			if($mysqli->query($sql) === TRUE) {
			   header("location: ../../views/operaciones/texto.php");
				
				exit();
			} else {
				$mensaje = "Error: $mysqli->error";
			}
			$mysqli->close();
		
		
	}
}

?>
         