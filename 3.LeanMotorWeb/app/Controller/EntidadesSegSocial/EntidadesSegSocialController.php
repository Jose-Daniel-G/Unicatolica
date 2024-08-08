<?php
	include_once('../../app/Model/EntidadesSegSocial/EntidadesSegSocialModel.php');
	
	class EntidadesSegSocialController{
		
		public function crearEntidadesSegSocial(){	
		    
		    $ObjEntidadesSegSocial= new EntidadesSegSocialModel();
			$sqlTipo="select * from tipo_entidades_seg_social order by Descripcion";
			$TipoSeg=$ObjEntidadesSegSocial->Consultar($sqlTipo);
			
			include_once('../../views/EntidadesSegSocial/GuiEntidadesSegSocial.html.php');			
		}
		public function borar(){

			redirect(getUrl('EntidadesSegSocial','EntidadesSegSocial','crearEntidadesSegSocial'));			
		}
		public function InsertarEntidadesSegSocial(){
			
			extract($_POST);

			$consulGrupo="select Nit from entidades_seguridad_social where Nit='$nit'";
			$ObjEntidadesSegSocial= new EntidadesSegSocialModel();
			$EntidadesSegSocial=$ObjEntidadesSegSocial->Consultar($consulGrupo);			
			
			if(count($EntidadesSegSocial)==0){	
				$InsertarEntidadesSegSocial="insert into entidades_seguridad_social (Nit,Nombre,Tipo,Estado) 
							values ('$nit','$nombre','$tipo','A')";				
				$ObjEntidadesSegSocial= new EntidadesSegSocialModel();
				$InsertEntidadesSegSocial=$ObjEntidadesSegSocial->Insertar($InsertarEntidadesSegSocial);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('EntidadesSegSocial','EntidadesSegSocial','crearEntidadesSegSocial')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update entidades_seguridad_social  set  Nombre='$nombre' , Tipo='$tipo' 
									where Nit='$nit'";
				$ObjEntidadesSegSocial= new EntidadesSegSocialModel();
				$ActLinea=$ObjEntidadesSegSocial->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('EntidadesSegSocial','EntidadesSegSocial','crearEntidadesSegSocial')."'
				</script>";
			}
		
		}
		public function buscarEntidadesSegSocial (){
			$sqlTipo="select * from tipo_entidades_seg_social order by Descripcion";
			$ObjEntidadesSegSocial= new EntidadesSegSocialModel();	
			$TipoSeg=$ObjEntidadesSegSocial->Consultar($sqlTipo);
			
			include_once('../../views/EntidadesSegSocial/GuiBuscarEntidadesSegSocial.html.php');
		}
		public function listarEntidadesSegSocial(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="and  Nombre like '$vIngresadodesc%' ";             
			}
			if($tipo<>""  and $tipo <>"undefined"){
				$condicion="and  Tipo='$tipo' ";             
			}
			// dd($_GET);
		        $listarSeguridad="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo  $condicion order by Nit ASC";
			$ObjEntidadesSegSocial= new EntidadesSegSocialModel();
			$listarSeg=$ObjEntidadesSegSocial->Consultar($listarSeguridad);
			include_once('../../views/EntidadesSegSocial/ListarEntidadesSegSocial.php');
		}
		public function getllenarEntidadesSegSocial(){
			
			extract($_GET); 
			
			if($llenarEntidadesSegSocial<>""){
				$llenarVivi="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.Tipo=tipo.Codigo and Nit = '$llenarEntidadesSegSocial' ";
				$ObjEntidadesSegSocial= new EntidadesSegSocialModel();			
				$llenalistarVivi=$ObjEntidadesSegSocial->Consultar($llenarVivi);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarVivi as $Vivienda){
				$arrayResultados['Nit'] = $Vivienda[0];
				$arrayResultados['Nombre'] = $Vivienda[1];
				$arrayResultados['Tipo'] = $Vivienda[2];
				$arrayResultados['Estado'] = $Vivienda[3];				
				$arrayResultados['Descripcion'] = $Vivienda[4];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarEntidadesSegSocial(){
			
			extract($_GET);			
			$eliminarGrupo="delete from entidades_seguridad_social where Nit='$nit'";
			$ObjEntidadesSegSocial= new EntidadesSegSocialModel();				
			$eliminar=$ObjEntidadesSegSocial->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('EntidadesSegSocial','EntidadesSegSocial','crearEntidadesSegSocial')."'
					</script>";	
		}
	}
?>


