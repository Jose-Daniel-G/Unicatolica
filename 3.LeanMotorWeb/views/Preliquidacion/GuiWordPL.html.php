<?php
    include_once("../../app/Model/Preliquidacion/PreliquidacionModel.php");
    include_once("../../vendor/sb-admin-2/lib/dompdf/lib/utilities-bootstrap4/bootstrap.php");
    @session_start();

    $objPreliquidacion= new PreliquidacionModel();

    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $base = "http://" . $host . $uri . "/";

    $Numero_Documento=$_GET["numero_doc"];
    $tipo_doc=$_GET["tipo_doc"];
    $nit_sede=$_GET["nit_sede"];
    
    $sqlPL="SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social,Codigo_Planta, Dirigido_A, clientes.Direccion, Telefono1, ciudades.Nombre, 
    encabezado_documento_venta.Dias_Plazo, encabezado_documento_venta.Prioridad, encabezado_documento_venta.Tiempo_Entrega, 
    Garantia, encabezado_documento_venta.Observaciones, Estado_Documento, Tipo_Documento, encabezado_documento_venta.NIT_Empresa, sedes.nombre, 
    Fecha_Documento, encabezado_documento_venta.Cedula_Empleado, Subtotal, encabezado_documento_venta.Numero_Ingreso, Descripcion, Enviado_Para 
    FROM encabezado_documento_venta, clientes, ciudades, sedes, forma_pago, ingreso_equipos 
    WHERE encabezado_documento_venta.Nit_Cliente=clientes.Nit_Cliente AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad 
    AND clientes.Forma_Pago=forma_pago.Codigo_Forma_Pago AND encabezado_documento_venta.Numero_Ingreso=ingreso_equipos.Numero_Ingreso 
    AND Numero_Documento='$Numero_Documento' AND Tipo_Documento='$tipo_doc' AND encabezado_documento_venta.NIT_Empresa='$nit_sede'";				
   
    $cabeceraPL=$objPreliquidacion->Consultar($sqlPL);

    if($cabeceraPL[0]["Codigo_Planta"] <> null){
        $sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente='".$cabeceraPL[0]["Nit_Cliente"]."'";
        $plantas=$objPreliquidacion->Consultar($sqlplanta);
    }
    else{
        $plantas=null;
    }

    foreach($cabeceraPL as $cabecera){}
	
	$sqlIngre="SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie,
						No_Fases, Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio 
                        FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru,
							marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									    AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									    AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									    AND equi.Codigo_Marca=marcas.Codigo_Marca
									    AND equi.Numero_Serie=dequi.Numero_Serie
                                        AND ing.Nit_Empresa='$nit_sede'
                                        AND ing.Numero_Ingreso=" . "'" . $cabeceraPL[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
    $ingresosPL=$objPreliquidacion->Consultar($sqlIngre);

    if ($ingresosPL) {
        if ($ingresosPL[0]["Voltaje"] != "") {
            $Voltaje=$ingresosPL[0]["Voltaje"];
        }else if($ingresosPL[0]["V_Primario"] != ""){
            $Voltaje=$ingresosPL[0]["V_Primario"];
        }else if($ingresosPL[0]["Va"] != ""){
            $Voltaje=$ingresosPL[0]["Va"];
        }else if($ingresosPL[0]["Voltaje"] == "" && $ingresosPL[0]["V_Primario"] == "" && $ingresosPL[0]["Va"] == ""){
            $Voltaje=null;
        }
        if ($ingresosPL[0]["Revoluciones_Por_Minuto"] != "") {
            $Velocidad=$ingresosPL[0]["Revoluciones_Por_Minuto"];
        }else if($ingresosPL[0]["Velocidad_Parte"] != ""){
            $Velocidad=$ingresosPL[0]["Velocidad_Parte"];
        }else if($ingresosPL[0]["Revoluciones_Por_Minuto"] == "" && $ingresosPL[0]["Velocidad_Parte"] == ""){
            $Velocidad=null;
        }
    }
    
    foreach($ingresosPL as $ingresos){}
	
    $sqlPLD="SELECT Aprobado, Codigo_Producto, Descripcion, Detalle, detalle_documento_venta.Cantidad,
					detalle_documento_venta.Valor_Unitario, detalle_documento_venta.Porcentaje_Descuento
                    FROM detalle_documento_venta, productos_servicios 
					WHERE detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
                        AND  Numero_Documento='$Numero_Documento' 
                        AND Tipo_Documento='$tipo_doc'
                        AND Nit_Empresa='$nit_sede'";
    $detallePL=$objPreliquidacion->Consultar($sqlPLD);

    $sqlemp="select ";

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
            ' . $bootstrap_css . '
    <title>Preliquidación</title>
