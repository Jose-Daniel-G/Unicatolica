<?php
	include_once('../../app/Model/Viviendas/ViviendasModel.php');
	
	class ViviendasController{
		
		public function crearViviendas(){	
		
			$ObjViviendas= new ViviendasModel();
			$cod=$ObjViviendas->autoIncrement('Codigo', 'viviendas');
			include_once('../../views/Viviendas/GuiViviendas.html.php');			
		}
		public function borar(){

			redirect(getUrl('Viviendas','Viviendas','crearViviendas'));			
		}
		public function InsertarViviendas(){
			
			extract($_POST);

			$consulGrupo="select Codigo from viviendas where Codigo='$codigo'";
			$ObjViviendas= new ViviendasModel();
			$Viviendas=$ObjViviendas->Consultar($consulGrupo);			
			
			if(count($Viviendas)==0){	
				$InsertarViviendas="insert into viviendas (Codigo,Descripcion,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjViviendas= new ViviendasModel();
				$InsertViviendas=$ObjViviendas->Insertar($InsertarViviendas);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Viviendas','Viviendas','crearViviendas')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update viviendas  set  Descripcion='$desc' 
									where Codigo='$codigo'";
				$ObjViviendas= new ViviendasModel();
				$ActLinea=$ObjViviendas->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Viviendas','Viviendas','crearViviendas')."'
				</script>";
			}
		
		}
		public function buscarViviendas (){
			include_once('../../views/Viviendas/GuiBuscarViviendas.html.php');
		}
		public function listarViviendas(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="where  Descripcion like '$vIngresadodesc%' ";             
			}

		$listarVivienda="select Codigo,Descripcion,Estado 
					from viviendas  $condicion order by Codigo ASC";
			$ObjViviendas= new ViviendasModel();	
			$listarVivi=$ObjViviendas->Consultar($listarVivienda);
			include_once('../../views/Viviendas/ListarViviendas.php');
		}
		public function getllenarViviendas(){
			
			extract($_GET); 
			
			if($llenarViviendas<>""){
				$llenarVivi="select Codigo,Descripcion,Estado
				from viviendas where Codigo =  '$llenarViviendas' ";
				$ObjViviendas= new ViviendasModel();			
				$llenalistarVivi=$ObjViviendas->Consultar($llenarVivi);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarVivi as $Vivienda){
				$arrayResultados['Codigo'] = $Vivienda[0];
				$arrayResultados['Descripcion'] = $Vivienda[1];
				$arrayResultados['Estado'] = $Vivienda[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarViviendas(){
			
			extract($_GET);			
			$eliminarGrupo="delete from viviendas where Codigo='$cod'";
			$ObjViviendas= new ViviendasModel();				
			$eliminar=$ObjViviendas->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Viviendas','Viviendas','crearViviendas')."'
					</script>";	
		}
	}
?>


