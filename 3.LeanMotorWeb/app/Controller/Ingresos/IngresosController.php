<?php

include_once('../../app/Model/Ingresos/IngresoEquiposModel.php');
@session_start();

class  IngresosController{
	
	function crearAC(){

    $objIngreso= new IngresoEquiposModel();
    
    $sqlTipos_Equipos = "SELECT Codigo_Tipo_Equipo, Descripcion FROM tipos_equipos WHERE Codigo_Grupo = '1' AND Estado='A' ORDER BY Descripcion";
    $Tipos_Equipos = $objIngreso->Consultar($sqlTipos_Equipos);
   
    $sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
    $Marca = $objIngreso->Consultar($sqlMarca);
    
    $sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
    $Empleado = $objIngreso->Consultar($sqlEmpleado);
    
    $sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
    $sedes=$objIngreso->Consultar($sqlsede);
    
    include_once('../../views/Ingresos/GuiIngresoAC.html.php');

  }
  
  	function crearDC(){		

    $objIngreso= new IngresoEquiposModel();
    
    $sqlTipos_Equipos = "SELECT Codigo_Tipo_Equipo, Descripcion FROM tipos_equipos WHERE Codigo_Grupo = '2' AND Estado='A' ORDER BY Descripcion";
    $Tipos_Equipos = $objIngreso->Consultar($sqlTipos_Equipos);
   
    $sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
    $Marca = $objIngreso->Consultar($sqlMarca);
	
	$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
    $Empleado = $objIngreso->Consultar($sqlEmpleado);
   
    $sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social";
    $Cliente = $objIngreso->Consultar($sqlCliente);
    
    $sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
    $sedes=$objIngreso->Consultar($sqlsede);
    

    include_once('../../views/Ingresos/GuiIngresoDC.html.php');

  }
  
    function crearPT(){		

    	$objIngreso= new IngresoEquiposModel();
    
		$sqlTipos_Equipos = "SELECT Codigo_Tipo_Equipo, Descripcion FROM tipos_equipos WHERE Codigo_Grupo = '4' AND Estado='A' ORDER BY Descripcion";
		$Tipos_Equipos = $objIngreso->Consultar($sqlTipos_Equipos);
	
		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$Marca = $objIngreso->Consultar($sqlMarca);
		
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
		$Empleado = $objIngreso->Consultar($sqlEmpleado);
	
		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social";
		$Cliente = $objIngreso->Consultar($sqlCliente);
		
		$sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
		$sedes=$objIngreso->Consultar($sqlsede);
		

		include_once('../../views/Ingresos/GuiIngresoPT.html.php');
	}
    
    function crearOT(){
		$objIngreso= new IngresoEquiposModel();
		
		$sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
		$sedes=$objIngreso->Consultar($sqlsede);
		
		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social";
        $Cliente = $objIngreso->Consultar($sqlCliente);
        
        $sqlTipos_Equipos = "SELECT Codigo_Grupo, Descripcion FROM grupos";
		$Tipos_Equipos = $objIngreso->Consultar($sqlTipos_Equipos);
       
        $sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$Marca = $objIngreso->Consultar($sqlMarca);

        $sqlServicios = "SELECT Codigo, Descripcion FROM productos_servicios WHERE Indicativo = 'A' AND Estado = 'A' ORDER BY Descripcion";
		$Servicios = $objIngreso->Consultar($sqlServicios);
		
    	$sqlAplicacion = "SELECT * FROM aplicacion WHERE Estado='A' ORDER BY codigo";
		$Aplicacion = $objIngreso->Consultar($sqlAplicacion);

    	$sqlArranque = "SELECT * FROM tipo_de_arranque WHERE Estado='A' ORDER BY codigo";
		$Arranque = $objIngreso->Consultar($sqlArranque);
    	
    	$sqlAcoplamiento = "SELECT * FROM acoplamiento WHERE Estado='A' ORDER BY codigo";
        $Acoplamiento = $objIngreso->Consultar($sqlAcoplamiento);
		
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
    	$Empleado = $objIngreso->Consultar($sqlEmpleado);
    	
        include_once ('../../views/Ingresos/GuiIngresoOUT.html.php');
	}

    
	function postCrearDC(){
		extract($_POST);

		$objIngresoEqui= new IngresoEquiposModel();
    
        $usu_id=$_SESSION['usua_id'];
        if(!isset($Estator)){$Estator='N';}else{$Estator="S";}
        if(!isset($Caperuza)){$Caperuza='N';}else{$Caperuza="S";}
        if(!isset($Patas)){$Patas='N';}else{$Patas="S";}
        if(!isset($Tapa_Caja_Conexiones)){$Tapa_Caja_Conexiones='N';}else{$Tapa_Caja_Conexiones="S";}
        if(!isset($Reglete_de_Conexiones)){$Reglete_de_Conexiones='N';}else{$Reglete_de_Conexiones="S";}
        if(!isset($Tornillos_Tapas)){$Tornillos_Tapas='N';}else{$Tornillos_Tapas="S";}
		if(!isset($Portaescobillas)){$Portaescobillas='N';}else{$Portaescobillas="S";}
		if(!isset($Otros)){$Otros='';}else{$Otros=$textotros;}
        if(!isset($Caja_Conexiones)){$Caja_Conexiones='N';}else{$Caja_Conexiones="S";}
        if(!isset($Cunas)){$Cunas='N';}else{$Cunas="S";}
        if(!isset($Polea)){$Polea='N';}else{$Polea="S";}
        if(!isset($Flejes)){$Flejes='N';}else{$Flejes="S";}
        if(!isset($Bornera)){$Bornera='N';}else{$Bornera="S";}
        if(!isset($Blower)){$Blower='N';}else{$Blower="S";}
        if(!isset($Brida)){$Brida='N';}else{$Brida="S";}
        if(!isset($Contratapas)){$Contratapas='N';}else{$Contratapas="S";}
        if(!isset($Escobillas)){$Escobillas='N';}else{$Escobillas="S";}
        if(!isset($Colector)){$Colector='N';}else{$Colector="S";}
        if(!isset($Acople)){$Acople='';}else{$Acople=$textacople;}
        if(!isset($Armadura)){$Armadura='N';}else{$Armadura="S";}
        if(!isset($Visor)){$Visor='';}else{$Visor=$textvisor;}
        if(!isset($Placa_Datos)){$Placa_Datos='N';}else{$Placa_Datos="S";}
        if(!isset($Ventilador)){$Ventilador='N';}else{$Ventilador="S";}
        if(!isset($Cancamo)){$Cancamo='';}else{$Cancamo=$textcancamo;}
        
        $contacto_envia="";
        $despachado_por="$despachado_por";
    
        date_default_timezone_set('America/Bogota');
        $Fecha_Ingreso=date('Y-m-d');
        $Hora_Ingreso="0000-00-00 ".date('h:i:s');
	
		if (!empty($Numero_SerieDC)) {
			$sql1="INSERT INTO ingreso_equipos 
			(Numero_Ingreso, Fecha_Ingreso, Numero_Serie, Detalle_De_Equipo, Enviado_Para, Enviado_Por, Cedula_Empleado, Estado, Observaciones, Usuario_Crea, 
			Hora_Ingreso, Contacto_Envia, Estator, Caperuza, Patas, Tapa_Caja_Conexiones, Reglete_de_Conexiones, 
			Tornillos_Tapas, Portaescobillas, Caja_Conexiones, Cunas, Polea, Flejes, Bornera, Blower, Brida, Contratapas, Otros, 
			Escobillas, Colector, Acople, Armadura, Visor, Orden_Servicio, Placa_Datos, Ventilador, Cancamo, 
			Requisitos_Cliente, Ubicacion, Fecha_Cierre_Virtual, Nit_Empresa, tipo_ingreso) 
			VALUES
			(null, '$Fecha_Ingreso', '$Numero_SerieDC', '$Detalle_De_Equipo', '$Enviado_Para', '$despachado_por', '$Cedula_Empleado', 'A', '$Observaciones', '$usu_id', 
			'$Hora_Ingreso', '$contacto_envia', '$Estator', '$Caperuza', '$Patas', '$Tapa_Caja_Conexiones', '$Reglete_de_Conexiones', 
			'$Tornillos_Tapas', '$Portaescobillas', '$Caja_Conexiones', '$Cunas', '$Polea', '$Flejes', '$Bornera', '$Blower', '$Brida', '$Contratapas', '$Otros', 
			'$Escobillas', '$Colector', '$Acople', '$Armadura', '$Visor', '$Orden_Servicio', '$Placa_Datos', '$Ventilador', '$Cancamo', 
			'$Requisitos_Cliente', '$Ubicacion', '0000-00-00 00:00:00', '$nit_sede', 'DC')";
			
			$objIngresoEqui->Insertar($sql1);

			$sqlBuscaIngreEqui="SELECT * FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieDC' ORDER BY Numero_Ingreso DESC LIMIT 1";
			$RegIngreEqui=$objIngresoEqui->Consultar($sqlBuscaIngreEqui);

			if ($RegIngreEqui != null) {
				$sqlBuscaEqui="SELECT * FROM equipos WHERE Numero_Serie='$Numero_SerieDC' AND Nit_Empresa='$nit_sede'";
				$RegEqui=$objIngresoEqui->Consultar($sqlBuscaEqui);
				
				if($RegEqui <> null){
					$sql2="UPDATE equipos SET Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$no_fases', Codigo_Marca='$Codigo_Marca', 
					Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo' WHERE Numero_Serie='$Numero_SerieDC'AND Nit_Empresa='$nit_sede'";
					$objIngresoEqui->Actualizar($sql2);
				}
				else{
					$sql2="INSERT INTO equipos VALUES ('$Numero_SerieDC','$Nit_Cliente','$Codigo_Planta','$no_fases','$Codigo_Marca','$Codigo_Tipo_Equipo', '$nit_sede')";
					$objIngresoEqui->Insertar($sql2);
				}
				
				if (isset($PotenciaInsert)) {
					$sql3="UPDATE ingreso_equipos SET Frame='$Frame', Tipo='$Tipo', Modulo='$Mod', Style='$Style', Form='$Form', 
					Frecuencia='$Frecuencia', Conexion='$Conexion', Fs='$Fs', Encl='$Encl', Ip='$Ip', Insul_Cls='$Insul_Cls' 
					WHERE Numero_Serie='$Numero_SerieDC'";
					$objIngresoEqui->Actualizar($sql3);

					for($i=0; $i<count($PotenciaInsert); $i++){
						$sql4="INSERT INTO detalle_equipo 
						(Numero_Registro, Numero_Serie, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, 
						Va, Vc, Ia, Ic, Nit_Empresa)
						VALUES 
						(null, '$Numero_SerieDC', '$PotenciaInsert[$i]', '$Unidad_De_PotenciaInsert[$i]', '$Revoluciones_Por_MinutoInsert[$i]', 
						'$VaInsert[$i]', '$VcInsert[$i]', '$IaInsert[$i]', '$IcInsert[$i]', '$nit_sede')";
						
						$DatoElec=$objIngresoEqui->Insertar($sql4);
					}
				}
				echo messageSweetAlert("El registro se ha realizado con éxito.<br>", '<h2 class="swal2-title">Número de Ingreso: <span class="badge badge-secondary">' . $RegIngreEqui[0][0] . '</span></h2>', "success", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearDC'));
			}else{
				echo messageSweetAlert("No se pudo realizar el registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearDC'));
			}
		}else{
			echo messageSweetAlert("Falta el Número de Registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearDC'));
		}
  	}
  
   
	function llenarplanta(){
		$nit=$_POST['nit'];
		$sql="SELECT Codigo_Planta,Nombre 
		FROM plantas, clientes 
		WHERE plantas.Nit_Cliente=clientes.Nit_Cliente AND plantas.Nit_Cliente='$nit' ";
		$objPlant= new IngresoEquiposModel();
		$Plant=$objPlant->Consultar($sql);

		include_once('../../views/Ingresos/GuiLLenarPlanta.html.php');
  }

	function listar(){
    $sql="SELECT * FROM equipos ";
    $objEquipo= new IngresoEquiposModel();
    $Equipo=$objEquipo->Consultar($sql);
    
    include_once('../../views/Ingresos/GuiBuscarIngresoE.html.php');
  }

  function getVerDC(){
	$objIngresoEquiDc= new IngresoEquiposModel();

    $numero_ingreso=$_GET['numero_doc'];
    $sede=$_GET['nit_sede'];
    $serie=$_GET['serie'];
    
    $sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
    $IngresoEqui=$objIngresoEquiDc->Consultar($sql);
  
    $sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
	$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);
	   
    $sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Estado='A' ORDER BY Razon_Social";
	$Cliente=$objIngresoEquiDc->Consultar($sqlCliente);
	
    $sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
	$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo);
	
    $sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
	$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);
	
    $sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '2' AND Estado='A' ORDER BY Descripcion";
	$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);

    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
	$sedes=$objIngresoEquiDc->Consultar($sqlsede);

	$sqlDetalle="SELECT Numero_Registro, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, Va, Vc, Ia, Ic 
					FROM detalle_equipo 
							WHERE Numero_serie='$serie' AND Nit_Empresa='$sede'";
	$Detalle=$objIngresoEquiDc->Consultar($sqlDetalle);
	
	$sqlDetalle2="SELECT Frame, Tipo, Modulo, Style, Form, Frecuencia, Conexion, Fs, Encl, Ip, Insul_Cls
							FROM ingreso_equipos 
								WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
	$Detalle2=$objIngresoEquiDc->Consultar($sqlDetalle2);


    if(!empty($Equipo[0][1])){
        $sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
        $Planta=$objIngresoEquiDc->Consultar($sqlplanta);
    }
    else{
        $Planta=null;
    }
   
    
    // if(!empty($Equipo[0][2])){
    //     $sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
    //     $contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
    // }
    // else{
    //     $contactos=null;
    // }
    
