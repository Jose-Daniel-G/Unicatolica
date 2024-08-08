<?php
	include_once('../../app/Model/Reportes/ReportesModel.php');
	
	class ReportesController{
		public function reporteCotizacion(){
			$ObjReportes = new ReportesModel();

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes = $ObjReportes->Consultar($sqlsede);
			
			include_once("../../views/Reportes/GuiReporteCotizacion.html.php");
		}

		public function reporteFactura(){
			$ObjReportes = new ReportesModel();

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes = $ObjReportes->Consultar($sqlsede);
			
			include_once("../../views/Reportes/GuiReporteFactura.html.php");
		}

		public function listarReporteCotizacion(){
			extract($_POST);
			$condicion = "";
			$datos = array();
			
			$ObjReportes = new ReportesModel();

			if ($nit_sede != "") {
				$condicion .= " AND ecv.NIT_Empresa='$nit_sede'";
			}
			if ($nit_empresa != "") {
				$condicion .= " AND cli.Nit_Cliente='$nit_empresa'";
			}
			if ($fecha_desde != "" and $fecha_hasta != "") {
				$condicion .= " AND ecv.Fecha_Documento BETWEEN ('$fecha_desde') AND ('$fecha_hasta')";
			}
			if ($proceso != "") {
				if ($proceso == "A") {
					$condicion .= " AND (ecv.FechaAprobacion != '0000-00-00')";
				}else if($proceso == "NA"){
					$condicion .= " AND (ecv.FechaAprobacion = '0000-00-00')";
				}
			}
			if ($vendedor != "") {
				$condicion .= " AND ecv.Cedula_Empleado = '$vendedor'";
			}

			$sqlReporteCotizacion = "SELECT ecv.Numero_Documento, ing.Numero_Ingreso, tequi.Descripcion AS Equipo, cli.Razon_Social AS Cliente, 
			DATE_FORMAT(ecv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, CONCAT(dequi.Potencia,' - ', dequi.Unidad_De_Potencia) AS Potencia_Ing, 
			COALESCE(dequi.Revoluciones_Por_Minuto, ing.Velocidad_Parte) AS Velocidad_Ing, COALESCE(dequi.Voltaje, dequi.V_Primario, dequi.Va) AS Voltaje_Ing,
			ecv.Potencia AS Potencia_CT, ecv.Rpm AS Velocidad_CT, ecv.Voltaje AS Voltaje_CT, ecv.Subtotal, ecv.Iva, ecv.Total, ecv.Estado_Documento, 
			CONCAT(emple.Nombres, ' ', emple.Apellidos) AS Vendedor, ecv.CotizacionAutorizada, 
			IF(ing.tipo_ingreso = 'OT', 'S', 'N') Outsourcing
			FROM encabezado_cotizacion_venta ecv 
			LEFT JOIN ingreso_equipos ing ON ecv.Numero_Ingreso = ing.Numero_Ingreso 
			LEFT JOIN equipos equi ON ing.Numero_Serie = equi.Numero_Serie
			LEFT JOIN tipos_equipos tequi ON COALESCE(equi.Codigo_Tipo_Equipo, ecv.Equipo) = tequi.Codigo_Tipo_Equipo
			LEFT JOIN detalle_equipo dequi ON dequi.Numero_Serie = equi.Numero_Serie
			LEFT JOIN clientes cli ON ecv.Nit_Cliente = cli.Nit_Cliente
			LEFT JOIN empleados emple ON ecv.Cedula_Empleado = emple.Cedula_Empleado
			WHERE ecv.Estado_Documento LIKE '%$estado%' $condicion 
			GROUP BY ecv.Fecha_Documento DESC, ecv.Numero_Documento DESC";
			$ReporteCotizacion = $ObjReportes->Consultar($sqlReporteCotizacion);

			foreach ($ReporteCotizacion as $reportecotizacion) {
				if ($reportecotizacion["Numero_Ingreso"] != "") {
					$Potencia = $reportecotizacion["Potencia_Ing"];
					$Velocidad = $reportecotizacion["Velocidad_Ing"];
					$Voltaje = $reportecotizacion["Voltaje_Ing"];
				}else{
					$Potencia = $reportecotizacion["Potencia_CT"];
					$Velocidad = $reportecotizacion["Velocidad_CT"];
					$Voltaje = $reportecotizacion["Voltaje_CT"];
				}
				
				array_push($datos,
				array(
					"numero_documento" => $reportecotizacion["Numero_Documento"],
					"fecha_documento" => $reportecotizacion["Fecha_Documento"],
					"cliente" => $reportecotizacion["Cliente"],
					"numero_ingreso" => $reportecotizacion["Numero_Ingreso"],
					"equipo" => $reportecotizacion["Equipo"],
					"potencia" => $Potencia,
					"velocidad" => $Velocidad,
					"voltaje" => $Voltaje,
					"subtotal" => number_format($reportecotizacion["Subtotal"], 0, ",", ","),
					"iva" => number_format($reportecotizacion["Iva"], 0, ",", ","),
					"total" => number_format($reportecotizacion["Total"], 0, ",", ","),
					"estado" => $reportecotizacion["Estado_Documento"],
					"vendedor" => $reportecotizacion["Vendedor"],
					"outsourcing" => $reportecotizacion["Outsourcing"],
					"seleccionar" => '
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="defaultUnchecked'.$reportecotizacion["Numero_Documento"].'">
						<label class="custom-control-label custom-control-label-lg" for="defaultUnchecked'.$reportecotizacion["Numero_Documento"].'"></label>
					</div>',
					"CotizacionAutorizada" => $reportecotizacion["CotizacionAutorizada"]
				));
			}

			$tabla = array("data" => $datos);
            echo json_encode($tabla);
		}

		public function listarReporteFactura(){
			extract($_POST);
			$condicion = "";
			$datos = array();
			
			$ObjReportes = new ReportesModel();

			if ($nit_sede != "") {
				$condicion .= " AND efv.NIT_Empresa='$nit_sede'";
			}
			if ($nit_empresa != "") {
				$condicion .= " AND cli.Nit_Cliente='$nit_empresa'";
			}
			if ($fecha_desde != "" and $fecha_hasta != "") {
				$condicion .= " AND efv.Fecha_Documento BETWEEN ('$fecha_desde') AND ('$fecha_hasta')";
			}
			if ($proceso != "") {
				if ($proceso == "A") {
					$condicion .= " AND (efv.FechaAprobacion != '0000-00-00')";
				}else if($proceso == "NA"){
					$condicion .= " AND (efv.FechaAprobacion = '0000-00-00')";
				}
			}
			if ($vendedor != "") {
				$condicion .= " AND efv.Cedula_Empleado = '$vendedor'";
			}

			$sqlReporteFactura = "SELECT efv.Numero_Documento, ing.Numero_Ingreso, tequi.Descripcion AS Equipo, cli.Razon_Social AS Cliente, 
			DATE_FORMAT(efv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, CONCAT(dequi.Potencia,' - ', dequi.Unidad_De_Potencia) AS Potencia_Ing, 
			COALESCE(dequi.Revoluciones_Por_Minuto, ing.Velocidad_Parte) AS Velocidad_Ing, COALESCE(dequi.Voltaje, dequi.V_Primario, dequi.Va) AS Voltaje_Ing,
			ecv.Potencia AS Potencia_CT, ecv.Rpm AS Velocidad_CT, ecv.Voltaje AS Voltaje_CT, efv.Subtotal, efv.Iva, efv.Descuento, efv.Total, efv.Estado_Documento, 
			CONCAT(emple.Nombres, ' ', emple.Apellidos) AS Vendedor,
			IF(ing.tipo_ingreso = 'OT', 'S', 'N') Outsourcing
			FROM encabezado_factura_venta efv
			LEFT JOIN encabezado_cotizacion_venta ecv ON efv.Numero_Cotizacion = ecv.Numero_Documento
			LEFT JOIN ingreso_equipos ing ON efv.Numero_Ingreso = ing.Numero_Ingreso 
			LEFT JOIN equipos equi ON ing.Numero_Serie = equi.Numero_Serie
			LEFT JOIN tipos_equipos tequi ON COALESCE(equi.Codigo_Tipo_Equipo, ecv.Equipo) = tequi.Codigo_Tipo_Equipo
			LEFT JOIN detalle_equipo dequi ON dequi.Numero_Serie = equi.Numero_Serie
			LEFT JOIN clientes cli ON efv.Nit_Cliente = cli.Nit_Cliente
			LEFT JOIN empleados emple ON efv.Cedula_Empleado = emple.Cedula_Empleado
			WHERE efv.Estado_Documento LIKE '%$estado%'
			$condicion GROUP BY efv.Fecha_Documento DESC, efv.Numero_Documento DESC";
			$ReporteFactura = $ObjReportes->Consultar($sqlReporteFactura);

			foreach ($ReporteFactura as $reportefactura) {
				array_push($datos,
				array(
					"numero_documento" => $reportefactura["Numero_Documento"],
					"fecha_documento" => $reportefactura["Fecha_Documento"],
					"cliente" => $reportefactura["Cliente"],
					"subtotal" => number_format($reportefactura["Subtotal"], 0, ",", ","),
					"iva" => number_format($reportefactura["Iva"], 0, ",", ","),
					"descuentos" => number_format($reportefactura["Descuento"], 0, ",", ","),
					"total" => number_format($reportefactura["Total"], 0, ",", ","),
					"estado" => $reportefactura["Estado_Documento"]
				));
			}

			$tabla = array("data" => $datos);
            echo json_encode($tabla);
		}

		public function procesoNoAprobacionCT(){
			$ObjReportes = new ReportesModel();
			$Numero_Documento = $_POST["Numero_Documento"];
			$DescripcionNoAutorizada = $_POST["DescripcionNoAutorizada"];
			$FechaMarcaNoAutorizada = date("Y-m-d");
			$UsuarioMarcaNoAutorizada = $_SESSION["usua_id"];

			$sqlNoAprob = "UPDATE encabezado_cotizacion_venta SET
				CotizacionAutorizada='N',
				FechaMarcaNoAutorizada='$FechaMarcaNoAutorizada',
				UsuarioMarcaNoAutorizada='$UsuarioMarcaNoAutorizada',
				DescripcionNoAutorizada='$DescripcionNoAutorizada'
				WHERE Numero_Documento = '$Numero_Documento' ";
			$ObjReportes->Actualizar($sqlNoAprob);

			if (mysqli_affected_rows($ObjReportes->conexion) > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}
	}
?>