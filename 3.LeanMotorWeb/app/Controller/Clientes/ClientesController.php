<?php

	include_once('../../app/Model/Clientes/ClientesModel.php');

	class ClientesController{
		
		function crearCliente(){

			$Objcliente= new ClientesModel();
			
			$sqlpais="SELECT * FROM paises ORDER BY nombre";
			$paises=$Objcliente->consultar($sqlpais);

			$sqlciudad="SELECT Codigo_Ciudad, Nombre FROM ciudades ORDER BY Nombre";
			$ciudades=$Objcliente->Consultar($sqlciudad);

			$sqldepto="SELECT Codigo_Pais, Codigo_Departamento, Nombre FROM departamentos ORDER BY Nombre";
			$deptos=$Objcliente->consultar($sqldepto);
			
			$sqlzona="SELECT Codigo_Zona, NombreZona FROM zonas ORDER BY NombreZona";
			$zonas=$Objcliente->consultar($sqlzona);
			
			$sqlF_pago="SELECT * FROM forma_pago ORDER BY Descripcion";
			$forma_pago=$Objcliente->consultar($sqlF_pago);
			
			$sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes=$Objcliente->consultar($sqlsede);
			
			include_once('../../views/Clientes/GuiClientes.html.php');
		}

		function ListarDepto(){
			$pais=$_POST['pais'];
			$Objcliente= new ClientesModel();
			$sqldepto="select Codigo_Departamento, Nombre from departamentos where Codigo_Pais='$pais' order by Nombre ";
			$deptos=$Objcliente->Consultar($sqldepto);
			
			include_once('../../views/Clientes/GuiVerDepto.html.php');
		}
		
		function ListarCiudad(){
			$depto=$_POST['depto'];
			$Objcliente= new ClientesModel();
			$sqlciudad="select Codigo_Ciudad, Nombre from ciudades where Codigo_Departamento='$depto' order by Nombre";
			$ciudades=$Objcliente->Consultar($sqlciudad);
			
			include_once('../../views/Clientes/GuiVerCiudad.html.php');
		}

		function validarNit(){
			$nit_cliente=$_POST["nit_cliente"];
			$respuesta=array();
			$Objcliente= new ClientesModel();
			$sql="SELECT * FROM clientes WHERE nit_Cliente='$nit_cliente'";
			$validarNit=$Objcliente->Consultar($sql);
			
			if (count($validarNit) != 0) {
				$respuesta=true;
			}else{
				$respuesta=false;
			}
			echo json_encode($respuesta);
		}

		function postCrearCliente(){
			extract($_POST);
			$fechaCrea=date('y-m-d');
			
			$Insertcli="INSERT INTO clientes (Nit_Cliente, Direccion, Email, Zona, Estado, Codigo_Ciudad,
							Fecha_creado, Observaciones, Contacto_Empresa, Forma_Pago, Razon_Social, Dias_Plazo,
							Cedula_Empleado, Telefono1, Telefono2, Nit_Empresa) 
						VALUES ('$nit', '$direccion', '$email', '$zona', 'A', '$ciudad', '$fechaCrea', ' ', 
						'$contac', $formaPago, '$razon_social', '$plazo', '$empleado', '$tel1', '$tel2', '$nit_sede')";				
			$Objcliente= new ClientesModel();
			$clien=$Objcliente->insertar($Insertcli);
			
			echo messageSweetAlert("El registro se ha realizado con éxito", "", "success", "", "si", "automatica", getUrl('Clientes', 'Clientes', 'crearCliente'), 2500);
		}

		function getVerCliente(){
			$nit_cliente=$_GET["nit_cliente"];
			$sede=$_GET["nit_sede"];

			$Objcliente= new ClientesModel();

			$sql="SELECT clientes.Cedula_Empleado, ciudades.Nombre AS Ciudad, clientes.Dias_Plazo, clientes.Direccion, clientes.Email, 
			clientes.Fax, forma_pago.Codigo_Forma_Pago, clientes.Nit_Cliente, clientes.Pagina_Web, clientes.Forma_Pago, clientes.Codigo_Ciudad, 
			clientes.Razon_Social, clientes.Telefono1, clientes.Telefono2, clientes.Zona, paises.Codigo_Pais, departamentos.Codigo_Departamento, 
			clientes.Contacto_Empresa, clientes.Nit_Empresa, departamentos.Nombre, clientes.Estado 
			FROM clientes, ciudades, forma_pago, paises, departamentos
			WHERE clientes.Forma_Pago=forma_pago.Codigo_Forma_Pago AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad 
			AND ciudades.Codigo_Departamento=departamentos.Codigo_Departamento AND 
			departamentos.Codigo_Pais=paises.Codigo_Pais AND clientes.Nit_Cliente = '$nit_cliente' ";
			$clientes=$Objcliente->Consultar($sql);

			$sqlpais="SELECT * FROM paises ORDER BY nombre";
			$paises=$Objcliente->consultar($sqlpais);

			$sqlciudad="SELECT Codigo_Ciudad, Nombre FROM ciudades ORDER BY Nombre";
			$ciudades=$Objcliente->Consultar($sqlciudad);

			$sqldepto="SELECT Codigo_Pais, Codigo_Departamento, Nombre FROM departamentos ORDER BY Nombre";
			$deptos=$Objcliente->consultar($sqldepto);
			
			$sqlzona="SELECT Codigo_Zona, NombreZona FROM zonas ORDER BY NombreZona";
			$zonas=$Objcliente->consultar($sqlzona);
			
			$sqlF_pago="SELECT * FROM forma_pago ORDER BY Descripcion";
			$forma_pago=$Objcliente->consultar($sqlF_pago);
			
			$sqlempleado="SELECT Cedula_Empleado, CONCAT(Nombres,' ',Apellidos) AS nombre_completo FROM empleados WHERE Nit_Empresa = '$sede' AND Cargo='14' AND Estado = 'A' ORDER BY nombre_completo";
			$empleados=$Objcliente->consultar($sqlempleado);

			$sqlempleadoCliente="SELECT * FROM empleados WHERE Cedula_Empleado = '".$clientes[0]["Cedula_Empleado"]."' AND Estado = 'A' ";
			$empleadoCliente=$Objcliente->Consultar($sqlempleadoCliente);

			$sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
			$sedes=$Objcliente->Consultar($sqlsede);

			include_once('../../views/Clientes/GuiVerClientes.html.php');
		}

		function getEditarCliente(){
			$nit_cliente=$_GET["nit_cliente"];
			$sede=$_GET["nit_sede"];

			$Objcliente= new ClientesModel();

			$sql="SELECT clientes.Cedula_Empleado, ciudades.Nombre AS Ciudad, clientes.Dias_Plazo, clientes.Direccion, clientes.Email, 
			clientes.Fax, forma_pago.Codigo_Forma_Pago, clientes.Nit_Cliente, clientes.Pagina_Web, clientes.Forma_Pago, clientes.Codigo_Ciudad, 
			clientes.Razon_Social, clientes.Telefono1, clientes.Telefono2, clientes.Zona, paises.Codigo_Pais, departamentos.Codigo_Departamento, 
			clientes.Contacto_Empresa, clientes.Nit_Empresa, departamentos.Nombre, clientes.Estado 
			FROM clientes, ciudades, forma_pago, paises, departamentos
			WHERE clientes.Forma_Pago=forma_pago.Codigo_Forma_Pago AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad 
			AND ciudades.Codigo_Departamento=departamentos.Codigo_Departamento AND 
			departamentos.Codigo_Pais=paises.Codigo_Pais AND clientes.Nit_Cliente = '$nit_cliente' ";
			$clientes=$Objcliente->Consultar($sql);

			$sqlpais="SELECT * FROM paises ORDER BY nombre";
			$paises=$Objcliente->consultar($sqlpais);

			$sqlciudad="SELECT Codigo_Ciudad, Nombre FROM ciudades ORDER BY Nombre";
			$ciudades=$Objcliente->Consultar($sqlciudad);

			$sqldepto="SELECT Codigo_Pais, Codigo_Departamento, Nombre FROM departamentos ORDER BY Nombre";
			$deptos=$Objcliente->consultar($sqldepto);
			
			$sqlzona="SELECT Codigo_Zona, NombreZona FROM zonas ORDER BY NombreZona";
			$zonas=$Objcliente->consultar($sqlzona);
			
			$sqlF_pago="SELECT * FROM forma_pago ORDER BY Descripcion";
			$forma_pago=$Objcliente->consultar($sqlF_pago);
			
			$sqlempleado="SELECT Cedula_Empleado, CONCAT(Nombres,' ',Apellidos) AS nombre_completo FROM empleados WHERE Nit_Empresa = '$sede' AND Cargo='14' AND Estado = 'A' ORDER BY nombre_completo";
			$empleados=$Objcliente->consultar($sqlempleado);

			$sqlempleadoCliente="SELECT * FROM empleados WHERE Cedula_Empleado = '".$clientes[0]["Cedula_Empleado"]."' AND Estado = 'A' ";
			$empleadoCliente=$Objcliente->Consultar($sqlempleadoCliente);

			$sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
			$sedes=$Objcliente->Consultar($sqlsede);

			include_once('../../views/Clientes/GuiEditarClientes.html.php');
		}

		function postEditarCliente(){
			extract($_POST);

			$Objcliente= new ClientesModel();

			$Actualizarcli="UPDATE clientes SET Nit_Cliente='$nit', Direccion='$direccion', Email='$email', 
			Zona='$zona', Codigo_Ciudad='$ciudad', Contacto_Empresa='$contac', Forma_Pago='$formaPago',
			Razon_Social='$razon_social', Dias_Plazo='$plazo', Cedula_Empleado='$empleado', Telefono1='$tel1', Telefono2='$tel2' 
			WHERE Nit_Cliente='$nit_cliente' ";
			$actuCliente=$Objcliente->insertar($Actualizarcli);

			echo messageSweetAlert("El registro se ha actualizado con éxito", "", "success", "", "si", "automatica", getUrl('Clientes', 'Clientes', 'getEditarCliente', array("nit_sede" => $nit_sede, "nit_cliente" => $nit)), 2500);
		}
		
		function modalBuscarCliente (){
			include_once('../../views/Clientes/GuiModalBuscarCliente.html.php');
		}
		
		function ListarClientes(){
			extract($_POST);
			
			$Objcliente= new ClientesModel();			
			
			$condicion="";

			if($Nit_cliente<>""){
				$condicion.=" AND Nit_Cliente LIKE '$Nit_cliente%' ";             
			}			
			if($Razon_social<>""){
				$condicion.=" AND Razon_Social LIKE '$Razon_social%' ";
			}
			if($Ciudad<>""){
				$condicion.=" AND Nombre LIKE '$Ciudad%' ";
			}
			if ($Estado<>"" && $Estado == "T") {
				$Estado = null;
			}
			
			$sqlbusCli="SELECT clientes.Nit_Cliente, clientes.Nit_Empresa, clientes.Razon_Social, ciudades.Nombre AS Ciudad, clientes.Direccion, clientes.Telefono1, clientes.Estado 
			FROM clientes, ciudades 
			WHERE clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad AND clientes.Estado LIKE '%$Estado%' $condicion ORDER BY Fecha_Creado DESC";
			$listarCli=$Objcliente->Consultar($sqlbusCli);
			
			$datos = array();

			if ($listarCli != null) {
				foreach ($listarCli as $listarClientes) {
					array_push($datos,
						array(
							"botonVerEditar" 		   		 => '<button class="href">'.$listarClientes["Nit_Cliente"].'</button>',
							"nit_cliente" 		   		 => $listarClientes["Nit_Cliente"],
							"nit_sede" 		   		 => $listarClientes["Nit_Empresa"],
							"razon_social"   			 	   => $listarClientes["Razon_Social"],
							"ciudad"     		       => $listarClientes["Ciudad"],
							"direccion"           => $listarClientes["Direccion"],
							"telefono"           => $listarClientes["Telefono1"],
							"estado"   			       => $listarClientes["Estado"]
						));
					}
			}
			
            $tabla = array("data" => $datos);
            
			echo json_encode($tabla);
		}
		
		function getEliminarCli(){
			
			extract($_GET);	
			
			$eliminarCli="delete from clientes where Nit_Cliente='$nit'";
			$Objcliente= new ClientesModel();			
			$eliminar=$Objcliente->eliminar($eliminarCli);
			
			echo"<script type='text/javascript'>
						alert('El se elimino con Exito')
						window.location.href='".getUrl('Clientes','Clientes','crearCliente')."'
					</script>";	
		}
		function borrar(){

			extract($_POST);
			unset($nit);
			unset($direccion);
			unset($email);
			unset($web);
			unset($zona);
			unset($ciudad);
			unset($contac);
			unset($formaPago);
			unset($razon_social);
			unset($plazo);
			unset($empleado);
			unset($fax);
			unset($tel1);
			unset($tel2);

			redirect(getUrl('Clientes','Clientes','crearCliente'));
			
		}
