<?php
	include_once('../../app/Model/Marcas/MarcasModel.php');
	
	class MarcasController{
		
		public function crearMarcas(){						
			
			/*$sqlpais="select * from paises order by nombre";
			$ObjMarcas= new MarcasModel();
			$paises=$ObjMarcas->Consultar($sqlpais);	*/
			
			include_once('../../views/Marcas/GuiMarcas.html.php');			
		}
		public function borar(){

			extract($_POST);
			unset($marca);
			unset($grupo);			

			redirect(getUrl('Marcas','Marcas','crearMarcas'));			
		}
		public function InsertarMarcas(){
			
			extract($_POST);

			$consulMarca="select Codigo_Marca from marcas where Codigo_Marca='$codigo'";
			$ObjMarcas= new MarcasModel();
			$mar=$ObjMarcas->Consultar($consulMarca);			
			
			if(count($mar)==0){	
				$InsertarMarca="insert into marcas (Descripcion,Tipo,Estado) 
							values ('$marca','$grupo','A')";				
				$ObjMarcas= new MarcasModel();
				$InsertMarcas=$ObjMarcas->Insertar($InsertarMarca);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Marcas','Marcas','crearMarcas')."'
					</script>";
			}else
			{
				$ActualizarMarca="update marcas  set  Descripcion='$marca',Tipo='$grupo' 
									where Codigo_Marca='$codigo'";
				$ObjMarcas= new MarcasModel();
				$ActMarca=$ObjMarcas->Actualizar($ActualizarMarca);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Marcas','Marcas','crearMarcas')."'
				</script>";
			}
		
		}
		public function buscarMarcas (){
			include_once('../../views/Marcas/GuiBuscarMarcas.html.php');
		}
		public function listarMarcas(){		
			
			extract($_GET);
			$condicion="";
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion=" and  Descripcion like '$vIngresadodesc%' ";		
			}
			
		$listarMarca="select *  from marcas  where Estado='A' $condicion order by Codigo_Marca ASC";
			$ObjMarcas= new MarcasModel();	
			$listarM=$ObjMarcas->Consultar($listarMarca);
			include_once('../../views/Marcas/ListarMarcas.php');
		}
		public function getllenarMarcas(){
			
			extract($_GET); 
			
			if($llenarMarcas<>""){
				$llenarMar="select * from marcas where Codigo_Marca =  '$llenarMarcas' ";
				$ObjMarcas= new MarcasModel();			
				$llenalistarM=$ObjMarcas->Consultar($llenarMar);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarM as $marca){
				$arrayResultados['Codigo_Marca'] = $marca[0];
				$arrayResultados['Descripcion'] = $marca[1];
				$arrayResultados['Tipo'] = $marca[2];				
				$arrayResultados['Estado'] = $marca[3];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarMarca(){
			
			extract($_GET);			
			$eliminarMarca="delete from marcas where Codigo_Marca='$cod'";
			$ObjMarcas= new MarcasModel();				
			$eliminar=$ObjMarcas->Anular($eliminarMarca);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Marcas','Marcas','crearMarcas')."'
					</script>";	
		}
	}
?>


