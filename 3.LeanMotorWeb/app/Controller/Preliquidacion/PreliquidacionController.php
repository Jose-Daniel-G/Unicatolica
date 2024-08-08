<?php
include_once '../../app/Model/Preliquidacion/PreliquidacionModel.php';

class PreliquidacionController {

    public function crearPreliquidacion() {

        $objPreliquidacion = new PreliquidacionModel();

        if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"])) {
            $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
            $empresas = $objPreliquidacion->Consultar($sqlempresa);

            $consIngreso = "SELECT ine.Numero_Ingreso FROM ingreso_equipos AS ine, equipos AS e
                                        WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["num_ingreso"]."' 
                                        AND e.Numero_Serie=ine.Numero_Serie 
                                        AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
            $Ingresos = $objPreliquidacion->Consultar($consIngreso);
        }else{
            $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social";
            $empresas = $objPreliquidacion->Consultar($sqlempresa);
        }

        $usua_perfil = $_SESSION['usua_perfil'];

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
		$sedes = $objPreliquidacion->Consultar($sqlsede);
		
		$sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
        $marcas = $objPreliquidacion->Consultar($sqlmarca);
		
		$sqlTipos_Equipos = "SELECT Codigo_Grupo, Descripcion FROM grupos";
		$Tipos_Equipos = $objPreliquidacion->Consultar($sqlTipos_Equipos);

        $sqlClase_Equipos = "SELECT * FROM tipos_equipos WHERE Estado='A' ORDER BY Descripcion";
		$Clase_Equipos=$objPreliquidacion->Consultar($sqlClase_Equipos);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objPreliquidacion->Consultar($sqlserv);

