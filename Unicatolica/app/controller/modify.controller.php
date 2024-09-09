<?php 
include_once "../../config/configuracion.php";
	$conexion = new mysqli($server, $user, $password, $database);
	if ($conexion->connect_errno) {
	    echo "Nuestro sitio experimenta fallos....";
	    exit();
	}

                if (!empty($_POST['id']) && !empty($_POST['cedula'])) {

                    $id = $_POST['id'];
                    $cedula = $_POST['cedula'];
                    $estado = "'A'";

					$sql = "UPDATE estudiantes SET Id_Estudiante=?, Facultad=?, Nombres=?, Cedula=?, Estado_Estudiante=? WHERE";
					$sql .= " Id_Estudiante=? ";
					/* Sentencia Preparada, etapa 1: preparación */
 					$sentence = $conexion->prepare($sql); 
 					if (!$sentence) {
	 					printf("Problemas en la Sentencia Preparada.\n". $conexion->error . "\n");
					}
					$sentence->bind_param("issssi",$_POST['id'],$_POST['facultad'],$_POST['nombres'],$_POST['cedula'],$_POST['estado'],$_POST['documentoAnt']);

					if (!$sentence) { 
						printf("Problemas en la Vinculación de Parámetros.\n". $conexion->error . "\n");
					} 
					$sentence->execute(); 
					if (!$sentence) { printf("Problemas en el Update.\n". $conexion->error . "\n"); 
					} else echo "!!El Empleado fue modificado OK!!<br>";
	 			}
       
