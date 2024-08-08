<?php
    include_once "../../app/Model/Cotizaciones/CotizacionesModel.php";
    include_once "../../vendor/sb-admin-2/lib/dompdf/lib/utilities-bootstrap4/bootstrap.php";
    include_once "../../app/Lib/helpers.php";
    @session_start();

    $objFactura = new CotizacionesModel();

    $Numero_Documento=$_GET['numero_doc'];
    $tipo_doc=$_GET['tipo_doc'];
    $nit_sede=$_GET['nit_sede'];

    $sqlFVC="SELECT edv.Numero_Documento, ddv.Numero_Ingreso, DATE_FORMAT(edv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, 
                        cli.Nit_Cliente, cli.Razon_Social, edv.Dirigido_A, edv.Codigo_Planta, cli.Direccion, cli.Telefono1, cli.Telefono2, edv.Dias_Plazo, 
                        edv.Observaciones, edv.Estado_Documento, edv.Nit_Empresa, sede.nombre AS Sede, edv.Cedula_Empleado, edv.Subtotal, edv.Descuento, 
                        edv.Iva, edv.Total, edv.Orden_Compra, ddv.Numero_Cotizacion 
                        FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv, clientes AS cli, sedes AS sede 
                        WHERE ddv.Numero_Documento = edv.Numero_Documento AND ddv.NIT_Empresa = edv.NIT_Empresa 
                        AND edv.NIT_Empresa=cli.Nit_Empresa AND edv.Nit_Cliente=cli.Nit_Cliente AND edv.Nit_Empresa=sede.nit_empresa 
                        AND edv.Numero_Documento='$Numero_Documento' AND edv.Tipo_Documento = '$tipo_doc' AND edv.NIT_Empresa = '$nit_sede' 
                        GROUP BY ddv.Numero_Documento DESC, ddv.Numero_Ingreso";
    $cabeceraFVC=$objFactura->Consultar($sqlFVC);

    $sqlDetalle = "SELECT Numero_Registro, Numero_Cotizacion, Numero_Ingreso, Aprobado, Codigo_Producto, productos_servicios.Descripcion, 
    detalle_factura_venta.Detalle, detalle_factura_venta.Cantidad, detalle_factura_venta.Valor_Unitario,
    detalle_factura_venta.Porcentaje_Descuento, Valor_Iva, detalle_factura_venta.Porcentaje_Iva
    FROM detalle_factura_venta, productos_servicios WHERE detalle_factura_venta.Codigo_Producto=productos_servicios.Codigo
        AND  Numero_Documento='$Numero_Documento' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ORDER BY Numero_Registro ASC";
    $detalleFVC = $objFactura->Consultar($sqlDetalle);

    if ($cabeceraFVC[0]["Codigo_Planta"] != null) {
        $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraFVC[0]["Nit_Cliente"] . "'" . "";
        $plantas = $objFactura->Consultar($sqlplanta);
    } else {
        $plantas = null;
    }

    $sqlParam = "SELECT * FROM parametros_sistema WHERE NIT_Empresa = '$nit_sede'";
    $paramSistem=$objFactura->Consultar($sqlParam);

    if ($cabeceraFVC[0]["Diaz_Plazo"] > 0) {
        $pago="Crédito";
    } else {
        $pago="Contado";
    }

    $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
    
    // FECHA DOCUMENTO
    $diaDoc = date("d", strtotime($cabeceraFVC[0]["Fecha_Documento"]));
    $mesDoc = substr($meses[(date("m", strtotime($cabeceraFVC[0]["Fecha_Documento"]))*1)-1], 0, 3);
    $anoDoc = date("y", strtotime($cabeceraFVC[0]["Fecha_Documento"]));
    $fechaDoc = $diaDoc."-".$mesDoc."-".$anoDoc;
    // FIN FECHA DOCUMENTO
    
    // FECHA VENCIMIENTO DEL DOCUMENTO
    $diaVenc = date("d", strtotime(substr($cabeceraFVC[0]["Fecha_Documento"], 0, 10)."+ ".$cabeceraFVC[0]["Diaz_Plazo"]." days"));
    $mesVenc = substr($meses[date("m", strtotime(substr($cabeceraFVC[0]["Fecha_Documento"], 0, 10)."+ ".$cabeceraFVC[0]["Diaz_Plazo"]." days")*1)-1], 0, 3);
    $anoVenc = date("y", strtotime(substr($cabeceraFVC[0]["Fecha_Documento"], 0, 10)."+ ".$cabeceraFVC[0]["Diaz_Plazo"]." days"));
    $fechaVenc = $diaVenc."-".$mesVenc."-".$anoVenc;
    // FIN FECHA VENCIMIENTO

