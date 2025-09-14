<?php
include_once "../../config/configuracion.php";

try {
    // ✅ Conexión con PDO
    $pdo = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Función para mostrar tabla
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
        // ✅ Consulta segura con PDO
        $stmt = $pdo->prepare("SELECT * FROM estudiantes WHERE Id_Estudiante = ?");
        $stmt->execute([$doc]);
        $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($estudiantes) {
            foreach ($estudiantes as $fila) {
                mostrarTabla($fila);

                // Si presionaron btn3 -> eliminar
                if (isset($_POST['btn3'])) {
                    $del = $pdo->prepare("DELETE FROM estudiantes WHERE Id_Estudiante = ?");
                    if ($del->execute([$doc])) {
                        echo "<br><strong>REGISTRO ELIMINADO !OK!</strong><br>";
                    } else {
                        echo "Error al eliminar.";
                    }
                }
            }
        } else {
            echo "No se encontró ningún estudiante con el ID $doc.";
        }
    }
}
?>
