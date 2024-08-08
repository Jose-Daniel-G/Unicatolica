<?php
	include_once('../../app/Model/Cargos/CargosModel.php');
	
	class CargosController{
		
		public function crearCargos(){						
			
			$ObjCargos= new CargosModel();
			$cod=$ObjCargos->autoIncrement('CodigoCargo', 'cargos');
			include_once('../../views/Cargos/GuiCargos.html.php');			
		}
		public function borar(){

			redirect(getUrl('Cargos','Cargos','crearCargos'));			
		}
		public function InsertarCargos(){
			
			extract($_POST);

			$consulGrupo="select CodigoCargo from cargos where CodigoCargo='$codigo'";
			$ObjCargos= new CargosModel();
			$Cargos=$ObjCargos->Consultar($consulGrupo);			
			
			if(count($Cargos)==0){	
				$InsertarCargos="insert into cargos (CodigoCargo,Descripcion,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjCargos= new CargosModel();
				$InsertCargos=$ObjCargos->Insertar($InsertarCargos);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Cargos','Cargos','crearCargos')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update cargos  set  Descripcion='$desc' 
									where CodigoCargo='$codigo'";
				$ObjCargos= new CargosModel();
				$ActLinea=$ObjCargos->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Cargos','Cargos','crearCargos')."'
				</script>";
			}
		
		}
		public function buscarCargos (){
			include_once('../../views/Cargos/GuiBuscarCargos.html.php');
		}
		public function listarCargos(){		
			
			extract($_GET);
			$condicion="";
			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="where  Descripcion like '$vIngresadodesc%' ";             
			}
			
						
		echo$listarCargo="select CodigoCargo,Descripcion,Estado 
					from cargos  $condicion order by CodigoCargo ASC";
			$ObjCargos= new CargosModel();	
			$listarCarg=$ObjCargos->Consultar($listarCargo);
			include_once('../../views/Cargos/ListarCargos.php');
		}
		public function getllenarCargos(){
			
			extract($_GET); 
			
			if($llenarCargos<>""){
				$llenarCargo="select CodigoCargo,Descripcion,Estado
				from cargos where CodigoCargo =  '$llenarCargos' ";
				$ObjCargos= new CargosModel();			
				$llenalistarCar=$ObjCargos->Consultar($llenarCargo);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarCar as $Cargos){
				$arrayResultados['CodigoCargo'] = $Cargos[0];
				$arrayResultados['Descripcion'] = $Cargos[1];
				$arrayResultados['Estado'] = $Cargos[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarCargos(){
			
			extract($_GET);			
			$eliminarCargo="delete from cargos where CodigoCargo='$cod'";
			$ObjCargos= new CargosModel();				
			$eliminar=$ObjCargos->Anular($eliminarCargo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Cargos','Cargos','crearCargos')."'
					</script>";	
		}
	}
?>


