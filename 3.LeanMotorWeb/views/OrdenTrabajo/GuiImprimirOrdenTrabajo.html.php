    <?php
    include_once("../../vendor/sb-admin-2/lib/dompdf/dompdf_config.inc.php");
    include_once("../../app/Model/OrdenTrabajo/OrdenTrabajoModel.php");
    @session_start();

    $objOrdenTrabajo= new OrdenTrabajoModel(); 

    $Numero_Orden=$_GET["numero_doc"];
    $nit_sede=$_GET["nit_sede"];

    $sqlOrdenTrabajo="SELECT orden.Numero_Ingreso, orden.Numero_Orden, cli.Razon_Social, equi.Nit_Cliente,
    cli.Direccion, cli.Telefono1, DATE_FORMAT(orden.Fecha_Creada, '%Y-%m-%d') AS Fecha_Creada, 
    orden.Nit_Empresa, orden.Estado FROM orden_trabajo AS orden, ingreso_equipos AS ing, 
    equipos AS equi, clientes AS cli WHERE ing.Numero_Serie=equi.Numero_Serie AND equi.Nit_Cliente=cli.Nit_Cliente 
    AND orden.Numero_Ingreso=ing.Numero_Ingreso AND ing.Numero_Serie=equi.Numero_Serie
    AND orden.Nit_Empresa=cli.Nit_Empresa AND orden.Numero_Orden = '$Numero_Orden' AND orden.Nit_Empresa = '$nit_sede'
    ORDER BY orden.Fecha_Creada, orden.Numero_Orden DESC";
    $ordenTrabajo = $objOrdenTrabajo->Consultar($sqlOrdenTrabajo);

    foreach($ordenTrabajo as $orden){}
	
    $sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, equi.Nit_Cliente, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie,
        No_Fases, Frame, Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio, Requisitos_Cliente
            FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru,
            marcas, detalle_equipo AS dequi
                WHERE ing.Numero_Serie=equi.Numero_Serie
                    AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
                    AND tequi.Codigo_Grupo=gru.Codigo_Grupo
                    AND equi.Codigo_Marca=marcas.Codigo_Marca
                    AND equi.Numero_Serie=dequi.Numero_Serie
                    AND ing.Numero_Ingreso=" . "'" . $orden["Numero_Ingreso"] . "'" . " LIMIT 1";
    $ingresoOrden = $objOrdenTrabajo->Consultar($sqlIngre);

    if ($ingresoOrden) {
        if ($ingresoOrden[0]["Voltaje"] != "") {
            $Voltaje=$ingresoOrden[0]["Voltaje"];
        }else if($ingresoOrden[0]["V_Primario"] != ""){
            $Voltaje=$ingresoOrden[0]["V_Primario"];
        }else if($ingresoOrden[0]["Va"] != ""){
            $Voltaje=$ingresoOrden[0]["Va"];
        }else if($ingresoOrden[0]["Voltaje"] == "" && $ingresoOrden[0]["V_Primario"] == "" && $ingresoOrden[0]["Va"] == ""){
            $Voltaje=null;
        }
        if ($ingresoOrden[0]["Revoluciones_Por_Minuto"] != "") {
            $Velocidad=$ingresoOrden[0]["Revoluciones_Por_Minuto"];
        }else if($ingresoOrden[0]["Velocidad_Parte"] != ""){
            $Velocidad=$ingresoOrden[0]["Velocidad_Parte"];
        }else if($ingresoOrden[0]["Revoluciones_Por_Minuto"] == "" && $ingresoOrden[0]["Velocidad_Parte"] == ""){
            $Velocidad=null;
        }
    }
    
    foreach($ingresoOrden as $ingreso){}
    
    $sqlDetalleOrden="SELECT detalle_orden_trabajo.Codigo_Actividad, productos_servicios.Descripcion AS Actividad, 
    detalle_orden_trabajo.Detalle_Actividad, detalle_orden_trabajo.Cantidad FROM detalle_orden_trabajo, productos_servicios 
    WHERE detalle_orden_trabajo.Codigo_Actividad=productos_servicios.Codigo 
    AND detalle_orden_trabajo.Numero_Orden = '$Numero_Orden' AND Nit_Empresa= '$nit_sede' ";
    $DetalleOrden = $objOrdenTrabajo->Consultar($sqlDetalleOrden);


    if ($orden["Numero_Ingreso"] != "") {
        $sqldetalle = "SELECT encabezado_cotizacion_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, detalle_cotizacion_venta.Cantidad,detalle_cotizacion_venta.Valor_Unitario,
                            detalle_cotizacion_venta.Porcentaje_Descuento, Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva, Prioridad
                                FROM detalle_cotizacion_venta, productos_servicios, encabezado_cotizacion_venta
                                    WHERE encabezado_cotizacion_venta.Numero_Documento=detalle_cotizacion_venta.Numero_Documento
                                        AND encabezado_cotizacion_venta.Tipo_Documento=detalle_cotizacion_venta.Tipo_Documento
                                        AND encabezado_cotizacion_venta.NIT_Empresa=detalle_cotizacion_venta.NIT_Empresa
                                        AND detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
                                        AND encabezado_cotizacion_venta.Numero_Documento=
                                        (SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_cotizacion_venta 
                                        WHERE Numero_Ingreso = " . "'" . $orden["Numero_Ingreso"] . "'" . " AND Estado_Documento = 'A') 
                                        AND encabezado_cotizacion_venta.Tipo_Documento='CT' 
                                        AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' 
                                        AND encabezado_cotizacion_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
        $DetalleCT = $objOrdenTrabajo->Consultar($sqldetalle);

        if ($DetalleCT == null) {
            $sqldetalle = "SELECT encabezado_documento_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle, detalle_documento_venta.Cantidad,detalle_documento_venta.Valor_Unitario,
                            detalle_documento_venta.Porcentaje_Descuento, Valor_Iva, detalle_documento_venta.Porcentaje_Iva, Prioridad
                                FROM detalle_documento_venta, productos_servicios, encabezado_documento_venta
                                    WHERE encabezado_documento_venta.Numero_Documento=detalle_documento_venta.Numero_Documento
                                        AND encabezado_documento_venta.Tipo_Documento=detalle_documento_venta.Tipo_Documento
                                        AND encabezado_documento_venta.NIT_Empresa=detalle_documento_venta.NIT_Empresa
                                        AND detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
                                        AND encabezado_documento_venta.Numero_Documento=
                                        (SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_documento_venta 
                                        WHERE Numero_Ingreso = " . "'" . $orden["Numero_Ingreso"] . "'" . " AND Estado_Documento = 'A') 
                                        AND encabezado_documento_venta.Tipo_Documento='PL' 
                                        AND encabezado_documento_venta.NIT_Empresa='$nit_sede' 
                                        AND encabezado_documento_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
            $DetallePL = $objOrdenTrabajo->Consultar($sqldetalle);
            $Detalle=$DetallePL;
        }else{
            $Detalle=$DetalleCT;
        }
    } else {
        $Detalle = null;
    }

    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

    // FECHA LIMITE DE ENTREGA
    $diaSemana = $dias[date("w", strtotime(substr($orden["Fecha_Creada"], 0, 10)."+ ".$Detalle[0]["Prioridad"]." days" . "-" . 1 . "days"))];
    $dia = date("d", strtotime(substr($orden["Fecha_Creada"], 0, 10)."+ ".$Detalle[0]["Prioridad"]." days" . "-" . 1 . "days"));
    $mes = $meses[date("m", strtotime(substr($orden["Fecha_Creada"], 0, 10)."+ ".$Detalle[0]["Prioridad"]." days" . "-" . 1 . "days")*1)-1];
    $ano = date("Y", strtotime(substr($orden["Fecha_Creada"], 0, 10)."+ ".$Detalle[0]["Prioridad"]." days" . "-" . 1 . "days"));
    $fechaEntrega = $diaSemana.", ".$dia." de ".$mes." de ".$ano;
    // FIN FECHA LIMITE DE ENTREGA

    date_default_timezone_set('America/Bogota');
    $fechaImp = date("Y/m/d - h:i a");

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
    <title>Orden de Trabajo</title>
