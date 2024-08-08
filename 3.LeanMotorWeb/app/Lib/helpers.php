<?php

function getUrl($modulo, $controlador, $funcion, $parametros = false, $ajax = false) {
    if ($ajax == false) {
        $pagina = "index";
    } else {
        $pagina = "ajax";
    }

    $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";

    if ($parametros != false) {
        foreach ($parametros as $key => $valor) {
            $url .= "&$key=$valor";
        }
    }
    return $url;
}

function getTitle($modulo, $funcion) {

    $return = "";

    return $return;
}

function messageSweetAlert($title, $html, $type, $text = null, $redirect = null, $typeRedirection = null, $url = null, $timer = 0) {

    $type = strtolower($type);
    $typeRedirection = strtolower($typeRedirection);

    if ($redirect == "si") {
        if ($typeRedirection == "boton" && $url != null && $timer == 0) {
            $sweetAlert =
                "<script>
                swal({
                    title: '$title',
                    html: '$html',
                    text: '$text',
                    type: '$type',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.value) {
                        window.location = '$url';
                    }
                });
                </script>";
        }else{
            $sweetAlert =
                "<div class='alert alert-dark w-50'>
                        <p><span class='font-weight-bold'>El parámetro '\$timer' debe ser null o igual a 0</p>
                </div>";
        }
        if ($typeRedirection == "automatica" && $url != null && $timer != 0) {
            $sweetAlert =
                "<script>
                    swal({
                        title: '$title',
                        html: '$html',
                        type: '$type',
                        text: '$text',
                        timer: '$timer',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === 'timer') {
                            window.location = '$url';
                        }
                    });
                    </script>";
        } else if ($typeRedirection == null && $url == null && $timer == 0) {
            $sweetAlert =
                "<div class='alert alert-dark w-50'>
                        <p><span class='font-weight-bold'>Fatal error: </span>Uncaught ArgumentCountError: Too few arguments to function messageSweetAlert(), 4 passed</p>
                        <p><span class='font-weight-bold'>Missing three: </span>\$typeRedirection, \$url, \$timer</p>
                </div>";
        }
        return $sweetAlert;
    }
    if ($redirect == "no" || $redirect == null) {
        $sweetAlert =
            "<script>
                swal({
                    title: '$title',
                    html: '$html',
                    type: '$type',
                    text: '$text',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
                </script>";
                
        return $sweetAlert;
    }
}

function basico($numero) {
    $valor = array('uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho',
        'nueve', 'diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciseis',
        'diecisiete', 'dieciocho', 'diecinueve', 'veinte', 'veintiuno', 'veintidos',
        'ventitres', 'veinticuatro', 'veinticinco', 'veintiséis', 'veintisiete', 'veintiocho',
        'veintinueve');
    return $valor[$numero - 1];
}

function decenas($n) {
    $decenas = array(30 => 'treinta', 40 => 'cuarenta', 50 => 'cincuenta', 60 => 'sesenta',
        70 => 'setenta', 80 => 'ochenta', 90 => 'noventa');
    if ($n <= 29) {
        return basico($n);
    }

    $x = $n % 10;
    if ($x == 0) {
        return $decenas[$n];
    } else {
        return $decenas[$n - $x] . ' y ' . basico($x);
    }

}

function centenas($n) {
    $cientos = array(100 => 'cien', 200 => 'doscientos', 300 => 'trecientos',
        400 => 'cuatrocientos', 500 => 'quinientos', 600 => 'seiscientos',
        700 => 'setecientos', 800 => 'ochocientos', 900 => 'novecientos');
    if ($n >= 100) {
        if ($n % 100 == 0) {
            return $cientos[$n];
        } else {
            $u = (int) substr($n, 0, 1);
            $d = (int) substr($n, 1, 2);
            return (($u == 1) ? 'ciento' : $cientos[$u * 100]) . ' ' . decenas($d);
        }
    } else {
        return decenas($n);
    }

}

function miles($n) {
    if ($n > 999) {
        if ($n == 1000) {return 'mil';} else {
            $l = strlen($n);
            $c = (int) substr($n, 0, $l - 3);
            $x = (int) substr($n, -3);
            if ($c == 1) {$cadena = 'mil ' . centenas($x);} else if ($x != 0) {$cadena = centenas($c) . ' mil ' . centenas($x);} else {
                $cadena = centenas($c) . ' mil';
            }

            return $cadena;
        }
    } else {
        return centenas($n);
    }

}

function millones($n) {
    if ($n == 1000000) {return 'un millón';} else {
        $l = strlen($n);
        $c = (int) substr($n, 0, $l - 6);
        $x = (int) substr($n, -6);
        if ($c == 1) {
            $cadena = ' millón ';
        } else {
            $cadena = ' millones ';
        }
        return miles($c) . $cadena . (($x > 0) ? miles($x) : '');
    }
}

function convertir($n) {
    switch (true) {
        case ($n >= 1 && $n <= 29): return basico($n);
            break;
        case ($n >= 30 && $n < 100): return decenas($n);
            break;
        case ($n >= 100 && $n < 1000): return centenas($n);
            break;
        case ($n >= 1000 && $n <= 999999): return miles($n);
            break;
        case ($n >= 1000000): return millones($n);
    }
}

function fechaCastellano ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date("d", strtotime($fecha));
    $dia = date("l", strtotime($fecha));
    $mes = date("F", strtotime($fecha));
    $anio = date("Y", strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia.", ".$numeroDia." de ".$nombreMes." de ".$anio;
}

function encriptar($dato){
	return(base64_encode(base64_encode($dato)));
}

function decriptar($dato){
	return(base64_decode(base64_decode($dato)));
}

function dd($variable) {
    echo "<pre>";
    die(print_r($variable));
}

function redirect($url) {
    echo "<script type='text/javascript'>
	window.location.href='$url';</script>";
}

function cargarPrincipal() {
    if (!isset($_GET['modulo']) && !isset($_GET['controlador']) && !isset($_GET['funcion'])) {
        //include_once('../../GuiIniciarSesion.html.php');
    } else {
        $modulo = ucwords($_GET['modulo']);
        $controlador = $_GET['controlador'];
        $funcion = $_GET['funcion'];

        if (is_dir("../../app/Controller/" . $modulo)) {
            if (file_exists("../../app/Controller/" . $modulo . "/" . $controlador . "Controller.php")) {
                include_once "../../app/Controller/" . $modulo . "/" . $controlador . "Controller.php";
                $nombreClase = $controlador . "Controller";
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
    }
}
