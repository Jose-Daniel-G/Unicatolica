<?php
include_once "configuracion.php";

// Sentencia preparada
$sql = "SELECT * FROM estudiantes WHERE Id_Estudiante = ?";
$sentence = $conexion->prepare($sql);

if (!$sentence) {
    die("Problemas en la Sentencia Preparada: " . $conexion->error);
}

// Obtener parámetro del request (documento)
$ID = $_REQUEST['documento'] ?? null;

// Validar que venga el dato
if (!$ID) {
    die("No se recibió el parámetro 'documento'.");
}

// Vincular parámetro (i = integer)
if (!$sentence->bind_param("i", $ID)) {
    die("Problemas en la Vinculación de Parámetros: " . $sentence->error);
}

// Ejecutar consulta
if (!$sentence->execute()) {
    die("Problemas en la Ejecución: " . $sentence->error);
}

// Obtener resultados
$resultado = $sentence->get_result();

if (!$resultado) {
    die("Problemas en el Select: " . $sentence->error);
}

// Recorrer registros (ejemplo)
while ($fila = $resultado->fetch_assoc()) {
    echo "ID: " . $fila['Id_Estudiante'] . " - Nombre: " . $fila['Nombres'] . "<br>";
}

// Liberar y cerrar
$sentence->close();
$conexion->close();
