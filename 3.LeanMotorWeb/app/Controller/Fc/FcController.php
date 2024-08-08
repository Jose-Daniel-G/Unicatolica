<?php
	include_once('../../app/Model/Fc/FcModel.php');
	
	class FcController{
		
		public function crearFc(){	
		
			$ObjFc= new FcModel();
			$cod=$ObjFc->autoIncrement('nit', 'entidades_seguridad_social');
			
			include_once('../../views/Fc/GuiFc.html.php');			
		}
		public function borar(){

			redirect(getUrl('Fc','Fc','crearFc'));			
		}
		public function InsertarFc(){
			
			extract($_POST);

			$consulGrupo="SELECT Nit from entidades_seguridad_social where Nit='$nit' and Tipo='5'";
			$ObjFc= new FcModel();
			$Fc=$ObjFc->Consultar($consulGrupo);			
			
			if(count($Fc)==0){	
				$InsertarFc="INSERT into entidades_seguridad_social (Nit,Nombre,Tipo,Estado) 
							values ('$nit','$nombre','5','A')";				
				$ObjFc= new FcModel();
				$InsertFc=$ObjFc->Insertar($InsertarFc);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Fc','Fc','crearFc')."'
					</script>";
			}else
			{
				$ActualizarFc="update entidades_seguridad_social  set  Nombre='$nombre' 
									where Nit='$nit' and Tipo='5'";
				$ObjFc= new FcModel();
				$ActLinea=$ObjFc->Actualizar($ActualizarFc);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Fc','Fc','crearFc')."'
				</script>";
			}
		
		}
		public function buscarFc (){
					
			include_once('../../views/Fc/GuiBuscarFc.html.php');
		}
		public function listarFc(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="and  Nombre like '$vIngresadodesc%' ";             
			}

			// dd($_GET);
		echo$listarFc="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='5' $condicion order by Nit ASC";
			$ObjFc= new FcModel();
			$listarFcp=$ObjFc->Consultar($listarFc);
			include_once('../../views/Fc/ListarFc.php');
		}
		public function getllenarFc(){
			
			extract($_GET); 
			
			if($llenarFc<>""){
				$llenarFcp="SELECT Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='5' and
					Nit = '$llenarFc' ";
				$ObjFc= new FcModel();			
				$llenalistarFc=$ObjFc->Consultar($llenarFcp);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarFc as $Fc){
				$arrayResultados['Nit'] = $Fc[0];
				$arrayResultados['Nombre'] = $Fc[1];
				$arrayResultados['Tipo'] = $Fc[4];
				$arrayResultados['Estado'] = $Fc[3];				
				$arrayResultados['Descripcion'] = $Fc[4];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarFc(){
			
			extract($_GET);			
			$eliminarFc="delete from entidades_seguridad_social where Nit='$nit' and Tipo='5'";
			$ObjFc= new FcModel();				
			$eliminar=$ObjFc->Anular($eliminarFc);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Fc','Fc','crearFc')."'
					</script>";	
		}
	}
?>


