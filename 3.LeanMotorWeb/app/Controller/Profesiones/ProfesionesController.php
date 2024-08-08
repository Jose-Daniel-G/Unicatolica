<?php
	include_once('../../app/Model/Profesiones/ProfesionesModel.php');
	
	class ProfesionesController{
		
		public function crearProfesiones(){						
			$ObjProfesiones= new ProfesionesModel();
			$cod=$ObjProfesiones->autoIncrement('Codigo', 'profesiones');
			include_once('../../views/Profesiones/GuiProfesiones.html.php');			
		}
		public function borar(){

			redirect(getUrl('Profesiones','Profesiones','crearProfesiones'));			
		}
		public function InsertarProfesiones(){
			
			extract($_POST);

			$consulGrupo="select Codigo from profesiones where Codigo='$codigo'";
			$ObjProfesiones= new ProfesionesModel();
			$Profesiones=$ObjProfesiones->Consultar($consulGrupo);			
			
			if(count($Profesiones)==0){	
				$InsertarProfesiones="insert into profesiones (Codigo,Descripcion,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjProfesiones= new ProfesionesModel();
				$InsertProfesiones=$ObjProfesiones->Insertar($InsertarProfesiones);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Profesiones','Profesiones','crearProfesiones')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update profesiones  set  Descripcion='$desc' 
									where Codigo='$codigo'";
				$ObjProfesiones= new ProfesionesModel();
				$ActLinea=$ObjProfesiones->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Profesiones','Profesiones','crearProfesiones')."'
				</script>";
			}
		
		}
		public function buscarProfesiones (){
			include_once('../../views/Profesiones/GuiBuscarProfesiones.html.php');
		}
		public function listarProfesiones(){		
			
			extract($_GET);
			$condicion="";
			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="where  Descripcion like '$vIngresadodesc%' ";             
			}
									
		$listarProfe="select Codigo,Descripcion,Estado 
					from profesiones  $condicion order by Codigo ASC";
			$ObjProfesiones= new ProfesionesModel();	
			$listarPro=$ObjProfesiones->Consultar($listarProfe);
			include_once('../../views/Profesiones/ListarProfesiones.php');
		}
		public function getllenarProfesiones(){
			
			extract($_GET); 
			
			if($llenarProfesiones<>""){
				$llenarProfesion="select Codigo,Descripcion,Estado
				from profesiones where Codigo = '$llenarProfesiones' ";
				$ObjProfesiones= new ProfesionesModel();			
				$llenalistarProf=$ObjProfesiones->Consultar($llenarProfesion);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarProf as $Profesiones){
				$arrayResultados['Codigo'] = $Profesiones[0];
				$arrayResultados['Descripcion'] = $Profesiones[1];
				$arrayResultados['Estado'] = $Profesiones[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarProfesiones(){
			
			extract($_GET);			
			$eliminarGrupo="delete from profesiones where Codigo='$cod'";
			$ObjProfesiones= new ProfesionesModel();				
			$eliminar=$ObjProfesiones->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Profesiones','Profesiones','crearProfesiones')."'
					</script>";	
		}
	}
?>