/***************************************PLANTA***************************************************/
		function ListarPlanta(){
			extract($_POST);
			$Objcliente= new ClientesModel();
			
			$listarPlanta="SELECT plantas.Nombre, plantas.Direccion, plantas.Cedula_Empleado, plantas.Nit_Cliente, plantas.Codigo_Planta, plantas.nit_empresa, 
			COUNT(contactos.Codigo_Contacto) AS cantContactos FROM plantas LEFT JOIN contactos ON plantas.Codigo_Planta = contactos.Codigo_Planta 
			WHERE plantas.Nit_Cliente='$nit_cliente' GROUP BY plantas.Codigo_Planta";
			$listarP=$Objcliente->Consultar($listarPlanta);

			$datos = array();

			if ($listarP != null) {
				foreach ($listarP as $listarPlantas) {
					
					$cantVende="SELECT COUNT(plantas.Cedula_Empleado) AS cantVendedores FROM plantas WHERE plantas.Codigo_Planta='".$listarPlantas["Codigo_Planta"]."'
					AND plantas.Nit_Cliente='$nit_cliente'";
					$cantVendedor=$Objcliente->Consultar($cantVende);

					foreach ($cantVendedor as $cantVendedores) {
						if ($tipo_vista == "ver") {
							$array = array(
								"codigo_planta" => $listarPlantas["Codigo_Planta"],
								"nombre" 		   => $listarPlantas["Nombre"],
								"direccion"   	   => $listarPlantas["Direccion"],
								"ver"     		  	   => '<button type="button" class="btn btn-primary fa fa-eye btnModalEditarPlanta" data-toggle="modal" data-target="#modalVerPlanta"></button>',
								"contactos"        => '<button class="btn btn-success fa fa-user" type-of-view="ver" id="btnListarContactos" data-url="'.getUrl("Clientes", "Clientes", "ListarContacto", false, "ajax").'"> (' . $listarPlantas["cantContactos"] . ')</button>',
								"vendedores"     => '<button class="btn btn-success fa fa-user" type-of-view="ver" id="btnListarVendedores" data-url="'.getUrl("Clientes", "Clientes", "ListarVendedor", false, "ajax").'"> (' . $cantVendedores["cantVendedores"] . ')</button>'
							);
						}else if($tipo_vista == "editar"){
							$array = array(
								"codigo_planta" => $listarPlantas["Codigo_Planta"],
								"nombre" 		   => $listarPlantas["Nombre"],
								"direccion"   	   => $listarPlantas["Direccion"],
								"editar"     		  => '<button type="button" class="btn btn-primary fa fa-edit btnModalEditarPlanta" data-toggle="modal" data-target="#modalEditarPlanta"></button>',
								"eliminar"          => '<button type="button" class="btn btn-danger fa fa-trash-alt btnEliminarPlanta" data-url="'.getUrl("Clientes", "Clientes", "postEliminarPlanta", false, "ajax").'"></button>',
								"contactos"        => '<button class="btn btn-success fa fa-user" type-of-view="editar" id="btnListarContactos" data-url="'.getUrl("Clientes", "Clientes", "ListarContacto", false, "ajax").'"> (' . $listarPlantas["cantContactos"] . ')</button>',
								"vendedores"     => '<button class="btn btn-success fa fa-user" type-of-view="editar" id="btnListarVendedores" data-url="'.getUrl("Clientes", "Clientes", "ListarVendedor", false, "ajax").'"> (' . $cantVendedores["cantVendedores"] . ')</button>'
							);
						}
					}
					array_push($datos, $array);
				}
			}
			
            $tabla = array("data" => $datos);
            
			echo json_encode($tabla);
		}

		function postCrearPlanta(){
			extract($_POST);
			$respuesta = array();
			$Objcliente = new ClientesModel();
		
			$InsertPlan="INSERT INTO plantas (Nombre, Direccion, Cedula_Empleado, Nit_Cliente, Codigo_Planta, nit_empresa)
			VALUES ('$nom_planta', '$dir_planta', '$empleado', '$nit_cliente', NULL, '$nit_sede')";	
			$Objcliente->Insertar($InsertPlan);

			if (mysqli_affected_rows($Objcliente->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

		function postEditarPlanta(){
			extract($_POST);
			$respuesta = array();
			$Objcliente = new ClientesModel();

			$ActualizarPlan="UPDATE plantas SET Nombre='$nom_planta', Direccion='$dir_planta' WHERE Codigo_Planta='$codigo_planta'";				
			$Objcliente->Actualizar($ActualizarPlan);

			if (mysqli_affected_rows($Objcliente->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

		function postEliminarPlanta(){
			extract($_POST);
			$respuesta = array();
			$Objcliente = new ClientesModel();

			$eliminarPla="DELETE FROM plantas WHERE Codigo_Planta='$codigo_planta' ";
			$Objcliente->Anular($eliminarPla);
			
			if (mysqli_affected_rows($Objcliente->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
			
		}
		/********************CONTACTO************************/
		function ListarContacto(){
			extract($_POST);
			$Objcliente = new ClientesModel();

			$listaConta="SELECT Nombre_Contacto, Telefono1, Codigo_Contacto, 
			Codigo_Planta, Email FROM contactos WHERE Codigo_Planta='$codigo_planta' ";
			$listarConta=$Objcliente->Consultar($listaConta);

			$datos = array();

			if ($listarConta != null) {
				foreach ($listarConta as $listarContactos) {
					if ($tipo_vista == "ver") {
						$array = array(
							"codigo_planta" 	  => $listarContactos["Codigo_Planta"],
							"codigo_contacto" 	=> $listarContactos["Codigo_Contacto"],
							"nombre" 		   		 => $listarContactos["Nombre_Contacto"],
							"telefono"   			  => $listarContactos["Telefono1"],
							"email"   			 	   => $listarContactos["Email"],
							"ver"     		             => '<button type="button" class="btn btn-primary fa fa-eye btnModalEditarContacto" data-toggle="modal" data-target="#modalVerContacto"></button>'
						);
					}else if ($tipo_vista == "editar"){
						$array = array(
							"codigo_planta" 	=> $listarContactos["Codigo_Planta"],
							"codigo_contacto" 	=> $listarContactos["Codigo_Contacto"],
							"nombre" 		   		 => $listarContactos["Nombre_Contacto"],
							"telefono"   			  => $listarContactos["Telefono1"],
							"email"   			 	   => $listarContactos["Email"],
							"editar"     		        => '<button type="button" class="btn btn-primary fa fa-edit btnModalEditarContacto" data-toggle="modal" data-target="#modalEditarContacto"></button>',
							"eliminar"                => '<button type="button" class="btn btn-danger fa fa-trash-alt btnEliminarContacto" data-url="'.getUrl("Clientes", "Clientes", "postEliminarContacto", false, "ajax").'"></button>'
						);
					}
					array_push($datos, $array);
				}
			}
			
			$tabla = array("data" => $datos);
			
			echo json_encode($tabla);
		}

		function postCrearContacto(){
			extract($_POST);
			$respuesta = array();
			$Objcliente = new ClientesModel();
			
			$InsertContac="INSERT INTO contactos (Codigo_Contacto, Nombre_Contacto, Email, Codigo_Planta, Telefono1) 
			VALUES (NULL, '$nom_contacto', '$email_contacto', '$codigo_planta', '$tel_contacto')";
			$Objcliente->Insertar($InsertContac);

			if (mysqli_affected_rows($Objcliente->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

		function postEditarContacto(){
			extract($_POST);
			$respuesta = array();
			$Objcliente = new ClientesModel();
			
			$ActualizarCont="UPDATE contactos SET Nombre_Contacto='$nom_contacto', 
			Email='$email_contacto', Telefono1='$tel_contacto' WHERE Codigo_Contacto='$codigo_contacto' ";
			$Objcliente->Actualizar($ActualizarCont);

			if (mysqli_affected_rows($Objcliente->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

		function postEliminarContacto(){
			extract($_POST);
			$respuesta = array();
			$Objcliente = new ClientesModel();
			
			$eliminarCont="DELETE FROM contactos WHERE Codigo_Contacto='$codigo_contacto' ";
			$Objcliente->Anular($eliminarCont);

			if (mysqli_affected_rows($Objcliente->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

		/********************VENDEDOR************************/
		function ListarVendedor(){
			extract($_POST);
			$Objcliente = new ClientesModel();

			$listaVende="SELECT plantas.Codigo_Planta, CONCAT(empleados.Nombres,' ',empleados.Apellidos) AS Nombre_Vendedor, plantas.Cedula_Empleado AS Cedula_Vendedor 
			FROM plantas, empleados WHERE plantas.Codigo_Planta = '$codigo_planta' AND plantas.Cedula_Empleado=empleados.Cedula_Empleado 
			AND empleados.Cargo='14' AND empleados.Estado = 'A' GROUP BY Cedula_Vendedor";
			$listarVende=$Objcliente->Consultar($listaVende);

			$datos = array();

			if ($listarVende != null) {
				foreach ($listarVende as $listarVendedores) {
					if ($tipo_vista == "ver") {
						$array = array(
							"codigo_planta" 	  => $listarVendedores["Codigo_Planta"],
							"nombre" 		   		 => $listarVendedores["Nombre_Vendedor"],
							"cedula" 		   	 => $listarVendedores["Cedula_Vendedor"]
						);
					}else if ($tipo_vista == "editar"){
						$array = array(
							"codigo_planta" 	  => $listarVendedores["Codigo_Planta"],
							"nombre" 		   		 => $listarVendedores["Nombre_Vendedor"],
							"cedula" 		   	 => $listarVendedores["Cedula_Vendedor"]
						);
					}
					array_push($datos, $array);
				}
			}
			
			$tabla = array("data" => $datos);
			
			echo json_encode($tabla);
		}

		function cambiarVendedorPlanta(){
			extract($_POST);
			$respuesta = array();
			$Objcliente = new ClientesModel();

			$ActualizarVende="UPDATE plantas SET Cedula_Empleado='$vendedor' 
			WHERE Codigo_Planta='$codigo_planta' ";
			$Objcliente->Actualizar($ActualizarVende);

			if (mysqli_affected_rows($Objcliente->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

	}
?>