$codigoHTML = '
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap Core CSS -->
        ' . $bootstrap_css . '
    <title>Factura</title>
</head>

<body>';

$codigoHTML.='
<table class="table-borderless pl-2" style="line-height: 13px; font-size: 14px;">
    <tr>
        <td>Señores:</td>
    </tr>

    <tr style="padding-top: 20px;">
        <td><b>'.strtoupper($cabeceraFVC[0]["Razon_Social"]).'</b></td>
    </tr>

    <tr style="padding-top: 20px;">
        <td>Nit '.$cabeceraFVC[0]["Nit_Cliente"].'</td>
    </tr>

    <tr style="padding-top: 20px;">
        <td>'.$cabeceraFVC[0]["Direccion"].'</td>
    </tr>

    <tr style="padding-top: 20px;">
        <td>Tel 1. '.$cabeceraFVC[0]["Telefono1"].' &nbsp;&nbsp;&nbsp; Tel 2. '.$cabeceraFVC[0]["Telefono2"].'</td>
    </tr>
</table>';

$codigoHTML.='
<table class="table table-borderless" style="font-size: 15px;">
    <tr style="padding-bottom: 20px;">
        <td class="font-weight-bold" style="width: 28%;">Fecha: ' . $fechaDoc . '</td>
        <td class="font-weight-bold" style="width: 38%;">Vencimiento: ' . $fechaVenc . '</td>
        <td style="width: 50%;">Condiciones de Pago: '.$pago.' '.$cabeceraFVC[0]["Dias_Plazo"].' días</td>
    </tr>
