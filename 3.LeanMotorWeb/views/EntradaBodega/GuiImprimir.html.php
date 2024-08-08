<?php
include_once("../../Lib/dompdf/dompdf_config.inc.php");
include_once("../../app/Model/Cotizaciones/CotizacionesModel.php");
@session_start();
$objCotizacion= new Connection();

$Numero_Documento=$_GET['numero_doc'];
$tipo_doc=$_GET['tipo_doc'];
$nit_empresa=$_GET['nit_sede'];

    
    $sqlESB="select No_Documento, Tipo_Documento, Fecha_Documento, Estado_Documento, ESB.Nit_Proveedor, Razon_Social, proveedores.Direccion, 
			proveedores.Telefono1, ciudades.Nombre, ESB.NO_PEDIDO,
                bodegas.Descripcion, ESB.Tipo_Documento_Cruce, ESB.No_Documento_Cruce, ESB.Fecha_Documento_Cruce
                FROM encabezado_e_s_bodega as ESB, proveedores, ciudades, bodegas
                    WHERE ESB.Nit_Proveedor=proveedores.Nit_Proveedor
                        and proveedores.Codigo_Ciudad=ciudades.Codigo_Ciudad
                        and ESB.Codigo_Bodega=bodegas.Codigo_Bodega 
                        and No_Documento='$Numero_Documento' and Tipo_Documento='$tipo_doc' and Nit_Empresa='$nit_empresa'";
   
    $cabeceraESB=$objCotizacion->execute($sqlESB);

    foreach($cabeceraESB as $cabecera){}
    
    if($cabecera[1]=="EB")
    {
        $titulo_Doc="Entrada a Bodega";
    }
    else
    {
         $titulo_Doc="Salida de Bodega";
    }
    
    if($cabecera[3]=="A")
    {
        $estado_Doc="Activa";
    }
    else
    {
        $estado_Doc="Anulada";
    }
    
    $sqlDESB="SELECT  prod.Descripcion, DESB.Cantidad, DESB.Valor_Unitario, DESB.Porcentaje_Descuento, DESB.Valor_Total
                FROM detalle_e_s_bodega as DESB, productos_servicios as prod
                    WHERE DESB.Codigo=prod.Codigo 
                        and No_Documento='$Numero_Documento' 
                        and Tipo_Documento='$tipo_doc' and Nit_Empresa='$nit_empresa'";
    $detalleESB=$objCotizacion->execute($sqlDESB);


date_default_timezone_set('America/Bogota');
//$fechaImp = date('g:ia \o\n l jS F Y');
$fechaImp=date('d-m-Y H:i:s');


$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

<title>Cotizacion GER</title>
</head>
<body>';
  

$codigoHTML.='  
    <h4>Fecha Imp: '.$fechaImp.'</h4>
    <table style="margin:auto" width="90%" ><tr>
            
            <th colspan="2">&nbsp;&nbsp;</th>
            
        </tr>
        
        <tr>
            <td rowspan="6"><img src="../../Web/Imagenes/LOGO_LTE.jpg" style="margin:0px 0px 0px 50px" width="120" height="0" /></td>
            <td style="text-align: center;">LABORATORIO TECNO-ELECTRICO S.A.S</td>
        </tr>
          
        <tr>

            <td style="text-align: center;line-height:10px;">CL 13 A No 8 A - 151</td>
        </tr> 

        <tr>
            <td style="text-align: center;line-height:10px;">PBX(57)2 4481234 Fax</td>
        </tr>  

        <tr>
            <td  style="text-align: center;font-family: Arial; font-size:11px; line-height:10px;">Email: servicioalcliente@lte-sas.com</td>
        </tr>

        <tr>
            <td style="text-align: center;">Cali - Colombia</td>
        </tr>  
        
        <tr>
            <td style="text-align: center;ont-size:18px;">'.$titulo_Doc.'</td>
        </tr>
                            </table>';


$codigoHTML.='<table style="margin:auto" width="90%" >
                <tr>
                    <td style="text-align: rigth;">Fecha Doc:'.substr($cabecera[2],0,10).'</td>
                    <td style="text-align: rigth;">No Documento:'.$cabecera[0].'</td>
					<td></td>
                    <td style="text-align: rigth;">Estado:'.$estado_Doc.'</td>
                </tr>
                
                <tr>
                    <td style="text-align: rigth;" colspan="3">Proveedor:'.$cabecera[5].'</td>                                       
                </tr>
				
				<tr>
					 <td style="text-align: rigth;" colspan="2">Nit:'.$cabecera[4].'</td>
				</tr>
				
				<tr>
					<td style="text-align: rigth;" colspan="3">Direccion:'.$cabecera[6].'</td>
                    <td style="text-align: rigth;">Telefono:'.$cabecera[7].'</td>
				</tr>
                
                <tr>
                    <td style="text-align: rigth;">Ciudad:'.$cabecera[8].'</td>
                    <td style="text-align: rigth;">No pedido:'.$cabecera[9].'</td>
                    <td style="text-align: rigth;">Bodega:'.$cabecera[10].'</td>
                </tr>
                
                <tr>
                    <td style="text-align: rigth;">Doc Cruce:'.$cabecera[11].'</td>
                    <td style="text-align: rigth;">No Doc Cruce:'.$cabecera[12].'</td>
                    <td style="text-align: rigth;"  colspan="2">Fecha Doc Cruce:'.substr($cabecera[13],0,10).'</td>
                </tr>
                

            </table>';


    $codigoHTML.='<table  style="margin:auto" width="90%">
    
            <tr>
                <th style="text-align:center" >Producto</t>
                <th style="text-align:right" >Cantidad</t>
                <th style="text-align:right" >Valor Unitario</t>
                <th style="text-align:right" ></t>
                <th style="text-align:right" >Valor Total</t>
            </tr>';
            
            foreach($detalleESB as $detalle)
            {
               
                $codigoHTML.='<tr>
                    <td >'.$detalle[0].'</td>
                    <td style="text-align:right">'.number_format($detalle[1]).'</td>                
                    <td style="text-align:right">'.number_format($detalle[2]).'</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right">'.number_format($detalle[4]).'</td>
                </tr>';
            }

        $codigoHTML.='</table>';

    

$codigoHTML.='</body></html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->set_paper("A4", "portrait");
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");

$dompdf->render();
$dompdf->stream("ES_Bodega.pdf");
?>