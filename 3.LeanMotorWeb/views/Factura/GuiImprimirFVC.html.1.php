<?php
include_once("../../vendor/sb-admin-2/lib/dompdf/dompdf_config.inc.php");
include_once("../../app/Model/Cotizaciones/CotizacionesModel.php");
include_once("../../app/Lib/helpers.php");
@session_start();

$objFactura= new CotizacionesModel(); 

$Numero_Documento=$_GET['numero_doc'];
$tipo_doc=$_GET['tipo_doc'];
$nit_sede=$_GET['nit_sede'];
// $nit_empresa= $_SESSION['Nit_Empresa'];

    $sqlFVC="SELECT Numero_Documento, Numero_Ingreso, Fecha_Documento, clientes.Nit_Cliente, Razon_Social, Dirigido_A, 
    Codigo_Planta, clientes.Direccion, Telefono1, Fax, encabezado_factura_venta.Dias_Plazo, 
    encabezado_factura_venta.Observaciones, Estado_Documento, encabezado_factura_venta.NIT_Empresa, 
    sedes.nombre, encabezado_factura_venta.Cedula_Empleado, Subtotal, Descuento, Iva, Total, Orden_Compra
        FROM encabezado_factura_venta, clientes, sedes
            WHERE encabezado_factura_venta.Nit_Cliente=clientes.Nit_Cliente 
            AND Numero_Documento='$Numero_Documento'
            AND Tipo_Documento='$tipo_doc' AND encabezado_factura_venta.NIT_Empresa='$nit_sede' 
            AND encabezado_factura_venta.NIT_Empresa=sedes.nit_empresa";
    $cabeceraFVC=$objFactura->Consultar($sqlFVC);

    if ($cabeceraFVC[0][6] != null) {
        $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraFVC[0][3] . "'" . "";
        $plantas = $objFactura->Consultar($sqlplanta);
    } else {
        $plantas = null;
    }

    foreach($cabeceraFVC as $cabecera){}

    $sqlIngre="SELECT Numero_Ingreso, tequi.Descripcion, gru.Descripcion, marcas.Descripcion, ing.Numero_Serie,
    No_fases, CONCAT(Potencia,' - ', Unidad_De_Potencia) AS potencia, revoluciones_por_minuto, voltaje, Ubicacion, 
    Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru, marcas, detalle_equipo AS dequi
            WHERE ing.Numero_Serie=equi.Numero_Serie
                    AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
                    AND tequi.Codigo_Grupo=gru.Codigo_Grupo
                    AND equi.Codigo_Marca=marcas.Codigo_Marca
                    AND equi.Numero_Serie=dequi.Numero_Serie
                    AND ing.Numero_Ingreso=" . "'" . $cabeceraFVC[0][1] . "'" . "";
    $ingresosFVC=$objFactura->Consultar($sqlIngre);
    
    foreach($ingresosFVC as $ingresos){}
	
    $sqlDetalle = "SELECT Numero_Registro, Numero_Cotizacion, Numero_Ingreso, Aprobado, Codigo_Producto, productos_servicios.Descripcion, 
    detalle_factura_venta.Detalle, detalle_factura_venta.Cantidad, detalle_factura_venta.Valor_Unitario,
    detalle_factura_venta.Porcentaje_Descuento, Valor_Iva, detalle_factura_venta.Porcentaje_Iva
    FROM detalle_factura_venta, productos_servicios WHERE detalle_factura_venta.Codigo_Producto=productos_servicios.Codigo
        AND  Numero_Documento='".$cabeceraFVC[0][0]."' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ORDER BY Numero_Registro ASC";
    $detalleFVC = $objFactura->Consultar($sqlDetalle);

    $sqlCTGER="SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, encabezado_factura_venta.Codigo_Planta, Dirigido_A, Direccion, Telefono1, 
    ciudades.Nombre, tipos_equipos.Descripcion AS Equipo, marcas.Descripcion AS Marca, Insul_Cls, Potencia, Rpm, Voltaje, Fs, Eficiencia, Serie, Ip, Frame, tipos_servicios.ts_descripcion AS Tipo_Servicio, 
    forma_pago.Descripcion, encabezado_factura_venta.Dias_Plazo, Prioridad, Garantia, FechaAprobacion, 
    encabezado_factura_venta.Observaciones, Estado_Documento, Tipo_Documento, Contacto_Empresa, 
    Fecha_Documento, Numero_Ingreso, Subtotal, Descuento, Iva, Total
    FROM encabezado_factura_venta, clientes, tipos_equipos, marcas, ciudades, forma_pago, tipos_servicios
    WHERE encabezado_factura_venta.Nit_Cliente=clientes.Nit_Cliente AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad 
    AND Equipo=tipos_equipos.Codigo_Tipo_Equipo AND Marca=marcas.Codigo_Marca 
    AND encabezado_factura_venta.Forma_Pago=forma_pago.Codigo_Forma_Pago AND Tipo_Servicio=tipos_servicios.ts_codigo 
    AND Numero_Documento='".$detalleFVC[0][1]."' AND Tipo_Documento='CTGER' AND encabezado_factura_venta.NIT_Empresa='$nit_sede'";
    $cabeceraCTGER=$objFactura->Consultar($sqlCTGER);

    $sqlParam = "SELECT * FROM parametros_sistema";
    $paramSistem=$objFactura->Consultar($sqlParam);

    if ($cabecera[10] > 0) {
        $pago="Crédito";
    } else {
        $pago="Contado";
    }

    $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
    
    // FECHA DOCUMENTO
    $diaDoc = date("d", strtotime($cabecera[2]));
    $mesDoc = substr($meses[(date("m", strtotime($cabecera[2]))*1)-1], 0, 3);
    $anoDoc = date("y", strtotime($cabecera[2]));
    $fechaDoc = $diaDoc."-".$mesDoc."-".$anoDoc;
    // FIN FECHA DOCUMENTO
    
    // FECHA VENCIMIENTO DEL DOCUMENTO
    $diaVenc = date("d", strtotime(substr($cabecera[2], 0, 10)."+ ".$cabecera[10]." days"));
    $mesVenc = substr($meses[date("m", strtotime(substr($cabecera[2], 0, 10)."+ ".$cabecera[10]." days")*1)-1], 0, 3);
    $anoVenc = date("y", strtotime(substr($cabecera[2], 0, 10)."+ ".$cabecera[10]." days"));
    $fechaVenc = $diaVenc."-".$mesVenc."-".$anoVenc;
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
        <td><b>'.strtoupper($cabecera[4]).'</b></td>
    </tr>

    <tr>
        <td>Nit '.$cabecera[3].'</td>
    </tr>

    <tr>
        <td>'.$cabecera[7].'</td>
    </tr>

    <tr>
        <td>Tel. '.$cabecera[8].' &nbsp;&nbsp;&nbsp; Fax. '.$cabecera[9].'</td>
    </tr>
