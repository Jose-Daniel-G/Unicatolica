<?php
// Inicia la sesión solo si no hay ninguna activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica que sea el administrador
if ($_SESSION["Id_Estudiante"] != 16882523) {
    header("Location: ./home.view.php");
    exit();
}

include_once "../../config/env.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../../public/img/logo-unicatolica.png" type="image/x-icon">
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../vendor/sweetalert/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../vendor/odometer/css/odometer.min.css">
    <title>Unicatólica</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="padding-top: 150px;">
            <div class="col-4 text-center">
                <img src="../../public/img/logo-unicatolica.png" alt="Logo" class="img-fluid">
            </div>
            <div class="col-4 text-center">
                <!-- BOTON MODAL SORTEO -->
                <button class="btn btn-dark text-white" id="btnSorteo" style="padding: 50px 100px;" data-toggle="modal"
                    data-target="#sorteoSemana">
                    <i class="fa fa-play fa-9x"></i>
                </button>
            </div>
            <div class="col-4 text-center">
                <img src="../../public/img/logo-semana-6.png" alt="Logo Semana 6" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- MODAL SORTEO -->
    <div class="modal fade" id="sorteoSemana" tabindex="-1" role="dialog" aria-labelledby="sorteoSemanaLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="bg-dark container-fluid text-center" id="container-modal">
                        <div id="odometer" class="odometer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL SORTEO -->

    <script src="../../vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/sweetalert/js/sweetalert2.min.js"></script>
    <script src="../../vendor/odometer/js/odometer.min.js"></script>
    <script src="../../public/js/draw.js"></script>
</body>

</html>
