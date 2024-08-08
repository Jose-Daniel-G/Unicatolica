<?php
@include_once "../../app/Model/Utilidades/UtilidadesModel.php";

class UtilidadesController {

    public function CalcularValorHoraTrabajoEmpleado($salario, $porcentaje_incremento, $dminutos, $QueEs) {

        if ($QueEs == "R") {
            $porcentaje_incremento = $porcentaje_incremento / 100;
        } else {
            if ($porcentaje_incremento < 100) {
                $porcentaje_incremento = 1 + ($porcentaje_incremento / 100);
            }

            if ($porcentaje_incremento >= 100) {
                $porcentaje_incremento = $porcentaje_incremento / 100;
            }
        }

        $priv_valorH = $salario / 240;
        $priv_valorHora = ($priv_valorH * ($dminutos / 60) * $porcentaje_incremento) * 100;

        return $priv_valorHora;
    }

    public function RecuperarPotenciaVelocidadVoltaje($oi, $nit_sede) {
        $objUtilidades = new UtilidadesModel();
        $priv_sqlEqui = "SELECT concat(Potencia,' - ', Unidad_De_Potencia) as Potencia,  Revoluciones_Por_Minuto, Voltaje, tipos_equipos.Descripcion
                    FROM detalle_equipo NATURAL JOIN equipos natural join ingreso_equipos  natural join tipos_equipos
                        WHERE Numero_Ingreso='$oi' and Nit_Empresa='$nit_sede'";
        $priv_equipo = $objUtilidades->Consultar($priv_sqlEqui);
        if ($priv_equipo != null) {
            $equipo = $priv_equipo;
        } else {
            $equipo[] = array(
                'Potencia' => "",
                'Revoluciones_Por_Minuto' => "",
                'Voltaje' => "",
            );
        }
        // $objUtilidades->closeConect();

        return $equipo;
    }

    //Ojo Doneya Preguntar como dejar generica     //Doneya Julio 18 de 2018

    public function BuscarPotenciaVelocidadVoltaje() {
        extract($_POST);

        $objUtilidades = new UtilidadesModel();
        $sqlDetalle = "SELECT CONCAT(Potencia,' - ', Unidad_De_Potencia) AS Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va FROM detalle_equipo NATURAL JOIN ingreso_equipos
                        WHERE Numero_Ingreso='$Numero_Ingreso' AND Nit_Empresa='$Nit_Empresa' LIMIT 1";
        $detalleEqui = $objUtilidades->Consultar($sqlDetalle);
        
        if ($detalleEqui != null) {
            foreach ($detalleEqui as $detalle) {
                if ($detalle["Voltaje"] != "") {
                    $Voltaje=$detalle["Voltaje"];
                }else if($detalle["V_Primario"] != ""){
                    $Voltaje=$detalle["V_Primario"];
                }else if($detalle["Va"] != ""){
                    $Voltaje=$detalle["Va"];
                }else if($detalle["Voltaje"] == "" && $detalle["V_Primario"] == "" && $detalle["Va"] == ""){
                    $Voltaje=null;
                }
                if ($detalle["Revoluciones_Por_Minuto"] != "") {
                    $Velocidad=$detalle["Revoluciones_Por_Minuto"];
                }else if($detalle["Velocidad_Parte"] != ""){
                    $Velocidad=$detalle["Velocidad_Parte"];
                }else if($detalle["Revoluciones_Por_Minuto"] == "" && $detalle["Velocidad_Parte"] == ""){
                    $Velocidad=null;
                }

               $equipo = array(
                    "numero_ingreso" => $Numero_Ingreso,
                    "potencia" => $detalle["Potencia"],
                    "velocidad" => $Velocidad,
                    "voltaje" => $Voltaje,
                );
            }
        }else{
            $equipo = null;
        }
        echo json_encode($equipo);
    }

    public function CalcularDiasEntreDosFechas($fecha_Max, $fecha_Min) {
        //echo"max $fecha_Max --- MIn $fecha_Min <br>";
        $cad_fecha = explode("-", $fecha_Min);
        $exp_ano = $cad_fecha[0];
        $exp_mes = $cad_fecha[1];
        $exp_dia = $cad_fecha[2];

        $cad_fecha2 = explode("-", $fecha_Max);
        $exp_ano2 = $cad_fecha2[0];
        $exp_mes2 = $cad_fecha2[1];
        $exp_dia2 = $cad_fecha2[2];

        //calculo timestam de las dos fechas
        $timestampMax = mktime(0, 0, 0, $exp_mes2, $exp_dia2, $exp_ano2);
        $timestampMin = mktime(0, 0, 0, $exp_mes, $exp_dia, $exp_ano);

        //resto a una fecha la otra
        $segundos_diferencia = $timestampMax - $timestampMin;

        //convierto segundos en días
        $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

        $dias = floor($dias_diferencia);
        return $dias;

    }

    public function BuscarFechaOrdenEjecucion($oi) {
        $objUtilidades = new UtilidadesModel();
        $consOe = "select fecha_creada from orden_trabajo where numero_ingreso='$oi' and estado='A'";
        $OE = $objUtilidades->Consultar($consOe);

        if ($OE != null) {
            $fechaOE = substr($OE[0][0], 0, 10);
        } else {
            //la necesito en cif
            $fechaOE = "";
        }
        // $objUtilidades->closeConect();
        return $fechaOE;
    }

    public function BuscarFechaRemision($oi) {
        $objUtilidades = new UtilidadesModel();
        $consRM = "select fecha_Documento from encabezado_documento_venta where numero_ingreso='$oi' and tipo_documento='RM' and estado_documento='A'";
        $RM = $objUtilidades->Consultar($consRM);
        if ($RM != null) {
            $fechaRM = substr($RM[0][0], 0, 10);
        } else {
            $fechaRM = "";
        }
        // $objUtilidades->closeConect();
        return $fechaRM;
    }

    public function BuscarFechaEntrega($oi) {
        $objUtilidades = new UtilidadesModel();
        $consOe = "select fecha_entrega from encabezado_documento_venta where numero_ingreso='$oi' and tipo_documento='RM' and estado_documento='A'";
        $Entrega = $objUtilidades->Consultar($consOe);
        if ($Entrega != null) {
            $fechaE = substr($Entrega[0][0], 0, 10);
        } else {
            $fechaE = "No Hay";
        }

        // $objUtilidades->closeConect();
        return $fechaE;
    }

