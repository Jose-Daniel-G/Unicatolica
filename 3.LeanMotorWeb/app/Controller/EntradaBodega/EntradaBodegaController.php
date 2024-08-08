<?php

@include_once('../../app/Model/EntradaBodega/EntradaBodegaModel.php');
@session_start();


class  EntradaBodegaController{        
    
    
    function ConsecutivoDocumento($nit_Empresa_sede)
    {        
        $objEntradaBodega= new EntradaBodegaModel(); 
        //$nit_Empresa_sede=$_SESSION['Nit_Empresa'];
        $sql="select ultimo_creado from consecutivo_documentos WHERE td_sigla='EB' and nit_empresa='$nit_Empresa_sede'";
        $num_doc=$objEntradaBodega->Consultar($sql);
        $cons_doc=$num_doc[0][0]+1;
        
        return $cons_doc;
    }
    
    function crearEntradaBodega()
    {		
        $objEntradaBodega= new EntradaBodegaModel();  
      
        $usua_perfil=$_SESSION['usua_perfil'];
        
        $sqlproveedor="select Nit_Proveedor, ucase(Razon_Social) from proveedores order by Razon_Social ";
        $proveedores=$objEntradaBodega->Consultar($sqlproveedor);

        $sqlbodega="select Codigo_Bodega,Descripcion from bodegas order by Descripcion";
        $bodegas=$objEntradaBodega->Consultar($sqlbodega);
        
        $sqlsede="select nit_empresa, nombre from sedes order by nombre";
        $sedes=$objEntradaBodega->Consultar($sqlsede);
        
        if($usua_perfil !=1)
        {
            $num_doc=$this->ConsecutivoDocumento();  
        }
        else
        {
            $num_doc='';
        }
       
        include_once('../../views/EntradaBodega/GuiEntradaBodega.html.php');
    }

    function BuscarDatosProveedor()
    {
    	$proveedor=$_POST['proveedor'];
    	$objEntradaBodega= new EntradaBodegaModel();  
    	$sqlpro="SELECT Nit_Proveedor, Direccion, Telefono1, ciudades.Nombre as ciudad_cliente 
		FROM proveedores , ciudades 
		WHERE proveedores.Codigo_Ciudad=ciudades.Codigo_Ciudad and Nit_Proveedor='$proveedor'";
    	$proveedores=$objEntradaBodega->Consultar($sqlpro);
        
        foreach ($proveedores as $proveedor)
        {            
        }       
    	echo json_encode($proveedor);
    }

    function BuscarProductoServicio()
    {
    	$desc=$_POST['desc_serv'];
        $data_fila=$_POST['data_fila'];
        //dd("hola".$data_fila);
    	$objEntradaBodega= new EntradaBodegaModel(); 
    	$sqlserv="select Codigo, ps.Descripcion,um.Descripcion,Ultimo_Costo,m.Descripcion,Nombre_Grupo,   ps.Unidad_Negocio, ps.Porcentaje_Iva
    	                    FROM productos_servicios as ps, marcas  as m, unidades_medidas um, grupos_productos as gp
                                WHERE ps.Codigo_Marca=m.Codigo_Marca 
                                        and ps.Unidad_Medida=um.Codigo_Unidad 
                                        and ps.Codigo_Grupo=gp.Codigo_Grupo 
                                        and	ps.Descripcion like '$desc%' and Indicativo='P'";
    	$servicios=$objEntradaBodega->Consultar($sqlserv);
		 
    	include_once('../../views/EntradaBodega/GuiListarProductoServicios.html.php'); 
    }

