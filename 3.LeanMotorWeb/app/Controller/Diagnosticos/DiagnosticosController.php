
<?php

include_once "../../app/Model/Diagnosticos/DiagnosticosModel.php";

class DiagnosticosController {
    public function tiposDiagnosticos() {
        $ObjDiagnostico= new DiagnosticosEquipoModel();

        if (!empty($_GET["nit_sede"]) && !empty($_GET["nit_cliente"]) && !empty($_GET["numero_ingreso"])) {
            $sqlempresa = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$_GET["nit_sede"]."' AND Estado='A' ORDER BY Razon_Social";
            $empresas = $ObjDiagnostico->Consultar($sqlempresa);

            $consIngreso = "SELECT ine.Numero_Ingreso FROM ingreso_equipos AS ine, equipos AS e
                                        WHERE e.Nit_Cliente='".$_GET["nit_cliente"]."' AND ine.Numero_Ingreso = '".$_GET["numero_ingreso"]."' 
                                        AND e.Numero_Serie=ine.Numero_Serie 
                                        AND ine.Estado='A' order by Fecha_Ingreso DESC";
            $Ingresos = $ObjDiagnostico->Consultar($consIngreso);
        }else{
            $sqlempresa = "select Nit_Cliente, Razon_Social from clientes order by Razon_Social ";
            $empresas = $ObjDiagnostico->Consultar($sqlempresa);
        }

        $sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
        $sedes=$ObjDiagnostico->Consultar($sqlsede);

        include_once  "../../views/Diagnosticos/GuiTiposDiagnosticos.html.php";
    }

    public function validarDiagnostico(){
        $Numero_Ingreso = $_POST["numero_ingreso"];
        $ObjDiagnostico = new DiagnosticosEquipoModel();

        $sqlDiag="SELECT diagnosticos.Numero_Ingreso, ing.Nit_Empresa, equi.Nit_Cliente FROM ".$_POST["tabla_diagnostico"]." AS diagnosticos, 
        ingreso_equipos AS ing, equipos AS equi WHERE diagnosticos.Numero_Ingreso = ing.Numero_Ingreso 
        AND ing.Numero_Serie=equi.Numero_Serie 
        AND ing.Estado = 'A' 
        AND ing.Numero_Ingreso = '$Numero_Ingreso' ";
        $diagnostico=$ObjDiagnostico->Consultar($sqlDiag);

        if ($diagnostico != null) {
            echo json_encode(array($_POST["tabla_diagnostico"] => true));
        }else{
            echo json_encode(array($_POST["tabla_diagnostico"] => false));
        }
    }

    public function diagnosticoMotorEstandar(){
        include_once "../../views/Diagnosticos/GuiDiagnosticoEstandar.html.php";
    }

    public function RegistrarDiagnosticoEstandar(){
        $ObjDiagnostico = new DiagnosticosEquipoModel();

        extract($_POST);
        print_r($_POST);
        date_default_timezone_set("America/Bogota");
        $Fecha = date("Y-m-d");
        if(!isset($Cancamo_Tiene)){$Cancamo_Tiene="N";}else{$Cancamo_Tiene="S";}
        if(!isset($Cancamo_Bueno)){$Cancamo_Bueno="N";}else{$Cancamo_Bueno="S";}
        if(!isset($Placa_Tiene)){$Placa_Tiene="N";}else{$Placa_Tiene="S";}
        if(!isset($Placa_Bueno)){$Placa_Bueno="N";}else{$Placa_Bueno="S";}
        if(!isset($Cancamo_Suministrar)){$Cancamo_Suministrar="N";}else{$Cancamo_Suministrar="S";}
        if(!isset($Cancamo_Reparar)){$Cancamo_Reparar="N";}else{$Cancamo_Reparar="S";}
        if(!isset($Placa_Suministrar)){$Placa_Suministrar="N";}else{$Placa_Suministrar="S";}
        if(!isset($Placa_Reparar)){$Placa_Reparar="N";}else{$Placa_Reparar="S";}

        $sqlDiagnostico1 = "INSERT INTO diagnostico_1
        (Numero_Diagnostico, Numero_Ingreso, Fecha, Cancamo_Tiene, Cancamo_Bueno, Cancamo_Suministrar, Cancamo_Referencia,
        Cancamo_Reparar, Placa_Tiene, Placa_Bueno, Placa_Suministrar, Placa_Referencia, Placa_Reparar, B, C, E, A, AB, H, HD)
        VALUES 
        (NULL, '$no_ingreso', '$Fecha', '$Cancamo_Tiene', '$Cancamo_Bueno', '$Cancamo_Suministrar', '$Cancamo_Referencia', 
        '$Cancamo_Reparar', '$Placa_Tiene', '$Placa_Bueno', '$Placa_Suministrar', '$Placa_Referencia', '$Placa_Reparar', 
        '$B', '$C', '$E', '$A', '$AB', '$H', '$HD')";
        $ObjDiagnostico->Insertar($sqlDiagnostico1);

        $sqlID = "SELECT @@identity AS id";
        $id=$ObjDiagnostico->Consultar($sqlID);
        $numDiag = trim($id[0][0]);

        if (isset($empleado) && isset($caja)) {
            for ($i = 0; $i < count($empleado); $i++) {
                $sqlDetalle = "INSERT INTO detalle_empleados_cajas
                (Numero_Registro, Numero_Diagnostico, Cedula_Empleado, Codigo_Caja)
                VALUES (NULL, '$numDiag', '$empleado[$i]', '$caja[$i]')";
                $ObjDiagnostico->Insertar($sqlDetalle);
            }
        }

        echo messageSweetAlert("El registro se ha realizado con éxito", "", "success", "", "si", "boton", getUrl("Diagnosticos", "Diagnosticos", "menuDiagnosticos", array("numero_ingreso" => $no_ingreso, "tipo_vista" => "editar")));
    }