    public function CalcularNoDiasOidesdeOeaFechaEntrega($fechae, $fechaOe) {
        $objUtilidades = new UtilidadesModel();
        if ($fechaOe != null and $fechae != "No Hay") {

            $dias = $this->CalcularDiasEntreDosFechas($fechaOe, $fechae);
        } else {
            $dias = "No hay Datos";
        }
        // $objUtilidades->closeConect();
        return $dias;
    }

    public function BuscarDiasPrometidosalClienteenCT($oi) {
        $objUtilidades = new UtilidadesModel();
        $consCT = "select prioridad from encabezado_cotizacion_venta where tipo_documento='CT' and numero_ingreso='$oi'";
        $dCT = $objUtilidades->Consultar($consCT);
        if ($dCT != null) {
            $diasCT = $dCT[0][0];
        } else {
            $diasCT = "No Hay";
        }

        //$objUtilidades->closeConect();
        return $diasCT;
    }

    public function CalculaNoDiasOienPlanta($fechaE, $fechaoi) {

        if ($fechaE != null) {
            $diasPlanta = $this->CalcularDiasEntreDosFechas($fechaoi, $fechaE);
        } else {
            $fechaact = date('Y-m-d');
            $diasPlanta = $this->CalcularDiasEntreDosFechas($fechaoi, $fechaact);
        }

        return $diasPlanta;
    }

    public function BuscarValorRefereciaCostosAlmacenamiento($mes, $ayo) {
        $objUtilidades = new UtilidadesModel();
        $consRA = "select valor from referencias_costos_almacenamiento where Mes='$mes' and Ayo='$ayo'";
        $RA = $objUtilidades->Consultar($consRA);
        if ($RA != null) {
            $priv_Vra = $RA[0][0];
        } else {
            $priv_Vra = 0;
        }
        // $objUtilidades->closeConect();

        return $priv_Vra;
    }

    public function CalcularDiasAlmacenamiento($oi) {
        $ObjUtilidades = new UtilidadesModel();
        $consRM = "Select Fecha_Entrega, Fecha_Documento from encabezado_documento_venta where Numero_Ingreso='$oi' and tipo_documento='RM' and estado_documento='A'";
        $priv_fechaRM = $ObjUtilidades->Consultar($consRM);
        if ($priv_fechaRM != null) {
            if ($priv_fechaRM[0][0] != null) {
                $fechaini = substr($priv_fechaRM[0][0], 0, 10);
                $fechafin = substr($priv_fechaRM[0][1], 0, 10);
                $diasA = $this->CalcularDiasEntreDosFechas($fechaini, $fechafin);

                if ($diasA == 0) {
                    $diasA = 1;

                }

            } else {
                $fechaini = substr($priv_fechaRM[0][1], 0, 10);
                $fechaact = date('Y-m-d');
                $diasA = $this->CalcularDiasEntreDosFechas($fechaini, $fechaact);
            }

        } else {
            $diasA = 0;
        }

        //$ObjUtilidades->closeConect();
        return $diasA;
    }

    public function BuscarTamañoCif($oi) {
        $ObjUtilidades = new UtilidadesModel();
        $consCif = "Select Tamayo_Cif from ingreso_equipos where Numero_Ingreso='$oi'";
        $priv_Cif = $ObjUtilidades->Consultar($consCif);
        if ($priv_Cif != null) {
            $cif = $priv_Cif[0][0];
        } else {
            $cif = 0;
        }
        // $ObjUtilidades->closeConect();

        return $cif;
    }

    public function BuscarTamaCifYFechaRM($oi) {
        $ObjUtilidadess = new UtilidadesModel();
        $cons = "select fecha_Documento, Tamayo_Cif, fecha_creada
                    from encabezado_documento_venta as A, Ingreso_equipos as B, orden_trabajo as C
                        where  A.Numero_Ingreso=B.Numero_Ingreso
                            and  B.Numero_Ingreso=C.Numero_Ingreso
                            and A.numero_ingreso='$oi'
                            and tipo_documento='RM'
                            and estado_documento='A'";
        $dato = $ObjUtilidadess->Consultar($cons);
        if ($dato != null) {

        } else {

        }

        // $ObjUtilidadess->closeConect();
        return $dato;
    }

    public function VerificarSiOutsourcingPuro($oi) {
        $ObjUtilidadess = new UtilidadesModel();
        $conout = "select * from detalle_tipos_equipos_out where Numero_Ingreso='$oi'";
        $regOut = $ObjUtilidadess->Consultar($conout);

        if ($regOut != null) {
            $priv_out = "Si";
        } else {
            $priv_out = "No";
        }
        //$ObjUtilidadess->closeConect();
        return $priv_out;

    }

    public function CalcularNoDiasAlmacenamientoTodasOi($mes, $ayo) {
        $ObjUtilidadess = new UtilidadesModel();
        $ObjUtilidades = new UtilidadesController();
        $fechRM = "";
        $constoasOi = "select A.Numero_Ingreso as Numero_Ingreso, B.fecha_entrega,B.fecha_Documento, A.Tamayo_Cif from ingreso_equipos as A, encabezado_documento_venta as B
                        where month(Fecha_Ingreso)='$mes'
                         and year(fecha_ingreso)='$ayo' and Estado='A' and A.Numero_Ingreso=B.Numero_Ingreso and Tipo_documento='RM' and Estado_documento='A' order by A.Numero_ingreso";
        $todas_OI = $ObjUtilidadess->Consultar($constoasOi);

        $contOI = 0;
        $contOk = 0;
        $Ndias = 0;
        $totDias = 0;
        $totTam = 0;
        $estadOut = "";
        if ($todas_OI != null) {
            foreach ($todas_OI as $todasOI) {
                $estadOut = $this->VerificarSiOutsourcingPuro($todasOI[0]);

                if ($estadOut == "No") {
                    $contOI++;
                    $fechRM = substr($todasOI[2], 0, 10);
                    $fechEntrCli = substr($todasOI[1], 0, 10);
                    if ($fechEntrCli != "" and $fechRM != "") {
                        $Ndias = $ObjUtilidades->CalcularDiasEntreDosFechas($fechEntrCli, $fechRM);
                        $totDias += $Ndias;
                        $contOk++;

                        $totTam += round($todasOI[3], 2);
                    }

                }

            }
        }

        $totalAlma[0] = $totDias;
        $totalAlma[1] = $totTam;
        // $ObjUtilidadess->closeConect();
        return $totalAlma;
    }

