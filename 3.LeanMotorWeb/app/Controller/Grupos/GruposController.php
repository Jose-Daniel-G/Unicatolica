<?php
	include_once('../../app/Model/Grupos/GruposModel.php');
	
	class GruposController{
		
		public function crearGrupos(){						
			
			include_once('../../views/Grupos/GuiGrupos.html.php');			
		}
		public function borar(){

			redirect(getUrl('Grupos','Grupos','crearGrupos'));			
		}
		public function InsertarGrupos(){
			
			extract($_POST);

			$consulGrupo="select Codigo_Grupo from grupos_productos where Codigo_Grupo='$codigo'";
			$ObjGrupos= new GruposModel();
			$Grupos=$ObjGrupos->Consultar($consulGrupo);			
			
			if(count($Grupos)==0){	
				$InsertarGrupos="insert into grupos_productos (Codigo_Grupo,Nombre_Grupo,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjGrupos= new GruposModel();
				$InsertGrupos=$ObjGrupos->Insertar($InsertarGrupos);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Grupos','Grupos','crearGrupos')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update grupos_productos  set  Nombre_Grupo='$desc' 
									where Codigo_Grupo='$codigo'";
				$ObjGrupos= new GruposModel();
				$ActLinea=$ObjGrupos->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Grupos','Grupos','crearGrupos')."'
				</script>";
			}
		
		}
		public function buscarGrupos (){
			include_once('../../views/Grupos/GuiBuscarGrupos.html.php');
		}
		public function listarGrupos(){		
			
			extract($_GET);
			$condicion="";
			
			if($vIngresadocodigo<>"" and $vIngresadocodigo <>"undefined"){
				$condicion=" where Codigo_Grupo like '$vIngresadocodigo%' ";             
			}
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="where  Nombre_Grupo like '$vIngresadodesc%' ";             
			}
			if($vIngresadoestado<>"" and $vIngresadoestado <>"undefined" ){
				$condicion="where  Estado = '$vIngresadoestado' ";             
			}
						
		$listarGrupo="select Codigo_Grupo,Nombre_Grupo,Estado 
					from grupos_productos  $condicion order by Codigo_Grupo ASC";
			$ObjGrupos= new GruposModel();	
			$listarG=$ObjGrupos->Consultar($listarGrupo);
			include_once('../../views/Grupos/ListarGrupos.php');
		}
		public function getllenarGrupos(){
			
			extract($_GET); 
			
			if($llenarGrupo<>""){
				$llenarGru="select Codigo_Grupo,Nombre_Grupo,Estado
				from grupos_productos where Codigo_Grupo =  '$llenarGrupo' ";
				$ObjGrupos= new GruposModel();			
				$llenalistarG=$ObjGrupos->Consultar($llenarGru);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarG as $Grupo){
				$arrayResultados['Codigo_Grupo'] = $Grupo[0];
				$arrayResultados['Nombre_Grupo'] = $Grupo[1];
				$arrayResultados['Estado'] = $Grupo[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarGrupos(){
			
			extract($_GET);			
			$eliminarGrupo="delete from grupos_productos where Codigo_Grupo='$cod'";
			$ObjGrupos= new GruposModel();				
			$eliminar=$ObjGrupos->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Grupos','Grupos','crearGrupos')."'
					</script>";	
		}
	}
?>


