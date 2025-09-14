<?php

extract($_POST);


if (!empty($_POST)) {

    if (isset($modulo) && isset($controlador) && isset($funcion)) {
        if (is_dir("../../app/controller/" . $modulo)) {
            // echo "<script> alert('servira :'+'../../app/controller/" . $modulo . "/" . $controlador . ".controller.php'); </script>";

            if (file_exists("../../app/controller/" . $modulo . "/" . $controlador . ".controller.php")) {
                include_once "../../app/controller/" . $modulo . "/" . $controlador . ".controller.php";
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
// extract($_POST);

// if (!empty($_POST)) {
//     if (isset($module) && isset($controller) && isset($functions)) {
//         if (is_dir("../../app/controller/" . $module)) {
//             if (file_exists("../../app/controller/" . $module . "/" . $controller . ".controller.php")) {
//                 echo "../../app/controller/" . $module . "/" . $controller . ".controller.php";
//                 include_once "../../app/controller/" . $module . "/" . $controller . ".controller.php";
//                 $nameClass = $controller;
//                 $objcontroller = new $nameClass();
    
//                 if (method_exists($objcontroller, $functions)) {
//                     $objcontroller->$functions();
//                 } else {
//                     die("La función especificada no existe");
//                 }
//             } else {
//                 die("El controlador especificado no existe");
//             }
//         } else {
//             die("El módulo especificado no existe");
//         }
//     } else {
//         if (!isset($module)) {
//             die("El módulo no esta definido");
//         } else if(!isset($controller)){
//             die("El controlador no esta definido");
//         }else if(!isset($controller)){
//             die("La función no esta definida");
//         }
//     }
// }