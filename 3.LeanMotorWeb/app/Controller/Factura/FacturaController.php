<?php

@include_once '../../app/Model/Factura/FacturaModel.php';
@session_start();

class FacturaController {

    public function ConsecutivoDocumento($nit_sede) {
        $objFactura = new FacturaModel();
        $sql = "SELECT ultimo_creado FROM consecutivo_documentos WHERE td_sigla='FVC' AND nit_empresa = '$nit_sede'";
        $num_doc = $objFactura->Consultar($sql);
        $cons_doc = $num_doc[0][0] + 1;

        return $cons_doc;
    }

    public function Incrementar_Consecutivo($nit_sede) {
        $objFactura = new FacturaModel();
        $actCons = "UPDATE consecutivo_documentos SET ultimo_creado=ultimo_creado+1 WHERE td_sigla='FVC' AND nit_empresa = '$nit_sede'";
        $objFactura->Actualizar($actCons);
    }

    public function crearFactura() {
        $objFactura = new FacturaModel();

        $usua_perfil = $_SESSION['usua_perfil'];

        if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"]) && !empty($_GET["num_ingreso"])) {

            $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
            $empresas = $objFactura->Consultar($sqlempresa);
            
            $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='".$_GET["nit_sede"]."' ORDER BY nombre";
            $sedes = $objFactura->Consultar($sqlsede);

            $sqlCotizacion = "SELECT MAX(Numero_Documento) AS Numero_Documento FROM encabezado_cotizacion_venta 
            WHERE Numero_Ingreso = '".$_GET["num_ingreso"]."' AND Estado_Documento = 'A' ";
            $cotizacion = $objFactura->Consultar($sqlCotizacion);
            $numCT = $cotizacion[0]["Numero_Documento"];

            $consIngreso = "SELECT ine.Numero_Ingreso, ine.Orden_Servicio FROM ingreso_equipos AS ine, equipos AS e
                                        WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["num_ingreso"]."' 
                                        AND e.Numero_Serie=ine.Numero_Serie 
                                        AND ine.Estado='A' ORDER BY Fecha_Ingreso DESC";
            $Ingresos = $objFactura->Consultar($consIngreso);
            $orden_servicio = $Ingresos[0]["Orden_Servicio"];

            $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa = '".$_GET["nit_sede"]."' AND Estado = 'A' ORDER BY nombre_completo";
            $vendedor = $objFactura->Consultar($sqlven);

            $sqlOrdenCompra = "SELECT MAX(Orden_Compra) AS Orden_Compra FROM encabezado_cotizacion_venta 
            WHERE Numero_Ingreso = '".$_GET["num_ingreso"]."' AND Estado_Documento = 'A' ";
            $orden_compra = $objFactura->Consultar($sqlOrdenCompra);

            $consecutivoFVC = $this->ConsecutivoDocumento($_GET["nit_sede"]);
        }else{
            $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social ";
            $empresas = $objFactura->Consultar($sqlempresa);

            $sqlsede = "SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
            $sedes = $objFactura->Consultar($sqlsede);
        }

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objFactura->Consultar($sqlserv);

