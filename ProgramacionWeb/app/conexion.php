<? 
$server = "localhost";
$user = "root";
$password = "";
$database = "formulario";

$conexion = new mysqli($server, $user, "", $database);

if ($conexion->connect_errno) {
    echo "Problemas en la conexion a MySQL: " . $conexion->connect_error;
}
