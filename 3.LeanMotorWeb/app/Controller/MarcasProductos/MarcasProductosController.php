<?php
	include_once('../../app/Model/MarcasProductos/MarcasProductosModel.php');
	
	class MarcasProductosController{
		
		public function crearMarcasProductos(){					
				$ObjMarcasProductos= new MarcasProductosModel();
				$cod=$ObjMarcasProductos->autoIncrement('Codigo', 'marcas_productos');
			
			include_once('../../views/MarcasProductos/GuiMarcasProductos.html.php');			
		}
		public function borar(){

			redirect(getUrl('MarcasProductos','MarcasProductos','crearMarcasProductos'));			
		}
		public function InsertarMarcasProductos(){
			
			extract($_POST);

			$consulGrupo="select Codigo from Marcas_productos where Codigo='$codigo'";
			$ObjMarcasProductos= new MarcasProductosModel();
			$MarcasProductos=$ObjMarcasProductos->Consultar($consulGrupo);			
			
			if(count($MarcasProductos)==0){	
				$InsertarMarcasProductos="insert into marcas_productos (Codigo,Descripcion,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjMarcasProductos= new MarcasProductosModel();
				$InsertMarcasProductos=$ObjMarcasProductos->Insertar($InsertarMarcasProductos);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('MarcasProductos','MarcasProductos','crearMarcasProductos')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update marcas_productos  set  Descripcion='$desc' 
									where Codigo='$codigo'";
				$ObjMarcasProductos= new MarcasProductosModel();
				$ActLinea=$ObjMarcasProductos->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('MarcasProductos','MarcasProductos','crearMarcasProductos')."'
				</script>";
			}
		
		}
		public function buscarMarcasProductos (){
			include_once('../../views/MarcasProductos/GuiBuscarMarcasProductos.html.php');
		}
		public function listarMarcasProductos(){		
			
			extract($_GET);
			$condicion="";
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="where  Descripcion like '$vIngresadodesc%' ";             
			}		
			$listarMarcasP="select Codigo,Descripcion,Estado 
					from marcas_productos  $condicion order by Codigo ASC";
			$ObjMarcasProductos= new MarcasProductosModel();	
			$listarMP=$ObjMarcasProductos->Consultar($listarMarcasP);
			include_once('../../views/MarcasProductos/ListarMarcasProductos.php');
		}
		public function getllenarMarcasProductos(){
			
			extract($_GET); 
			
			if($llenarMarcasP<>""){
				$llenarMarcaP="select Codigo,Descripcion,Estado
				from marcas_productos where Codigo = '$llenarMarcasP' ";
				
				$ObjMarcasProductos= new MarcasProductosModel();			
				$llenalistarMP=$ObjMarcasProductos->Consultar($llenarMarcaP);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarMP as $MP){
				$arrayResultados['Codigo'] = $MP[0];
				$arrayResultados['Descripcion'] = $MP[1];
				$arrayResultados['Estado'] = $MP[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarMarcasProductos(){
			
			extract($_GET);			
			$eliminarGrupo="delete from marcas_productos where Codigo='$cod'";
			$ObjMarcasProductos= new MarcasProductosModel();				
			$eliminar=$ObjMarcasProductos->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('MarcasProductos','MarcasProductos','crearMarcasProductos')."'
					</script>";	
		}
	}
?>


