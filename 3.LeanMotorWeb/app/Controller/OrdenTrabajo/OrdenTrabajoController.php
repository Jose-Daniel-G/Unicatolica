<?php
	include_once("../../app/Model/OrdenTrabajo/OrdenTrabajoModel.php");
	
	class OrdenTrabajoController{
		
		public function crearOrdenTrabajo(){
			$objOrden = new OrdenTrabajoModel();

			$usua_perfil = $_SESSION["usua_perfil"];

			if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"])) {
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
				$empresas = $objOrden->Consultar($sqlempresa);

				$consIngreso = "SELECT ine.Numero_Ingreso FROM ingreso_equipos AS ine, equipos AS e
											WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["num_ingreso"]."' 
											AND e.Numero_Serie=ine.Numero_Serie 
											AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
				$Ingresos = $objOrden->Consultar($consIngreso);

				$sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa = '".$_GET["nit_sede"]."' AND Estado = 'A' ORDER BY nombre_completo";
				$vendedor = $objOrden->Consultar($sqlven);
			}else{
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social ";
				$empresas = $objOrden->Consultar($sqlempresa);
			}

			$sqlTipos_Equipos = "SELECT Codigo_Grupo, Descripcion FROM grupos";
			$Tipos_Equipos = $objOrden->Consultar($sqlTipos_Equipos);

			$sqlClase_Equipos = "SELECT * FROM tipos_equipos WHERE Estado='A' ORDER BY Descripcion";
			$Clase_Equipos = $objOrden->Consultar($sqlClase_Equipos);

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes = $objOrden->Consultar($sqlsede);

			$sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
			$marcas = $objOrden->Consultar($sqlmarca);

			$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Empleado = $objOrden->Consultar($sqlEmpleado);

			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
			$servicios = $objOrden->Consultar($sqlserv);

			include_once("../../views/OrdenTrabajo/GuiOrdenTrabajo.html.php");
		}

		public function BuscarDetalleIngreso() {
			$nit_sede = $_POST["nit_sede"];
			$num_ingreso = $_POST["ingreso"];
	
			$objOrden = new OrdenTrabajoModel();
	
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
				$DetalleCT = $objOrden->Consultar($sqldetalle);

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
					$DetallePL = $objOrden->Consultar($sqldetalle);
					$Detalle=$DetallePL;
				}else{
					$Detalle=$DetalleCT;
				}
			} else {
				$Detalle = null;
			}
	
			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A'";
			$servicios = $objOrden->Consultar($sqlserv);
	
			include_once '../../views/OrdenTrabajo/GuiCargarDetalleOrdenTrabajo.html.php';
		}

		public function RegistrarOrdenTrabajo(){
			extract($_POST);
			$usu_id = $_SESSION['usua_id'];
			date_default_timezone_set('America/Bogota');
			$Fecha_Creada = date('Y-m-d');
			$Hora_Creada = "0000-00-00 " . date('h:i:s');
			$objOrden = new OrdenTrabajoModel();

			if(!isset($Garantia)){$Garantia="N";}else{$Garantia="S";}

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

				if (!empty($Orden_Maestra)) {
					$Tipo_Orden="R";
				}else{
					$Orden_Maestra=NULL;
					$Tipo_Orden="P";
				}
	
				$sqlOrden = "INSERT INTO orden_trabajo
				(Numero_Ingreso, Numero_Orden, Creada_Por, Estado, Fecha_Creada, Hora_Creada, Armado_Por, Usuario_Crea, Tipo_Orden, 
				Orden_Maestra, Garantia, Nit_Empresa)
				VALUES
				('$no_ingreso', NULL, '$Creada_Por', 'A', '$Fecha_Creada', '$Hora_Creada', '$Armado_Por', '$usu_id', '$Tipo_Orden',
				'$Orden_Maestra', '$Garantia', '$nit_sede')";
				$objOrden->Insertar($sqlOrden);
				$plano = $sqlOrden . ";";
	
				$sqlID = "SELECT @@identity AS id";
				$id=$objOrden->Consultar($sqlID);
				$numOrden = trim($id[0][0]);
	
				if (isset($producto)) {
					for ($i = 0; $i < count($producto); $i++) {
						$sqlActividades="SELECT Codigo, Unidad_Negocio
						FROM productos_servicios WHERE Codigo = " . $producto[$i] . " ";
						$actividades=$objOrden->Consultar($sqlActividades);

						$sqlServ = "INSERT INTO detalle_orden_trabajo
						(Numero_Registro, Numero_Orden, Tipo_Actividad, Cantidad, Item, Codigo_Actividad, Detalle_Actividad, unidad_negocio, Nit_Empresa)
						VALUES
						(NULL, '$numOrden', 'C', " . $cant[$i] . ", $item[$i], " . $producto[$i] . ", '$detalle[$i]', '".$actividades[0]["Unidad_Negocio"]."', '$nit_sede')";
						$objOrden->Insertar($sqlServ);
					}
				}
	
				echo json_encode(array("numOrden" => $numOrden));
			}else{
				echo messageSweetAlert("Falta el Nit del cliente y/o el Número de ingreso", "", "error", "", "si", "boton", getUrl('Remisiones', 'Remisiones', 'crearRemision'));
			}
		}

		public function getVerOrdenTrabajo(){
			$objOrden = new OrdenTrabajoModel();

			$numero_orden = $_GET["numero_doc"];
			$nit_sede = $_GET["nit_sede"];

			$sqlOrden="SELECT ot.Numero_Ingreso, ot.Numero_Orden, ot.Creada_Por, ot.Estado, 
			DATE_FORMAT(ot.Fecha_Creada, '%Y-%m-%d') AS Fecha_Creada, 
			DATE_FORMAT(ot.Fecha_Creada, '%m') AS Mes, 
			DATE_FORMAT(ot.Fecha_Creada, '%d') AS Dia, 
			DATE_FORMAT(ot.Fecha_Creada, '%Y') AS Año, 
			ot.Armado_Por, ot.Tipo_Orden, ot.Orden_Maestra, ot.Garantia, ot.Nit_Empresa FROM orden_trabajo AS ot 
			WHERE Numero_Orden='$numero_orden' AND Nit_Empresa='$nit_sede'";
			$Orden=$objOrden->Consultar($sqlOrden);

			$sqlDetalleOrden="SELECT * FROM detalle_orden_trabajo WHERE Numero_Orden='$numero_orden' AND Nit_Empresa='$nit_sede'";
			$DetalleOrden=$objOrden->Consultar($sqlDetalleOrden);

			if ($Orden[0]["Numero_Ingreso"] != "") {
				$sqldetalle = "SELECT encabezado_cotizacion_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, detalle_cotizacion_venta.Cantidad,detalle_cotizacion_venta.Valor_Unitario,
									detalle_cotizacion_venta.Porcentaje_Descuento, Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva, Prioridad
										FROM detalle_cotizacion_venta, productos_servicios, encabezado_cotizacion_venta
											WHERE encabezado_cotizacion_venta.Numero_Documento=detalle_cotizacion_venta.Numero_Documento
												AND encabezado_cotizacion_venta.Tipo_Documento=detalle_cotizacion_venta.Tipo_Documento
												AND encabezado_cotizacion_venta.NIT_Empresa=detalle_cotizacion_venta.NIT_Empresa
												AND detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
												AND encabezado_cotizacion_venta.Numero_Documento=
												(SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_cotizacion_venta 
												WHERE Numero_Ingreso = " . "'" . $Orden[0]["Numero_Ingreso"] . "'" . " AND Estado_Documento = 'A') 
												AND encabezado_cotizacion_venta.Tipo_Documento='CT' 
												AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' 
												AND encabezado_cotizacion_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
				$DetalleCT = $objOrden->Consultar($sqldetalle);

				if ($DetalleCT == null) {
					$sqldetalle = "SELECT encabezado_documento_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle, detalle_documento_venta.Cantidad,detalle_documento_venta.Valor_Unitario,
									detalle_documento_venta.Porcentaje_Descuento, Valor_Iva, detalle_documento_venta.Porcentaje_Iva, Prioridad
										FROM detalle_documento_venta, productos_servicios, encabezado_documento_venta
											WHERE encabezado_documento_venta.Numero_Documento=detalle_documento_venta.Numero_Documento
												AND encabezado_documento_venta.Tipo_Documento=detalle_documento_venta.Tipo_Documento
												AND encabezado_documento_venta.NIT_Empresa=detalle_documento_venta.NIT_Empresa
												AND detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
												AND encabezado_documento_venta.Numero_Documento=
												(SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_documento_venta 
												WHERE Numero_Ingreso = " . "'" . $Orden[0]["Numero_Ingreso"] . "'" . " AND Estado_Documento = 'A') 
												AND encabezado_documento_venta.Tipo_Documento='PL' 
												AND encabezado_documento_venta.NIT_Empresa='$nit_sede' 
												AND encabezado_documento_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
					$DetallePL = $objOrden->Consultar($sqldetalle);
					$Detalle=$DetallePL;
				}else{
					$Detalle=$DetalleCT;
				}
			} else {
				$Detalle = null;
			}

			$sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, equi.Nit_Cliente, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, 
						marcas.Descripcion AS Marca, ing.Numero_Serie, equi.Codigo_Planta, No_Fases, Frame, Potencia, Revoluciones_Por_Minuto, 
							Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio, Requisitos_Cliente
							FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru,
							marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $Orden[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
			$ingresoOrden = $objOrden->Consultar($sqlIngre);
			
			if ($ingresoOrden[0]["Codigo_Planta"] != null) {
				$sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente='".$ingresoOrden[0]["Nit_Cliente"]."' ";
				$plantas = $objOrden->Consultar($sqlplanta);
			} else {
				$plantas = null;
			}

			if ($ingresoOrden[0]["Voltaje"] != "") {
				$Voltaje=$ingresoOrden[0]["Voltaje"];
			}else if($ingresoOrden[0]["V_Primario"] != ""){
				$Voltaje=$ingresoOrden[0]["V_Primario"];
			}else if($ingresoOrden[0]["Va"] != ""){
				$Voltaje=$ingresoOrden[0]["Va"];
			}else if($ingresoOrden[0]["Voltaje"] == "" && $ingresoOrden[0]["V_Primario"] == "" && $ingresoOrden[0]["Va"] == ""){
				$Voltaje=null;
			}
			if ($ingresoOrden[0]["Revoluciones_Por_Minuto"] != "") {
				$Velocidad=$ingresoOrden[0]["Revoluciones_Por_Minuto"];
			}else if($ingresoOrden[0]["Velocidad_Parte"] != ""){
				$Velocidad=$ingresoOrden[0]["Velocidad_Parte"];
			}else if($ingresoOrden[0]["Revoluciones_Por_Minuto"] == "" && $ingresoOrden[0]["Velocidad_Parte"] == ""){
				$Velocidad=null;
			}

			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objOrden->Consultar($sqlempresa);

			$sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
			WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $ingresoOrden[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
			$Cliente = $objOrden->Consultar($sqlcliente);

			$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Empleado = $objOrden->Consultar($sqlEmpleado);
		
			$sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
			$sedes = $objOrden->Consultar($sqlsede);

			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
			$servicios = $objOrden->Consultar($sqlserv);

			$sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
			$tipos_servicios = $objOrden->Consultar($sqltipo_servicio);

			$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    		$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

			// FECHA LIMITE DE ENTREGA
			$diaSemana = $dias[date("w", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]))];
			$dia = date("d", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]));
			$mes = $meses[date("m", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]))*1-1];
			$ano = date("Y", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]));
			$fechaEntrega = $diaSemana.", ".$dia." de ".$mes." de ".$ano;
			// FIN FECHA LIMITE DE ENTREGA

			include_once '../../views/OrdenTrabajo/GuiVerOrdenTrabajo.html.php';
		}

		public function getEditarOrdenTrabajo(){
			$objOrden = new OrdenTrabajoModel();

			$numero_orden = $_GET["numero_doc"];
			$nit_sede = $_GET["nit_sede"];

			$sqlOrden="SELECT ot.Numero_Ingreso, ot.Numero_Orden, ot.Creada_Por, ot.Estado, 
			DATE_FORMAT(ot.Fecha_Creada, '%Y-%m-%d') AS Fecha_Creada, 
			DATE_FORMAT(ot.Fecha_Creada, '%m') AS Mes, 
			DATE_FORMAT(ot.Fecha_Creada, '%d') AS Dia, 
			DATE_FORMAT(ot.Fecha_Creada, '%Y') AS Año, 
			ot.Armado_Por, ot.Tipo_Orden, ot.Orden_Maestra, ot.Garantia, ot.Nit_Empresa FROM orden_trabajo AS ot 
			WHERE Numero_Orden='$numero_orden' AND Nit_Empresa='$nit_sede'";
			$Orden=$objOrden->Consultar($sqlOrden);

			$sqlDetalleOrden="SELECT * FROM detalle_orden_trabajo WHERE Numero_Orden='$numero_orden' AND Nit_Empresa='$nit_sede'";
			$DetalleOrden=$objOrden->Consultar($sqlDetalleOrden);

			if ($Orden[0]["Numero_Ingreso"] != "") {
				$sqldetalle = "SELECT encabezado_cotizacion_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, detalle_cotizacion_venta.Cantidad,detalle_cotizacion_venta.Valor_Unitario,
									detalle_cotizacion_venta.Porcentaje_Descuento, Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva, Prioridad
										FROM detalle_cotizacion_venta, productos_servicios, encabezado_cotizacion_venta
											WHERE encabezado_cotizacion_venta.Numero_Documento=detalle_cotizacion_venta.Numero_Documento
												AND encabezado_cotizacion_venta.Tipo_Documento=detalle_cotizacion_venta.Tipo_Documento
												AND encabezado_cotizacion_venta.NIT_Empresa=detalle_cotizacion_venta.NIT_Empresa
												AND detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
												AND encabezado_cotizacion_venta.Numero_Documento=
												(SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_cotizacion_venta 
												WHERE Numero_Ingreso = " . "'" . $Orden[0]["Numero_Ingreso"] . "'" . " AND Estado_Documento = 'A') 
												AND encabezado_cotizacion_venta.Tipo_Documento='CT' 
												AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' 
												AND encabezado_cotizacion_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
				$DetalleCT = $objOrden->Consultar($sqldetalle);

				if ($DetalleCT == null) {
					$sqldetalle = "SELECT encabezado_documento_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle, detalle_documento_venta.Cantidad,detalle_documento_venta.Valor_Unitario,
									detalle_documento_venta.Porcentaje_Descuento, Valor_Iva, detalle_documento_venta.Porcentaje_Iva, Prioridad
										FROM detalle_documento_venta, productos_servicios, encabezado_documento_venta
											WHERE encabezado_documento_venta.Numero_Documento=detalle_documento_venta.Numero_Documento
												AND encabezado_documento_venta.Tipo_Documento=detalle_documento_venta.Tipo_Documento
												AND encabezado_documento_venta.NIT_Empresa=detalle_documento_venta.NIT_Empresa
												AND detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
												AND encabezado_documento_venta.Numero_Documento=
												(SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_documento_venta 
												WHERE Numero_Ingreso = " . "'" . $Orden[0]["Numero_Ingreso"] . "'" . " AND Estado_Documento = 'A') 
												AND encabezado_documento_venta.Tipo_Documento='PL' 
												AND encabezado_documento_venta.NIT_Empresa='$nit_sede' 
												AND encabezado_documento_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
					$DetallePL = $objOrden->Consultar($sqldetalle);
					$Detalle=$DetallePL;
				}else{
					$Detalle=$DetalleCT;
				}
			} else {
				$Detalle = null;
			}

			$sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, equi.Nit_Cliente, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, 
						marcas.Descripcion AS Marca, ing.Numero_Serie, equi.Codigo_Planta, No_Fases, Frame, Potencia, Revoluciones_Por_Minuto, 
							Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio, Requisitos_Cliente
							FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru,
							marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $Orden[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
			$ingresoOrden = $objOrden->Consultar($sqlIngre);
			
			if ($ingresoOrden[0]["Codigo_Planta"] != null) {
				$sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente='".$ingresoOrden[0]["Nit_Cliente"]."' ";
				$plantas = $objOrden->Consultar($sqlplanta);
			} else {
				$plantas = null;
			}

			if ($ingresoOrden[0]["Voltaje"] != "") {
				$Voltaje=$ingresoOrden[0]["Voltaje"];
			}else if($ingresoOrden[0]["V_Primario"] != ""){
				$Voltaje=$ingresoOrden[0]["V_Primario"];
			}else if($ingresoOrden[0]["Va"] != ""){
				$Voltaje=$ingresoOrden[0]["Va"];
			}else if($ingresoOrden[0]["Voltaje"] == "" && $ingresoOrden[0]["V_Primario"] == "" && $ingresoOrden[0]["Va"] == ""){
				$Voltaje=null;
			}
			if ($ingresoOrden[0]["Revoluciones_Por_Minuto"] != "") {
				$Velocidad=$ingresoOrden[0]["Revoluciones_Por_Minuto"];
			}else if($ingresoOrden[0]["Velocidad_Parte"] != ""){
				$Velocidad=$ingresoOrden[0]["Velocidad_Parte"];
			}else if($ingresoOrden[0]["Revoluciones_Por_Minuto"] == "" && $ingresoOrden[0]["Velocidad_Parte"] == ""){
				$Velocidad=null;
			}

			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objOrden->Consultar($sqlempresa);

			$sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
			WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $ingresoOrden[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
			$Cliente = $objOrden->Consultar($sqlcliente);

			$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Empleado = $objOrden->Consultar($sqlEmpleado);
		
			$sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
			$sedes = $objOrden->Consultar($sqlsede);

			$sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
			$servicios = $objOrden->Consultar($sqlserv);

			$sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
			$tipos_servicios = $objOrden->Consultar($sqltipo_servicio);

			$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    		$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

			// FECHA LIMITE DE ENTREGA
			$diaSemana = $dias[date("w", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]))];
			$dia = date("d", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]));
			$mes = $meses[date("m", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]))*1-1];
			$ano = date("Y", mktime(0, 0, 0, $Orden[0]["Mes"], $Orden[0]["Dia"] + $Detalle[0]["Prioridad"] - 1, $Orden[0]["Año"]));
			$fechaEntrega = $diaSemana.", ".$dia." de ".$mes." de ".$ano;
			// FIN FECHA LIMITE DE ENTREGA

			include_once '../../views/OrdenTrabajo/GuiEditarOrdenTrabajo.html.php';
		}

		public function EditarOrdenTrabajo(){
			extract($_POST);
			$usu_id = $_SESSION["usua_id"];
			date_default_timezone_set("America/Bogota");
			$Fecha_Modifica = date("Y-m-d");
			$Hora_Creada = "0000-00-00 " . date("h:i:s");
			$objOrden = new OrdenTrabajoModel();

			if(!isset($Garantia)){$Garantia="N";}else{$Garantia="S";}

			if ($planta == null) {
				$planta = "";
			}

			$sqlOrden = "UPDATE orden_trabajo SET Creada_Por='$Creada_Por', Armado_Por='$Armado_Por', Fecha_Creada='$Fecha_Doc',
			Fecha_Modifica='$Fecha_Modifica', Orden_Maestra=NULL, Garantia='$Garantia' WHERE Numero_Orden='$numOrden' AND NIT_Empresa='$nit_sede' ";
			$objOrden->Actualizar($sqlOrden);

			if (isset($producto)) {
				for ($i = 0; $i < count($producto); $i++) {
					$sqlActividades="SELECT Codigo, Unidad_Negocio
					FROM productos_servicios WHERE Codigo = " . $producto[$i] . " ";
					$actividades=$objOrden->Consultar($sqlActividades);

					$sqlServ = "INSERT INTO detalle_orden_trabajo
					(Numero_Registro, Numero_Orden, Tipo_Actividad, Cantidad, Item, Codigo_Actividad, Detalle_Actividad, unidad_negocio, Nit_Empresa)
					VALUES
					(NULL, '$numOrden', 'C', " . $cant[$i] . ", $item[$i], " . $producto[$i] . ", '$detalle[$i]', '".$actividades[0]["Unidad_Negocio"]."', '$nit_sede')";
					$objOrden->Insertar($sqlServ);
				}
			}
			if (isset($producto_Editar)) {
				for ($i = 0; $i < count($producto_Editar); $i++) {
					$sqlActividades="SELECT Codigo, Unidad_Negocio
					FROM productos_servicios WHERE Codigo = " . $producto_Editar[$i] . " ";
					$actividades=$objOrden->Consultar($sqlActividades);

					$sqlOrden = "UPDATE detalle_orden_trabajo SET Tipo_Actividad='C', Cantidad=" . $cant_Editar[$i] . ", Item=$item_Editar[$i],
					Codigo_Actividad=" . $producto_Editar[$i] . ", Detalle_Actividad='$detalle_Editar[$i]', unidad_negocio='".$actividades[0]["Unidad_Negocio"]."' 
					WHERE Numero_Registro='$Numero_Registro_Editar[$i]' AND NIT_Empresa='$nit_sede' ";
					$objOrden->Actualizar($sqlOrden);
				}
			}
		}

		public function AnularOrdenTrabajo() {
			$numOrden = $_POST["numOrden"];
			$Razon_Anula = $_POST["Razon_Anula"];
			$nit_sede = $_POST["nit_sede"];
			$Usuario_Anula = $_SESSION["usua_id"];
	
			date_default_timezone_set("America/Bogota");
			$fecha = date("Y-m-d");
			$objOrden = new OrdenTrabajoModel();
			$sqlOrden = "UPDATE orden_trabajo SET Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha',
			Razon_Anula='$Razon_Anula',  Estado='I' WHERE Numero_Orden='$numOrden' AND Nit_Empresa='$nit_sede'";
			$UpdateOrden = $objOrden->Anular($sqlOrden);
		}

		public function VerDatosAdicionales(){
			$objOrden = new OrdenTrabajoModel();
			$numOrden = $_POST["numOrden"];

			$sqlDatos = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario, Fecha_Modifica, Usuario_Anula, Fecha_Anula, Razon_Anula, Usuario_Modifica
								FROM orden_trabajo, usuarios
									WHERE orden_trabajo.Usuario_Crea=usuarios.Cedula
										AND Numero_Orden='$numOrden'";
			$datos = $objOrden->Consultar($sqlDatos);

			$sqlOrden="SELECT * FROM orden_trabajo WHERE Numero_Orden = '$numOrden' AND Tipo_Orden = 'R' AND Estado = 'A' ";
			$reproceso=$objOrden->Consultar($sqlOrden);

			if ($datos != null) {
				if ($datos[0]["Usuario_Modifica"] != "") {
					$sqlModifica = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Modifica"] . "'";
					$modifica = $objOrden->Consultar($sqlModifica);
					$usuModifica = $modifica[0]["Nombre_Usuario"];
					$fechaModifica = $datos[0]["Fecha_Modifica"];
				} else {
					$usuModifica = "";
					$fechaModifica = "";
				}

				if ($datos[0]["Usuario_Anula"] != "") {
					$sqlElimina = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Anula"] . "'";
					$elimina = $objOrden->Consultar($sqlElimina);
					$usuElimina = $elimina[0]["Nombre_Usuario"];
					$fechaElimina = substr($datos[0]["Fecha_Anula"], 0, 10);

				} else {
					$usuElimina = "";
					$fechaElimina = "";
				}
				include_once '../../views/OrdenTrabajo/GuiVerDatosAdicionales.html.php';
			}
		}

		public function validarReprocesoOrden(){
			$objOrden = new OrdenTrabajoModel;
			$Orden_Maestra=$_POST["Orden_Maestra"];
			$estadoReproceso=false;

			$sqlOrden="SELECT * FROM orden_trabajo WHERE orden_maestra = '$Orden_Maestra' AND Tipo_Orden = 'R' AND Estado = 'A' ";
			$reproceso=$objOrden->Consultar($sqlOrden);

			if ($reproceso == null) {
            	echo json_encode(array("estadoReproceso" => $estadoReproceso));
			}else{
				$estadoReproceso = true;
				echo json_encode(array("estadoReproceso" => $estadoReproceso, "numReproceso" => $reproceso[0]["Numero_Orden"]));
			}
		}
	}
?>