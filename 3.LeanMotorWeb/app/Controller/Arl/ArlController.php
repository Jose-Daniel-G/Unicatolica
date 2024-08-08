<?php
	include_once('../../app/Model/Arl/ArlModel.php');
	
	class ArlController{
		
		public function crearArl(){	
		
			
			
			include_once('../../views/Arl/GuiArl.html.php');			
		}
		public function borar(){

			redirect(getUrl('Arl','Arl','crearArl'));			
		}
		public function InsertarArl(){
			
			extract($_POST);

			$consulGrupo="select Nit from entidades_seguridad_social where Nit='$nit' and Tipo='2'";
			$ObjArl= new ArlModel();
			$Arl=$ObjArl->Consultar($consulGrupo);			
			
			if(count($Arl)==0){	
				$InsertarArl="insert into entidades_seguridad_social (Nit,Nombre,Tipo,Estado) 
							values ('$nit','$nombre','2','A')";				
				$ObjArl= new ArlModel();
				$InsertArl=$ObjArl->Insertar($InsertarArl);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Arl','Arl','crearArl')."'
					</script>";
			}else
			{
				$ActualizarArl="update entidades_seguridad_social  set  Nombre='$nombre' 
									where Nit='$nit' and Tipo='2'";
				$ObjArl= new ArlModel();
				$ActLinea=$ObjArl->Actualizar($ActualizarArl);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Arl','Arl','crearArl')."'
				</script>";
			}
		
		}
		public function buscarArl (){
					
			include_once('../../views/Arl/GuiBuscarArl.html.php');
		}
		public function listarArl(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="and  Nombre like '$vIngresadodesc%' ";             
			}

			// dd($_GET);
		$listarArls="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.Tipo=tipo.Codigo and Tipo='2' $condicion order by Nit ASC";
			$ObjArl= new ArlModel();
			$listarArl=$ObjArl->Consultar($listarArls);
			include_once('../../views/Arl/ListarArl.php');
		}
		public function getllenarArl(){
			
			extract($_GET); 
			
			if($llenarArl<>""){
				$llenarArll="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='2' and
					Nit = '$llenarArl' ";
				$ObjArl= new ArlModel();			
				$llenalistarArl=$ObjArl->Consultar($llenarArll);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarArl as $Arl){
				$arrayResultados['Nit'] = $Arl[0];
				$arrayResultados['Nombre'] = $Arl[1];
				$arrayResultados['Tipo'] = $Arl[4];
				$arrayResultados['Estado'] = $Arl[3];				
				$arrayResultados['Descripcion'] = $Arl[4];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarArl(){
			
			extract($_GET);			
			$eliminarGrupo="delete from entidades_seguridad_social where Nit='$nit' and Tipo='2'";
			$ObjArl= new ArlModel();				
			$eliminar=$ObjArl->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Arl','Arl','crearArl')."'
					</script>";	
		}
	}
?>


