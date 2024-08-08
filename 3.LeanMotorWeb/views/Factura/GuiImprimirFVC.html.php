<?php
    include_once("../../vendor/sb-admin-2/lib/dompdf/dompdf_config.inc.php");
    include_once("../../app/Model/Cotizaciones/CotizacionesModel.php");
    include_once("../../app/Lib/helpers.php");
    @session_start();

    $objFactura = new CotizacionesModel();
    $dompdf = new DOMPDF(array("isPhpEnabled" => true));

    $Numero_Documento=$_GET['numero_doc'];
    $tipo_doc=$_GET['tipo_doc'];
    $nit_sede=$_GET['nit_sede'];

    $sqlFVC="SELECT edv.Numero_Documento, ddv.Numero_Ingreso, DATE_FORMAT(edv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, 
                        DATE_FORMAT(edv.Fecha_Documento, '%m') AS Mes, DATE_FORMAT(edv.Fecha_Documento, '%d') AS Dia, 
                        DATE_FORMAT(edv.Fecha_Documento, '%Y') AS Año, 
                        cli.Nit_Cliente, cli.Razon_Social, edv.Dirigido_A, edv.Codigo_Planta, cli.Direccion, cli.Telefono1, cli.Telefono2, edv.Dias_Plazo, 
                        edv.Observaciones, edv.Estado_Documento, edv.Nit_Empresa, sede.nombre AS Sede, edv.Cedula_Empleado, edv.Subtotal, edv.Descuento, 
                        edv.Iva, edv.Total, edv.Orden_Compra, ddv.Numero_Cotizacion 
                        FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv, clientes AS cli, sedes AS sede 
                        WHERE ddv.Numero_Documento = edv.Numero_Documento AND ddv.NIT_Empresa = edv.NIT_Empresa 
                        AND edv.NIT_Empresa=cli.Nit_Empresa AND edv.Nit_Cliente=cli.Nit_Cliente AND edv.Nit_Empresa=sede.nit_empresa 
                        AND edv.Numero_Documento='$Numero_Documento' AND edv.Tipo_Documento = '$tipo_doc' AND edv.NIT_Empresa = '$nit_sede' 
                        GROUP BY ddv.Numero_Cotizacion DESC, ddv.Numero_Ingreso DESC";
    $cabeceraFVC=$objFactura->Consultar($sqlFVC);

    if ($cabeceraFVC[0]["Codigo_Planta"] != null) {
        $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraFVC[0]["Nit_Cliente"] . "'" . "";
        $plantas = $objFactura->Consultar($sqlplanta);
    } else {
        $plantas = null;
    }

    $sqlParam = "SELECT * FROM parametros_sistema WHERE NIT_Empresa = '$nit_sede'";
    $paramSistem=$objFactura->Consultar($sqlParam);

    if ($cabeceraFVC[0]["Dias_Plazo"] > 0) {
        $pago="Crédito";
    } else {
        $pago="Contado";
    }

    date_default_timezone_set("America/Bogota");

    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

    // FECHA DOCUMENTO
    $diaSemanaDoc = $dias[date("w", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"], $cabeceraFVC[0]["Año"]))];
    $diaDoc = date("d", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"], $cabeceraFVC[0]["Año"]));
    $mesDoc = $meses[date("m", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"], $cabeceraFVC[0]["Año"]))*1-1];
    $anoDoc = date("Y", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"], $cabeceraFVC[0]["Año"]));
    $fechaDoc = $diaSemanaDoc.", ".$diaDoc." de ".$mesDoc." de ".$anoDoc;
    // FIN FECHA DOCUMENTO
    
    // FECHA VENCIMIENTO DEL DOCUMENTO
    $diaSemanaVenc = $dias[date("w", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"] + $cabeceraFVC[0]["Dias_Plazo"], $cabeceraFVC[0]["Año"]))];
    $diaVenc = date("d", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"] + $cabeceraFVC[0]["Dias_Plazo"], $cabeceraFVC[0]["Año"]));
    $mesVenc = $meses[date("m", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"] + $cabeceraFVC[0]["Dias_Plazo"], $cabeceraFVC[0]["Año"]))*1-1];
    $anoVenc = date("Y", mktime(0, 0, 0, $cabeceraFVC[0]["Mes"], $cabeceraFVC[0]["Dia"] + $cabeceraFVC[0]["Dias_Plazo"], $cabeceraFVC[0]["Año"]));
    $fechaVenc = $diaSemanaVenc.", ".$diaVenc." de ".$mesVenc." de ".$anoVenc;
    // FIN FECHA VENCIMIENTO

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
        <title>Factura</title>
        <style>
        body {
            font-family: "times-new-roman";
        }
        @page {
            margin-left: 20%;
            margin-top: 8%;
        }
        table {
            table-layout: fixed ;
            width: 100% ;
        }
        </style>
    </head>

    <body>';

    $codigoHTML.='
    <table class="table-borderless pl-2" style="line-height: 13px; font-size: 14px;">
        <tr>
            <td>Señores:</td>
        </tr>

        <tr>
            <td><b>'.strtoupper($cabeceraFVC[0]["Razon_Social"]).'</b></td>
        </tr>

        <tr>
            <td>Nit '.$cabeceraFVC[0]["Nit_Cliente"].'</td>
        </tr>

        <tr>
            <td>'.$cabeceraFVC[0]["Direccion"].'</td>
        </tr>

        <tr>
            <td>Tel 1. '.$cabeceraFVC[0]["Telefono1"].' &nbsp;&nbsp;&nbsp; Tel 2. '.$cabeceraFVC[0]["Telefono2"].'</td>
        </tr>

        <tr>
            <td>Cotizaciones: ';
            $cont = 0;
            $cotizaciones = "";
            
            foreach($cabeceraFVC as $cabecera){
                $cotizaciones .= ''.$cabecera["Numero_Cotizacion"].', ';
            }
            $cotizaciones = substr($cotizaciones, 0, -2);
            
            $codigoHTML .= '<span>'.$cotizaciones.'</span>';
            $codigoHTML.='</td>
        </tr>
    </table>';

    $codigoHTML.='
    <table class="table-borderless pl-2" style="padding-top: 20px; font-size: 15px;">
        <tr>
            <td style="width: 28%;"><b>Fecha Factura: '. $fechaDoc .'</b></td>
        </tr>
        <tr>
            <td style="width: 38%;"><b>Fecha Vence: '. $fechaVenc .'</b></td>
        </tr>
        <tr>
            <td style="width: 50%;"><b>Condiciones de Pago: '.$pago.' '.$cabeceraFVC[0]["Dias_Plazo"].' días</b></td>
        </tr>
    </table>';

    $subtotal=0;
    $cont=0;

    foreach($cabeceraFVC as $cabecera){

        $sqlDetalle = "SELECT Numero_Registro, Numero_Cotizacion, Numero_Ingreso, Aprobado, Codigo_Producto, productos_servicios.Descripcion, 
        detalle_factura_venta.Detalle, detalle_factura_venta.Cantidad, detalle_factura_venta.Valor_Unitario,
        detalle_factura_venta.Porcentaje_Descuento, Valor_Iva, detalle_factura_venta.Porcentaje_Iva
        FROM detalle_factura_venta, productos_servicios WHERE detalle_factura_venta.Codigo_Producto=productos_servicios.Codigo
        AND  Numero_Cotizacion='".$cabecera["Numero_Cotizacion"]."' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ORDER BY Numero_Registro ASC";
        $detalleFVC = $objFactura->Consultar($sqlDetalle);

        if ($cont==0) {

            $codigoHTML.='<br><br><br><br><br>';

            $codigoHTML.='
            <table class="pl-2 table-borderless" style="font-size: 17px;">
                <tr style="font-weight: bold;">
                    <td rowspan="3" style="width: 50%;"></td>
                    <td>
                        <p class="m-0"><b>Subtotal</p><td>$:</td><td class="text-right">'.number_format($cabecera["Subtotal"]).'</b></td>
                    </td>
                </tr>
                <tr style="font-weight: bold;">
                    <td>
                        <p class="m-0">Iva</p>
                        <td>$:</td>
                        <td class="text-right">
                            '.number_format($cabecera["Iva"]).'
                        </td>
                    </td>
                </tr>
                <tr style="font-weight: bold;">
                    <td>
                        <p class="m-0">Total&nbsp;Factura</p>
                        <td>$:</td>
                        <td class="text-right">
                            '.number_format($cabecera["Total"]).'
                        </td>
                    </td>
                </tr>
            </table>';

            $codigoHTML.='<br><br><br><br><br>';

            $codigoHTML.='
            <table class="table-borderless pl-2" style="font-size: 13px;">
                <tr>
                    <td>
                        <p class="m-0" style="font-size: 14px;"><b>Valor en Letras:</b></p>
                        <p class="m-0" style="font-size: 14px;"><b>'.ucwords(convertir($cabecera["Total"])) ." Pesos".'</b></p>
                        <p>
                            '.$paramSistem[0]["Resolucion_Dian"].'
                        </p>
                        <p>
                            '.$paramSistem[0]["Mensaje4"].'
                        </p>
                        <p class="text-center">
                            '.$paramSistem[0]["Mensaje1"].'
                        </p>
                        <p class="text-center">
                            '.$paramSistem[0]["Mensaje2"].'
                        </p>
                        <p class="text-center">
                            '.$paramSistem[0]["Mensaje3"].'
                        </p>
                        <p>
                            He efectuado los aportes a la seguridad social por los ingresos materia de facturación, 
                            El numero o referencia de la planilla en el cual se realizo el pago es el : 
                            La radicacion de esta factura de venta declara haber recibido real y materialmente 
                            la mercancia detallada en el presente documento, en caso de mora se causara 
                            una sanción del 3% mensual
                        </p>
                        <p class="text-center">
                            '.$_GET["circularizacion"].'
                        </p>
                    </td>
                    </tr>
            </table>';

            $codigoHTML.='<br><br><br><br><br><br><br><br><br><br>';

            $cont++;
        }

        if ($cabecera["Numero_Ingreso"] != null) {
            $sqlIngre="SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie,
            No_Fases, CONCAT(Potencia,' - ', Unidad_De_Potencia) AS Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, 
            Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru, marcas, detalle_equipo AS dequi
            WHERE ing.Numero_Serie=equi.Numero_Serie
            AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
            AND tequi.Codigo_Grupo=gru.Codigo_Grupo
            AND equi.Codigo_Marca=marcas.Codigo_Marca
            AND equi.Numero_Serie=dequi.Numero_Serie
            AND ing.Numero_Ingreso='".$cabecera["Numero_Ingreso"]."' LIMIT 1";
            $ingresosFVC=$objFactura->Consultar($sqlIngre);

            if ($ingresosFVC) {
                if ($ingresosFVC[0]["Voltaje"] != "") {
                    $Voltaje=$ingresosFVC[0]["Voltaje"];
                }else if($ingresosFVC[0]["V_Primario"] != ""){
                    $Voltaje=$ingresosFVC[0]["V_Primario"];
                }else if($ingresosFVC[0]["Va"] != ""){
                    $Voltaje=$ingresosFVC[0]["Va"];
                }else if($ingresosFVC[0]["Voltaje"] == "" && $ingresosFVC[0]["V_Primario"] == "" && $ingresosFVC[0]["Va"] == ""){
                    $Voltaje=null;
                }
                if ($ingresosFVC[0]["Revoluciones_Por_Minuto"] != "") {
                    $Velocidad=$ingresosFVC[0]["Revoluciones_Por_Minuto"];
                }else if($ingresosFVC[0]["Velocidad_Parte"] != ""){
                    $Velocidad=$ingresosFVC[0]["Velocidad_Parte"];
                }else if($ingresosFVC[0]["Revoluciones_Por_Minuto"] == "" && $ingresosFVC[0]["Velocidad_Parte"] == ""){
                    $Velocidad=null;
                }
            }

            $codigoHTML.='
            <table class="table-borderless pl-2" style="font-size: 13px;">
                <tbody>';
            foreach($ingresosFVC as $ingresos){
                $codigoHTML.='
                    <tr>
                        <td style="padding-bottom: 15px;"></td>
                    </tr>
                    
                    <tr>
                        <td>Equipo: '.$ingresos["Equipo"].'</td>
                    </tr>
                
                    <tr>
                        <td colspan="2">Marca: '.$ingresos["Marca"].'</td>
                        <td>Fases: '.$ingresos["No_Fases"].'</td>
                    </tr>
                
                    <tr>
                        <td>Potencia: '.$ingresos["Potencia"].'</td>
                        <td style="width: 30%">Voltaje: '.$Voltaje.'</td>
                        <td>Ingreso: '.$ingresos["Numero_Ingreso"].'</td>
                    </tr>
                
                    <tr>
                        <td>R.P.M: '.$Velocidad.'</td>
                        <td>Serie: '.$ingresos["Numero_Serie"].'</td>
                        <td>O.S: '.$ingresos["Orden_Servicio"].'</td>
                    </tr>

                    <tr>
                        <td colspan="2">Cotización: '.$detalleFVC[0]["Numero_Cotizacion"].'</td>
                        <td>O.C: '.$cabecera["Orden_Compra"].'</td>
                    </tr>

                    <tr>
                        <td>Ubicación: '.$ingresos["Ubicacion"].'</td>
                    </tr>
                    
                    <tr>
                        <td>Detalle de Equipo: '.$ingresos["Detalle_De_Equipo"].'</td>
                    </tr>';
            }
            $codigoHTML.='</tbody></table>';

            }else{
                $sqlCTGER="SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion, Telefono1, ciudades.Nombre AS Ciudad, Numero_Ingreso, Equipo, Marca, Insul_Cls, Potencia, Rpm, Voltaje,
                Fs, Eficiencia, Rpm, Serie, Ip, Frame, Tipo_Servicio, encabezado_cotizacion_venta.Forma_Pago, encabezado_cotizacion_venta.Dias_Plazo, Prioridad, Garantia, FechaAprobacion,
                    encabezado_cotizacion_venta.Observaciones, Estado_Documento, Tipo_Documento, encabezado_cotizacion_venta.NIT_Empresa, sedes.nombre, Fecha_Documento,
                        encabezado_cotizacion_venta.Cedula_Empleado, Subtotal, Descuento, Iva, Total, tipos_equipos.Descripcion, encabezado_cotizacion_venta.Orden_Compra 
                            FROM encabezado_cotizacion_venta, clientes, ciudades, sedes, tipos_equipos
                                WHERE encabezado_cotizacion_venta.Nit_Cliente=clientes.Nit_Cliente AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad
                                AND encabezado_cotizacion_venta.equipo=tipos_equipos.Codigo_Tipo_Equipo AND Numero_Documento='".$cabecera["Numero_Cotizacion"]."'
                                    AND Tipo_Documento='CTGER' AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' AND encabezado_cotizacion_venta.NIT_Empresa=sedes.nit_empresa";
                $cabeceraCTGER=$objFactura->Consultar($sqlCTGER);

                    $codigoHTML.='
                    <table class="table-borderless pl-2" style="font-size: 13px;">
                        <tbody>';

                    foreach($cabeceraCTGER as $cabecera){
                        $codigoHTML.='
                    <tr>
                        <td style="padding-bottom: 15px;"></td>
                    </tr>
                    
                    <tr>
                        <td>Equipo: '.$cabecera["Equipo"].'</td>
                    </tr>
                
                    <tr>
                        <td colspan="2">Marca: '.$cabecera["Marca"].'</td>
                        <td>F.S: '.$cabecera["Fs"].'</td>
                    </tr>
                
                    <tr>
                        <td>Potencia: '.$cabecera["Potencia"].'</td>
                        <td style="width: 30%">Voltaje: '.$cabecera["Voltaje"].'</td>
                        <td>I.P: '.$cabecera["Numero_Ingreso"].'</td>
                    </tr>
                
                    <tr>
                        <td>R.P.M: '.$cabecera["Rpm"].'</td>
                        <td>Serie: '.$cabecera["Serie"].'</td>
                        <td>Insul Cls: '.$cabecera["Insul_Cls"].'</td>
                    </tr>

                    <tr>
                        <td colspan="2">Cotización: '.$detalleFVC[0]["Numero_Cotizacion"].'</td>
                        <td>O.C: '.$cabecera["Orden_Compra"].'</td>
                    </tr>'; 
                    $codigoHTML.='</tbody></table>';
                }
            }
            
            $codigoHTML.='
            <table class="table-borderless pl-2" style="font-size: 13px; padding: 30px 0px 30px 0px;">
                <tbody>
                    <tr>
                        <td><b>Actividad</b></td>
                        <td><b>Detalle</b></td>
                        <td class="text-center"><b>Cantidad</b></td>
                        <td class="text-right"><b>Valor</b></td>
                        <td class="text-right"><b>Subtotal</b></td>
                    </tr>';
            foreach($detalleFVC as $detalle){
                $subtotal=$detalle["Valor_Unitario"] * $detalle["Cantidad"];
                $codigoHTML.='
                    <tr>
                        <td style="font-size: 10px; width: 30%;">'.strtoupper($detalle["Descripcion"]).'</td>
                        <td style="font-size: 10px; width: 35%;">'.strtoupper(substr($detalle["Detalle"], 0, 30)).'</td>
                        <td class="text-center">'.$detalle["Cantidad"].'</td>
                        <td class="text-right">'.number_format($detalle["Valor_Unitario"], 0, ",", ",").'</td>
                        <td style="width: 13%;" class="text-right">'.number_format($subtotal, 0, ",", ",").'</td>
                    </tr>';
            }
            $codigoHTML.='</tbody></table>';
        }

            $codigoHTML.='
                <table class="pl-2 table table-borderless" style="padding-top: 100px; font-size: 13px;">
                    <tr>
                        <td class="text-left">
                            <p><hr style="max-width: 200px; margin: 0px;"></p>
                            <p class="ml-5">Entregado por</p>
                        </td>
                        <td class="text-right">
                            <p><hr style="max-width: 200px; margin-left: 40%;"></p>
                            <p class="ml-5">Firma sello Nit C.C. Cliente</p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>';

    $codigoHTML.='
    <table class="pb-3 pl-2 table-borderless" style="padding-top: 30px; font-size: 14px;">
        <tr>
            <td>Observaciones: '.$cabecera["Observaciones"].'</td>
        </tr>
    </table>';

    $codigoHTML.='
</html>';
$codigoHTML=utf8_encode(utf8_decode($codigoHTML));
$dompdf->set_paper("A4", "portrait");
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$font = Font_Metrics::get_font("helvetica");
$canvas->page_text(128, 40, "Pag: {PAGE_NUM}", $font, 10, array(0,0,0));
$canvas->page_text(500, 40, 'No. ' . $cabecera["Numero_Documento"], $font, 14, array(0,0,0));

// Se muestra el PDF y se le asigna el nombre de descarga
$dompdf->stream(
	"Factura de Venta.pdf",
	array(
		"Attachment" => false
	)
);
?>