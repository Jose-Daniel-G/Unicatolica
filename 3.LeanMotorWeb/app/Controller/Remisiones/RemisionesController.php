<?php
	include_once("../../app/Model/Remisiones/RemisionesModel.php");
	
	class RemisionesController{

		public function crearRemision(){
			$objRemision = new RemisionesModel();

			$usua_perfil = $_SESSION['usua_perfil'];

			if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"])) {
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
				$empresas = $objRemision->Consultar($sqlempresa);

				$consIngreso = "SELECT ine.Numero_Ingreso FROM ingreso_equipos AS ine, equipos AS e
											WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["num_ingreso"]."' 
											AND e.Numero_Serie=ine.Numero_Serie 
											AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
				$Ingresos = $objRemision->Consultar($consIngreso);

				$sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Nit_Empresa = '".$_GET["nit_sede"]."' AND Estado = 'A' ORDER BY nombre_completo";
				$vendedor = $objRemision->Consultar($sqlven);

			}else{
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social ";
				$empresas = $objRemision->Consultar($sqlempresa);
			}

			$sqlTipos_Equipos = "SELECT Codigo_Grupo, Descripcion FROM grupos";
			$Tipos_Equipos = $objRemision->Consultar($sqlTipos_Equipos);

			$sqlClase_Equipos = "SELECT * FROM tipos_equipos WHERE Estado='A' ORDER BY Descripcion";
			$Clase_Equipos = $objRemision->Consultar($sqlClase_Equipos);

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes = $objRemision->Consultar($sqlsede);

			$sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
			$marcas = $objRemision->Consultar($sqlmarca);

			$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Empleado = $objRemision->Consultar($sqlEmpleado);

			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
			$servicios = $objRemision->Consultar($sqlserv);

			include_once("../../views/Remisiones/GuiRemision.html.php");
		}

		public function BuscarDetalleIngreso() {
			$nit_sede = $_POST["nit_sede"];
			$num_ingreso = $_POST["ingreso"];
	
			$objRemision = new RemisionesModel();
	
			if ($num_ingreso != "") {
				$sqldetalle = "SELECT encabezado_cotizacion_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, detalle_cotizacion_venta.Cantidad,detalle_cotizacion_venta.Valor_Unitario,
									detalle_cotizacion_venta.Porcentaje_Descuento, Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva
										FROM detalle_cotizacion_venta, productos_servicios, encabezado_cotizacion_venta
											WHERE encabezado_cotizacion_venta.Numero_Documento=detalle_cotizacion_venta.Numero_Documento
												AND encabezado_cotizacion_venta.Tipo_Documento=detalle_cotizacion_venta.Tipo_Documento
												AND encabezado_cotizacion_venta.NIT_Empresa=detalle_cotizacion_venta.NIT_Empresa
												AND detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
												AND encabezado_cotizacion_venta.Numero_Documento=
												(SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_cotizacion_venta 
												WHERE Numero_Ingreso = '$num_ingreso' AND Estado_Documento = 'A') 
												AND encabezado_cotizacion_venta.Tipo_Documento='CT' 
												AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' 
												AND encabezado_cotizacion_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
				$DetalleCT = $objRemision->Consultar($sqldetalle);

				if ($DetalleCT == null) {
					$sqldetalle = "SELECT encabezado_documento_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle, detalle_documento_venta.Cantidad,detalle_documento_venta.Valor_Unitario,
									detalle_documento_venta.Porcentaje_Descuento, Valor_Iva, detalle_documento_venta.Porcentaje_Iva
										FROM detalle_documento_venta, productos_servicios, encabezado_documento_venta
											WHERE encabezado_documento_venta.Numero_Documento=detalle_documento_venta.Numero_Documento
												AND encabezado_documento_venta.Tipo_Documento=detalle_documento_venta.Tipo_Documento
												AND encabezado_documento_venta.NIT_Empresa=detalle_documento_venta.NIT_Empresa
												AND detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
												AND encabezado_documento_venta.Numero_Documento=
												(SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_documento_venta 
												WHERE Numero_Ingreso = '$num_ingreso' AND Estado_Documento = 'A') 
												AND encabezado_documento_venta.Tipo_Documento='PL' 
												AND encabezado_documento_venta.NIT_Empresa='$nit_sede' 
												AND encabezado_documento_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
					$DetallePL = $objRemision->Consultar($sqldetalle);
					$Detalle=$DetallePL;
				}else{
					$Detalle=$DetalleCT;
				}
			} else {
				$Detalle = null;
			}
	
			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A'";
			$servicios = $objRemision->Consultar($sqlserv);
	
			include_once '../../views/Remisiones/GuiCargarDetalleRemision.html.php';
		}

		public function RegistrarRemision() {
			extract($_POST);
			$usu_id = $_SESSION['usua_id'];
			date_default_timezone_set('America/Bogota');
			$Fecha_Documento = date('Y-m-d');
			$Hora_Documento = "0000-00-00 " . date('h:i:s');
			$objRemision = new RemisionesModel();
	
			if (!empty($num_ingreso)) {
				$no_ingreso=$num_ingreso;
			}
			if (!empty($nit_emp)) {
				$nit_empresa=$nit_emp;
			}
	
			if (!empty($nit_empresa) && !empty($no_ingreso)) {
	
				if (empty($planta)) {
					$planta = "";
				}

				if ($Tipo_Remision == "RemisionDetalle") {
					$observaciones=$observacionDetalle;
				}else if($Tipo_Remision == "RemisionBasica"){
					$observaciones=$observacionBasica;
				}
	
				$sqlRM = "INSERT INTO encabezado_documento_venta
				(Numero_Documento, Tipo_Documento, Fecha_Documento, Hora_Documento, Cedula_Empleado, Estado_Documento, Nit_Cliente,
				Usuario_Crea, Numero_Ingreso, Equipo, Marca, Potencia, Rpm, Voltaje, Fs, Serie, Codigo_Planta, 
				Prioridad, TipoTrabajo, NIT_Empresa, Observaciones)
				VALUES
				(NULL, '$tipo_documento', '$Fecha_Documento', '$Hora_Documento', '$Empleado', 'A', '$nit_empresa',
				'$usu_id', '$no_ingreso', '$equipo', '$marca', '$potencia', '$rpm', '$voltaje', '$fases', '$serie', '$planta', 
				'$tiempoE', '$TipoTrabajo', '$nit_sede', '$observaciones')";
				$objRemision->Insertar($sqlRM);
	
				$sqlID = "SELECT @@identity AS id";
				$id=$objRemision->Consultar($sqlID);
				$numRM = trim($id[0][0]);

				if ($Tipo_Remision == "RemisionDetalle") {
					if (isset($producto)) {
						for ($i = 0; $i < count($producto); $i++) {
							$sqlServ = "INSERT INTO detalle_documento_venta
							(Numero_Registro, Numero_Documento, Numero_Ingreso, Tipo_Documento, Cantidad, Codigo_Producto, NIT_Empresa,
							Detalle, Item)
							VALUES
							(NULL, '$numRM', '$no_ingreso', '$tipo_documento', " . $cant[$i] . "," . $producto[$i] . ",  '$nit_sede',
							'$detalle[$i]', $item[$i])";
							$objRemision->Insertar($sqlServ);
						}
					}
				}
	
				echo json_encode(array("numRM" => $numRM));
			}else{
				echo messageSweetAlert("Falta el Nit del cliente y/o el Número de ingreso", "", "error", "", "si", "boton", getUrl('Remisiones', 'Remisiones', 'crearRemision'));
			}
		}

		public function getEditarRemision() {
			$Numero_Documento = $_GET['numero_doc'];
			$tipo_doc = $_GET['tipo_doc'];
			$nit_sede = $_GET['nit_sede'];
	
			$objRemision = new RemisionesModel();
			$sqlRM = "SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion,
				Telefono1, ciudades.Nombre AS Ciudad,encabezado_documento_venta.Dias_Plazo, Prioridad, TipoTrabajo, Garantia,
							encabezado_documento_venta.Observaciones, Estado_Documento, Tipo_Documento,
							encabezado_documento_venta.NIT_Empresa, sedes.nombre, Fecha_Documento, Fecha_Entrega,
								encabezado_documento_venta.Cedula_Empleado, Subtotal, Numero_Ingreso
									FROM
										encabezado_documento_venta, clientes,ciudades, sedes
										WHERE
											encabezado_documento_venta.Nit_Cliente=clientes.Nit_Cliente
											AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad
											AND Numero_Documento='$Numero_Documento'
											AND Tipo_Documento='$tipo_doc'
											AND encabezado_documento_venta.NIT_Empresa='$nit_sede'
											AND encabezado_documento_venta.NIT_Empresa=sedes.nit_empresa";
			$cabeceraRM = $objRemision->Consultar($sqlRM);
			
			if ($cabeceraRM[0]["Codigo_Planta"] != null) {
				$sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraRM[0]["Nit_Cliente"] . "'" . "";
				$plantas = $objRemision->Consultar($sqlplanta);
			} else {
				$plantas = null;
			}
	
			$sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie,
							No_Fases, Potencia, Frame, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio
								FROM ingreso_equipos as ing, equipos as equi, tipos_equipos tequi, grupos as gru,
								marcas, detalle_equipo as dequi
									WHERE ing.Numero_Serie=equi.Numero_Serie
										and equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
										and tequi.Codigo_Grupo=gru.Codigo_Grupo
										and equi.Codigo_Marca=marcas.Codigo_Marca
										and equi.Numero_Serie=dequi.Numero_Serie
										and ing.Numero_Ingreso=" . "'" . $cabeceraRM[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
			$ingresosRM = $objRemision->Consultar($sqlIngre);
	
			if ($ingresosRM[0]["Voltaje"] != "") {
				$Voltaje=$ingresosRM[0]["Voltaje"];
			}else if($ingresosRM[0]["V_Primario"] != ""){
				$Voltaje=$ingresosRM[0]["V_Primario"];
			}else if($ingresosRM[0]["Va"] != ""){
				$Voltaje=$ingresosRM[0]["Va"];
			}else if($ingresosRM[0]["Voltaje"] == "" && $ingresosRM[0]["V_Primario"] == "" && $ingresosRM[0]["Va"] == ""){
				$Voltaje=null;
			}
			if ($ingresosRM[0]["Revoluciones_Por_Minuto"] != "") {
				$Velocidad=$ingresosRM[0]["Revoluciones_Por_Minuto"];
			}else if($ingresosRM[0]["Velocidad_Parte"] != ""){
				$Velocidad=$ingresosRM[0]["Velocidad_Parte"];
			}else if($ingresosRM[0]["Revoluciones_Por_Minuto"] == "" && $ingresosRM[0]["Velocidad_Parte"] == ""){
				$Velocidad=null;
			}
			
			$sqlRMD = "SELECT Numero_Registro, Aprobado, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle,
				detalle_documento_venta.Cantidad, detalle_documento_venta.Valor_Unitario, detalle_documento_venta.Valor_Iva, 
				detalle_documento_venta.Porcentaje_Iva, detalle_documento_venta.Porcentaje_Descuento
					FROM
						detalle_documento_venta, productos_servicios WHERE detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
								AND  Numero_Documento='$Numero_Documento'
								AND Tipo_Documento='$tipo_doc'
								AND NIT_Empresa='$nit_sede'";
			$detalleRM = $objRemision->Consultar($sqlRMD);
	
			$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Empleado = $objRemision->Consultar($sqlEmpleado);
	
			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objRemision->Consultar($sqlempresa);
	
			$sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
			$sedes = $objRemision->Consultar($sqlsede);
	
			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
			$servicios = $objRemision->Consultar($sqlserv);
	
			$sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
			$tipos_servicios = $objRemision->Consultar($sqltipo_servicio);
	
			include_once '../../views/Remisiones/GuiEditarRemision.html.php';
		}

		public function getVerRemision() {
			$Numero_Documento = $_GET['numero_doc'];
			$tipo_doc = $_GET['tipo_doc'];
			$nit_sede = $_GET['nit_sede'];
	
			$objRemision = new RemisionesModel();
			$sqlRM = "SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion,
				Telefono1, ciudades.Nombre AS Ciudad,encabezado_documento_venta.Dias_Plazo, Prioridad, TipoTrabajo, Garantia,
							encabezado_documento_venta.Observaciones, Estado_Documento, Tipo_Documento,
							encabezado_documento_venta.NIT_Empresa, sedes.nombre, Fecha_Documento, Fecha_Entrega,
								encabezado_documento_venta.Cedula_Empleado, Subtotal, Numero_Ingreso
									FROM
										encabezado_documento_venta, clientes,ciudades, sedes
										WHERE
											encabezado_documento_venta.Nit_Cliente=clientes.Nit_Cliente
											AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad
											AND Numero_Documento='$Numero_Documento'
											AND Tipo_Documento='$tipo_doc'
											AND encabezado_documento_venta.NIT_Empresa='$nit_sede'
											AND encabezado_documento_venta.NIT_Empresa=sedes.nit_empresa";
			$cabeceraRM = $objRemision->Consultar($sqlRM);
			
			if ($cabeceraRM[0]["Codigo_Planta"] != null) {
				$sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraRM[0]["Nit_Cliente"] . "'" . "";
				$plantas = $objRemision->Consultar($sqlplanta);
			} else {
				$plantas = null;
			}
	
			$sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie,
							No_Fases, Potencia, Frame, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio
								FROM ingreso_equipos as ing, equipos as equi, tipos_equipos tequi, grupos as gru,
								marcas, detalle_equipo as dequi
									WHERE ing.Numero_Serie=equi.Numero_Serie
										and equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
										and tequi.Codigo_Grupo=gru.Codigo_Grupo
										and equi.Codigo_Marca=marcas.Codigo_Marca
										and equi.Numero_Serie=dequi.Numero_Serie
										and ing.Numero_Ingreso=" . "'" . $cabeceraRM[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
			$ingresosRM = $objRemision->Consultar($sqlIngre);
	
			if ($ingresosRM[0]["Voltaje"] != "") {
				$Voltaje=$ingresosRM[0]["Voltaje"];
			}else if($ingresosRM[0]["V_Primario"] != ""){
				$Voltaje=$ingresosRM[0]["V_Primario"];
			}else if($ingresosRM[0]["Va"] != ""){
				$Voltaje=$ingresosRM[0]["Va"];
			}else if($ingresosRM[0]["Voltaje"] == "" && $ingresosRM[0]["V_Primario"] == "" && $ingresosRM[0]["Va"] == ""){
				$Voltaje=null;
			}
			if ($ingresosRM[0]["Revoluciones_Por_Minuto"] != "") {
				$Velocidad=$ingresosRM[0]["Revoluciones_Por_Minuto"];
			}else if($ingresosRM[0]["Velocidad_Parte"] != ""){
				$Velocidad=$ingresosRM[0]["Velocidad_Parte"];
			}else if($ingresosRM[0]["Revoluciones_Por_Minuto"] == "" && $ingresosRM[0]["Velocidad_Parte"] == ""){
				$Velocidad=null;
			}
			
			$sqlRMD = "SELECT Numero_Registro, Aprobado, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle,
				detalle_documento_venta.Cantidad, detalle_documento_venta.Valor_Unitario, detalle_documento_venta.Valor_Iva, 
				detalle_documento_venta.Porcentaje_Iva, detalle_documento_venta.Porcentaje_Descuento
					FROM
						detalle_documento_venta, productos_servicios WHERE detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
								AND  Numero_Documento='$Numero_Documento'
								AND Tipo_Documento='$tipo_doc'
								AND NIT_Empresa='$nit_sede'";
			$detalleRM = $objRemision->Consultar($sqlRMD);
	
			$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Empleado = $objRemision->Consultar($sqlEmpleado);
	
			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objRemision->Consultar($sqlempresa);
	
			$sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
			$sedes = $objRemision->Consultar($sqlsede);
	
			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
			$servicios = $objRemision->Consultar($sqlserv);
	
			$sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
			$tipos_servicios = $objRemision->Consultar($sqltipo_servicio);
	
			include_once '../../views/Remisiones/GuiVerRemision.html.php';
		}

		public function EditarRemision() {
			extract($_POST);
			$usu_id = $_SESSION["usua_id"];
			date_default_timezone_set('America/Bogota');
			$Fecha_Documento = date('Y-m-d');
			$Hora_Documento = "0000-00-00 " . date('h:i:s');
			$objRemision = new RemisionesModel();
	
			if ($planta == null) {
				$planta = "";
			}
	
			$sqlARM = "UPDATE encabezado_documento_venta SET Usuario_Modifica='$usu_id', Fecha_Documento='$Fecha_Doc',
			 Fecha_Entrega='$Fecha_Entrega', Fecha_Modifica=NOW(), Cedula_Empleado='$Empleado', Estado_Documento='A', 
			 Nit_Cliente='$nit_empresa', Codigo_Planta='$planta', Numero_Ingreso='$no_ingreso', Prioridad='$tiempoE', 
			 TipoTrabajo='$TipoTrabajo', Observaciones='$Observaciones'
			WHERE Numero_Documento='$numRM' AND Tipo_Documento='$tipo_documento' AND NIT_Empresa='$nit_sede' ";
			$objRemision->Actualizar($sqlARM);
	
			if (isset($producto_Editar)) {
				for ($i = 0; $i < count($producto_Editar); $i++) {
					$sqlServ = "UPDATE detalle_documento_venta SET Tipo_Documento='$tipo_documento', Cantidad='$cant_Editar[$i]', Codigo_Producto='$producto_Editar[$i]', Detalle='$detalle_Editar[$i]', Item=$item_Editar[$i]
					WHERE Numero_Registro='$Numero_Registro_Editar[$i]' AND NIT_Empresa='$nit_sede' ";
					$objRemision->Actualizar($sqlServ);
				}
			}
			if (isset($producto)) {
				for ($i = 0; $i < count($producto); $i++) {
					$sqlServ = "INSERT INTO detalle_documento_venta
					(Numero_Registro, Numero_Documento, Numero_Ingreso, Tipo_Documento, Cantidad, Codigo_Producto, NIT_Empresa,
					Detalle, Item)
					VALUES
					(NULL, '$numRM', '$no_ingreso', '$tipo_documento', " . $cant[$i] . "," . $producto[$i] . ",  '$nit_sede',
					'$detalle[$i]', $item[$i])";
					$objRemision->Insertar($sqlServ);
				}
			}
		}

		public function ActualizarFechaRecibido() {
			$fechRecibido = $_POST["fechRecib"];
			$num_doc = $_POST["num_doc"];
			$tipo_doc = $_POST["tipo_doc"];
			$sede = $_POST["nit_sede"];
	
			$objRemision = new RemisionesModel();
			$sqlUpdate = "UPDATE encabezado_documento_venta SET Fecha_Entrega='$fechRecibido' WHERE Tipo_Documento='$tipo_doc' AND Numero_Documento='$num_doc' AND NIT_Empresa='$sede'";
			$objRemision->Actualizar($sqlUpdate);
		}

		public function VerDatosAdicionales(){
			$objRemision = new RemisionesModel();
			$numRM = $_POST["numRM"];

			$sqlDatos = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario, Fecha_Modifica, Usuario_Anula, Fecha_Anula, Razon_Anula, Usuario_Modifica
								FROM encabezado_documento_venta, usuarios
									WHERE encabezado_documento_venta.Usuario_Crea=usuarios.Cedula
										AND Numero_Documento='$numRM'";
			$datos = $objRemision->Consultar($sqlDatos);

			if ($datos != null) {
				if ($datos[0]["Usuario_Modifica"] != "") {
					$sqlModifica = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Modifica"] . "'";
					$modifica = $objRemision->Consultar($sqlModifica);
					$usuModifica = $modifica[0]["Nombre_Usuario"];
					$fechaModifica = $datos[0]["Fecha_Modifica"];
				} else {
					$usuModifica = "";
					$fechaModifica = "";
				}

				if ($datos[0]["Usuario_Anula"] != "") {
					$sqlElimina = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Anula"] . "'";
					$elimina = $objRemision->Consultar($sqlElimina);
					$usuElimina = $elimina[0]["Nombre_Usuario"];
					$fechaElimina = substr($datos[0]["Fecha_Anula"], 0, 10);

				} else {
					$usuElimina = "";
					$fechaElimina = "";
				}
				include_once '../../views/Remisiones/GuiVerDatosAdicionales.html.php';
			}
		}

		public function AnularRemision() {
			$numRM = $_POST['numRM'];
			$tipo_doc = $_POST['tipo_doc'];
			$Razon_Anula = $_POST['Razon_Anula'];
			$nit_sede = $_POST['nit_sede'];
			$Usuario_Anula = $_SESSION['usua_id']; //$_POST['usu_id'] Ojo
	
			date_default_timezone_set('America/Bogota');
			$fecha = date('Y-m-d');
			$objRemision = new RemisionesModel();
			echo $sqlRM = "UPDATE encabezado_documento_venta SET Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha',
			Razon_Anula='$Razon_Anula',  Estado_Documento='I' WHERE Numero_Documento='$numRM' AND Tipo_Documento='$tipo_doc' AND Nit_Empresa='$nit_sede'";
			$UpdateRM = $objRemision->Anular($sqlRM);
		}

	}
?>