    function RegistarEntradaBodega()
    {
       
        //Preguntar cuales son los datos minimos para registrar EntradaBodega
        extract($_POST);
        $usu_id=$_SESSION['usua_id'];
        $objEntradaBodega= new EntradaBodegaModel(); 
        $sqlEB="select No_Documento
                        from encabezado_e_s_bodega
                            where No_Documento='$numEB' 
                                and Tipo_Documento='EB'
                                and Nit_empresa='$nit_sede'";
        $EB= $objEntradaBodega->Consultar($sqlEB);
        
       
       
        if($nit <> "" and count($producto_id) >0)
        {
           
            
            mysql_query("SET AUTOCOMMIT=0");
            mysql_query("START TRANSACTION");
            mysql_query("LOCK TABLES encabezado_e_s_bodega, detalle_e_s_bodega   WRITE;"); 
            
            if($EB[0][0] == null)
            {
            
                $sqlCT="insert into encabezado_e_s_bodega (No_Documento, Tipo_Documento, Fecha_Documento, Nit_proveedor, NO_PEDIDO, Codigo_Bodega,Tipo_Documento_Cruce,
                            No_Documento_Cruce, Fecha_Documento_Cruce,Usuario_Crea, Nit_empresa, Estado_Documento) 
                                values ('$numEB', 'EB', now(),'$proveedor','$pedido','$bodega','$doc','$numero', '$fecha','$usu_id', '$nit_sede', 'A')";
          
                $objEntradaBodega->Insertar($sqlCT);
                
                $plano=$sqlCT.";";
                //preguntar por consecutivos de Doc
                $item=1;
                for($i=0; $i<count($producto_id); $i++)
                {
                    $sqlServ="insert into detalle_e_s_bodega (No_Documento, Tipo_Documento,Cantidad, Valor_Unitario, Codigo, Nit_Empresa, Valor_Total, Unidad_Negocio, Item) 
                                values('$numEB', 'EB', ".$cant[$i].", ".$valor[$i].", '".$producto_id[$i]."', '$nit_sede', $subtotal_pro[$i], '$un[$i]', $item)";
                    $objEntradaBodega->Insertar($sqlServ);
                    $item++;
                    $plano.=$sqlServ.";";
                } 
                
                $objEntradaBodega->Incrementar_Consecutivo('EB', $nit_sede);
            }
            else
            {
                $sqlCT="update encabezado_e_s_bodega set  Nit_proveedor='$proveedor', NO_PEDIDO='$pedido', Codigo_Bodega='$bodega', Tipo_Documento_Cruce='$doc', No_Documento_Cruce='$numero', 
                            Fecha_Documento_Cruce='$fecha'
                                where No_Documento='$numEB' and  Tipo_Documento='EB' and Nit_Empresa='$nit_sede'";
          
                $objEntradaBodega->Actualizar($sqlCT);
                
                $delEB="delete from detalle_e_s_bodega where No_Documento='$numEB' and  Tipo_Documento='EB' and Nit_Empresa='$nit_sede'";
                $objEntradaBodega->Anular($delEB);
                $plano=$sqlCT.";";
               
                $item=1;
                for($i=0; $i<count($producto_id); $i++)
                {
                    $sqlServ="insert into detalle_e_s_bodega (No_Documento, Tipo_Documento,Cantidad,  Valor_Unitario, Codigo, Nit_Empresa, Valor_Total, Unidad_Negocio, Item) 
                                values('$numEB', 'EB', ".$cant[$i].", ".$valor[$i].", '".$producto_id[$i]."', '$nit_sede', $subtotal[$i], '$un[$i]', $item)";
                    $objEntradaBodega->Insertar($sqlServ);
                    $item++;
                    $plano.=$sqlServ.";";
                } 
            }
                
                
            mysql_query("unlock tables;");
            mysql_query("COMMIT");  
            
            
           /* $nombre_archivo= "EntradaBodega".$numEB.".txt"; 
 
            if(file_exists($nombre_archivo))
            {
                $mensaje = "El Archivo $numEB se ha modificado";
            }
            else
            {
                if($archivo = fopen($nombre_archivo, "a"))
                {
                    if(fwrite($archivo, $plano))
                    {
                        
                    }
                    else
                    {
                        echo'<script type="text/javascript" charset="utf-8"> alert("Ha habido un problema al crear el archivo");</script>';
                    }
             
                    fclose($archivo);
                    //header("Location: ".$nombre_CT );  
                }
            }*/
            
            echo"<script type='text/javascript'>
						alert('Entrada a Bodega Guardada con Exito');
						window.location.href='".getUrl('EntradaBodega','EntradaBodega','crearEntradaBodega')."'; 
				</script>";  
          
        }
        else
        {
            echo'<script type="text/javascript" charset="utf-8"> alert("Faltan Datos!!");</script>';
            //redirect(getUrl("EntradaBodega", "EntradaBodega", "crearEntradaBodega"));
        }

    }

    function VerDatosAdicionales()
    {
        $objEntradaBodega= new EntradaBodegaModel(); 
        $numDoc=$_POST['num_doc'];
        $nit_sede=$_POST['nit_sede'];

        $sqlDatos="select Usuario_Modifica, Fecha_Modifica, Usuario_Anula,Fecha_Anula, Razon_Anula from encabezado_e_s_bodega 
                    where No_Documento='$numDoc' and Tipo_Documento='EB' and Nit_Empresa='$nit_sede'";  
        $datos=$objEntradaBodega->Consultar($sqlDatos);

        if($datos <> null)
        {
           include_once('../../views/BuscarDocumento/GuiVerDatosAdicionales.html.php'); 
        }
        else
        {
            echo"No hay Registros";
        }
        
    }

    function AnularEntradaBodega()
    {
        $num_doc=$_POST['num_doc'];
        $tipo_doc=$_POST['tipo_doc'];
        $Razon_Anula=$_POST['Razon_Anula'];
        $Usuario_Anula= $_SESSION['usua_id'];
        $fecha=date('Y-m-d');
        $objEntradaBodega= new EntradaBodegaModel(); 
        echo$sqlEB="update encabezado_e_s_bodega set Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha', Razon_Anula='$Razon_Anula',  Estado_Documento='I' 
                    where No_Documento='$num_doc' and Tipo_Documento='$tipo_doc'";
        $UpdateEB=$objEntradaBodega->Anular($sqlEB);
       
        redirect(getUrl("EntradaBodega", "EntradaBodega", "crearEntradaBodega"));
    }

    function VerEntradaBodega()
    {
        $Numero_Documento=$_GET['numero_doc'];
        $tipo_doc=$_GET['tipo_doc'];
        $nit_sede=$_GET['nit_sede'];
      
        $objEntradaBodega= new EntradaBodegaModel(); 
        $sqlEB="select pro.Nit_Proveedor, pro.Razon_Social, pro.Direccion, pro.Telefono1, ciudades.Nombre, EB.NO_PEDIDO, EB.Codigo_Bodega, EB.Tipo_Documento_Cruce, EB.No_Documento_Cruce,  EB.No_Documento, 
                    substring(EB.Fecha_Documento,1,10), EB.Nit_Empresa, EB.Estado_Documento
                        from encabezado_e_s_bodega as EB, proveedores as pro, ciudades
                            where EB.Nit_Proveedor=pro.Nit_Proveedor
                                    and pro.Codigo_Ciudad=ciudades.Codigo_Ciudad and EB.Tipo_Documento='$tipo_doc' and EB.No_Documento='$Numero_Documento' and EB.Nit_Empresa='$nit_sede'";
       
        $cabeceraEB=$objEntradaBodega->Consultar($sqlEB);
        
        $sqlDEB="SELECT DEB.Codigo, ps.Descripcion, ps.Unidad_Negocio ,DEB.Cantidad, DEB.Valor_Unitario, DEB.Porcentaje_Descuento, DEB.Valor_Total, ps.Porcentaje_Iva
                    FROM detalle_e_s_bodega DEB, productos_servicios as ps
                        WHERE DEB.Codigo=ps.Codigo
                            and  No_Documento='$Numero_Documento' and Tipo_Documento='$tipo_doc' and Nit_Empresa='$nit_sede'";
        $detalleEB=$objEntradaBodega->Consultar($sqlDEB);
        
        $sqlsede="select nit_empresa, nombre from sedes order by nombre";
        $sedes=$objEntradaBodega->Consultar($sqlsede);
         
        $sqlproveedor="select Nit_Proveedor, Razon_Social from proveedores order by Razon_Social ";
        $proveedores=$objEntradaBodega->Consultar($sqlproveedor);
        
        $sqlbodega="select Codigo_Bodega,Descripcion from bodegas order by Descripcion";
        $bodegas=$objEntradaBodega->Consultar($sqlbodega);
        
        include_once('../../views/EntradaBodega/GuiVerEntradaBodega.html.php');
      
    }
    
    function BuscarConsecutivo()
    {
        $nit_Empresa_sede=$_POST['nit_sede'];
        $num_doc=$this->ConsecutivoDocumento($nit_Empresa_sede);
        echo json_encode($num_doc);
    }
    
    function exportarCT($num_doc)
    {
        //http://www.webioss.com/php/crear-y-escribir-en-un-archivo-con-php/ Ajustar para dejar generico Ojo!!!!
        
        $nombre_archivo = "EntradaBodega".$num_doc.".txt"; 
 
        if(file_exists($nombre_archivo))
        {
            $mensaje = "El Archivo $nombre_archivo se ha modificado";
        }
     
        else
        {
            if($archivo = fopen($nombre_archivo, "a"))
            {
                if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
                {
                    echo "Se ha ejecutado correctamente";
                }
                else
                {
                    echo "Ha habido un problema al crear el archivo";
                }
         
                fclose($archivo);
            }
        }      
    }
    
    function EditarEB()
    {
        extract($_POST);
        $usu_id=$_SESSION['usua_id'];
        $objEntradaBodega= new EntradaBodegaModel(); 
            
        $num_Act="select Numero_Documento from encabezado_documento_venta where  Tipo_Documento='CT' and Numero_Documento like '$numCT' and NIT_Empresa='$nit_sede'";
        $existe=$objEntradaBodega->Consultar();
        if($existe <> null)
        {
            
        }
       
    }
	

}

?>