</head>

<body>';


$codigoHTML.='
<p class="font-weight-bold">Fecha Imp: '.$fechaImp.'</p>

<table class="table table table-borderless">

    <thead class="text-center">
        <tr>
            <td>
                <img src="'.$base.'../../public/img/LOGO_LTE.jpg" width="200" height="0">
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


$codigoHTML.='<table class="table table table-borderless">
    <tr>
        <td>Fecha doc: '. str_replace("-", "/", substr($cabecera["Fecha_Documento"], 0,10)) .'</td>
    </tr>

    <tr>
        <th>Preliquidacion FA-02 No: '.$cabecera["Numero_Documento"].'</td>
    </tr>

    <tr>
        <td>Señores:</td>
    </tr>

    <tr>
        <td>'.$cabecera["Razon_Social"].'</td>
    </tr>

    <tr>
        <td>'.$cabecera["Dirigido_A"].'</td>
    </tr>

    <tr>
        <td>'.$cabecera["Direccion"].'</td>
    </tr>

    <tr>
        <td>'.$cabecera["Telefono1"].'</td>
    </tr>

</table>';

$codigoHTML.='<table class="table table table-borderless">

    <tr>
        <th class="text-center" colspan="3" style="padding-bottom: 30px;">Características del Equipo</th>
    </tr>

    <tbody>

        <tr>
            <td>Equipo: '.$ingresos["Equipo"].'</td>
            <td>Marca: '.$ingresos["Marca"].'</td>
            <td>Ubicacion: '.$ingresos["Ubicacion"].'</td>
        </tr>
    
        <tr>
            <td>Fases: '.$ingresos["No_Fases"].'</td>
            <td>Potencia: '.$ingresos["Potencia"].'</td>
        </tr>
    
        <tr>
            <td>Voltaje: '.$Voltaje.'</td>
            <td>R.P.M: '.$Velocidad.'</td>
        </tr>
    
        <tr>
            <td>Ingreso: '.$ingresos["Numero_Ingreso"].'</td>
            <td>Serie: '.$ingresos["Numero_Serie"].'</td>
        </tr>

        <tr>
            <td>Detalle de Equipo: '.$ingresos["Detalle_De_Equipo"].'</td>
        </tr>

    </tbody>

</table>';

$codigoHTML.='<table class="table table table-borderless">
    <tr>
        <th class="text-center" colspan="5" style="padding-bottom: 30px;">Actividades a Realizar</th>
    </tr>

    <tr>
        <td style="font-weight: bold;">Actividad</td>
        <td style="font-weight: bold;">Detalle</td>
        <td class="text-center" style="font-weight: bold;">Cantidad</td>
        <td class="text-right" style="font-weight: bold;">Valor</td>
        <td class="text-right" style="font-weight: bold;">Subtotal</td>
    </tr>';

    $subtotal=0;
    foreach($detallePL as $detalle){
    $subtotal=$detalle["Valor_Unitario"] * $detalle["Cantidad"];
    $codigoHTML.='<tr>
        <td>'.$detalle["Descripcion"].'</td>
        <td>'.$detalle["Detalle"].'</td>
        <td class="text-center">'.$detalle[4].'</td>
        <td class="text-right">'.number_format($detalle["Valor_Unitario"], 0, ",", ",").'</td>
        <td class="text-right">'.number_format($subtotal, 0, ",", ",").'</td>
    </tr>';
    }

    $codigoHTML.='
</table>';

$codigoHTML.='<table class="table table table-borderless">
    <tr style="padding-top: 60px;">
        <td>Tiempo de Entrega: <span class="font-weight-bold">'.$cabecera["Tiempo_Entrega"].' Días</span></td>
    </tr>
    <tr>
        <td>Observaciones: <span class="font-weight-bold">'.$cabecera["Observaciones"].'</span></td>
    </tr>
</table>';

$codigoHTML.='<table>
    <tr style="padding-top: 30px;">
        <td>* No se da garantía sobre trabajos de mmto. a devanados de motores AC y/o DC</td>
    </tr>

    <tr>
        <td>* No otorgamos garantía por rodamiento y respuestos</td>
    </tr>

    <tr>
        <td>* En caso de que el núcleo estator presente daño en sus laminaciones, la reparación tendrá un valor
            adicional</td>
    </tr>

    <tr>
        <td>No se da garantía por intervención del equipo por personal no autorizado</td>
    </tr>

    <tr>
        <td>* Repuestos Sujetos a Venta Previa</td>
    </tr>

</table>';

$codigoHTML.='

</body>

</html>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=PreliquidacionFA-02.pdf.doc");
    ?>

    <?=$codigoHTML;?>
    