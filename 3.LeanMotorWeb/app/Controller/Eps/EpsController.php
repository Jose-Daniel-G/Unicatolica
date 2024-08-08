<?php
	include_once('../../app/Model/Eps/EpsModel.php');
	
	class EpsController{
		
		public function crearEps(){	
		
			$ObjEps= new EpsModel();
			$cod=$ObjEps->autoIncrement('nit', 'entidades_seguridad_social');
			
			include_once('../../views/Eps/GuiEps.html.php');			
		}
		public function borar(){

			redirect(getUrl('Eps','Eps','crearEps'));			
		}
		public function InsertarEps(){
			
			extract($_POST);

			$consulGrupo="select Nit from entidades_seguridad_social where Nit='$nit' and Tipo='1'";
			$ObjEps= new EpsModel();
			$Eps=$ObjEps->Consultar($consulGrupo);			
			
			if(count($Eps)==0){	
				$InsertarEps="insert into entidades_seguridad_social (Nit,Nombre,Tipo,Estado) 
							values ('$nit','$nombre','1','A')";				
				$ObjEps= new EpsModel();
				$InsertEps=$ObjEps->Insertar($InsertarEps);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Eps','Eps','crearEps')."'
					</script>";
			}else
			{
				$ActualizarGrupo="update entidades_seguridad_social  set  Nombre='$nombre' 
									where Nit='$nit' and Tipo='1'";
				$ObjEps= new EpsModel();
				$ActLinea=$ObjEps->Actualizar($ActualizarGrupo);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Eps','Eps','crearEps')."'
				</script>";
			}
		
		}
		public function buscarEps (){
					
			include_once('../../views/Eps/GuiBuscarEps.html.php');
		}
		public function listarEps(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="and  Nombre like '$vIngresadodesc%' ";             
			}

			// dd($_GET);
		echo$listarEpss="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='1' $condicion order by Nit ASC";
			$ObjEps= new EpsModel();
			$listarEps=$ObjEps->Consultar($listarEpss);
			include_once('../../views/Eps/ListarEps.php');
		}
		public function getllenarEps(){
			
			extract($_GET); 
			
			if($llenarEps<>""){
				$llenarVivi="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='1' and
					Nit = '$llenarEps' ";
				$ObjEps= new EpsModel();			
				$llenalistarEps=$ObjEps->Consultar($llenarVivi);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarEps as $Eps){
				$arrayResultados['Nit'] = $Eps[0];
				$arrayResultados['Nombre'] = $Eps[1];
				$arrayResultados['Tipo'] = $Eps[4];
				$arrayResultados['Estado'] = $Eps[3];				
				$arrayResultados['Descripcion'] = $Eps[4];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarEps(){
			
			extract($_GET);			
			$eliminarGrupo="delete from entidades_seguridad_social where Nit='$nit' and Tipo='1'";
			$ObjEps= new EpsModel();				
			$eliminar=$ObjEps->Anular($eliminarGrupo);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Eps','Eps','crearEps')."'
					</script>";	
		}
	}
?>


