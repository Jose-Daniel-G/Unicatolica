<?php
session_start();
include_once "../../config/configuracion.php";
include_once "../../config/core.php";
include_once "../../vendor/phpqrcode/qrlib.php";

// $obj = new core($server, $user, $password, $database);
$obj = new core();

// ==================== FUNCIONES AUXILIARES ==================== //

/**
 * Obtener el ID del estudiante desde la sesión.
 */
function getIdEstudiante()
{
    return !empty($_SESSION['Id_Estudiante']) ? $_SESSION['Id_Estudiante'] : 0;
}

/**
 * Obtener la fecha y hora actual en Bogotá.
 */
function getFechaHoraActual()
{
    date_default_timezone_set("America/Bogota");
    return [date("Y-m-d"), date('G:i:s')];
}

/**
 * Generar un código QR y devolverlo como base64.
 */
function generarQR($code, $tempDir = "../../public/temp/")
{
    if (!file_exists($tempDir)) mkdir($tempDir, 0700);
    $filename = uniqid() . ".png";
    $filePath = $tempDir . $filename;
    QRcode::png($code, $filePath, 'L', 10, 3);
    $data = base64_encode(file_get_contents($filePath));
    return 'data:' . mime_content_type($filePath) . ';base64,' . $data;
}

/**
 * Escapar strings para SQL seguro.
 */
function esc($str)
{
    return "'" . addslashes($str) . "'";
}

// ==================== FIN FUNCIONES ==================== //

// header('Content-Type: application/json');f