    include_once('../../views/Ingresos/GuiVerIngresoDC.html.php');
  }

	function getEditarDC(){
	$objIngresoEquiDc= new IngresoEquiposModel();

    $numero_ingreso=$_GET['numero_doc'];
    $sede=$_GET['nit_sede'];
    $serie=$_GET['serie'];
    
    $sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
    $IngresoEqui=$objIngresoEquiDc->Consultar($sql);
  
    $sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
	$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);
	   
    $sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Estado='A' ORDER BY Razon_Social";
	$Cliente=$objIngresoEquiDc->Consultar($sqlCliente);
	
    $sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
	$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo);
	
    $sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
	$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);
	
    $sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '2' AND Estado='A' ORDER BY Descripcion";
	$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);

    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
	$sedes=$objIngresoEquiDc->Consultar($sqlsede);

	$sqlDetalle="SELECT Numero_Registro, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, Va, Vc, Ia, Ic 
					FROM detalle_equipo 
							WHERE Numero_serie='$serie' AND Nit_Empresa='$sede'";
	$Detalle=$objIngresoEquiDc->Consultar($sqlDetalle);
		
	$sqlDetalle2="SELECT Frame, Tipo, Modulo, Style, Form, Frecuencia, Conexion, Fs, Encl, Ip, Insul_Cls
							FROM ingreso_equipos 
								WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
	$Detalle2=$objIngresoEquiDc->Consultar($sqlDetalle2);

    if(!empty($Equipo[0][1])){
        $sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
        $Planta=$objIngresoEquiDc->Consultar($sqlplanta);
    }
    else{
        $Planta=null;
    }
    
    // if(!empty($Equipo[0][2])){
    //     $sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
    //     $contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
    // }
    // else{
    //     $contactos=null;
    // }
    
    include_once('../../views/Ingresos/GuiEditarIngresoDC.html.php');
  }

	function postEditarDC(){
		extract($_POST);

		$objIngresoEqui= new IngresoEquiposModel();
		
        $usu_id= $_SESSION['usua_id'];
       if(!isset($Urgente)){$Urgente='N';}else{$Urgente="S";}
       if(!isset($Estator)){$Estator='N';}else{$Estator="S";}
       if(!isset($Caperuza)){$Caperuza='N';}else{$Caperuza="S";}
       if(!isset($Patas)){$Patas='N';}else{$Patas="S";}
       if(!isset($Tapa_Caja_Conexiones)){$Tapa_Caja_Conexiones='N';}else{$Tapa_Caja_Conexiones="S";}
       if(!isset($Reglete_de_Conexiones)){$Reglete_de_Conexiones='N';}else{$Reglete_de_Conexiones="S";}
       if(!isset($Tornillos_Tapas)){$Tornillos_Tapas='N';}else{$Tornillos_Tapas="S";}
	   if(!isset($Portaescobillas)){$Portaescobillas='N';}else{$Portaescobillas="S";}
	   if(!isset($Otros)){$Otros='';}else{$Otros=$textotros;}
       if(!isset($Caja_Conexiones)){$Caja_Conexiones='N';}else{$Caja_Conexiones="S";}
       if(!isset($Cunas)){$Cunas='N';}else{$Cunas="S";}
       if(!isset($Polea)){$Polea='N';}else{$Polea="S";}
       if(!isset($Flejes)){$Flejes='N';}else{$Flejes="S";}
       if(!isset($Bornera)){$Bornera='N';}else{$Bornera="S";}
       if(!isset($Blower)){$Blower='N';}else{$Blower="S";}
       if(!isset($Brida)){$Brida='N';}else{$Brida="S";}
       if(!isset($Contratapas)){$Contratapas='N';}else{$Contratapas="S";}
       if(!isset($Escobillas)){$Escobillas='N';}else{$Escobillas="S";}
       if(!isset($Colector)){$Colector='N';}else{$Colector="S";}
       if(!isset($Acople)){$Acople='';}else{$Acople=$textacople;}
       if(!isset($Armadura)){$Armadura='N';}else{$Armadura="S";}
       if(!isset($Visor)){$Visor='';}else{$Visor=$textvisor;}
       if(!isset($Placa_Datos)){$Placa_Datos='N';}else{$Placa_Datos="S";}
       if(!isset($Ventilador)){$Ventilador='N';}else{$Ventilador="S";}
	   if(!isset($Cancamo)){$Cancamo='';}else{$Cancamo=$textcancamo;}
	   
	   $sqlNumero="SELECT Numero_Ingreso FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieDC' AND Nit_Empresa='$nit_sede'";
		$numero_doc=$objIngresoEqui->Consultar($sqlNumero);

	   $sql1="UPDATE ingreso_equipos SET Numero_Serie='$Numero_Serie', Detalle_De_Equipo='$Detalle_De_Equipo', Fecha_Ingreso='$Fecha_Ingreso', Enviado_Para='$Enviado_Para', 
	   Enviado_Por='$despachado_por', Cedula_Empleado='$Cedula_Empleado', Observaciones='$Observaciones', Contacto_Envia=null, 
	   Urgente='$Urgente', Estator='$Estator', Caperuza='$Caperuza', Patas='$Patas', Tapa_Caja_Conexiones='$Tapa_Caja_Conexiones', 
	   Reglete_de_Conexiones='$Reglete_de_Conexiones', Tornillos_Tapas='$Tornillos_Tapas', Tapa_de_Bornera=null, Portaescobillas='$Portaescobillas', 
	   Caja_Conexiones='$Caja_Conexiones', Cunas='$Cunas', Polea='$Polea', Flejes='$Flejes', Bornera='$Bornera', Blower='$Blower', Brida='$Brida', 
	   Contratapas='$Contratapas', Otros='$Otros', Escobillas='$Escobillas',Colector='$Colector', Acople='$Acople', Armadura='$Armadura', Visor='$Visor', 
	   Orden_Servicio='$Orden_Servicio', Placa_Datos='$Placa_Datos', Ventilador='$Ventilador', Cancamo='$Cancamo',
		Requisitos_Cliente='$Requisitos_Cliente', Ubicacion='$Ubicacion', Usuario_Modifica='$usu_id', Fecha_Modifica=NOW() 
		WHERE Numero_Serie='$Numero_SerieDC' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql1);
	
		if (isset($Frame) OR isset($Tipo) OR isset($Mod) OR isset($Frecuencia) OR isset($Conexion) OR isset($Fs) OR isset($Encl) 
		OR isset($Ip) OR isset($Insul_Cls) OR isset($Style) OR isset($Form)) {
			$sql2="UPDATE ingreso_equipos SET Frame='$Frame', Tipo='$Tipo', Modulo='$Mod', Frecuencia='$Frecuencia', Conexion='$Conexion', Fs='$Fs', Encl='$Encl', Ip='$Ip', 
			Insul_Cls='$Insul_Cls', Style='$Style', Form='$Form' WHERE Numero_Serie='$Numero_SerieDC' AND Nit_Empresa='$nit_sede'";
			$objIngresoEqui->Actualizar($sql2);
		}

		$sql3="UPDATE equipos SET Numero_Serie='$Numero_Serie', Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$no_fases', 
		Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo' WHERE Numero_Serie='$Numero_SerieDC' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql3);
       
        $sql4="UPDATE detalle_equipo SET Numero_Serie='$Numero_Serie' WHERE Numero_Serie='$Numero_SerieDC' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql4);

        if (isset($PotenciaEditar)) {
			for($i=0; $i<count($PotenciaEditar); $i++){
					$sql5="UPDATE detalle_equipo SET Unidad_De_Potencia='$Unidad_De_PotenciaEditar[$i]', 
					Potencia='$PotenciaEditar[$i]', Revoluciones_Por_Minuto='$Revoluciones_Por_MinutoEditar[$i]', Va='$VaEditar[$i]', Vc='$VcEditar[$i]', 
					Ia='$IaEditar[$i]', Ic='$IcEditar[$i]' WHERE Numero_Registro='$Numero_RegistroEditar[$i]' AND Nit_Empresa='$nit_sede'";

					$objIngresoEqui->Actualizar($sql5);
			}
		}
		if(isset($PotenciaInsert)){
			for($i=0; $i<count($PotenciaInsert); $i++){
				$sql6="INSERT INTO detalle_equipo 
				(Numero_Registro, Numero_Serie, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, 
				Va, Vc, Ia, Ic, Nit_Empresa)
				VALUES 
				(null, '$Numero_Serie', '$PotenciaInsert[$i]', '$Unidad_De_PotenciaInsert[$i]', '$Revoluciones_Por_MinutoInsert[$i]', 
				'$VaInsert[$i]', '$VcInsert[$i]', '$IaInsert[$i]', '$IcInsert[$i]', '$nit_sede')";
				
				$objIngresoEqui->Insertar($sql6);
			}
		}
		echo messageSweetAlert("El registro se ha actualizado con éxito", "", "success", "", "si", "automatica", getUrl('Ingresos', 'Ingresos', 'getEditarDC', array("numero_doc" => $numero_doc[0][0], "serie" => $Numero_Serie, "nit_sede" => $nit_sede)), 2500);
 	}

	function BuscarDatosElecEquiOT(){
		$objEquipo = new IngresoEquiposModel();
		$serie=$_POST['serie'];
		$nit_sede=$_POST['nit_sede'];

		$sqlDetalle="SELECT Numero_Registro, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, Va, Vc, Ia, Ic
					FROM detalle_equipo
							WHERE Numero_serie='$serie' AND Nit_Empresa='$nit_sede' ";
		
		$sqlEquipo="SELECT  Frame, Tipo, Modulo, Style, Form, Frecuencia, Conexion, Fs, Ip, Insul_Cls, Rotor, Encl
							FROM ingreso_equipos
								WHERE Numero_serie='$serie' AND Nit_Empresa='$nit_sede' ";

		$Equipo=$objEquipo->Consultar($sqlEquipo);
		$Detalle=$objEquipo->Consultar($sqlDetalle);

	  include_once('../../views/Ingresos/GuiVerDatoSELECTOUT.html.php');
	}
	
    function AnularIngreso(){
        $numDoc=$_POST['num_doc'];
        $Razon_Anula=$_POST['Razon_Anula'];
        $Usuario_Anula= $_SESSION['usua_id'];
        $nit_sede=$_POST['nit_sede'];
        $fecha=date('Y-m-d');
        $objEquipo= new IngresoEquiposModel ();
        $sqlIngreso="update ingreso_equipos set Usuario_Anula='$Usuario_Anula', Fecha_Anula='$fecha', Razon_Anula='$Razon_Anula',  Estado='I' 
                        WHERE Numero_Ingreso='$numDoc'  AND Nit_Empresa='$nit_sede'";
        $UpdateIngreso=$objEquipo->Anular($sqlIngreso);
	   
        
    }
    
    function VerDatosAdicionales(){
        $objEquipo= new IngresoEquiposModel();
        $num_doc=$_POST['num_doc'];
        $nit_sede=$_POST['nit_sede'];

        $sqlDatos="SELECT CONCAT(Nombres, ' ', Apellidos), Fecha_Modifica, Usuario_Anula,Fecha_Anula, Razon_Anula, Usuario_Modifica 
                        FROM ingreso_equipos, usuarios
                            WHERE ingreso_equipos.Usuario_Crea=usuarios.Cedula
                                AND Numero_Ingreso='$num_doc' AND ingreso_equipos.Nit_Empresa='$nit_sede'";  
        $datos=$objEquipo->Consultar($sqlDatos);
       
        if($datos <> null){
            if($datos[0][5] <>  ""){
                $sqlModifica="SELECT CONCAT(Nombres, ' ', Apellidos) FROM usuarios WHERE usuarios.Cedula='".$datos[0][5]."'";
                $modifica=$objEquipo->Consultar($sqlModifica);
                $usuModifica=$modifica[0][0];
                $fechaModifica=$datos[0][1];
            }
            else{
                $usuModifica="";
                $fechaModifica="";
            }
            
            
            if($datos[0][2] <>  "") {
                $sqlElimina="SELECT CONCAT(Nombres, ' ', Apellidos) FROM usuarios WHERE usuarios.Cedula='".$datos[0][2]."'";
                $elimina=$objEquipo->Consultar($sqlElimina);
                $usuElimina=$elimina[0][0];
                $fechaElimina=substr($datos[0][3],0,10);
                
            }
            else{
                $usuElimina="";
                $fechaElimina="";
            }
            include_once('../../views/Ingresos/GuiVerDatosAdicionales.html.php'); 
        }
    }
	
	function getContactoPlanta()
	{
		$objEquipo= new IngresoEquiposModel();
        $planta=$_POST['planta'];
       
		$sqlcontacto="SELECT Nombre_contacto FROM contactos WHERE Codigo_Planta='$planta' ORDER BY Nombre_contacto";
		$contactos=$objEquipo->Consultar($sqlcontacto);
		
		if($contactos <> null)
		{
			include_once'../../views/Ingresos/GuiLlenarContacto.html.php';
		}
		else
		{
			/*$sqlcontacto="SELECT Nombre_contacto FROM contactos WHERE Codigo_Planta='$planta' ORDER BY Nombre_contacto";
			$contactos=$objEquipo->Consultar($sqlcontacto);*/
		}
		
	}
	
	function PostCrearAC(){
		extract($_POST);

		$objIngresoEqui = new IngresoEquiposModel();
		
		$usu_id=$_SESSION['usua_id'];
		if(!isset($Estator)){$Estator='N';}else{$Estator="S";}
		if(!isset($Inventario_Rotor)){$Inventario_Rotor='N';}else{$Inventario_Rotor="S";}
		if(!isset($Caja_Conexiones)){$Caja_Conexiones='N';}else{$Caja_Conexiones="S";}
		if(!isset($Contratapas)){$Contratapas='N';}else{$Contratapas="S";}
		if(!isset($Escobillas)){$Escobillas='N';}else{$Escobillas="S";}
		if(!isset($Tapa_Conexiones)){$Tapa_Conexiones='N';}else{$Tapa_Conexiones="S";}
		if(!isset($Tornillos)){$Tornillos_Tapas='N';}else{$Tornillos_Tapas="S";}
		if(!isset($Colector)){$Colector='N';}else{$Colector="S";}
		if(!isset($ventiladorInt)){$ventiladorInt='N';}else{$ventiladorInt="S";}
		if(!isset($Cancamo)){$Cancamo='';}else{$Cancamo=$textcancamo;}
		if(!isset($Flejes)){$Flejes='N';}else{$Flejes="S";}
		if(!isset($Flanje)){$Flanje='N';}else{$Flanje="S";}
		if(!isset($Caperuza)){$Caperuza='N';}else{$Caperuza="S";}
		if(!isset($Acople)){$Acople='';}else{$Acople=$textacople;}
		if(!isset($Cunas)){$Cunas='N';}else{$Cunas="S";}
		if(!isset($Bornera)){$Bornera='N';}else{$Bornera="S";}
		if(!isset($Patas)){$Patas='N';}else{$Patas="S";}
		if(!isset($Polea)){$Polea='N';}else{$Polea="S";}
		if(!isset($Blower)){$Blower='N';}else{$Blower="S";}
		if(!isset($Placa_Datos)){$Placa_Datos='N';}else{$Placa_Datos="S";}
		if(!isset($Reglete_de_Conexiones)){$Reglete_de_Conexiones='N';}else{$Reglete_de_Conexiones="S";}
		if(!isset($Brida)){$Brida='N';}else{$Brida="S";}
		if(!isset($Portaescobillas)){$Portaescobillas='N';}else{$Portaescobillas="S";}
		if(!isset($Otros)){$Otros='';}else{$Otros=$textotros;}
		
		$contacto_envia="";
		$despachado_por="$despachado_por";
        date_default_timezone_set('America/Bogota');
		$Fecha_Ingreso=date('Y-m-d');
        $Hora_Ingreso="0000-00-00 ".date('h:i:s');

	    if (!empty($Numero_SerieAC)) {
			$sql1="INSERT INTO ingreso_equipos 
			(Numero_Ingreso, Fecha_Ingreso, Numero_Serie, Detalle_De_Equipo, Enviado_Para, Enviado_Por, Cedula_Empleado, Estado, Observaciones,
			Usuario_Crea, Hora_Ingreso, Contacto_Envia, Estator, Caperuza, Patas, Tapa_Caja_Conexiones, 
			Reglete_de_Conexiones, Tornillos_Tapas, Portaescobillas, Caja_Conexiones, Cunas, Polea, Flejes, Bornera, 
			Blower, Brida, Contratapas, Otros, Escobillas, Colector, Acople, Inventario_Rotor, Orden_Servicio, Placa_Datos, 
			Ventilador, Cancamo, Flanje, Requisitos_Cliente, Ubicacion, Fecha_Cierre_Virtual, Nit_Empresa, tipo_ingreso)
			VALUES
			(null, '$Fecha_Ingreso', '$Numero_SerieAC', '$Detalle_De_Equipo', '$Enviado_Para', '$despachado_por', '$Cedula_Empleado', 'A', '$Observaciones',  
			'$usu_id', '$Hora_Ingreso', '$contacto_envia', '$Estator', '$Caperuza', '$Patas', '$Tapa_Conexiones', 
			'$Reglete_de_Conexiones', '$Tornillos_Tapas', '$Portaescobillas', '$Caja_Conexiones', '$Cunas', '$Polea', '$Flejes', '$Bornera', 
			'$Blower', '$Brida', '$Contratapas', '$Otros', '$Escobillas', '$Colector', '$Acople', '$Inventario_Rotor', '$Orden_Servicio', 
			'$Placa_Datos', '$ventiladorInt', '$Cancamo', '$Flanje', '$Requisitos_Cliente', '$Ubicacion', '0000-00-00 00:00:00',  '$nit_sede',  'AC')";
			
			$objIngresoEqui->Insertar($sql1);

			$sqlBuscaIngreEqui="SELECT * FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieAC' ORDER BY Numero_Ingreso DESC LIMIT 1";
			$RegIngreEqui=$objIngresoEqui->Consultar($sqlBuscaIngreEqui);

			if ($RegIngreEqui != null) {
				$sqlBuscaEqui="SELECT * FROM equipos WHERE Numero_Serie='$Numero_SerieAC' AND Nit_Empresa='$nit_sede'";
				$RegEqui=$objIngresoEqui->Consultar($sqlBuscaEqui);
				
				if($RegEqui != null){
					$sql2="UPDATE equipos SET Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$no_fases', Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo'
										WHERE Numero_Serie='$Numero_SerieAC' AND Nit_Empresa='$nit_sede'";
					$objIngresoEqui->Actualizar($sql2);
				}
				else{
					$sql2="INSERT INTO equipos VALUES ('$Numero_SerieAC','$Nit_Cliente','$Codigo_Planta','$no_fases','$Codigo_Marca','$Codigo_Tipo_Equipo', '$nit_sede')";
					$objIngresoEqui->Insertar($sql2);
				}

				if (isset($PotenciaInsert)) {
					$sql3="UPDATE ingreso_equipos SET Frame='$Frame', Tipo='$Tipo', Modulo='$Mod', Cos='$Cos', Eficiencia='$Eficiencia', 
					Frecuencia='$Frecuencia', Conexion='$Conexion', Fs='$Fs', Encl='$Encl', Ip='$Ip', Insul_Cls='$Insul_Cls', Rotor='$RotorDetalle' 
					WHERE Numero_Serie='$Numero_SerieAC'";
					$objIngresoEqui->Actualizar($sql3);
					
					for($i=0; $i<count($PotenciaInsert); $i++){
						$sql4="INSERT INTO detalle_equipo 
						(Numero_Registro, Numero_Serie, Potencia, Revoluciones_Por_Minuto, Voltaje, Amperaje, 
						Unidad_De_Potencia, Nit_Empresa) 
						VALUES 
						(null, '$Numero_SerieAC', ".$PotenciaInsert[$i].", ".$Revoluciones_Por_MinutoInsert[$i].", $VoltajeInsert[$i], ".$AmperajeInsert[$i].", 
						'".$Unidad_De_PotenciaInsert[$i]."', '$nit_sede') ";
						$objIngresoEqui->Insertar($sql4);
					}
				}
				echo messageSweetAlert("El registro se ha realizado con éxito.<br>", '<h2 class="swal2-title">Número de Ingreso: <span class="badge badge-secondary">' . $RegIngreEqui[0][0] . '</span></h2>', "success", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearAC'));
			}else{
				echo messageSweetAlert("No se pudo realizar el registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearAC'));
			}
		}else{
			echo messageSweetAlert("Falta el Número de Registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearAC'));
		}
	}

	function getVerAC(){
		$objIngresoEquiDc= new IngresoEquiposModel();

		$numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
		$IngresoEqui=$objIngresoEquiDc->Consultar($sql);
	  
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);

		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Estado='A' ORDER BY Razon_Social";
		$Cliente=$objIngresoEquiDc->Consultar($sqlCliente);

		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo);

		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);

		$sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '1' AND Estado='A' ORDER BY Descripcion";
		$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);

	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede'ORDER BY nombre";
		$sedes=$objIngresoEquiDc->Consultar($sqlsede);

		$sqlDetalle="SELECT Numero_Registro, Potencia, Unidad_De_Potencia,Revoluciones_Por_Minuto, Voltaje, Amperaje
					FROM detalle_equipo 
							WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
		$Detalle=$objIngresoEquiDc->Consultar($sqlDetalle);
		
		$sqlDetalle2="SELECT Frame, Tipo, Modulo, Cos, Eficiencia, Frecuencia, Conexion, Fs, Encl, Ip, Insul_Cls, Rotor
							FROM ingreso_equipos 
								WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
		$Detalle2=$objIngresoEquiDc->Consultar($sqlDetalle2);
		
		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiDc->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}
		
		// if(!empty($Equipo[0][2])){
		// 	echo $sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }
		
		include_once('../../views/Ingresos/GuiVerIngresoAC.html.php');
	}
	
	function getEditarAC(){
		$objIngresoEquiDc= new IngresoEquiposModel();

		$numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
		$IngresoEqui=$objIngresoEquiDc->Consultar($sql);
	  
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);

		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Estado='A' ORDER BY Razon_Social";
		$Cliente=$objIngresoEquiDc->Consultar($sqlCliente);

		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo);

		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);

		$sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '1' AND Estado='A' ORDER BY Descripcion";
		$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);

	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede'ORDER BY nombre";
		$sedes=$objIngresoEquiDc->Consultar($sqlsede);

		$sqlDetalle="SELECT Numero_Registro, Potencia, Unidad_De_Potencia,Revoluciones_Por_Minuto, Voltaje, Amperaje
					FROM detalle_equipo 
							WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
		$Detalle=$objIngresoEquiDc->Consultar($sqlDetalle);
		
		$sqlDetalle2="SELECT Frame, Tipo, Modulo, Cos, Eficiencia, Frecuencia, Conexion, Fs, Encl, Ip, Insul_Cls, Rotor
							FROM ingreso_equipos 
								WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
		$Detalle2=$objIngresoEquiDc->Consultar($sqlDetalle2);
		
		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiDc->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}
		
		// if(!empty($Equipo[0][2])){
		// 	$sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }
		
		include_once('../../views/Ingresos/GuiEditarIngresoAC.html.php');
	}
	
	
	function postEditarAC(){
	    extract($_POST);
		
		$objIngresoEqui= new IngresoEquiposModel();

		$usu_id=$_SESSION['usua_id'];
		if(!isset($Estator)){$Estator='N';}else{$Estator="S";}
		if(!isset($Inventario_Rotor)){$Inventario_Rotor='N';}else{$Inventario_Rotor="S";}
		if(!isset($Caja_Conexiones)){$Caja_Conexiones='N';}else{$Caja_Conexiones="S";}
		if(!isset($Contratapas)){$Contratapas='N';}else{$Contratapas="S";}
		if(!isset($Escobillas)){$Escobillas='N';}else{$Escobillas="S";}
		if(!isset($Tapa_Conexiones)){$Tapa_Conexiones='N';}else{$Tapa_Conexiones="S";}
		if(!isset($Tornillos_Tapas)){$Tornillos_Tapas='N';}else{$Tornillos_Tapas="S";}
		if(!isset($Colector)){$Colector='N';}else{$Colector="S";}
		if(!isset($Ventilador)){$Ventilador='N';}else{$Ventilador="S";}
		if(!isset($Cancamo)){$Cancamo='';}else{$Cancamo=$textcancamo;}
		if(!isset($Flejes)){$Flejes='N';}else{$Flejes="S";}
		if(!isset($Flanje)){$Flanje='N';}else{$Flanje="S";}
		if(!isset($Caperuza)){$Caperuza='N';}else{$Caperuza="S";}
		if(!isset($Acople)){$Acople='';}else{$Acople=$textacople;}
		if(!isset($Cunas)){$Cunas='N';}else{$Cunas="S";}
		if(!isset($Bornera)){$Bornera='N';}else{$Bornera="S";}
		if(!isset($Patas)){$Patas='N';}else{$Patas="S";}	
		if(!isset($Polea)){$Polea='N';}else{$Polea="S";}
		if(!isset($Blower)){$Blower='N';}else{$Blower="S";}
		if(!isset($Placa_Datos)){$Placa_Datos='N';}else{$Placa_Datos="S";}	
		if(!isset($Reglete_de_Conexiones)){$Reglete_de_Conexiones='N';}else{$Reglete_de_Conexiones="S";}	
		if(!isset($Brida)){$Brida='N';}else{$Brida="S";}	
		if(!isset($Portaescobillas)){$Portaescobillas='N';}else{$Portaescobillas="S";}	
		if(!isset($Otros)){$Otros='';}else{$Otros=$textotros;}
		
		$contacto_envia="";
		$despachado_por="$despachado_por";

		$sqlNumero="SELECT Numero_Ingreso FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieAC' AND Nit_Empresa='$nit_sede'";
		$numero_doc=$objIngresoEqui->Consultar($sqlNumero);

		$sql1="UPDATE ingreso_equipos SET Numero_Serie='$Numero_Serie', Detalle_De_Equipo='$Detalle_De_Equipo', Fecha_Ingreso='$Fecha_Ingreso', Enviado_Para='$Enviado_Para', Enviado_Por='$despachado_por', 
		Cedula_Empleado='$Cedula_Empleado', Observaciones='$Observaciones', Contacto_Envia=Null, Estator='$Estator', Caperuza='$Caperuza', 
		Patas='$Patas', Reglete_de_Conexiones='$Reglete_de_Conexiones', Tornillos_Tapas='$Tornillos_Tapas', Tapa_de_Bornera=NULL, 
		Portaescobillas='$Portaescobillas', Caja_Conexiones='$Caja_Conexiones', Cunas='$Cunas', Polea='$Polea', Flejes='$Flejes', 
		Bornera='$Bornera', Blower='$Blower', Brida='$Brida', Contratapas='$Contratapas', Otros='$Otros', Escobillas='$Escobillas', Colector='$Colector', 
		Caja_Conexiones='$Caja_Conexiones', Tapa_Caja_Conexiones='$Tapa_Conexiones', Colector='$Colector', Flanje='$Flanje', Acople='$Acople', 
		Inventario_Rotor='$Inventario_Rotor', Orden_Servicio='$Orden_Servicio', Placa_Datos='$Placa_Datos', Ventilador='$Ventilador', Cancamo='$Cancamo', 
		Requisitos_Cliente='$Requisitos_Cliente', Ubicacion='$Ubicacion', Usuario_Modifica='$usu_id', Fecha_Modifica=NOW()
		WHERE Numero_Serie='$Numero_SerieAC' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql1);
	
		if (isset($Frame) OR isset($Tipo) OR isset($Mod) OR isset($Cos) OR isset($Eficiencia) OR isset($Frecuencia) OR isset($Conexion) OR isset($Fs) OR isset($Encl) 
		OR isset($Ip) OR isset($Insul_Cls) OR isset($RotorDetalle)) {
			$sql2="UPDATE ingreso_equipos SET Frame='$Frame', Tipo='$Tipo', Modulo='$Mod', Cos='$Cos', Eficiencia='$Eficiencia', Frecuencia='$Frecuencia', Conexion='$Conexion', Fs='$Fs', 
			Encl='$Encl', Ip='$Ip', Insul_Cls='$Insul_Cls', Rotor='$RotorDetalle' WHERE Numero_Serie='$Numero_SerieAC' AND Nit_Empresa='$nit_sede'";
			$objIngresoEqui->Actualizar($sql2);
		}

		$sql3="UPDATE equipos SET Numero_Serie='$Numero_Serie', Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$fases', 
		Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo' WHERE Numero_Serie='$Numero_SerieAC' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql3);

		$sql4="UPDATE detalle_equipo SET Numero_Serie='$Numero_Serie' WHERE Numero_Serie='$Numero_SerieAC' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql4);

        if (isset($PotenciaEditar)) {
			for($i=0; $i<count($PotenciaEditar); $i++){
					$sql5="UPDATE detalle_equipo SET Unidad_De_Potencia='$Unidad_De_PotenciaEditar[$i]', 
					Potencia='$PotenciaEditar[$i]', Revoluciones_Por_Minuto='$Revoluciones_Por_MinutoEditar[$i]', Voltaje='$VoltajeEditar[$i]', 
					Amperaje='$AmperajeEditar[$i]' WHERE Numero_Registro='$Numero_RegistroEditar[$i]' AND Nit_Empresa='$nit_sede'";
					$objIngresoEqui->Actualizar($sql5);
			}
		}
		if(isset($PotenciaInsert)){
			for($i=0; $i<count($PotenciaInsert); $i++){
				$sql6="INSERT INTO detalle_equipo 
				(Numero_Registro, Numero_Serie, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, 
				Voltaje, Amperaje, Nit_Empresa)
				VALUES 
				(null, '$Numero_Serie', '$PotenciaInsert[$i]', '$Unidad_De_PotenciaInsert[$i]', '$Revoluciones_Por_MinutoInsert[$i]', 
				'$VoltajeInsert[$i]', '$AmperajeInsert[$i]', '$nit_sede')";
				$objIngresoEqui->Insertar($sql6);
			}
		}
		echo messageSweetAlert("El registro se ha actualizado con éxito", "", "success", "", "si", "automatica", getUrl('Ingresos', 'Ingresos', 'getEditarAC', array("numero_doc" => $numero_doc[0][0], "serie" => $Numero_Serie, "nit_sede" => $nit_sede)), 2500);
	}


	/******************************TRANSFORMADORES******************************/
	
	function crearTR(){		

    $objIngreso= new IngresoEquiposModel();
    
    $sqlTipos_Equipos = "SELECT Codigo_Tipo_Equipo, Descripcion FROM tipos_equipos WHERE Codigo_Grupo = '3' AND Estado='A' ORDER BY Descripcion";
    $Tipos_Equipos = $objIngreso->Consultar($sqlTipos_Equipos);
   
    $sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
    $Marca = $objIngreso->Consultar($sqlMarca);
    
    $sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY Cedula_Empleado";
    $Empleado = $objIngreso->Consultar($sqlEmpleado);
   
    $sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes ORDER BY Razon_Social";
    $Cliente = $objIngreso->Consultar($sqlCliente);
    
    $sqlsede="SELECT nit_empresa, nombre FROM sedes ORDER BY nombre";
    $sedes=$objIngreso->Consultar($sqlsede);
    

    include_once('../../views/Ingresos/GuiIngresoTR.html.php');

  }
  
  
  	function PostCrearTR(){
		extract($_POST);

		$objIngresoEqui= new IngresoEquiposModel();
		
		$usu_id=$_SESSION['usua_id'];
		if(!isset($cuba)){$cuba='N';}else{$cuba="S";}
		if(!isset($tapa)){$tapa='N';}else{$tapa="S";}
		if(!isset($nucleo)){$nucleo='N';}else{$nucleo="S";}
		if(!isset($bobinas)){$bobinas='N';}else{$bobinas="S";}
		if(!isset($aceite)){$aceite='';}else{$aceite=$textaceite;}
		if(!isset($aislamientoat)){$aislamientoat='';}else{$aislamientoat=$textaislamientoat;}
		if(!isset($aislamientobt)){$aislamientobt='';}else{$aislamientobt=$textaislamientobt;}
		if(!isset($empaqueat)){$empaqueat='';}else{$empaqueat=$textempaqueat;}
		if(!isset($empaquebt)){$empaquebt='';}else{$empaquebt=$textempaquebt;}
		if(!isset($bornera)){$bornera='N';}else{$bornera="S";}
		if(!isset($radiadores)){$radiadores='';}else{$radiadores=$textradiadores;}
		if(!isset($ventiladores)){$ventiladores='';}else{$ventiladores=$textventiladores;}
		if(!isset($tapones)){$tapones='N';}else{$tapones="S";}
		if(!isset($cancamos)){$cancamos='';}else{$cancamos=$textcancamos;}
		if(!isset($tanqueEx)){$tanqueEx='N';}else{$tanqueEx="S";}
	    if(!isset($tanqueSi)){$tanqueSi='N';}else{$tanqueSi="S";}
	    if(!isset($visor)){$visor='N';}else{$visor="S";}
	    if(!isset($nivelAcite)){$nivelAcite='N';}else{$nivelAcite="S";}
	    if(!isset($valvula)){$valvula='';}else{$valvula=$textvalvula;}
	    if(!isset($cambiador)){$cambiador='N';}else{$cambiador="S";}
	    if(!isset($rele)){$rele='N';}else{$rele="S";}
	    if(!isset($cables)){$cables='N';}else{$cables="S";}
	    if(!isset($placa)){$placa='N';}else{$placa="S";}
	    if(!isset($Otros)){$Otros='';}else{$Otros=$textotros;}
	    
	    $contacto_envia="";
	
	    date_default_timezone_set('America/Bogota');
        $Fecha_Ingreso=date('Y-m-d');
		$Hora_Ingreso="0000-00-00 ".date('h:i:s');
		
		if (!empty($Numero_SerieTR)) {
			$sql1="INSERT INTO ingreso_equipos 
			(Numero_Ingreso, Fecha_Ingreso, Numero_Serie, Detalle_De_Equipo, Enviado_Para, Enviado_Por, Cedula_Empleado, Estado, 
			Observaciones, Usuario_Crea, Hora_Ingreso, Contacto_Envia, Bornera, Otros, Frecuencia, Conexion, 
			Insul_Cls, Grupo_Conexion, Cuba, Tapa_Cuba, Nucleo, Bobinas, Aceite, Aislamientos_At, Aislamientos_Bt, Empaques_At, 
			Empaques_Bt, Radiadores, Tapones, Tanque_Expansion, Tanque_Silica, Visor, Indicador_Nivel_Aceite, Cambiador_Taps, Valvula, 
			Rele_Buchholz, Cables_Baja, Orden_Servicio, Placa_Datos, Regulacion, Ventilador, Cancamo, Tamayo_Cif, 
			Requisitos_Cliente, Ubicacion, Fecha_Cierre_Virtual, Nit_Empresa, tipo_ingreso)
			VALUES 
			(null, '$Fecha_Ingreso', '$Numero_SerieTR', '$Detalle_De_Equipo', '$Enviado_Para', '$despachado_por', '$Cedula_Empleado', 'A', 
			'$Observaciones', '$usu_id', '$Hora_Ingreso', '$contacto_envia', '$bornera', '$Otros', '$frecuencia', '$conexion', 
			'$insul', '$grupoconex', '$cuba', '$tapa', '$nucleo', '$bobinas', '$aceite', '$aislamientoat', '$aislamientobt', '$textempaqueat', 
			'$textempaquebt', '$radiadores', '$tapones', '$tanqueEx', '$tanqueSi', '$visor', '$nivelAcite', '$cambiador', '$valvula', 
			'$rele', '$cables', '$Orden_Servicio', '$placa', '$regulacion', '$textventiladores', '$cancamos', '$cif', 
			'$Requisitos_Cliente', '$Ubicacion', '0000-00-00 00:00:00', '$nit_sede', 'TR')";
			$IngresoEqui=$objIngresoEqui->Insertar($sql1);

			$sqlBuscaIngreEqui="SELECT * FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieTR' ORDER BY Numero_Ingreso DESC LIMIT 1";
			$RegIngreEqui=$objIngresoEqui->Consultar($sqlBuscaIngreEqui);
		
			if ($RegIngreEqui != null) {
				$sqlBuscaEqui="SELECT * FROM equipos WHERE Numero_Serie='$Numero_SerieTR'";
				$RegEqui=$objIngresoEqui->Consultar($sqlBuscaEqui);
			
				if($RegEqui != null){
					$sql2="UPDATE equipos SET Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$fases', Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo'
										WHERE Numero_Serie='$Numero_SerieTR'";
					$objIngresoEqui->Actualizar($sql2);
				}
				else{
					$sql2="INSERT INTO equipos VALUES ('$Numero_SerieTR','$Nit_Cliente','$Codigo_Planta','$fases','$Codigo_Marca','$Codigo_Tipo_Equipo', '$nit_sede')";
					$objIngresoEqui->Insertar($sql2);
				}
				
				$sql3="INSERT INTO detalle_equipo 
				(Numero_Registro, Numero_Serie, Potencia, Unidad_De_Potencia, V_Primario, V_Secundario1, V_Secundario2, I_Primario, I_Secundario, Nit_Empresa) 
				VALUES 
				(null, '$Numero_SerieTR', '$potencia', '$unidad', '$vp', '$vs1', '$vs2', '$ip', '$is', '$nit_sede')";
				$DatoElec=$objIngresoEqui->Insertar($sql3);

				echo messageSweetAlert("El registro se ha realizado con éxito.<br>", '<h2 class="swal2-title">Número de Ingreso: <span class="badge badge-secondary">' . $RegIngreEqui[0][0] . '</span></h2>', "success", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearTR'));
			}else{
				echo messageSweetAlert("No se pudo realizar el registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearTR'));
			}
		}else{
			echo messageSweetAlert("Falta el Número de Registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearTR'));
		}
	}

	function getVerTR(){
	    $numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
	  
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) as Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Estado='A' ORDER BY Razon_Social";
		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$sqlDEquipo="SELECT * FROM detalle_equipo WHERE Numero_Serie='$serie'";
		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '3' AND Estado='A' ORDER BY Descripcion";
	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede'ORDER BY nombre";
	   
		$objIngresoEquiDc= new IngresoEquiposModel();
		$IngresoEqui=$objIngresoEquiDc->Consultar($sql);
		$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);  
			   
		$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);   
		$Cliente=$objIngresoEquiDc->Consultar($sqlCliente); 
		$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo); 
		$DEquipo=$objIngresoEquiDc->Consultar($sqlDEquipo); 
		
		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiDc->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}

		// if(!empty($Equipo[0][2])){
		// 	$sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }
		
		$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);    
		$sedes=$objIngresoEquiDc->Consultar($sqlsede);
		
		include_once('../../views/Ingresos/GuiVerIngresoTR.html.php');
	}
	
	function getEditarTR(){
	    $numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
	  
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Estado='A' ORDER BY Razon_Social";
		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$sqlDEquipo="SELECT * FROM detalle_equipo WHERE Numero_Serie='$serie'";
		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '3' AND Estado='A' ORDER BY Descripcion";
	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede'ORDER BY nombre";
	   
		$objIngresoEquiDc= new IngresoEquiposModel();
		$IngresoEqui=$objIngresoEquiDc->Consultar($sql);
		$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);  
			   
		$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);   
		$Cliente=$objIngresoEquiDc->Consultar($sqlCliente); 
		$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo); 
		$DEquipo=$objIngresoEquiDc->Consultar($sqlDEquipo); 
		
		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiDc->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}

		// if(!empty($Equipo[0][2])){
		// 	$sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }
		
		$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);    
		$sedes=$objIngresoEquiDc->Consultar($sqlsede);
		
		include_once('../../views/Ingresos/GuiEditarIngresoTR.html.php');
	}
  
  
    function postEditarTR(){
		extract($_POST);
		
		$objIngresoEqui= new IngresoEquiposModel();
		
	    $usu_id=$_SESSION['usua_id'];
		if(!isset($cuba)){$cuba='N';}else{$cuba="S";}
		if(!isset($tapa)){$tapa='N';}else{$tapa="S";}
		if(!isset($nucleo)){$nucleo='N';}else{$nucleo="S";}
		if(!isset($bobinas)){$bobinas='N';}else{$bobinas="S";}
		if(!isset($aceite)){$textaceite='';}
		if(!isset($aislamientoat)){$textaislamientoat='';}
		if(!isset($aislamientobt)){$textaislamientobt='';}
		if(!isset($empaqueat)){$textempaqueat='';}
		if(!isset($empaquebt)){$textempaquebt='';}
		if(!isset($bornera)){$bornera='N';}else{$bornera="S";}
		if(!isset($radiadores)){$textradiadores='';}
		if(!isset($ventiladores)){$textventiladores='';}
		if(!isset($tapones)){$tapones='N';}else{$tapones="S";}
		if(!isset($cancamos)){$textcancamos='';}
		if(!isset($tanqueEx)){$tanqueEx='N';}else{$tanqueEx="S";}
	    if(!isset($tanqueSi)){$tanqueSi='N';}else{$tanqueSi="S";}
	    if(!isset($visor)){$visor='N';}else{$visor="S";}
	    if(!isset($nivelAcite)){$nivelAcite='N';}else{$nivelAcite="S";}
	    if(!isset($valvula)){$textvalvula='';}
	    if(!isset($cambiador)){$cambiador='N';}else{$cambiador="S";}
	    if(!isset($rele)){$rele='N';}else{$rele="S";}
	    if(!isset($cables)){$cables='N';}else{$cables="S";}
	    if(!isset($placa)){$placa='N';}else{$placa="S";}
		if(!isset($Otros)){$Otros='';}else{$Otros=$textotros;}
		
		$sqlNumero="SELECT Numero_Ingreso FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieTR' AND Nit_Empresa='$nit_sede'";
		$numero_doc=$objIngresoEqui->Consultar($sqlNumero);

		$sql1="UPDATE ingreso_equipos SET Numero_Serie='$Numero_Serie', Detalle_De_Equipo = '$Detalle_De_Equipo', Fecha_Ingreso='$Fecha_Ingreso', 
		Enviado_Para='$Enviado_Para', Enviado_Por='$despachado_por', Cedula_Empleado='$Cedula_Empleado', 
		Observaciones='$Observaciones', Otros='$Otros', 
		Orden_Servicio='$Orden_Servicio', Placa_Datos='$placa', Regulacion='$regulacion', Ventilador='$textventiladores', 
		Cancamo='$textcancamos', Requisitos_Cliente='$Requisitos_Cliente', Ubicacion='$Ubicacion', Usuario_Modifica='$usu_id', 
		Fecha_Modifica=NOW(), Frecuencia='$frecuencia', Conexion='$conexion', Ip='$ip', Insul_Cls='$insul', 
		Grupo_Conexion='$grupoconex', Cuba='$cuba', Tapa_Cuba='$tapa', Nucleo='$nucleo', Bobinas='$bobinas', Aceite='$textaceite', 
		Aislamientos_At='$textaislamientoat', Aislamientos_Bt='$textaislamientobt', Empaques_At='$textempaqueat', 
		Empaques_Bt='$textempaquebt', Bornera='$bornera', Radiadores='$textradiadores', Tapones='$tapones', Cancamo='$textcancamos', 
		Tamayo_Cif='$cif', Tanque_Expansion='$tanqueEx', Tanque_Silica='$tanqueSi', Visor='$visor', Indicador_Nivel_Aceite='$nivelAcite', 
		Valvula='$textvalvula', Cambiador_Taps='$cambiador', Rele_Buchholz='$rele', Cables_Baja='$cables' 
		WHERE Numero_Serie='$Numero_SerieTR' AND Nit_Empresa='$nit_sede'";
        
		$IngresoEqui=$objIngresoEqui->Actualizar($sql1);
		
		$sql2="UPDATE equipos SET Numero_Serie='$Numero_Serie', Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$fases', 
		Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo' WHERE Numero_Serie='$Numero_SerieTR' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql2);

		$sql3="UPDATE detalle_equipo SET Numero_Serie='$Numero_Serie', Potencia='$potencia', Unidad_De_Potencia='$unidad', 
		V_Primario='$vp', V_Secundario1='$vs1', V_Secundario2='$vs2', I_Primario='$ip', I_Secundario='$is' 
		WHERE Numero_Serie='$Numero_SerieTR' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql3);

		echo messageSweetAlert("El registro se ha actualizado con éxito", "", "success", "", "si", "automatica", getUrl('Ingresos', 'Ingresos', 'getEditarTR', array("numero_doc" => $numero_doc[0][0], "serie" => $Numero_Serie, "nit_sede" => $nit_sede)), 2500);
	}
	
	function PostCrearPT(){
		extract($_POST);
		
		$objIngresoEqui= new IngresoEquiposModel();
		
		$usu_id=$_SESSION['usua_id'];
	    $contacto_envia="";
	    date_default_timezone_set('America/Bogota');
        $Fecha_Ingreso=date('Y-m-d');
        $Hora_Ingreso="0000-00-00 ".date('h:i:s');

		if (!empty($Numero_SeriePT)) {
			$sql1="INSERT INTO ingreso_equipos 
			(Numero_Ingreso, Fecha_Ingreso, Numero_Serie, Detalle_De_Equipo, Enviado_Para, Enviado_Por, Cedula_Empleado, Estado, Observaciones, 
			Usuario_Crea, Hora_Ingreso, Contacto_Envia, Tipo, Frecuencia, Conexion, Insul_Cls, Grupo_Conexion, Cantidad, Referencia, 
			Modelo, Dimensiones, Orden_Servicio, Regulacion, Tamayo_Cif, Requisitos_Cliente, Ubicacion, Velocidad_Parte, Fecha_Cierre_Virtual, 
			Nit_Empresa, tipo_ingreso)
			VALUES 
			(null, '$Fecha_Ingreso', '$Numero_SeriePT', '$Detalle_De_Equipo', '$Enviado_Para', '$despachado_por', '$Cedula_Empleado', 'A', '$Observaciones', 
			'$usu_id', '$Hora_Ingreso', '$contacto_envia', '$tipo', '$frecuencia', '$conexion', '$insul', '$grupoconex', '$cantidad', '$referencia', 
			'$modelo', '$dimensiones', '$Orden_Servicio', '$regulacion', '$cif', '$Requisitos_Cliente', '$Ubicacion', '$velocidad', '0000-00-00 00:00:00', 
			'$nit_sede', 'PT')";
		
			$IngresoEqui=$objIngresoEqui->Insertar($sql1);

			$sqlBuscaIngreEqui="SELECT * FROM ingreso_equipos WHERE Numero_Serie='$Numero_SeriePT' ORDER BY Numero_Ingreso DESC LIMIT 1";
			$RegIngreEqui=$objIngresoEqui->Consultar($sqlBuscaIngreEqui);
		
			if ($RegIngreEqui != null) {
				$sqlBuscaEqui="SELECT * FROM equipos WHERE Numero_Serie='$Numero_SeriePT'";
				$RegEqui=$objIngresoEqui->Consultar($sqlBuscaEqui);
				
				if($RegEqui != null){
					$sql2="UPDATE equipos SET Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$fases', Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo'
										WHERE Numero_Serie='$Numero_SeriePT'";
					$objIngresoEqui->Actualizar($sql2);
				}
				else{
					$sql2="INSERT INTO equipos VALUES ('$Numero_SeriePT','$Nit_Cliente','$Codigo_Planta','$fases','$Codigo_Marca','$Codigo_Tipo_Equipo', '$nit_sede')";
					$objIngresoEqui->Insertar($sql2);
				}

				$sql3="INSERT INTO detalle_equipo 
				(Numero_Registro, Numero_Serie, Potencia, Voltaje, Amperaje, Unidad_De_Potencia, V_Primario, V_Secundario1, V_Secundario2, I_Primario, I_Secundario, Nit_Empresa) 
				VALUES 
				(null, '$Numero_SeriePT', '$potencia', '$voltaje', '$amperaje', '$unidad', '$vp', '$vs1', '$vs2', '$ip', '$is', '$nit_sede')";
				$DatoElec=$objIngresoEqui->Insertar($sql3);

				echo messageSweetAlert("El registro se ha realizado con éxito.<br>", '<h2 class="swal2-title">Número de Ingreso: <span class="badge badge-secondary">' . $RegIngreEqui[0][0] . '</span></h2>', "success", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearPT'));
			}else{
				echo messageSweetAlert("No se pudo realizar el registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearPT'));
			}
		}else{
			echo messageSweetAlert("Falta el Número de Registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearPT'));
		}
	}
	
    function getVerPT(){
	    $numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
	  
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) as Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Estado='A' ORDER BY Razon_Social";
		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$sqlDEquipo="SELECT * FROM detalle_equipo WHERE Numero_Serie='$serie'";
		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '4' AND Estado='A' ORDER BY Descripcion";
	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede'ORDER BY nombre";
	   

		$objIngresoEquiDc= new IngresoEquiposModel();
		$IngresoEqui=$objIngresoEquiDc->Consultar($sql);
		$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);  
			   
		$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);   
		$Cliente=$objIngresoEquiDc->Consultar($sqlCliente); 
		$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo); 
		$DEquipo=$objIngresoEquiDc->Consultar($sqlDEquipo); 
		
		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiDc->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}

		// if(!empty($Equipo[0][2])){
		// 	$sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }
		
		$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);    
		$sedes=$objIngresoEquiDc->Consultar($sqlsede);
		
		include_once('../../views/Ingresos/GuiVerIngresoPT.html.php');
	}

    function getEditarPT(){
	    $numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
	  
		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) as Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa ='$sede' AND Estado='A' ORDER BY Razon_Social";
		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$sqlDEquipo="SELECT * FROM detalle_equipo WHERE Numero_Serie='$serie'";
		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$sqlTipos_Equipos = "SELECT * FROM tipos_equipos WHERE Codigo_Grupo = '4' AND Estado='A' ORDER BY Descripcion";
	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede'ORDER BY nombre";
	   

		$objIngresoEquiDc= new IngresoEquiposModel();
		$IngresoEqui=$objIngresoEquiDc->Consultar($sql);
		$Marca=$objIngresoEquiDc->Consultar( $sqlMarca);  
			   
		$Empleado=$objIngresoEquiDc->Consultar($sqlEmpleado);   
		$Cliente=$objIngresoEquiDc->Consultar($sqlCliente); 
		$Equipo=$objIngresoEquiDc->Consultar($sqlEquipo); 
		$DEquipo=$objIngresoEquiDc->Consultar($sqlDEquipo); 
		
		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiDc->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}

		// if(!empty($Equipo[0][2])){
		// 	$sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }
		
		$Tipos_Equipos=$objIngresoEquiDc->Consultar($sqlTipos_Equipos);    
		$sedes=$objIngresoEquiDc->Consultar($sqlsede);
		
		include_once('../../views/Ingresos/GuiEditarIngresoPT.html.php');
	}
  
	function postEditarPT(){
		extract($_POST);
		
		$objIngresoEqui= new IngresoEquiposModel();
		
	    $usu_id=$_SESSION['usua_id'];
		if(!isset($Urgente)){$Urgente='N';}else{$Urgente="S";}

		$sqlNumero="SELECT Numero_Ingreso FROM ingreso_equipos WHERE Numero_Serie='$Numero_SeriePT' AND Nit_Empresa='$nit_sede'";
		$numero_doc=$objIngresoEqui->Consultar($sqlNumero);

		$sql1="UPDATE ingreso_equipos SET Numero_Serie='$Numero_Serie', Detalle_De_Equipo='$Detalle_De_Equipo', Fecha_Ingreso='$Fecha_Ingreso', Enviado_Para='$Enviado_Para', 
		Enviado_Por='$despachado_por', Cedula_Empleado='$Cedula_Empleado', Observaciones='$Observaciones', 
		Tipo='$tipo', Frecuencia='$frecuencia', Conexion='$conexion', Insul_Cls='$insul', Grupo_Conexion='$grupoconex', 
		cantidad='$cantidad', Referencia='$referencia', modelo='$modelo', dimensiones='$dimensiones', 
		Orden_Servicio='$Orden_Servicio', Regulacion='$regulacion', Tamayo_Cif='$cif', Requisitos_Cliente='$Requisitos_Cliente', Ubicacion='$Ubicacion', 
		Velocidad_Parte='$velocidad', Usuario_Modifica='$usu_id', Fecha_Modifica=NOW() WHERE Numero_Serie='$Numero_SeriePT' AND Nit_Empresa='$nit_sede'";
        
		$objIngresoEqui->Actualizar($sql1);
		
		$sql2="UPDATE equipos SET Numero_Serie='$Numero_Serie', Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$fases', 
		Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo' WHERE Numero_Serie='$Numero_SeriePT' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql2);

		$sql3="UPDATE detalle_equipo SET Numero_Serie='$Numero_Serie', Potencia='$potencia', Voltaje='$voltaje', Amperaje='$amperaje', 
		Unidad_De_Potencia='$unidad', V_Primario='$vp', V_Secundario1='$vs1', V_Secundario2='$vs2', I_Primario='$ip', I_Secundario='$is' 
		WHERE Numero_Serie='$Numero_SeriePT' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql3);

		echo messageSweetAlert("El registro se ha actualizado con éxito", "", "success", "", "si", "automatica", getUrl('Ingresos', 'Ingresos', 'getEditarPT', array("numero_doc" => $numero_doc[0][0], "serie" => $Numero_Serie, "nit_sede" => $nit_sede)), 2500);
	}
	
	function PostCrearOT(){
		extract($_POST);

		$objIngresoEqui= new IngresoEquiposModel();
		
		$Usuario_Crea=$_SESSION['usua_id'];
	    date_default_timezone_set('America/Bogota');
        $Fecha_Ingreso=date('Y-m-d');
        $Hora_Ingreso="0000-00-00 ".date('h:i:s');

		if (!empty($Numero_SerieOT)) {
			$sql1 = "INSERT INTO ingreso_equipos
			(tipo_ingreso, Numero_Ingreso, Fecha_Ingreso, Hora_Ingreso, Nit_Empresa, Orden_Servicio, Tamayo_Cif,
			Numero_Serie, Detalle_De_Equipo, Codigo_Actividad_Produccion, Ubicacion, Enviado_Para, Codigo_Tipo_Equipo_Out, 
			Codigo_Aplicacion_Out, Codigo_Tipo_Arranque_Out, Codigo_Acoplamiento_Out, Requisitos_Cliente, Observaciones, 
			Enviado_Por, Cedula_Empleado, Fecha_Cierre_Virtual, Usuario_Crea, Estado)
			VALUES 
			('OT', null, '$Fecha_Ingreso', '$Hora_Ingreso', '$nit_sede', '$Orden_Servicio', '$cif',
			'$Numero_SerieOT', '$Detalle_De_Equipo', '$Codigo_Actividad_Produccion', '$Ubicacion', '$Enviado_Para', '$Codigo_Tipo_Equipo_Out', 
			'$Codigo_Aplicacion_Out', '$Codigo_Tipo_Arranque_Out', '$Codigo_Acoplamiento_Out', '$Requisitos_Cliente', '$Observaciones', 
			'$despachado_por', '$Cedula_Empleado', '0000-00-00 00:00:00', '$Usuario_Crea', 'A')";

			$IngresoEqui=$objIngresoEqui->Insertar($sql1);

			$sqlBuscaIngreEqui="SELECT * FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieOT' ORDER BY Numero_Ingreso DESC LIMIT 1";
			$RegIngreEqui=$objIngresoEqui->Consultar($sqlBuscaIngreEqui);
		
			if ($RegIngreEqui != null) {
				$sqlBuscaEqui="SELECT * FROM equipos WHERE Numero_Serie='$Numero_SerieOT'";
				$RegEqui=$objIngresoEqui->Consultar($sqlBuscaEqui);
				
				if($RegEqui <> null){
					$sql2="UPDATE equipos SET Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$no_fases', Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo_Out'
										WHERE Numero_Serie='$Numero_SerieOT'";
					$Equipo=$objIngresoEqui->Actualizar($sql2);
				}
				else{
					$sql2="INSERT INTO equipos VALUES('$Numero_SerieOT','$Nit_Cliente','$Codigo_Planta','$no_fases','$Codigo_Marca','$Codigo_Tipo_Equipo_Out', '$nit_sede')";
					$Equipo=$objIngresoEqui->Insertar($sql2);
				}

				if (isset($PotenciaInsert)) {
					$sql3="UPDATE ingreso_equipos SET Frame='$Frame', Tipo='$Tipo', Modulo='$Mod', Style='$Style', Form='$Form', 
					Frecuencia='$Frecuencia', Conexion='$Conexion', Fs='$Fs', Encl='$Encl', Ip='$Ip', Insul_Cls='$Insul_Cls', Rotor='$RotorDetalle' 
					WHERE Numero_Serie='$Numero_SerieOT'";
					$objIngresoEqui->Actualizar($sql3);

					for($i=0; $i<count($PotenciaInsert); $i++){
						$sql4="INSERT INTO detalle_equipo 
						(Numero_Serie, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, 
						Va, Vc, Ia, Ic, Nit_Empresa)
						VALUES 
						('$Numero_SerieOT', '$PotenciaInsert[$i]', '$Unidad_De_PotenciaInsert[$i]', '$Revoluciones_Por_MinutoInsert[$i]', 
						'$VaInsert[$i]', '$VcInsert[$i]', '$IaInsert[$i]', '$IcInsert[$i]', '$nit_sede')";
						
						$objIngresoEqui->Insertar($sql4);
					}
				}

				echo messageSweetAlert("El registro se ha realizado con éxito.<br>", '<h2 class="swal2-title">Número de Ingreso: <span class="badge badge-secondary">' . $RegIngreEqui[0][0] . '</span></h2>', "success", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearOT'));
			}else{
				echo messageSweetAlert("No se pudo realizar el registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearOT'));
			}
		}else{
			echo messageSweetAlert("Falta el Número de Registro", "error", "", "si", "boton", getUrl('Ingresos', 'Ingresos', 'crearOT'));
		}
	}

	function getVerOT(){
		$objIngresoEquiOt= new IngresoEquiposModel();

	    $numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
		$IngresoEqui=$objIngresoEquiOt->Consultar($sql);

		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$Equipo=$objIngresoEquiOt->Consultar($sqlEquipo);

	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
		$sedes=$objIngresoEquiOt->Consultar($sqlsede);

		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$Empleado=$objIngresoEquiOt->Consultar($sqlEmpleado);

		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Estado='A' ORDER BY Razon_Social";
		$Cliente=$objIngresoEquiOt->Consultar($sqlCliente);

		$sqlTipo_Equipos = "SELECT * FROM grupos ORDER BY Descripcion";
		$Tipo_Equipos=$objIngresoEquiOt->Consultar($sqlTipo_Equipos);

		$sqlCodigo_Grupo = "SELECT Codigo_Grupo, Descripcion 
        FROM tipos_equipos WHERE Codigo_Tipo_Equipo = "."'" . $Equipo[0]["Codigo_Tipo_Equipo"] . "'"." AND Estado='A' ";
		$Codigo_grupo = $objIngresoEquiOt->Consultar($sqlCodigo_Grupo);

		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$Marca=$objIngresoEquiOt->Consultar( $sqlMarca);

		$sqlServicios = "SELECT Codigo, Descripcion FROM productos_servicios WHERE Indicativo = 'A' AND Estado = 'A' ORDER BY Descripcion";
		$Servicios = $objIngresoEquiOt->Consultar($sqlServicios);

		$sqlClase_Equipos = "SELECT * FROM tipos_equipos WHERE Estado='A' ORDER BY Descripcion";
		$Clase_Equipos=$objIngresoEquiOt->Consultar($sqlClase_Equipos);

		$sqlAplicacion = "SELECT * FROM aplicacion WHERE Estado='A' ORDER BY codigo";
		$Aplicacion = $objIngresoEquiOt->Consultar($sqlAplicacion);

    	$sqlArranque = "SELECT * FROM tipo_de_arranque WHERE Estado='A' ORDER BY codigo";
		$Arranque = $objIngresoEquiOt->Consultar($sqlArranque);

    	$sqlAcoplamiento = "SELECT * FROM acoplamiento WHERE Estado='A' ORDER BY codigo";
		$Acoplamiento = $objIngresoEquiOt->Consultar($sqlAcoplamiento);

		$sqlDetalle="SELECT Numero_Registro, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, Va, Vc, Ia, Ic 
					FROM detalle_equipo 
							WHERE Numero_serie='$serie' AND Nit_Empresa='$sede'";
		$Detalle=$objIngresoEquiOt->Consultar($sqlDetalle);
		
		$sqlDetalle2="SELECT Frame, Tipo, Modulo, Style, Form, Frecuencia, Conexion, Fs, Encl, Ip, Insul_Cls, Rotor
							FROM ingreso_equipos 
								WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
		$Detalle2=$objIngresoEquiOt->Consultar($sqlDetalle2);

		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiOt->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}

		// if(!empty($Equipo[0][2])){
		// 	$sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }

		include_once('../../views/Ingresos/GuiVerIngresoOUT.html.php');
	}
	
    function getEditarOT(){
		$objIngresoEquiOt= new IngresoEquiposModel();

	    $numero_ingreso=$_GET['numero_doc'];
		$sede=$_GET['nit_sede'];
		$serie=$_GET['serie'];
		
		$sql="SELECT * FROM ingreso_equipos WHERE Numero_Ingreso='$numero_ingreso' AND Nit_Empresa='$sede'";
		$IngresoEqui=$objIngresoEquiOt->Consultar($sql);

		$sqlEquipo="SELECT * FROM equipos WHERE Numero_Serie='$serie'";
		$Equipo=$objIngresoEquiOt->Consultar($sqlEquipo);

	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
		$sedes=$objIngresoEquiOt->Consultar($sqlsede);

		$sqlEmpleado = "SELECT Cedula_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre_Completo FROM empleados WHERE Estado='A' ORDER BY nombre_completo";
		$Empleado=$objIngresoEquiOt->Consultar($sqlEmpleado);

		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Estado='A' ORDER BY Razon_Social";
		$Cliente=$objIngresoEquiOt->Consultar($sqlCliente);

		$sqlTipo_Equipos = "SELECT * FROM grupos ORDER BY Descripcion";
		$Tipo_Equipos=$objIngresoEquiOt->Consultar($sqlTipo_Equipos);

		$sqlCodigo_Grupo = "SELECT Codigo_Grupo, Descripcion 
        FROM tipos_equipos WHERE Codigo_Tipo_Equipo = "."'" . $Equipo[0]["Codigo_Tipo_Equipo"] . "'"." AND Estado='A' ";
		$Codigo_grupo = $objIngresoEquiOt->Consultar($sqlCodigo_Grupo);

		$sqlMarca = "SELECT * FROM marcas WHERE Estado='A' ORDER BY Descripcion";
		$Marca=$objIngresoEquiOt->Consultar( $sqlMarca);

		$sqlServicios = "SELECT Codigo, Descripcion FROM productos_servicios WHERE Indicativo = 'A' AND Estado = 'A' ORDER BY Descripcion";
		$Servicios = $objIngresoEquiOt->Consultar($sqlServicios);

		$sqlClase_Equipos = "SELECT * FROM tipos_equipos WHERE Estado='A' ORDER BY Descripcion";
		$Clase_Equipos=$objIngresoEquiOt->Consultar($sqlClase_Equipos);

		$sqlAplicacion = "SELECT * FROM aplicacion WHERE Estado='A' ORDER BY codigo";
		$Aplicacion = $objIngresoEquiOt->Consultar($sqlAplicacion);

    	$sqlArranque = "SELECT * FROM tipo_de_arranque WHERE Estado='A' ORDER BY codigo";
		$Arranque = $objIngresoEquiOt->Consultar($sqlArranque);

    	$sqlAcoplamiento = "SELECT * FROM acoplamiento WHERE Estado='A' ORDER BY codigo";
		$Acoplamiento = $objIngresoEquiOt->Consultar($sqlAcoplamiento);

		$sqlDetalle="SELECT Numero_Registro, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, Va, Vc, Ia, Ic 
					FROM detalle_equipo 
							WHERE Numero_serie='$serie' AND Nit_Empresa='$sede'";
		$Detalle=$objIngresoEquiOt->Consultar($sqlDetalle);
		
		$sqlDetalle2="SELECT Frame, Tipo, Modulo, Style, Form, Frecuencia, Conexion, Fs, Encl, Ip, Insul_Cls, Rotor
							FROM ingreso_equipos 
								WHERE Numero_serie='$serie' AND Nit_Empresa='$sede' ";
		$Detalle2=$objIngresoEquiOt->Consultar($sqlDetalle2);

		if(!empty($Equipo[0][1])){
			$sqlplanta="SELECT Codigo_Planta, Nombre FROM plantas WHERE Nit_Cliente="."'" . $Equipo[0]["Nit_Cliente"] . "'"."";
			$Planta=$objIngresoEquiOt->Consultar($sqlplanta);
		}
		else{
			$Planta=null;
		}

		// if(!empty($Equipo[0][2])){
		// 	$sqlcontacto="SELECT Codigo_Contacto, Nombre_Contacto FROM Clientes WHERE Codigo_Planta = '".$Equipo[0][2]."' ";
		// 	$contactos=$objIngresoEquiDc->Consultar($sqlcontacto); 
		// }
		// else{
		// 	$contactos=null;
		// }

		include_once('../../views/Ingresos/GuiEditarIngresoOUT.html.php');
	}
  
	function postEditarOT(){
		extract($_POST);
		
		$objIngresoEqui = new IngresoEquiposModel();

		$Usuario_Modifica=$_SESSION['usua_id'];

		$sqlNumero="SELECT Numero_Ingreso FROM ingreso_equipos WHERE Numero_Serie='$Numero_SerieOUT' AND Nit_Empresa='$nit_sede'";
		$numero_doc=$objIngresoEqui->Consultar($sqlNumero);
        
        $sql1="UPDATE ingreso_equipos SET Numero_Serie='$Numero_Serie', Detalle_De_Equipo='$Detalle_De_Equipo', Codigo_Actividad_Produccion='$Codigo_Actividad_Produccion', 
		Codigo_Aplicacion_Out='$Codigo_Aplicacion_Out', Codigo_Tipo_Equipo_Out='$Codigo_Tipo_Equipo_Out', Codigo_Tipo_Arranque_Out='$Codigo_Tipo_Arranque_Out', 
		Codigo_Acoplamiento_Out='$Codigo_Acoplamiento_Out', Fecha_Ingreso='$Fecha_Ingreso', Enviado_Para='$Enviado_Para', 
		Enviado_Por='$despachado_por', Cedula_Empleado='$Cedula_Empleado', Observaciones='$Observaciones', 
		Orden_Servicio='$Orden_Servicio', Tamayo_Cif='$cif', 
		Requisitos_Cliente='$Requisitos_Cliente', Ubicacion='$Ubicacion', Usuario_Modifica='$Usuario_Modifica', 
		Fecha_Modifica=NOW() WHERE Numero_Serie='$Numero_SerieOUT' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql1);
	
		if (isset($Frame) OR isset($Tipo) OR isset($Mod) OR isset($Frecuencia) OR isset($Conexion) OR isset($Fs) OR isset($Encl) 
		OR isset($Ip) OR isset($Insul_Cls) OR isset($RotorDetalle) OR isset($Style) OR isset($Form)) {
			$sql2="UPDATE ingreso_equipos SET Frame='$Frame', Tipo='$Tipo', Modulo='$Mod', Frecuencia='$Frecuencia', Conexion='$Conexion', Fs='$Fs', Encl='$Encl', Ip='$Ip', 
			Insul_Cls='$Insul_Cls', Rotor='$RotorDetalle', Style='$Style', Form='$Form' WHERE Numero_Serie='$Numero_SerieOUT' AND Nit_Empresa='$nit_sede'";
			$objIngresoEqui->Actualizar($sql2);
		}
	
    	$sql3="UPDATE equipos SET Numero_Serie='$Numero_Serie', Nit_Cliente='$Nit_Cliente', Codigo_Planta='$Codigo_Planta', No_Fases='$no_fases', 
		Codigo_Marca='$Codigo_Marca', Codigo_Tipo_Equipo='$Codigo_Tipo_Equipo_Out' WHERE Numero_Serie='$Numero_SerieOUT' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql3);

		$sql4="UPDATE detalle_equipo SET Numero_Serie='$Numero_Serie' WHERE Numero_Serie='$Numero_SerieOUT' AND Nit_Empresa='$nit_sede'";
		$objIngresoEqui->Actualizar($sql4);
    
        if (isset($PotenciaEditar)) {
			for($i=0; $i<count($PotenciaEditar); $i++){
					$sql5="UPDATE detalle_equipo SET Unidad_De_Potencia='$Unidad_De_PotenciaEditar[$i]', 
					Potencia='$PotenciaEditar[$i]', Revoluciones_Por_Minuto='$Revoluciones_Por_MinutoEditar[$i]', Va='$VaEditar[$i]', Vc='$VcEditar[$i]', 
					Ia='$IaEditar[$i]', Ic='$IcEditar[$i]' WHERE Numero_Registro='$Numero_RegistroEditar[$i]' AND Nit_Empresa='$nit_sede'";

					$objIngresoEqui->Actualizar($sql5);
			}
		}
		if(isset($PotenciaInsert)){
			for($i=0; $i<count($PotenciaInsert); $i++){
				$sql6="INSERT INTO detalle_equipo 
				(Numero_Registro, Numero_Serie, Potencia, Unidad_De_Potencia, Revoluciones_Por_Minuto, 
				Va, Vc, Ia, Ic, Nit_Empresa)
				VALUES 
				(null, '$Numero_Serie', '$PotenciaInsert[$i]', '$Unidad_De_PotenciaInsert[$i]', '$Revoluciones_Por_MinutoInsert[$i]', 
				'$VaInsert[$i]', '$VcInsert[$i]', '$IaInsert[$i]', '$IcInsert[$i]', '$nit_sede')";
				
				$objIngresoEqui->Insertar($sql6);
			}
		}

		echo messageSweetAlert("El registro se ha actualizado con éxito", "", "success", "", "si", "automatica", getUrl('Ingresos', 'Ingresos', 'getEditarOT', array("numero_doc" => $numero_doc[0][0], "serie" => $Numero_Serie, "nit_sede" => $nit_sede)), 2500);
	}

	function getCicloDeVida(){
		$objIngresoEquiOt= new IngresoEquiposModel();

	    $numero_ingreso=$_GET["numero_doc"];
		$sede=$_GET["nit_sede"];
		$serie=$_GET["serie"];
		
		$sqlIngre = "SELECT ing.Numero_Ingreso, equi.Nit_Cliente, tequi.Descripcion AS Equipo, gru.Descripcion AS Tipo_Equipo,
                            marcas.Descripcion AS Marca, marcas.Codigo_Marca, ing.Numero_Serie, No_Fases, Frame, CONCAT(Potencia,' - ', Unidad_De_Potencia) AS Potencia, Revoluciones_Por_Minuto, Velocidad_Parte, 
                            Voltaje, V_Primario, Va, Ubicacion, Enviado_Para, Orden_Servicio FROM ingreso_equipos AS ing, equipos AS equi, tipos_equipos AS tequi, grupos AS gru, marcas, detalle_equipo AS dequi
								WHERE ing.Numero_Serie=equi.Numero_Serie
									AND equi.Codigo_Tipo_Equipo=tequi.Codigo_Tipo_Equipo
									AND tequi.Codigo_Grupo=gru.Codigo_Grupo
									AND equi.Codigo_Marca=marcas.Codigo_Marca
									AND equi.Numero_Serie=dequi.Numero_Serie
									AND ing.Numero_Ingreso='$numero_ingreso' LIMIT 1";
        $Ingreso = $objIngresoEquiOt->Consultar($sqlIngre);

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

	    $sqlsede="SELECT nit_empresa, nombre FROM sedes WHERE nit_empresa='$sede' ORDER BY nombre";
		$sedes=$objIngresoEquiOt->Consultar($sqlsede);

		$sqlCliente = "SELECT Nit_Cliente, Razon_Social FROM clientes WHERE Nit_Empresa='$sede' AND Nit_Cliente = '".$Ingreso[0]["Nit_Cliente"]."' AND Estado='A' ORDER BY Razon_Social";
		$Cliente=$objIngresoEquiOt->Consultar($sqlCliente);

		include_once("../../views/Ingresos/GuiCicloDeVida.html.php");
	}

	function tablaProcesosCicloVida(){
		$Numero_Ingreso = $_POST["Numero_Ingreso"];
		$objIngresoEqui = new IngresoEquiposModel();

		if (!empty($Numero_Ingreso)) {

			$sqlDocPL = "SELECT COUNT(Numero_Documento) AS Cantidad
			FROM encabezado_documento_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'PL' 
			AND Estado_Documento = 'A' ORDER BY Fecha_Documento DESC";
			$DocPL = $objIngresoEqui->Consultar($sqlDocPL);

			$sqlDocCT = "SELECT COUNT(Numero_Documento) AS Cantidad
			FROM encabezado_cotizacion_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'CT' 
			AND Estado_Documento = 'A' ORDER BY Fecha_Documento DESC";
			$DocCT = $objIngresoEqui->Consultar($sqlDocCT);

			$sqlDocFVC = "SELECT COUNT(Numero_Documento) AS Cantidad
			FROM encabezado_factura_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'FVC' 
			AND Estado_Documento = 'A' ORDER BY Fecha_Documento DESC";
			$DocFVC = $objIngresoEqui->Consultar($sqlDocFVC);

			$sqlDocOrden = "SELECT COUNT(Numero_Orden) AS Cantidad, Nit_Empresa 
			FROM orden_trabajo 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado='A' 
			ORDER BY Fecha_Creada DESC";
			$DocOrden = $objIngresoEqui->Consultar($sqlDocOrden);

			$sqlDocInforme = "SELECT COUNT(Numero_Documento) AS Cantidad 
			FROM informe_tecnico_reparacion_pruebas 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND 
			Estado_Documento='A' ORDER BY Numero_Documento DESC LIMIT 1";
			$DocInforme = $objIngresoEqui->Consultar($sqlDocInforme);

			$sqlDocRM = "SELECT COUNT(Numero_Documento) AS Cantidad
			FROM encabezado_documento_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'RM' 
			AND Estado_Documento = 'A' ORDER BY Fecha_Documento DESC";
			$DocRM = $objIngresoEqui->Consultar($sqlDocRM);

			$sqlDocGasto = "SELECT COUNT(Numero_Documento) AS Cantidad, Nit_Empresa 
			FROM encabezado_gastosdirectos 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado_Documento='A' 
			ORDER BY Fecha_Documento DESC";
			$DocGasto = $objIngresoEqui->Consultar($sqlDocGasto);
			
			if (!empty($DocPL[0]["Cantidad"])) {
				$rowDocPL = '
					<tr>
						<td>PRELIQUIDACIONES</td>
						<td id="cantDocPL">
							<button data-tipo-doc="PL" class="href">' . $DocPL[0]["Cantidad"] . '</button>
						</td>
					</tr>';
			}else{
				$rowDocPL = null;
			}

			if (!empty($DocCT[0]["Cantidad"])) {
				$rowDocCT = '
					<tr>
						<td>COTIZACIONES</td>
						<td id="cantDocCT">
							<button data-tipo-doc="CT" class="href">' . $DocCT[0]["Cantidad"] . '</button>
						</td>
					</tr>';
			}else{
				$rowDocCT = null;
			}

			if (!empty($DocFVC[0]["Cantidad"])) {
				$rowDocFVC = '
					<tr>
						<td>FACTURAS</td>
						<td id="cantDocFVC">
							<button data-tipo-doc="FVC" class="href">' . $DocFVC[0]["Cantidad"] . '</button>
						</td>
					</tr>';
			}else{
				$rowDocFVC = null;
			}

			if (!empty($DocInforme[0]["Cantidad"])) {
				$rowDocInforme = '
					<tr>
						<td>INFORMES TÉCNICOS</td>
						<td id="cantDocIT">
							<button data-tipo-doc="IT" class="href">' . $DocInforme[0]["Cantidad"] . '</button>
						</td>
					</tr>';
			}else{
				$rowDocInforme = null;
			}
			
			if (!empty($DocOrden[0]["Cantidad"])) {
				$rowDocOrden = '
					<tr>
						<td>ORDENES DE TRABAJO</td>
						<td id="cantDocOT">
							<button data-tipo-doc="OT" class="href">' . $DocOrden[0]["Cantidad"] . '</button>
						</td>
					</tr>';
			}else{
				$rowDocOrden = null;
			}

			if (!empty($DocRM[0]["Cantidad"])) {
				$rowDocRM = '
					<tr>
						<td>REMISIONES</td>
						<td id="cantDocRM">
							<button data-tipo-doc="RM" class="href">' . $DocRM[0]["Cantidad"] . '</button>
						</td>
					</tr>';
			}else{
				$rowDocRM = null;
			}

			if (!empty($DocGasto[0]["Cantidad"])) {
				$rowDocGasto = '
					<tr>
						<td>GASTO DIRECTO</td>
						<td id="cantDocGasto">
							<button data-tipo-doc="GD" class="href">' . $DocGasto[0]["Cantidad"] . '</button>
						</td>
					</tr>';
			}else{
				$rowDocGasto = null;
			}

			$tabla = '
			<table id="tablaProcesosCicloVida" class="table table-bordered table-hover">

				<thead class="text-center text-white bg-primary thead-primary">
					<tr>
						<th>Documento</th>
						<th>Cantidad</th>
					</tr>
				</thead>

				<tbody class="text-center" style="font-size: 20px;">
					' . $rowDocPL . '
					' . $rowDocCT . '
					' . $rowDocFVC . '
					' . $rowDocOrden. '
					' . $rowDocInforme. '
					' . $rowDocRM . '
					' . $rowDocGasto . '
				</tbody>

			</table>';

		}
		echo json_encode(array(
			"tablaProcesosCicloVida" => $tabla,
		));
	}

	function  buscarCicloVida(){
		$Numero_Ingreso = $_POST["Numero_Ingreso"];
		$Tipo_Documento = $_POST["Tipo_Documento"];
		$objIngresoEqui = new IngresoEquiposModel();

		if (!empty($Numero_Ingreso) && !empty($Tipo_Documento)) {
			if($Tipo_Documento == "CT"){
				$sqlDoc = "SELECT * FROM encabezado_cotizacion_venta 
				WHERE Numero_Ingreso = '$Numero_Ingreso' 
				AND Tipo_Documento = '$Tipo_Documento' 
				AND Estado_Documento = 'A' 
				ORDER BY Fecha_Documento DESC";

				$editar='<button class="btn btn-primary fa fa-edit" id="editar"></button>';
			}else if($Tipo_Documento == "FVC"){
				$sqlDoc = "SELECT * FROM encabezado_factura_venta 
				WHERE Numero_Ingreso = '$Numero_Ingreso' 
				AND Tipo_Documento = '$Tipo_Documento' 
				AND Estado_Documento = 'A' 
				ORDER BY Fecha_Documento DESC";

				$editar='<span></span>';
			}else if($Tipo_Documento == "PL"){
				$sqlDoc = "SELECT * FROM encabezado_documento_venta 
				WHERE Numero_Ingreso = '$Numero_Ingreso' 
				AND Tipo_Documento = '$Tipo_Documento' 
				AND Estado_Documento = 'A' 
				ORDER BY Fecha_Documento DESC";

				$editar='<button class="btn btn-primary fa fa-edit" id="editar"></button>';

			}else if($Tipo_Documento == "RM"){
				$sqlDoc = "SELECT * FROM encabezado_documento_venta 
				WHERE Numero_Ingreso = '$Numero_Ingreso' 
				AND Tipo_Documento = '$Tipo_Documento' 
				AND Estado_Documento = 'A' 
				ORDER BY Fecha_Documento DESC";

				$editar='<button class="btn btn-primary fa fa-edit" id="editar"></button>';
			}else if($Tipo_Documento == "OT"){
				$sqlDoc = "SELECT * FROM orden_trabajo 
				WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado='A' 
				ORDER BY Fecha_Creada DESC";

				$editar='<button class="btn btn-primary fa fa-edit" id="editar"></button>';
			}else if($Tipo_Documento == "IT"){
				$sqlDoc = "SELECT * FROM informe_tecnico_reparacion_pruebas 
				WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado_Documento='A' 
				ORDER BY Fecha_Documento DESC";

				$editar='<button class="btn btn-primary fa fa-edit" id="editar"></button>';
			}else if($Tipo_Documento == "GD"){
				$sqlDoc = "SELECT * FROM encabezado_gastosdirectos 
				WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado_Documento='A' 
				ORDER BY Fecha_Documento DESC";

				$editar='<button class="btn btn-primary fa fa-edit" id="editar"></button>';
			}
			
			$documentos = $objIngresoEqui->Consultar($sqlDoc);

			$datos = array();

			if ($documentos != null) {
				
				switch($Tipo_Documento){
					case "CT":
						$data_url=getUrl("Cotizaciones", "Cotizaciones", "Cotizacion");
					break;

					case "RM":
					$data_url=getUrl("Remisiones", "Remisiones", "Remision");
					break;
					
					case "PL":
						$data_url=getUrl("Preliquidacion", "Preliquidacion", "Preliquidacion");
					break;
					
					case "EB":
						$data_url=getUrl("EntradaBodega", "EntradaBodega", "EntradaBodega");
					break;

					case "FVC":
						$data_url=getUrl("Factura", "Factura", "Factura");
					break;

					case "OT":
						$data_url=getUrl("OrdenTrabajo", "OrdenTrabajo", "OrdenTrabajo");
					break;

					case "IT":
                        $data_url=getUrl("Informes", "Informes", "InformeTecnico");
                    break;

					case "GD":
						$data_url=getUrl("GastosDirectos", "GastosDirectos", "GastoDirectoFabricacion");
					break;

					default:
						$data_url="index.php";
					break;
				}

				foreach ($documentos as $documento) {

					if($Tipo_Documento == "OT"){
						array_push($datos,
						array(
							"urlDoc" => $data_url.'&numero_doc='.$documento["Numero_Orden"].'&nit_sede='.$documento["Nit_Empresa"].'',
							"tipo_documento" => "OT",
							"tipo_orden" => $documento["Tipo_Orden"],
							"numero_documento" => $documento["Numero_Orden"],
							"fecha_documento" => substr($documento["Fecha_Creada"], 0,10),
							"estado" => $documento["Estado"],
							"ver" => '<button class="btn btn-primary fa fa-eye" id="ver"></button>',
							"editar" => $editar
						));
					}else if ($Tipo_Documento == "GD" || $Tipo_Documento == "IT") {
						if($Tipo_Documento == "GD"){
							$tipo_doc = "GD";
						}else if ($Tipo_Documento == "IT"){
							$tipo_doc = "IT";
						}
						array_push($datos,
						array(
							"urlDoc" => ''.$data_url.'&numero_doc='.$documento["Numero_Documento"].'&nit_sede='.$documento["Nit_Empresa"].'',
							"tipo_documento" => $tipo_doc,
							"numero_documento" => $documento["Numero_Documento"],
							"fecha_documento" => substr($documento["Fecha_Documento"], 0,10),
							"estado" => $documento["Estado_Documento"],
							"ver" => '<button class="btn btn-primary fa fa-eye" id="ver"></button>',
							"editar" => $editar
						));
					}else if ($Tipo_Documento == "CT") {
						$sqlFV = "SELECT ddv.Numero_Documento, ddv.Numero_Ingreso, edv.Fecha_Documento, ddv.Tipo_Documento,
                        ddv.NIT_Empresa, edv.Estado_Documento
                        FROM detalle_factura_venta AS ddv, encabezado_factura_venta AS edv
                        WHERE ddv.Numero_Documento = edv.Numero_Documento
                        AND ddv.NIT_Empresa = edv.NIT_Empresa
                        AND ddv.Numero_Cotizacion LIKE '".$documento["Numero_Documento"]."%' AND ddv.Tipo_Documento = 'FVC'
                        AND ddv.NIT_Empresa = '".$documento["NIT_Empresa"]."' AND edv.Estado_Documento = 'A'";
                        $facturaVenta = $objIngresoEqui->Consultar($sqlFV);

                        if ($facturaVenta == null) {
                            $factura = false;
                        }else{
                            $factura = true;
						}
						
						array_push($datos,
						array(
							"urlDoc" => ''.$data_url.'&numero_doc='.$documento["Numero_Documento"].'&tipo_doc='.$documento["Tipo_Documento"].'&nit_sede='.$documento["NIT_Empresa"].'',
							"tipo_documento" => $documento["Tipo_Documento"],
							"numero_documento" => $documento["Numero_Documento"],
							"fecha_documento" => substr($documento["Fecha_Documento"], 0,10),
							"estado" => $documento["Estado_Documento"],
							"factura" => $factura,
							"ver" => '<button class="btn btn-primary fa fa-eye" id="ver"></button>',
							"editar" => $editar
						));
					}else if($Tipo_Documento != "CT" && $Tipo_Documento != "OT" && $Tipo_Documento != "IT" && $Tipo_Documento != "GD"){
						array_push($datos,
						array(
							"urlDoc" => ''.$data_url.'&numero_doc='.$documento["Numero_Documento"].'&tipo_doc='.$documento["Tipo_Documento"].'&nit_sede='.$documento["NIT_Empresa"].'',
							"tipo_documento" => $documento["Tipo_Documento"],
							"numero_documento" => $documento["Numero_Documento"],
							"fecha_documento" => substr($documento["Fecha_Documento"], 0,10),
							"estado" => $documento["Estado_Documento"],
							"ver" => '<button class="btn btn-primary fa fa-eye" id="ver"></button>',
							"editar" => $editar
						));
					}
                }
			}
		}
		$tabla = array("data" => $datos);
        echo json_encode($tabla);
	}

	function EliminarDatoElectrico(){
		extract($_POST);

		$objIngresoEqui = new IngresoEquiposModel();

		if (isset($Numero_Registro)) {
			$sql1="DELETE FROM detalle_equipo WHERE Numero_Registro = '$Numero_Registro'";
			$objIngresoEqui->Anular($sql1);

			$sql2="ALTER TABLE detalle_equipo AUTO_INCREMENT = $Numero_Registro";
			$objIngresoEqui->Consultar($sql2);
		}
	}

	function BuscarClaseEquipo(){
		$codigo_tipo_equipo=$_POST["codigo_tipo_equipo"];
        $objIngresoEqui = new IngresoEquiposModel();

        $sqlClase_Equipos = "SELECT Codigo_Tipo_Equipo, Descripcion 
        FROM tipos_equipos WHERE Codigo_Grupo = '$codigo_tipo_equipo' AND Estado='A' ";
		$Clase_Equipos = $objIngresoEqui->Consultar($sqlClase_Equipos);

		$select = '<option value="">Seleccione ...</option>';
		if ($Clase_Equipos != null) {
			foreach ($Clase_Equipos as $Clase_Equipo) {
				$select .= "<option value=" . $Clase_Equipo[0]. ">" . $Clase_Equipo[1]. "</option>";                                                   
			}
		}
		
		$datos = array(
			"selectClaseEquipos" => $select
		);

		echo json_encode($datos);
	}

	function buscarDocumentosIngreso(){
		$Numero_Ingreso = $_POST["Numero_Ingreso"];
		$objIngresoEqui = new IngresoEquiposModel();

		if (!empty($Numero_Ingreso)) {

			$sqlDocDiag = "SELECT diag1.Numero_Ingreso, ing.Nit_Empresa, equi.Nit_Cliente FROM diagnostico_1 AS diag1, 
			ingreso_equipos AS ing, equipos AS equi WHERE diag1.Numero_Ingreso = ing.Numero_Ingreso 
			AND ing.Numero_Serie=equi.Numero_Serie 
			AND ing.Estado = 'A' 
			AND ing.Numero_Ingreso = '$Numero_Ingreso'
			ORDER BY diag1.Fecha DESC LIMIT 1";
			$DocDiag = $objIngresoEqui->Consultar($sqlDocDiag);

			$sqlDocPL = "SELECT Numero_Documento, NIT_Empresa 
			FROM encabezado_documento_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'PL' 
			AND Estado_Documento='A' ORDER BY Numero_Documento DESC LIMIT 1";
			$DocPL = $objIngresoEqui->Consultar($sqlDocPL);

			$sqlDocCT = "SELECT Numero_Documento, NIT_Empresa 
			FROM encabezado_cotizacion_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'CT' 
			AND Estado_Documento='A' ORDER BY Numero_Documento DESC LIMIT 1";
			$DocCT = $objIngresoEqui->Consultar($sqlDocCT);

			$sqlDocRM = "SELECT Numero_Documento, NIT_Empresa 
			FROM encabezado_documento_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'RM' 
			AND Estado_Documento='A' ORDER BY Numero_Documento DESC LIMIT 1";
			$DocRM = $objIngresoEqui->Consultar($sqlDocRM);

			$sqlDocFVC = "SELECT Numero_Documento, NIT_Empresa 
			FROM encabezado_factura_venta 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Tipo_Documento = 'FVC' 
			AND Estado_Documento='A' ORDER BY Numero_Documento DESC LIMIT 1";
			$DocFVC = $objIngresoEqui->Consultar($sqlDocFVC);

			$sqlDocOrden = "SELECT Numero_Orden, Nit_Empresa 
			FROM orden_trabajo 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado='A' 
			ORDER BY Numero_Orden DESC LIMIT 1";
			$DocOrden = $objIngresoEqui->Consultar($sqlDocOrden);

			$sqlDocInforme = "SELECT Numero_Documento, Nit_Empresa 
			FROM informe_tecnico_reparacion_pruebas 
			WHERE Numero_Ingreso = '$Numero_Ingreso' AND Estado_Documento='A' 
			ORDER BY Numero_Documento DESC LIMIT 1";
			$DocInforme = $objIngresoEqui->Consultar($sqlDocInforme);


			if ($DocDiag != null) {
				$urlDocDiag = getUrl("Diagnosticos", "Diagnosticos", "", array(
					"numero_ingreso" => $DocDiag[0]["Numero_Ingreso"],
					"nit_sede" => $DocDiag[0]["Nit_Empresa"],
					"nit_cliente" => $DocDiag[0]["Nit_Cliente"]
					));
			}else{
				$urlDocDiag =  false;
			}

			if ($DocPL != null) {
				$urlDocPL = getUrl("Preliquidacion", "Preliquidacion", "Preliquidacion", array(
					"numero_doc" => $DocPL[0]["Numero_Documento"],
					"tipo_doc" => "PL",
					"nit_sede" => $DocPL[0]["NIT_Empresa"]
					));
			}else{
				$urlDocPL =  false;
			}

			if ($DocCT != null) {
				$urlDocCT = getUrl("Cotizaciones", "Cotizaciones", "Cotizacion", array(
					"numero_doc" => $DocCT[0]["Numero_Documento"],
					"tipo_doc" => "CT",
					"nit_sede" => $DocCT[0]["NIT_Empresa"]
					));
			}else{
				$urlDocCT =  false;
			}

			if ($DocRM != null) {
				$urlDocRM = getUrl("Remisiones", "Remisiones", "Remision", array(
					"numero_doc" => $DocRM[0]["Numero_Documento"],
					"tipo_doc" => "RM",
					"nit_sede" => $DocRM[0]["NIT_Empresa"]
					));
			}else{
				$urlDocRM =  false;
			}

			if ($DocFVC != null) {
				$urlDocFVC = getUrl("Factura", "Factura", "Factura", array(
					"numero_doc" => $DocFVC[0]["Numero_Documento"],
					"tipo_doc" => "FVC",
					"nit_sede" => $DocFVC[0]["NIT_Empresa"]
					));
			}else{
				$urlDocFVC =  false;
			}

			if ($DocOrden != null) {
				$urlDocOrden = getUrl("OrdenTrabajo", "OrdenTrabajo", "OrdenTrabajo", array(
					"numero_doc" => $DocOrden[0]["Numero_Orden"],
					"nit_sede" => $DocOrden[0]["Nit_Empresa"]
					));
			}else{
				$urlDocOrden =  false;
			}

			if ($DocInforme != null) {
				$urlDocInforme = getUrl("Informes", "Informes", "InformeTecnico", array(
					"numero_doc" => $DocInforme[0]["Numero_Documento"],
					"nit_sede" => $DocInforme[0]["Nit_Empresa"]
					));
			}else{
				$urlDocInforme =  false;
			}

		}
		echo json_encode(array(
			"urlDocDiag" => $urlDocDiag,
			"urlDocPL" => $urlDocPL,
			"urlDocCT" => $urlDocCT,
			"urlDocRM" => $urlDocRM,
			"urlDocFVC" => $urlDocFVC,
			"urlDocOrden" => $urlDocOrden,
			"urlDocInforme" => $urlDocInforme,
		));
	}

	function ValidarNumeroSerie(){
		$Numero_Serie = $_POST["Numero_Serie"];
		$objIngresoEqui = new IngresoEquiposModel();

		if (!empty($Numero_Serie)) {
			$sqlValid="SELECT * FROM equipos WHERE Numero_Serie ='$Numero_Serie' AND Estado = 'A'";
			$validserie=$objIngresoEqui->Consultar($sqlValid);

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
									AND ing.Numero_Ingreso='".$validserie[0]["Numero_Ingreso"]."'
									AND ing.Estado = 'A' LIMIT 1";
			$Ingreso = $objIngresoEqui->Consultar($sqlIngre);

			if($Ingreso != null){
				foreach($Ingreso as $ingreso){
					if ($ingreso["Voltaje"] != "") {
						$Voltaje=$ingreso["Voltaje"];
					}else if($ingreso["V_Primario"] != ""){
						$Voltaje=$ingreso["V_Primario"];
					}else if($ingreso["Va"] != ""){
						$Voltaje=$ingreso["Va"];
					}else if($ingreso["Voltaje"] == "" && $ingreso["V_Primario"] == "" && $ingreso["Va"] == ""){
						$Voltaje="";
					}
					if ($ingreso["Revoluciones_Por_Minuto"] != "") {
						$Velocidad=$ingreso["Revoluciones_Por_Minuto"];
					}else if($ingreso["Velocidad_Parte"] != ""){
						$Velocidad=$ingreso["Velocidad_Parte"];
					}else if($ingreso["Revoluciones_Por_Minuto"] == "" && $ingreso["Velocidad_Parte"] == ""){
						$Velocidad="";
					}
					if ($validserie != null) {
						$respuesta=true;
					}else{
						$respuesta=false;
					}
	
					$datos = array(
						"existeNumSerie" => $respuesta,
						"Cliente" => $ingreso["Razon_Social"],
						"Tipo_Equipo" => $ingreso["Tipo_Equipo"],
						"Potencia" => $ingreso["Potencia"],
						"Velocidad" => $Velocidad,
						"Voltaje" => $Voltaje
					);
				}
			}else{
				$datos = array();
			}
			echo json_encode($datos);
		}
	}
}

?>