<?php

extract($_POST);

if (!empty($_POST)) {
	// echo "<script>alert(' '+${modulo}+' / '+${controlador}+' / '+${funcion})</script>";

    if (isset($modulo) && isset($controlador) && isset($funcion)) {
      
        if (is_dir("../../app/controller/" . $modulo)) {
            if (file_exists("../../app/controller/" . $modulo . "/" . $controlador . ".controller.php")) {
                include_once "../../app/controller/" . $modulo . "/" . $controlador . ".controller.php";
                // echo "<script>alert(${modulo})</script>";
                // echo "${modulo}";

                $nombreClase = $controlador;

       
                $objControlador = new $nombreClase();
    
                if (method_exists($objControlador, $funcion)) {
                    $objControlador->$funcion();
                } else {
                    die("La función especificada no existe");
                }
            } else {
                die("El controlador especificado no existe");
            }
        } else {
            die("El módulo especificado no existe");
        }
    } else {
        if (!isset($modulo)) {
            die("El módulo no esta definido");
        } else if(!isset($controlador)){
            die("El controlador no esta definido");
        }else if(!isset($funcion)){
            die("La función no esta definida");
        }
    }
}