<?php
	include_once('../../app/Model/EstadosCiviles/EstadosCivilesModel.php');
	
	class EstadosCivilesController{
		
		public function crearEstadosCiviles(){						
			$ObjEstadosCiviles= new EstadosCivilesModel();
			$cod=$ObjEstadosCiviles->autoIncrement('Codigo', 'estados_civiles');
			
			include_once('../../views/EstadosCiviles/GuiEstadosCiviles.html.php');			
		}
		public function borar(){

			redirect(getUrl('EstadosCiviles','EstadosCiviles','crearEstadosCiviles'));			
		}
		public function InsertarEstadosCiviles(){
			
			extract($_POST);

			$consulGrupo="select Codigo from estados_civiles where Codigo='$codigo'";
			$ObjEstadosCiviles= new EstadosCivilesModel();
			$EstadosCiviles=$ObjEstadosCiviles->Consultar($consulGrupo);			
			
			if(count($EstadosCiviles)==0){	
				$InsertarEstadosCiviles="insert into estados_civiles (Codigo,Descripcion,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjEstadosCiviles= new EstadosCivilesModel();
				$InsertEstadosCiviles=$ObjEstadosCiviles->Insertar($InsertarEstadosCiviles);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('EstadosCiviles','EstadosCiviles','crearEstadosCiviles')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update estados_civiles  set  Descripcion='$desc' 
									where Codigo='$codigo'";
				$ObjEstadosCiviles= new EstadosCivilesModel();
				$ActLinea=$ObjEstadosCiviles->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('EstadosCiviles','EstadosCiviles','crearEstadosCiviles')."'
				</script>";
			}
		
		}
		public function buscarEstadosCiviles (){
			include_once('../../views/EstadosCiviles/GuiBuscarEstadosCiviles.html.php');
		}
		public function listarEstadosCiviles(){		
			
			extract($_GET);
			$condicion="";
			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="where  Descripcion like '$vIngresadodesc%' ";             
			}			
						
		$listarGrupo="select Codigo,Descripcion,Estado 
					from estados_civiles  $condicion order by Codigo ASC";
			$ObjEstadosCiviles= new EstadosCivilesModel();	
			$listarEstCivil=$ObjEstadosCiviles->Consultar($listarGrupo);
			include_once('../../views/EstadosCiviles/ListarEstadosCiviles.php');
		}
		public function getllenarEstadosCiviles(){
			
			extract($_GET); 
			
			if($llenarEstCivil<>""){
				$llenarEstC="select Codigo,Descripcion,Estado
				from estados_civiles where Codigo =  '$llenarEstCivil' ";
				$ObjEstadosCiviles= new EstadosCivilesModel();			
				$llenalistarEC=$ObjEstadosCiviles->Consultar($llenarEstC);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarEC as $Estciv){
				$arrayResultados['Codigo'] = $Estciv[0];
				$arrayResultados['Descripcion'] = $Estciv[1];
				$arrayResultados['Estado'] = $Estciv[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarEstadosCiviles(){
			
			extract($_GET);			
			$eliminarGrupo="delete from estados_civiles where Codigo='$cod'";
			$ObjEstadosCiviles= new EstadosCivilesModel();				
			$eliminar=$ObjEstadosCiviles->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('EstadosCiviles','EstadosCiviles','crearEstadosCiviles')."'
					</script>";	
		}
	}
?>


