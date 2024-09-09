<?php 
include_once "configuracion.php";
//include_once "../../views/modify/Modifing.php";
	$conexion = new mysqli($server, $user, $password, $database);
	if ($conexion->connect_errno) {
	    echo "Nuestro sitio experimenta fallos....";
	    exit();
	}
	$sql = "SELECT * FROM estudiantes WHERE Id_Estudiante=?";

	$sentence = $conexion->prepare($sql);
 		if (!$sentence) {
	 		printf("Problemas en la Sentencia Preparada.\n". $conexion->error . "\n");
	 	}
		 /* Sentencia preparada, etapa 2: vincular parametros y ejecutar */
	 	$ID = $_REQUEST['documento']; $sentence->bind_param("i", $ID);
	 	if (!$sentence){ 
	 		printf("Problemas en la Vinculación de Parámetros.\n". $conexion->error . "\n"); 
		 } 
	 	$sentence->execute(); 
	 	if (!$sentence) { 
	 		printf("Problemas en la Ejecución.\n". $conexion->error . "\n"); 
	 	}
	 /* Sentencia preparada, etapa 3: Obtener Resultado */
		 $registros=$sentence->get_result();
	 	if (!$registros) { 
	 		printf("Problemas en el Select.\n". $conexion->error . "\n");
	 	}
 ?>