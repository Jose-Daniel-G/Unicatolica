<?php

include_once "../../app/Model/Session/SessionModel.php";
@session_start();

class SessionController {

    public function AbrirSession() {

        if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
            $objSession = new SessionModel();
            $usua_id = $_POST['usuario'];
            $usua_pass = $_POST['contrasena'];
            // $sqlclie = "SELECT Cedula, CONCAT(Nombres, ' ', Apellidos), Id_Perfil, Nit_Empresa FROM usuarios
            // WHERE Login='$usua_id' AND Password='$usua_pass' AND Estado='A'";
            $sqlclie = "SELECT Cedula, CONCAT(Nombres, ' ', Apellidos), Id_Perfil FROM usuarios
            WHERE Login='$usua_id' AND Password='$usua_pass' AND Estado='A'";

            $cliente = $objSession->Consultar($sqlclie);

            if ($cliente != null) {
                $_SESSION['usua_id'] = $cliente[0][0];
                $_SESSION['usua_nombreCompleto'] = $cliente[0][1];
                // $_SESSION['Nit_Empresa'] = $cliente[0][3];
                $_SESSION['usua_perfil'] = $cliente[0][2];

                redirect("../../web/pages/");
            } else {
                echo "<script type='text/javascript'>
                        alert('Usuario no válido');
                        window.location.href='../../';
                        </script>";

                    
           
            }
        } else {
         
            echo messageSweetAlert("Revise los siguientes campos:", "", "error", "•El campo usuario o contraseña están vacíos", "si", "boton", "/");
        }
    }

    public function cerrarSesion() {
        @session_start();
        @session_destroy();
        redirect("../../");
    }
}