</table>';

$codigoHTML.='
<table class="table table-borderless" style="font-size: 15px;">
    <tr>
        <td style="width: 28%;"><b>Fecha: '. $fechaDoc .'</b></td>
        <td style="width: 35%;"><b>Vencimiento: '. $fechaVenc .'</b></td>
        <td style="width: 50%;">Condiciones de Pago: '.$pago.' '.$cabecera[10].' días</td>
    </tr>
</table>';

if ($detalleFVC[0][2] != null) {

    $codigoHTML.='<table class="table-borderless pl-2" style="font-size: 13px;">

    <tbody>
        <tr>
            <td>Equipo: '.$ingresos[1].'</td>
        </tr>
    
        <tr>
            <td colspan="2">Marca: '.$ingresos[3].'</td>
            <td>Fases: '.$ingresos[5].'</td>
        </tr>
    
        <tr>
            <td>Potencia: '.$ingresos[6].'</td>
            <td style="width: 30%">Voltaje: '.$ingresos[8].'</td>
            <td>Ingreso: '.$ingresos[0].'</td>
        </tr>
    
        <tr>
            <td>R.P.M: '.$ingresos[7].'</td>
            <td>Serie: '.$ingresos[4].'</td>
            <td>O.S: '.$ingresos[10].'</td>
        </tr>

        <tr>
            <td colspan="2">Cotización: '.$detalleFVC[0][1].'</td>
            <td>O.C: '.$cabecera[20].'</td>
        </tr>

        <tr>
            <td>Ubicación: '.$ingresos[9].'</td>
        </tr>

    </tbody>

</table>';

}else{

foreach($cabeceraCTGER as $cabeceraCT){}

$codigoHTML.='<table class="table-borderless pl-2" style="font-size: 13px;">      


<tr>
    <td>Equipo: '.$cabeceraCT[8].'</td>
    <td>Marca: '.$cabeceraCT[9].'</td>
    <td>Eficiencia: '.$cabeceraCT[15].' %</td>
</tr>

<tr>
    <td>F.S: '.$cabeceraCT[14].'</td>
    <td>Potencia: '.$cabeceraCT[11].'</td>
    <td>O.C: '.$cabecera[20].'</td>
</tr>

<tr>
    <td>Voltaje: '.$cabeceraCT[13].'</td>
    <td>R.P.M: '.$cabeceraCT[12].'</td>
</tr>

<tr>
    <td>Serie: '.$cabeceraCT[16].'</td>
    <td>Insul Cls: '.$cabeceraCT[10].'</td>
</tr>

</table>';
}