    public function conexionesPlacaFrame(){
        $ObjDiagnostico = new DiagnosticosEquipoModel();

        $sqlDiag="SELECT diag1.Numero_Diagnostico, diag1.Numero_Ingreso, diag1.Fecha, diag1.Cancamo_Tiene, diag1.Cancamo_Bueno, 
        diag1.Cancamo_Suministrar, diag1.Cancamo_Referencia, diag1.Cancamo_Reparar, diag1.Placa_Tiene, diag1.Placa_Bueno, diag1.Placa_Suministrar,
        diag1.Placa_Referencia, diag1.Placa_Reparar, diag1.B, diag1.C, diag1.E, diag1.A, diag1.AB, diag1.H, diag1.HD, ing.Nit_Empresa, equi.Nit_Cliente 
        FROM diagnostico_1 AS diag1, ingreso_equipos AS ing, equipos AS equi 
        WHERE diag1.Numero_Ingreso = ing.Numero_Ingreso 
        AND ing.Numero_Serie=equi.Numero_Serie 
        AND ing.Estado = 'A' 
        AND ing.Numero_Ingreso = '".$_GET["numero_ingreso"]."' ";
        $Diagnostico=$ObjDiagnostico->Consultar($sqlDiag);

        include_once "../../views/Diagnosticos/GuiConexionesPlacaFrame.html.php";
    }

    public function menuDiagnosticos(){
        $ingreso = $_GET["numero_ingreso"];
        $ObjDiagnostico = new DiagnosticosEquipoModel();

        $sqlingreso = "SELECT ing.Fecha_Ingreso, ing.Numero_Ingreso, equi.Nit_Cliente, ing.Nit_Empresa, equi.Codigo_Tipo_Equipo AS Codigo_Clase_Equipo, tequi.Descripcion AS Clase_Equipo, 
        tequi.Codigo_Grupo AS Codigo_Tipo_Equipo, gru.Descripcion AS Tipo_Equipo, marcas.Codigo_Marca AS Codigo_Marca, 
        marcas.Descripcion AS Marca, ing.Numero_Serie AS Numero_Serie, Velocidad_Parte, Voltaje, V_Primario, Va, 
        Fs, No_Fases, Frame, Cos, CONCAT(Potencia,' - ', Unidad_De_Potencia) AS Potencia, Revoluciones_Por_Minuto, Codigo_Planta, Ubicacion, Requisitos_Cliente, Orden_Servicio 
        FROM ingreso_equipos AS ing, equipos AS equi, detalle_equipo AS dequi, tipos_equipos AS tequi, grupos AS gru, marcas
        WHERE ing.Numero_Serie=equi.Numero_Serie
            AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
            AND tequi.Codigo_Grupo=gru.Codigo_Grupo
            AND equi.Codigo_Marca=marcas.Codigo_Marca
            AND equi.Numero_Serie=dequi.Numero_Serie
            AND ing.Numero_Ingreso='$ingreso'";
        $ingresos = $ObjDiagnostico->Consultar($sqlingreso);

        $sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='".$ingresos[0]["Nit_Empresa"]."' AND Nit_Cliente = '".$ingresos[0]["Nit_Cliente"]."' AND Estado='A' ORDER BY Razon_Social";
        $Cliente=$ObjDiagnostico->Consultar($sqlCliente);
        
        $sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
        $Empleado = $ObjDiagnostico->Consultar($sqlEmpleado);

        if ($ingresos) {
            if ($ingresos[0]["Voltaje"] != "") {
                $Voltaje=$ingresos[0]["Voltaje"];
            }else if($ingresos[0]["V_Primario"] != ""){
                $Voltaje=$ingresos[0]["V_Primario"];
            }else if($ingresos[0]["Va"] != ""){
                $Voltaje=$ingresos[0]["Va"];
            }else if($ingresos[0]["Voltaje"] == "" && $ingresos[0]["V_Primario"] == "" && $ingresos[0]["Va"] == ""){
                $Voltaje=null;
            }
            if ($ingresos[0]["Revoluciones_Por_Minuto"] != "") {
                $Velocidad=$ingresos[0]["Revoluciones_Por_Minuto"];
            }else if($ingresos[0]["Velocidad_Parte"] != ""){
                $Velocidad=$ingresos[0]["Velocidad_Parte"];
            }else if($ingresos[0]["Revoluciones_Por_Minuto"] == "" && $ingresos[0]["Velocidad_Parte"] == ""){
                $Velocidad=null;
            }
        }
        
        include_once "../../views/Diagnosticos/GuiMenuDiagnosticos.html.php";
    }

    public function cajaConexionBorneraCaperuza(){
        include_once "../../views/Diagnosticos/GuiCajaConexionBorneraCaperuza.html.php";
    }
}