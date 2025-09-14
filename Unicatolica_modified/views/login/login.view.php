<?php
include_once "config/env.php";

// Iniciar sesión de manera segura
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="public/img/logo-unicatolica.png" type="image/x-icon">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="vendor/sweetalert/css/sweetalert2.min.css">
    <title>Inicio de Sesión</title>
</head>

<body>
    <div class="mt-5 container">
        <div class="justify-content-center row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card card-login">
                    <div class="card-heading">
                        <div class="justify-content-center row">
                            <div class="col-12 text-center">
                                <p class="active" id="login-form-link">6<sup>ta</sup> Semana de la Ingeniería Creativa</p>
                            </div>
                            <div class="col-6 text-center">
                                <img src="public/img/logo-unicatolica.png" alt="Logo Unicatólica" class="img-fluid">
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- FORMULARIO -->
                                <form id="login-form" method="post" autocomplete="off">
                                    <div class="form-group">
                                        <label for="id" class="sr-only">ID</label>
                                        <input type="number" name="id" id="id" class="form-control" placeholder="ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="cedula" class="sr-only">Cédula</label>
                                        <input type="password" name="cedula" id="cedula" class="form-control" placeholder="Cédula">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="submit" id="login" class="form-control btn btn-login" value="Iniciar Sesión">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <a href="views/operations/Browse&Delete.view.php" class="btn btn-primary">Administrador</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- FIN FORMULARIO -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/sweetalert/js/sweetalert2.min.js"></script>
    <script>
        (function validarLogin() {
            $("#login-form").on("submit", function(event) {
                event.preventDefault(); // Evitar ejecutar el submit del formulario.

                var id = $("#id").val();
                var cedula = $("#cedula").val();

                if (id != "" && cedula != "") {
                    var formData = new FormData(event.target);
                    formData.append("funcion", "validar_sesion");
                    $.ajax({
                        url: "app/controller/login.controller.php",
                        method: "post",
                        dataType: "json",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            if (res.tipoRespuesta == "success") {
                                location.href = "views/home/home.view.php";
                            } else if (res.tipoRespuesta == "error") {
                                Swal.fire({title: 'El usuario ingresado no existe',type: 'warning',});
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Error de conexión', 'error');
                        }
                    });
                }
            });
        }());
    </script>
</body>

</html>