if (!empty($_POST) && !empty($_POST['funcion'])) {

    $funcion = $_POST['funcion'];
    $idEstudiante = getIdEstudiante();
    $estadoActivo = "'A'";

    switch ($funcion) {

        // ==================== SELECT ACTIVIDADES ==================== //
        case "selectActividades":
            $query = $obj->execute("SELECT Id_Conferencia, Titulo FROM conferencias WHERE Estado_Conferencia = $estadoActivo");
            $select = "<option value=''>Seleccione ...</option>";
            while ($row = mysqli_fetch_row($query)) {
                $select .= "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
            }
            echo json_encode(['html' => $select]);
            break;

        // ==================== SELECT ESTUDIANTES ==================== //
        case "selectEstudiantes":
            $query = $obj->execute("
                SELECT Id_Estudiante, CONCAT(Nombres,' ',Apellido1,' ',Apellido2) AS Nombre_Completo 
                FROM estudiantes 
                WHERE NOT EXISTS (
                    SELECT Id_Estudiante 
                    FROM registromaratonprogramacion 
                    WHERE registromaratonprogramacion.Id_Estudiante = estudiantes.Id_Estudiante 
                    AND registromaratonprogramacion.Estado_Registro = $estadoActivo
                ) 
                AND Estado_Estudiante = $estadoActivo
            ");
            $select = "<option value=''>Seleccione ...</option>";
            while ($row = mysqli_fetch_row($query)) {
                $nombre = trim(str_replace("*", "", $row[1]));
                $select .= "<option value='" . $row[0] . "'>$nombre</option>";
            }
            echo $select;

            break;

        // ==================== LLENAR DATOS DE UNA ACTIVIDAD ==================== //
        case "llenarDatos":
            $opcionSelect = $_POST["opcionSelect"] ?? 0;
            if ($opcionSelect != 0) {
                $query = $obj->execute("SELECT * FROM conferencias WHERE Id_Conferencia = $opcionSelect AND Estado_Conferencia = $estadoActivo");
                $conferencia = mysqli_fetch_assoc($query);
                if ($conferencia) {
                    $conferencia["Hora"] = date("g:i A", strtotime($conferencia["Hora"]));
                    echo json_encode($conferencia);
                } else {
                    echo json_encode(['error' => 'Actividad no encontrada']);
                }
            }
            break;

        // ==================== INSCRIBIR ACTIVIDAD ==================== //
        case "inscribirActividad":
            if (!empty($_POST["actividad"])) {
                $limite = count($_POST["actividad"]);
                $respuesta = [];
                $noConferencia = [];
                $tempDir = "../../public/temp/";

                for ($i = 0; $i < $limite; $i++) {
                    if (!empty($_POST["actividad"][$i])) {
                        [$fechaActual, $horaActual] = getFechaHoraActual();
                        $titulo = esc($_POST["actividad"][$i]);

                        $query = $obj->execute("SELECT Id_Conferencia, Numero_Maximo FROM conferencias WHERE Titulo = $titulo AND Estado_Conferencia = $estadoActivo");
                        $conferencia = mysqli_fetch_assoc($query);
                        if (!$conferencia) continue;

                        $idConferencia = $conferencia['Id_Conferencia'];
                        $numeroMaximo = $conferencia['Numero_Maximo'];

                        $query2 = $obj->execute("SELECT * FROM inscripciones WHERE Id_Conferencia = $idConferencia AND Id_Estudiante = $idEstudiante AND Estado_Inscripcion = $estadoActivo");
                        $capacidad = mysqli_fetch_row($obj->execute("SELECT COUNT(Id_Estudiante) FROM inscripciones WHERE Id_Conferencia = $idConferencia"));

                        if ($capacidad[0] >= $numeroMaximo) {
                            $obj->execute("UPDATE conferencias SET Estado_Conferencia = 'I' WHERE Id_Conferencia = $idConferencia");
                        }

                        if (mysqli_num_rows($query2) == 0) {
                            $obj->execute("INSERT INTO inscripciones (No_Reg_I, Id_Estudiante, Id_Conferencia, Fecha_Inscripcion, Hora_Inscripcion, Estado_Inscripcion) 
                                VALUES (NULL, $idEstudiante, $idConferencia, '$fechaActual', '$horaActual', $estadoActivo)");
                            $code = $idEstudiante;
                            $respuesta["tipoRespuesta"] = "success";
                        } else {
                            $noConferencia[] = $i + 1;
                            $respuesta["tipoRespuesta"] = "error";
                            $respuesta["noConferencia"] = $noConferencia;
                        }
                    }
                }

                if (!empty($code)) $respuesta["codigoQR"] = generarQR($code);
                echo json_encode($respuesta);
            }
            break;

        // ==================== INSCRIBIR ESTUDIANTE EN MARATÓN ==================== //
        case "inscribirEstudiante":
            if (!empty($_POST["estudiante"])) {
                $limite = count($_POST["estudiante"]);
                $respuesta = [];
                $noEstudiante = [];
                $idRegistro = esc($_POST["idRegistro"] ?? 0);

                for ($i = 0; $i < $limite; $i++) {
                    if ($limite >= 2) {
                        [$fechaActual, $horaActual] = getFechaHoraActual();
                        $idEstudianteInscrito = esc($_POST["idEstudiante"][$i]);

                        $query = $obj->execute("SELECT Id_Estudiante FROM registromaratonprogramacion WHERE Id_Estudiante = $idEstudianteInscrito AND Estado_Registro = $estadoActivo");
                        if (mysqli_num_rows($query) == 0) {
                            $obj->execute("INSERT INTO registromaratonprogramacion (Id_Registro, Id_Estudiante, Fecha_Inscripcion, Hora_Inscripcion, Id_Estudiante_Realiza_Inscripcion, Estado_Registro)
                                VALUES ($idRegistro, $idEstudianteInscrito, '$fechaActual', '$horaActual', $idEstudiante, $estadoActivo)");
                            $respuesta["tipoRespuesta"] = "success";
                        } else {
                            $noEstudiante[] = $i + 1;
                            $respuesta["tipoRespuesta"] = "error";
                            $respuesta["noEstudiante"] = $noEstudiante;
                        }
                    }
                }
                echo json_encode($respuesta);
            }
            break;

        // ==================== VALIDAR REGISTRO MARATÓN ==================== //
        case "validarRegistroMaraton":
            $query = $obj->execute("SELECT Id_Registro FROM registromaratonprogramacion WHERE Id_Estudiante = $idEstudiante AND Estado_Registro = $estadoActivo");
            $idRegistro = mysqli_fetch_array($query);
            if ($idRegistro) {
                $query2 = $obj->execute("
                    SELECT DISTINCT a.Id_Registro, CONCAT(b.Nombres,' ',b.Apellido1,' ',b.Apellido2) AS Nombre_Completo 
                    FROM registromaratonprogramacion a 
                    JOIN estudiantes b ON a.Id_Estudiante = b.Id_Estudiante 
                    WHERE a.Id_Registro = '" . $idRegistro[0] . "' AND Estado_Registro = $estadoActivo
                ");
                if (mysqli_num_rows($query2) > 0) {
                    $respuesta = [
                        "verEquipo" => '<span style="color: LimeGreen;">Ya estás inscrito</span><button style="color: LimeGreen;" class="href" id="botonVerEquipoMaraton" data-toggle="modal" data-target="#equipoMaraton">(Ver equipo)</button>',
                        "registroMaraton" => true
                    ];
                } else {
                    $respuesta = [
                        "verEquipo" => '<span style="color: Red;">No estás inscrito</span>',
                        "registroMaraton" => false
                    ];
                }
                echo json_encode($respuesta);
            }
            break;

        // ==================== CARGAR QR ==================== //
        case "cargarQR":
            $respuesta = [];
            if ($idEstudiante != 0) {
                $respuesta['codigoQR'] = generarQR($idEstudiante);
                $query = $obj->execute("SELECT COUNT(No_Reg_I) AS Cantidad FROM inscripciones WHERE Id_Estudiante=$idEstudiante AND Estado_Inscripcion = $estadoActivo");
                $row = mysqli_fetch_array($query);
                $respuesta["Cantidad"] = $row["Cantidad"];
            }
            echo json_encode($respuesta);
            break;
        // ==================== TABLA MODAL ACTIVIDADES ==================== //
        case 'tablaModalActividades':

            // Obtener ID del estudiante desde sesión
            $idEstudiante = $_SESSION['Id_Estudiante'] ?? 0;

            // Consulta principal
            $listar = $obj->execute("
                    SELECT a.No_Reg_I, a.Id_Conferencia, b.Titulo, b.Fecha, 
                        DATE_FORMAT(b.Hora,'%h:%i %p') AS Hora, b.Sede, b.Nombre_Expositor
                    FROM inscripciones a
                    INNER JOIN conferencias b ON a.Id_Conferencia = b.Id_Conferencia
                    WHERE a.Id_Estudiante = $idEstudiante AND a.Estado_Inscripcion = 'A'
                    ORDER BY a.Id_Conferencia ASC
                ");

                        // Contar cantidad de inscripciones activas
                        $cantidad = $obj->execute("
                    SELECT COUNT(No_Reg_I) AS Cantidad 
                    FROM inscripciones 
                    WHERE Id_Estudiante = $idEstudiante AND Estado_Inscripcion = 'A'
                ");
            $row2 = mysqli_fetch_assoc($cantidad);

            $datos = [];
            while ($row = mysqli_fetch_assoc($listar)) {
                $datos[] = [
                    "no_reg_i"  => $row["No_Reg_I"],
                    "cantidad"  => $row2["Cantidad"],
                    "nombre"    => $row["Titulo"],
                    "fecha"     => $row["Fecha"],
                    "hora"      => $row["Hora"],
                    "sede"      => $row["Sede"],
                    "expositor" => $row["Nombre_Expositor"],
                    "estado"    => '<i class="fa fa-check"></i>',
                    "eliminar"  => '<button type="button" class="text-white btn fa fa-trash" style="background: #428BCA;"></button>',
                ];
            }

            // Devolver JSON para DataTables
            echo json_encode(["data" => $datos]);

            break;

        // ==================== ELIMINAR INSCRIPCIÓN ==================== //
        case "eliminarInscripcion":
            $No_Reg_I = $_POST["No_Reg_I"] ?? null;
            if ($No_Reg_I) {
                $obj->execute("UPDATE inscripciones SET Estado_Inscripcion = 'I' WHERE No_Reg_I = $No_Reg_I");
                echo json_encode(['status' => 'success']);
            }
            break;

        // ==================== ELIMINAR PARTICIPANTE ==================== //
        case "eliminarParticipante":
            $Id_EstudianteEliminar = $_POST["Id_Estudiante"] ?? null;
            if ($Id_EstudianteEliminar) {
                $obj->execute("UPDATE registromaratonprogramacion SET Estado_Registro = 'I' WHERE Id_Estudiante = $Id_EstudianteEliminar");
                echo json_encode(['status' => 'success']);
            }
            break;

        default:
            echo json_encode(['error' => 'Función no válida']);
            break;
    }
} else {
    echo json_encode(['error' => 'Solicitud no válida']);
}
