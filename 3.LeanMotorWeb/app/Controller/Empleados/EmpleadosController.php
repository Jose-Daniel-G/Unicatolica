<?php
@session_start();
	@include_once('../../app/Model/Empleados/EmpleadosModel.php');
	class EmpleadosController{
		
		function crearEmpleado(){
			
			$ObjEmpleados= new EmpleadosModel();
			$sqlciudad="select Codigo_Ciudad, Nombre from ciudades order by Nombre";
			$ciudades=$ObjEmpleados->Consultar($sqlciudad);
						
			$sqlcargos="select * from cargos order by Descripcion";
			$cargos=$ObjEmpleados->Consultar($sqlcargos);
						
			$sqlcentrocos="select * from centro_costos order by Descripcion";
			$costos=$ObjEmpleados->Consultar($sqlcentrocos);
			
			$sqlprocesig="select * from procesosig order by Descripcion";
			$procesosig=$ObjEmpleados->Consultar($sqlprocesig);
			
			$sqlsede="select nit_empresa, nombre from sedes order by nombre";
            $sedes=$ObjEmpleados->Consultar($sqlsede);
			
			include_once('../../views/Empleados/GuiEmpleados.html.php');
		}
		
		function postCrearEmpleado(){
		    
		  /*  extract($_POST);
		    
			$fechaCrea=date('y-m-d');
			$i=0;
			
			$funEmpleado=$_POST['funEmpleado'];
			$num_funciones=count($funEmpleado);
			$current=0;
			if(is_array($funEmpleado))
			{
				foreach($funEmpleado as $key=>$value)
				{
					if($current != $num_funciones-1)
					{
						$fun_selected[$i]=$value;
						$i++;
					}
					else
					{
						$fun_selected[$i]=$value;
					}
					$current++;
				}
			}
			$ObjEmpleados= new EmpleadosModel();	
			$sqlEmp="select * from empleados where Cedula_Empleado='$cedula_emple'";
				
			$empleado=$ObjEmpleados->Consultar($sqlEmp);
		
			if($empleado == null)
			{/*
			    echo"hola";
			    
				mysql_query("SET AUTOCOMMIT=0");
				mysql_query("START TRANSACTION");
				mysql_query("LOCK TABLES empleados, detalle_pantallas_empleados WRITE;");
				$regEmp="insert into empleados(Cedula_Empleado, Nombres, Apellidos, Direccion, Estado,
					Fecha_Nacido, Codigo_Empleado, Codigo_Centro_Costo, Cargo, Permiso_Cotizar,
					Salario_Basico, Auxilio_Transporte, FechaIngreso, Telefono, Telefono_2,
					Tipo_Ingreso, ProcesoSig, FirmaInformeTecnico, CiudadResidencia, LugarNacimiento, Email,Nit_Empresa)
					values('$cedula_emple', '$nom_emple', '$apell_emple', '$dir_emple', 'A', '$fnacimiento',
					'$cod_emple', '$centroCosto', '$cargo_emple', '', '$salario_emple', '', '$fingreso', 
					'$tel1', '$tel2', '', '$psig', '', '$ciudad', '$lugarn', '$mail_emple','$nit_sede')";
				
					
				$Emp=$ObjEmpleados->Insertar($regEmp);
				
				for($i=0; $i<count($fun_selected); $i++)
				{
					$sqlIDetalle="insert into detalle_pantallas_empleados values ('".$fun_selected[$i]."', '".$cedula_emple."')";
						dd($sqlIDetalle);
					$InserD=$ObjEmpleados->Consultar($sqlIDetalle);
					
				}
				
				mysql_query("unlock tables;");
				mysql_query("COMMIT");
				
				echo"<script type='text/javascript'>
						alert('Registro Exitoso')
						window.location.href='".getUrl('Empleados','Empleados','crearEmpleado')."'
					</script>";	
			}*/
		    
		    
			
			extract($_POST);
			
			$ObjEmpleados= new EmpleadosModel();

			if(!isset($firmaInfoTec)){$firmaInfoTec='N';}else{$firmaInfoTec="S";}

			if (isset($fnacimiento)) {
				$fnacimiento = date_create($fnacimiento);
				$fnacimiento = date_format($fnacimiento, 'Y-m-d');
			}
			if (isset($fingreso)) {
				$fingreso = date_create($fingreso);
				$fingreso = date_format($fingreso, 'Y-m-d');
			}
		
			/*$fechaCrea=date('y-m-d');
			$i=0;
			
			$funEmpleado=$_POST['funEmpleado'];
			$num_funciones=count($funEmpleado);
			$current=0;
			if(is_array($funEmpleado))
			{
				foreach($funEmpleado as $key=>$value)
				{
					if($current != $num_funciones-1)
					{
						$fun_selected[$i]=$value;
						$i++;
					}
					else
					{
						$fun_selected[$i]=$value;
					}
					$current++;
				}
			}*/
			$sqlEmp="SELECT * FROM empleados WHERE Cedula_Empleado='$cedula_emple'";
			$empleado=$ObjEmpleados->Consultar($sqlEmp);
			
	/*	if(!isset($firma)){
		    
		     $firmaInfoTec="N";
		}
		else
		{
		     $firmaInfoTec="S";
		}*/
		
	
			if($empleado == null){
				$regEmp="INSERT INTO empleados
				(Cedula_Empleado, Nombres, Apellidos, Direccion, Estado, Fecha_Nacido, Codigo_Empleado, Codigo_Centro_Costo, Cargo, Permiso_Cotizar, 
				Salario_Basico, Auxilio_Transporte, FechaIngreso, Telefono, Telefono_2, Tipo_Ingreso, ProcesoSig, FirmaInformeTecnico, CiudadResidencia, 
				LugarNacimiento, Email, Nit_Empresa)
				VALUES
				('$cedula_emple', '$nom_emple', '$apell_emple', '$dir_emple', 'A', '$fnacimiento', '$cod_emple', '$centroCosto', '$cargo_emple', '', 
				'$salario_emple', '', '$fingreso', '$tel1', '$tel2', '$tvincula', '$psig', '$firmaInfoTec', '$ciudad', 
				'$lugarn', '$mail_emple', '$nit_sede')";

				$Emp=$ObjEmpleados->Insertar($regEmp);
				
				for($i=0; $i<count($funEmpleado); $i++){
						$sqlIDetalle="INSERT INTO detalle_pantallas_empleados VALUES ('$funEmpleado[$i]', '$cedula_emple')";
						$InserD=$ObjEmpleados->Insertar($sqlIDetalle);
				}
				
				echo messageSweetAlert("El registro se ha realizado con éxito", "", "success", "", "si", "automatica", getUrl('Empleados', 'Empleados', 'crearEmpleado'), 2500);
			}
			else{    
				$actEmpleado="update empleados set Nombres='$nom_emple',Apellidos='$apell_emple',Direccion='$dir_emple',
							Fecha_Nacido='$fnacimiento',Codigo_Empleado='$cod_emple',Codigo_Centro_Costo='$centroCosto',
							Cargo='$cargo_emple',Salario_Basico='$salario_emple',FechaIngreso='$fingreso',
							Telefono='$tel1', Telefono_2='$tel2',Tipo_Ingreso='$tvincula',ProcesoSig='$psig',
							FirmaInformeTecnico='$firmaInfoTec',CiudadResidencia='$ciudad',LugarNacimiento='$lugarn',
							Email='$mail_emple', Nit_Empresa='$nit_sede' where  Cedula_Empleado='$cedula_emple'";	
					
					$ObjEmpleados= new EmpleadosModel();	
					$actuaemple=$ObjEmpleados->Actualizar($actEmpleado);

					// echo"<script type='text/javascript'>
					// 	alert('El Registro se ha actualizo con Exito hhhhhh')
					// 	window.location.href='".getUrl('Empleados','Empleados','crearEmpleado')."'
					// </script>";
			}
		}

		function getVerEmpleado(){
			$ObjEmpleados=new EmpleadosModel();
			
			$cedula=$_GET['cedula'];
			$sede=$_GET['nit_sede'];

			$sql = "SELECT * FROM empleados WHERE Cedula_Empleado='$cedula' AND Nit_Empresa='$sede'";
			$empleados=$ObjEmpleados->Consultar($sql);
		
			$sqlciudad="SELECT Codigo_Ciudad, Nombre FROM ciudades ORDER BY Nombre";
			$ciudades=$ObjEmpleados->Consultar($sqlciudad);
						
			$sqlcargos="SELECT * FROM cargos ORDER BY Descripcion";
			$cargos=$ObjEmpleados->Consultar($sqlcargos);
						
			$sqlcentrocos="SELECT * FROM centro_costos ORDER BY Descripcion";
			$costos=$ObjEmpleados->Consultar($sqlcentrocos);
			
			$sqlprocesig="SELECT * FROM procesosig ORDER BY Descripcion";
			$procesosig=$ObjEmpleados->Consultar($sqlprocesig);

			$sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
			$sedes=$ObjEmpleados->Consultar($sqlsede);
			
			include_once("../../views/Empleados/GuiVerEmpleados.html.php");
		}

		function getEditarEmpleado(){
			$ObjEmpleados=new EmpleadosModel();
			
			$cedula=$_GET['cedula'];
			$sede=$_GET['nit_sede'];

			$sql = "SELECT * FROM empleados WHERE Cedula_Empleado='$cedula' AND Nit_Empresa='$sede'";
			$empleados=$ObjEmpleados->Consultar($sql);
		
			$sqlciudad="SELECT Codigo_Ciudad, Nombre FROM ciudades ORDER BY Nombre";
			$ciudades=$ObjEmpleados->Consultar($sqlciudad);
						
			$sqlcargos="SELECT * FROM cargos ORDER BY Descripcion";
			$cargos=$ObjEmpleados->Consultar($sqlcargos);
						
			$sqlcentrocos="SELECT * FROM centro_costos ORDER BY Descripcion";
			$costos=$ObjEmpleados->Consultar($sqlcentrocos);
			
			$sqlprocesig="SELECT * FROM procesosig ORDER BY Descripcion";
			$procesosig=$ObjEmpleados->Consultar($sqlprocesig);

			$sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
			$sedes=$ObjEmpleados->Consultar($sqlsede);
			
			include_once("../../views/Empleados/GuiEditarEmpleados.html.php");
		}

		function postEditarEmpleado(){
			extract($_POST);

			$ObjEmpleados= new EmpleadosModel();	
			
			if(!isset($firmaInfoTec)){$firmaInfoTec='N';}else{$firmaInfoTec="S";}

			$sql="UPDATE empleados SET Cedula_Empleado='$cedula_emple_update', Nombres='$nom_emple', Apellidos='$apell_emple', Direccion='$dir_emple',
			Fecha_Nacido='$fnacimiento', Codigo_Empleado='$cod_emple', Codigo_Centro_Costo='$centroCosto', Cargo='$cargo_emple', Salario_Basico='$salario_emple',FechaIngreso='$fingreso',
			Telefono='$tel1', Telefono_2='$tel2', Tipo_Ingreso='$tvincula', ProcesoSig='$psig', FirmaInformeTecnico='$firmaInfoTec', CiudadResidencia='$ciudad', 
			LugarNacimiento='$lugarn', Email='$mail_emple', Nit_Empresa='$nit_sede' WHERE  Cedula_Empleado='$cedula_emple'";
			$ObjEmpleados->Actualizar($sql);

			echo messageSweetAlert("El registro se ha actualizado con éxito", "", "success", "", "si", "automatica", getUrl('Empleados', 'Empleados', 'getEditarEmpleado', array("cedula" => $cedula_emple_update, "nit_sede" => $nit_sede)), 2500);
		}
		
		function borrar(){
			redirect(getUrl('Empleados','Empleados','crearEmpleado'));			
		}
		
		function modalBuscarEmpleado(){
			include_once('../../views/Empleados/GuiModalBuscarEmpleado.html.php');
		}
		
		function ListarEmpleados(){
			extract($_POST);

			$ObjEmpleados=new EmpleadosModel();

			$condicion="";
			
			if($cedula<>""){
				$condicion = "AND Cedula_Empleado LIKE '%$cedula%' ";             
			}
			if($nombre<>""){
				$condicion .= "AND Nombres LIKE '%$nombre%' ";             
			}
			if($cargo<>""){
				$condicion .= "AND cargos.Descripcion LIKE '%$cargo%' ";   
			}
			if ($estado<>"" && $estado == "T") {
				$estado = null;
			}
			
			$sqlbusEmple="SELECT CONCAT(empleados.Nombres,' ',empleados.Apellidos) 
			AS Nombre_Completo, empleados.Cedula_Empleado, cargos.Descripcion AS Cargo, empleados.Nit_Empresa, empleados.Estado 
			FROM empleados, cargos 
			WHERE empleados.Cargo = cargos.CodigoCargo 
			AND cargos.Estado = 'A' AND empleados.Estado LIKE '%$estado%' $condicion";
			$listaremple=$ObjEmpleados->Consultar($sqlbusEmple);
			
			$sqlpantalla="select * from pantallas_empleados";
			$pantallas=$ObjEmpleados->Consultar($sqlpantalla);
			
			$datos = array();
			$numero_empleado=1;

			if ($listaremple != null) {
				foreach ($listaremple as $listarempleados) {
					array_push($datos,
						array(
							"numeroEmpleado" => '<button class="href">'.$numero_empleado.'</button>',
							"nombre" 		   		 => $listarempleados["Nombre_Completo"], 
							"cedula"   			 	   => $listarempleados["Cedula_Empleado"],
							"cargo"     		       => $listarempleados["Cargo"],
							"nit_empresa"           => $listarempleados["Nit_Empresa"],
							"estado"   			       => $listarempleados["Estado"]
						));
						$numero_empleado++;
					}
			}
			
            $tabla = array("data" => $datos);
            
			echo json_encode($tabla);
		}

		function informeEmpleados(){
			include_once('../../views/Empleados/GuiInformeEmpleados.html.php');
		}
		
		function listarInformeEmpleado(){
			extract($_POST);
			$ObjEmpleados= new EmpleadosModel();

			$condicion="";

			if($estado=="Activos"){
				$condicion=" AND e.Estado='A'";
			}
			if($estado=="Inactivos"){
				$condicion=" AND e.Estado='I'";
			}
			if($estado=="Todos"){
				$condicion="";
			}

			$listarinfo="SELECT Codigo_Empleado, Cedula_Empleado, Nombres, Apellidos, FechaIngreso, Cargo, Descripcion, 
			FechaCambio, FORMAT(Salario_Basico, 0) AS Salario_Basico, FORMAT(ValorSalario, 0) AS ValorSalario, Fecha_Nacido, 
			Direccion, Telefono, Telefono_2, Email, ciu.Nombre AS CiudadResidencia, ciu2.Nombre AS LugarNacimiento
			FROM empleados AS e, detalle_empleados_salarios AS dts, centro_costos AS cc, ciudades AS ciu, ciudades AS ciu2 
			WHERE dts.CedulaEmpleado=e.Cedula_Empleado AND e.Codigo_Centro_Costo=cc.Codigo AND e.CiudadResidencia = ciu.Codigo_Ciudad 
			AND e.LugarNacimiento = ciu2.Codigo_Ciudad $condicion ORDER BY Codigo_Empleado ASC";
			$listarinforme=$ObjEmpleados->Consultar($listarinfo);

			$datos = array();

			if ($listarinforme != null) {
				foreach ($listarinforme as $listarinformes) {
						array_push($datos, array(
							"codigo" 		   		 => $listarinformes["Codigo_Empleado"],
							"cedula" 		   		 => $listarinformes["Cedula_Empleado"],
							"nombres"   			 	   => $listarinformes["Nombres"],
							"apellidos"     		       => $listarinformes["Apellidos"],
							"ingreso"           => substr($listarinformes["FechaIngreso"], 0, 10),
							"cargo"   			       => $listarinformes["Cargo"],
							"centro_costo"   			       => $listarinformes["Descripcion"],
							"fecha_aumento"   			       => substr($listarinformes["FechaCambio"], 0, 10),
							"salario"   			       => $listarinformes["Salario_Basico"],
							"salario_anterior"   			       => $listarinformes["ValorSalario"],
							"fecha_nacimiento"   			       => substr($listarinformes["Fecha_Nacido"], 0, 10),
							"direccion"   			       => $listarinformes["Direccion"],
							"telefono1"   			       => $listarinformes["Telefono"],
							"telefono2"   			       => $listarinformes["Telefono_2"],
							"email"   			       => $listarinformes["Email"],
							"ciudad_residencia"   			       => $listarinformes["CiudadResidencia"],
							"lugar_nacimiento"   			       => $listarinformes["LugarNacimiento"]
						));
					}
			}

			$tabla = array("data" => $datos);
            
            echo json_encode($tabla);
		}
	    
	    function getllenarEmple(){
			extract($_GET);
			if($llenarE<>""){
				$sqllenarEmple="select Cedula_Empleado,Nombres,Apellidos,e.Direccion,Fecha_Nacido, Codigo_Empleado,c.Descripcion,Cargo,Salario_Basico,FechaIngreso,e.Telefono,Telefono_2,Tipo_Ingreso,
				                    ProcesoSig,
				                    FirmaInformeTecnico, CiudadResidencia,LugarNacimiento,e.Email, ciudades.Nombre, e.Codigo_Centro_Costo, sedes.Nit_Empresa
    								from empleados as e,centro_costos as c, ciudades, sedes
        								where e.Codigo_Centro_Costo=c.Codigo 
        								and e.CiudadResidencia=ciudades.Codigo_Ciudad
        								and e.Nit_Empresa=sedes.nit_empresa
        								and Cedula_Empleado='$llenarE'";
			$ObjEmpleados= new EmpleadosModel();			
			$llenarEmp=$ObjEmpleados->Consultar($sqllenarEmple);	
			}
			$arrayResultados = array();
			
			foreach($llenarEmp as $emp){
				$arrayResultados['Cedula_Empleado'] = $emp[0];
				$arrayResultados['Nombres'] = $emp[1];
				$arrayResultados['Apellidos'] = $emp[2];
				$arrayResultados['Direccion'] = $emp[3];
				$arrayResultados['fnacimiento'] = substr($emp[4], 0,10);
				$arrayResultados['Codigo'] = $emp[5];	
				$arrayResultados['costos'] = $emp[19];
				$arrayResultados['cargo'] = $emp[7];
				$arrayResultados['salario'] = $emp[8];
				$arrayResultados['fingreso'] = substr($emp[9],0,10);				
				$arrayResultados['tel1'] = $emp[10];
				$arrayResultados['tel2'] = $emp[11];
				$arrayResultados['vinculacion'] = $emp[12];
				$arrayResultados['sig'] = $emp[13];
				$arrayResultados['firma'] = $emp[14];
				$arrayResultados['ciudadreside'] = $emp[15];
				$arrayResultados['lugarn'] = $emp[16];
				$arrayResultados['email'] = $emp[17];	
				$arrayResultados['nit_sede'] = $emp[20];
				
			}	
			echo json_encode($arrayResultados);	
			
		}
		
		function LlenarDetalleEmpleado(){
			$emp_id=$_POST['emp_id'];
			$ObjEmpleados= new EmpleadosModel();
			$Emplesalario="select * from detalle_empleados_salarios where CedulaEmpleado='$emp_id' ";						
			$llenarsalario=$ObjEmpleados->Consultar($Emplesalario);
			
			$Empleretiro="select * from detalle_empleados_ingresos_retiros where CedulaEmpleado='$emp_id' ";					
			$llenarretiro=$ObjEmpleados->Consultar($Empleretiro);
			
			include_once('../../views/Empleados/GuiVerDetalleEmpleado.html.php');
		}
		
		function LlenarPantalla(){
			$emp_id=$_POST['emp_id'];
			$ObjEmpleados= new EmpleadosModel();
			$sqlpantalla="select * from pantallas_empleados";
			$pantallas=$ObjEmpleados->Consultar($sqlpantalla);
			
			$sqlpEmp="select * from detalle_pantallas_empleados where Cedula_Empleado='$emp_id'";
			$pantallaE=$ObjEmpleados->Consultar($sqlpEmp);
			
			include_once('../../views/Empleados/GuiVerDetallePantallas.html.php');
		}
		
		function getEliminarEmple(){
			
			extract($_GET);	
			
			$eliminarCli="delete from empleados where Cedula_Empleado='$cedula'";
			$Objcliente= new EmpleadosModel();	
		
			$eliminar=$Objcliente->Anular($eliminarCli);
			
			echo"<script type='text/javascript'>
						alert('El se elimino con Exito')
						window.location.href='".getUrl('Empleados','Empleados','crearEmpleado')."'
					</script>";	
		}
		
		function ModalRetiroEmpleado(){
			include_once('../../views/Empleados/GuiModalRetiroEmpleado.html.php');
		}
		
		function insertarRetiro(){
			$usuarioCrea=$_SESSION['usua_id'];
			extract($_POST);
			$regRetiroEmp="insert into detalle_empleados_ingresos_retiros (CedulaEmpleado,
						Fecha,Tipo,UsuarioCrea,Observaciones) values
						('$cedula_retiro','$fnovedad','$tipo','$usuarioCrea','$obser')";
			$ObjEmpleados= new EmpleadosModel();	
			$Emp=$ObjEmpleados->Insertar($regRetiroEmp);
			
			echo"<script type='text/javascript'>
					alert('El se Registro con Exito')
					window.location.href='".getUrl('Empleados','Empleados','crearEmpleado')."'
				</script>";	
		}
        
        function nuevoSalarioEmpleado(){
			include_once('../../views/Empleados/GuiModalAumentoSalario.html.php');
		}
		
		function insertarSalario(){
			extract($_POST);
			$regRetiroEmp="insert into detalle_empleados_salarios (CedulaEmpleado,
						FechaCambio,ValorSalario,UsuarioCrea,Observaciones) values
						('$cedula_salario','$fmodifica','$valor','$usuarioCrea','$obser')";
			$ObjEmpleados= new EmpleadosModel();	
			$Emp=$ObjEmpleados->Insertar($regRetiroEmp);
			
			echo"<script type='text/javascript'>
					alert('El se Registro con Exito')
					window.location.href='".getUrl('Empleados','Empleados','crearEmpleado')."'
				</script>";	
		}
		
		function historialCargos(){
			include_once('../../views/Empleados/GuiModalHistorialCargos.html.php');
		}
		
		function listarHistoriaCargos(){
			extract($_GET);			
			
			$listarcargos="select";
			$ObjEmpleados= new EmpleadosModel();			
			$liscargo=$ObjEmpleados->Consultar($listarcargos);			
			
			include_once('../../views/Empleados/listarInfoEmpleado.php');
		}

	}
?>