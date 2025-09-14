<?php
include_once "../../config/configuracion.php";


function mostrarTabla($estudiante) {
    echo "
    <table width='100%' border='1'>
        <tr>
            <th><center>ID</center></th>
            <th><center>Facultad</center></th>
            <th><center>Nombres</center></th>
            <th><center>Cédula</center></th>
            <th><center>Estado</center></th>
        </tr>
        <tr>
            <td>{$estudiante['Id_Estudiante']}</td>
            <td>{$estudiante['Facultad']}</td>
            <td>{$estudiante['Nombres']}</td>
            <td>{$estudiante['Cedula']}</td>
            <td>{$estudiante['Estado_Estudiante']}</td>
        </tr>
    </table>
    ";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doc = trim($_POST['doc'] ?? '');

    if ($doc === '') {
        echo "Digita un documento por favor. (Ej: 123)";
    } else {
        // ✅ Usamos sentencia preparada para evitar SQL Injection
        $stmt = $mysqli->prepare("SELECT * FROM estudiantes WHERE Id_Estudiante = ?");
        $stmt->bind_param("i", $doc);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                mostrarTabla($fila);

                if (isset($_POST['btn3'])) {
                    // ✅ Borrado seguro con prepare
                    $del = $mysqli->prepare("DELETE FROM estudiantes WHERE Id_Estudiante = ?");
                    $del->bind_param("i", $doc);
                    if ($del->execute()) {
                        echo "<br><strong>REGISTRO ELIMINADO !OK!</strong><br>";
                    } else {
                        echo "Error al eliminar: " . $mysqli->error;
                    }
                    $del->close();
                }
            }
        } else {
            echo "No se encontró ningún estudiante con el ID $doc.";
        }
        $stmt->close();
    }
}

$mysqli->close();
?>
