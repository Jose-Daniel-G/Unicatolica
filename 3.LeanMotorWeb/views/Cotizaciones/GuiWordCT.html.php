<?php
    include_once("../../app/Model/Cotizaciones/CotizacionesModel.php");
    include_once("../../vendor/sb-admin-2/lib/dompdf/lib/utilities-bootstrap4/bootstrap.php");
    @session_start();
    $objCotizacion= new CotizacionesModel();

    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $base = "http://" . $host . $uri . "/";

    $Numero_Documento=$_GET["numero_doc"];
    $tipo_doc=$_GET["tipo_doc"];
    $nit_sede=$_GET["nit_sede"];
    
    $sqlCT="SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, encabezado_cotizacion_venta.Codigo_Planta, Dirigido_A, Direccion, Telefono1, 
    ciudades.Nombre, tipos_equipos.Descripcion AS Equipo, marcas.Descripcion AS Marca, Insul_Cls, Potencia, Rpm, Voltaje, Fs, Eficiencia, Serie, Ip, Frame, tipos_servicios.ts_descripcion AS Tipo_Servicio, 
    forma_pago.Descripcion AS Forma_Pago, encabezado_cotizacion_venta.Dias_Plazo, Prioridad, Garantia, FechaAprobacion, 
    encabezado_cotizacion_venta.Observaciones, Estado_Documento, Tipo_Documento, Contacto_Empresa, 
    Fecha_Documento, Numero_Ingreso, Subtotal, Descuento, Iva, Total
    FROM encabezado_cotizacion_venta, clientes, tipos_equipos, marcas, ciudades, forma_pago, tipos_servicios
    WHERE encabezado_cotizacion_venta.Nit_Cliente=clientes.Nit_Cliente 
    AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad AND Equipo=tipos_equipos.Codigo_Tipo_Equipo 
    AND Marca=marcas.Codigo_Marca AND encabezado_cotizacion_venta.Forma_Pago=forma_pago.Codigo_Forma_Pago 
    AND Tipo_Servicio=tipos_servicios.ts_codigo AND Numero_Documento='$Numero_Documento' 
    AND Tipo_Documento='$tipo_doc' AND encabezado_cotizacion_venta.Nit_Empresa='$nit_sede'";
   
    $cabeceraCT=$objCotizacion->Consultar($sqlCT);

    if($cabeceraCT[0]["Codigo_Planta"] <> null){
        $sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente='".$cabeceraCT[0]["Nit_Cliente"]."'";
        $plantas=$objCotizacion->Consultar($sqlplanta);
    }
    else{
        $plantas=null;
    }

    foreach($cabeceraCT as $cabecera){}

    $sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, 
    ing.Numero_Serie, No_Fases, Frame, Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio 
    FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
        WHERE ing.Numero_Serie=equi.Numero_Serie
            AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
            AND tequi.Codigo_Grupo=gru.Codigo_Grupo
            AND equi.Codigo_Marca=marcas.Codigo_Marca
            AND equi.Numero_Serie=dequi.Numero_Serie
            AND ing.Numero_Ingreso=" . "'" . $cabeceraCT[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
    $ingresosCT = $objCotizacion->Consultar($sqlIngre);

    if ($ingresosCT) {
        if ($ingresosCT[0]["Voltaje"] != "") {
            $Voltaje=$ingresosCT[0]["Voltaje"];
        }else if($ingresosCT[0]["V_Primario"] != ""){
            $Voltaje=$ingresosCT[0]["V_Primario"];
        }else if($ingresosCT[0]["Va"] != ""){
            $Voltaje=$ingresosCT[0]["Va"];
        }else if($ingresosCT[0]["Voltaje"] == "" && $ingresosCT[0]["V_Primario"] == "" && $ingresosCT[0]["Va"] == ""){
            $Voltaje=null;
        }
        if ($ingresosCT[0]["Revoluciones_Por_Minuto"] != "") {
            $Velocidad=$ingresosCT[0]["Revoluciones_Por_Minuto"];
        }else if($ingresosCT[0]["Velocidad_Parte"] != ""){
            $Velocidad=$ingresosCT[0]["Velocidad_Parte"];
        }else if($ingresosCT[0]["Revoluciones_Por_Minuto"] == "" && $ingresosCT[0]["Velocidad_Parte"] == ""){
            $Velocidad=null;
        }
    }

    foreach($ingresosCT as $ingresos){}
    
    $sqlCTD="SELECT Aprobado, Codigo_Producto, Descripcion, Detalle, detalle_cotizacion_venta.Cantidad,detalle_cotizacion_venta.Valor_Unitario, detalle_cotizacion_venta.Porcentaje_Descuento
                    FROM detalle_cotizacion_venta, productos_servicios WHERE detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
                        AND Numero_Documento='$Numero_Documento' AND Tipo_Documento='$tipo_doc' AND Nit_Empresa='$nit_sede'";
    $detalleCT=$objCotizacion->Consultar($sqlCTD);

    $sqlemp="select ";

    date_default_timezone_set('America/Bogota');
    $fechaImp = date("Y/m/d - h:i a");

    if ($tipo_doc == "CT") {
        $title = "Cotización";
    }else if($tipo_doc == "CTGER"){
        $title = "Cotización GER";
    }

    $codigoHTML='
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap Core CSS -->
                ' . $bootstrap_css . '
        <title>' . $title . '</title>
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

    if ($tipo_doc == "CT") {
        $cotizacion = "Cotización No:";
    }else if($tipo_doc == "CTGER"){
        $cotizacion = "Cotización GER No:";
    }

    $codigoHTML.='<table class="table table table-borderless">
                    <tr>
                        <td>Fecha doc: '. str_replace("-", "/", substr($cabecera["Fecha_Documento"], 0,10)) .'</td>
                    </tr>

                    <tr>
                        <th>' . $cotizacion . ' '.$cabecera["Numero_Documento"].'</td>
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

                if ($tipo_doc == "CT") {

                $codigoHTML.='<table class="table table table-borderless">

                <tr style="padding-bottom: 20px;">
                    <th class="text-center" colspan="3">Características del Equipo</th>
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
        }else if($tipo_doc == "CTGER"){
            $codigoHTML.='<table class="table table table-borderless">      

            <tr>
                <th class="text-center" colspan="3" style="padding-bottom: 30px;">Características del Equipo</t>
            </tr>

            <tr>
                <td>Equipo: '.$cabecera["Equipo"].'</td>
                <td>Marca: '.$cabecera["Marca"].'</td>
                <td>Eficiencia: '.$cabecera["Eficiencia"].' %</td>
            </tr>

            <tr>
                <td>F.S: '.$cabecera["Fs"].'</td>
                <td>Potencia: '.$cabecera["Potencia"].'</td>
            </tr>

            <tr>
                <td>Voltaje: '.$cabecera["Voltaje"].'</td>
                <td>R.P.M: '.$cabecera["Rpm"].'</td>
            </tr>

            <tr>
                <td>Serie: '.$cabecera["Serie"].'</td>
                <td>Insul Cls: '.$cabecera["Insul_Cls"].'</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>

        </table>';
        }

        $codigoHTML.='<table class="table table table-borderless">
        <tr>
            <th class="text-center" colspan="5" style="padding-bottom: 30px;">Actividades a Realizar</th>
        </tr>

        <tr>
            <td style="font-weight: bold;">Actividad</td>
            <td style="font-weight: bold;">Detalle</td>
            <td style="font-weight: bold;" class="text-center">Cantidad</td>
            <td style="font-weight: bold;" class="text-right">Valor</td>
            <td style="font-weight: bold;" class="text-right">Subtotal</td>
        </tr>';

        $subtotal=0;
        foreach($detalleCT as $detalle){
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
                <tr style="padding-top: 30px;">
                    <td>Tipo Servicio: <span class="font-weight-bold">'.$cabecera["Tipo_Servicio"].'</span></td>
                    <td>&nbsp;</td>
                    <td>Subtotal: </td><td class="text-right" style="font-weight: bold;">'.number_format($cabecera["Subtotal"]).'</td>
                </tr>

                <tr>
                    <td>Forma de Pago: <span class="font-weight-bold">'.$cabecera["Forma_Pago"].'</span></td>
                    <td>&nbsp;</td>
                    <td>Descuento: </td><td class="text-right" style="font-weight: bold;">'.number_format($cabecera["Descuento"]).'</td>
                </tr>

                <tr>
                    <td>Tiempo de Entrega: <span class="font-weight-bold">'.$cabecera["Prioridad"].' Días</span></td>
                    <td>&nbsp;</td>
                    <td>Iva: </td><td class="text-right" style="font-weight: bold;">'.number_format($cabecera["Iva"]).'</td>
                </tr>

                <tr>
                    <td>Observaciones: <span class="font-weight-bold">'.$cabecera["Observaciones"].'</span></td>
                    <td>&nbsp;</td>
                    <td>Total Cotizacion: </td><td class="text-right" style="font-weight: bold;">'.number_format($cabecera["Total"]).'</td>
                </tr>

                <tr><td>&nbsp;</td></tr>
            </table>';

            $codigoHTML.='<table>
        <tr>
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
    header("Content-Disposition: attachment; filename=" . $title . ".doc");
    ?>

    <?=$codigoHTML;?>
    