    public function BuscarFechaCierreCIFunIngreso($oi) {
        $ObjUtilidadess = new UtilidadesModel();
        $consCV = "select fecha_cierre_virtual from cierre_virtual_cif where Numero_Ingreso='$oi'";
        $regCV = $ObjUtilidadess->Consultar($consCV);
        if ($regCV != null) {
            $priv_cierre = substr($regCV[0][0], 0, 10);
        } else {
            $consCN = "select fecha_cierre_cif from Ingreso_equipos where Numero_Ingreso='$oi' ";
            $regCN = $ObjUtilidadess->Consultar($consCN);
            if ($regCN) {
                $priv_cierre = substr($regCN[0][0], 0, 10);
            } else {
                $priv_cierre = date('Y-m-d');
            }
        }

        // $ObjUtilidadess->closeConect();
        return $priv_cierre;
    }

    public function BuscarValorTiempoReferenciaCif($mes, $ayo) {
        $ObjUtilidades = new UtilidadesModel();
        $cons = "select valortiempo from referencia_cif where mes='$mes' and ayo='$ayo' order by UnNegocio";
        $regcons = $ObjUtilidades->Consultar($cons);
        if ($regcons != null) {
            $valorRCif = $regcons;
        } else {
            $valorRCif = null;
        }
        // $ObjUtilidades->closeConect();
        return $valorRCif;
    }

    public function BuscarValorTamanoReferenciaCif($Uneg, $mes, $ayo) {
        $ObjUtilidades = new UtilidadesModel();
        $cons = "select valortamayo from referencia_cif where unnegocio='$Uneg' and mes='$mes' and ayo='$ayo'";
        $regcons = $ObjUtilidades->Consultar($cons);
        if ($regcons != null) {
            $valorTCif = $regcons[0][0];
        } else {
            $valorTCif = 0;
        }

        // $ObjUtilidades->closeConect();
        return $valorTCif;
    }

    public function BuscarPorcentajeInductorUN($Uneg) {
        $ObjUtilidades = new UtilidadesModel();
        $cons = "select porcentaje_inductor_costo from unidades_negocio where Codigo='$Uneg'";
        $regcons = $ObjUtilidades->Consultar($cons);
        if ($regcons[0][0] != "") {
            $valorIUN = $regcons[0][0];
        } else {
            $valorIUN = 0;
        }

        //$ObjUtilidades->closeConect();
        return $valorIUN;
    }

    public function BuscarIngresosCerradosMes($mes, $ayo, $Uneg, $oi) {
        $ObjUtilidades = new UtilidadesModel();
        $cons = "select Numero_Ingreso
                        from ingreso_equipos as A, tiempo_actividades_produccion as B
                            where A.Numero_Ingreso=B.Ingreso and Month(fecha_cierre_cif)='$mes'
                                and year(fecha_cierre_cif)='$ayo' and unidad_negocio='$Uneg' and estado='A' $oi  and isnull(AfectarCifs) group by numero_ingreso";
        $IngresosC = $ObjUtilidades->Consultar($cons);
        // $ObjUtilidades->closeConect();
        return $IngresosC;
    }

    public function BuscarPorcentajeParafiscales() {
        $ObjUtilidadess = new UtilidadesModel();
        $conspara = "SELECT Porcentaje_Parafiscales FROM parametros_sistema";
        $parafis = $ObjUtilidadess->Consultar($conspara);

        if ($parafis != null) {
            $para = $parafis[0][0];
        } else {
            $para = 0;
        }

        //$ObjUtilidadess->closeConect();
        return $para;
    }

    public function RecuperarInfoEquipoconOI() {
        $oi = $_POST['oi'];
        $objUtilidades = new UtilidadesModel();
        $priv_sqlEqui = "SELECT Numero_Ingreso, razon_social, ingreso_equipos.Fecha_Ingreso, tipos_equipos.Descripcion, Potencia, Revoluciones_Por_Minuto, Voltaje, Amperaje, Unidad_De_Potencia
                                FROM ingreso_equipos, equipos, clientes, tipos_equipos, detalle_equipo
                                    where ingreso_equipos.Numero_Serie=equipos.Numero_Serie
                                        and equipos.Nit_Cliente=clientes.Nit_Cliente
                                        and equipos.Codigo_Tipo_Equipo=tipos_equipos.Codigo_Tipo_Equipo
                                        and detalle_equipo.Numero_Serie=equipos.Numero_Serie and ingreso_equipos.Numero_Ingreso='$oi'";
        $priv_equipo = $objUtilidades->Consultar($priv_sqlEqui);
        //dd($priv_equipo);
        if ($priv_equipo != null) {
            $fechaOE = $this->BuscarFechaOrdenEjecucion($oi);
            $fechaE = $this->BuscarFechaEntrega($oi);
            $difOeE = $this->CalcularNoDiasOidesdeOeaFechaEntrega($fechaOE, $fechaE);
            $dprometidos = $this->BuscarDiasPrometidosalClienteenCT($oi);
            $dplanta = $this->CalculaNoDiasOienPlanta(substr($priv_equipo[0][2], 0, 10), $fechaE);

        }
        // $objUtilidades->closeConect();
        include_once '../../views/CostosABC/GuiVerOi.html.php';

    }

    
    public function ModalBuscarIngresos() {
        $objIngresos = new UtilidadesModel();
        $sqlsede = "select nit_empresa, nombre from sedes order by nombre";
        $sedes = $objIngresos->Consultar($sqlsede);
        
        $sqlempresa = "select Nit_Cliente, Razon_Social from clientes order by Razon_Social ";
        $empresas = $objIngresos->Consultar($sqlempresa);
        include_once '../../views/BuscarDocumento/Gui_ModalBuscarIngreso.html.php';
    }