        include_once '../../views/Preliquidacion/GuiPreliquidacion.html.php';
    }
    
    public function borar() {

        redirect(getUrl('Preliquidacion', 'Preliquidacion', 'crearPreliquidacion'));

    }

    public function ListarPlantaCliente() {
        $nit_cliente = $_POST["nit_cliente"];
        $objPreliquidacion = new PreliquidacionModel();
        $consplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente='$nit_cliente' ORDER BY Nombre";
        $plantas = $objPreliquidacion->Consultar($consplanta);

        if ($plantas != null) {
            $select = '<option value="">Seleccione ...</option>';
            foreach ($plantas as $planta) {
                $select .= "<option value=" . $planta[0] . ">" . $planta[1] . "</option>";
            }
        } else {
            $select = '<option value="0"></option>';
        }

        $datos = array(
            "selectPlanta" => $select
        );

        echo json_encode($datos);
	}
	
    public function BuscarContactoPlanta() {
        $planta = $_POST['planta'];
        $objPreliquidacion = new PreliquidacionModel();
        $sqlcontacto = "SELECT Nombre_Contacto FROM contactos WHERE Codigo_Planta='$planta'";
        $contactos = $objPreliquidacion->Consultar($sqlcontacto);
        if ($contactos != null) {
            foreach ($contactos as $contacto) {

            }
        } else {
            $contacto[0] = "";
        }
        echo json_encode($contacto);
    }

    public function BuscarIngresoCliente() {
        $objPreliquidacion = new PreliquidacionModel();
        
        if(!empty($_POST["nit_cliente"])){
            $nit_cliente = $_POST["nit_cliente"];

            $consIngreso = "SELECT ine.Numero_Ingreso
					FROM ingreso_equipos AS ine, equipos AS e
						WHERE e.Nit_Cliente='$nit_cliente'
						AND e.Numero_Serie=ine.Numero_Serie
						AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
            $Ingresos = $objPreliquidacion->Consultar($consIngreso);
       
            if($Ingresos != null){
                $select="<option value=''>Seleccione ...</option>";
                foreach($Ingresos as $ingreso){
                    if (isset($_POST["tipo_doc"])) {
        
                        $tipo_doc = $_POST["tipo_doc"];

                        if ($tipo_doc == "PL") { // PRELIQUIDACIÓN
                            $validar = "SELECT * FROM encabezado_documento_venta WHERE Tipo_Documento = '$tipo_doc' 
                            AND Numero_Ingreso = '$ingreso[Numero_Ingreso]' AND Estado_Documento = 'A' ";
                        }else if ($tipo_doc == "CT"){ // COTIZACIÓN
                            $validar = "SELECT * FROM encabezado_cotizacion_venta WHERE Tipo_Documento = '$tipo_doc' 
                            AND Numero_Ingreso = '$ingreso[Numero_Ingreso]' AND Estado_Documento = 'A' ";
                        }else if ($tipo_doc == "RM"){ // REMISIÓN
                            $validar = "SELECT * FROM encabezado_documento_venta WHERE Tipo_Documento = '$tipo_doc' 
                            AND Numero_Ingreso = '$ingreso[Numero_Ingreso]' AND Estado_Documento = 'A' ";
                        }else if($tipo_doc == "OT"){ // ORDEN DE TRABAJO
                            $validar = "SELECT * FROM orden_trabajo WHERE Numero_Ingreso = '$ingreso[Numero_Ingreso]' 
                            AND Estado = 'A' ";
                        }else if($tipo_doc == "GD"){ // GASTO DIRECTO
                            $validar = "SELECT * FROM encabezado_gastosdirectos WHERE Numero_Ingreso = '$ingreso[Numero_Ingreso]' 
                            AND Estado_Documento = 'A' ";
                        }else if($tipo_doc == "IT"){ // INFORME TÉCNICO
                            $validar = "SELECT * FROM informe_tecnico_reparacion_pruebas WHERE Numero_Ingreso = '$ingreso[Numero_Ingreso]' 
                            AND Estado_Documento = 'A' ";
                        }

                        $valid = $objPreliquidacion->Consultar($validar);
                    }else{
                        $valid = null;
                    }

                    if ($valid == null) {
                        $select.="<option value='".$ingreso[0]."'>".$ingreso[0]."</option>";
                    }
                }
            }
            else{
                $select="<option value=''>Seleccione ...</option>";
            }
        }else{
            $select="<option value=''>Seleccione ...</option>";
        }
        echo json_encode(array("selectIngresosCliente"=>$select));
    }

    public function BuscarDatosIngreso() {
        $ingreso = $_POST['ingreso'];

        if ($ingreso == "") {
            $ingreso = 0;
        }

        $objPreliquidacion = new PreliquidacionModel();
        $sqlingreso = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, equi.Codigo_Tipo_Equipo AS Codigo_Clase_Equipo, 
        tequi.Descripcion AS Clase_Equipo, tequi.Codigo_Grupo AS Codigo_Tipo_Equipo, gru.Descripcion AS Tipo_Equipo, 
        marcas.Codigo_Marca AS Codigo_Marca, marcas.Descripcion AS Marca, ing.Numero_Serie AS Numero_Serie, Velocidad_Parte, 
        Fs, No_fases, Frame, Codigo_Planta, Ubicacion, Orden_Servicio, Enviado_Para
        FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas
        WHERE ing.Numero_Serie=equi.Numero_Serie
            AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
            AND tequi.Codigo_Grupo=gru.Codigo_Grupo
            AND equi.Codigo_Marca=marcas.Codigo_Marca
            AND ing.Numero_Ingreso='$ingreso'";
        $ingresos = $objPreliquidacion->Consultar($sqlingreso);

        if ($ingresos != null) {
            $sqldetalle = "SELECT Potencia, Revoluciones_Por_Minuto, Voltaje, V_Primario, Va FROM detalle_equipo WHERE Numero_Serie = '".$ingresos[0]["Numero_Serie"]."' LIMIT 1";
            $detalles = $objPreliquidacion->Consultar($sqldetalle);

            $sqlservicio = "SELECT * FROM tipos_servicios WHERE ts_descripcion = '".$ingresos[0]["Enviado_Para"]."' ";
            $servicio = $objPreliquidacion->Consultar($sqlservicio);

            $sqldoc = "SELECT * FROM encabezado_documento_venta WHERE Numero_Ingreso = '".$ingresos[0]["Numero_Ingreso"]."' AND Tipo_Documento = 'PL' ";
            $documento = $objPreliquidacion->Consultar($sqldoc);

            if ($detalles == null) {
                $detalles = null;
            }
            if ($servicio == null) {
                $servicio = null;
            }
            if ($documento == null) {
                $documento = null;
            }
            
            foreach ($ingresos as $ingreso) {

                if (empty($ingreso["Codigo_Planta"])) {
                    $ingreso["Codigo_Planta"]=0;
                }
                if ($detalles[0]["Voltaje"] != "") {
                    $Voltaje=$detalles[0]["Voltaje"];
                }else if($detalles[0]["V_Primario"] != ""){
                    $Voltaje=$detalles[0]["V_Primario"];
                }else if($detalles[0]["Va"] != ""){
                    $Voltaje=$detalles[0]["Va"];
                }else if($detalles[0]["Voltaje"] == "" && $detalles[0]["V_Primario"] == "" && $detalles[0]["Va"] == ""){
                    $Voltaje=null;
                }
                if ($detalles[0]["Revoluciones_Por_Minuto"] != "") {
                    $Velocidad=$detalles[0]["Revoluciones_Por_Minuto"];
                }else if($ingreso["Velocidad_Parte"] != ""){
                    $Velocidad=$ingreso["Velocidad_Parte"];
                }else if($detalles[0]["Revoluciones_Por_Minuto"] == "" && $ingreso["Velocidad_Parte"] == ""){
                    $Velocidad=null;
                }

                $datos = array(
                    "Numero_Ingreso" => $ingreso["Numero_Ingreso"],
                    "Detalle_De_Equipo" => $ingreso["Detalle_De_Equipo"],
                    "Codigo_Clase_Equipo" => $ingreso["Codigo_Clase_Equipo"],
                    "Clase_Equipo" => $ingreso["Clase_Equipo"],
                    "Codigo_Tipo_Equipo" => $ingreso["Codigo_Tipo_Equipo"],
                    "Tipo_Equipo" => $ingreso["Tipo_Equipo"],
                    "Codigo_Marca" => $ingreso["Codigo_Marca"],
                    "Marca" => $ingreso["Marca"],
                    "Numero_Serie" => $ingreso["Numero_Serie"],
                    "Potencia" => $detalles[0]["Potencia"],
                    "Velocidad" => $Velocidad,
                    "Voltaje" => $Voltaje,
                    "No_Fases" => $ingreso["No_fases"],
                    "Frame" => $ingreso["Frame"],
                    "Planta" => $ingreso["Codigo_Planta"],
                    "Ubicacion" => $ingreso["Ubicacion"],
                    "Orden_Servicio" => $ingreso["Orden_Servicio"],
                    "Tipo_Servicio" => $servicio[0]["ts_codigo"],
                    "Tiempo_Entrega" => $documento[0]["Tiempo_Entrega"],
                    "Vendedor" => $documento[0]["Cedula_Empleado"],
                    "Garantia" => $documento[0]["Garantia"],
                    "Observaciones" => $documento[0]["Observaciones"],
                );
            }
        }else{
            $datos = array();
        }
        echo json_encode($datos);
    }
    
    public function BuscarPL($numPL = false, $nit_sede = false) {
        if ($numPL == false) {
            $numPL = $_POST['numPL'];
            $nit_sede = $_POST['nit_sede'];
        }
        $objPreliquidacion = new PreliquidacionModel();
        $sqlBuscaPL = "SELECT Numero_Documento FROM encabezado_documento_venta
				WHERE Numero_Documento='$numPL' and Tipo_Documento='PL' and NIT_Empresa='$nit_sede'";
        $DatosPL = $objPreliquidacion->Consultar($sqlBuscaPL);
        if ($DatosPL != null) {
            $num_doc = $DatosPL[0][0];
        } else {
            $num_doc = "";
        }
    }

    public function BuscarProductoServicio() {
        $desc = $_POST['desc_serv'];
        $data_fila = $_POST['data_fila'];

        $objPreliquidacion = new PreliquidacionModel();
        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios
							WHERE Descripcion like '$desc%' and Indicativo='A'";
        $servicios = $objPreliquidacion->Consultar($sqlserv);
        include_once '../../views/Preliquidacion/GuiListarProductoServicios.html.php';
    }

    public function RegistrarPreliquidacion() {
        extract($_POST);
        $usu_id = $_SESSION['usua_id'];
        date_default_timezone_set('America/Bogota');
        $Fecha_Documento = date('Y-m-d');
        $Hora_Documento = "0000-00-00 " . date('h:i:s');
        $objPreliquidacion = new PreliquidacionModel();

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

            $sqlPL = "INSERT INTO encabezado_documento_venta
            (Numero_Documento, Tipo_Documento, Fecha_Documento, Hora_Documento, Cedula_Empleado, Estado_Documento, Nit_Cliente,
            Dirigido_A, Usuario_Crea, Numero_Ingreso, Equipo, Marca, Potencia, Rpm, Voltaje, Fs, Serie, Codigo_Planta, Prioridad, 
            Tiempo_Entrega, Garantia, NIT_Empresa, Observaciones)
            VALUES
            (NULL, '$tipo_doc', '$Fecha_Documento', '$Hora_Documento', '$responsable', 'A', '$nit_empresa',
            '$dirigida', '$usu_id', '$no_ingreso', '$equipo', '$marca', '$potencia', '$rpm', '$voltaje', '$fases', '$serie', '$planta', '$Prioridad', 
            '$tiempoE', '$garantia', '$nit_sede', '$observa')";
            $objPreliquidacion->Insertar($sqlPL);
            $plano = $sqlPL . ";";

            $sqlID = "SELECT @@identity AS id";
            $id=$objPreliquidacion->Consultar($sqlID);
            $numPL = trim($id[0][0]);

            if (isset($producto)) {
                for ($i = 0; $i < count($producto); $i++) {
                    $sqlServ = "INSERT INTO detalle_documento_venta
                    (Numero_Registro, Numero_Documento, Numero_Ingreso, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                    Detalle, Porcentaje_Iva, Valor_Iva, Item)
                    VALUES
                    (NULL, '$numPL', '$no_ingreso', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ",  '$nit_sede',
                    '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                    $objPreliquidacion->Insertar($sqlServ);
                }
            }

            echo json_encode(array("numPL" => $numPL));
        }else{
            echo messageSweetAlert("Falta el Nit del cliente y/o el Número de ingreso", "", "error", "", "si", "boton", getUrl('Preliquidacion', 'Preliquidacion', 'crearPreliquidacion', array("tipo_doc" => $tipo_documento)));
        }
    }

    public function VerDatosAdicionales() {
        $objPreliquidacion = new PreliquidacionModel();
        $numPL = $_POST['numPL'];

        $sqlDatos = "SELECT concat(Nombres, ' ', Apellidos), Fecha_Modifica, Usuario_Anula,Fecha_Anula, Razon_Anula, Usuario_Modifica
							FROM encabezado_documento_venta, usuarios
								WHERE encabezado_documento_venta.Usuario_Crea=usuarios.Cedula
									and Numero_Documento='$numPL' and Tipo_Documento='PL'";
        $datos = $objPreliquidacion->Consultar($sqlDatos);

        if ($datos != null) {
            if ($datos[0][5] != "") {
                $sqlModifica = "SELECT concat(Nombres, ' ', Apellidos) FROM usuarios WHERE usuarios.Cedula='" . $datos[0][5] . "'";
                $modifica = $objPreliquidacion->Consultar($sqlModifica);
                $usuModifica = $modifica[0][0];
                $fechaModifica = $datos[0][1];
            } else {
                $usuModifica = "";
                $fechaModifica = "";
            }

            if ($datos[0][2] != "") {
                $sqlElimina = "SELECT concat(Nombres, ' ', Apellidos) FROM usuarios WHERE usuarios.Cedula='" . $datos[0][2] . "'";
                $elimina = $objPreliquidacion->Consultar($sqlElimina);
                $usuElimina = $elimina[0][0];
                $fechaElimina = substr($datos[0][3], 0, 10);

            } else {
                $usuElimina = "";
                $fechaElimina = "";
            }
            include_once '../../views/Preliquidacion/GuiVerDatosAdicionales.html.php';
        }

    }
    public function AnularPreliquidacion() {
        $numPL = $_POST['numPL'];
        $tipo_doc = $_POST['tipo_doc'];
        $Razon_Anula = $_POST['Razon_Anula'];
        $nit_sede = $_POST['nit_sede'];
        $Usuario_Anula = $_SESSION['usua_id']; //$_POST['usu_id'] Ojo

        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $objPreliquidacion = new PreliquidacionModel();
        $sqlPL = "update encabezado_documento_venta set Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha',
        Razon_Anula='$Razon_Anula',  Estado_Documento='I' WHERE Numero_Documento='$numPL' and Tipo_Documento='$tipo_doc' and Nit_Empresa='$nit_sede'";
        $UpdatePL = $objPreliquidacion->Anular($sqlPL);
    }
    /*************************************/
    public function getVerPreliquidacion() {
        $Numero_Documento = $_GET['numero_doc'];
        $tipo_doc = $_GET['tipo_doc'];
        $nit_sede = $_GET['nit_sede'];

        $objPreliquidacion = new PreliquidacionModel();
        $sqlPL = "SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion,
			Telefono1, ciudades.Nombre AS Ciudad,encabezado_documento_venta.Dias_Plazo, Prioridad, Tiempo_Entrega, Garantia,
                        encabezado_documento_venta.Observaciones, Estado_Documento, Tipo_Documento,
						encabezado_documento_venta.NIT_Empresa, sedes.nombre, Fecha_Documento,
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

        $cabeceraPL = $objPreliquidacion->Consultar($sqlPL);
        if ($cabeceraPL[0][3] != null) {
            $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraPL[0]["Nit_Cliente"] . "'" . "";
            $plantas = $objPreliquidacion->Consultar($sqlplanta);
        } else {
            $plantas = null;
        }

        $sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, 
                        marcas.Descripcion AS Marca, ing.Numero_Serie, equi.No_Fases, ing.Frame, dequi.Potencia, dequi.Revoluciones_Por_Minuto, 
                        ing.Velocidad_Parte, dequi.Voltaje, dequi.V_Primario, dequi.Va, ing.Ubicacion, ing.Orden_Servicio
							FROM ingreso_equipos as ing, equipos as equi, tipos_equipos tequi, grupos as gru,
							marcas, detalle_equipo as dequi  
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $cabeceraPL[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
        $ingresosPL = $objPreliquidacion->Consultar($sqlIngre);

        if ($ingresosPL[0]["Voltaje"] != "") {
            $Voltaje=$ingresosPL[0]["Voltaje"];
        }else if($ingresosPL[0]["V_Primario"] != ""){
            $Voltaje=$ingresosPL[0]["V_Primario"];
        }else if($ingresosPL[0]["Va"] != ""){
            $Voltaje=$ingresosPL[0]["Va"];
        }else if($ingresosPL[0]["Voltaje"] == "" && $ingresosPL[0]["V_Primario"] == "" && $ingresosPL[0]["Va"] == ""){
            $Voltaje=null;
        }
        if ($ingresosPL[0]["Revoluciones_Por_Minuto"] != "") {
            $Velocidad=$ingresosPL[0]["Revoluciones_Por_Minuto"];
        }else if($ingresosPL[0]["Velocidad_Parte"] != ""){
            $Velocidad=$ingresosPL[0]["Velocidad_Parte"];
        }else if($ingresosPL[0]["Revoluciones_Por_Minuto"] == "" && $ingresosPL[0]["Velocidad_Parte"] == ""){
            $Velocidad=null;
        }
        
        $sqlPLD = "SELECT Numero_Registro, Aprobado, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle,
			detalle_documento_venta.Cantidad, detalle_documento_venta.Valor_Unitario, detalle_documento_venta.Valor_Iva, 
            detalle_documento_venta.Porcentaje_Iva, detalle_documento_venta.Porcentaje_Descuento
                FROM
					detalle_documento_venta, productos_servicios WHERE detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
                            AND  Numero_Documento='$Numero_Documento'
							AND Tipo_Documento='$tipo_doc'
							AND NIT_Empresa='$nit_sede'";
        $detallePL = $objPreliquidacion->Consultar($sqlPLD);

        $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa = '$nit_sede' AND Estado = 'A' ORDER BY Nombre_Completo";
        $responsable = $objPreliquidacion->Consultar($sqlven);

        $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
        $empresas = $objPreliquidacion->Consultar($sqlempresa);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
        $sedes = $objPreliquidacion->Consultar($sqlsede);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objPreliquidacion->Consultar($sqlserv);

        $sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
        $tipos_servicios = $objPreliquidacion->Consultar($sqltipo_servicio);

        include_once '../../views/Preliquidacion/GuiVerPreliquidacion.html.php';
    }

    public function getEditarPreliquidacion() {
        $Numero_Documento = $_GET['numero_doc'];
        $tipo_doc = $_GET['tipo_doc'];
        $nit_sede = $_GET['nit_sede'];

        $objPreliquidacion = new PreliquidacionModel();
        $sqlPL = "SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion,
			Telefono1, ciudades.Nombre AS Ciudad, encabezado_documento_venta.Dias_Plazo, Prioridad, Tiempo_Entrega, Garantia,
                        encabezado_documento_venta.Observaciones, Estado_Documento, Tipo_Documento,
						encabezado_documento_venta.NIT_Empresa, sedes.nombre, Fecha_Documento,
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

        $cabeceraPL = $objPreliquidacion->Consultar($sqlPL);
        if ($cabeceraPL[0][3] != null) {
            $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraPL[0]["Nit_Cliente"] . "'" . "";
            $plantas = $objPreliquidacion->Consultar($sqlplanta);
        } else {
            $plantas = null;
        }

        $sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo, 
                        marcas.Descripcion AS Marca, ing.Numero_Serie, equi.No_Fases, ing.Frame, dequi.Potencia, dequi.Revoluciones_Por_Minuto, 
                        ing.Velocidad_Parte, dequi.Voltaje, dequi.V_Primario, dequi.Va, ing.Ubicacion, ing.Orden_Servicio
							FROM ingreso_equipos as ing, equipos as equi, tipos_equipos tequi, grupos as gru,
							marcas, detalle_equipo as dequi  
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $cabeceraPL[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
        $ingresosPL = $objPreliquidacion->Consultar($sqlIngre);

        if ($ingresosPL[0]["Voltaje"] != "") {
            $Voltaje=$ingresosPL[0]["Voltaje"];
        }else if($ingresosPL[0]["V_Primario"] != ""){
            $Voltaje=$ingresosPL[0]["V_Primario"];
        }else if($ingresosPL[0]["Va"] != ""){
            $Voltaje=$ingresosPL[0]["Va"];
        }else if($ingresosPL[0]["Voltaje"] == "" && $ingresosPL[0]["V_Primario"] == "" && $ingresosPL[0]["Va"] == ""){
            $Voltaje=null;
        }
        if ($ingresosPL[0]["Revoluciones_Por_Minuto"] != "") {
            $Velocidad=$ingresosPL[0]["Revoluciones_Por_Minuto"];
        }else if($ingresosPL[0]["Velocidad_Parte"] != ""){
            $Velocidad=$ingresosPL[0]["Velocidad_Parte"];
        }else if($ingresosPL[0]["Revoluciones_Por_Minuto"] == "" && $ingresosPL[0]["Velocidad_Parte"] == ""){
            $Velocidad=null;
        }
        
        $sqlPLD = "SELECT Numero_Registro, Aprobado, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle,
			detalle_documento_venta.Cantidad, detalle_documento_venta.Valor_Unitario, detalle_documento_venta.Valor_Iva, 
            detalle_documento_venta.Porcentaje_Iva, detalle_documento_venta.Porcentaje_Descuento
                FROM
					detalle_documento_venta, productos_servicios WHERE detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
                            AND  Numero_Documento='$Numero_Documento'
							AND Tipo_Documento='$tipo_doc'
							AND NIT_Empresa='$nit_sede'";
        $detallePL = $objPreliquidacion->Consultar($sqlPLD);

        $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa = '$nit_sede' AND Estado = 'A' ORDER BY Nombre_Completo";
        $responsable = $objPreliquidacion->Consultar($sqlven);

        $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
        $empresas = $objPreliquidacion->Consultar($sqlempresa);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
        $sedes = $objPreliquidacion->Consultar($sqlsede);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objPreliquidacion->Consultar($sqlserv);

        $sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
        $tipos_servicios = $objPreliquidacion->Consultar($sqltipo_servicio);

        include_once '../../views/Preliquidacion/GuiEditarPreliquidacion.html.php';
    }

    public function EditarPreliquidacion() {
        extract($_POST);
        $usu_id = $_SESSION["usua_id"];
        date_default_timezone_set('America/Bogota');
        $Fecha_Modifica = date('Y-m-d');
        $Hora_Documento = "0000-00-00 " . date('h:i:s');
        $objPreliquidacion = new PreliquidacionModel();

        if ($planta == null) {
            $planta = "";
        }

        $sqlAPL = "UPDATE encabezado_documento_venta SET Usuario_Modifica='$usu_id', Fecha_Documento='$Fecha_Doc',
         Fecha_Modifica='$Fecha_Modifica', Cedula_Empleado='$responsable', Estado_Documento='A', Nit_Cliente='$nit_empresa', 
         Codigo_Planta='$planta', Dirigido_A='$dirigida', Numero_Ingreso='$no_ingreso', Prioridad='$Prioridad', Tiempo_Entrega='$tiempoE', 
         Garantia='$garantia', Observaciones='$observa' 
         WHERE Numero_Documento='$numPL' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ";
        $objPreliquidacion->Actualizar($sqlAPL);

        if (isset($producto_Editar)) {
            for ($i = 0; $i < count($producto_Editar); $i++) {
                $sqlServ = "UPDATE detalle_documento_venta SET Tipo_Documento='$tipo_doc', Cantidad='$cant_Editar[$i]', Porcentaje_Descuento='$desc_Editar[$i]',
                Valor_Unitario=" . str_replace(",", "", $valor_Editar[$i]) . ", Codigo_Producto='$producto_Editar[$i]', Detalle='$detalle_Editar[$i]', Porcentaje_Iva='$iva_Editar[$i]', Valor_Iva='$valoriva_Editar[$i]', Item=$item_Editar[$i]
                WHERE Numero_Registro='$Numero_Registro_Editar[$i]' AND NIT_Empresa='$nit_sede' ";
                $objPreliquidacion->Actualizar($sqlServ);
            }
        }
        if (isset($producto)) {
            for ($i = 0; $i < count($producto); $i++) {
                $sqlServ2 = "INSERT INTO detalle_documento_venta
                (Numero_Registro, Numero_Documento, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                Detalle, Porcentaje_Iva, Valor_Iva, Item)
                VALUES
                (NULL, '$numPL', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ", '$nit_sede',
                '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                $objPreliquidacion->Insertar($sqlServ2);
            }
        }
    }
}