</head>

<body>';


$codigoHTML.='
<p class="font-weight-bold">Fecha Imp: '.$fechaImp.'</p>

<table class="table-borderless" width="100%;">

    <thead class="text-center">
        <tr>
            <td>
                <img src="../../public/img/LOGO_LTE.jpg" width="120" height="0">
            </td>
        </tr>

        <tr>
            <td>LABORATORIO TECNO-ELÉCTRICO S.A.S</td>
        </tr>

        <tr>
            <td>CL 13 A No. 8 A - 151</td>
        </tr>

        <tr>
            <td>PBX (57) 2 4481234 Fax</td>
        </tr>

        <tr>
            <td style="font-size: 14px;">Email:
                servicioalcliente@lte-sas.com</td>
        </tr>

        <tr>
            <td>Cali - Colombia</td>
        </tr>
    </thead>

</table>';


$codigoHTML.='<table class="table-borderless" width="100%;">
    <tr>
        <td>Fecha doc: '. str_replace("-", "/", substr($orden["Fecha_Creada"], 0,10)) .'</td>
    </tr>

    <tr>
        <th>Orden de Trabajo FM-03 No: '.$orden["Numero_Orden"].'</td>
    </tr>

    <tr>
        <td>Señores:</td>
    </tr>

    <tr>
        <td>'.$orden["Razon_Social"].'</td>
    </tr>

    <tr>
        <td>'.$orden["Direccion"].'</td>
    </tr>

    <tr>
        <td>'.$orden["Telefono1"].'</td>
    </tr>