    public function ListarIngresos() {
        extract($_POST);
        $condicion = "";
        
        $objIngreso = new UtilidadesModel();
        
        (empty($fecha_desde)) ? $fecha_desde = "" : null;
        (empty($fecha_hasta)) ? $fecha_hasta = "" : null;
        (empty($nit_empresa)) ? $nit_empresa = "" : null;
        (empty($numero_serie)) ? $numero_serie = "" : null;
        (empty($numero_ref)) ? $numero_ref = "" : null;
        (empty($numero_ingreso)) ? $numero_ingreso = "" : null;
        (empty($estado_doc)) ? $estado_doc = "" : null;
        (empty($nit_sede)) ? $nit_sede = "" : null;

        if ($fecha_desde != "" and $fecha_hasta != "") {
            $condicion = " AND ingreso_equipos.Fecha_Ingreso BETWEEN ('$fecha_desde') AND ('$fecha_hasta')";
        }
        if ($nit_empresa != "" and $nit_empresa != "undefined") {
            $condicion .= " AND clientes.Nit_Cliente='$nit_empresa'";
        }
        if ($numero_serie != "") {
            $condicion = " AND ingreso_equipos.Numero_Serie='$numero_serie'";
        }
        if ($numero_ref != "") {
            $condicion = " AND ingreso_equipos.Referencia='$numero_ref'";
        }
        if ($numero_ingreso != "") {
            $condicion = " AND ingreso_equipos.Numero_Ingreso='$numero_ingreso'";
        }
        if ($nit_sede != "") {
            $condicion .= " AND ingreso_equipos.Nit_Empresa='$nit_sede'";
        }
        if ($estado_doc<>"" && $estado_doc == "T") {
            $estado_doc = null;
        }
        
        $sqlDoc = "SELECT Numero_Ingreso, DATE_FORMAT(Fecha_Ingreso, '%Y-%m-%d') AS Fecha_Ingreso, ingreso_equipos.Numero_Serie, tipos_equipos.Descripcion, clientes.Nit_Cliente, clientes.Razon_Social, ingreso_equipos.Nit_Empresa, tipo_ingreso, ingreso_equipos.Estado
                            FROM ingreso_equipos, equipos, tipos_equipos, clientes
                            WHERE ingreso_equipos.Numero_Serie=equipos.Numero_Serie
                            AND equipos.Codigo_Tipo_Equipo=tipos_equipos.Codigo_Tipo_Equipo
                            AND equipos.Nit_Cliente=clientes.Nit_Cliente AND ingreso_equipos.Estado LIKE '%$estado_doc%'
                            $condicion ORDER BY Numero_Ingreso DESC";
        $ingresos = $objIngreso->Consultar($sqlDoc);
        
        $datos = array();

        if ($ingresos != null) {
            foreach ($ingresos as $documento) {
                array_push($datos,
                    array(
                        "botonVerIngreso" => '<button data-url="'.getUrl("Ingresos", "Ingresos", "buscarDocumentosIngreso", false, "ajax").'" class="href">'.$documento["Numero_Ingreso"].'</button>',
                        "numero_ingreso" => $documento["Numero_Ingreso"], 
                        "nit_empresa"       => $documento["Nit_Empresa"], 
                        "nit_cliente"      => $documento["Nit_Cliente"], 
                        "razon_social"      => $documento["Razon_Social"], 
                        "tipo_ingreso" => $documento["tipo_ingreso"],
                        "fecha_ingreso" => $documento["Fecha_Ingreso"],
                        "numero_serie" => $documento["Numero_Serie"],
                        "descripcion" => $documento["Descripcion"],
                        "potencia" => '<span id="tdIngPotencia' . $documento["Numero_Ingreso"] . '"></span>',
                        "velocidad" => '<span id="tdIngVelocidad' . $documento["Numero_Ingreso"] . '"></span>',
                        "voltaje" => '<span id="tdIngVoltaje' . $documento["Numero_Ingreso"] . '"></span>',
                        "estado" => $documento["Estado"],
                    ));
                }
            }
            $tabla = array("data" => $datos);
            
            echo json_encode($tabla);
        }
        
        public function ModalBuscarDocumento() {
            $objCotizacion = new UtilidadesModel();
            $sqlempresa = "select Nit_Cliente, Razon_Social from clientes order by Razon_Social ";
            $empresas = $objCotizacion->Consultar($sqlempresa);
    
            $sqltipo_doc = "select  td_sigla, td_descripcion from tipos_documentos where td_estado='A' order by td_descripcion ";
            $tipos_doc = $objCotizacion->Consultar($sqltipo_doc);
    
            $sqlsede = "select  nit_empresa, nombre from sedes  order by nombre ";
            $sedes = $objCotizacion->Consultar($sqlsede);
            include_once '../../views/BuscarDocumento/Gui_ModalBuscarDocumento.html.php';
        }

