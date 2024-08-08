<?php
	include_once('../../app/Model/Productos/ProductosModel.php');
	
	class ProductosController{
		
		public function crearProductos(){	
		
			$grupo="select Codigo_Grupo,Nombre_Grupo
					from grupos_productos ";
			$ObjProductos= new ProductosModel();
			$grupos=$ObjProductos->Consultar($grupo);
			
			$linea="select Codigo_Linea,Descripcion
					from lineas order by Descripcion ";
			$ObjProductos= new ProductosModel();
			$lineas=$ObjProductos->Consultar($linea);
			
			$marca="select Codigo_Marca,Descripcion
					from marcas ";
			$ObjProductos= new ProductosModel();
			$marcas=$ObjProductos->Consultar($marca);
			
			$unidad="select Codigo_Unidad,Descripcion
					from unidades_medidas ";
			$ObjProductos= new ProductosModel();
			$unidades=$ObjProductos->Consultar($unidad);
			
			$sqliva="select * from tipos_iva order by Descripcion";
			$ObjProductos= new ProductosModel();
			$ivas=$ObjProductos->Consultar($sqliva);
			
			include_once('../../views/Productos/GuiProductos.html.php');			
		}
		public function borar(){

			redirect(getUrl('Productos','Productos','crearProductos'));			
		}
		public function InsertarProductos(){
			
			extract($_POST);

			$consulProducto="select Codigo from productos_servicios where Indicativo='P' and Codigo='$codigo'";
			$ObjProductos= new ProductosModel();
			$Produc=$ObjProductos->Consultar($consulProducto);			
			//dd($consulProducto);
			if(count($Produc)==0){	
				$InsertarProducto="insert into productos_servicios
						(Codigo,Descripcion,Codigo_Grupo,Codigo_Linea,Codigo_Marca,Unidad_Medida,Ubicacion_Bodega,
						Equivalencia,Ultimo_Costo,Porcentaje_Comision,Porcentaje_Iva,Precio_Venta1,Precio_Venta2,
						Precio_Venta3,Precio_Venta4,Stock_Minimo,Stock_Maximo,Costo_Fob,Venta_Fob,Estado,Indicativo) 
						values 
						('$codigo','$desc','$grupo','$linea','$marca','$unidad','$bodega','$equivalencia',
						'$ultCosto','$comision','$iva','$venta1','$venta2','$venta3','$venta4','$minimo',
						'$maximo','$costo','$venta','A','P')";				
				$ObjProductos= new ProductosModel();
				$InsertProductos=$ObjProductos->Insertar($InsertarProducto);
				
				echo"<script type='text/javascript'>
						alert('Registro Exitoso')
						window.location.href='".getUrl('Productos','Productos','crearProductos')."'
					</script>";
			}else
			{
				$ActualizarProdu="update productos_servicios  set  
							Descripcion='$desc',Codigo_Grupo='$grupo',
							Codigo_Linea='$linea',Codigo_Marca='$marca',Unidad_Medida='$unidad',
							Ubicacion_Bodega='$bodega',Equivalencia='$equivalencia',Ultimo_Costo='$ultCosto',
							Porcentaje_Comision='$comision',Porcentaje_Iva='$iva',Precio_Venta1='$venta1',
							Precio_Venta2='$venta2',Precio_Venta3='$venta3',Precio_Venta4='$venta4',
							Stock_Minimo='$minimo',Stock_Maximo='$maximo',Costo_Fob='$costo',Venta_Fob='$venta' 
									where Codigo='$codigo'";
				$ObjProductos= new ProductosModel();
				$ActPro=$ObjProductos->Actualizar($ActualizarProdu);
				
				echo"<script type='text/javascript'>
					alert('Registro Actualizo Exitosamente')
					window.location.href='".getUrl('Productos','Productos','crearProductos')."'
				</script>";
			}
		
		}
		public function buscarProductos (){
			include_once('../../views/Productos/GuiBuscarProductos.html.php');
		}
		public function listarProductos(){		
			
			extract($_GET);
			$condicion="";
			
			if($vIngresadocodigo<>"" and $vIngresadocodigo <>"undefined"){
				$condicion="  and Codigo like '$vIngresadocodigo%' ";             
			}
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion.=" and  Descripcion like '$vIngresadodesc%' ";             
			}
			if($vIngresadoestado<>"" and $vIngresadoestado <>"undefined" ){
				$condicion.=" and ps.Estado = '$vIngresadoestado' ";             
			}			
			
			$listarPro="select Codigo,Descripcion,Estado 
					from productos_servicios  where Indicativo='P' $condicion order by Codigo ASC";
			$ObjProductos= new ProductosModel();	
			$listarP=$ObjProductos->Consultar($listarPro);
			include_once('../../views/Productos/ListarProductos.php');
		}
		public function getllenarProductos(){
			
			extract($_GET); 
			
			if($llenarProductos<>""){
			$llenarPro="SELECT  Codigo, ps.Descripcion,ps.Codigo_Grupo as grupo,
						ps.Codigo_linea as linea,ps.Codigo_Marca as marca,Unidad_Medida as unidad, 
						Ubicacion_Bodega,Equivalencia,Ultimo_Costo,Porcentaje_Comision,Porcentaje_Iva,
						Precio_Venta1,Precio_Venta2,Precio_Venta3,Precio_Venta4,Stock_Minimo,Stock_Maximo,
						Costo_Fob,Venta_Fob
				FROM productos_servicios as ps,
					grupos_productos as gp,
					lineas as l,
					marcas as m,
					unidades_medidas as um
					WHERE 
					ps.Codigo_Grupo=gp.Codigo_Grupo AND
					ps.Codigo_Linea=l.Codigo_Linea AND
					ps.Codigo_Marca=m.Codigo_Marca AND
					ps.Unidad_Medida=um.Codigo_Unidad AND
					Indicativo='P' and Codigo =  '$llenarProductos' ";
				$ObjProductos= new ProductosModel();			
				$llenalistarP=$ObjProductos->Consultar($llenarPro);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarP as $Product){
				$arrayResultados['Codigo'] = $Product[0];
				$arrayResultados['Descripcion'] = $Product[1];
				$arrayResultados['grupo'] = $Product[2];				
				$arrayResultados['linea'] = $Product[3];				
				$arrayResultados['marca'] = $Product[4];				
				$arrayResultados['unidad'] = $Product[5];				
				$arrayResultados['Ubicacion_Bodega'] = $Product[6];				
				$arrayResultados['Equivalencia'] = $Product[7];				
				$arrayResultados['Ultimo_Costos'] = $Product[8];				
				$arrayResultados['Porcentaje_Comision'] = $Product[9];				
				$arrayResultados['Porcentaje_Iva'] = $Product[10];				
				$arrayResultados['Precio_Venta1'] = $Product[11];				
				$arrayResultados['Precio_Venta2'] = $Product[12];				
				$arrayResultados['Precio_Venta3'] = $Product[13];				
				$arrayResultados['Precio_Venta4'] = $Product[14];				
				$arrayResultados['Stock_Minimo'] = $Product[15];				
				$arrayResultados['Stock_Maximo'] = $Product[16];				
				$arrayResultados['Costo_Fob'] = $Product[17];				
				$arrayResultados['Venta_Fob'] = $Product[18];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarProducto(){
			
			extract($_GET);			
			$eliminarProducto="delete from productos_servicios where Codigo='$cod'";
			$ObjProductos= new ProductosModel();				
			$eliminar=$ObjProductos->Anular($eliminarProducto);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Productos','Productos','crearProductos')."'
					</script>";	
		}
		
		
	}
?>


