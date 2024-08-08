<?php
	include_once('../../app/Model/Fp/FpModel.php');
	
	class FpController{
		
		public function crearFp(){	
		
			$ObjFp= new FpModel();
			$cod=$ObjFp->autoIncrement('nit', 'entidades_seguridad_social');
			
			include_once('../../views/Fp/GuiFp.html.php');			
		}
		public function borar(){

			redirect(getUrl('Fp','Fp','crearFp'));			
		}
		public function InsertarFp(){
			
			extract($_POST);

			$consulGrupo="select Nit from entidades_seguridad_social where Nit='$nit' and Tipo='4'";
			$ObjFp= new FpModel();
			$Fp=$ObjFp->Consultar($consulGrupo);			
			
			if(count($Fp)==0){	
				$InsertarFp="insert into entidades_seguridad_social (Nit,Nombre,Tipo,Estado) 
							values ('$nit','$nombre','4','A')";				
				$ObjFp= new FpModel();
				$InsertFp=$ObjFp->Insertar($InsertarFp);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('Fp','Fp','crearFp')."'
					</script>";
			}else
			{
				$ActualizarFp="update entidades_seguridad_social  set  Nombre='$nombre' 
									where Nit='$nit' and Tipo='4'";
				$ObjFp= new FpModel();
				$ActLinea=$ObjFp->Actualizar($ActualizarFp);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('Fp','Fp','crearFp')."'
				</script>";
			}
		
		}
		public function buscarFp (){
					
			include_once('../../views/Fp/GuiBuscarFp.html.php');
		}
		public function listarFp(){		
			
			extract($_GET);
			$condicion="";			
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion="and  Nombre like '$vIngresadodesc%' ";             
			}

			// dd($_GET);
		echo$listarFp="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='4' $condicion order by Nit ASC";
			$ObjFp= new FpModel();
			$listarFpp=$ObjFp->Consultar($listarFp);
			include_once('../../views/Fp/ListarFp.php');
		}
		public function getllenarFp(){
			
			extract($_GET); 
			
			if($llenarFp<>""){
				$llenarFpp="select Nit,Nombre,Tipo,seg.Estado,Descripcion 
					from entidades_seguridad_social as seg,tipo_entidades_seg_social as tipo
                    where seg.tipo=tipo.Codigo and Tipo='4' and
					Nit = '$llenarFp' ";
				$ObjFp= new FpModel();			
				$llenalistarFp=$ObjFp->Consultar($llenarFpp);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarFp as $Fp){
				$arrayResultados['Nit'] = $Fp[0];
				$arrayResultados['Nombre'] = $Fp[1];
				$arrayResultados['Tipo'] = $Fp[4];
				$arrayResultados['Estado'] = $Fp[3];				
				$arrayResultados['Descripcion'] = $Fp[4];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarFp(){
			
			extract($_GET);			
			$eliminarFp="delete from entidades_seguridad_social where Nit='$nit' and Tipo='4'";
			$ObjFp= new FpModel();				
			$eliminar=$ObjFp->Anular($eliminarFp);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('Fp','Fp','crearFp')."'
					</script>";	
		}
	}
?>


