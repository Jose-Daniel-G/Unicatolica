<?php
include_once "../../config/configuracion.php";

$mensaje = "";
session_start();

if (isset($_POST['ingresar'])) {
    if (empty($_POST['doc']) || empty($_POST['facultad']) || empty($_POST['nombre']) || empty($_POST['cedula'])) {
        $mensaje = "Error: Usuario y Contraseña inválidos.";
    } else {

        $id = $_POST['doc'];
        $facultad = $_POST['facultad'];
        $nombre = $_POST['nombre'];
        $cedula = $_POST['cedula'];

        // Sentencia preparada
        $sql = "INSERT INTO estudiantes (Id_Estudiante, Facultad, Nombres, Apellido1, Apellido2, Cedula, Email, Estado_Estudiante) 
                VALUES (?, ?, ?, '*', '*', ?, '*', 'A')";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("Error en la preparación de la sentencia: " . $mysqli->error);
        }

        $stmt->bind_param("isss", $id, $facultad, $nombre, $cedula);

        if ($stmt->execute()) {
            header("location: ../../views/operaciones/texto.php");
            exit();
        } else {
            $mensaje = "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>
