<?php
	include_once('../../app/Model/Mantenimiento/MantenimientoModel.php');
	
	class MantenimientoController{
		
		public function vistaNumeroSerie(){
			$ObjMantenimiento = new MantenimientoModel();
			include_once("../../views/Mantenimiento/GuiBuscarNumeroSerie.html.php");			
		}

		public function vistaNitCliente(){
			$ObjMantenimiento = new MantenimientoModel();
			include_once("../../views/Mantenimiento/GuiBuscarNitCliente.html.php");			
		}
		
		public function vistaEditarDatosEquipo(){	
			$ObjMantenimiento = new MantenimientoModel();

			$sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
			$sedes = $ObjMantenimiento->Consultar($sqlsede);
			
			include_once("../../views/Mantenimiento/GuiEditarDatosEquipo.html.php");			
		}

		public function obtenerDatosEquipo(){
			$ObjMantenimiento = new MantenimientoModel();
			$datos = array();
			$Numero_Serie=$_POST["Numero_Serie"];

			$sqlIngre = "SELECT ing.Numero_Ingreso, cli.Razon_Social, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, 
						gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie, equi.No_Fases, ing.Frame, 
						CONCAT(dequi.Potencia,' - ', dequi.Unidad_De_Potencia) AS Potencia, dequi.Revoluciones_Por_Minuto, 
                        ing.Velocidad_Parte, dequi.Voltaje, dequi.V_Primario, dequi.Va, ing.Ubicacion, ing.Orden_Servicio
							FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru, 
								marcas, detalle_equipo AS dequi, clientes AS cli
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND equi.Nit_Cliente=cli.Nit_Cliente 
									AND ing.Numero_Serie='$Numero_Serie'
									AND ing.Estado = 'A' LIMIT 1";
			$Ingreso = $ObjMantenimiento->Consultar($sqlIngre);

			$sqlCantidadOIS = "SELECT COUNT(Numero_Serie) AS Cantidad_OIS FROM ingreso_equipos WHERE Numero_Serie = '$Numero_Serie'";
			$cantidadOIS = $ObjMantenimiento->Consultar($sqlCantidadOIS);

			foreach ($Ingreso as $ingreso) {
				if ($ingreso["Voltaje"] != "") {
					$Voltaje=$ingreso["Voltaje"];
				}else if($ingreso["V_Primario"] != ""){
					$Voltaje=$ingreso["V_Primario"];
				}else if($ingreso["Va"] != ""){
					$Voltaje=$ingreso["Va"];
				}else if($ingreso["Voltaje"] == "" && $ingreso["V_Primario"] == "" && $ingreso["Va"] == ""){
					$Voltaje=null;
				}
				if ($ingreso["Revoluciones_Por_Minuto"] != "") {
					$Velocidad=$ingreso["Revoluciones_Por_Minuto"];
				}else if($ingreso["Velocidad_Parte"] != ""){
					$Velocidad=$ingreso["Velocidad_Parte"];
				}else if($ingreso["Revoluciones_Por_Minuto"] == "" && $ingreso["Velocidad_Parte"] == ""){
					$Velocidad=null;
				}

				array_push($datos,
				array(
					"cliente" => $ingreso["Razon_Social"],
					"marca" => $ingreso["Marca"],
					"tipo" => $ingreso["Tipo_Equipo"],
					"potencia" => $ingreso["Potencia"],
					"velocidad" => $Velocidad,
					"voltaje" => $Voltaje,
					"cantidad" => $cantidadOIS[0]["Cantidad_OIS"]
				));
			}

			echo json_encode($datos);
		}

		public function obtenerDatosCliente(){
			$ObjMantenimiento = new MantenimientoModel();
			$datos = array();
			$Nit_Cliente=$_POST["Nit_Cliente"];

			$sqlCliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, ciu.Nombre AS Ciudad, cli.Direccion, cli.Telefono1 
			FROM clientes AS cli, ciudades AS ciu WHERE Nit_Cliente = '$Nit_Cliente' 
			AND cli.Codigo_Ciudad = ciu.Codigo_Ciudad";
			$Cliente = $ObjMantenimiento->Consultar($sqlCliente);

			foreach ($Cliente as $cliente) {
				array_push($datos,
				array(
					"cliente" => $cliente["Razon_Social"],
					"nit" => $cliente["Nit_Cliente"],
					"ciudad" => $cliente["Ciudad"],
					"direccion" => $cliente["Direccion"],
					"telefono" => $cliente["Telefono1"]
				));
			}

			echo json_encode($datos);
		}

		public function buscarNuevoNumeroSerie(){
			$ObjMantenimiento = new MantenimientoModel();
			$Numero_Serie=$_POST["Numero_Serie"];

			$sqlSerie = "SELECT * FROM equipos WHERE Numero_Serie = '$Numero_Serie' ";
			$Serie = $ObjMantenimiento->Consultar($sqlSerie);

			if ($Serie != null) {
				$respuesta = array("numSerie" => true);
			}else{
				$respuesta = array("numSerie" => false);
			}

			echo json_encode($respuesta);
		}

		public function buscarNuevoNitCliente(){
			$ObjMantenimiento = new MantenimientoModel();
			$Nit_Cliente=$_POST["Nit_Cliente"];

			$sqlCliente = "SELECT * FROM clientes WHERE Nit_Cliente = '$Nit_Cliente' ";
			$Cliente = $ObjMantenimiento->Consultar($sqlCliente);

			if ($Cliente != null) {
				$respuesta = array("nitCliente" => true);
			}else{
				$respuesta = array("nitCliente" => false);
			}

			echo json_encode($respuesta);
		}

		public function cambiarNumeroSerie(){
			$ObjMantenimiento = new MantenimientoModel();
			$Numero_Serie=$_POST["Numero_Serie"];
			$Nuevo_Numero_Serie=$_POST["Nuevo_Numero_Serie"];

			$sql = array();
			$sql[] = "UPDATE equipos SET Numero_Serie = '$Nuevo_Numero_Serie' WHERE Numero_Serie = '$Numero_Serie' ";
			$sql[] = "UPDATE ingreso_equipos SET Numero_Serie = '$Nuevo_Numero_Serie' WHERE Numero_Serie = '$Numero_Serie' ";
			$sql[] = "UPDATE detalle_equipo SET Numero_Serie = '$Nuevo_Numero_Serie' WHERE Numero_Serie = '$Numero_Serie' ";

			$affected_rows = 0;

			foreach($sql as $updates){
				$ObjMantenimiento->Actualizar($updates);
				$affected_rows = $affected_rows + mysqli_affected_rows($ObjMantenimiento->conexion);
			}

			if ($affected_rows > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

		public function cambiarNitCliente(){
			$ObjMantenimiento = new MantenimientoModel();
			$Nit_Cliente=$_POST["Nit_Cliente"];
			$Nuevo_Nit_Cliente=$_POST["Nuevo_Nit_Cliente"];

			$sql = array();
			$sql[] = "UPDATE clientes SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE plantas SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE equipos SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE encabezado_documento_venta SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE encabezado_cotizacion_venta SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE encabezado_factura_venta SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE encabezado_gastosdirectos SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE encabezado_documento_venta_dollares SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";
			$sql[] = "UPDATE encabezado_e_s_bodega SET Nit_Cliente = '$Nuevo_Nit_Cliente' WHERE Nit_Cliente = '$Nit_Cliente' ";

			$affected_rows = 0;

			foreach($sql as $updates){
				$ObjMantenimiento->Actualizar($updates);
				$affected_rows = $affected_rows + mysqli_affected_rows($ObjMantenimiento->conexion);
			}

			if ($affected_rows > 0) {
				$respuesta["tipoRespuesta"]=true;
			}

			echo json_encode($respuesta);
		}

		public function buscarDatosEquipo(){
			$ObjMantenimiento= new MantenimientoModel();
			$Numero_Serie=$_POST["Numero_Serie"];
			$Nit_Sede=$_POST["Nit_Sede"];

			$sqlDetalle="SELECT Potencia, Revoluciones_Por_Minuto AS Velocidad, Voltaje, Amperaje, Unidad_De_Potencia AS Unidad, 
									Va, Vc, Ia, Ic, V_Primario, V_Secundario1, V_Secundario2, I_Primario, I_Secundario 
									FROM detalle_equipo 
									WHERE Numero_serie='$Numero_Serie' 
									AND Nit_Empresa='$Nit_Sede'";
			$Detalle=$ObjMantenimiento->Consultar2($sqlDetalle);

			$llaves=array();
			$datos=array();
			$prueba=array();

			foreach ($Detalle as $deta) {
				foreach ($deta as $keys => $values) {
					if ($values != "") {
						array_push($llaves, $keys);
						array_push($prueba, array(
							"data" => $keys
						));
					}
				}
				$llaves=array_unique($llaves);
				array_push($datos, array_filter($deta));
			}

			// $tabla = array("columns" => $llaves,"data" => $datos);
			echo json_encode($prueba);
		}
	}
?>
