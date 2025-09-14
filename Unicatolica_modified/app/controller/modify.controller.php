<?php
include_once "../../config/configuracion.php";

if (!empty($_POST['id']) && !empty($_POST['cedula'])) {

    $id = $_POST['id'];
    $facultad = $_POST['facultad'] ?? '';
    $nombres = $_POST['nombres'] ?? '';
    $cedula = $_POST['cedula'];
    $estado = $_POST['estado'] ?? 'A';
    $documentoAnt = $_POST['documentoAnt'] ?? $id; // valor por defecto

    $sql = "UPDATE estudiantes 
            SET Id_Estudiante=?, Facultad=?, Nombres=?, Cedula=?, Estado_Estudiante=? 
            WHERE Id_Estudiante=?";

    $sentence = $mysqli->prepare($sql);
    if (!$sentence) {
        die("Error en la preparación de la sentencia: " . $mysqli->error);
    }

    // Ajusta tipos: i=int, s=string
    // Supongo que Id_Estudiante y documentoAnt son enteros, resto strings
    $sentence->bind_param("issssi", $id, $facultad, $nombres, $cedula, $estado, $documentoAnt);

    if (!$sentence->execute()) {
        die("Error en la ejecución del update: " . $sentence->error);
    } else {
        echo "¡El estudiante fue modificado correctamente!";
    }

    $sentence->close();
}

$mysqli->close();