</table>';

$codigoHTML.='<table class="table-borderless" width="100%;">

    <tr>
        <th class="text-center pb-4" colspan="3">Características del Equipo</th>
    </tr>

    <tbody>

        <tr>
            <td>Equipo: '.$ingreso["Equipo"].'</td>
            <td>Marca: '.$ingreso["Marca"].'</td>
            <td>Ubicacion: '.$ingreso["Ubicacion"].'</td>
        </tr>
    
        <tr>
            <td>Fases: '.$ingreso["No_Fases"].'</td>
            <td>Potencia: '.$ingreso["Potencia"].'</td>
        </tr>
    
        <tr>
            <td>Voltaje: '.$Voltaje.'</td>
            <td>R.P.M: '.$Velocidad.'</td>
        </tr>
    
        <tr>
            <td>Ingreso: '.$ingreso["Numero_Ingreso"].'</td>
            <td>Serie: '.$ingreso["Numero_Serie"].'</td>
        </tr>

        <tr>
            <td>Detalle de Equipo: '.$ingreso["Detalle_De_Equipo"].'</td>
        </tr>

    </tbody>

</table>';

$codigoHTML.='<table class="table-borderless" width="100%;">
    <tr>
        <th class="pb-4 text-center" colspan="3">Actividades a Realizar</th>
    </tr>

    <tr>
        <td class="font-weight-bold">Actividad</td>
        <td class="font-weight-bold">Detalle</td>
        <td class="text-center font-weight-bold">Cantidad</td>
    </tr>';

    

    foreach($DetalleOrden as $detalle){
    $codigoHTML.='<tr>
        <td>'.$detalle["Actividad"].'</td>
        <td>'.$detalle["Detalle_Actividad"].'</td>
        <td class="text-center">'.$detalle["Cantidad"].'</td>
    </tr>';
    }

    $codigoHTML.='
</table>';

$codigoHTML.='<table class="pt-4 table-borderless" width="100%;">
    <tr>
        <td class="font-weight-bold">Fecha límite de entrega '.$fechaEntrega.'</span></td>
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

// Se muestra el PDF y se le asigna el nombre de descarga
$dompdf->stream(
	"OrdenTrabajoFM-03.pdf",
	array(
		"Attachment" => false
	)
);
?>