    <?php
    @session_start();
    include_once("../../vendor/sb-admin-2/lib/dompdf/dompdf_config.inc.php");
    include_once("../../app/Model/GastosDirectos/GastosDirectosModel.php");
    include_once("../../app/Lib/helpers.php");

    $objGasto= new GastosDirectosModel(); 

    $Numero_Documento=$_GET["numero_doc"];
    $nit_sede=$_GET["nit_sede"];
    $usua_id=$_SESSION["usua_id"];

    $sqlGasto = "SELECT egd.Numero_Documento, egd.Fecha_Documento, egd.Estado_Documento, egd.Nit_Cliente, egd.Numero_Ingreso, 
    egd.Detalle, egd.Total, egd.Codigo_Cuenta_Contable, egd.Fecha_Gasto, tiva.Id_Iva, un.Descripcion AS Unidad_Negocio, 
    egd.NoDocumentoCruce, egd.TipoDocumentoCruce, CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario_Crea,
    CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario_Imprime, egd.Nit_Empresa 
    FROM encabezado_gastosdirectos AS egd, unidades_negocio AS un, tipos_iva AS tiva, usuarios AS usu 
    WHERE egd.Numero_Documento = '$Numero_Documento' 
    AND egd.Nit_Empresa = '$nit_sede'
    AND usu.Cedula = '$usua_id' 
    AND egd.Unidad_Negocio = un.Codigo 
    AND egd.Desc_Tipo_Iva = tiva.Descripcion
    AND egd.Usuario_Crea = usu.Cedula";
    $Gasto = $objGasto->Consultar($sqlGasto);

    $sqlIngre = "SELECT ing.Numero_Ingreso, equi.Nit_Cliente, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo,
                            marcas.Descripcion AS Marca, marcas.Codigo_Marca, ing.Numero_Serie, No_Fases, Frame, Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, 
                            Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $Gasto[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
    $ingresosGD = $objGasto->Consultar($sqlIngre);

    $sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
    WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $ingresosGD[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
    $Cliente = $objGasto->Consultar($sqlcliente);

    if ($ingresosGD) {
        if ($ingresosGD[0]["Voltaje"] != "") {
            $Voltaje=$ingresosGD[0]["Voltaje"];
        }else if($ingresosGD[0]["V_Primario"] != ""){
            $Voltaje=$ingresosGD[0]["V_Primario"];
        }else if($ingresosGD[0]["Va"] != ""){
            $Voltaje=$ingresosGD[0]["Va"];
        }else if($ingresosGD[0]["Voltaje"] == "" && $ingresosGD[0]["V_Primario"] == "" && $ingresosGD[0]["Va"] == ""){
            $Voltaje=null;
        }
        if ($ingresosGD[0]["Revoluciones_Por_Minuto"] != "") {
            $Velocidad=$ingresosGD[0]["Revoluciones_Por_Minuto"];
        }else if($ingresosGD[0]["Velocidad_Parte"] != ""){
            $Velocidad=$ingresosGD[0]["Velocidad_Parte"];
        }else if($ingresosGD[0]["Revoluciones_Por_Minuto"] == "" && $ingresosGD[0]["Velocidad_Parte"] == ""){
            $Velocidad=null;
        }
    }

    foreach ($Gasto as $gasto) {}
    foreach ($ingresosGD as $ingreso) {}
    foreach ($Cliente as $cliente) {}

    date_default_timezone_set("America/Bogota");
    $fechaImpresion = date("Y/m/d");

    $codigoHTML='
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap Core CSS -->
        <link href="../../vendor/sb-admin-2/lib/dompdf/lib/utilities-bootstrap4/bootstrap.min.css?v=' . rand() . '" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="../../vendor/sb-admin-2/lib/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Styles CSS -->
        <link href="../../public/css/styles.css?v=' . rand() . '" rel="stylesheet">
        <title>Gasto Directo</title>
    </head>

    <body>';


    $codigoHTML.='
    <table class="table-borderless" width="100%;">

        <thead class="text-center">
            <tr>
                <td>LABORATORIO TECNO-ELÉCTRICO S.A.S</td>
            </tr>

            <tr>
                <td>Gasto Directo</td>
            </tr>

            <tr>
                <td class="text-left">Fecha impresión : '.fechaCastellano($fechaImpresion).'</td>
            </tr>

            <tr>
                <td class="text-left">Fecha gasto <span class="padding-left: 4px;">: '.fechaCastellano($gasto["Fecha_Documento"]).'</span></td>
            </tr>
        </thead>

    </table>';


    $codigoHTML.='
    <table class="table-borderless" width="100%;" style="padding-top: 20px;">
        <tr>
            <td>Cliente : '.$cliente["Razon_Social"].'</td>
            <td>Nit : '.$cliente["Nit_Cliente"].'</td>
        </tr>

        <tr>
            <td>Dirección : '.$cliente["Direccion"].'</td>
            <td>Ciudad : '.$cliente["Ciudad"].'</td>
            <td>Teléfono : '.$cliente["Telefono1"].'</td>
        </tr>
    </table>';

    $codigoHTML.='
    <table class="table-borderless" width="100%;" style="padding-top: 20px;">
        <tr>
            <td>Ingreso : '.$ingreso["Numero_Ingreso"].'</td>
            <td>Equipo : '.$ingreso["Equipo"].'</td>
            <td>Marca : '.$ingreso["Marca"].'</td>
        </tr>

        <tr>
            <td>Serie : '.$ingreso["Numero_Serie"].'</td>
            <td>Potencia : '.$ingreso["Potencia"].'</td>
            <td>R.P.M : '.$Velocidad.'</td>
            <td>Frame : '.$ingreso["Frame"].'</td>
        </tr>
    </table>';

    $codigoHTML.='
    <table class="table-borderless" width="100%;" style="padding-top: 20px;">
        <tr>
            <td>Valor Gasto : '.number_format($gasto["Total"], 0, ",", ",").'</td>
            <td>Documento Cruce : '.$gasto["TipoDocumentoCruce"].'</td>
            <td>N° Documento Cruce : '.$gasto["NoDocumentoCruce"].'</td>
        </tr>
    </table>';

    $codigoHTML.='
    <table class="table-borderless" width="100%;">
        <tr>
            <td>Cuenta Gasto : '.$gasto["Codigo_Cuenta_Contable"].'</td>
            <td>Unidad de negocio : '.$gasto["Unidad_Negocio"].'</td>
        </tr>
    </table>';

    $Detalle = str_split($gasto["Detalle"], 70);

    if (strlen($gasto["Detalle"]) <= 70) {
        $codigoHTML.='
        <table class="table-borderless" width="100%;">
            <tr>
                <td>Detalle : '.$gasto["Detalle"].'</td>
            </tr>
        </table>';
    }else{
        $codigoHTML.='
        <table class="table-borderless" width="100%;">        
            <tr>
                <td>Detalle: 
            </tr>';
            foreach ($Detalle as $index => $detalle) {
                $codigoHTML .= '
                <tr>
                    <td>'.$detalle.'</td>
                </tr>';
            }
        '</table>';
    }

    $codigoHTML.='
    <table class="table-borderless" width="100%;"> 
        <tr>
            <td>Usuario Crea : '.$gasto["Usuario_Crea"].'</td>
            <td>Usuario Imprime : '.$gasto["Usuario_Imprime"].'</td>
        </tr>
    </table>';

    $codigoHTML.='

    </body>

    </html>';
    $codigoHTML=utf8_encode(utf8_decode($codigoHTML));
    // Se crea la instancia
    $dompdf = new DOMPDF();
    $dompdf->set_paper("A4", "portrait");
    $dompdf->load_html($codigoHTML);
    ini_set("memory_limit","128M");
    $dompdf->render();
    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica");
    $canvas->page_text(500, 50, "No. $gasto[0]", $font, 14, array(0,0,0));

    // Se muestra el PDF y se le asigna el nombre de descarga
    $dompdf->stream(
        "Gasto Directo.pdf",
        array(
            "Attachment" => false
        )
    );
    ?>