</table>';

        $subtotal=0;
        $cont=0;

        foreach($cabeceraFVC as $cabecera){
            if ($cabecera["Numero_Ingreso"] != null) {

                $sqlIngre="SELECT Numero_Ingreso, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie,
                No_fases, CONCAT(Potencia,' - ', Unidad_De_Potencia) AS Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, 
                Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru, marcas, detalle_equipo AS dequi
                WHERE ing.Numero_Serie=equi.Numero_Serie
                AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
                AND tequi.Codigo_Grupo=gru.Codigo_Grupo
                AND equi.Codigo_Marca=marcas.Codigo_Marca
                AND equi.Numero_Serie=dequi.Numero_Serie
                AND ing.Numero_Ingreso=" . "'" . $cabecera["Numero_Ingreso"] . "'" . " LIMIT 1";
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
                    <table class="table table-borderless pl-2" style="font-size: 13px;">
                        <tbody>';

                foreach($ingresosFVC as $ingresos){
                    $codigoHTML.='
                        <tr>
                            <td style="padding-bottom: 15px;"></td>
                        </tr>
                        
                        <tr style="padding-top: 20px;">
                            <td>Equipo: '.$ingresos["Equipo"].'</td>
                        </tr>
                    
                        <tr style="padding-top: 20px;">
                            <td colspan="2">Marca: '.$ingresos["Marca"].'</td>
                            <td>Fases: '.$ingresos["No_Fases"].'</td>
                        </tr>
                    
                        <tr style="padding-top: 20px;">
                            <td>Potencia: '.$ingresos["Potencia"].'</td>
                            <td style="width: 30%">Voltaje: '.$Voltaje.'</td>
                            <td>Ingreso: '.$ingresos["Numero_Ingreso"].'</td>
                        </tr>
                    
                        <tr style="padding-top: 20px;">
                            <td>R.P.M: '.$Velocidad.'</td>
                            <td>Serie: '.$ingresos["Numero_Serie"].'</td>
                            <td>O.S: '.$ingresos["Orden_Compra"].'</td>
                        </tr>

                        <tr style="padding-top: 20px;">
                            <td colspan="2">Cotización: '.$detalleFVC[0]["Numero_Cotizacion"].'</td>
                            <td>O.C: '.$cabecera["Orden_Compra"].'</td>
                        </tr>

                        <tr style="padding-top: 20px;">
                            <td>Ubicación: '.$ingresos["Ubicacion"].'</td>
                        </tr>';
                    }
                    $codigoHTML.='</tbody></table>';

                    $codigoHTML.='
                    <table class="table-borderless pl-2 pt-4" style="font-size: 13px;">
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
                    if ($cont==0) {
                        $codigoHTML.='
                        <table class="table-borderless pl-2">
                            <tr>
                                <td rowspan="3" style="width: 60%; font-size: 11px;">
                                    <p class="m-0" style="font-size: 14px;"><b>Valor en Letras:</b></p>
                                    <p class="m-0" style="font-size: 14px;"><b>'.ucwords(convertir($cabecera["Total"])) ." Pesos".'</b></p>
                                    <p class="m-0" style="width: 85%;">
                                        He efectuado los aportes a la seguridad social por los ingresos materia de facturación, 
                                        El numero o referencia de la planilla en el cual se realizo el pago es el : 
                                        La radicacion de esta factura de venta declara haber recibido real y materialmente 
                                        la mercancia detallada en el presente documento, en caso de mora se causara 
                                        una sanción del 3% mensual
                                    </p>
                                </td>
                                <td>
                                    <p style="font-size: 14px;">Subtotal</p><td>$:</td><td class="text-right"><b>'.number_format($cabecera["Subtotal"]).'</b></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size: 14px;">Iva</p><td>$:</td><td class="text-right"><b>'.number_format($cabecera["Iva"]).'</b></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size: 14px;">Total&nbsp;Factura</p><td>$:</td><td class="text-right"><b>'.number_format($cabecera["Total"]).'</b></td>
                                </td>
                            </tr>
                        </table>';

                    $codigoHTML.='
                    <table class="pl-2 table-borderless" style="font-size: 12px;">
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

                    $codigoHTML.='
                    <table class="pl-2 table table-borderless" style="font-size: 13px;">
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
                    $cont++;
                }else{
                    $sqlCTGER="SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, encabezado_factura_venta.Codigo_Planta, Dirigido_A, Direccion, Telefono1, 
                    ciudades.Nombre, tipos_equipos.Descripcion AS Equipo, marcas.Descripcion AS Marca, Insul_Cls, Potencia, Rpm, Voltaje, Fs, Eficiencia, Serie, Ip, Frame, tipos_servicios.ts_descripcion AS Tipo_Servicio, 
                    forma_pago.Descripcion, encabezado_factura_venta.Dias_Plazo, Prioridad, Garantia, FechaAprobacion, 
                    encabezado_factura_venta.Observaciones, Estado_Documento, Tipo_Documento, Contacto_Empresa, 
                    Fecha_Documento, Numero_Ingreso, Subtotal, Descuento, Iva, Total, encabezado_factura_venta.Orden_Compra 
                    FROM encabezado_factura_venta, clientes, tipos_equipos, marcas, ciudades, forma_pago, tipos_servicios
                    WHERE encabezado_factura_venta.Nit_Cliente=clientes.Nit_Cliente AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad 
                    AND Equipo=tipos_equipos.Codigo_Tipo_Equipo AND Marca=marcas.Codigo_Marca 
                    AND encabezado_factura_venta.Forma_Pago=forma_pago.Codigo_Forma_Pago AND Tipo_Servicio=tipos_servicios.ts_codigo 
                    AND Numero_Documento=" . "'" . $cabecera["Numero_Cotizacion"] . "'" . " AND Tipo_Documento='CTGER' AND encabezado_factura_venta.NIT_Empresa='$nit_sede'";
                    $cabeceraCTGER=$objFactura->Consultar($sqlCTGER);
            
                    $cont=0;
            
                    $codigoHTML.='
                    <table class="table-borderless pl-2" style="font-size: 13px;">
                        <tbody>';
                    foreach($cabeceraCTGER as $cabecera){
                        $codigoHTML.='
                            <tr style="padding-top: 20px;">
                                <td>Equipo: '.$cabecera["Equipo"].'</td>
                                <td>Marca: '.$cabecera["Marca"].'</td>
                                <td>Eficiencia: '.$cabecera["Eficiencia"].' %</td>
                            </tr>
                    
                            <tr style="padding-top: 20px;">
                                <td>F.S: '.$cabecera["Fs"].'</td>
                                <td>Potencia: '.$cabecera["Potencia"].'</td>
                                <td>O.C: '.$cabecera["Orden_Compra"].'</td>
                            </tr>
                        
                            <tr style="padding-top: 20px;">
                                <td>Voltaje: '.$cabecera["Voltaje"].'</td>
                                <td>R.P.M: '.$cabecera["Revoluciones_Por_Minuto"].'</td>
                            </tr>
                        
                            <tr style="padding-top: 20px;">
                                <td>Serie: '.$cabecera["Numero_Serie"].'</td>
                                <td>Insul Cls: '.$cabecera["Insul_Cls"].'</td>
                            </tr>';
                    $codigoHTML.='</tbody></table>';
            
                    $codigoHTML.='
                    <table class="table-borderless pl-2 pt-4" style="font-size: 13px;">
                        <tbody>
                            <tr style="padding-top: 30px;">
                                <td><b>Actividad</b></td>
                                <td><b>Detalle</b></td>
                                <td class="text-center"><b>Cantidad</b></td>
                                <td class="text-right"><b>Valor</b></td>
                                <td class="text-right"><b>Subtotal</b></td>
                            </tr>';
                    foreach($detalleFVC as $detalle){
                        $subtotal=$detalle["Valor_Unitario"] * $detalle["Cantidad"];
                        $codigoHTML.='
                            <tr style="padding-top: 20px;">
                                <td style="font-size: 10px; width: 30%;">'.strtoupper($detalle["Descripcion"]).'</td>
                                <td style="font-size: 10px; width: 35%;">'.strtoupper(substr($detalle["Detalle"], 0, 30)).'</td>
                                <td class="text-center">'.$detalle["Cantidad"].'</td>
                                <td class="text-right">'.number_format($detalle["Valor_Unitario"], 0, ",", ",").'</td>
                                <td style="width: 13%;" class="text-right">'.number_format($subtotal, 0, ",", ",").'</td>
                            </tr>';
                    }
                    $codigoHTML.='</tbody></table>';
                    if ($cont==0) {
                        $codigoHTML.='
                        <table class="table-borderless pl-2" style="padding-top: 50px;">
                            <tr>
                                <td rowspan="3" style="width: 60%; font-size: 11px;">
                                    <p class="m-0" style="font-size: 14px;"><b>Valor en Letras:</b></p>
                                    <p class="m-0" style="font-size: 14px;"><b>'.ucwords(convertir($cabecera["Total"])) ." Pesos".'</b></p>
                                    <p class="m-0" style="width: 85%;">
                                        He efectuado los aportes a la seguridad social por los ingresos materia de facturación, 
                                        El numero o referencia de la planilla en el cual se realizo el pago es el : 
                                        La radicacion de esta factura de venta declara haber recibido real y materialmente 
                                        la mercancia detallada en el presente documento, en caso de mora se causara 
                                        una sanción del 3% mensual
                                    </p>
                                </td>
                                <td>
                                    <p style="font-size: 14px;">Subtotal</p><td>$:</td><td style="text-align: right; font-weight: bold;"><b>'.number_format($cabecera["Subtotal"]).'</b></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size: 14px;">Iva</p><td>$:</td><td style="text-align: right; font-weight: bold;"><b>'.number_format($cabecera["Iva"]).'</b></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size: 14px;">Total&nbsp;Factura</p><td>$:</td><td style="text-align: right; font-weight: bold;"><b>'.number_format($cabecera["Total"]).'</b></td>
                                </td>
                            </tr>
                        </table>';
            
                    $codigoHTML.='
                    <table class="pl-2 table-borderless" style="font-size: 12px;">
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
            
                    $codigoHTML.='
                    <table class="pl-2 table table-borderless" style="font-size: 13px; padding-top: 60px;">
                        <tr>
                            <td class="text-left">
                                <p><hr style="max-width: 200px; margin: 0px;"></p>
                                <p style="margin-left: 15%;">Entregado por</p>
                            </td>
                            <td class="text-right">
                                <p><hr style="max-width: 200px; margin-left: 40%;"></p>
                                <p>Firma sello Nit C.C. Cliente</p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table>';
                    $cont++;
                    }
                }
            }
        }
    }
    $codigoHTML.='
    <table class="pb-3 pl-2 table-borderless" style="padding-top: 60px; font-size: 14px;">
        <tr>
            <td>Observaciones: '.$cabecera["Observaciones"].'</td>
        </tr>
    </table>';

$codigoHTML .= '

</body>

</html>';

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Factura de Venta.doc");
?>

<?=$codigoHTML;?>