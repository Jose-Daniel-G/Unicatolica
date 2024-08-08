<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso de Transformadores FA-06 - Consultando</b>
		</h4>
	</div>

	<div class="card-body">
		<form method="post" autocomplete="off" action="">

			<?php
				foreach($IngresoEqui as $Ingreso){}
				foreach($Equipo as $equi){}
				foreach($DEquipo as $Dequi){}
			?>

			<input type="hidden" id="Numero_Ingreso" value="<?=$Ingreso["Numero_Ingreso"];?>">
			
			<?php if($Ingreso["Estado"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

			<div class="container-fluid">
				<div class="pb-3 row">
					<div class="col-5">
						<div class="row">
							<div class="col-7">
								<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearTR" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso TR"><i class="fa fa-file"></i></a>
		
								<button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarIngresos" data-url='<?=getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax");  ?>' id="btnBuscarIngresos" value="Buscar" title="Buscar Ingresos"><i class="fa fa-search"></i></button>
		
								<button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosIngreso" title="Ver Datos Adicionales" data-url='<?=getUrl("Ingresos", "Ingresos", "VerDatosAdicionales", false, "ajax");  ?>' id="VerDatosIngreso" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>
							</div>
							
							<div class="col-3">
								<font color="<?=$Estilo ?>"><?=$estado; ?></font>
							</div>
						</div>
					</div>
					<div class="col-2">
						<span class="font-weight-bold" style="font-size: 20px;">N°&nbsp;<?=$Ingreso["Numero_Ingreso"];?></span>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">

					<input type="hidden" id="tipo_documento" name="tipo_documento" value="OI">

					<div class="col-3">
						<div class="row">
							<?php if ($usua_perfil == 1): ?>
							<div class="col-3">
								<label for="nit_sede">Sede</label>
							</div>
							<div class="col-9">
								<?php foreach ($sedes as $sede): ?>
								<input type="text" name="sede_nombre" class="form-control" readonly value="<?=$sede["nombre"];?>">
								<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$Ingreso["Nit_Empresa"];?>">
								<?php endforeach;?>
							</div>
							<?php else: ?>
							<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$Ingreso["Nit_Empresa"];?>">
							<?php endif;?>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="col-4">
								<label for="Fecha_Ingreso">Fecha</label>
							</div>
							<div class="p-0 col-8">
								<input type="text" name="Fecha_Ingreso" class="form-control" style="font-size: 17px;" value="<?=substr($Ingreso["Fecha_Ingreso"], 0,10); ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-5">
								<label for="cif">Tamaño&nbsp;CIF</label>
							</div>
							<div class="p-0 col-6">
							<input type="text" name="cif" id="cif" class="form-control" value="<?=$Ingreso["Tamayo_Cif"]; ?>" readonly>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="Nit_Cliente">Empresa</label>
							</div>
							<div class="col-10">
								<select name="Nit_Cliente" id="Nit_Cliente" class="form-control" 
									data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax"); ?>" 
									data-url="<?=geturl("Ingresos", "Ingresos", "llenarplanta", false, "ajax"); ?>" disabled>
									<option value=""></option>
									<?php foreach ($Cliente as $Clientes): ?>
									<?php if ($Clientes["Nit_Cliente"] == $equi["Nit_Cliente"]): ?>
									<option value="<?=$Clientes["Nit_Cliente"];?>" selected><?=$Clientes["Razon_Social"];?></option>
									<?php else: ?>
									<option value="<?=$Clientes["Nit_Cliente"];?>"><?=$Clientes["Razon_Social"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="Codigo_Planta">Planta</label>
							</div>
							<div class="p-0 col-9">
								<select class="form-control" id="Codigo_Planta" name="Codigo_Planta" 
								data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax"); ?>" disabled>
									<?php if(!empty($Planta)): ?>
									<option value=""></option>
									<?php foreach ($Planta as $Plantas): ?>
									<?php if ($Plantas["Codigo_Planta"] == $equi["Codigo_Planta"]): ?>
									<option value="<?=$Plantas["Codigo_Planta"];?>" selected><?=$Plantas["Nombre"];?></option>
									<?php else: ?>
									<option value="<?=$Plantas["Codigo_Planta"];?>"><?=$Plantas["Nombre"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
									<?php else: ?>
									<option value="0"></option>
									<?php endif; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-5">
								<label for="Orden_Servicio">Orden de Servicio</label>
							</div>
							<div class="p-0 col-7">
								<input class="form-control" name="Orden_Servicio" id="Orden_Servicio" value="<?=$Ingreso["Orden_Servicio"]; ?>" readonly>
							</div>
						</div>
					</div>

				</div>


				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="Codigo_Tipo_Equipo">Equipo</label>
							</div>
							<div class="col-10">
								<select class="form-control" id="Codigo_Tipo_Equipo" name="Codigo_Tipo_Equipo" disabled>
									<option value=""></option>
									<?php foreach ($Tipos_Equipos as $Tipos_equipos): ?>
									<?php if ($equi["Codigo_Tipo_Equipo"] == $Tipos_equipos["Codigo_Tipo_Equipo"]): ?>
									<option value="<?=$Tipos_equipos["Codigo_Tipo_Equipo"];?>" selected><?=$Tipos_equipos["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$Tipos_equipos["Codigo_Tipo_Equipo"];?>"><?=$Tipos_equipos["Descripcion"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-7">
						<div class="row">
							<div class="col-3">
								<label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo</label>
							</div>
							<div class="col-9">
								<input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" value="<?=$Ingreso["Detalle_De_Equipo"]; ?>" maxlength="100" readonly>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="validNumeroSerie">N°&nbsp;Serie</label>
							</div>
							<div class="p-0 col-8">
								<input class="form-control" name="Numero_Serie" id="validNumeroSerie" data-url="<?=getUrl("Ingresos", "Ingresos", "ValidarNumeroSerie", false, "ajax"); ?>" value="<?=$equi["Numero_Serie"];?>" readonly>
								<input type="hidden" name="Numero_SerieTR" id="Numero_SerieTR" value="<?=$equi["Numero_Serie"];?>">
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="Codigo_Marca">Marca</label>
							</div>
							<div class="p-0 col-9">
								<select class="form-control" id="Codigo_Marca" name="Codigo_Marca" disabled>
									<option value=""></option>
									<?php foreach ($Marca as $Marcas): ?>
									<?php if ($equi["Codigo_Marca"] == $Marcas["Codigo_Marca"]): ?>
									<option value="<?=$Marcas["Codigo_Marca"];?>" selected><?=$Marcas["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$Marcas["Codigo_Marca"];?>"><?=$Marcas["Descripcion"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-12">
						<div class="row">
							<div class="col-1">
								<label for="Ubicacion">Ubicación</label>
							</div>
							<div class="col-11">
								<input class="form-control" name="Ubicacion" id="Ubicacion" value="<?=$Ingreso["Ubicacion"];?>" readonly>
							</div>
						</div>
					</div>

				</div>


				<div class="pb-2 row">

					<label class="header-blue">Enviado Para</label>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Cotizacion"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Cotizacion" type="radio" value="Cotizacion" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Cotizacion" type="radio" value="Cotizacion" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Cotizacion">Cotización</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Reparacion"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Reparacion" type="radio" value="Reparacion" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Reparacion" type="radio" value="Reparacion" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Reparacion">Reparación</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Mantenimiento"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Mantenimiento" type="radio" value="Mantenimiento" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Mantenimiento" type="radio" value="Mantenimiento" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Mantenimiento">Mantenimiento</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Garantia"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Garantia" type="radio" value="Garantia" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Garantia" type="radio" value="Garantia" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Garantia">Garantía</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Outsourcing"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Outsourcing" type="radio" value="Outsourcing" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Outsourcing" type="radio" value="Outsourcing" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Outsourcing">Outsourcing</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Otros"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="otros" type="radio" value="Otros" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="otros" type="radio" value="Otros" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="otros">Otros</label>
							</div>
						</div>
					</div>
				</div>


				<div class="pt-3 pb-3 row">

					<label class="header-blue">Datos Eléctricos</label>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="potencia">Potencia</label>
							</div>
							<div class="col-9">
								<input type="text" name="potencia" id="potencia" class="form-control" value="<?=$Dequi["Potencia"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="unidad">Unidad</label>
							</div>
							<div class="col-8">
								<select name="unidad" id="unidad" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "HP", "KW", "W", "KVA", "MVA", "VA", "CV"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Dequi["Unidad_De_Potencia"] == $valor): ?>
									<option value="<?=$Dequi["Unidad_De_Potencia"]; ?>" selected><?=$Dequi["Unidad_De_Potencia"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="fases">Fases</label>
							</div>
							<div class="col-6">
								<input type="text" name="fases" id="fases" class="form-control" value="<?=$equi["No_Fases"];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-4">
								<label for="frecuencia">Frecuencia</label>
							</div>
							<div class="col-8">
								<input type="text" name="frecuencia" id="frecuencia" class="form-control" value="<?=$Ingreso["Frecuencia"];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vp">Vp</label>
							</div>
							<div class="col-7">
								<input type="text" name="vp" id="vp" class="form-control" value="<?=$Dequi["V_Primario"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vs1">Vs 1</label>
							</div>
							<div class="col-7">
								<input type="text" name="vs1" id="vs1" class="form-control" value="<?=$Dequi["V_Secundario1"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>


				<div class="border-top pt-3 pb-3 row">

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vs2">Vs 2</label>
							</div>
							<div class="col-9">
								<input type="text" name="vs2" id="vs2" class="form-control" value="<?=$Dequi["V_Secundario2"]; ?>" readonly>
							</div>
						</div>
					</div>


					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="ip">Ip</label>
							</div>
							<div class="col-9">
								<input type="text" name="ip" id="ip" class="form-control" value="<?=$Dequi["I_Primario"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="is">Is</label>
							</div>
							<div class="col-9">
								<input type="text" name="is" id="is" class="form-control" value="<?=$Dequi["I_Secundario"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-5">
								<label for="grupoconex">Grupo Conexión</label>
							</div>
							<div class="col-7">
								<select name="grupoconex" id="grupoconex" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "Dd0", "Yy0", "Dz0", "Dy5", "Yd5", "Yz5", "Dd6", "Yy6",
											"Dz6", "Dy11", "Yd11", "Yz11"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Ingreso["Grupo_Conexion"] == $valor): ?>
									<option value="<?=$Ingreso["Grupo_Conexion"]; ?>" selected><?=$Ingreso["Grupo_Conexion"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>


					<div class="col-3">
						<div class="row">
							<div class="p-0 col-3">
								<label for="conexion">Conexión</label>
							</div>
							<div class="col-7">
								<input type="text" name="conexion" id="conexion" class="form-control" value="<?=$Ingreso["Conexion"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>


				<div class="border-top pt-3 pb-3 row">

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-3">
								<label for="regulacion">Regulación</label>
							</div>
							<div class="col-7">
								<select name="regulacion" id="regulacion" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "+/-2 x 2.5%", "+/-2 x 5%"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Ingreso["Regulacion"] == $valor): ?>
									<option value="<?=$Ingreso["Regulacion"]; ?>" selected><?=$Ingreso["Regulacion"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-3">
								<label for="insul">Insul Cls</label>
							</div>
							<div class="col-7">
								<select name="insul" id="insul" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "B", "F", "H"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Ingreso["Insul_Cls"] == $valor): ?>
									<option value="<?=$Ingreso["Insul_Cls"]; ?>" selected><?=$Ingreso["Insul_Cls"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Cuba"] == "S"): ?>
								<input class="form-control" name="cuba" id="cuba" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="cuba" id="cuba" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="cuba">Cuba</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Aislamientos_Bt"] != ""): ?>
								<input class="form-control" name="aislamientobt" id="aislamientobt" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="aislamientobt" id="aislamientobt" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="aislamientobt">Aislamientos&nbsp;BT</label>
							</div>
							<div class="col-4">
								<input type="text" name="textaislamientobt" id="textaislamientobt" class="form-control" value="<?=$Ingreso["Aislamientos_Bt"]?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Tapones"] == "S"): ?>
								<input class="form-control" name="tapones" id="tapones" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="tapones" id="tapones" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="tapones">Tapones</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Valvula"] != ""): ?>
								<input class="form-control" name="valvula" id="valvula" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="valvula" id="valvula" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-3">
								<label for="valvula">Valvula</label>
							</div>
							<div class="col-4">
								<input type="text" name="textvalvula" id="textvalvula" class="form-control" style="display: none;" value="<?=$Ingreso["Valvula"]?>" readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Tapa_Cuba"] == "S"): ?>
								<input class="form-control" name="tapa" id="tapa" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="tapa" id="tapa" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="tapa">Tapa Cuba</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Empaques_At"] != ""): ?>
								<input class="form-control" name="empaqueat" id="empaqueat" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="empaqueat" id="empaqueat" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="empaqueat">Empaques&nbsp;AT</label>
							</div>
							<div class="col-4">
								<input type="text" name="textempaqueat" id="textempaqueat" class="form-control" style="display: none;" value="<?=$Ingreso["Empaques_At"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Cancamo"] != ""): ?>
								<input class="form-control" name="cancamos" id="cancamos" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="cancamos" id="cancamos" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="cancamos">Cancamos</label>
							</div>
							<div class="col-4">
								<input type="text" name="textcancamos" id="textcancamos" class="form-control" style="display: none;" value="<?=$Ingreso["Cancamo"]?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Cambiador_Taps"] == "S"): ?>
								<input class="form-control" name="cambiador" id="cambiador" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="cambiador" id="cambiador" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="cambiador">Cambiador Taps</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Nucleo"] == "S"): ?>
								<input class="form-control" name="nucleo" id="nucleo" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="nucleo" id="nucleo" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="nucleo">Núcleo</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Empaques_Bt"] != ""): ?>
								<input class="form-control" name="empaquebt" id="empaquebt" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="empaquebt" id="empaquebt" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="empaquebt">Empaques&nbsp;BT</label>
							</div>
							<div class="col-4">
								<input type="text" name="textempaquebt" id="textempaquebt" class="form-control" style="display: none;" value="<?=$Ingreso["Empaques_Bt"]?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Tanque_Expansion"] == "S"): ?>
								<input class="form-control" name="tanqueEx" id="tanqueEx" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="tanqueEx" id="tanqueEx" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="tanqueEx">Tanque de Expansión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Rele_Buchholz"] == "S"): ?>
								<input class="form-control" name="rele" id="rele" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="rele" id="rele" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="rele">Rele Buchholz</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Bobinas"] == "S"): ?>
								<input class="form-control" name="bobinas" id="bobinas" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="bobinas" id="bobinas" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="bobinas">Bobinas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Bornera"] == "S"): ?>
								<input class="form-control" name="bornera" id="bornera" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="bornera" id="bornera" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="bornera">Bornera</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Tanque_Silica"] == "S"): ?>
								<input class="form-control" name="tanqueSi" id="tanqueSi" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="tanqueSi" id="tanqueSi" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="tanqueSi">Tanque Silica</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Cables_Baja"] == "S"): ?>
								<input class="form-control" name="cables" id="cables" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="cables" id="cables" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="cables">Cables de Baja</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Aceite"] != ""): ?>
								<input class="form-control" name="aceite" id="aceite" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="aceite" id="aceite" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-3">
								<label for="aceite">Aceite</label>
							</div>
							<div class="col-4">
								<input type="text" name="textaceite" id="textaceite" class="form-control" style="display: none;" value="<?=$Ingreso["Aceite"]?>" readonly>
							</div>
							<div class="col-1">
								<label class="font-weight-bold">GI</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Radiadores"] != ""): ?>
								<input class="form-control" name="radiadores" id="radiadores" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="radiadores" id="radiadores" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="radiadores">Radiadores</label>
							</div>
							<div class="col-4">
								<input type="text" name="textradiadores" id="textradiadores" class="form-control" style="display: none;" value="<?=$Ingreso["Radiadores"]?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Visor"] == "S"): ?>
								<input class="form-control" name="visor" id="visor" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="visor" id="visor" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="visor">Visor</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Placa_Datos"] == "S"): ?>
								<input class="form-control" name="placa" id="placa" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="placa" id="placa" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="placa">Placa de Datos</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Aislamientos_At"] != ""): ?>
								<input class="form-control" name="aislamientoat" id="aislamientoat" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="aislamientoat" id="aislamientoat" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="aislamientoat">Aislamientos&nbsp;AT</label>
							</div>
							<div class="col-4">
								<input type="text" name="textaislamientoat" id="textaislamientoat" class="form-control" style="display: none;" value="<?=$Ingreso["Aislamientos_At"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Ventilador"] != ""): ?>
								<input class="form-control" name="ventiladores" id="ventiladores" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="ventiladores" id="ventiladores" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="ventiladores">Ventiladores</label>
							</div>
							<div class="col-4">
								<input type="text" name="textventiladores" id="textventiladores" class="form-control" style="display: none;" value="<?=$Ingreso["Ventilador"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Indicador_Nivel_Aceite"] == "S"): ?>
								<input class="form-control" name="nivelAcite" id="nivelAcite" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="nivelAcite" id="nivelAcite" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="nivelAcite">Indicador Nivel Aceite</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Otros"] != ""): ?>
								<input class="form-control" name="Otros" id="Otros" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled checked>
								<?php else: ?>
								<input class="form-control" name="Otros" id="Otros" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-3">
								<label for="Otros">Otros</label>
							</div>
							<div class="col-7">
								<input type="text" name="textotros" id="textotros" class="form-control" style="display: none;" value="<?=$Ingreso["Otros"];?>" readonly>
							</div>
						</div>
					</div>
				</div>


				<div class="border-top pt-3 pb-3 row">
					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<label for="despachado_por">Despachado por</label>
							</div>
							<div class="col-8">
								<input type="text" class="form-control" id="despachado_por" name="despachado_por" value="<?=$Ingreso["Enviado_Por"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<label for="Cedula_Empleado">Recibido por</label>
							</div>
							<div class="col-8">
								<select class="form-control" id="Cedula_Empleado" name="Cedula_Empleado" disabled>
									<?php foreach ($Empleado as $Empleados): ?>
									<?php if ($Empleados["Cedula_Empleado"] == $Ingreso["Cedula_Empleado"]): ?>
									<option value="<?=$Empleados["Cedula_Empleado"];?>" selected><?=$Empleados["Nombre_Completo"];?></option>
									<?php else: ?>
									<option value="<?=$Empleados["Cedula_Empleado"];?>"><?=$Empleados["Nombre_Completo"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-12">
						<div class="row">
							<div class="col-2">
								<label for="Observaciones">Observaciones</label>
							</div>
							<div class="col-10">
								<textarea name="Observaciones" id="Observaciones" class="form-control" rows="4" readonly><?=$Ingreso["Observaciones"]; ?></textarea>
							</div>
						</div>
					</div>
				</div>

				
				<div class="border-top pt-3 pb-3 row">
					<div class="col-12">
						<div class="row">
							<div class="col-2">
								<label for="Requisitos_Cliente">Req's del cliente</label>
							</div>
							<div class="col-10">
								<input class="form-control" type="text" name="Requisitos_Cliente" id="Requisitos_Cliente" value="<?=$Ingreso["Requisitos_Cliente"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>


			</div> <!-- FIN CONTAINER -->
			

		</form>
	</div>
</div>

<script>
	$(document).ready(function () {
		if ($("#aislamientobt").is(":checked")) {
			$("#textaislamientobt").css("display", "block");
		} else {
			$("#textaislamientobt").css("display", "none");
		}

		if ($("#valvula").is(":checked")) {
			$("#textvalvula").css("display", "block");
		} else {
			$("#textvalvula").css("display", "none");
		}

		if ($("#empaqueat").is(":checked")) {
			$("#textempaqueat").css("display", "block");
		} else {
			$("#textempaqueat").css("display", "none");
		}

		if ($("#cancamos").is(":checked")) {
			$("#textcancamos").css("display", "block");
		} else {
			$("#textcancamos").css("display", "none");
		}

		if ($("#empaquebt").is(":checked")) {
			$("#textempaquebt").css("display", "block");
		} else {
			$("#textempaquebt").css("display", "none");
		}

		if ($("#aceite").is(":checked")) {
			$("#textaceite").css("display", "block");
		} else {
			$("#textaceite").css("display", "none");
		}

		if ($("#radiadores").is(":checked")) {
			$("#textradiadores").css("display", "block");
		} else {
			$("#textradiadores").css("display", "none");
		}

		if ($("#aislamientoat").is(":checked")) {
			$("#textaislamientoat").css("display", "block");
		} else {
			$("#textaislamientoat").css("display", "none");
		}

		if ($("#ventiladores").is(":checked")) {
			$("#textventiladores").css("display", "block");
		} else {
			$("#textventiladores").css("display", "none");
		}

		if ($("#Otros").is(":checked")) {
			$("#textotros").css("display", "block");
		} else {
			$("#textotros").css("display", "none");
		}
	});
</script>