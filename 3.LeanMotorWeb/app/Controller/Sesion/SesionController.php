<?php

include_once "../../app/Model/Sesion/SesionModel.php";
@session_start();

class SesionController {

    public function AbrirSesion() {

        if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
            $objSesion = new SesionModel();
            $usua_id = $_POST['usuario'];
            $usua_pass = $_POST['contrasena'];
            $sqlclie = "SELECT Cedula, CONCAT(Nombres, ' ', Apellidos), Id_Perfil, Nit_Empresa FROM usuarios
            WHERE Login='$usua_id' AND Password='$usua_pass' AND Estado='A'";

            $cliente = $objSesion->Consultar($sqlclie);

            if ($cliente != null) {
                $_SESSION['usua_id'] = $cliente[0][0];
                $_SESSION['usua_nombreCompleto'] = $cliente[0][1];
                $_SESSION['Nit_Empresa'] = $cliente[0][3];
                $_SESSION['usua_perfil'] = $cliente[0][2];

                redirect("../../web/pages/");
            } else {
                echo "<script type='text/javascript'>
                        alert('Usuario no válido');
                        window.location.href='../../';</script>";
                /*
                $titulo= obligatorio, $tipo = obligatorio, $texto = opcional;
                $redirigir, $tipo de redirección, $url y $tiempo son opcionales solo si no se específico ninguno de estos.
                 */
                // echo messageSweetAlert("Usuario no válido", "warning", "", "si", "automatica", "/", 2500);
            }
        } else {
            /*
            $titulo= obligatorio, $tipo = obligatorio, $texto = opcional;
            $redirigir, $tipo de redirección, $url y $tiempo son opcionales solo si no se específico ninguno de estos.
             */
            echo messageSweetAlert("Revise los siguientes campos:", "", "error", "•El campo usuario o contraseña están vacíos", "si", "boton", "/");
        }
    }

    public function cerrarSesion() {
        @session_start();
        @session_destroy();
        redirect("../../");
    }
}
