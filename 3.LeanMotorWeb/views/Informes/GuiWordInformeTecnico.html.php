<?php
    include_once "../../app/Model/Informes/InformesModel.php";
    include_once "../../vendor/sb-admin-2/lib/dompdf/lib/utilities-bootstrap4/bootstrap.php";
    include_once "../../app/Lib/helpers.php";
    @session_start();

    $objInforme = new InformesModel();

    $Numero_Documento=$_GET["numero_doc"];
    $nit_sede=$_GET["nit_sede"];
    $usua_id=$_SESSION["usua_id"];

    $sqlInforme="SELECT infort.Numero_Documento, infort.Numero_Ingreso, equi.Nit_Cliente, 
    DATE_FORMAT(infort.Fecha_Documento, '%Y-%m-%d') AS Fecha_Documento, 
    DATE_FORMAT(Hora_Documento,'%h:%i:%s %p') AS Hora_Documento, 
    infort.Nit_Empresa, infort.Estado_Documento, sede.nombre AS Sede, 
    CONCAT(emple.Nombres, ' ', emple.Apellidos) AS Ingeniero_Planta, 
    infort.Observaciones_Causa_Falla, infort.Observaciones_Inspeccion, infort.Volt_Prueba, infort.Hipot_mA, 
    infort.Surge_Impulso_F1, infort.Surge_Impulso_F2, infort.Surge_Impulso_F3, infort.Volt_Prueba2, infort.R_Aisl_Gohm, 
    infort.Observaciones_Pru_elec, infort.Axial_Lc, infort.Axial_Loc, infort.Vertical_Lc, infort.Vertical_Loc, 
    infort.Horizontal_Lc, infort.Horizontal_Loc, infort.Observaciones_Analisis_Vib, infort.Ten_De_Pruebas, 
    IF(infort.Conexion = 'Seleccione ...', NULL, infort.Conexion) Conexion, 
    infort.Corriente_F1, infort.Corriente_F2, infort.Corriente_F3, infort.Observaciones_Pru_Sin_Carga, 
    CONCAT(emple2.Nombres, ' ', emple2.Apellidos) AS Responsable
    FROM informe_tecnico_reparacion_pruebas AS infort, 
    empleados AS emple, empleados AS emple2, equipos AS equi, ingreso_equipos AS ing, sedes AS sede 
    WHERE infort.Numero_Ingreso=ing.Numero_Ingreso 
    AND infort.Ingeniero_Planta = emple.Cedula_Empleado
    AND infort.Cedula_Responsable = emple2.Cedula_Empleado
    AND ing.Numero_Serie=equi.Numero_Serie 
    AND infort.Nit_Empresa=sede.nit_empresa 
    AND infort.Numero_Documento = '$Numero_Documento' 
    AND infort.Nit_Empresa = '$nit_sede' ";
    $Informe = $objInforme->Consultar($sqlInforme);

    $sqlDetalle = "SELECT dri.Numero_Registro, dri.Numero_Ingreso, dri.Codigo_Revision, revi.Descripcion, 
    dri.Resultado, dri.Accion_Correctiva, dri.Realizada, infort.Nit_Empresa, infort.Estado_Documento 
    FROM informe_tecnico_reparacion_pruebas AS infort, detalle_revision_ingreso AS dri, revisiones AS revi 
    WHERE infort.Numero_Ingreso = dri.Numero_Ingreso 
    AND infort.Nit_Empresa = dri.Nit_Empresa 
    AND dri.Numero_Ingreso = '".$Informe[0]["Numero_Ingreso"]."' 
    AND dri.Codigo_Revision = revi.Codigo_Revision ORDER BY dri.Numero_Registro ASC";
    $Detalle = $objInforme->Consultar($sqlDetalle);

    $sqlIngre = "SELECT ing.Numero_Ingreso, ing.Tipo_Ingreso, ing.Detalle_De_Equipo, equi.Nit_Cliente, tequi.Descripcion AS Equipo, 
                gru.Descripcion AS Tipo_Equipo, marcas.Descripcion AS Marca, ing.Numero_Serie, equi.Codigo_Planta, No_Fases, Frame, 
                CONCAT(Potencia,' - ', Unidad_De_Potencia) AS Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, Voltaje, V_Primario, Va, Ubicacion, Orden_Servicio, Requisitos_Cliente
                    FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos tequi, grupos AS gru,
                    marcas, detalle_equipo AS dequi
                        WHERE ing.Numero_Serie=equi.Numero_Serie
                            AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
                            AND tequi.Codigo_Grupo=gru.Codigo_Grupo
                            AND equi.Codigo_Marca=marcas.Codigo_Marca
                            AND equi.Numero_Serie=dequi.Numero_Serie
                            AND ing.Numero_Ingreso='".$Informe[0]["Numero_Ingreso"]."' LIMIT 1";
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

    $sqlcliente = "SELECT cli.Nit_Cliente, cli.Razon_Social, cli.Direccion, cli.Telefono1,	ciu.Nombre AS Ciudad FROM clientes AS cli, ciudades AS ciu 
    WHERE cli.Codigo_Ciudad=ciu.Codigo_Ciudad AND Nit_Cliente=" . "'" . $Informe[0]["Nit_Cliente"] . "'" . " AND Estado='A'";
    $Cliente = $objInforme->Consultar($sqlcliente);

    foreach ($Informe as $informe) {}
    foreach ($Ingreso as $ingreso) {}
    foreach ($Cliente as $cliente) {}

    date_default_timezone_set("America/Bogota");
    $fechaImpresion = date("Y/m/d");

    $codigoHTML='
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap Core CSS -->
            ' . $bootstrap_css . '
        <title>Informe Técnico</title>
    </head>

    <body>';


    $codigoHTML.='
    <table class="table table-borderless" width="100%;">

        <thead class="text-center">
            <tr>
                <td>LABORATORIO TECNO-ELÉCTRICO S.A.S</td>
            </tr>
        </thead>

    </table>

    <table class="table table-borderless" width="100%;">

        <tbody>
            <tr>
                <td>Informe Técnico de Reparación y Pruebas</td>
                <td>Responsable : '.$informe["Responsable"].'</td>
            </tr>
        </tbody>

    </table>
    
    <table class="table table-borderless" width="100%;">

        <tbody>
            <tr>
                <td>No. Documento: '.$informe["Numero_Documento"].'</td>
                <td>Fecha: '.fechaCastellano($informe["Fecha_Documento"]).'</td>
                <td>Hora: '.$informe["Hora_Documento"].'</td>
                <td>Estado: '.$informe["Estado_Documento"].'</td>
            </tr>
        </tbody>

    </table>
    
    <table class="table table-borderless" width="100%;">

        <tbody>
            <tr>
                <td>Cliente: '.$cliente["Razon_Social"].'</td>
                <td>Ingreso: '.$ingreso["Numero_Ingreso"].'</td>
                <td>O.S: '.$ingreso["Orden_Servicio"].'</td>
            </tr>
        </tbody>

    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td style="font-weight: bold;">1. DATOS DE PLACA</td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Equipo: '.$ingreso["Equipo"].'</td>
                <td>Frame: '.$ingreso["Frame"].'</td>
                <td>Tipo: '.$ingreso["Tipo_Equipo"].'</td>
                <td>Voltaje: '.$Voltaje.'</td>
            </tr>

            <tr>
                <td>Marca: '.$ingreso["Marca"].'</td>
                <td>Potencia: '.$ingreso["Potencia"].'</td>
                <td>Fases: '.$ingreso["No_Fases"].'</td>
                <td>R.P.M: '.$Velocidad.'</td>
            </tr>

            <tr>
                <td>Serie: '.$ingreso["Numero_Serie"].'</td>
            </tr>

            <tr>
                <td>Ubicacion: '.$ingreso["Ubicacion"].'</td>
            </tr>
        </tbody>

    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td><span style="font-weight: bold;">2. CAUSAS DE FALLA:</span> '.$informe["Observaciones_Causa_Falla"].'</td>
            </tr>
        </thead>

    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td style="font-weight: bold;">3. INSPECCIONES</td>
            </tr>
        </thead>

    </table>
    
    <table class="table table-borderless" width="100%;">
        <tbody>
            <tr>
                <td style="padding-left: 200px;">RESULTADOS</td>
                <td style="padding-left: 210px;">REALIZADA</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table" width="100%;" border="1" style="border-collapse: collapse;">

        <thead>
            <tr>
                <th>PARTE REVISADA</th>
                <th>B</th>
                <th>M</th>
                <th>ACCIÓN CORRECTIVA</th>
                <th>S</th>
                <th>N</th>
            </tr>
        </thead>

        <tbody>';
            foreach ($Detalle as $detalle) {
                if ($detalle["Resultado"] == "B") {
                    $opcion_bueno = "X";
                    $opcion_malo = "";
                }else if($detalle["Resultado"] == "M"){
                    $opcion_bueno = "";
                    $opcion_malo = "X";
                }
                if ($detalle["Realizada"] == "S") {
                    $opcion_si = "X";
                    $opcion_no = "";
                }else if($detalle["Realizada"] == "N"){
                    $opcion_si = "";
                    $opcion_no = "X";
                }

                $codigoHTML.='
                <tr>
                    <td>'.$detalle["Descripcion"].'</td>
                    <td class="text-center">'.$opcion_bueno.'</td>
                    <td class="text-center">'.$opcion_malo.'</td>
                    <td>'.$detalle["Accion_Correctiva"].'</td>
                    <td class="text-center">'.$opcion_si.'</td>
                    <td class="text-center">'.$opcion_no.'</td>
                </tr>';
            }
    $codigoHTML.='
        </tbody>

    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td>Observaciones: '.$informe["Observaciones_Inspeccion"].'</td>
            </tr>
        </thead>

    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td style="font-weight: bold;">4. PRUEBAS ELÉCTRICAS</td>
            </tr>
        </thead>

    </table>
    
    <table class="table" width="100%;" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Volt. de Prueba</th>
                <th>Hipot mA</th>
                <th colspan="3">Surge (Impulso)</th>
                <th>Volt</th>
                <th>R. Aisl</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="text-center">'.$informe["Volt_Prueba"].'</td>
                <td class="text-center">'.$informe["Hipot_mA"].'</td>
                <td class="text-center">F1: '.$informe["Surge_Impulso_F1"].'</td>
                <td class="text-center">F2: '.$informe["Surge_Impulso_F2"].'</td>
                <td class="text-center">F3: '.$informe["Surge_Impulso_F3"].'</td>
                <td class="text-center">'.$informe["Volt_Prueba2"].'</td>
                <td class="text-center">'.$informe["R_Aisl_Gohm"].'</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td>Observaciones: '.$informe["Observaciones_Pru_elec"].'</td>
            </tr>
        </thead>

    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td style="font-weight: bold;">5. ANÁLISIS VIBRACIONAL</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding-left: 480px;">(Vel/Pulg/Seg)</td>
            </tr>
        </thead>

    </table>

    <table class="table table-borderless" width="100%;">
        <tbody>
            <tr>
                <td style="padding-left: 480px;">L.C</td>
                <td style="padding-right: 10px;">L.O.C</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table" width="100%;" border="1" style="border-collapse: collapse;">
        <tbody>
            <tr>
                <td>Axial :</td>
                <td class="text-center">'.$informe["Axial_Lc"].'</td>
                <td class="text-center">'.$informe["Axial_Loc"].'</td>
            </tr>

            <tr>
                <td>Vertical :</td>
                <td class="text-center">'.$informe["Vertical_Lc"].'</td>
                <td class="text-center">'.$informe["Vertical_Lc"].'</td>
            </tr>

            <tr>
                <td>Horizontal :</td>
                <td class="text-center">'.$informe["Horizontal_Lc"].'</td>
                <td class="text-center">'.$informe["Horizontal_Lc"].'</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td>Observaciones: '.$informe["Observaciones_Analisis_Vib"].'</td>
            </tr>
        </thead>

    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td style="font-weight: bold;">6. PRUEBAS SIN CARGA</td>
            </tr>
        </thead>

    </table>
    
    <table class="table" width="100%;" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Ten. de Prueba</th>
                <th>Conexión</th>
                <th colspan="3">Corriente</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="text-center">'.$informe["Ten_De_Pruebas"].'</td>
                <td class="text-center">'.$informe["Conexion"].'</td>
                <td class="text-center">F1: '.$informe["Corriente_F1"].'</td>
                <td class="text-center">F2: '.$informe["Corriente_F2"].'</td>
                <td class="text-center">F3: '.$informe["Corriente_F3"].'</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-borderless" style="padding-top: 15px;" width="100%;">

        <thead>
            <tr>
                <td>Observaciones: '.$informe["Observaciones_Pru_Sin_Carga"].'</td>
            </tr>
        </thead>

    </table>
    
    <table class="table table-borderless" style="padding-left: 100px;">
        <tr>
            <td>
                <span style="font-weight: bold;">ING. DE PLANTA: </span>
                <td class="pt-4" style="width: 58%;">
                    <hr>
                    <span style="font-weight: bold;">'.$informe["Ingeniero_Planta"].'</span>
                </td>
            </td>
        </tr>
    </table>';

    $codigoHTML.='

    </body>

    </html>';

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=Informe Técnico.doc");
    ?>

    <?=$codigoHTML;?>