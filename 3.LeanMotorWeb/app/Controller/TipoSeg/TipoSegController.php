<?php
	include_once('../../app/Model/TipoSeg/TipoSegModel.php');
	
	class TipoSegController{
		
		public function crearTipoSeg(){	
		
			$ObjTipoSeg= new TipoSegModel();
			$cod=$ObjTipoSeg->autoIncrement('Codigo', 'tipo_entidades_seg_social');
			include_once('../../views/TipoSeg/GuiTipoSeg.html.php');			
		}
		public function borar(){

			redirect(getUrl('TipoSeg','TipoSeg','crearTipoSeg'));			
		}
		public function InsertarTipoSeg(){
			
			extract($_POST);

			$consulGrupo="select Codigo from tipo_entidades_seg_social where Codigo='$codigo'";
			$ObjTipoSeg= new TipoSegModel();
			$TipoSeg=$ObjTipoSeg->Consultar($consulGrupo);			
			
			if(count($TipoSeg)==0){	
				$InsertarTipoSeg="insert into tipo_entidades_seg_social (Codigo,Descripcion,Estado) 
							values ('$codigo','$desc','A')";				
				$ObjTipoSeg= new TipoSegModel();
				$InsertTipoSeg=$ObjTipoSeg->Insertar($InsertarTipoSeg);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('TipoSeg','TipoSeg','crearTipoSeg')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update tipo_entidades_seg_social  set  Descripcion='$desc' 
									where Codigo='$codigo'";
				$ObjTipoSeg= new TipoSegModel();
				$ActLinea=$ObjTipoSeg->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('TipoSeg','TipoSeg','crearTipoSeg')."'
				</script>";
			}
		
		}
		public function buscarTipoSeg (){
			include_once('../../views/TipoSeg/GuiBuscarTipoSeg.html.php');
		}
		public function listarTipoSeg(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="where  Descripcion like '$vIngresadodesc%' ";             
			}

		$listarTipoSeguro="select Codigo,Descripcion,Estado 
					from tipo_entidades_seg_social  $condicion order by Codigo ASC";
			$ObjTipoSeg= new TipoSegModel();	
			$listarTipoSeg=$ObjTipoSeg->Consultar($listarTipoSeguro);
			include_once('../../views/TipoSeg/ListarTipoSeg.php');
		}
		public function getllenarTipoSeg(){
			
			extract($_GET); 
			
			if($llenarTipoSeg<>""){
				$llenarVivi="select Codigo,Descripcion,Estado
				from tipo_entidades_seg_social where Codigo =  '$llenarTipoSeg' ";
				$ObjTipoSeg= new TipoSegModel();			
				$llenalistarTipoSeg=$ObjTipoSeg->Consultar($llenarVivi);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarTipoSeg as $TipoSeg){
				$arrayResultados['Codigo'] = $TipoSeg[0];
				$arrayResultados['Descripcion'] = $TipoSeg[1];
				$arrayResultados['Estado'] = $TipoSeg[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarTipoSeg(){
			
			extract($_GET);			
			$eliminarGrupo="delete from tipo_entidades_seg_social where Codigo='$cod'";
			$ObjTipoSeg= new TipoSegModel();				
			$eliminar=$ObjTipoSeg->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('TipoSeg','TipoSeg','crearTipoSeg')."'
					</script>";	
		}
	}
?>