$codigoHTML.='<table class="table-borderless pl-2 pt-4" style="font-size: 13px;">
    <tr>
        <td><b>Actividad</b></td>
        <td><b>Detalle</b></td>
        <td class="text-center"><b>Cantidad</b></td>
        <td class="text-right"><b>Valor</b></td>
        <td class="text-right"><b>Subtotal</b></td>
    </tr>';

    $subtotal=0;
    foreach($detalleFVC as $detalle){
    $subtotal=$detalle[8] * $detalle[7];
    $codigoHTML.='<tr>
        <td style="font-size: 10px; width: 30%;">'.strtoupper($detalle[5]).'</td>
        <td style="font-size: 10px; width: 35%;">'.strtoupper(substr($detalle[6], 0, 30)).'</td>
        <td class="text-center">'.$detalle[7].'</td>
        <td class="text-right">'.number_format($detalle[8], 0, ",", ",").'</td>
        <td style="width: 13%;" class="text-right">'.number_format($subtotal, 0, ",", ",").'</td>
    </tr>';
    }

    $codigoHTML.='
</table>';
    $codigoHTML.='<table class="table-borderless" style="padding-top: 80px;">
        <tr>
            <td rowspan="3" style="width: 60%; font-size: 11px;">
                <p class="m-0" style="font-size: 14px;"><b>Valor en Letras:</b></p>
                <p class="m-0" style="font-size: 14px;"><b>'.ucwords(convertir($cabecera[19])) ." Pesos".'</b></p>
                <p class="m-0" style="width: 85%;">
                    He efectuado los aportes a la seguridad social por los ingresos materia de facturación, 
                    El numero o referencia de la planilla en el cual se realizo el pago es el : 
                    La radicacion de esta factura de venta declara haber recibido real y materialmente 
                    la mercancia detallada en el presente documento, en caso de mora se causara 
                    una sanción del 3% mensual
                </p>
            </td>
            <td>
                <p style="font-size: 14px;">Subtotal</p><td>$:</td><td class="text-right"><b>'.number_format($cabecera[16]).'</b></td>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size: 14px;">Iva</p><td>$:</td><td class="text-right"><b>'.number_format($cabecera[18]).'</b></td>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size: 14px;">Total&nbsp;Factura</p><td>$:</td><td class="text-right"><b>'.number_format($cabecera[19]).'</b></td>
            </td>
        </tr>
    </table>';

    $codigoHTML.='<table class="pt-3 pb-3 table-borderless" style="font-size: 14px;">
        <tr>
            <td>Observaciones: '.$cabecera[11].'</td>
        </tr>
    </table>';

    $codigoHTML.='<table class="pt-5 table-borderless" style="font-size: 13px;">
        <tr>
            <td>'.$paramSistem[0]["Resolucion_Dian"].'</td>
        </tr>
        <tr>
            <td>'.$paramSistem[0]["Mensaje4"].'</td>
        </tr>
        <tr>
            <td class="text-center">'.$paramSistem[0]["Mensaje1"].'</td>
        </tr>
        <tr>
            <td class="text-center">'.$paramSistem[0]["Mensaje2"].'</td>
        </tr>
        <tr>
            <td class="text-center">'.$paramSistem[0]["Mensaje3"].'</td>
        </tr>
        <tr>
            <td class="text-center">'.$_GET["circularizacion"].'</td>
        </tr>
    </table>';

    $codigoHTML.='<table class="pt-5 pb-3 table table-borderless" style="font-size: 15px;">
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
$canvas->page_text(128, 40, "Pag: {PAGE_NUM}", $font, 10, array(0,0,0));
$canvas->page_text(500, 40, "No. $cabecera[0]", $font, 14, array(0,0,0));

// Se muestra el PDF y se le asigna el nombre de descarga
$dompdf->stream(
	"Factura de Venta.pdf",
	array(
		"Attachment" => false
	)
);
?>