<?php
@session_start();
include_once "../../config/configuracion.php";
include_once "../../config/core.php";
$obj = new core();

if (!empty($_POST['funcion'])) {
    $respuesta = [];

    switch ($_POST['funcion']) {

        //======================================================
        // Caso: Sorteo Semana
        //======================================================
        case "sorteoSemana":
            $sql = "SELECT COUNT(*) AS total FROM asistencia";
            $result = $obj->execute($sql);
            $row = $result->fetch_assoc();
            $respuesta["max"] = $row["total"];

            echo json_encode($respuesta);
            break;

        //======================================================
        // Caso: Ganador
        //======================================================
        case "ganador":
            $No_Reg_A = intval($_POST["No_Reg_A"] ?? 0);

            $sql = "SELECT a.No_Reg_A, a.Id_Estudiante, 
                           CONCAT(b.Nombres, ' ', b.Apellido1, ' ', b.Apellido2) AS Nombre_Completo
                    FROM asistencia a
                    INNER JOIN estudiantes b ON a.Id_Estudiante = b.Id_Estudiante
                    WHERE a.No_Reg_A = ? AND b.Estado_Estudiante = 'A'
                    ORDER BY a.No_Reg_A ASC
                    LIMIT 1";

            $conn = $obj->getConexion();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $No_Reg_A);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result()->fetch_assoc();

                if ($resultado) {
                    $respuesta["ganador"] = trim(str_replace("*", "", $resultado["Nombre_Completo"]));
                } else {
                    $respuesta["ganador"] = null;
                }
            } else {
                $respuesta["error"] = "Error al ejecutar: " . $stmt->error;
            }

            $stmt->close();

            echo json_encode($respuesta);
            break;
    }
}
