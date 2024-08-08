<?php
	include_once('../../app/Model/GastosDirectos/GastosDirectosModel.php');
	
	class GastosDirectosController{
		
		public function crearGastoDirectoFabricacion(){
			$objGasto = new GastosDirectosModel();

			$usua_perfil = $_SESSION["usua_perfil"];

			if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"])) {
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
				$empresas = $objGasto->Consultar($sqlempresa);

				$consIngreso = "SELECT ine.Numero_Ingreso FROM ingreso_equipos AS ine, equipos AS e
											WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["num_ingreso"]."' 
											AND e.Numero_Serie=ine.Numero_Serie 
											AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
				$Ingresos = $objGasto->Consultar($consIngreso);

			}else{
				$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social ";
				$empresas = $objGasto->Consultar($sqlempresa);
			}

			$sqlTiposIva = "SELECT Id_Iva, Descripcion FROM tipos_iva WHERE Estado = 'A' ";
			$tipos_iva = $objGasto->Consultar($sqlTiposIva);

			$sqlCuentasGasto = "SELECT Codigo_Cuenta, Nombre_Cuenta FROM maestro_puc WHERE Estado = 'A' ";
			$cuentasGasto = $objGasto->Consultar($sqlCuentasGasto);

			$sqlUnidadesNegocio = "SELECT Codigo, Descripcion FROM unidades_negocio WHERE Estado = 'A' ";
			$unidadesNegocio = $objGasto->Consultar($sqlUnidadesNegocio);

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes = $objGasto->Consultar($sqlsede);

			$sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
			$marcas = $objGasto->Consultar($sqlmarca);
			
			include_once("../../views/GastosDirectos/GuiGastoDirectoFabricacion.html.php");			
		}

		public function RegistrarGastoDirecto(){
			extract($_POST);
			$usu_id = $_SESSION["usua_id"];
			date_default_timezone_set("America/Bogota");
			$Fecha_Documento = date("Y-m-d");
			$Hora_Documento = "0000-00-00 " . date("h:i:s");
			$objGasto = new GastosDirectosModel();

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

				$sqlGasto = "INSERT INTO encabezado_gastosdirectos
				(Numero_Documento, Fecha_Documento, Hora_Documento, Cedula_Empleado, Estado_Documento, Nit_Cliente, 
				Numero_Ingreso, Detalle, Total, Codigo_Cuenta_Contable, Fecha_Gasto, Desc_Tipo_Iva, Unidad_Negocio, Usuario_Crea, 
				NoDocumentoCruce, TipoDocumentoCruce, Nit_Empresa)
				VALUES 
				(NULL, '$Fecha_Documento', '$Hora_Documento', '$usu_id', 'A', '$nit_empresa', 
				'$no_ingreso', '$Detalle', " . str_replace(",", "", $Total) . ", '$Codigo_Cuenta_Contable', '$Fecha_Gasto', 
				'$Desc_Tipo_Iva', '$Unidad_Negocio', '$usu_id', 
				'$NoDocumentoCruce', '$TipoDocumentoCruce', '$nit_sede')";
				$objGasto->Insertar($sqlGasto);
				
				$sqlID = "SELECT @@identity AS id";
				$id=$objGasto->Consultar($sqlID);
				$numGasto = trim($id[0][0]);

				echo json_encode(array("numGasto" => $numGasto));
			}else{
				echo messageSweetAlert("Falta el Nit del cliente y/o el Número de ingreso", "", "error", "", "si", "boton", getUrl('Remisiones', 'Remisiones', 'crearRemision'));
			}
		}

		public function getVerGastoDirectoFabricacion(){
			$objGasto = new GastosDirectosModel();

			$numero_doc = $_GET["numero_doc"];
			$nit_sede = $_GET["nit_sede"];

			$sqlGasto = "SELECT egd.Numero_Documento, egd.Fecha_Documento, egd.Estado_Documento, egd.Nit_Cliente, egd.Numero_Ingreso, egd.Detalle, 
			egd.Total, egd.Codigo_Cuenta_Contable, egd.Fecha_Gasto, tiva.Id_Iva, egd.Unidad_Negocio, egd.NoDocumentoCruce, egd.TipoDocumentoCruce, egd.Nit_Empresa 
			FROM encabezado_gastosdirectos AS egd, tipos_iva AS tiva 
			WHERE Numero_Documento = '$numero_doc' 
			AND Nit_Empresa = '$nit_sede' 
			AND egd.Desc_Tipo_Iva = tiva.Descripcion";
			$Gasto = $objGasto->Consultar($sqlGasto);

			$sqlIngre = "SELECT ing.Numero_Ingreso, equi.Nit_Cliente, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo,
                            marcas.Descripcion AS Marca, marcas.Codigo_Marca, ing.Numero_Serie, No_Fases, Frame, Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, 
                            Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $Gasto[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
        	$ingresosGD = $objGasto->Consultar($sqlIngre);

			if ($ingresosGD) {
				if ($ingresosGD[0]["Voltaje"] != "") {
					$Voltaje=$ingresosGD[0]["Voltaje"];
				}else if($ingresosGD[0]["V_Primario"] != ""){
					$Voltaje=$ingresosGD[0]["V_Primario"];
				}else if($ingresosGD[0]["Va"] != ""){
					$Voltaje=$ingresosGD[0]["Va"];
				}else if($ingresosGD[0]["Voltaje"] == "" && $ingresosGD[0]["V_Primario"] == "" && $ingresosGD[0]["Va"] == ""){
					$Voltaje=null;
				}
				if ($ingresosGD[0]["Revoluciones_Por_Minuto"] != "") {
					$Velocidad=$ingresosGD[0]["Revoluciones_Por_Minuto"];
				}else if($ingresosGD[0]["Velocidad_Parte"] != ""){
					$Velocidad=$ingresosGD[0]["Velocidad_Parte"];
				}else if($ingresosGD[0]["Revoluciones_Por_Minuto"] == "" && $ingresosGD[0]["Velocidad_Parte"] == ""){
					$Velocidad=null;
				}
			}

			$sqlTiposIva = "SELECT Id_Iva, Descripcion FROM tipos_iva WHERE Estado = 'A' ";
			$tipos_iva = $objGasto->Consultar($sqlTiposIva);

			$sqlCuentasGasto = "SELECT Codigo_Cuenta, Nombre_Cuenta FROM maestro_puc WHERE Estado = 'A' ";
			$cuentasGasto = $objGasto->Consultar($sqlCuentasGasto);

			$sqlUnidadesNegocio = "SELECT Codigo, Descripcion FROM unidades_negocio WHERE Estado = 'A' ";
			$unidadesNegocio = $objGasto->Consultar($sqlUnidadesNegocio);

			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objGasto->Consultar($sqlempresa);

			$sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
			WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $ingresosGD[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
			$Cliente = $objGasto->Consultar($sqlcliente);
			
			$sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
			$marcas = $objGasto->Consultar($sqlmarca);

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
			$sedes = $objGasto->Consultar($sqlsede);

			include_once "../../views/GastosDirectos/GuiVerGastoDirectoFabricacion.html.php";
		}

		public function getEditarGastoDirectoFabricacion(){
			$objGasto = new GastosDirectosModel();

			$numero_doc = $_GET["numero_doc"];
			$nit_sede = $_GET["nit_sede"];

			$sqlGasto = "SELECT egd.Numero_Documento, egd.Fecha_Documento, egd.Estado_Documento, egd.Nit_Cliente, egd.Numero_Ingreso, egd.Detalle, 
			egd.Total, egd.Codigo_Cuenta_Contable, egd.Fecha_Gasto, tiva.Id_Iva, egd.Unidad_Negocio, egd.NoDocumentoCruce, egd.TipoDocumentoCruce, egd.Nit_Empresa 
			FROM encabezado_gastosdirectos AS egd, tipos_iva AS tiva 
			WHERE Numero_Documento = '$numero_doc' 
			AND Nit_Empresa = '$nit_sede' 
			AND egd.Desc_Tipo_Iva = tiva.Descripcion";
			$Gasto = $objGasto->Consultar($sqlGasto);

			$sqlIngre = "SELECT ing.Numero_Ingreso, equi.Nit_Cliente, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo,
                            marcas.Descripcion AS Marca, marcas.Codigo_Marca, ing.Numero_Serie, No_Fases, Frame, Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, 
                            Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $Gasto[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
        	$ingresosGD = $objGasto->Consultar($sqlIngre);

			if ($ingresosGD) {
				if ($ingresosGD[0]["Voltaje"] != "") {
					$Voltaje=$ingresosGD[0]["Voltaje"];
				}else if($ingresosGD[0]["V_Primario"] != ""){
					$Voltaje=$ingresosGD[0]["V_Primario"];
				}else if($ingresosGD[0]["Va"] != ""){
					$Voltaje=$ingresosGD[0]["Va"];
				}else if($ingresosGD[0]["Voltaje"] == "" && $ingresosGD[0]["V_Primario"] == "" && $ingresosGD[0]["Va"] == ""){
					$Voltaje=null;
				}
				if ($ingresosGD[0]["Revoluciones_Por_Minuto"] != "") {
					$Velocidad=$ingresosGD[0]["Revoluciones_Por_Minuto"];
				}else if($ingresosGD[0]["Velocidad_Parte"] != ""){
					$Velocidad=$ingresosGD[0]["Velocidad_Parte"];
				}else if($ingresosGD[0]["Revoluciones_Por_Minuto"] == "" && $ingresosGD[0]["Velocidad_Parte"] == ""){
					$Velocidad=null;
				}
			}

			$sqlTiposIva = "SELECT Id_Iva, Descripcion FROM tipos_iva WHERE Estado = 'A' ";
			$tipos_iva = $objGasto->Consultar($sqlTiposIva);

			$sqlCuentasGasto = "SELECT Codigo_Cuenta, Nombre_Cuenta FROM maestro_puc WHERE Estado = 'A' ";
			$cuentasGasto = $objGasto->Consultar($sqlCuentasGasto);

			$sqlUnidadesNegocio = "SELECT Codigo, Descripcion FROM unidades_negocio WHERE Estado = 'A' ";
			$unidadesNegocio = $objGasto->Consultar($sqlUnidadesNegocio);

			$sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
			$empresas = $objGasto->Consultar($sqlempresa);

			$sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
			WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $ingresosGD[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
			$Cliente = $objGasto->Consultar($sqlcliente);
			
			$sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
			$marcas = $objGasto->Consultar($sqlmarca);

			$sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
			$sedes = $objGasto->Consultar($sqlsede);

			include_once "../../views/GastosDirectos/GuiEditarGastoDirectoFabricacion.html.php";
		}

		public function EditarGastoDirectoFabricacion(){
			extract($_POST);
			$usu_id = $_SESSION["usua_id"];
			date_default_timezone_set("America/Bogota");
			$Fecha_Modifica = date("Y-m-d");
			$Hora_Creada = "0000-00-00 " . date("h:i:s");
			$objGasto = new GastosDirectosModel();

			$sqlGasto = "UPDATE encabezado_gastosdirectos SET Fecha_Gasto='$Fecha_Gasto', Fecha_Documento = '$Fecha_Doc', Total=" . str_replace(",", "", $Total) . ", Desc_Tipo_Iva='$Desc_Tipo_Iva',
			NoDocumentoCruce='$NoDocumentoCruce', TipoDocumentoCruce='$TipoDocumentoCruce', Codigo_Cuenta_Contable='$Codigo_Cuenta_Contable', 
			Unidad_Negocio='$Unidad_Negocio', Detalle = '$Detalle' WHERE Numero_Documento='$numGD' AND NIT_Empresa='$nit_sede' ";
			$objGasto->Actualizar($sqlGasto);
		}

		public function VerDatosAdicionales() {
			$objGasto = new GastosDirectosModel();
			$numGD = $_POST["numGD"];
	
			$sqlDatos = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario, Fecha_Modifica, Usuario_Anula, Fecha_Anula, Razon_Anula, Usuario_Modifica
								FROM encabezado_gastosDirectos, usuarios
									WHERE encabezado_gastosdirectos.Usuario_Crea=usuarios.Cedula
										AND Numero_Documento='$numGD'";
			$datos = $objGasto->Consultar($sqlDatos);
	
			if ($datos != null) {
				if ($datos[0]["Usuario_Modifica"] != "") {
					$sqlModifica = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Modifica"] . "'";
					$modifica = $objGasto->Consultar($sqlModifica);
					$usuModifica = $modifica[0]["Nombre_Usuario"];
					$fechaModifica = $datos[0]["Fecha_Modifica"];
				} else {
					$usuModifica = "";
					$fechaModifica = "";
				}

				if ($datos[0]["Usuario_Anula"] != "") {
					$sqlElimina = "SELECT CONCAT(Nombres, ' ', Apellidos) AS Nombre_Usuario FROM usuarios WHERE usuarios.Cedula='" . $datos[0]["Usuario_Anula"] . "'";
					$elimina = $objGasto->Consultar($sqlElimina);
					$usuElimina = $elimina[0]["Nombre_Usuario"];
					$fechaElimina = substr($datos[0]["Fecha_Anula"], 0, 10);

				} else {
					$usuElimina = "";
					$fechaElimina = "";
				}
				include_once '../../views/GastosDirectos/GuiVerDatosAdicionales.html.php';
			}
		}

		public function AnularGastoDirecto() {
			$numGD = $_POST['numGD'];
			$Razon_Anula = $_POST['Razon_Anula'];
			$nit_sede = $_POST['nit_sede'];
			$Usuario_Anula = $_SESSION['usua_id'];
	
			date_default_timezone_set('America/Bogota');
			$fecha = date('Y-m-d');
			$objGasto = new GastosDirectosModel();
			$sqlGD = "UPDATE encabezado_gastosdirectos SET Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha',
			Razon_Anula='$Razon_Anula',  Estado_Documento='I' WHERE Numero_Documento='$numGD' AND Nit_Empresa='$nit_sede'";
			$UpdateGD = $objGasto->Anular($sqlGD);
		}
	}
?>


