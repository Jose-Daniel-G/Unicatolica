<?php
	include_once('../../app/Model/Actividades/ActividadesModel.php');
	
	class ActividadesController{
		
		public function crearActividades(){						
			
			$sqliva="select * from tipos_iva order by Descripcion";
			$ObjActividades= new ActividadesModel();
			$ivas=$ObjActividades->Consultar($sqliva);
			
			$sqlUnidad="select * from unidades_negocio  order by Descripcion";
			$ObjActividades= new ActividadesModel();
			$Unidades=$ObjActividades->Consultar($sqlUnidad);			
			$num_doc=$ObjActividades->autoIncrement('Codigo', 'productos_servicios');
			include_once('../../views/Actividades/GuiActividades.html.php');			
		}
		public function borar(){

			extract($_POST);
			unset($codigo);
			unset($descripcion);
			unset($iva);			
			unset($unidad);			

			redirect(getUrl('Actividades','Actividades','crearActividades'));			
		}
		public function InsertarActividades(){
			
			extract($_POST);

			$consulAct="select Codigo from productos_servicios where Indicativo='A' and Codigo='$codigo'";
			$ObjActividades= new ActividadesModel();
			$Act=$ObjActividades->Consultar($consulAct);			
			
			if(count($Act)==0){	
				$InsertarAct="insert into productos_servicios (Codigo,Descripcion,Unidad_Negocio,
							Indicativo,Porcentaje_Iva,Estado) 
							values ('$codigo','$descripcion','$unidad','A','$iva','A')";				
				$ObjActividades= new ActividadesModel();
				$InsertActividades=$ObjActividades->Insertar($InsertarAct);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Actividades','Actividades','crearActividades')."'
					</script>";
			}else
			{
				$ActualizarMarca="update productos_servicios  set  Descripcion='$descripcion', 
									Unidad_Negocio='$unidad',
									Porcentaje_Iva='$iva'
									where Codigo='$codigo'";
				$ObjActividades= new ActividadesModel();
				$ActMarca=$ObjActividades->Actualizar($ActualizarMarca);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Actividades','Actividades','crearActividades')."'
				</script>";
			}
		
		}
		public function buscarActividades (){
			include_once('../../views/Actividades/GuiBuscarActividades.html.php');
		}
		public function listarActividades(){				
			
			extract($_GET);
			$condicion="";
			
			if($vIngresadocodigo<>"" and $vIngresadocodigo <>"undefined"){
				$condicion=" and Codigo like '$vIngresadocodigo%' ";             
			}
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion.=" and  ps.Descripcion like '$vIngresadodesc%' ";             
			}
			if($vIngresadoestado<>"" and $vIngresadoestado <>"undefined" ){
				$condicion.=" and ps.Estado = '$vIngresadoestado' ";             
			}
			
			$listarActividad="select ps.Codigo,ps.Descripcion,Unidad_Negocio,
							Indicativo,Porcentaje_Iva,ps.Estado,un.Descripcion 
							from productos_servicios as ps,unidades_negocio as un 
							where
							ps.Unidad_Negocio=un.Codigo and
							Indicativo='A'  
							$condicion order by ps.Codigo ASC";
			$ObjActividades= new ActividadesModel();				
			$listarAct=$ObjActividades->Consultar($listarActividad);
		
			include_once('../../views/Actividades/ListarActividades.php');
			
		}
		public function getllenarActividades(){
			
			extract($_GET); 
			
			if($llenarActividades<>""){
				$llenarMar="select ps.Codigo,ps.Descripcion,Unidad_Negocio, Indicativo,Porcentaje_Iva,ps.Estado,un.Descripcion,ti.Descripcion
				from productos_servicios as ps,unidades_negocio as un, tipos_iva as ti 
				where   ps.Unidad_Negocio=un.Codigo 
				    and ps.Porcentaje_Iva=ti.Id_Iva 
				    and Indicativo='A'
				    and ps.Codigo =  '$llenarActividades' ";
				$ObjActividades= new ActividadesModel();			
				$llenalistarAct=$ObjActividades->Consultar($llenarMar);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarAct as $act){
				$arrayResultados['Codigo'] = $act[0];
				$arrayResultados['Descripcion'] = $act[1];
				$arrayResultados['Unidad_Negocio'] = $act[2];
				$arrayResultados['Porcentaje_Iva'] = $act[4];
				$arrayResultados['Estado'] = $act[5];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarActividades(){
			
			extract($_GET);			
			$eliminarMarca="delete from productos_servicios where Indicativo='A' and Codigo='$cod'";
			$ObjActividades= new ActividadesModel();				
			$eliminar=$ObjActividades->Anular($eliminarMarca);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Actividades','Actividades','crearActividades')."'
					</script>";	
		}
	}
?>