        public function ListarDocumentos() {
            extract($_POST);
            $condicion = "";

            $objCotizacion = new UtilidadesModel();
    
                if ($tipo_doc == "CT" or $tipo_doc == "FV" or $tipo_doc == "FVC" or $tipo_doc == "FCT" or $tipo_doc == "PL" or $tipo_doc == "GD" or $tipo_doc=="OT" or $tipo_doc=="IT" or $tipo_doc=="OC" or $tipo_doc == "RM") {
                    if ($fecha_desde != "" and $fecha_hasta != "") {
                        if ($tipo_doc == "OT") {
                            $condicion .= " AND orden.Fecha_Creada BETWEEN ('$fecha_desde') AND ('$fecha_hasta')";
                        }else{
                            $condicion .= " AND edv.Fecha_Documento BETWEEN ('$fecha_desde') AND ('$fecha_hasta')";
                        }
                    }
    
                if ($nit_empresa != "") {
                    $condicion .= " AND cli.Nit_Cliente='$nit_empresa'";
                }
    
                if ($tipo_doc != "") {
                    if ($tipo_doc == "FCT") {
                        $condicion .= " AND (edv.Tipo_Documento='FV' OR edv.Tipo_Documento='FVC')";
                    } else if ($tipo_doc == "CT" || $tipo_doc == "OC") {
                        $condicion .= " AND (edv.Tipo_Documento='CT' OR edv.Tipo_Documento='CTGER')";
                    }else if($tipo_doc == "OT" || $tipo_doc == "GD" || $tipo_doc == "IT"){
                        $condicion .= "";
                    }
                    else {
                        $condicion .= " AND edv.Tipo_Documento='$tipo_doc'";
                    }
                }
    
                if ($numero_doc != "") {
                    if ($tipo_doc == "OT") {
                        $condicion .= " AND orden.Numero_Orden='$numero_doc'";
                    }else if($tipo_doc == "OC"){
                       $condicion .= " AND edv.Orden_Compra = '$numero_doc'";
                    }else if ($tipo_doc != "OT"){
                        $condicion .= " AND edv.Numero_Documento='$numero_doc'";
                    }
                }
                
                if ($numero_ingreso != "") {
                    if($tipo_doc == "OT"){
                        $condicion .= " AND orden.Numero_Ingreso='$numero_ingreso'";
                    }else{
                        $condicion .= " AND edv.Numero_Ingreso='$numero_ingreso'";
                    }
                }
    
                if ($nit_sede != "") {
                    if ($tipo_doc == "OT") {
                        $condicion .= " AND orden.Nit_Empresa='$nit_sede'";
                    }else{
                        $condicion .= " AND edv.Nit_Empresa='$nit_sede'";
                    }
                }
                
                if ($estado_doc<>"" && $estado_doc == "T") {
                    $estado_doc = null;
                }

                if ($tipo_doc == "CT" || $tipo_doc == "OC") {

                    $sqlDoc = "SELECT edv.Numero_Documento, DATE_FORMAT(edv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, cli.Razon_Social, edv.Numero_Ingreso, edv.Estado_Documento, CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario,
                    edv.Tipo_Documento, edv.Nit_Empresa, sede.nombre AS Sede
                    FROM encabezado_cotizacion_venta AS edv, clientes AS cli, usuarios AS usu, sedes AS sede
                    WHERE edv.Nit_Cliente=cli.Nit_Cliente
                    AND edv.Usuario_Crea=usu.Cedula
                    AND edv.Nit_Empresa=sede.nit_empresa AND edv.Estado_Documento LIKE '%$estado_doc%' 
                    $condicion ORDER BY edv.Fecha_Documento DESC, edv.Numero_Documento DESC";
                }else if($tipo_doc == "FVC" || $tipo_doc == "FCT"){

                    $sqlDoc = "SELECT edv.Numero_Documento, DATE_FORMAT(edv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, cli.Razon_Social,
                        ddv.Numero_Ingreso, edv.Tipo_Documento, edv.Nit_Empresa, sede.nombre AS Sede, edv.Estado_Documento, CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario
                        FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv,
                        clientes AS cli, sedes AS sede, usuarios AS usu WHERE ddv.Numero_Documento = edv.Numero_Documento
                        AND ddv.NIT_Empresa = edv.NIT_Empresa AND edv.NIT_Empresa=cli.Nit_Empresa
                        AND edv.Nit_Cliente=cli.Nit_Cliente AND edv.Nit_Empresa=sede.nit_empresa
                        AND usu.cedula=edv.Usuario_Crea
                        AND edv.Estado_Documento LIKE '%$estado_doc%'
                        $condicion GROUP BY ddv.Numero_Documento DESC, ddv.Numero_Ingreso";
                }else if($tipo_doc == "PL" || $tipo_doc == "RM"){

                    $sqlDoc = "SELECT edv.Numero_Documento, DATE_FORMAT(edv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, cli.Razon_Social, edv.Numero_Ingreso, edv.Estado_Documento, CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario,
                    edv.Tipo_Documento, edv.Nit_Empresa, sede.nombre AS Sede
                    FROM encabezado_documento_venta AS edv, clientes AS cli, usuarios AS usu, sedes AS sede
                    WHERE edv.Nit_Cliente=cli.Nit_Cliente
                    AND edv.Usuario_Crea=usu.Cedula
                    AND edv.Nit_Empresa=sede.nit_empresa AND edv.Estado_Documento LIKE '%$estado_doc%' 
                    $condicion ORDER BY edv.Fecha_Documento DESC, edv.Numero_Documento DESC";
                }else if($tipo_doc == "GD"){

                    $sqlDoc = "SELECT edv.Numero_Documento, DATE_FORMAT(edv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, cli.Razon_Social, edv.Numero_Ingreso, edv.Estado_Documento, CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario,
                    edv.Nit_Empresa, sede.nombre AS Sede
                    FROM encabezado_gastosdirectos AS edv, clientes AS cli, usuarios AS usu, sedes AS sede
                        WHERE edv.Nit_Cliente=cli.Nit_Cliente
                        AND edv.Usuario_Crea=usu.Cedula
                        AND edv.Nit_Empresa=sede.nit_empresa AND edv.Estado_Documento LIKE '%$estado_doc%' 
                        $condicion ORDER BY edv.Fecha_Documento DESC, edv.Numero_Documento DESC";
                }else if($tipo_doc == "OT"){

                    $sqlDoc="SELECT orden.Numero_Ingreso, orden.Numero_Orden, orden.Tipo_Orden, cli.Razon_Social, equi.Nit_Cliente,
                    DATE_FORMAT(orden.Fecha_Creada, '%Y-%m-%d') AS Fecha_Creada, 
                    CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario, orden.Nit_Empresa, orden.Estado, 
                    sede.nombre AS Sede FROM orden_trabajo AS orden, ingreso_equipos AS ing, 
					equipos AS equi, clientes AS cli, sedes AS sede, usuarios AS usu
					WHERE ing.Numero_Serie=equi.Numero_Serie AND equi.Nit_Cliente=cli.Nit_Cliente 
					AND orden.Numero_Ingreso=ing.Numero_Ingreso AND ing.Numero_Serie=equi.Numero_Serie
                    AND orden.Usuario_Crea=usu.Cedula AND orden.Nit_Empresa=sede.nit_empresa
                    AND orden.Nit_Empresa=cli.Nit_Empresa AND orden.Estado LIKE '%$estado_doc%' $condicion
					ORDER BY orden.Fecha_Creada, orden.Numero_Orden DESC";    
                }else if($tipo_doc == "IT"){

                    $sqlDoc="SELECT edv.Numero_Ingreso, edv.Numero_Documento, cli.Razon_Social, equi.Nit_Cliente,
                    DATE_FORMAT(edv.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, 
                    CONCAT(usu.Nombres, ' ', usu.apellidos) AS Usuario, edv.Nit_Empresa, edv.Estado_Documento, 
                    sede.nombre AS Sede FROM informe_tecnico_reparacion_pruebas AS edv, ingreso_equipos AS ing, 
					equipos AS equi, clientes AS cli, sedes AS sede, usuarios AS usu
					WHERE equi.Nit_Cliente=cli.Nit_Cliente AND edv.Numero_Ingreso=ing.Numero_Ingreso 
                    AND ing.Numero_Serie=equi.Numero_Serie AND edv.Usuario_Crea=usu.Cedula 
                    AND edv.Nit_Empresa=sede.nit_empresa AND edv.Nit_Empresa=cli.Nit_Empresa 
                    AND edv.Estado_Documento LIKE '%$estado_doc%' $condicion 
                    ORDER BY edv.Fecha_Documento, edv.Numero_Documento DESC";    
                }

            } else {
                if ($tipo_doc == "EB") {
                    if ($sin_fecha == "") {
                        if ($fecha_desde != "" and $fecha_hasta != "") {
                            $condicion = " AND DATE_FORMAT(Fecha_Documento, '%d-%m-%Y') AS Fecha_Documento, BETWEEN ('$fecha_desde') AND ('$fecha_hasta')";
                        }
                    }
    
                    if ($nit_sede != "") {
                        $condicion .= " AND proveedores.Nit_Proveedor='$nit_sede'";
                    }
    
                    if ($tipo_doc != "") {
                        $condicion .= " AND Tipo_Documento='$tipo_doc'";
                    }
    
                    if ($numero_doc != "") {
                        $condicion .= " AND No_Documento='$numero_doc'";
                    }
    
                    if ($numero_ingreso != "") {
                        $condicion .= " AND Numero_Ingreso='$numero_ingreso'";
                    }
    
                    if ($nit_empresa != "") {
                        $condicion .= " AND EB.Nit_Empresa='$nit_empresa'";
                    }
    
                    if ($estado_doc != "") {
                        $condicion .= " AND EB.Estado_Documento='$estado_doc'";
                    }
    
                    $sqlDoc = "SELECT No_Documento AS Numero_Documento, DATE_FORMAT(Fecha_Documento, '%d-%m-%Y') AS Fecha_Documento, Razon_Social, Numero_Ingreso, Estado_Documento, CONCAT(Nombres, ' ', apellidos) AS Usuario, Tipo_Documento, sedes.nombre AS Sede, EB.Nit_Empresa
                                FROM encabezado_e_s_bodega AS EB, sedes, proveedores, usuarios
                                    WHERE EB.Nit_Proveedor=proveedores.Nit_Proveedor AND EB.Nit_Empresa=sedes.nit_empresa AND EB.Usuario_Crea=usuarios.Cedula $condicion ORDER BY No_Documento DESC";
                } else {
                if($tipo_doc=="FD"){
                    if($sin_fecha ==""){
                        if($fecha_desde <> "" and $fecha_hasta <> ""){
                            $condicion=" AND Fecha_Documento between ('$fecha_desde') AND ('$fecha_hasta')";
                        }
                    }
    
                if($nit_sede <> ""){
                    $condicion.=" AND proveedores.Nit_Proveedor='$nit_sede'";
                }
    
                if($tipo_doc <> ""){
                    $condicion.=" AND Tipo_Documento='$tipo_doc'";
                }
    
                if($numero_doc <>""){
                    $condicion.=" AND Numero_Documento='$numero_doc'";
                }
    
                if($numero_ingreso <> ""){
                    $condicion.=" AND Numero_Ingreso='$numero_ingreso'";
                }
                    $sqlDoc="SELECT No_Documento AS Numero_Documento, Fecha_Documento, Fecha_Documento AS hora, Razon_Social, Numero_Ingreso, Estado_Documento, Usuario_Crea, Tipo_Documento, EB.Nit_Empresa
                    FROM encabezado_e_s_bodega as EB, proveedores
                    WHERE EB.Nit_Proveedor=proveedores.Nit_Proveedor $condicion  ";
                }
            }
        }

            $documentos = $objCotizacion->Consultar($sqlDoc);

            $datos = array();

            if ($documentos != null) {
                switch($tipo_doc){

                    case "PL":
                        $data_url=getUrl("Preliquidacion", "Preliquidacion", "Preliquidacion");
                    break;

                    case "CT":
                        $data_url=getUrl("Cotizaciones", "Cotizaciones", "Cotizacion");
                    break;

                    case "RM":
                        $data_url=getUrl("Remisiones", "Remisiones", "Remision");
                    break;

                    case "FVC":
                        $data_url=getUrl("Factura", "Factura", "Factura");
                    break;

                    case "FCT":
                        $data_url=getUrl("Factura", "Factura", "Factura");
                    break;

                    case "GD":
                        $data_url=getUrl("GastosDirectos", "GastosDirectos", "GastoDirectoFabricacion");
                    break;

                    case "OT":
                        $data_url=getUrl("OrdenTrabajo", "OrdenTrabajo", "OrdenTrabajo");
                    break;

                    case "IT":
                        $data_url=getUrl("Informes", "Informes", "InformeTecnico");
                    break;

                    case "OC":
                        $data_url=getUrl("Cotizaciones", "Cotizaciones", "Cotizacion");
                    break;
                    
                    case "EB":
                        $data_url=getUrl("EntradaBodega", "EntradaBodega", "EntradaBodega");
                    break;

                    default:
                        $data_url="index.php";
                    break;
                }
                
                foreach ($documentos as $documento) {
                    if ($tipo_doc == "OT") {
                        array_push($datos,
                        array(
                            "urlDoc" => ''.$data_url.'&numero_doc='.$documento["Numero_Orden"].'&nit_sede='.$documento["Nit_Empresa"].'',
                            "botonVerDoc" => '<button class="href">'.$documento["Numero_Orden"].'</button>',
                            "numero_documento" => $documento["Numero_Orden"],
                            "tipo_orden" => $documento["Tipo_Orden"],
                            "nit_sede" => $documento["Nit_Empresa"],
                            "fecha_documento" => $documento["Fecha_Creada"],
                            "razon_social" => $documento["Razon_Social"],
                            "numero_ingreso" => $documento["Numero_Ingreso"],
                            "usuario_crea" => $documento["Usuario"],
                            "sede" => $documento["Sede"],
                            "estado" => $documento["Estado"]
                        ));
                    }else if($tipo_doc == "GD" || $tipo_doc == "IT"){
                        array_push($datos,
                        array(
                            "urlDoc" => ''.$data_url.'&numero_doc='.$documento["Numero_Documento"].'&nit_sede='.$documento["Nit_Empresa"].'',
                            "botonVerDoc" => '<button class="href">'.$documento["Numero_Documento"].'</button>',
                            "numero_documento" => $documento["Numero_Documento"],
                            "tipo_documento" => null,
                            "nit_sede" => $documento["Nit_Empresa"],
                            "fecha_documento" => $documento["Fecha_Documento"],
                            "razon_social" => $documento["Razon_Social"],
                            "numero_ingreso" => $documento["Numero_Ingreso"],
                            "usuario_crea" => $documento["Usuario"],
                            "sede" => $documento["Sede"],
                            "estado" => $documento["Estado_Documento"]
                        ));
                    }else if($tipo_doc == "CT"){
                        $sqlFV = "SELECT ddv.Numero_Documento, ddv.Numero_Ingreso, edv.Fecha_Documento, ddv.Tipo_Documento,
                        ddv.NIT_Empresa, edv.Estado_Documento
                        FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv
                        WHERE ddv.Numero_Documento = edv.Numero_Documento
                        AND ddv.NIT_Empresa = edv.NIT_Empresa
                        AND ddv.Numero_Cotizacion LIKE '".$documento["Numero_Documento"]."%' AND ddv.Tipo_Documento = 'FVC'
                        AND ddv.NIT_Empresa = '".$documento["Nit_Empresa"]."' AND edv.Estado_Documento = 'A'";
                        $facturaVenta = $objCotizacion->Consultar($sqlFV);

                        if ($facturaVenta == null) {
                            $factura = false;
                        }else{
                            $factura = true;
                        }

                        array_push($datos,
                        array(
                            "urlDoc" => ''.$data_url.'&numero_doc='.$documento["Numero_Documento"].'&tipo_doc='.$documento["Tipo_Documento"].'&nit_sede='.$documento["Nit_Empresa"].'',
                            "botonVerDoc" => '<button class="href">'.$documento["Numero_Documento"].'</button>',
                            "numero_documento" => $documento["Numero_Documento"],
                            "tipo_documento" => $documento["Tipo_Documento"],
                            "nit_sede" => $documento["Nit_Empresa"],
                            "fecha_documento" => $documento["Fecha_Documento"],
                            "razon_social" => $documento["Razon_Social"],
                            "numero_ingreso" => $documento["Numero_Ingreso"],
                            "usuario_crea" => $documento["Usuario"],
                            "sede" => $documento["Sede"],
                            "factura" => $factura,
                            "estado" => $documento["Estado_Documento"]
                        ));
                    }else if($tipo_doc != "CT" && $tipo_doc != "OT" && $tipo_doc != "IT" && $tipo_doc != "GD"){
                        array_push($datos,
                        array(
                            "urlDoc" => ''.$data_url.'&numero_doc='.$documento["Numero_Documento"].'&tipo_doc='.$documento["Tipo_Documento"].'&nit_sede='.$documento["Nit_Empresa"].'',
                            "botonVerDoc" => '<button class="href">'.$documento["Numero_Documento"].'</button>',
                            "numero_documento" => $documento["Numero_Documento"],
                            "tipo_documento" => $documento["Tipo_Documento"],
                            "nit_sede" => $documento["Nit_Empresa"],
                            "fecha_documento" => $documento["Fecha_Documento"],
                            "razon_social" => $documento["Razon_Social"],
                            "numero_ingreso" => $documento["Numero_Ingreso"],
                            "usuario_crea" => $documento["Usuario"],
                            "sede" => $documento["Sede"],
                            "estado" => $documento["Estado_Documento"]
                        ));
                    }
                }
            }
                
            $tabla = array("data" => $datos);
            echo json_encode($tabla);
        }

        function BuscarDatosCliente(){
            $nit_cliente=$_POST["nit_cliente"];
            $objCotizacion = new UtilidadesModel();
            
            $sqlcli="SELECT Nit_Cliente, clientes.Direccion, Telefono1, Telefono2, ciudades.Nombre AS Ciudad_Cliente, Dias_Plazo, Forma_Pago 
            FROM clientes, ciudades WHERE clientes.Codigo_Ciudad=ciudades.Codigo_Ciudad AND Nit_Cliente='$nit_cliente'";
            $clientes=$objCotizacion->Consultar($sqlcli);

            $sqlemple="SELECT clientes.Nit_Cliente, CONCAT(empleados.Nombres,' ',empleados.Apellidos) AS Nombre_Completo, clientes.Cedula_Empleado 
            FROM clientes, empleados WHERE clientes.Cedula_Empleado=empleados.Cedula_Empleado AND empleados.Cargo='14' 
			AND Nit_Cliente='$nit_cliente' AND empleados.Estado = 'A'";
            $empleados=$objCotizacion->Consultar($sqlemple);
            if ($empleados != null) {
                $cedula_empleado = $empleados[0]["Cedula_Empleado"];
            }else{
                $cedula_empleado = null;
            }
    
            if ($clientes != null) {
                foreach ($clientes AS $cliente) {
                    $datos = array(
                        "Nit_Cliente" => $cliente["Nit_Cliente"],
                        "Direccion" => $cliente["Direccion"],
                        "Telefono1" => $cliente["Telefono1"],
                        "Telefono2" => $cliente["Telefono2"],
                        "Ciudad_Cliente" => $cliente["Ciudad_Cliente"],
                        "Dias_Plazo" => $cliente["Dias_Plazo"],
                        "Forma_Pago" => $cliente["Forma_Pago"],
                        "Cedula_Empleado" => $cedula_empleado
                    );
                }
            }else{
                $datos = array();
            }
            echo json_encode($datos);
        }
        
        public function buscarClientesSede() {
            $nit_Empresa_sede = $_POST['nit_sede'];
            $objConsecutivo = new UtilidadesModel();

            $sql ="SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa = '$nit_Empresa_sede' AND Estado='A' ORDER BY Razon_Social";
            $Cliente = $objConsecutivo->Consultar($sql);

            $select = '<option value="">Seleccione ...</option>';
            foreach ($Cliente as $Clientes) {
              $select .= "<option value=" . $Clientes[0]. ">" . $Clientes[1]. "</option>";                                                   
            }

            $datos = array(
                "selectNitCliente" => $select
            );

            echo json_encode($datos);
        }
        
        public function buscarConsecutivoSedeYcliente() {
            $nit_Empresa_sede = $_POST['nit_sede'];
            $tipo_doc = $_POST['tipo_doc'];
            $objUtilidades = new UtilidadesModel();

            $sql = "SELECT ultimo_creado FROM consecutivo_documentos WHERE td_sigla='$tipo_doc' AND nit_empresa='$nit_Empresa_sede'";
            $num_doc = $objUtilidades->Consultar($sql);
            
            if ($num_doc != null) {
                $cons_doc = $num_doc[0][0] + 1;
            }else{
                $cons_doc = null;
            }

            $sql2 ="SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa = '$nit_Empresa_sede' AND Estado='A' ORDER BY Razon_Social";
            $Cliente = $objUtilidades->Consultar($sql2);

            $select = '<option value="">Seleccione ...</option>';
            foreach ($Cliente as $Clientes) {
              if ($Cliente != null) {
                $select .= "<option value=" . $Clientes[0]. ">" . $Clientes[1]. "</option>";     
              }
            }

            $datos = array(
                "consecutivo_doc" => $cons_doc,
                "selectNitCliente" => $select
            );

            echo json_encode($datos);
    }

    public function buscarVendedorSede(){
        $nit_Empresa_sede = $_POST['nit_sede'];
        $objUtilidades = new UtilidadesModel();

        $sql ="SELECT Cedula_Empleado, CONCAT(Nombres,' ', Apellidos) AS Nombre_Completo 
                    FROM empleados WHERE Cargo='14' AND Nit_Empresa='$nit_Empresa_sede' AND Estado = 'A'
                    ORDER BY Nombre_Completo";
        $vendedor = $objUtilidades->Consultar($sql);

        $select = '<option value="">Seleccione ...</option>';
        foreach ($vendedor as $vendedores) {
            $select .= "<option value=" . $vendedores[0]. ">" . $vendedores[1]. "</option>";                                                   
        }

        $datos = array(
            "selectVendedor" => $select
        );

        echo json_encode($datos);
    }

    public function BuscarContactoCliente() {

        $objCotizacion = new UtilidadesModel();

        if (!empty($_POST["nit_cliente"])) {
            $nit_cliente = $_POST['nit_cliente'];
            $sqlcontacto = "SELECT Contacto_Empresa FROM clientes WHERE Nit_Cliente='$nit_cliente'";
            $contactos = $objCotizacion->Consultar($sqlcontacto);
            if ($contactos != null) {
                $contacto = $contactos[0]["Contacto_Empresa"];
            }
        }else{
            $contacto = null;
        }

        if (!empty($_POST["planta"])) {
            $planta = $_POST["planta"];
            $sqlcontacto = "SELECT Nombre_Contacto FROM contactos WHERE Codigo_Planta='$planta'";
            $contactos = $objCotizacion->Consultar($sqlcontacto);
            if ($contactos != null) {
                $contacto = $contactos[0]["Nombre_Contacto"];
            }
        }
        echo json_encode(array("Nombre_Contacto" => $contacto));
    }

    public function buscarVendedorPlanta(){
        $objDocumento = new UtilidadesModel();

        if (!empty($_POST["planta"])) {
            $planta = $_POST["planta"];
            $sqlvendedor = "SELECT Cedula_Empleado FROM plantas WHERE Codigo_Planta='$planta'";
            $vende = $objDocumento->Consultar($sqlvendedor);
            if ($vende != null) {
                $vendedor = $vende[0][0];
            }
        }
        echo json_encode(array("Vendedor" => $vendedor));
    }

    // public function generarReporteExcel(){
    //     @require "../../vendor/sb-admin-2/lib/phpexcel/Classes/PHPExcel.php";

    //     $objUtilidades = new UtilidadesModel();

    //     $reporteExcel=$objUtilidades->Consultar("SELECT *  FROM empleados");
        
    //     $objPHPExcel = new PHPExcel();
    //     $objPHPExcel->getProperties()
    //     ->setCreator("nombre creador libro")
    //     ->setTitle("Excel en PHP")
    //     ->setDescription("Documento prueba")
    //     ->setKeywords("excel phpexcel php")
    //     ->setCategory("Ejemplos");

    //     $objPHPExcel->setActiveSheetIndex(0);
    //     $objPHPExcel->getActiveSheet()->setTitle("Hoja1");

    //     $objPHPExcel->getActiveSheet()->setCellValue("A1", "Nombres");
    //     $objPHPExcel->getActiveSheet()->setCellValue("B1", "Apellidos");
    //     $objPHPExcel->getActiveSheet()->setCellValue("C1", "Direccion");
    //     $objPHPExcel->getActiveSheet()->setCellValue("D1", "Codigo");
    //     $objPHPExcel->getActiveSheet()->setCellValue("E1", "Estado");

    //     $fila = 2;

    //     $sheet = $objPHPExcel->getActiveSheet();
    //     $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
    //     $cellIterator->setIterateOnlyExistingCells(true);

    //     foreach($cellIterator as $cell) {
    //         $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
    //     }

    //     foreach ($reporteExcel as $reporte) {
    //         $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $reporte["Nombres"]);
    //         $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $reporte["Apellidos"]);
    //         $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $reporte["Direccion"]);
    //         $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $reporte["Codigo_Empleado"]);
    //         $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, $reporte["Estado"]);

    //         $fila++;
    //     }

    //     header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    //     header('Content-Disposition: attachment;filename="Reporte_Fechas_Ingreso.xlsx"');
    //     header("Cache-Control: max-age=0");

    //     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    //     $objWriter->save("php://output");
    // }

    public function EliminarDetalleDoc() {
        extract($_POST);

        $objUtilidades = new UtilidadesModel();

        // COTIZACIONES
        if ($tipo_doc == "CT") {
            $sql1 = "SELECT * FROM detalle_cotizacion_venta WHERE Numero_Registro = '$Numero_Registro'";
            $Numero_Documento = $objUtilidades->Consultar($sql1);
            $consecutivo = substr($Numero_Documento[0][1], strpos($Numero_Documento[0][1], "-") + 1);

            if ($consecutivo == 5) {
                if (isset($Numero_Registro)) {
                    $sql2 = "DELETE FROM detalle_cotizacion_venta WHERE Numero_Registro = '$Numero_Registro'";
                    $objUtilidades->Anular($sql2);
    
                    $sql3 = "ALTER TABLE detalle_cotizacion_venta AUTO_INCREMENT = $Numero_Registro";
                    $objUtilidades->Consultar($sql3);
                }
            }
        // PRELIQUIDACIONES Y REMISIONES
        }else if($tipo_doc == "PL" || $tipo_doc == "RM"){
            if (isset($Numero_Registro)) {
                $sql2 = "DELETE FROM detalle_documento_venta WHERE Numero_Registro = '$Numero_Registro'";
                $objUtilidades->Anular($sql2);

                $sql3 = "ALTER TABLE detalle_cotizacion_venta AUTO_INCREMENT = $Numero_Registro";
                $objUtilidades->Consultar($sql3);
            }
        // ORDENES DE TRABAJO
        }else if($tipo_doc == "OT"){
            if (isset($Numero_Registro)) {
                $sql2 = "DELETE FROM detalle_orden_trabajo WHERE Numero_Registro = '$Numero_Registro'";
                $objUtilidades->Anular($sql2);

                $sql3 = "ALTER TABLE detalle_orden_trabajo AUTO_INCREMENT = $Numero_Registro";
                $objUtilidades->Consultar($sql3);
            }
        // INFORMES TÉCNICOS
        }else if($tipo_doc == "IT"){
            if (isset($Numero_Registro)) {
                $sql2 = "DELETE FROM detalle_revision_ingreso WHERE Numero_Registro = '$Numero_Registro'";
                $objUtilidades->Anular($sql2);

                $sql3 = "ALTER TABLE detalle_revision_ingreso AUTO_INCREMENT = $Numero_Registro";
                $objUtilidades->Consultar($sql3);
            }
        }
    }

    public function autocompletarBuscador(){
        $objUtilidades = new UtilidadesModel();
        $datos = array();
        $tabla = $_POST["tabla"];
        $campo = $_POST["campo"];

        $sqlAutocompletar = "SELECT * FROM $tabla";
        $Autocompletar = $objUtilidades->Consultar($sqlAutocompletar);

        $index = 1;

        foreach ($Autocompletar as $autocompletar) {
            array_push($datos,
            array(
                "id" => "id".$index,
                "name" => $autocompletar[$campo]
            ));
            $index++;
        }
        
        echo json_encode($datos);
    }
}