        include_once '../../views/Factura/GuiFacturaVenta.html.php';
    }

    public function validarFacturaCotizacion() {
        $numCT = $_POST["numero_doc"];
        $tipo_doc = $_POST["tipo_doc"];
        $nit_sede = $_POST["nit_sede"];
        $objFactura = new FacturaModel();

        $factura = false;

        if (strpos($numCT, "-") !== false){
            $numDoc = substr($numCT, 0, strpos($numCT, "-"));
        } else {
            $numDoc = $numCT;
        }

        $sqlFV = "SELECT ddv.Numero_Documento, ddv.Numero_Ingreso, edv.Fecha_Documento, ddv.Tipo_Documento,
                            ddv.NIT_Empresa, edv.Estado_Documento
                            FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv
                            WHERE ddv.Numero_Documento = edv.Numero_Documento
                            AND ddv.NIT_Empresa = edv.NIT_Empresa
                            AND ddv.Numero_Cotizacion LIKE '$numDoc%' AND ddv.Tipo_Documento = 'FVC'
                            AND ddv.NIT_Empresa = '$nit_sede' AND edv.Estado_Documento = 'A'";
        $facturaVenta = $objFactura->Consultar($sqlFV);

        if ($facturaVenta == null) {
            echo json_encode(array("factura_venta" => $factura));
        }else{
            $factura = true;
            echo json_encode(array("factura_venta" => $factura, "numFVC" => $facturaVenta[0]["Numero_Documento"]));
        }
    }

    public function FacturarCotizacion() {

        $objFactura = new FacturaModel();

        $Numero_Documento = $_GET["numero_doc"];
        $tipo_doc = $_GET["tipo_doc"];
        $nit_sede = $_GET["nit_sede"];

        $sqlFVC = "SELECT Numero_Documento, Numero_Ingreso, clientes.Nit_Cliente, Razon_Social, Dirigido_A, Codigo_Planta, clientes.Direccion, Telefono1,
				Telefono2, encabezado_cotizacion_venta.Dias_Plazo, encabezado_cotizacion_venta.Observaciones, Estado_Documento,
				encabezado_cotizacion_venta.NIT_Empresa, sedes.nombre, encabezado_cotizacion_venta.Cedula_Empleado, Subtotal, Descuento, Iva, Total, encabezado_cotizacion_venta.Orden_Compra 
                    FROM encabezado_cotizacion_venta, clientes, sedes
						WHERE encabezado_cotizacion_venta.Nit_Cliente=clientes.Nit_Cliente
						AND Numero_Documento='$Numero_Documento'
						AND Tipo_Documento='$tipo_doc' AND encabezado_cotizacion_venta.NIT_Empresa='$nit_sede'
						AND encabezado_cotizacion_venta.NIT_Empresa=sedes.nit_empresa";

        $cabeceraFVC = $objFactura->Consultar($sqlFVC);

        if ($cabeceraFVC[0]["Codigo_Planta"] != null) {
            $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraFVC[0]["Nit_Cliente"] . "'" . "";
            $plantas = $objFactura->Consultar($sqlplanta);
        } else {
            $plantas = null;
        }

        $sqlIngre = "SELECT Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion, tequi.Codigo_Tipo_Equipo, gru.Descripcion, gru.Codigo_Grupo,
							marcas.Descripcion, marcas.Codigo_Marca, ing.Numero_Serie, No_fases, potencia, revoluciones_por_minuto, voltaje, Ubicacion,
							Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso=" . "'" . $cabeceraFVC[0]["Numero_Ingreso"] . "'" . " LIMIT 1";
        $ingresosFVC = $objFactura->Consultar($sqlIngre);

        $sqlDetalle = "SELECT  Numero_Registro, Numero_Cotizacion, Numero_Ingreso, Aprobado, Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle,
						detalle_cotizacion_venta.Cantidad, detalle_cotizacion_venta.Valor_Unitario,
						detalle_cotizacion_venta.Porcentaje_Descuento, Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva
						FROM detalle_cotizacion_venta, productos_servicios WHERE detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
							AND  Numero_Documento='$Numero_Documento' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ORDER BY Numero_Registro ASC";
        $detalleFVC = $objFactura->Consultar($sqlDetalle);

        $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa='$nit_sede' AND Estado = 'A' ORDER BY nombre_completo";
        $vendedor = $objFactura->Consultar($sqlven);

        $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
        $empresas = $objFactura->Consultar($sqlempresa);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
        $sedes = $objFactura->Consultar($sqlsede);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objFactura->Consultar($sqlserv);

        $sql = "SELECT ultimo_creado FROM consecutivo_documentos WHERE td_sigla='FVC' AND nit_empresa='$nit_sede'";
        $num_doc = $objFactura->Consultar($sql);

        if ($num_doc != null) {
            $cons_doc = $num_doc[0][0] + 1;
        } else {
            $cons_doc = null;
        }

        include_once '../../views/Factura/GuiFacturarCotizacion.html.php';
    }

    public function RegistrarFactura() {
        extract($_POST);
        $usu_id = $_SESSION['usua_id'];
        date_default_timezone_set('America/Bogota');
        $Hora_Documento = "0000-00-00 " . date('h:i:s');
        $objFactura = new FacturaModel();

        $numFVC = $this->ConsecutivoDocumento($nit_sede);

        if (!empty($nit_emp)) {
            $nit_empresa=$nit_emp;
        }

        $sqlFVC = "INSERT INTO encabezado_factura_venta
        (Numero_Documento, Numero_Cotizacion, Numero_Ingreso, Tipo_Documento, Fecha_Documento, Hora_Documento, Orden_Compra, Cedula_Empleado, Estado_Documento,
        Nit_Cliente, Usuario_Crea, Codigo_Planta, Dias_Plazo, Subtotal, Iva, Total, NIT_Empresa, Observaciones)
        VALUES
        ('$numFVC', '$numero_cotizacion', '$numero_ingreso', '$tipo_doc', '$Fecha_Documento', '$Hora_Documento', '$Orden_Compra', '$vendedor', 'A',
        '$nit_empresa', '$usu_id', '$planta', '$plazo', " . str_replace(",", "", $subtotal_doc) . ", 
        " . str_replace(",", "", $tiva) . ", " . str_replace(",", "", $tdoc) . ", '$nit_sede', '$observa')";
        $objFactura->Insertar($sqlFVC);

        if (isset($producto)) {
            for ($i = 0; $i < count($producto); $i++) {
                echo $sqlServ = "INSERT INTO detalle_factura_venta
                (Numero_Registro, Numero_Documento, Numero_Cotizacion, Numero_Ingreso, Tipo_Documento, Cantidad, Porcentaje_Descuento, Valor_Unitario, Codigo_Producto, NIT_Empresa,
                Detalle, Porcentaje_Iva, Valor_Iva, Item)
                VALUES
                (NULL, '$numFVC', '$numCT[$i]', '$no_ingreso[$i]', '$tipo_doc', " . $cant[$i] . "," . $desc[$i] . ", " . str_replace(",", "", $valor[$i]) . ", " . $producto[$i] . ",  '$nit_sede',
                '$detalle[$i]', $iva[$i], $valoriva[$i], $item[$i])";
                $objFactura->Insertar($sqlServ);
            }
        }

        $this->Incrementar_Consecutivo($nit_sede);
    }

    public function getVerFactura() {
        $Numero_Documento = $_GET["numero_doc"];
        $tipo_doc = $_GET["tipo_doc"];
        $nit_sede = $_GET["nit_sede"];
        $objFactura = new FacturaModel();

        $sqlFVC = "SELECT Numero_Documento, Numero_Cotizacion, Numero_Ingreso, Fecha_Documento, clientes.Nit_Cliente, Razon_Social, Dirigido_A,
                Codigo_Planta, clientes.Direccion, Telefono1, Telefono2, encabezado_factura_venta.Dias_Plazo,
                encabezado_factura_venta.Observaciones, Estado_Documento, encabezado_factura_venta.NIT_Empresa,
                sedes.nombre, encabezado_factura_venta.Cedula_Empleado, Subtotal, Descuento, Iva, Total, Orden_Compra
                    FROM encabezado_factura_venta, clientes, sedes
                        WHERE encabezado_factura_venta.Nit_Cliente=clientes.Nit_Cliente
                        AND Numero_Documento='$Numero_Documento'
                        AND Tipo_Documento='$tipo_doc' AND encabezado_factura_venta.NIT_Empresa='$nit_sede'
                        AND encabezado_factura_venta.NIT_Empresa=sedes.nit_empresa";
        $cabeceraFVC = $objFactura->Consultar($sqlFVC);

        if ($cabeceraFVC[0]["Codigo_Planta"] != null) {
            $sqlplanta = "SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente=" . "'" . $cabeceraFVC[0]["Nit_Cliente"] . "'" . "";
            $plantas = $objFactura->Consultar($sqlplanta);
        } else {
            $plantas = null;
        }

        $sqlIngre = "SELECT Numero_Ingreso, ing.Detalle_De_Equipo, tequi.Descripcion, tequi.Codigo_Tipo_Equipo, gru.Descripcion, gru.Codigo_Grupo,
                            marcas.Descripcion, marcas.Codigo_Marca, ing.Numero_Serie, No_fases, potencia, revoluciones_por_minuto, voltaje, Ubicacion,
                            Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
                                WHERE ing.Numero_Serie=equi.Numero_Serie
                                    AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
                                    AND tequi.Codigo_Grupo=gru.Codigo_Grupo
                                    AND equi.Codigo_Marca=marcas.Codigo_Marca
                                    AND equi.Numero_Serie=dequi.Numero_Serie
                                    AND ing.Numero_Ingreso='".$cabeceraFVC[0]["Numero_Ingreso"]."' ";
        $ingresosFVC = $objFactura->Consultar($sqlIngre);

        $sqlDetalle = "SELECT Numero_Registro, Numero_Cotizacion, Numero_Ingreso, Aprobado, Codigo_Producto, productos_servicios.Descripcion,
                        detalle_factura_venta.Detalle, detalle_factura_venta.Cantidad, detalle_factura_venta.Valor_Unitario,
                        detalle_factura_venta.Porcentaje_Descuento, Valor_Iva, detalle_factura_venta.Porcentaje_Iva
                        FROM detalle_factura_venta, productos_servicios WHERE detalle_factura_venta.Codigo_Producto=productos_servicios.Codigo
                            AND  Numero_Documento='$Numero_Documento' AND Tipo_Documento='$tipo_doc' AND NIT_Empresa='$nit_sede' ORDER BY Numero_Registro ASC";
        $detalleFVC = $objFactura->Consultar($sqlDetalle);

        $sqlven = "SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Cargo='14' AND Nit_Empresa='$nit_sede' AND Estado = 'A' ORDER BY nombre_completo";
        $vendedor = $objFactura->Consultar($sqlven);

        $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$nit_sede' AND Estado='A' ORDER BY Razon_Social";
        $empresas = $objFactura->Consultar($sqlempresa);

        $sqlsede = "SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$nit_sede' ORDER BY nombre";
        $sedes = $objFactura->Consultar($sqlsede);

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objFactura->Consultar($sqlserv);

        $sql = "SELECT ultimo_creado FROM consecutivo_documentos WHERE td_sigla='CT' AND nit_empresa='$nit_sede'";
        $num_doc = $objFactura->Consultar($sql);

        include_once '../../views/Factura/GuiVerFacturaVenta.html.php';
    }

    public function seleccionIngresos() {
        $nit_cliente = $_POST["nit_cliente"];

        $objFactura = new FacturaModel();
        $sqlDoc = "SELECT ine.Numero_Ingreso, ine.Nit_Empresa, cli.Razon_Social, ine.Fecha_Ingreso, CONCAT(dte.Potencia,' - ', dte.Unidad_De_Potencia) AS Potencia,
                            dte.Revoluciones_Por_Minuto, dte.Voltaje FROM ingreso_equipos AS ine, equipos AS equi, detalle_equipo AS dte, clientes AS cli
                            WHERE equi.Numero_Serie=ine.Numero_Serie AND ine.Numero_Serie=dte.Numero_Serie
                            AND equi.Nit_Cliente=cli.Nit_Cliente AND equi.Nit_Cliente='$nit_cliente' GROUP BY ine.Numero_Ingreso";
        $ingresos = $objFactura->Consultar($sqlDoc);

        $datos = array();

        if ($ingresos != null) {
            foreach ($ingresos as $ingreso) {

                $sqlFVC = "SELECT ddv.Numero_Documento, ddv.Numero_Ingreso, edv.Fecha_Documento, ddv.Tipo_Documento,
                ddv.NIT_Empresa, edv.Estado_Documento FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv
                WHERE ddv.Numero_Documento = edv.Numero_Documento AND ddv.NIT_Empresa = edv.NIT_Empresa
                AND ddv.Numero_Ingreso = '" . $ingreso["Numero_Ingreso"] . "' AND ddv.Tipo_Documento = 'FVC'
                AND ddv.NIT_Empresa = '" . $ingreso["Nit_Empresa"] . "' AND edv.Estado_Documento = 'A'";
                $factura = $objFactura->Consultar($sqlFVC);

                if ($factura == null) {
                    array_push($datos,
                        array(
                            "numero_ingreso" => $ingreso["Numero_Ingreso"],
                            "fecha_ingreso" => substr($ingreso["Fecha_Ingreso"], 0, 10),
                            "potencia" => $ingreso["Potencia"],
                            "velocidad" => $ingreso["Revoluciones_Por_Minuto"],
                            "voltaje" => $ingreso["Voltaje"],
                            "ver_cotizacion" => '<button type="button" id="verCotizacionIngreso" data-url="' . getUrl("Factura", "Factura", "buscarCotizacionesIngreso", false, "ajax") . '" class="btn btn-primary fa fa-eye"></button>',
                        ));
                }
            }
        }

        $tabla = array("data" => $datos);

        echo json_encode($tabla);
    }

    public function adicionarCotizaciones(){
        $nit_cliente = $_POST["nit_cliente"];
        $objFactura = new FacturaModel();

        $sqlCotizacion = "SELECT * FROM encabezado_cotizacion_venta WHERE Nit_Cliente = '$nit_cliente' AND Estado_Documento = 'A' ORDER BY Fecha_Documento DESC";
        $cotizaciones = $objFactura->Consultar($sqlCotizacion);

        $datos = array();

        if ($cotizaciones != null) {
            foreach ($cotizaciones as $cotizacion) {

                $sqlFVC = "SELECT ddv.Numero_Documento, edv.Fecha_Documento, ddv.Tipo_Documento,
                ddv.NIT_Empresa, edv.Estado_Documento FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv
                WHERE ddv.Numero_Documento = edv.Numero_Documento AND ddv.NIT_Empresa = edv.NIT_Empresa
                AND ddv.Numero_Cotizacion = '".$cotizacion["Numero_Documento"]."' AND ddv.Tipo_Documento = 'FVC'
                AND ddv.NIT_Empresa = '".$cotizacion["NIT_Empresa"]."' AND edv.Estado_Documento = 'A'";
                $factura = $objFactura->Consultar($sqlFVC);

                if($factura == null){
                    array_push($datos,
                    array(
                        "numero_documento" => $cotizacion["Numero_Documento"],
                        "numero_ingreso" => $cotizacion["Numero_Ingreso"],
                        "fecha_documento" => substr($cotizacion["Fecha_Documento"], 0, 10),
                        "agregar_detalle" => '<button type="button" id="agregarDetalleCotizacion" data-url="' . getUrl("Factura", "Factura", "agregarDetalleCotizacion", false, "ajax") . '" class="btn btn-primary fa fa-folder-plus"></button>',
                        "estado" => "",
                    ));
                }
            }
        }

        $tabla = array("data" => $datos);

        echo json_encode($tabla);
    }

    public function buscarCotizacionesIngreso() {
        $num_ingreso = $_POST["num_ingreso"];
        $objFactura = new FacturaModel();

        $sqlCotizacion = "SELECT * FROM encabezado_cotizacion_venta WHERE Numero_Ingreso = '$num_ingreso' AND Tipo_Documento = 'CT' AND Estado_Documento = 'A' ORDER BY Numero_Documento DESC, Fecha_Documento DESC";
        $cotizaciones = $objFactura->Consultar($sqlCotizacion);

        $datos = array();

        if ($cotizaciones != null) {
            foreach ($cotizaciones as $cotizacion) {
                array_push($datos,
                    array(
                        "numero_ingreso" => $cotizacion["Numero_Ingreso"],
                        "numero_documento" => $cotizacion["Numero_Documento"],
                        "fecha_documento" => substr($cotizacion["Fecha_Documento"], 0, 10),
                        "agregar_detalle" => '<button type="button" id="agregarDetalleCotizacion" data-url="' . getUrl("Factura", "Factura", "agregarDetalleCotizacion", false, "ajax") . '" class="btn btn-primary fa fa-folder-plus"></button>',
                        "estado" => "",
                    ));
            }
        }

        $tabla = array("data" => $datos);

        echo json_encode($tabla);
    }

    public function agregarDetalleCotizacion() {
        $num_cotizacion = $_POST["num_cotizacion"];
        $objFactura = new FacturaModel();

        $sqlTipoCT = "SELECT * FROM encabezado_cotizacion_venta WHERE Numero_Documento = '$num_cotizacion' ";
        $tipoCT = $objFactura->Consultar($sqlTipoCT);

        if ($num_cotizacion != "") {
            if ($tipoCT[0]["Tipo_Documento"] == "CT") {
                $sqldetalle = "SELECT encabezado_cotizacion_venta.Numero_Ingreso, encabezado_cotizacion_venta.Orden_Compra, 
                ingreso_equipos.Detalle_De_Equipo, ingreso_equipos.Orden_Servicio, encabezado_cotizacion_venta.Tipo_Documento, 
                detalle_cotizacion_venta.Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, 
                detalle_cotizacion_venta.Cantidad, detalle_cotizacion_venta.Valor_Unitario, detalle_cotizacion_venta.Porcentaje_Descuento, 
                detalle_cotizacion_venta.Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva
                    FROM ingreso_equipos, detalle_cotizacion_venta, encabezado_cotizacion_venta, productos_servicios 
                            WHERE encabezado_cotizacion_venta.Numero_Ingreso=ingreso_equipos.Numero_Ingreso
                            AND encabezado_cotizacion_venta.Numero_Documento=detalle_cotizacion_venta.Numero_Documento
                            AND encabezado_cotizacion_venta.Tipo_Documento=detalle_cotizacion_venta.Tipo_Documento
                            AND encabezado_cotizacion_venta.NIT_Empresa=detalle_cotizacion_venta.NIT_Empresa
                            AND detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
                            AND detalle_cotizacion_venta.Numero_Documento='$num_cotizacion' ORDER BY Numero_Registro ASC";
            }else if ($tipoCT[0]["Tipo_Documento"] == "CTGER"){
                $sqldetalle = "SELECT encabezado_cotizacion_venta.Numero_Ingreso, encabezado_cotizacion_venta.Orden_Compra, 
                encabezado_cotizacion_venta.Tipo_Documento, 
                detalle_cotizacion_venta.Codigo_Producto, productos_servicios.Descripcion, detalle_cotizacion_venta.Detalle, 
                detalle_cotizacion_venta.Cantidad, detalle_cotizacion_venta.Valor_Unitario, detalle_cotizacion_venta.Porcentaje_Descuento, 
                detalle_cotizacion_venta.Valor_Iva, detalle_cotizacion_venta.Porcentaje_Iva
                    FROM detalle_cotizacion_venta, encabezado_cotizacion_venta, productos_servicios 
                        WHERE encabezado_cotizacion_venta.Numero_Documento=detalle_cotizacion_venta.Numero_Documento
                        AND encabezado_cotizacion_venta.Tipo_Documento=detalle_cotizacion_venta.Tipo_Documento
                        AND encabezado_cotizacion_venta.NIT_Empresa=detalle_cotizacion_venta.NIT_Empresa
                        AND detalle_cotizacion_venta.Codigo_Producto=productos_servicios.Codigo
                        AND detalle_cotizacion_venta.Numero_Documento='$num_cotizacion' ORDER BY Numero_Registro ASC";
            }

            $detalleCT = $objFactura->Consultar($sqldetalle);
        } else {
            $detalleCT = null;
        }

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios WHERE Indicativo='A' ORDER BY Descripcion";
        $servicios = $objFactura->Consultar($sqlserv);

        $subt = 0;
        $tsubt = 0;
        $i = 1;
        $dsto = 0;
        $tdsto = 0;
        $tiva = 0;
        $detalle_cotizacion = "";

        if ($detalleCT != null) {
            foreach ($detalleCT as $detalle) {
                $valor_Bruto = $detalle["Valor_Unitario"] * $detalle["Cantidad"];
                if ($detalle["Porcentaje_Descuento"] > 0) {
                    $destouno = $valor_Bruto * ($detalle["Porcentaje_Descuento"] / 100);
                    $subt = $valor_Bruto - $destouno;
                } else {
                    $destouno = 0;
                    $subt = $valor_Bruto;
                }

                $tsubt += $subt;
                $tdsto += $destouno;
                $tiva += $detalle["Valor_Iva"];

                $orden_compra = $detalle["Orden_Compra"];

                $detalle_cotizacion .= '
                <div id="options_productos" style="display: none;">
                    <option value="">Seleccione ...</option>';
                foreach ($servicios as $servicio) {
                    $detalle_cotizacion .= '<option value="' . $servicio["Codigo"] . '">' . $servicio["Descripcion"] . '</option>';
                }
                $detalle_cotizacion .= '
                </div>

                <div class="pt-2 pb-2 fila_DetalleGER row">

                    <div class="col-6">
                        <div class="row">
                            <input type="hidden" id="item' . $i . '" name="item[]" class="itemDetalle" value="' . $i . '">
                            <input type="hidden" name="numCT[]" value="' . $num_cotizacion . '">';

                            if ($detalle["Tipo_Documento"] == "CT") {
                                $detalle_cotizacion.='<input type="hidden" name="no_ingreso[]" value="' . $detalle["Numero_Ingreso"] . '">';
                                $orden_servicio=$detalle["Orden_Servicio"];
                            }else if ($detalle["Tipo_Documento"] == "CTGER"){
                                $detalle_cotizacion.='<input type="hidden" name="no_ingreso[]" value="' . null . '">';
                                $orden_servicio=null;
                            }

                            $detalle_cotizacion.='
                            <div class="col-6">
                                <select name="producto[]" id="producto' . $i . '" class="form-control select2 productos_servicios"
                                data-url="' . getUrl("Cotizaciones", "Cotizaciones", "obtenerIvaProductoServicio", false, "ajax") . '">
                                    <option value="">Seleccione ...</option>';
                                    foreach ($servicios as $servicio) {
                                        if ($servicio["Codigo"] == $detalle["Codigo_Producto"]) {
                                            $detalle_cotizacion .= '<option value="' . $servicio["Codigo"] . '" selected>' . $servicio["Descripcion"] . '</option>';
                                        } else {
                                            $detalle_cotizacion .= '<option value="' . $servicio["Codigo"] . '">' . $servicio["Descripcion"] . '</option>';
                                        }
                                    }
                                    $detalle_cotizacion .= '
                                </select>
                            </div>

                            <input type="hidden" name="iva[]" id="iva' . $i . '" class="ivaDetalle" value="' . $detalle["Porcentaje_Iva"] . '">
                            <input type="hidden" name="valoriva[]" id="valoriva' . $i . '" class="valorivaDetalle" value="' . $detalle["Valor_Iva"] . '">

                            <div class="p-0 col-6">
                                <input type="text" name="detalle[]" id="detalle' . $i . '" class="form-control" value="' . $detalle["Detalle"] . '">
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row">
                            <div class="col-3">
                                <input type="number" name="cant[]" id="cant' . $i . '" class="form-control text-center cantDetalle" value="' . $detalle["Cantidad"] . '">
                            </div>

                            <div class="p-0 col-3">
                                <input type="text" name="valor[]" id="valor' . $i . '" class="format form-control text-right valorDetalle" value="' . $detalle["Valor_Unitario"] . '">
                            </div>

                            <div class="col-3">
                                <input type="number" name="desc[]" id="desc' . $i . '" class="form-control text-center descDetalle" value="' . $detalle["Porcentaje_Descuento"] . '">
                            </div>

                            <div class="p-0 col-3">
                                <input type="text" name="subtotal[]" id="subtotal' . $i . '" class="format form-control text-right subtotalDetalle" value="' . $subt . '">
                            </div>
                        </div>
                    </div>

                    <div class="col-1 align-self-center">
                        <button type="button" class="btn btn-danger fa fa-minus btn_eliminarGER" title="Eliminar fila"></button>
                    </div>

                </div>';
                $i++;
            }

            $detalle_cotizacion .= '
            <script>
            $(".select2").select2({
                language: "es",
                width: "100%",
                theme: "bootstrap"
            });
            $(".format").each(function () {
                $(this).val(numeral($(this).val()).format("0,0"));
            });
            $(".format").on({
                "input": function (event) {
                    this.value = this.value.replace(/[^0-9]/g, "");
                },
                "keyup": function (event) {
                    let format = numeral($(event.target).val());
                    $(event.target).val(format.format("0,0"));
                }
            });
            </script>';
        }

        if ($detalle_cotizacion != null) {
            echo json_encode(
            array(
                "numCotizacion" => $num_cotizacion, 
                "detalleCotizacion" => $detalle_cotizacion, 
                "ordenCompra"=> $orden_compra, 
                "ordenServicio"=> $orden_servicio, 
                "estadoDetalle" => true)
            );
        } else {
            echo json_encode(array("estadoDetalle" => false));
        }
    }

    public function BuscarDetalleIngresoCT() {
        $nit_sede = $_POST["nit_sede"];
        $num_ingreso = $_POST["ingreso"];

        $objFactura = new FacturaModel();

        if ($num_ingreso != "") {
            $sqldetalle = "SELECT encabezado_cotizacion_venta.Numero_Ingreso, detalle_cotizacion_venta.Numero_Cotizacion,
                             detalle_cotizacion_venta.Tipo_Documento, Codigo_Producto, productos_servicios.Descripcion, 
                             detalle_cotizacion_venta.Detalle, detalle_cotizacion_venta.Cantidad, detalle_cotizacion_venta.Valor_Unitario, 
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
            $detalleCT = $objFactura->Consultar($sqldetalle);
        } else {
            $detalleCT = null;
        }

        $sqlserv = "SELECT Codigo, Descripcion, Porcentaje_Iva FROM productos_servicios where Indicativo='A'";
        $servicios = $objFactura->Consultar($sqlserv);

        include_once '../../views/Factura/GuiCargarDetalleCT.html.php';
    }

    public function AnularFactura() {
        $numFVC = $_POST['numFVC'];
        $tipo_doc = $_POST['tipo_doc'];
        $Razon_Anula = $_POST['Razon_Anula'];
        $nit_sede = $_POST['nit_sede'];
        $Usuario_Anula = $_SESSION['usua_id'];

        date_default_timezone_set('America/Bogota');
        $fecha = date("Y-m-d");
        $hora = "0000-00-00 " . date('h:i:s');
        $objFactura = new FacturaModel();
        $sqlFVC = "update encabezado_factura_venta set Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha', Hora_Anula='$hora', Razon_Anula='$Razon_Anula',  Estado_Documento='I'
                    WHERE Numero_Documento='$numFVC' and Tipo_Documento='$tipo_doc' and Nit_Empresa='$nit_sede'";
        $UpdateFVC = $objFactura->Anular($sqlFVC);
    }

    public function actualizarObservacionesFactura(){
        $numFVC = $_POST["numFVC"];
        $nit_sede = $_POST["nit_sede"];
        $observaciones = $_POST["observaciones"];
        $respuesta = array();

        $objFactura = new FacturaModel();

        $sqlObser = "UPDATE encabezado_factura_venta SET Observaciones = '$observaciones' 
                              WHERE Numero_Documento = '$numFVC' AND Nit_Empresa = '$nit_sede' AND Estado_Documento = 'A' ";
        $updateObser = $objFactura->Actualizar($sqlObser);

        if (mysqli_affected_rows($objFactura->conexion) > 0) {
            $respuesta["tipoRespuesta"]=true;
        }

        echo json_encode($respuesta);
    }

    public function copiasFactura() {
        $objFactura = new FacturaModel();
        $datos = array();

        $sqlParam = "SELECT * FROM parametros_sistema";
        $paramSistem = $objFactura->Consultar($sqlParam);

        foreach ($paramSistem as $parametros) {
            array_push($datos, array(
                $parametros["Circularizacion1"], $parametros["Circularizacion2"], $parametros["Circularizacion3"],
            ));
        }
        echo json_encode(array("Circularizacion" => $datos));
    }

}
