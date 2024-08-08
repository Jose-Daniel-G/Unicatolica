<?php

@include_once '../../app/Model/Cotizaciones/CotizacionesModel.php';
@session_start();

class CotizacionesController {

    public function ConsecutivoDocumento() {
        $objCotizacion = new CotizacionesModel();
        $sql = "SELECT ultimo_creado FROM consecutivo_documentos WHERE td_sigla='CT'";
        $num_doc = $objCotizacion->Consultar($sql);
        $cons_doc = $num_doc[0][0] + 1;

        return $cons_doc;
    }

    public function Incrementar_Consecutivo() {
        $objCotizacion = new CotizacionesModel();
        $actCons = "UPDATE consecutivo_documentos SET ultimo_creado=ultimo_creado+1 WHERE td_sigla='CT'";
        $objCotizacion->Actualizar($actCons);
    }

    public function crearCotizacion() {
        $objCotizacion = new CotizacionesModel();

        $usua_perfil = $_SESSION['usua_perfil'];

        if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"])) {
            $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
            $empresas = $objCotizacion->Consultar($sqlempresa);

            $consIngreso = "SELECT ine.Numero_Ingreso FROM ingreso_equipos AS ine, equipos AS e
                                        WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["num_ingreso"]."' 
                                        AND e.Numero_Serie=ine.Numero_Serie 
                                        AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
            $Ingresos = $objCotizacion->Consultar($consIngreso);

            $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa = '".$_GET["nit_sede"]."' AND Estado = 'A' ORDER BY Nombre_Completo";
            $vendedor = $objCotizacion->Consultar($sqlven);
        }else{
            $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social ";
            $empresas = $objCotizacion->Consultar($sqlempresa);
        }

        $sqlTipos_Equipos = "SELECT Codigo_Grupo, Descripcion FROM grupos";
        $Tipos_Equipos = $objCotizacion->Consultar($sqlTipos_Equipos);

        $sqlClase_Equipos = "SELECT * FROM tipos_equipos WHERE Estado='A' ORDER BY Descripcion";
        $Clase_Equipos = $objCotizacion->Consultar($sqlClase_Equipos);

        $sqlfpago = "SELECT Codigo_Forma_Pago, Descripcion FROM forma_pago ORDER BY Descripcion";
        $fpagos = $objCotizacion->Consultar($sqlfpago);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
        $sedes = $objCotizacion->Consultar($sqlsede);

        $sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas where Estado='A' ORDER BY Descripcion";
        $marcas = $objCotizacion->Consultar($sqlmarca);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios where Indicativo='A' ORDER BY Descripcion";
        $servicios = $objCotizacion->Consultar($sqlserv);

        $sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios where ts_estado='A' ORDER BY ts_descripcion";
        $tipos_servicios = $objCotizacion->Consultar($sqltipo_servicio);

