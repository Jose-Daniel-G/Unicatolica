<?php
include_once "config/env.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruir sesión anterior
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Estudiantes</title>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="stylesheet" href="../../vendor/sweetalert/css/sweetalert2.min.css">
</head>

<body>
    <div class="mt-5 container">
        <div class="justify-content-center row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <h2><strong><em>Consultar Estudiantes</em></strong></h2>
                <div class="my-3">
                    <img src="../../public/img/logo-unicatolica.png" alt="Logo" class="img-fluid">
                </div>

                <!-- FORMULARIO -->
                <form name="consult" id="consult" method="post">
                    <div class="form-group">
                        <label for="documento">ID estudiante</label>
                        <input type="text" id="documento" name="documento" class="form-control" placeholder="Ingrese ID">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-login btn-block" value="BUSCAR">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="../../vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/sweetalert/js/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#consult').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'controllers/consult.php', // Script PHP que procesa la búsqueda
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.tipoRespuesta === 'success') {
                            Swal.fire('Éxito', response.mensaje || 'Estudiante encontrado', 'success');
                            // Opcional: redirigir o mostrar info
                            // window.location.href = 'Modify.view.php?id=' + response.id;
                        } else {
                            Swal.fire('Error', response.mensaje || 'Estudiante no encontrado', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Error de conexión', 'error');
                    }
                });
            });
        });
    </script>
</body>
</html>
