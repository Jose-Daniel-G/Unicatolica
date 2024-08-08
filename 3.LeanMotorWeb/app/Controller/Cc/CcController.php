<?php
	include_once('../../app/Model/Cc/CcModel.php');
	
	class CcController{
		
		public function crearCc(){	
		
					
			include_once('../../views/Cc/GuiCc.html.php');			
		}
		public function borar(){

			redirect(getUrl('Cc','Cc','crearCc'));			
		}
		public function InsertarCc(){
			
			extract($_POST);

			$consulGrupo="select Nit from entidades_seguridad_social where Nit='$nit' and Tipo='3'";
			$ObjCc= new CcModel();
			$Cc=$ObjCc->Consultar($consulGrupo);			
			
			if(count($Cc)==0){	
				$InsertarCc="insert into entidades_seguridad_social (Nit,Nombre,Tipo,Estado) 
							values ('$nit','$nombre','3','A')";				
				$ObjCc= new CcModel();
				$InsertCc=$ObjCc->Insertar($InsertarCc);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Cc','Cc','crearCc')."'
					</script>";
			}else
			{
				$ActualizarCc="update entidades_seguridad_social  set  Nombre='$nombre' 
									where Nit='$nit' and Tipo='3'";
				$ObjCc= new CcModel();
				$ActLinea=$ObjCc->Actualizar($ActualizarCc);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Cc','Cc','crearCc')."'
				</script>";
			}
		
		}
		public function buscarCc (){
					
			include_once('../../views/Cc/GuiBuscarCc.html.php');
		}
		public function listarCc(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="and  Nombre like '$vIngresadodesc%' ";             
			}

			// dd($_GET);
		$listarCc="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='3' $condicion order by Nit ASC";
			$ObjCc= new CcModel();
			$listarCcp=$ObjCc->Consultar($listarCc);
			include_once('../../views/Cc/ListarCc.php');
		}
		public function getllenarCc(){
			
			extract($_GET); 
			
			if($llenarCc<>""){
				$llenarCcp="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='3' and
					Nit = '$llenarCc' ";
				$ObjCc= new CcModel();			
				$llenalistarCc=$ObjCc->Consultar($llenarCcp);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarCc as $Cc){
				$arrayResultados['Nit'] = $Cc[0];
				$arrayResultados['Nombre'] = $Cc[1];
				$arrayResultados['Tipo'] = $Cc[4];
				$arrayResultados['Estado'] = $Cc[3];				
				$arrayResultados['Descripcion'] = $Cc[4];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarCc(){
			
			extract($_GET);			
			$eliminarCc="delete from entidades_seguridad_social where Nit='$nit' and Tipo='3'";
			$ObjCc= new CcModel();				
			$eliminar=$ObjCc->Anular($eliminarCc);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Cc','Cc','crearCc')."'
					</script>";	
		}
	}
?>