        include_once '../../views/Cotizaciones/GuiCotizacion.html.php';
    }

    public function BuscarContactoPlanta() {
        $planta = $_POST['planta'];
        $objCotizacion = new CotizacionesModel();
        $sqlcontacto = "SELECT Nombre_Contacto FROM contactos WHERE Codigo_Planta='$planta'";
        $contactos = $objCotizacion->Consultar($sqlcontacto);
        if ($contactos != null) {
            foreach ($contactos as $contacto) {

            }
        } else {
            $contacto[0] = "";
        }
        echo json_encode($contacto);
    }

    public function BuscarCT($numCT = false, $nit_sede = false) {
        if ($numCT == false) {
            $numCT = $_POST['numCT'];
            $nit_sede = $_POST['nit_sede'];
        }
        $objCotizacion = new CotizacionesModel();
        $sqlBuscaCT = "SELECT Numero_Documento FROM encabezado_cotizacion_venta
			where Numero_Documento='$numCT' and Tipo_Documento='CT' and NIT_Empresa='$nit_sede'";
        $DatosCT = $objCotizacion->Consultar($sqlBuscaCT);
        if ($DatosCT != null) {
            $num_doc = $DatosCT[0][0];
        } else {
            $num_doc = "";
        }
        echo json_encode($num_doc);
    }

    public function ListarPlantaCliente() {
        $nit_cliente = $_POST["nit_cliente"];
        $objCotizacion = new CotizacionesModel();
        $consplanta = "SELECT Codigo_Planta, Nombre FROM plantas where Nit_Cliente='$nit_cliente' ORDER BY Nombre";
        $plantas = $objCotizacion->Consultar($consplanta);

        $select = '<option value="">Seleccione ...</option>';
        if ($plantas != null) {
            foreach ($plantas as $planta) {
                $select .= "<option value=" . $planta[0] . ">" . $planta[1] . "</option>";
            }
        } else {
            $select = '<option value="0"></option>';
        }

        $datos = array(
            "selectPlanta" => $select,
        );

        echo json_encode($datos);
    }

    public function obtenerIvaProductoServicio() {
        $codigo = $_POST["Codigo"];
        $objCotizacion = new CotizacionesModel();
        $sqlprod = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Codigo = '$codigo' ";
        $iva = $objCotizacion->consultar($sqlprod);

        $respuesta = array("Porcentaje_Iva" => $iva[0][2]);
        echo json_encode($respuesta);
    }

    public function RegistrarCotizacion() {
        extract($_POST);
        $usu_id = $_SESSION['usua_id'];
        date_default_timezone_set('America/Bogota');
        $Fecha_Documento = date('Y-m-d');
        $Hora_Documento = "0000-00-00 " . date('h:i:s');
        $objCotizacion = new CotizacionesModel();

        if (!empty($num_ingreso)) {
            $no_ingreso=$num_ingreso;
        }
        if (!empty($nit_emp)) {
            $nit_empresa=$nit_emp;
        }
        if (!empty($orden_compra)) {
            $Orden_Compra=$orden_compra;
        }
        if (empty($planta)) {
            $planta = "";
        }

        $numCT = $this->ConsecutivoDocumento();

        if ($tipo_doc == "CT") {
            if (!empty($nit_empresa) && !empty($no_ingreso)) {
                $EsGer = "N";

                $sqlCT = "INSERT INTO encabezado_cotizacion_venta
                (Numero_Documento, Tipo_Documento, Fecha_Documento, Hora_Documento, Cedula_Empleado, Estado_Documento,
                Nit_Cliente, Dirigido_A, Numero_Ingreso, Usuario_Crea, Equipo, Marca, Potencia, Rpm, Voltaje, Serie, Codigo_Planta, EsGer,
                Tipo_Servicio, Forma_Pago, Dias_Plazo, Prioridad, Orden_Compra, Garantia, FechaAprobacion, Subtotal, Descuento, Iva, Total, NIT_Empresa, Observaciones)
                VALUES
                ('$numCT', '$tipo_doc', '$Fecha_Documento', '$Hora_Documento', '$vendedor', 'A',
                '$nit_empresa', '$dirigida', '$no_ingreso', '$usu_id', '$equipo', '$marca', '$potencia', '$rpm', '$voltaje', '$serie', '$planta', '$EsGer',
                '$tservicio', '$fpago', '$plazo', '$tiempoE', '$Orden_Compra', '$garantia', '$fecha_aprobGER', " . str_replace(",", "", $subtotal_doc) . ", " . str_replace(",", "", $tdescuento) . ", 
                " . str_replace(",", "", $tiva) . ", " . str_replace(",", "", $tdoc) . ", '$nit_sede', '$observa')";
                $objCotizacion->Insertar($sqlCT);

                if (isset($producto)) {
                    for ($i = 0; $i < count($producto); $i++) {
                        $sqlServ = "INSERT INTO detalle_cotizacion_venta
                        (Numero_Registro, Numero_Documento, Numero_Ingreso, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                        VALUES
                        (NULL, '$numCT', '$no_ingreso', '$numCT', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ",  '$nit_sede',
                        '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                        $objCotizacion->Insertar($sqlServ);
                    }
                }

                if (isset($producto_Editar)) {
                    for ($i = 0; $i < count($producto_Editar); $i++) {
                       $sqlServ = "INSERT INTO detalle_cotizacion_venta
                        (Numero_Registro, Numero_Documento, Numero_Ingreso, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                        VALUES
                        (NULL, '$numCT', '$no_ingreso', '$numCT', '$tipo_doc', " . $cant_Editar[$i] . "," . $desc_Editar[$i] . ", " . str_replace(",", "", $valor_Editar[$i]) . ", 
                        " . $producto_Editar[$i] . ", '$nit_sede', '$detalle_Editar[$i]', $iva_Editar[$i], $valoriva_Editar[$i], $item_Editar[$i])";
                        $objCotizacion->Insertar($sqlServ);
                    }
                }
            }else{
                echo messageSweetAlert("Falta el Nit del cliente y/o el Número de ingreso", "", "error", "", "si", "boton", getUrl('Cotizaciones', 'Cotizaciones', 'crearCotizacion', array("tipo_doc" => $tipo_doc)));
            }
        } else if ($tipo_doc == "CTGER") {
            if(!empty($nit_empresa)) {
                $EsGer = "S";

                $sqlCT = "INSERT INTO encabezado_cotizacion_venta
                (Numero_Documento, Tipo_Documento, Fecha_Documento, Hora_Documento, Cedula_Empleado, Estado_Documento, Nit_Cliente, Dirigido_A,
                Usuario_Crea, Equipo, Marca, Insul_Cls, Potencia, Rpm, Voltaje, Fs, Eficiencia, Serie, Ip, Frame, Codigo_Planta, EsGer, Tipo_Servicio, Forma_Pago,
                Dias_Plazo, Prioridad, Orden_Compra, Garantia, FechaAprobacion, Subtotal, Descuento, Iva, Total, NIT_Empresa, Observaciones)
                VALUES
                ('$numCT', '$tipo_doc', '$Fecha_Documento', '$Hora_Documento', '$vendedor', 'A', '$nit_empresa', '$dirigida',
                '$usu_id', '$equipo', '$marca', '$insul', '$potencia', '$rpm', '$voltaje', '$fs', '$eficiencia', '$serie', '$ip', '$frame','$planta', '$EsGer','$tservicio', '$fpago',
                '$plazo', '$tiempoE', '$Orden_Compra', '$garantia', '$fecha_aprobGER', " . str_replace(",", "", $subtotal_doc) . ", " . str_replace(",", "", $tdescuento) . ", 
                " . str_replace(",", "", $tiva) . ", " . str_replace(",", "", $tdoc) . ", '$nit_sede', '$observa')";
                $objCotizacion->Insertar($sqlCT);

                if (isset($producto)) {
                    for ($i = 0; $i < count($producto); $i++) {
                        $sqlServ = "INSERT INTO detalle_cotizacion_venta
                        (Numero_Registro, Numero_Documento, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                        VALUES
                        (NULL, '$numCT', '$numCT', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ",  '$nit_sede',
                        '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                        $objCotizacion->Insertar($sqlServ);
                    }
                }

                if (isset($producto_Editar)) {
                    for ($i = 0; $i < count($producto_Editar); $i++) {
                        $sqlServ = "INSERT INTO detalle_cotizacion_venta
                        (Numero_Registro, Numero_Documento, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                        VALUES
                        (NULL, '$numCT', '$numCT', '$tipo_doc', " . $cant_Editar[$i] . "," . $desc_Editar[$i] . ", " . str_replace(",", "", $valor_Editar[$i]) . ", 
                        " . $producto_Editar[$i] . ", '$nit_sede', '$detalle_Editar[$i]', $iva_Editar[$i], $valoriva_Editar[$i], $item_Editar[$i])";
                        $objCotizacion->Insertar($sqlServ);
                    }
                }
            }else{
                echo messageSweetAlert("Falta el Nit del cliente", "", "error", "", "si", "boton", getUrl('Cotizaciones', 'Cotizaciones', 'crearCotizacion', array("tipo_doc" => $tipo_doc)));
            }
        }
        $this->Incrementar_Consecutivo();
        echo json_encode(array("numCT" => $numCT));
    }

    public function VerDatosAdicionales() {
        $objCotizacion = new CotizacionesModel();
        $numCT = $_POST['numCT'];
        $tipo_doc = $_POST["tipo_doc"];
        $nit_sede = $_POST["nit_sede"];

        $sqlDatos = "SELECT concat(Nombres, ' ', Apellidos), Fecha_Modifica, Usuario_Anula,Fecha_Anula, Razon_Anula, Usuario_Modifica
                        FROM encabezado_cotizacion_venta, usuarios
                            where encabezado_cotizacion_venta.Usuario_Crea=usuarios.Cedula
                                and Numero_Documento='$numCT' and Tipo_Documento='$tipo_doc'";
        $datos = $objCotizacion->Consultar($sqlDatos);

        $sqlFV = "SELECT dfv.Numero_Documento, dfv.Numero_Ingreso, edv.Fecha_Documento, dfv.Tipo_Documento, 
                            dfv.NIT_Empresa, edv.Estado_Documento 
                            FROM detalle_factura_venta AS dfv, encabezado_factura_venta AS edv 
                            WHERE dfv.Numero_Documento = edv.Numero_Documento 
                            AND dfv.NIT_Empresa = edv.NIT_Empresa 
                            AND dfv.Numero_Cotizacion = '$numCT' AND dfv.Tipo_Documento = 'FVC' 
                            AND dfv.NIT_Empresa = '$nit_sede' AND edv.Estado_Documento = 'A'";
        $facturaVenta = $objCotizacion->Consultar($sqlFV);

        if ($datos != null) {
            if ($datos[0][5] != "") {
                $sqlModifica = "SELECT concat(Nombres, ' ', Apellidos) FROM usuarios where usuarios.Cedula='" . $datos[0][5] . "'";
                $modifica = $objCotizacion->Consultar($sqlModifica);
                $usuModifica = $modifica[0][0];
                $fechaModifica = $datos[0][1];
            } else {
                $usuModifica = "";
                $fechaModifica = "";
            }

            if ($datos[0][2] != "") {
                $sqlElimina = "SELECT concat(Nombres, ' ', Apellidos) FROM usuarios where usuarios.Cedula='" . $datos[0][2] . "'";
                $elimina = $objCotizacion->Consultar($sqlElimina);
                $usuElimina = $elimina[0][0];
                $fechaElimina = substr($datos[0][3], 0, 10);

            } else {
                $usuElimina = "";
                $fechaElimina = "";
            }
            include_once '../../views/Cotizaciones/GuiVerDatosAdicionales.html.php';
        }

    }

    public function AnularCotizacion() {
        $numCT = $_POST['numCT'];
        $tipo_doc = $_POST['tipo_doc'];
        $Razon_Anula = $_POST['Razon_Anula'];
        $nit_sede = $_POST['nit_sede'];
        $Usuario_Anula = $_SESSION['usua_id'];

        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $objCotizacion = new CotizacionesModel();
        $sqlGER = "update encabezado_cotizacion_venta set Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha', Razon_Anula='$Razon_Anula',  Estado_Documento='I'
                    where Numero_Documento='$numCT' and Tipo_Documento='$tipo_doc' and Nit_Empresa='$nit_sede'";
        $UpdateCT = $objCotizacion->Anular($sqlGER);
    }

    public function getVerCotizacion() {
        $Numero_Documento = $_GET['numero_doc'];
        $tipo_doc = $_GET['tipo_doc'];
        $nit_sede = $_GET['nit_sede'];

        $objCotizacion = new CotizacionesModel();
        $sqlCT = "SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion, Telefono1, ciudades.Nombre AS Ciudad, Numero_Ingreso, Equipo, Marca, Insul_Cls, Potencia, Rpm, Voltaje,
                    Fs, Eficiencia, Serie, Ip, Frame, Tipo_Servicio, encabezado_cotizacion_venta.Forma_Pago, encabezado_cotizacion_venta.Dias_Plazo, Prioridad, Garantia, FechaAprobacion,
                        encabezado_cotizacion_venta.Observaciones, Estado_Documento, Tipo_Documento, encabezado_cotizacion_venta.NIT_Empresa, sedes.nombre, Fecha_Documento,
                            encabezado_cotizacion_venta.Cedula_Empleado, Subtotal, Descuento, Iva, Total, tipos_equipos.Descripcion, encabezado_cotizacion_venta.Orden_Compra 
                                FROM encabezado_cotizacion_venta, clientes, ciudades, sedes, tipos_equipos
                                    WHERE encabezado_cotizacion_venta.Nit_Cliente=clientes.Nit_Cliente AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad
                                    AND encabezado_cotizacion_venta.equipo=tipos_equipos.Codigo_Tipo_Equipo AND Numero_Documento='$Numero_Documento'
                                        AND Tipo_Documento='$tipo_doc' AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' AND encabezado_cotizacion_venta.NIT_Empresa=sedes.nit_empresa";
        $cabeceraCT = $objCotizacion->Consultar($sqlCT);

        if ($cabeceraCT[0][3] != null) {
            $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraCT[0]["Nit_Cliente"] . "'" . "";
            $plantas = $objCotizacion->Consultar($sqlplanta);
        } else {
            $plantas = null;
        }

        $sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, tequi.Codigo_Grupo AS Codigo_Equipo, 
                            gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, marcas.Codigo_Marca, ing.Numero_Serie, equi.No_Fases, ing.Frame, 
                            dequi.Potencia, dequi.Revoluciones_Por_Minuto, Velocidad_Parte, dequi.Voltaje, dequi.V_Primario, dequi.Va, ing.Ubicacion, ing.Orden_Servicio 
                            FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $cabeceraCT[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
        $ingresosCT = $objCotizacion->Consultar($sqlIngre);

        if ($ingresosCT) {
            if ($ingresosCT[0]["Voltaje"] != "") {
                $Voltaje=$ingresosCT[0]["Voltaje"];
            }else if($ingresosCT[0]["V_Primario"] != ""){
                $Voltaje=$ingresosCT[0]["V_Primario"];
            }else if($ingresosCT[0]["Va"] != ""){
                $Voltaje=$ingresosCT[0]["Va"];
            }else if($ingresosCT[0]["Voltaje"] == "" && $ingresosCT[0]["V_Primario"] == "" && $ingresosCT[0]["Va"] == ""){
                $Voltaje=null;
            }
            if ($ingresosCT[0]["Revoluciones_Por_Minuto"] != "") {
                $Velocidad=$ingresosCT[0]["Revoluciones_Por_Minuto"];
            }else if($ingresosCT[0]["Velocidad_Parte"] != ""){
                $Velocidad=$ingresosCT[0]["Velocidad_Parte"];
            }else if($ingresosCT[0]["Revoluciones_Por_Minuto"] == "" && $ingresosCT[0]["Velocidad_Parte"] == ""){
                $Velocidad=null;
            }
        }

        $sqlCTD = "SELECT Numero_Registro, Aprobado, Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, detalle_cotizacion_venta.Cantidad, detalle_cotizacion_venta.Valor_Unitario,
                        detalle_cotizacion_venta.Porcentaje_Descuento, Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva
                        FROM detalle_cotizacion_venta, productos_servicios WHERE detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
                            AND  Numero_Documento='$Numero_Documento' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ORDER BY Numero_Registro ASC";
        $detalleCT = $objCotizacion->Consultar($sqlCTD);

        $sqlfp = "SELECT Codigo_Forma_Pago, Descripcion FROM forma_pago ORDER BY Descripcion";
        $fp = $objCotizacion->Consultar($sqlfp);

        $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ',Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa='$nit_sede' AND Estado = 'A' ORDER BY Nombre_Completo";
        $vendedor = $objCotizacion->Consultar($sqlven);

        $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
        $empresas = $objCotizacion->Consultar($sqlempresa);

        $sqlTipos_Equipos = "SELECT Codigo_Tipo_Equipo, Descripcion FROM tipos_equipos where Estado='A' ORDER BY Descripcion";
        $Tipos_Equipos = $objCotizacion->Consultar($sqlTipos_Equipos);

        $sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
        $marcas = $objCotizacion->Consultar($sqlmarca);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
        $sedes = $objCotizacion->Consultar($sqlsede);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objCotizacion->Consultar($sqlserv);

        $sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
        $tipos_servicios = $objCotizacion->Consultar($sqltipo_servicio);

        include_once '../../views/Cotizaciones/GuiVerCotizacion.html.php';
    }

    public function getEditarCotizacion() {
        $Numero_Documento = $_GET['numero_doc'];
        $tipo_doc = $_GET['tipo_doc'];
        $nit_sede = $_GET['nit_sede'];

        $objCotizacion = new CotizacionesModel();
        $sqlCT = "SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion, Telefono1, ciudades.Nombre AS Ciudad, Numero_Ingreso, Equipo, Marca, Insul_Cls, Potencia, Rpm, Voltaje,
                    Fs, Eficiencia, Serie, Ip, Frame, Tipo_Servicio, encabezado_cotizacion_venta.Forma_Pago, encabezado_cotizacion_venta.Dias_Plazo, Prioridad, Garantia, FechaAprobacion,
                        encabezado_cotizacion_venta.Observaciones, Estado_Documento, Tipo_Documento, encabezado_cotizacion_venta.NIT_Empresa, sedes.nombre, Fecha_Documento,
                            encabezado_cotizacion_venta.Cedula_Empleado, Subtotal, Descuento, Iva, Total, tipos_equipos.Descripcion, encabezado_cotizacion_venta.Orden_Compra 
                                FROM encabezado_cotizacion_venta, clientes, ciudades, sedes, tipos_equipos
                                    WHERE encabezado_cotizacion_venta.Nit_Cliente=clientes.Nit_Cliente AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad
                                    AND encabezado_cotizacion_venta.equipo=tipos_equipos.Codigo_Tipo_Equipo AND Numero_Documento='$Numero_Documento'
                                        AND Tipo_Documento='$tipo_doc' AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' AND encabezado_cotizacion_venta.NIT_Empresa=sedes.nit_empresa";
        $cabeceraCT = $objCotizacion->Consultar($sqlCT);

        if ($cabeceraCT[0][3] != null) {
            $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraCT[0]["Nit_Cliente"] . "'" . "";
            $plantas = $objCotizacion->Consultar($sqlplanta);
        } else {
            $plantas = null;
        }

        $sqlIngre = "SELECT ing.Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion AS Equipo, tequi.Codigo_Grupo AS Codigo_Equipo, 
                            gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, marcas.Codigo_Marca, ing.Numero_Serie, equi.No_Fases, ing.Frame, 
                            dequi.Potencia, dequi.Revoluciones_Por_Minuto, Velocidad_Parte, dequi.Voltaje, dequi.V_Primario, dequi.Va, ing.Ubicacion, ing.Orden_Servicio 
                            FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $cabeceraCT[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
        $ingresosCT = $objCotizacion->Consultar($sqlIngre);

        if ($ingresosCT) {
            if ($ingresosCT[0]["Voltaje"] != "") {
                $Voltaje=$ingresosCT[0]["Voltaje"];
            }else if($ingresosCT[0]["V_Primario"] != ""){
                $Voltaje=$ingresosCT[0]["V_Primario"];
            }else if($ingresosCT[0]["Va"] != ""){
                $Voltaje=$ingresosCT[0]["Va"];
            }else if($ingresosCT[0]["Voltaje"] == "" && $ingresosCT[0]["V_Primario"] == "" && $ingresosCT[0]["Va"] == ""){
                $Voltaje=null;
            }
            if ($ingresosCT[0]["Revoluciones_Por_Minuto"] != "") {
                $Velocidad=$ingresosCT[0]["Revoluciones_Por_Minuto"];
            }else if($ingresosCT[0]["Velocidad_Parte"] != ""){
                $Velocidad=$ingresosCT[0]["Velocidad_Parte"];
            }else if($ingresosCT[0]["Revoluciones_Por_Minuto"] == "" && $ingresosCT[0]["Velocidad_Parte"] == ""){
                $Velocidad=null;
            }
        }

        $sqlCTD = "SELECT Numero_Registro, Aprobado, Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, detalle_cotizacion_venta.Cantidad, detalle_cotizacion_venta.Valor_Unitario,
                        detalle_cotizacion_venta.Porcentaje_Descuento, Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva
                        FROM detalle_cotizacion_venta, productos_servicios WHERE detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
                            AND  Numero_Documento='$Numero_Documento' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ORDER BY Numero_Registro ASC";
        $detalleCT = $objCotizacion->Consultar($sqlCTD);

        $sqlfp = "SELECT Codigo_Forma_Pago, Descripcion FROM forma_pago ORDER BY Descripcion";
        $fp = $objCotizacion->Consultar($sqlfp);

        $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ',Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa='$nit_sede' AND Estado = 'A' ORDER BY Nombre_Completo";
        $vendedor = $objCotizacion->Consultar($sqlven);

        $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
        $empresas = $objCotizacion->Consultar($sqlempresa);

        $sqlTipos_Equipos = "SELECT Codigo_Tipo_Equipo, Descripcion FROM tipos_equipos where Estado='A' ORDER BY Descripcion";
        $Tipos_Equipos = $objCotizacion->Consultar($sqlTipos_Equipos);

        $sqlmarca = "SELECT Codigo_Marca, Descripcion FROM marcas WHERE Estado='A' ORDER BY Descripcion";
        $marcas = $objCotizacion->Consultar($sqlmarca);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
        $sedes = $objCotizacion->Consultar($sqlsede);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objCotizacion->Consultar($sqlserv);

        $sqltipo_servicio = "SELECT ts_codigo, ts_descripcion FROM tipos_servicios WHERE ts_estado='A' ORDER BY ts_descripcion";
        $tipos_servicios = $objCotizacion->Consultar($sqltipo_servicio);

        include_once '../../views/Cotizaciones/GuiEditarCotizacion.html.php';
    }

    public function getCicloDeVida() {
        $numero_documento = $_GET["numero_doc"];
        $tipo_doc = $_GET["tipo_doc"];
        $nit_sede = $_GET["nit_sede"];

        $objCotizacion = new CotizacionesModel();
        $sqlCT = "SELECT Numero_Documento, clientes.Nit_Cliente, Razon_Social, Codigo_Planta, Dirigido_A, clientes.Direccion, Telefono1, ciudades.Nombre, Numero_Ingreso, Equipo, Marca, Insul_Cls, Potencia, Rpm, Voltaje,
                    Fs, Eficiencia, Serie, Ip, Frame, Tipo_Servicio, encabezado_cotizacion_venta.Forma_Pago, encabezado_cotizacion_venta.Dias_Plazo, Prioridad, Garantia, FechaAprobacion,
                        encabezado_cotizacion_venta.Observaciones, Estado_Documento, Tipo_Documento, encabezado_cotizacion_venta.NIT_Empresa, sedes.nombre, Fecha_Documento,
                            encabezado_cotizacion_venta.Cedula_Empleado, Subtotal, Descuento, Iva, Total, tipos_equipos.Descripcion
                                FROM encabezado_cotizacion_venta, clientes, ciudades, sedes, tipos_equipos
                                    WHERE encabezado_cotizacion_venta.Nit_Cliente=clientes.Nit_Cliente AND clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad
                                    AND encabezado_cotizacion_venta.equipo=tipos_equipos.Codigo_Tipo_Equipo AND Numero_Documento='$numero_documento'
                                        AND Tipo_Documento='$tipo_doc' AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede' AND encabezado_cotizacion_venta.NIT_Empresa=sedes.nit_empresa";
        $cabeceraCT = $objCotizacion->Consultar($sqlCT);

        $sqlIngre = "SELECT Numero_Ingreso, tequi.Descripcion, tequi.Codigo_Tipo_Equipo, gru.Descripcion, gru.Codigo_Grupo,
                            marcas.Descripcion, marcas.Codigo_Marca, ing.Numero_Serie, No_fases, potencia, revoluciones_por_minuto, voltaje, Ubicacion,
                            Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $cabeceraCT[0][8] . "'" . "";
        $ingresosCT = $objCotizacion->Consultar($sqlIngre);

        $sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Nit_Cliente = '".$cabeceraCT[0][1]."' AND Estado='A' ORDER BY Razon_Social";
        $Cliente = $objCotizacion->Consultar($sqlCliente);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
        $sedes = $objCotizacion->Consultar($sqlsede);

        include_once '../../views/Cotizaciones/GuiCicloDeVida.html.php';
    }

    function tablaEstadosCicloVida(){
		$Numero_Documento = $_POST["Numero_Documento"];
		$tipo_doc = $_POST["tipo_doc"];
		$nit_sede = $_POST["nit_sede"];
		$objCotizacion = new CotizacionesModel();

		if (!empty($Numero_Documento)) {

			$sqlEstado1 = "SELECT FechaAprobacion, Numero_Documento, Numero_Ingreso, Fecha_Documento
			FROM encabezado_cotizacion_venta 
			WHERE Numero_Documento = '$Numero_Documento'";
            $Estado1 = $objCotizacion->Consultar($sqlEstado1);

            if (!empty($Estado1[0][2])) {
                $sqlEstado2 = "SELECT Numero_Documento, Fecha_Documento, Tipo_Documento, NIT_Empresa
                FROM encabezado_documento_venta 
                WHERE Numero_Ingreso = '".$Estado1[0][2]."' AND Tipo_Documento = 'RM'
                AND Estado_Documento = 'A'";
                $Estado2 = $objCotizacion->Consultar($sqlEstado2);

                $sqlEstado4 = "SELECT Numero_Documento, Fecha_Documento, Tipo_Documento, NIT_Empresa
                FROM encabezado_documento_venta 
                WHERE Numero_Ingreso = '".$Estado1[0][2]."' AND Tipo_Documento = 'PL'
                AND Estado_Documento = 'A'";
                $Estado4 = $objCotizacion->Consultar($sqlEstado4);
            }else{
                $Estado2 = null;
                $Estado4 = null;
            }
            
            $sqlEstado3 = "SELECT dfv.Numero_Documento, dfv.Numero_Ingreso, edv.Fecha_Documento, dfv.Tipo_Documento, 
                            dfv.NIT_Empresa, edv.Estado_Documento 
                            FROM detalle_factura_venta AS dfv, encabezado_factura_venta AS edv 
                            WHERE dfv.Numero_Documento = edv.Numero_Documento 
                            AND dfv.NIT_Empresa = edv.NIT_Empresa 
                            AND dfv.Numero_Cotizacion = '$Numero_Documento' AND dfv.Tipo_Documento = 'FVC' 
                            AND dfv.NIT_Empresa = '$nit_sede' AND edv.Estado_Documento = 'A'";
            $Estado3 = $objCotizacion->Consultar($sqlEstado3);
			
			if (substr($Estado1[0]["FechaAprobacion"], 0, 10) != "0000-00-00") {

                $data_urlCT = getUrl("Cotizaciones", "Cotizaciones", "Cotizacion", 
                    array(
                        "numero_doc" => $Numero_Documento, 
                        "tipo_doc" => $tipo_doc, 
                        "nit_sede" => $nit_sede
                    ));

				$rowEstado1 = '
                    <tr>
                        <td>Aprobada</td>
                        <td>
                            <span><i class="fa fa-check"></i></span>
                        </td>
                        <td>
                            <span> ' . $Estado1[0]["Numero_Documento"] . ' </span>
                        </td>
                        <td>
                            <span> ' . substr($Estado1[0]["FechaAprobacion"], 0, 10) . ' </span>
                        </td>
                        <td>
                            <a href="'.str_replace("&funcion=" , "&funcion=getVer", $data_urlCT).'" target="_blank" class="btn btn-primary fa fa-eye" id="ver"></a>
                        </td>
                        <td>
                            <a href="'.str_replace("&funcion=" , "&funcion=getEditar", $data_urlCT).'" target="_blank" class="btn btn-primary fa fa-edit" id="editar"></a>
                        </td>
                    </tr>';
			}else{

                $data_urlCT = getUrl("Cotizaciones", "Cotizaciones", "Cotizacion", 
                    array(
                        "numero_doc" => $Numero_Documento, 
                        "tipo_doc" => $tipo_doc, 
                        "nit_sede" => $nit_sede
                    ));

                $rowEstado1 = '
                    <tr>
                        <td>Aprobada</td>
                        <td>
                            <span><i class="fa fa-times"></i></span>
                        </td>
                        <td>
                            <span> ' . $Estado1[0]["Numero_Documento"] . ' </span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                        <td>
                            <a href="'.str_replace("&funcion=" , "&funcion=getVer", $data_urlCT).'" target="_blank" class="btn btn-primary fa fa-eye" id="ver"></a>
                        </td>
                        <td>
                            <a href="'.str_replace("&funcion=" , "&funcion=getEditar", $data_urlCT).'" target="_blank" class="btn btn-primary fa fa-edit" id="editar"></a>
                        </td>
                    </tr>';
            }

			if ($Estado2 != null) {
				$rowEstado2 = '
                    <tr>
                        <td>Remisionada</td>
                        <td>
                            <span><i class="fa fa-check"></i></span>
                        </td>
                        <td>
                            <span> ' . $Estado2[0]["Numero_Documento"] . ' </span>
                        </td>
                        <td>
                            <span> ' . substr($Estado2[0]["Fecha_Documento"], 0, 10) . ' </span>
                        </td>
                        <td>
                            <button class="btn btn-primary fa fa-eye" id="ver"></button>
                        </td>
                        <td>
                            <button class="btn btn-primary fa fa-edit" id="editar"></button>
                        </td>
                    </tr>';
			}else{
                $rowEstado2 = '
                    <tr>
                        <td>Remisionada</td>
                        <td>
                            <span><i class="fa fa-times"></i></span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                        <td>
                            <button class="btn btn-primary fa fa-eye" id="ver"></button>
                        </td>
                        <td>
                            <button class="btn btn-primary fa fa-edit" id="editar"></button>
                        </td>
                    </tr>';
            }
            
			if ($Estado3 != null) {

                $data_urlFVC = getUrl("Factura", "Factura", "Factura", 
                    array(
                        "numero_doc" => $Estado3[0]["Numero_Documento"], 
                        "tipo_doc" => $Estado3[0]["Tipo_Documento"], 
                        "nit_sede" => $Estado3[0]["NIT_Empresa"]
                    ));
                    
				$rowEstado3 = '
                    <tr>
                        <td>Facturada</td>
                        <td>
                            <span><i class="fa fa-check"></i></span>
                        </td>
                        <td>
                            <span> ' . $Estado3[0]["Numero_Documento"] . ' </span>
                        </td>
                        <td>
                            <span> ' . substr($Estado3[0]["Fecha_Documento"], 0, 10) . ' </span>
                        </td>
                        <td>
                            <a href="'.str_replace("&funcion=" , "&funcion=getVer", $data_urlFVC).'" target="_blank" class="btn btn-primary fa fa-eye" id="ver"></a>
                        </td>
                        <td>
                            <span></span>
                        </td>
                    </tr>';
			}else{

                $data_urlCT = getUrl("Cotizaciones", "Cotizaciones", "Cotizacion", 
                    array(
                        "numero_doc" => $Numero_Documento, 
                        "tipo_doc" => $tipo_doc, 
                        "nit_sede" => $nit_sede
                    ));

                $rowEstado3 = '
                    <tr>
                        <td>Facturada</td>
                        <td>
                            <span><i class="fa fa-times"></i></span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                        <td>
                            <span></span>
                        </td>
                        <td>
                            <a href="'.str_replace("&funcion=Cotizacion" , "&funcion=FacturarCotizacion", $data_urlCT).'" target="_blank" class="btn btn-primary fa fa-eye" id="ver"></a>
                        </td>
                        <td>
                            <span></span>
                        </td>
                    </tr>';
            }
            
            if($tipo_doc == "CT"){
                
                $num_ingreso = $_POST["num_ingreso"];
                $nit_cliente = $_POST["nit_cliente"];
                
                if ($Estado4 != null) {

                    $data_urlPL = getUrl("Preliquidacion", "Preliquidacion", "Preliquidacion", 
                        array(
                            "numero_doc" => $Estado4[0]["Numero_Documento"], 
                            "tipo_doc" => $Estado4[0]["Tipo_Documento"], 
                            "nit_sede" => $Estado4[0]["NIT_Empresa"]
                        ));

                    $rowEstado4 = '
                        <tr>
                            <td>Preliquidada</td>
                            <td>
                                <span><i class="fa fa-check"></i></span>
                            </td>
                            <td>
                                <span> ' . $Estado4[0]["Numero_Documento"] . ' </span>
                            </td>
                            <td>
                                <span> ' . substr($Estado4[0]["Fecha_Documento"], 0, 10) . ' </span>
                            </td>
                            <td>
                                <a href="'.str_replace("&funcion=" , "&funcion=getVer", $data_urlPL).'" target="_blank" class="btn btn-primary fa fa-eye" id="ver"></a>
                            </td>
                            <td>
                                <a href="'.str_replace("&funcion=" , "&funcion=getEditar", $data_urlPL).'" target="_blank" class="btn btn-primary fa fa-edit" id="editar"></a>
                            </td>
                        </tr>';
                }else{

                    $data_urlPL = getUrl("Preliquidacion", "Preliquidacion", "crearPreliquidacion", 
                        array(
                            "tipo_doc" => $tipo_doc,
                            "num_ingreso" => $num_ingreso,
                            "nit_sede" => $nit_sede,
                            "nit_cliente" => $nit_cliente
                        ));

                    $rowEstado4 = '
                        <tr>
                            <td>Preliquidada</td>
                            <td>
                                <span><i class="fa fa-times"></i></span>
                            </td>
                            <td>
                                <span></span>
                            </td>
                            <td>
                                <span></span>
                            </td>
                            <td>
                                <a href="'.$data_urlPL.'" target="_blank" class="btn btn-primary fa fa-eye" id="ver"></a>
                            </td>
                            <td>
                                <a href="'.$data_urlPL.'" target="_blank" class="btn btn-primary fa fa-edit" id="editar"></a>
                            </td>
                        </tr>';
                }
            }else{
                $rowEstado4=null;
            }

			$tabla = '
			<table id="tablaEstadosCicloVida" class="table table-bordered table-hover">

				<thead class="text-center text-white bg-primary thead-primary">
					<tr>
						<th>Estados</th>
						<th></th>
						<th>N° de Documento</th>
						<th>Fecha</th>
						<th>Ver</th>
						<th>Editar</th>
					</tr>
				</thead>

				<tbody class="text-center" style="font-size: 20px;">
					' . $rowEstado1 . '
					' . $rowEstado2 . '
					' . $rowEstado3 . '
					' . $rowEstado4 . '
				</tbody>

			</table>';

		}
		echo json_encode(array(
			"tablaEstadosCicloVida" => $tabla,
		));
	}

    public function EditarCotizacion() {
        extract($_POST);
        $objCotizacion = new CotizacionesModel();

        if (!empty($_POST)) {
            if (!empty($case)) {
                switch ($case) {
                    case "obtenerConsecutivo":

                    if (strpos($numCT, "-") !== false){
                        $numDoc = substr($numCT, 0, strpos($numCT, "-"));
                    } else {
                        $numDoc = $numCT;
                    }
                    
                    if ($existeCT == "true") {
                        $sqlnumdoc = "SELECT Numero_Documento
                                        FROM encabezado_cotizacion_venta
                                            WHERE Tipo_Documento='$tipo_doc'
                                                AND NIT_Empresa='$nit_sede'
                                                AND Numero_Documento LIKE '$numDoc%'
                                                    ORDER BY Numero_Documento DESC";
                        $listaNum = $objCotizacion->Consultar($sqlnumdoc);
                        $UltimoNumDoc = $listaNum[0][0];
                        $separador = strpos($UltimoNumDoc, "-");
            
                        if ($separador == false) {
                            $sgte = 1;
                            $ultimoDigito = 0;
                            $num = $UltimoNumDoc;
                        } else {
                            $cant_caracter = strlen($UltimoNumDoc);
                            $ultimoDigito = substr($UltimoNumDoc, $cant_caracter - 1, 1);
                            $sgte = $ultimoDigito + 1;
                            $num = substr($UltimoNumDoc, 0, $cant_caracter - 2);
                        }
                        $numCT = $num . "-" . $sgte;

                        if ($sgte >= 5) {
                            $numCT = $num . "-" . "5";
                        }

                        echo json_encode(array("numCT"=>$numCT));
                    }
        
                    break;
                    
                    case "EditarCotizacion":
                        
                    $usu_id = $_SESSION["usua_id"];
                    date_default_timezone_set('America/Bogota');
                    $Fecha_Documento = date('Y-m-d');
                    $Hora_Documento = "0000-00-00 " . date('h:i:s');
                    $objCotizacion = new CotizacionesModel();
                    $numCotizacion = $numCT;
            
                    if ($planta == null) {
                        $planta = "";
                    }
            
                    if ($existeCT == "true") {
                
                        if (strpos($numCT, "-") !== false){
                            $numDoc = substr($numCT, 0, strpos($numCT, "-"));
                        } else {
                            $numDoc = $numCT;
                        }
                        
                        $sqlnumdoc = "SELECT Numero_Documento
                                        FROM encabezado_cotizacion_venta
                                            WHERE Tipo_Documento='$tipo_doc'
                                                AND NIT_Empresa='$nit_sede'
                                                AND Numero_Documento LIKE '$numDoc%'
                                                    ORDER BY Numero_Documento DESC";
                        $listaNum = $objCotizacion->Consultar($sqlnumdoc);
                        $UltimoNumDoc = $listaNum[0][0];
                        $separador = strpos($UltimoNumDoc, "-");
            
                        if ($separador == false) {
                            $sgte = 1;
                            $ultimoDigito = 0;
                            $num = $UltimoNumDoc;
                        } else {
                            $cant_caracter = strlen($UltimoNumDoc);
                            $ultimoDigito = substr($UltimoNumDoc, $cant_caracter - 1, 1);
                            $sgte = $ultimoDigito + 1;
                            $num = substr($UltimoNumDoc, 0, $cant_caracter - 2);
                        }

                        $numCT = $num . "-" . $sgte;

                        if ($sgte >= 5) {
                            $numCT = $num . "-" . "5";
                        }
            
                        if ($tipo_doc == "CT") {
                            $EsGer = "N";
            
                            if ($ultimoDigito == 5) {
                                $sqlACT = "UPDATE encabezado_cotizacion_venta SET Usuario_Modifica='$usu_id', Fecha_Documento='$Fecha_Doc', Fecha_Modifica=NOW(),
                                Cedula_Empleado='$vendedor', Estado_Documento='A', Nit_Cliente='$nit_empresa', Dirigido_A='$dirigida', Equipo='$equipo', Marca='$marca',
                                Potencia= '$potencia', Rpm='$rpm', Voltaje='$voltaje', Serie='$serie', Codigo_Planta='$planta', Tipo_Servicio='$tservicio', Forma_Pago='$fpago',
                                Dias_Plazo='$plazo', Prioridad='$tiempoE', Orden_Compra='$orden_compra', Garantia='$garantia', FechaAprobacion='$fecha_aprobGER', Subtotal=" . str_replace(",", "", $subtotal_doc) . ", 
                                Descuento=" . str_replace(",", "", $tdescuento) . ", Iva=" . str_replace(",", "", $tiva) . ", Total=" . str_replace(",", "", $tdoc) . ", Observaciones='$observa'
                                WHERE Numero_Documento='$numCT' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ";
                                $objCotizacion->Actualizar($sqlACT);
            
                                if (isset($producto_Editar)) {
                                    for ($i = 0; $i < count($producto_Editar); $i++) {
                                        echo $sqlServ = "UPDATE detalle_cotizacion_venta SET Tipo_Documento='$tipo_doc', Cantidad='$cant_Editar[$i]', Porcentaje_Descuento='$desc_Editar[$i]',
                                        Valor_Unitario=". str_replace(",", "", $valor_Editar[$i]) .", Codigo_Producto='$producto_Editar[$i]', Detalle='$detalle_Editar[$i]', Porcentaje_Iva='$iva_Editar[$i]', Valor_Iva='$valoriva_Editar[$i]', Item=$item_Editar[$i]
                                        WHERE Numero_Registro='$Numero_Registro_Editar[$i]' AND NIT_Empresa='$nit_sede' ";
                                        $objCotizacion->Actualizar($sqlServ);
                                    }
                                }
                                if (isset($producto)) {
                                    for ($i = 0; $i < count($producto); $i++) {
                                        echo $sqlServ2 = "INSERT INTO detalle_cotizacion_venta
                                        (Numero_Registro, Numero_Documento, Numero_Ingreso, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                                        VALUES
                                        (NULL, '$numCT', '$no_ingreso', '$numCT', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ", '$nit_sede',
                                        '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                                        $objCotizacion->Insertar($sqlServ2);
                                    }
                                }
                            } else {
                               $sqlCT = "INSERT INTO encabezado_cotizacion_venta
                                (Numero_Documento, Tipo_Documento, Fecha_Documento, Hora_Documento, Cedula_Empleado, Estado_Documento,
                                Nit_Cliente, Dirigido_A, Numero_Ingreso, Usuario_Crea, Equipo, Marca, Potencia, Rpm, Voltaje, Serie, Codigo_Planta, EsGer,
                                Tipo_Servicio, Forma_Pago, Dias_Plazo, Prioridad, Orden_Compra, Garantia, FechaAprobacion, Subtotal, Descuento, Iva, Total, NIT_Empresa,
                                Observaciones)
                                VALUES
                                ('$numCT', '$tipo_doc', '$Fecha_Documento', '$Hora_Documento', '$vendedor', 'A',
                                '$nit_empresa', '$dirigida', '$no_ingreso', '$usu_id', '$equipo', '$marca', '$potencia', '$rpm', '$voltaje', '$serie', '$planta', '$EsGer',
                                '$tservicio', '$fpago', '$plazo', '$tiempoE', '$orden_compra', '$garantia', '$fecha_aprobGER', " . str_replace(",", "", $subtotal_doc) . ", 
                                " . str_replace(",", "", $tdescuento) . ", " . str_replace(",", "", $tiva) . ", " . str_replace(",", "", $tdoc) . ", '$nit_sede', '$observa')";
                                $objCotizacion->Insertar($sqlCT);
        
                                $plano = $sqlCT . ";";
        
                                if (isset($producto_Editar)) {
                                    for ($i = 0; $i < count($producto_Editar); $i++) {
                                       $sqlServ = "INSERT INTO detalle_cotizacion_venta
                                        (Numero_Registro, Numero_Documento, Numero_Ingreso, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                                        VALUES
                                        (NULL, '$numCT', '$no_ingreso', '$numCT', '$tipo_doc', " . $cant_Editar[$i] . "," . $desc_Editar[$i] . ", " . str_replace(",", "", $valor_Editar[$i]) . ", 
                                        " . $producto_Editar[$i] . ", '$nit_sede', '$detalle_Editar[$i]', $iva_Editar[$i], $valoriva_Editar[$i], $item_Editar[$i])";
                                        $objCotizacion->Insertar($sqlServ);
                                    }
                                }

                                if (isset($producto)) {
                                    for ($i = 0; $i < count($producto); $i++) {
                                        $sqlServ = "INSERT INTO detalle_cotizacion_venta
                                        (Numero_Registro, Numero_Documento, Numero_Ingreso, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                                        VALUES
                                        (NULL, '$numCT', '$no_ingreso', '$numCT', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ",  '$nit_sede',
                                        '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                                        $objCotizacion->Insertar($sqlServ);
                                    }
                                }
                            }
            
                        } else if ($tipo_doc == "CTGER") {
            
                            $EsGer = "S";
                            
                            if ($ultimoDigito == 5) {
                                $sqlACT = "UPDATE encabezado_cotizacion_venta SET Usuario_Modifica='$usu_id', Fecha_Documento='$Fecha_Doc', Fecha_Modifica=NOW(),
                                Cedula_Empleado='$vendedor', Estado_Documento='A', Nit_Cliente='$nit_empresa', Dirigido_A='$dirigida', Equipo='$equipo', Marca='$marca',
                                Insul_Cls='$insul', Potencia= '$potencia', Rpm='$rpm', Voltaje='$voltaje', Fs='$fs', Eficiencia='$eficiencia', Serie='$serie', Ip='$ip', Frame='$frame',
                                Codigo_Planta='$planta', Tipo_Servicio='$tservicio', Forma_Pago='$fpago', Dias_Plazo='$plazo', Prioridad='$tiempoE', Orden_Compra='$orden_compra', 
                                Garantia='$garantia', FechaAprobacion='$fecha_aprobGER', Subtotal=" . str_replace(",", "", $subtotal_doc) . ", Descuento=" . str_replace(",", "", $tdescuento) . ", 
                                Iva=" . str_replace(",", "", $tiva) . ", Total=" . str_replace(",", "", $tdoc) . ", Observaciones='$observa'
                                WHERE Numero_Documento='$numCT' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ";
                                $objCotizacion->Actualizar($sqlACT);
            
                                if (isset($producto_Editar)) {
                                    for ($i = 0; $i < count($producto_Editar); $i++) {
                                        $sqlServ = "UPDATE detalle_cotizacion_venta SET Tipo_Documento='$tipo_doc', Cantidad='$cant_Editar[$i]', Porcentaje_Descuento='$desc_Editar[$i]',
                                        Valor_Unitario=". str_replace(",", "", $valor_Editar[$i]) .", Codigo_Producto='$producto_Editar[$i]', Detalle='$detalle_Editar[$i]', Porcentaje_Iva='$iva_Editar[$i]', Valor_Iva='$valoriva_Editar[$i]', Item=$item_Editar[$i]
                                        WHERE Numero_Registro='$Numero_Registro_Editar[$i]' AND NIT_Empresa='$nit_sede' ";
                                        $objCotizacion->Actualizar($sqlServ);
                                    }
                                }
                                if (isset($producto)) {
                                    for ($i = 0; $i < count($producto); $i++) {
                                        $sqlServ = "INSERT INTO detalle_cotizacion_venta
                                        (Numero_Registro, Numero_Documento, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                                        VALUES
                                        (NULL, '$numCT', '$numCT', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ",  '$nit_sede',
                                        '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                                        $objCotizacion->Insertar($sqlServ);
                                    }
                                }
                            } else {
                                $sqlCT = "INSERT INTO encabezado_cotizacion_venta
                                (Numero_Documento, Tipo_Documento, Fecha_Documento, Hora_Documento, Cedula_Empleado, Estado_Documento, Nit_Cliente, Dirigido_A,
                                Usuario_Crea,Equipo, Marca, Insul_Cls, Potencia, Rpm, Voltaje, Fs, Eficiencia, Serie, Ip, Frame, Codigo_Planta, EsGer, Tipo_Servicio, Forma_Pago,
                                Dias_Plazo, Prioridad, Orden_Compra, Garantia, FechaAprobacion, Subtotal, Descuento, Iva, Total, NIT_Empresa, Observaciones)
                                VALUES
                                ('$numCT', '$tipo_doc', '$Fecha_Documento', '$Hora_Documento', '$vendedor', 'A', '$nit_empresa', '$dirigida',
                                '$usu_id', '$equipo', '$marca', '$insul', '$potencia', '$rpm', '$voltaje', '$fs', '$eficiencia', '$serie', '$ip', '$frame', '$planta', '$EsGer', '$tservicio',
                                    '$fpago', '$plazo', '$tiempoE', '$orden_compra', '$garantia', '$fecha_aprobGER', " . str_replace(",", "", $subtotal_doc) . ", " . str_replace(",", "", $tdescuento) . ", 
                                " . str_replace(",", "", $tiva) . ", " . str_replace(",", "", $tdoc) . ", '$nit_sede', '$observa')";
                                $objCotizacion->Insertar($sqlCT);
        
                                $plano = $sqlCT . ";";
        
                                if (isset($producto_Editar)) {
                                    for ($i = 0; $i < count($producto_Editar); $i++) {
                                        $sqlServ = "INSERT INTO detalle_cotizacion_venta
                                        (Numero_Registro, Numero_Documento, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                                        VALUES
                                        (NULL, '$numCT', '$numCT', '$tipo_doc', " . $cant_Editar[$i] . "," . $desc_Editar[$i] . ", " . str_replace(",", "", $valor_Editar[$i]) . ", 
                                        " . $producto_Editar[$i] . ", '$nit_sede', '$detalle_Editar[$i]', $iva_Editar[$i], $valoriva_Editar[$i], $item_Editar[$i])";
                                        $objCotizacion->Insertar($sqlServ);
                                    }
                                }
        
                                if (isset($producto)) {
                                    for ($i = 0; $i < count($producto); $i++) {
                                        $sqlServ2 = "INSERT INTO detalle_cotizacion_venta
                                        (Numero_Registro, Numero_Documento, Numero_Cotizacion, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                                        Detalle, Porcentaje_Iva, Valor_Iva, Item)
                                        VALUES
                                        (NULL, '$numCT', '$numCT', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ", '$nit_sede',
                                        '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                                        $objCotizacion->Insertar($sqlServ2);
                                    }
                                }
                            }
                        }
                    }

                    break;
                }
            }
        }
    }

    // public function validarOpcionVerEditar() {
    //     $num = $_POST["Numero_Documento"];
    //     $tipo_doc = $_POST["Tipo_Documento"];
    //     $nit_sede = $_POST["Nit_Sede"];
    //     $objCotizacion = new CotizacionesModel();

    //     if ($tipo_doc != "CT") {
    //         $sql = "SELECT Numero_Documento FROM encabezado_documento_venta
    //         WHERE Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede'
    //         AND Numero_Documento LIKE '$num%' ORDER BY Numero_Documento DESC";
    //         $num_doc = $objCotizacion->Consultar($sql);
    //     }else{
    //         $sql = "SELECT Numero_Documento FROM encabezado_cotizacion_venta
    //         WHERE Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede'
    //         AND Numero_Documento LIKE '$num%' ORDER BY Numero_Documento DESC";
    //         $num_doc = $objCotizacion->Consultar($sql);
    //     }

    //     echo json_encode(array("num_doc_reciente" => $num_doc[0][0]));
    // }

    public function BuscarConsecutivo() {
        $nit_Empresa_sede = $_POST['nit_sede'];
        $num_doc = $this->ConsecutivoDocumento($nit_Empresa_sede);
        echo json_encode($num_doc);
    }

    public function exportarCT($num_doc) {
        //http://www.webioss.com/php/crear-y-escribir-en-un-archivo-con-php/ Ajustar para dejar generico Ojo!!!!

        $nombre_archivo = "Cotizacion" . $num_doc . ".txt";

        if (file_exists($nombre_archivo)) {
            $mensaje = "El Archivo $nombre_archivo se ha modificado";
        } else {
            if ($archivo = fopen($nombre_archivo, "a")) {
                if (fwrite($archivo, date("d m Y H:m:s") . " " . $mensaje . "\n")) {
                    echo "Se ha ejecutado correctamente";
                } else {
                    echo "Ha habido un problema al crear el archivo";
                }

                fclose($archivo);
            }
        }
    }

    public function ActualizarFechaAprobacion() {
        $fechAprobacion = $_POST["fechApro"];
        $num_doc = $_POST["num_doc"];
        $tipo_doc = $_POST["tipo_doc"];
        $sede = $_POST["nit_sede"];

        $objCotizacion = new CotizacionesModel();
        $sqlUpdate = "UPDATE encabezado_cotizacion_venta SET FechaAprobacion='$fechAprobacion' WHERE Tipo_Documento='$tipo_doc' AND Numero_Documento='$num_doc' AND NIT_Empresa='$sede'";
        $objCotizacion->Actualizar($sqlUpdate);
    }

    public function ActualizarOrdenCompra() {
        $OrdenCompra = $_POST["OrdenCompra"];
        $num_doc = $_POST["num_doc"];
        $tipo_doc = $_POST["tipo_doc"];
        $sede = $_POST["nit_sede"];

        $objCotizacion = new CotizacionesModel();
        $sqlUpdate = "UPDATE encabezado_cotizacion_venta SET Orden_Compra='$OrdenCompra' WHERE Tipo_Documento='$tipo_doc' AND Numero_Documento='$num_doc' AND NIT_Empresa='$sede'";
        $objCotizacion->Actualizar($sqlUpdate);
    }

    public function BuscarDetalleIngresoPL() {
        $nit_sede = $_POST["nit_sede"];
        $num_ingreso = $_POST["ingreso"];

        $objCotizacion = new CotizacionesModel();

        if ($num_ingreso != "") { 
            $sqldetalle = "SELECT encabezado_documento_venta.Numero_Ingreso, Codigo_Producto, productos_servicios.Descripcion, detalle_documento_venta.Detalle, detalle_documento_venta.Cantidad,detalle_documento_venta.Valor_Unitario,
                                detalle_documento_venta.Porcentaje_Descuento, Valor_Iva, detalle_documento_venta.Porcentaje_Iva
                                    FROM detalle_documento_venta, productos_servicios, encabezado_documento_venta
                                        WHERE encabezado_documento_venta.Numero_Documento=detalle_documento_venta.Numero_Documento
                                            AND encabezado_documento_venta.Tipo_Documento=detalle_documento_venta.Tipo_Documento
                                            AND encabezado_documento_venta.NIT_Empresa=detalle_documento_venta.NIT_Empresa
                                            AND detalle_documento_venta.Codigo_Producto=productos_servicios.Codigo
                                            AND encabezado_documento_venta.Numero_Ingreso='$num_ingreso' 
                                            AND encabezado_documento_venta.Tipo_Documento='PL' 
                                            AND encabezado_documento_venta.NIT_Empresa='$nit_sede' 
                                            AND encabezado_documento_venta.Estado_Documento = 'A' ORDER BY Numero_Registro ASC";
            $detallePL = $objCotizacion->Consultar($sqldetalle);
        } else {
            $detallePL = null;
        }

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios where Indicativo='A'";
        $servicios = $objCotizacion->Consultar($sqlserv);

        include_once '../../views/Cotizaciones/GuiCargarDetallePL.html.php';
    }

    function ValidarOrdenCompra(){
		$objCotizacion = new CotizacionesModel();

		if (!empty($_POST["Orden_Compra"]) && !empty($_POST["Nit_Sede"])) {

			$sqlCotizacion="SELECT * FROM encabezado_cotizacion_venta WHERE Orden_Compra = '".$_POST["Orden_Compra"]."' AND Nit_Empresa = '".$_POST["Nit_Sede"]."' AND Estado_Documento = 'A'";
			$validorden=$objCotizacion->Consultar($sqlCotizacion);

			if ($validorden != null) {
				$respuesta=true;
			}else{
				$respuesta=false;
            }
            
            if(!empty($_POST["Numero_Documento"]) && !empty($_POST["Nit_Sede"])){

                $numCT=$_POST["Numero_Documento"];
                $Orden1=$_POST["Orden_Compra"];
    
                if (strpos($numCT, "-") !== false){
                    $numDoc1 = substr($numCT, 0, strpos($numCT, "-"));
                } else {
                    $numDoc1 = $numCT;
                }
                
                $sqlCotizacion="SELECT * FROM encabezado_cotizacion_venta WHERE Orden_Compra = '".$_POST["Orden_Compra"]."' AND Nit_Empresa = '".$_POST["Nit_Sede"]."' AND Estado_Documento = 'A'";
                $cotizacion=$objCotizacion->Consultar($sqlCotizacion);
                
                if ($cotizacion != null) {
    
                    $Orden2=$cotizacion[0]["Orden_Compra"];
    
                    if (strpos($cotizacion[0]["Numero_Documento"], "-") !== false){
                        $numDoc2 = substr($cotizacion[0]["Numero_Documento"], 0, strpos($cotizacion[0], "-"));
                    } else {
                        $numDoc2 = $cotizacion[0]["Numero_Documento"];
                    }
    
                    if ($numDoc1 == $numDoc2 && $Orden1 == $Orden2) {
                        $respuesta=false;
                    }else{
                        $respuesta=true;
                    }
                }else{
                    $respuesta=false;
                }
            }
        }
        echo json_encode($respuesta);
	}
}