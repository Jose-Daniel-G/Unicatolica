<?php
	include_once("../../app/Model/Informes/InformesModel.php");
	
	class InformesController{
		
		public function crearInformeTecnico(){
			$objInforme = new InformesModel();

			if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"])) {
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
				$empresas = $objInforme->Consultar($sqlempresa);
	
				$consIngreso = "SELECT ine.Numero_Ingreso FROM ingreso_equipos AS ine, equipos AS e
											WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["num_ingreso"]."' 
											AND e.Numero_Serie=ine.Numero_Serie 
											AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
				$Ingresos = $objInforme->Consultar($consIngreso);
			}else{
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social";
				$empresas = $objInforme->Consultar($sqlempresa);
			}
	
			$usua_perfil = $_SESSION['usua_perfil'];

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes = $objInforme->Consultar($sqlsede);
			
			$sqlIngeniero = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Ingeniero = $objInforme->Consultar($sqlIngeniero);

			include_once("../../views/Informes/GuiInformeTecnico.html.php");			
		}

		public function cargarDetalleRevisionIngreso(){
			$objInforme = new InformesModel();
			$Numero_Ingreso = $_POST["Numero_Ingreso"];
			$Tipo_Vista = $_POST["Tipo_Vista"];
			$datos = array();

			$sqlDetalle = "SELECT dri.Numero_Registro, dri.Numero_Ingreso, dri.Codigo_Revision, revi.Descripcion, 
			dri.Resultado, dri.Accion_Correctiva, dri.Realizada, infort.Nit_Empresa, infort.Estado_Documento 
			FROM informe_tecnico_reparacion_pruebas AS infort, detalle_revision_ingreso AS dri, revisiones AS revi 
			WHERE infort.Numero_Ingreso = dri.Numero_Ingreso 
			AND infort.Nit_Empresa = dri.Nit_Empresa 
			AND dri.Numero_Ingreso = '$Numero_Ingreso'
			AND dri.Codigo_Revision = revi.Codigo_Revision ORDER BY dri.Numero_Registro ASC";
			$Detalle = $objInforme->Consultar($sqlDetalle);

			$sqlActividades = "SELECT ps.Descripcion, dot.Codigo_Actividad FROM orden_trabajo AS ot, detalle_orden_trabajo AS dot, productos_servicios AS ps 
			WHERE ot.Numero_Orden = dot.Numero_Orden AND dot.Numero_Orden = 
			(SELECT MAX(Numero_Orden) AS Numero_Orden FROM orden_trabajo 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado = 'A') 
			AND dot.Codigo_Actividad = ps.Codigo
			ORDER BY dot.Numero_Registro ASC";
			$Actividades = $objInforme->Consultar($sqlActividades);

			$index = 0;

			if (!empty($Numero_Ingreso)) {
				if ($Detalle != null) {
					foreach ($Detalle as $detalle) {
						if ($Tipo_Vista == "ver") {
							$propiedad = "disabled";
						}else if($Tipo_Vista == "editar"){
							$propiedad = "";
						}

						if ($detalle["Resultado"] == "B") {
							$opcion_bueno = '<input type="radio" name="Resultado['.$index.']" class="form-control" value="B" checked '.$propiedad.'>';
							$opcion_malo = '<input type="radio" name="Resultado['.$index.']" class="form-control" value="M" '.$propiedad.'>';
						}else if($detalle["Resultado"] == "M"){
							$opcion_bueno = '<input type="radio" name="Resultado['.$index.']" class="form-control" value="B" '.$propiedad.'>';
							$opcion_malo = '<input type="radio" name="Resultado['.$index.']" class="form-control" value="M" checked '.$propiedad.'>';
						}
						if ($detalle["Realizada"] == "S") {
							$opcion_si = '<input type="radio" name="Realizada['.$index.']" class="form-control" value="S" checked '.$propiedad.'>';
							$opcion_no = '<input type="radio" name="Realizada['.$index.']" class="form-control" value="N" '.$propiedad.'>';
						}else if($detalle["Realizada"] == "N"){
							$opcion_si = '<input type="radio" name="Realizada['.$index.']" class="form-control" value="S" '.$propiedad.'>';
							$opcion_no = '<input type="radio" name="Realizada['.$index.']" class="form-control" value="N" checked '.$propiedad.'>';
						}

						if($Tipo_Vista == "ver"){
							$array = array(
								"index" => $index,
								"parte_revisada" => $detalle["Descripcion"],
								"opcion_bueno" => $opcion_bueno,
								"opcion_malo" => $opcion_malo,
								"accion_correctiva" => '
								<select name="Accion_Correctiva['.$index.']" id="Accion_Correctiva'.($index+1).'" class="form-control Accion_Correctiva">
									<option value="'.$detalle["Accion_Correctiva"].'" selected>'.$detalle["Accion_Correctiva"].'</option>
								</select>',
								"opcion_si" => $opcion_si,
								"opcion_no" => $opcion_no,
							);
						}else if($Tipo_Vista == "editar"){
							$select = '
							<select name="Accion_Correctiva['.$index.']" id="Accion_Correctiva'.($index+1).'" class="form-control Accion_Correctiva" required>
								<option value="">Seleccione ...</option>';
								foreach ($Actividades as $actividades) {
									if ($detalle["Accion_Correctiva"] == $actividades["Descripcion"]) {
										$select .= '<option value="' . $actividades["Descripcion"] . '" selected>' . $actividades["Descripcion"] . '</option>';
									}else{
										$select .= '<option value="' . $actividades["Descripcion"] . '">' . $actividades["Descripcion"] . '</option>';
									}
								}
								$select .= '
							</select>';

							// <select name="Accion_Correctiva['.$index.']" id="Accion_Correctiva'.($index+1).'" class="form-control Accion_Correctiva" required>
							// 	<option value="">Seleccione ...</option>
							// 	<option value="'.$detalle["Accion_Correctiva"].'" selected>'.$detalle["Accion_Correctiva"].'</option>
							// </select>

							$array = array(
								"index" => $index,
								"numero_registro" => '<input type="hidden" name="Numero_Registro['.$index.']" value="'.$detalle["Numero_Registro"].'">',
								"codigo_revision" => '<input type="hidden" name="Codigo_Revision['.$index.']" value="'.$detalle["Codigo_Revision"].'">',
								"parte_revisada" => $detalle["Descripcion"],
								"opcion_bueno" => $opcion_bueno,
								"opcion_malo" => $opcion_malo,
								"accion_correctiva" => $select,
								"opcion_si" => $opcion_si,
								"opcion_no" => $opcion_no,
								"opcion_borrar" => '<button type="button" class="btn btn-danger fa fa-minus" data-url="'.getUrl("Utilidades", "Utilidades", "EliminarDetalleDoc", false, "ajax").'" title="Borrar fila"></button>'
							);
						}
							
						$index++;
						array_push($datos, $array);
						}
				}else{
					$sqlRevisiones = "SELECT * FROM revisiones ORDER BY Codigo_Revision";
					$Revisiones = $objInforme->Consultar($sqlRevisiones);
	
					foreach ($Revisiones as $revisiones) {
						if ($index == 0) {
							$required = "required = 'required' ";
						}else{
							$required = "";
						}
						array_push($datos, 
						array(
								"index" => $index,
								"codigo_revision" => '<input type="hidden" name="Codigo_Revision['.$index.']" value="'.$revisiones["Codigo_Revision"].'">',
								"parte_revisada" => $revisiones["Descripcion"],
								"opcion_bueno" => '<input type="radio" name="Resultado['.$index.']" class="form-control" value="B" '.$required.'>',
								"opcion_malo" => '<input type="radio" name="Resultado['.$index.']" class="form-control" value="M" '.$required.'>',
								"accion_correctiva" => "",
								"opcion_si" => '<input type="radio" name="Realizada['.$index.']" class="form-control" value="S" '.$required.'>',
								"opcion_no" => '<input type="radio" name="Realizada['.$index.']" class="form-control" value="N" '.$required.'>',
								"opcion_borrar" => '<button type="button" class="btn btn-danger fa fa-minus" title="Borrar fila"></button>'
							));
							$index++;
						}
				}
			}else{
				$tabla = array();
			}

			$tabla = array("data" => $datos);
			echo json_encode($tabla);

		}

		public function cargarActividadOrdenTrabajo(){
			$objInforme = new InformesModel();
			$Numero_Ingreso = $_POST["Numero_Ingreso"];
			$select = "";

			$sqlActividades = "SELECT ps.Descripcion, dot.Codigo_Actividad FROM orden_trabajo AS ot, detalle_orden_trabajo AS dot, productos_servicios AS ps 
			WHERE ot.Numero_Orden = dot.Numero_Orden AND dot.Numero_Orden = 
			(SELECT MAX(Numero_Orden) AS Numero_Orden FROM orden_trabajo 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado = 'A') 
			AND dot.Codigo_Actividad = ps.Codigo
			ORDER BY dot.Numero_Registro ASC";
			$Actividades = $objInforme->Consultar($sqlActividades);

			if (!empty($_POST["Index"])) {
				$index = $_POST["Index"];
			}else{
				$index = 0;
			}

			if ($Actividades != null) {
				$select .= '
				<select name="Accion_Correctiva['.$index.']" id="Accion_Correctiva'.($index+1).'" class="form-control Accion_Correctiva" required>
					<option value="">Seleccione ...</option>';
					foreach ($Actividades as $actividades) {
						$select .= '<option value="' . $actividades["Descripcion"] . '">' . $actividades["Descripcion"] . '</option>';
					}
					$select .= '
				</select>';

				$tipo_respuesta = true;
			}else{
				$select = null;
				$tipo_respuesta = false;
			}

			$select .= '
			<script>
				$(".Accion_Correctiva").select2({
					language: "es",
					width: "100%",
					theme: "bootstrap"
				});
				$("b[role=presentation]").hide();
			</script>';

			echo json_encode(array("selectAccionCorrectiva" => $select, "tipoRespuesta" => $tipo_respuesta));
		}

		public function RegistrarInformeTecnico(){
			$objInforme = new InformesModel();

			extract($_POST);
			$usu_id = $_SESSION["usua_id"];
			date_default_timezone_set("America/Bogota");
			$Fecha_Documento = date("Y-m-d");

			if (!empty($num_ingreso)) {
				$no_ingreso=$num_ingreso;
			}
			if (!empty($nit_emp)) {
				$nit_empresa=$nit_emp;
			}

			if (!empty($nit_empresa) && !empty($no_ingreso)) {
				$sqlInforme = "INSERT INTO informe_tecnico_reparacion_pruebas
				(Numero_Documento, Numero_Ingreso, Fecha_Documento, Hora_Documento, Estado_Documento, 
				Observaciones_Causa_Falla, Observaciones_Inspeccion, Volt_Prueba, Volt_Prueba2, Hipot_mA, 
				R_Aisl_Gohm, Observaciones_Pru_elec, Axial_Lc, Axial_Loc, Vertical_Lc, Vertical_Loc, 
				Horizontal_Lc, Horizontal_Loc, Observaciones_Analisis_Vib, Ten_De_Pruebas, Conexion, 
				Observaciones_Pru_Sin_Carga, Ingeniero_Planta, Usuario_Crea, Surge_Impulso_F1, Surge_Impulso_F2, 
				Surge_Impulso_F3, Corriente_F1, Corriente_F2, Corriente_F3, Cedula_Responsable, Nit_Empresa)
				VALUES (NULL, '$no_ingreso', '$Fecha_Documento', NOW(), 'A', 
				'$Observaciones_Causa_Falla', '$Observaciones_Inspeccion', '$Volt_Prueba', '$Volt_Prueba2', '$Hipot_mA', 
				'$R_Aisl_Gohm', '$Observaciones_Pru_elec', '$Axial_Lc', '$Axial_Loc', '$Vertical_Lc', '$Vertical_Loc', 
				'$Horizontal_Lc', '$Horizontal_Loc', '$Observaciones_Analisis_Vib', '$Ten_De_Pruebas', '$Conexion', 
				'$Observaciones_Pru_Sin_Carga', '$Ingeniero_Planta', '$usu_id', '$Surge_Impulso_F1', '$Surge_Impulso_F2', 
				'$Surge_Impulso_F3', '$Corriente_F1', '$Corriente_F2', '$Corriente_F3', '$Cedula_Responsable', '$nit_sede')";
				$objInforme->Insertar($sqlInforme);

				$sqlID = "SELECT @@identity AS id";
				$id=$objInforme->Consultar($sqlID);
				$numInforme = trim($id[0][0]);
				
				foreach ($Resultado as $index => $value) {
					if (!isset($Accion_Correctiva[$index])) {
						$Accion_Correctiva[$index] = null;
					}

					$sqlDetalle = "INSERT INTO detalle_revision_ingreso
					(Numero_Registro, Numero_Ingreso, Codigo_Revision, Resultado, Accion_Correctiva, Realizada, Nit_Empresa)
					VALUES (NULL, '$no_ingreso', '$Codigo_Revision[$index]', '$Resultado[$index]', '$Accion_Correctiva[$index]', '$Realizada[$index]', '$nit_sede')";
					$objInforme->Insertar($sqlDetalle);
				}

				echo json_encode(array("numInforme" => $numInforme));
			}else{
				echo messageSweetAlert("Falta el Nit del cliente", "", "error", "", "si", "boton", getUrl("Informes", "Informes", "crearInformeTecnico"));
			}

		}

		public function getVerInformeTecnico(){
			$objInforme = new InformesModel();

			$numero_doc = $_GET["numero_doc"];
			$nit_sede = $_GET["nit_sede"];

			$sqlInforme="SELECT infort.Numero_Documento, infort.Numero_Ingreso, equi.Nit_Cliente, 
			DATE_FORMAT(infort.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, 
			infort.Nit_Empresa, infort.Estado_Documento, sede.nombre AS Sede, infort.Ingeniero_Planta, 
			infort.Observaciones_Causa_Falla, infort.Observaciones_Inspeccion, infort.Volt_Prueba, infort.Hipot_mA, 
			infort.Surge_Impulso_F1, infort.Surge_Impulso_F2, infort.Surge_Impulso_F3, infort.Volt_Prueba2, infort.R_Aisl_Gohm, 
			infort.Observaciones_Pru_elec, infort.Axial_Lc, infort.Axial_Loc, infort.Vertical_Lc, infort.Vertical_Loc, 
			infort.Horizontal_Lc, infort.Horizontal_Loc, infort.Observaciones_Analisis_Vib, infort.Ten_De_Pruebas, infort.Conexion, 
			infort.Corriente_F1, infort.Corriente_F2, infort.Corriente_F3, infort.Observaciones_Pru_Sin_Carga, infort.Cedula_Responsable
			FROM informe_tecnico_reparacion_pruebas AS infort, equipos AS equi, ingreso_equipos AS ing, sedes AS sede 
			WHERE infort.Numero_Ingreso=ing.Numero_Ingreso 
			AND ing.Numero_Serie=equi.Numero_Serie 
			AND infort.Nit_Empresa=sede.nit_empresa 
			AND infort.Numero_Documento = '$numero_doc' 
			AND infort.Nit_Empresa = '$nit_sede' ";
			$Informe = $objInforme->Consultar($sqlInforme);

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
									AND ing.Numero_Ingreso=" . "'" . $Informe[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
			$Ingreso = $objInforme->Consultar($sqlIngre);
			
			if ($Ingreso) {
				if ($Ingreso[0]["Voltaje"] != "") {
					$Voltaje=$Ingreso[0]["Voltaje"];
				}else if($Ingreso[0]["V_Primario"] != ""){
					$Voltaje=$Ingreso[0]["V_Primario"];
				}else if($Ingreso[0]["Va"] != ""){
					$Voltaje=$Ingreso[0]["Va"];
				}else if($Ingreso[0]["Voltaje"] == "" && $Ingreso[0]["V_Primario"] == "" && $Ingreso[0]["Va"] == ""){
					$Voltaje=null;
				}
				if ($Ingreso[0]["Revoluciones_Por_Minuto"] != "") {
					$Velocidad=$Ingreso[0]["Revoluciones_Por_Minuto"];
				}else if($Ingreso[0]["Velocidad_Parte"] != ""){
					$Velocidad=$Ingreso[0]["Velocidad_Parte"];
				}else if($Ingreso[0]["Revoluciones_Por_Minuto"] == "" && $Ingreso[0]["Velocidad_Parte"] == ""){
					$Velocidad=null;
				}
			}

			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objInforme->Consultar($sqlempresa);

			$sqlIngeniero = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Ingeniero = $objInforme->Consultar($sqlIngeniero);

			$sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
			WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $Informe[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
			$Cliente = $objInforme->Consultar($sqlcliente);
			
			$sqlresponsable = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa = '$nit_sede' AND Estado = 'A' ORDER BY Nombre_Completo";
        	$responsable = $objInforme->Consultar($sqlresponsable);

			include_once "../../views/Informes/GuiVerInformeTecnico.html.php";
		}

		public function getEditarInformeTecnico(){
			$objInforme = new InformesModel();

			$numero_doc = $_GET["numero_doc"];
			$nit_sede = $_GET["nit_sede"];

			$sqlInforme="SELECT infort.Numero_Documento, infort.Numero_Ingreso, equi.Nit_Cliente, 
			DATE_FORMAT(infort.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, 
			infort.Nit_Empresa, infort.Estado_Documento, sede.nombre AS Sede, infort.Ingeniero_Planta, 
			infort.Observaciones_Causa_Falla, infort.Observaciones_Inspeccion, infort.Volt_Prueba, infort.Hipot_mA, 
			infort.Surge_Impulso_F1, infort.Surge_Impulso_F2, infort.Surge_Impulso_F3, infort.Volt_Prueba2, infort.R_Aisl_Gohm, 
			infort.Observaciones_Pru_elec, infort.Axial_Lc, infort.Axial_Loc, infort.Vertical_Lc, infort.Vertical_Loc, 
			infort.Horizontal_Lc, infort.Horizontal_Loc, infort.Observaciones_Analisis_Vib, infort.Ten_De_Pruebas, infort.Conexion, 
			infort.Corriente_F1, infort.Corriente_F2, infort.Corriente_F3, infort.Observaciones_Pru_Sin_Carga, infort.Cedula_Responsable
			FROM informe_tecnico_reparacion_pruebas AS infort, equipos AS equi, ingreso_equipos AS ing, sedes AS sede 
			WHERE infort.Numero_Ingreso=ing.Numero_Ingreso 
			AND ing.Numero_Serie=equi.Numero_Serie 
			AND infort.Nit_Empresa=sede.nit_empresa 
			AND infort.Numero_Documento = '$numero_doc' 
			AND infort.Nit_Empresa = '$nit_sede' ";
			$Informe = $objInforme->Consultar($sqlInforme);

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
									AND ing.Numero_Ingreso=" . "'" . $Informe[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
			$Ingreso = $objInforme->Consultar($sqlIngre);
			
			if ($Ingreso) {
				if ($Ingreso[0]["Voltaje"] != "") {
					$Voltaje=$Ingreso[0]["Voltaje"];
				}else if($Ingreso[0]["V_Primario"] != ""){
					$Voltaje=$Ingreso[0]["V_Primario"];
				}else if($Ingreso[0]["Va"] != ""){
					$Voltaje=$Ingreso[0]["Va"];
				}else if($Ingreso[0]["Voltaje"] == "" && $Ingreso[0]["V_Primario"] == "" && $Ingreso[0]["Va"] == ""){
					$Voltaje=null;
				}
				if ($Ingreso[0]["Revoluciones_Por_Minuto"] != "") {
					$Velocidad=$Ingreso[0]["Revoluciones_Por_Minuto"];
				}else if($Ingreso[0]["Velocidad_Parte"] != ""){
					$Velocidad=$Ingreso[0]["Velocidad_Parte"];
				}else if($Ingreso[0]["Revoluciones_Por_Minuto"] == "" && $Ingreso[0]["Velocidad_Parte"] == ""){
					$Velocidad=null;
				}
			}

			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objInforme->Consultar($sqlempresa);

			$sqlIngeniero = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
			$Ingeniero = $objInforme->Consultar($sqlIngeniero);

			$sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
			WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $Informe[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
			$Cliente = $objInforme->Consultar($sqlcliente);
			
			$sqlresponsable = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa = '$nit_sede' AND Estado = 'A' ORDER BY Nombre_Completo";
        	$responsable = $objInforme->Consultar($sqlresponsable);

			include_once "../../views/Informes/GuiEditarInformeTecnico.html.php";
		}

		public function EditarInformeTecnico(){
			$objInforme = new InformesModel();
			extract($_POST);
			$usu_id = $_SESSION["usua_id"];
			date_default_timezone_set("America/Bogota");
			$Fecha_Modifica = date("Y-m-d");

			$sqlInforme = "UPDATE informe_tecnico_reparacion_pruebas
			SET Fecha_Documento='$Fecha_Doc', Observaciones_Causa_Falla='$Observaciones_Causa_Falla', 
			Observaciones_Inspeccion='$Observaciones_Inspeccion', Volt_Prueba='$Volt_Prueba', Volt_Prueba2='$Volt_Prueba2', 
			Hipot_mA='$Hipot_mA', R_Aisl_Gohm='$R_Aisl_Gohm', Observaciones_Pru_elec='$Observaciones_Pru_elec', 
			Axial_Lc='$Axial_Lc', Axial_Loc='$Axial_Loc', Vertical_Lc='$Vertical_Lc', Vertical_Loc='$Vertical_Loc', 
			Horizontal_Lc='$Horizontal_Lc', Horizontal_Loc='$Horizontal_Loc', Observaciones_Analisis_Vib='$Observaciones_Analisis_Vib', 
			Ten_De_Pruebas='$Ten_De_Pruebas', Conexion='$Conexion', Observaciones_Pru_Sin_Carga='$Observaciones_Pru_Sin_Carga', 
			Ingeniero_Planta='$Ingeniero_Planta', Usuario_Modifica='$usu_id', Fecha_Modifica='$Fecha_Modifica', 
			Surge_Impulso_F1='$Surge_Impulso_F1', Surge_Impulso_F2='$Surge_Impulso_F2', Surge_Impulso_F3='$Surge_Impulso_F3', 
			Corriente_F1='$Corriente_F1', Corriente_F2='$Corriente_F2', Corriente_F3='$Corriente_F3', Cedula_Responsable='$Cedula_Responsable' 
			WHERE Numero_Documento='$numInforme' AND Nit_Empresa='$nit_sede' ";
			$objInforme->Actualizar($sqlInforme);

			foreach ($Resultado as $index => $value) {
				$sqlDetalle = "UPDATE detalle_revision_ingreso SET Codigo_Revision='$Codigo_Revision[$index]', Resultado='$Resultado[$index]', 
				Accion_Correctiva='$Accion_Correctiva[$index]', Realizada='$Realizada[$index]'
				WHERE Numero_Registro = '$Numero_Registro[$index]' AND Nit_Empresa='$nit_sede' ";
				$objInforme->Actualizar($sqlDetalle);
			}
		}

		public function AnularInformeTecnico() {
			$numInforme = $_POST["numInforme"];
			$Razon_Anula = $_POST["Razon_Anula"];
			$nit_sede = $_POST["nit_sede"];
			$Usuario_Anula = $_SESSION["usua_id"];
	
			date_default_timezone_set("America/Bogota");
			$fecha = date("Y-m-d");
			$objInforme = new InformesModel();
			$sqlInforme = "UPDATE informe_tecnico_reparacion_pruebas SET Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha',
			Razon_Anula='$Razon_Anula',  Estado_Documento='I' WHERE Numero_Documento='$numInforme' AND Nit_Empresa='$nit_sede'";
			$UpdateInforme = $objInforme->Anular($sqlInforme);
		}

		public function VerDatosAdicionales() {
			$objInforme = new InformesModel();
			$numInforme = $_POST["numInforme"];
	
			$sqlDatos = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario, Fecha_Modifica, Usuario_Anula, Fecha_Anula, Razon_Anula, Usuario_Modifica
								FROM informe_tecnico_reparacion_pruebas, usuarios
									WHERE informe_tecnico_reparacion_pruebas.Usuario_Crea=usuarios.Cedula
										AND Numero_Documento='$numInforme'";
			$datos = $objInforme->Consultar($sqlDatos);
	
			if ($datos != null) {
				if ($datos[0]["Usuario_Modifica"] != "") {
					$sqlModifica = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Modifica"] . "'";
					$modifica = $objInforme->Consultar($sqlModifica);
					$usuModifica = $modifica[0]["Nombre_Usuario"];
					$fechaModifica = $datos[0]["Fecha_Modifica"];
				} else {
					$usuModifica = "";
					$fechaModifica = "";
				}

				if ($datos[0]["Usuario_Anula"] != "") {
					$sqlElimina = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Anula"] . "'";
					$elimina = $objInforme->Consultar($sqlElimina);
					$usuElimina = $elimina[0]["Nombre_Usuario"];
					$fechaElimina = substr($datos[0]["Fecha_Anula"], 0, 10);

				} else {
					$usuElimina = "";
					$fechaElimina = "";
				}
				include_once '../../views/GastosDirectos/GuiVerDatosAdicionales.html.php';
			}
		}
	}
?>