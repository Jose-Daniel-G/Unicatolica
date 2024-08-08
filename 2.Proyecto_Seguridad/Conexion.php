<?php 

class OperacioneSQL {

	function agregarMascota ($nombre,$tipo,$raza,$genero,$idDueño,$edad,$esterilisada,$NomDueño,$telefono,$direccion){

		$usuario="Veterinaria";
		$contrasena="maicool*";
		$servidor="localhost";
		$baseDatos="veterinaria";
		$mensaje = "";
		$mysqli = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

		if (mysqli_connect_errno()) {
			echo "Error al conectarse con MySQL ".mysqli_connect_error();
			exit();
		}
		
		$nombre = $mysqli->real_escape_string($nombre);
		$tipo = $mysqli->real_escape_string($tipo);
		$raza = $mysqli->real_escape_string($raza);
		$genero = $mysqli->real_escape_string($genero);
		$idDueño = $mysqli->real_escape_string($idDueño);
		$edad = $mysqli->real_escape_string($edad);
		$esterilisada = $mysqli->real_escape_string($esterilisada);
		$NomDueño = $mysqli->real_escape_string($NomDueño);
		$telefono = $mysqli->real_escape_string($telefono);
		$direccion = $mysqli->real_escape_string($direccion);

		//consulta nombre si esta repetido
		$sql = "SELECT Nombre, 	NumDocumento FROM mascota WHERE  ";
		$sql .= "Nombre = '$nombre'" ;
		$sql .= "AND NumDocumento = '$idDueño'";
		$res = $mysqli->query($sql);
	
		if($res->num_rows == 1 ) {

			//echo "$contrabd";
			$mensaje = "Error:El nombre de la mascota ya existe.";
			return $mensaje;

		} else {

			//insertar Datos
			$sql = "INSERT INTO mascota values ('$nombre','$tipo','$raza','$genero','$idDueño',";
			$sql .= "'$edad','$esterilisada','$NomDueño','$telefono','$direccion')";
		
			//validacion si la insercion fue correcta
			if($mysqli->query($sql) === TRUE) {
				return $mensaje = "Se registraron los datos de forma correcta.";
			} else {
				return $mensaje = "Error: $mysqli->error";
			}
		}	
	}

	function agregarCitas ($idMascota,$procedimiento,$fecha,$horas,$comentarios){

		$usuario="Veterinaria";
		$contrasena="maicool*";
		$servidor="localhost";
		$baseDatos="veterinaria";
		$mensaje = "";
		$mysqli = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

		if (mysqli_connect_errno()) {
			echo "Error al conectarse con MySQL ".mysqli_connect_error();
			exit();
		}

		$idMascota = $mysqli->real_escape_string($idMascota);
		$procedimiento = $mysqli->real_escape_string($procedimiento);
		$fecha = $mysqli->real_escape_string($fecha);
		$horas = $mysqli->real_escape_string($horas);
		$comentarios = $mysqli->real_escape_string($comentarios);
		

		//consulta nombre si esta repetido
		$sql = "SELECT 	NumDocumento FROM mascota WHERE  ";
		$sql .= "NumDocumento = '$idMascota'" ;
		$res = $mysqli->query($sql);
	
		if($res->num_rows == 1 ) {

			//insertar Datos
			$sql = "INSERT INTO cita values ('$idMascota','$procedimiento','$fecha','$horas','$comentarios')";
		
			//validacion si la insercion fue correcta
			if($mysqli->query($sql) === TRUE) {
				return $mensaje = "Se registraron los datos de forma correcta.";
			} else {
				return $mensaje = "Error: $mysqli->error";
			}

		} else {

			//echo "$contrabd";
			$mensaje = "Error:No existe una mascota registrada con ese numero de documento";
			return $mensaje;
		}

	}	

	function mostrarMascota(){

	}

	function mostrarCitas () {
		
	}
}





?>