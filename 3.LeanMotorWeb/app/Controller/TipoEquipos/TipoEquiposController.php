<?php
	include_once('../../app/Model/TipoEquipos/TipoEquiposModel.php');
	
	class TipoEquiposController{
		
		public function crearTipoEquipos(){						
			
			$sqlGrupo="select * from grupos order by Descripcion"; 
			$ObjTipoEquipos= new TipoEquiposModel();
			$grupos=$ObjTipoEquipos->Consultar($sqlGrupo);	
			
			include_once('../../views/TipoEquipos/GuiTipoEquipos.html.php');			
		}
		public function borar(){

			extract($_POST);
			unset($descripcion);
			unset($grupo);			

			redirect(getUrl('TipoEquipos','TipoEquipos','crearTipoEquipos'));			
		}
		public function InsertarTipoEquipos(){
			
			extract($_POST);

			$consulTequipo="select Codigo_Tipo_Equipo from tipos_equipos where Codigo_Tipo_Equipo='$codigo'";
			$ObjTipoEquipos= new TipoEquiposModel();
			$mar=$ObjTipoEquipos->Consultar($consulTequipo);			
			
			if(count($mar)==0){	
				$InsertarTEquipos="insert into tipos_equipos (Descripcion,Codigo_Grupo,Estado) 
							values ('$descripcion','$grupo','A')";				
				$ObjTipoEquipos= new TipoEquiposModel();
				$InsertTEquipos=$ObjTipoEquipos->Insertar($InsertarTEquipos);
				
				echo"<script type='text/javascript'>
						alert('El Registro se ha realizado con Exito')
						window.location.href='".getUrl('TipoEquipos','TipoEquipos','crearTipoEquipos')."'
					</script>";
			}else
			{
				$ActualizarMarca="update tipos_equipos  set  Descripcion='$descripcion',Codigo_Grupo='$grupo' 
									where Codigo_Tipo_Equipo='$codigo'";
				$ObjTipoEquipos= new TipoEquiposModel();
				$ActMarca=$ObjTipoEquipos->Actualizar($ActualizarMarca);
				
				echo"<script type='text/javascript'>
					alert('El Registro se ha actualizo con Exito')
					window.location.href='".getUrl('TipoEquipos','TipoEquipos','crearTipoEquipos')."'
				</script>";
			}
		
		}
		public function buscarTipoEquipos (){
			include_once('../../views/TipoEquipos/GuiBuscarTipoEquipos.html.php');
		}
		public function listarTipoEquipos(){		
			
			extract($_GET);
			
			$condicion="";
			
			if($vIngresadodesc<>""  and $vIngresadodesc <>"undefined"){
				$condicion=" and  Descripcion like '$vIngresadodesc%' ";		
			}
			
			$listarEquipos="select *  from tipos_equipos where Estado='A' $condicion order by Codigo_Tipo_Equipo ASC";
			$ObjTipoEquipos= new TipoEquiposModel();
			$listarTipoE=$ObjTipoEquipos->Consultar($listarEquipos);
			include_once('../../views/TipoEquipos/ListarTipoEquipos.php');
		}
		public function getllenarTipoEquipos(){
			
			extract($_GET); 
			
			if($llenarEquipos<>""){
				$llenarTE="select Codigo_Tipo_Equipo,te.Descripcion,Estado,g.Descripcion as Desc_Grupo,te.Codigo_Grupo 
					from tipos_equipos as te,grupos as g 
						where te.Codigo_Grupo=g.Codigo_Grupo and Codigo_Tipo_Equipo='$llenarEquipos' ";
				$ObjTipoEquipos= new TipoEquiposModel();
				$llenalistarTE=$ObjTipoEquipos->Consultar($llenarTE);						
			}
			$arrayResultados = array();
			
			foreach($llenalistarTE as $equipos){
				$arrayResultados['Codigo_Tipo_Equipo'] = $equipos[0];
				$arrayResultados['Descripcion'] = $equipos[1];
				$arrayResultados['Desc_Grupo'] = $equipos[3];
				$arrayResultados['Codigo_Grupo'] = $equipos[4];				
				$arrayResultados['Estado'] = $equipos[2];				
				}
			echo json_encode($arrayResultados);
			
		}
		public function getEliminarTipoEquipo(){
			
			extract($_GET);			
			echo$eliminarMarca="delete from tipos_equipos where Codigo_Tipo_Equipo='$cod'";
			$ObjTipoEquipos= new TipoEquiposModel();
			$eliminar=$ObjTipoEquipos->Anular($eliminarMarca);
			
			echo"<script type='text/javascript'>
						alert('El Registro se elimino con Exito')
						window.location.href='".getUrl('TipoEquipos','TipoEquipos','crearTipoEquipos')."'
					</script>";	
		}
		
		function buscarTipoEquipoEnDoc()
		{
		    $desc=$_POST['equipo_des'];
            //dd("hola".$data_fila);
            $listarEquipos="select Codigo_Tipo_Equipo, Descripcion, Estado  
                                    from tipos_equipos where Estado='A' and Descripcion like '$desc%' order by Descripcion";
			$ObjTipoEquipos= new TipoEquiposModel();
			$tipo_Equipos=$ObjTipoEquipos->Consultar($listarEquipos);
        	include_once('../../views/TipoEquipos/GuiListarTipoEquiposEnDoc.html.php'); 
		}
	}
?>


