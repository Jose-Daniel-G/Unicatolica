<?php
	include_once('../../app/Model/Lineas/LineasModel.php');
	
	class LineasController{
		
		public function crearLineas(){						
			
			include_once('../../views/Lineas/GuiLineas.html.php');			
		}
		public function borar(){

			extract($_POST);
			unset($codigo);
			unset($linea);			

			redirect(getUrl('Lineas','Lineas','crearLineas'));			
		}
		public function InsertarLineas(){
			
			extract($_POST);

			$consulLinea="select Codigo_Linea from lineas where Codigo_Linea='$codigo'";
			$ObjLineas= new LineasModel();
			$linea=$ObjLineas->Consultar($consulLinea);			
			
			if(count($linea)==0){	
				$InsertarLinea="insert into lineas (Codigo_Linea,Descripcion,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjLineas= new LineasModel();
				$InsertLineas=$ObjLineas->Insertar($InsertarLinea);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Lineas','Lineas','crearLineas')."'
					</script>";
			}else
			{
				$ActualizarLinea="update lineas  set  Descripcion='$desc' 
									where Codigo_Linea='$codigo'";
				$ObjLineas= new LineasModel();
				$ActLinea=$ObjLineas->Actualizar($ActualizarLinea);
				
				/*echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Lineas','Lineas','crearLineas')."'
				</script>";*/
			}
		
		}
		public function buscarLineas (){
			include_once('../../views/Lineas/GuiBuscarLineas.html.php');
		}
		public function listarLineas(){		
			
			extract($_GET);
			
			$condicion="";
			
			// if($vIngresadocodigo<>"" and $vIngresadocodigo <>"undefined"){
			if($vIngresadocodigo<>"" ){
				$condicion=" where  Codigo_Linea like '$vIngresadocodigo%' ";             
			}
			if($vIngresadodesc<>"" ){
				$condicion="where   Descripcion like '$vIngresadodesc%' ";             
			}
			if($vIngresadoestado<>"" and $vIngresadoestado <>"undefined" ){
				$condicion="where Estado = '$vIngresadoestado' ";             
			}
					
			$listarLinea="select Codigo_Linea,Descripcion,Estado 
					from lineas  $condicion order by Codigo_Linea ASC";					
			$ObjLineas= new LineasModel();	
			$listarL=$ObjLineas->Consultar($listarLinea);
			include_once('../../views/Lineas/ListarLineas.php');
		}
		public function getllenarLineas(){
			
			extract($_GET); 
			
			if($llenarLineas<>""){
				$llenarLi="select Codigo_Linea,Descripcion,Estado
				from lineas where Codigo_Linea =  '$llenarLineas' ";
				$ObjLineas= new LineasModel();			
				$llenalistarL=$ObjLineas->Consultar($llenarLi);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarL as $Linea){
				$arrayResultados['Codigo_Linea'] = $Linea[0];
				$arrayResultados['Descripcion'] = $Linea[1];
				$arrayResultados['Estado'] = $Linea[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarLinea(){
			
			extract($_GET);			
			$eliminarLinea="delete from lineas where Codigo_Linea='$cod'";
			$ObjLineas= new LineasModel();				
			$eliminar=$ObjLineas->Anular($eliminarLinea);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Lineas','Lineas','crearLineas')."'
					</script>";	
		}
	}
?>


