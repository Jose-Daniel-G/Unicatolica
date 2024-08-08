<?php
	include_once('../../app/Model/UnidadNegocio/UnidadNegocioModel.php');
	
	class UnidadNegocioController{
		
		public function crearUnidadNegocio(){	
			$ObjUnidadN= new UnidadNegocioModel();
			$num_doc=$ObjUnidadN->autoIncrement('Codigo', 'unidades_negocio');			
			include_once('../../views/UnidadNegocio/GuiUnidadNegocio.html.php');			
		}
		public function borar(){

			extract($_POST);
			unset($codigo);
			unset($descripcion);
			unset($cif);			

			redirect(getUrl('UnidadNegocio','UnidadNegocio','crearUnidadNegocio'));			
		}
		public function InsertarUnidadNegocio(){
			
			extract($_POST);

			$consulUnidad="select Codigo from unidades_negocio where Codigo='$codigo'";
			$ObjUnidadN= new UnidadNegocioModel();
			$unidad=$ObjUnidadN->Consultar($consulUnidad);			
			
			if(count($unidad)==0){	
				$InsertarTEquipos="insert into unidades_negocio (Codigo,Descripcion,Estado,Porcentaje_Inductor_Costo) 
							values ('$codigo','$descripcion','A','$cif')";				
				$ObjUnidadN= new UnidadNegocioModel();
				$InsertTEquipos=$ObjUnidadN->Insertar($InsertarTEquipos);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('UnidadNegocio','UnidadNegocio','crearUnidadNegocio')."'
					</script>";
			}else
			{
				$ActualizarMarca="update unidades_negocio  set  Descripcion='$descripcion',
									Porcentaje_Inductor_Costo='$cif' 
									where Codigo='$codigo'";
				$ObjUnidadN= new UnidadNegocioModel();
				$ActMarca=$ObjUnidadN->Actualizar($ActualizarMarca);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('UnidadNegocio','UnidadNegocio','crearUnidadNegocio')."'
				</script>";
			}
		
		}
		public function buscarUnidadNegocio (){
			include_once('../../views/UnidadNegocio/GuiBuscarUnidadNegocio.html.php');
		}
		public function listarUnidadNegocio(){		
			
			extract($_GET);
			$condicion="";			
			if($vIngresaestado<>""  and $vIngresaestado <>"undefined")
			{
				$condicion=" and Estado='$vIngresaestado'";
			}
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion.=" and  Descripcion like '$vIngresadodesc%' ";             
			}
				$listarUnidades="select *  from unidades_negocio where Estado='A' $condicion  order by Codigo ASC";
				$ObjUnidadN= new UnidadNegocioModel();
				$listarUnidad=$ObjUnidadN->Consultar($listarUnidades);
				include_once('../../views/UnidadNegocio/ListarUnidadNegocio.php');
			
		}
		public function getllenarUnidadNegocio(){
			
			extract($_GET); 
			
			if($llenarUnidades<>""){
				$llenarUN="select * from unidades_negocio where Codigo='$llenarUnidades' ";
				$ObjUnidadN= new UnidadNegocioModel();
				$llenalistarUN=$ObjUnidadN->Consultar($llenarUN);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarUN as $unidad){
				$arrayResultados['Codigo'] = $unidad[0];
				$arrayResultados['Descripcion'] = $unidad[1];
				$arrayResultados['Porcentaje_Inductor_Costo'] = $unidad[3];
				$arrayResultados['Estado'] = $unidad[2];
								
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarUnidadNegocio(){
			
			extract($_GET);			
			echo$eliminarUnidad="delete from unidades_negocio where Codigo='$cod'";
			$ObjUnidadN= new UnidadNegocioModel();
			$eliminar=$ObjUnidadN->Anular($eliminarUnidad);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('UnidadNegocio','UnidadNegocio','crearUnidadNegocio')."'
					</script>";	
		}
	}
?>


