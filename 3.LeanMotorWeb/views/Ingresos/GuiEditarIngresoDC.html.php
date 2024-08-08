<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso Equipo DC - Editando</b>
		</h4>
	</div>

	<div class="card-body">
		<form method="post" autocomplete="off" action="<?=getUrl("Ingresos", "Ingresos", "postEditarDC"); ?>">
			<?php 
				foreach($IngresoEqui as $Ingreso){}
				foreach($Equipo as $equi){}
			?>

			<input type="hidden" id="Numero_Ingreso" value="<?=$Ingreso["Numero_Ingreso"];?>">
			
			<?php if($Ingreso["Estado"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>
			
			<div class="container-fluid">
				<!-- CONTAINER -->
				<div class="pb-3 row">
					<div class="col-5">
						<div class="row">
							<div class="col-8">
								<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearDC" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso DC"><i class="fa fa-file"></i></a>
		                        
		                        <button type="submit" class="btn btn-primary" name="RegIngreso" id="RegIngreso" value="Guardar" title="Guardar Ingreso DC"><i class="fa fa-save"></i></button> 
		                        
		                        <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarIngresos" data-url='<?=getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax")  ?>' id="btnBuscarIngresos" value="Buscar" title="Buscar Ingresos"><i class="fa fa-search"></i></button>
		                        
		                        <button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosIngreso" title="Ver Datos Adicionales" data-url='<?=getUrl("Ingresos", "Ingresos", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosIngreso" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>

								<button type="button" class="btn text-white" style="background-color: Red;" name="AnularIngreso" title="Anular Ingreso"  data-url='<?=getUrl("Ingresos", "Ingresos", "AnularIngreso", false, "ajax")  ?>' id="AnularIngreso" value="Anular"><i class="fa fa-trash-alt"></i></button>
		                        
		                        <button type="button" class="btn text-white" style="background-color: DarkViolet;" id="btn_datos_ElecEquiDC" title="Datos eléctricos" data-toggle="modal" data-target="#ModalEquipoDC"><i class="fa fa-bolt"></i></button>
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

					<div class="col-4">
						<div class="row">
							<?php if ($usua_perfil == 1): ?>
							<div class="col-2">
								<label for="nit_sede">Sede&nbsp;*</label>
							</div>
							<div class="col-8">
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

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="Fecha_Ingreso">Fecha</label>
							</div>
							<div class="col-7">
								<input type="text" name="Fecha_Ingreso" class="form-control" style="font-size: 17px;" value="<?=substr($Ingreso["Fecha_Ingreso"], 0,10); ?>" readonly>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">

					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="Nit_Cliente">Empresa&nbsp;*</label>
							</div>
							<div class="col-10">
								<select name="Nit_Cliente" id="Nit_Cliente" class="form-control select2" 
									data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax"); ?>" 
									data-url="<?=geturl("Ingresos", "Ingresos", "llenarplanta", false, "ajax"); ?>" required>
									<option value="">Seleccione ...</option>
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
								data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax"); ?>">
									<?php if(!empty($Planta)): ?>
									<option value="">Seleccione ...</option>
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
								<label for="Orden_Servicio">Orden&nbsp;de&nbsp;Servicio</label>
							</div>
							<div class="p-0 col-7">
								<input class="form-control" name="Orden_Servicio" id="Orden_Servicio" value="<?=$Ingreso["Orden_Servicio"]; ?>">
							</div>
						</div>
					</div>

				</div>


				<div class="border-top pt-3 pb-3 row">

					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="Codigo_Tipo_Equipo">Equipo&nbsp;*</label>
							</div>
							<div class="col-10">
								<select class="form-control select2" id="Codigo_Tipo_Equipo" name="Codigo_Tipo_Equipo">
									<option value="">Seleccione ...</option>
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
								<label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo&nbsp;*</label>
							</div>
							<div class="col-9">
								<input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" value="<?=$Ingreso["Detalle_De_Equipo"]; ?>" maxlength="100" required>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-2">
						<div class="row">
							<div class="col-5">
								<label for="no_fases">Fases</label>
							</div>
							<div class="p-0 col-5">
								<input class="form-control" name="no_fases" id="no_fases" value="<?=$equi["No_Fases"];?>">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="validNumeroSerie">N°&nbsp;Serie&nbsp;*</label>
							</div>
							<div class="p-0 col-8">
								<input class="form-control" name="Numero_Serie" id="validNumeroSerie" data-url="<?=getUrl("Ingresos", "Ingresos", "ValidarNumeroSerie", false, "ajax"); ?>" value="<?=$Ingreso["Numero_Serie"];?>" required>
								<input type="hidden" name="Numero_SerieDC" id="Numero_SerieDC" value="<?=$Ingreso["Numero_Serie"];?>">
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-2">
								<label for="Codigo_Marca">Marca&nbsp;*</label>
							</div>
							<div class="col-9">
								<select class="form-control select2" id="Codigo_Marca" name="Codigo_Marca" required>
									<option value="">Seleccione ...</option>
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
								<label for="Ubicacion">Ubicación&nbsp;*</label>
							</div>
							<div class="col-11">
								<input class="form-control" name="Ubicacion" id="Ubicacion" value="<?=$Ingreso["Ubicacion"];?>" required>
							</div>
						</div>
					</div>

				</div>


				<div class="pb-2 row">

					<label class="header-blue">Enviado Para&nbsp;*</label>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Cotizacion"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Cotizacion" type="radio" value="Cotizacion" required checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Cotizacion" type="radio" value="Cotizacion" required>
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
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Reparacion" type="radio" value="Reparacion" required checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Reparacion" type="radio" value="Reparacion" required>
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
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Mantenimiento" type="radio" value="Mantenimiento" required checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Mantenimiento" type="radio" value="Mantenimiento" required>
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
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Garantia" type="radio" value="Garantia" required checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Garantia" type="radio" value="Garantia" required>
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
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Outsourcing" type="radio" value="Outsourcing" required checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Outsourcing" type="radio" value="Outsourcing" required>
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
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="otros" type="radio" value="Otros" required checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="otros" type="radio" value="Otros" required>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="otros">Otros</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Estator"] == "S"): ?>
								<input class="form-control" name="Estator" id="Estator" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Estator" id="Estator" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Estator">Estator</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Caja_Conexiones"] == "S"): ?>
								<input class="form-control" name="Caja_Conexiones" id="Caja_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Caja_Conexiones" id="Caja_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Caja_Conexiones">Caja Conexión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Contratapas"] == "S"): ?>
								<input class="form-control" name="Contratapas" id="Contratapas" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Contratapas" id="Contratapas" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Contratapas">Contratapas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Escobillas"] == "S"): ?>
								<input class="form-control" name="Escobillas" id="Escobillas" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Escobillas" id="Escobillas" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-5">
								<label for="Escobillas">Escobillas</label>
							</div>
							<div class="p-0 col-2">
								<input class="form-control" name="Todas" id="Todas" type="checkbox" style="width: 20px; margin: -5px 20px;" onclick="marcar(this);" title="Seleccionar Todos">
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Bornera"] == "S"): ?>
								<input class="form-control" name="Bornera" id="Bornera" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Bornera" id="Bornera" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Bornera">Bornera</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Tapa_Caja_Conexiones"] == "S"): ?>
								<input class="form-control" name="Tapa_Caja_Conexiones" id="Tapa_Caja_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Tapa_Caja_Conexiones" id="Tapa_Caja_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Tapa_Caja_Conexiones">Tapa Caja Conexión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Tornillos_Tapas"] == "S"): ?>
								<input class="form-control" name="Tornillos_Tapas" id="Tornillos_Tapas" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Tornillos_Tapas" id="Tornillos_Tapas" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Tornillos">Tornillos Tapas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Colector"] == "S"): ?>
								<input class="form-control" name="Colector" id="Colector" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Colector" id="Colector" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Colector">Colector</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Ventilador"] == "S"): ?>
								<input class="form-control" name="Ventilador" id="Ventilador" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Ventilador" id="Ventilador" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="ventiladorInt">Ventilador Interno</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Cancamo"] != ""): ?>
								<input class="form-control" name="Cancamo" id="Cancamo" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Cancamo" id="Cancamo" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="Cancamo">Cancamo</label>
							</div>
							<div class="col-4">
								<input type="number" name="textcancamo" id="textcancamo" class="form-control" style="display: none;" value="<?=$Ingreso["Cancamo"];?>">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Flejes"] == "S"): ?>
								<input class="form-control" name="Flejes" id="Flejes" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Flejes" id="Flejes" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Flejes">Flejes</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Armadura"] == "S"): ?>
								<input class="form-control" name="Armadura" id="Armadura" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Armadura" id="Armadura" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Armadura">Armadura</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Caperuza"] == "S"): ?>
								<input class="form-control" name="Caperuza" id="Caperuza" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Caperuza" id="Caperuza" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Caperuza">Caperuza</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Acople"] != ""): ?>
								<input class="form-control" name="Acople" id="Acople" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Acople" id="Acople" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-3">
								<label for="Acople">Acople</label>
							</div>
							<div class="col-7">
								<input type="text" name="textacople" id="textacople" class="form-control" style="display: none;" value="<?=$Ingreso["Acople"];?>">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Cunas"] == "S"): ?>
								<input class="form-control" name="Cunas" id="Cunas" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Cunas" id="Cunas" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Cunas">Cuña</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Placa_Datos"] == "S"): ?>
								<input class="form-control" name="Placa_Datos" id="Placa_Datos" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Placa_Datos" id="Placa_Datos" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Placa_Datos">Placa de Datos</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Patas"] == "S"): ?>
								<input class="form-control" name="Patas" id="Patas" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Patas" id="Patas" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Patas">Patas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Polea"] == "S"): ?>
								<input class="form-control" name="Polea" id="Polea" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Polea" id="Polea" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Polea">Polea</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Blower"] == "S"): ?>
								<input class="form-control" name="Blower" id="Blower" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Blower" id="Blower" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Blower">Blower</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Visor"] != ""): ?>
								<input class="form-control" name="Visor" id="Visor" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Visor" id="Visor" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-6">
								<label for="Visor">Visor</label>
							</div>
							<div class="col-4">
                            	<input type="number" name="textvisor" id="textvisor" class="form-control" style="display: none;" value="<?=$Ingreso["Visor"];?>">
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Reglete_de_Conexiones"] == "S"): ?>
								<input class="form-control" name="Reglete_de_Conexiones" id="Reglete_de_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Reglete_de_Conexiones" id="Reglete_de_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Reglete_de_Conexiones">Reglete de Conexión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Brida"] == "S"): ?>
								<input class="form-control" name="Brida" id="Brida" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Brida" id="Brida" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Brida">Tapa Brida</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Portaescobillas"] == "S"): ?>
								<input class="form-control" name="Portaescobillas" id="Portaescobillas" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Portaescobillas" id="Portaescobillas" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Portaescobillas">Portaescobillas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Otros"] != ""): ?>
								<input class="form-control" name="Otros" id="Otros" type="checkbox" style="width: 20px; margin: -5px 20px;" checked>
								<?php else: ?>
								<input class="form-control" name="Otros" id="Otros" type="checkbox" style="width: 20px; margin: -5px 20px;">
								<?php endif; ?>
							</div>
							<div class="col-3">
								<label for="Otros">Otros</label>
							</div>
							<div class="col-7">
								<input type="text" name="textotros" id="textotros" class="form-control" style="display: none;" value="<?=$Ingreso["Otros"];?>">
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
								<input class="form-control" type="text" name="Requisitos_Cliente" id="Requisitos_Cliente" value="<?=$Ingreso["Requisitos_Cliente"]; ?>">
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
								<textarea name="Observaciones" id="Observaciones" class="form-control" rows="4"><?=$Ingreso["Observaciones"]; ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<label for="despachado_por">Despachado por&nbsp;*</label>
							</div>
							<div class="col-8">
								<input type="text" class="form-control" id="despachado_por" name="despachado_por" value="<?=$Ingreso["Enviado_Por"]; ?>" required>
							</div>
						</div>
					</div>

					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<label for="Cedula_Empleado">Recibido por&nbsp;*</label>
							</div>
							<div class="col-8">
								<select class="form-control select2" id="Cedula_Empleado" name="Cedula_Empleado" required>
									<option value="">Seleccione ...</option>
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


			</div> <!-- FIN CONTAINER -->


			<!-- Modal Datos Eléctricos DC -->
			<div class="modal fade" id="ModalEquipoDC" role="dialog">

				<div class="modal-dialog modal-lg" role="document">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Datos eléctricos DC</h4>
						</div>
						<div class="modal-body">
							<div id="datosElectDC">
									<table class="table table-borderless table-hover">
										<tr>
											<th>Potencia</th>
											<th>Unidad</th>
											<th>R.P.M.</th>
											<th>VA</th>
											<th>VC</th>
											<th>IA</th>
											<th>IC</th>
											<td><button type='button' id='agregarDatosElectricosDC' class="btn btn-primary btn-circle"> + </button></td>
										</tr>
										<?php $cont=1; ?>

										<tbody id="tbody_datosElectricosDC">

										<?php if ($Detalle != null): ?>
											<?php foreach ($Detalle as $deta): ?>
											<tr class="datosElectricos type-number">
												<td width="13%">
													<input type="hidden" name="Numero_RegistroEditar[]" value="<?=$deta["Numero_Registro"]; ?>">
													<input type="text" class="form-control" name="PotenciaEditar[]" id="Potencia<?=$cont; ?>" value="<?=$deta["Potencia"]; ?>"></td>
												<td width="13%">
													<select class="form-control select2" id="Unidad_De_Potencia<?=$cont; ?>" name="Unidad_De_PotenciaEditar[]">
														<?php
														$options = array(
															"valor" => "", "HP", "KW", "W", "KVA", "MVA", "VA", "CV"
														);
														?>
														<?php foreach ($options as $valor): ?>
															<?php if($deta["Unidad_De_Potencia"] == $valor): ?>
																<option value="<?=$deta["Unidad_De_Potencia"];?>" selected><?=$deta["Unidad_De_Potencia"];?></option>
															<?php else: ?>
																<option value="<?=$valor;?>"><?=$valor;?></option>
														<?php endif; ?>
														<?php endforeach; ?>
													</select>
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="Revoluciones_Por_MinutoEditar[]" id="Revoluciones_Por_Minuto<?=$cont; ?>" value="<?=$deta["Revoluciones_Por_Minuto"]; ?>">
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="VaEditar[]" id="Va<?=$cont; ?>" value="<?=$deta["Va"]; ?>">
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="VcEditar[]" id="Vc<?=$cont; ?>" value="<?=$deta["Vc"]; ?>">
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="IaEditar[]" id="Ia<?=$cont; ?>" value="<?=$deta["Ia"]; ?>">
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="IcEditar[]" id="Ic<?=$cont; ?>" value="<?=$deta["Ic"]; ?>">
												</td>
												<td>
													<button type="button" class="btn btn-danger btn-circle btnEliminarDatoElectrico" data-url='<?=getUrl("Ingresos", "Ingresos", "EliminarDatoElectrico", false, "ajax");  ?>'> - </button>
												</td>
											</tr>
											<?php $cont++; ?>
											<?php endforeach; ?>
										</tbody>
										<?php endif; ?>
									</table>

									<?php if ($Detalle2 != null): ?>
									<?php foreach ($Detalle2 as $deta2): ?>
									<div class="container">
										<div class="row">
											<div class="col-sm-4">
												<label>Frame</label>
												<input class="form-control" name="Frame" id="Frame" value="<?=$deta2["Frame"]; ?>">
											</div>

											<div class=" col-sm-4">
												<label>Tipo</label>
												<input class="form-control" name="Tipo" id="Tipo" value="<?=$deta2["Tipo"]; ?>">
											</div>

											<div class="col-sm-4">
												<label>Mod</label>
												<input class="form-control" name="Mod" id="Mod" value="<?=$deta2["Modulo"]; ?>">
											</div>
										</div>

										<div class="row">
											<div class=" col-sm-4">
												<label>Style</label>
												<input class="form-control" name="Style" id="Style" value="<?=$deta2["Style"]; ?>">
											</div>

											<div class=" col-sm-4">
												<label>Form</label>
												<input class="form-control" name="Form" id="Form" value="<?=$deta2["Form"]; ?>">
											</div>

											<div class=" col-sm-4">
												<label>Frecuencia Hz</label>
												<input class="form-control" name="Frecuencia" id="Frecuencia" value="<?=$deta2["Frecuencia"]; ?>">
											</div>
										</div>

										<div class="row">
											<div class="col-12">
												<div class="row">
													<div class=" col-sm-4">
														<label>Conexion</label>
														<select class="form-control" id="Conexion" name="Conexion">
															<?php
															$options = array(
																"valor" => "Seleccione ...", "Y/2Y", "D/Y", "D/2D", "Y", 
																"D", "Dos Velocidades", "Tres Velocidades", 
																"Part Winding", "Dahlander", "Tres Velocidades (Dahlander)",
																"Especial"
															);
															?>
															<?php foreach ($options as $valor): ?>
															<?php if($deta2["Conexion"] == $valor): ?>
																<option value="<?=$deta2["Conexion"];?>" selected><?=$deta2["Conexion"];?></option>
															<?php else: ?>
																<option value="<?=$valor;?>"><?=$valor;?></option>
															<?php endif; ?>
															<?php endforeach; ?>
														</select>
													</div>

													<div class=" col-sm-4">
														<label>F.S.</label>
														<select class="form-control" id="Fs" name="Fs">
															<?php
															$options = array(
																"valor" => "Seleccione ...", "1.0", "1.05", "1.10", "1.15", 
																"1.20", "1.25", "1.30", "1.35", "1.40",
																"1.50", "1.60", "1.75", "2.0"
															);
															?>
															<?php foreach ($options as $valor): ?>
															<?php if($deta2["Fs"] == $valor): ?>
																<option value="<?=$deta2["Fs"];?>" selected><?=$deta2["Fs"];?></option>
															<?php else: ?>
																<option value="<?=$valor;?>"><?=$valor;?></option>
															<?php endif; ?>
															<?php endforeach; ?>
														</select>
													</div>
													<div class=" col-sm-4">
														<label>Encl</label>
														<select class="form-control" id="Encl" name="Encl">
															<?php
															$options = array(
																"valor" => "Seleccione ...", "TEFC", "ODP", "EXP", "PROOF", 
																"Severy Duty"
															);
															?>
															<?php foreach ($options as $valor): ?>
															<?php if($deta2["Encl"] == $valor): ?>
																<option value="<?=$deta2["Encl"];?>" selected><?=$deta2["Encl"];?></option>
															<?php else: ?>
																<option value="<?=$valor;?>"><?=$valor;?></option>
															<?php endif; ?>
															<?php endforeach; ?>
														</select>
													</div>
												</div>

												<div class="row">
													<div class=" col-sm-4">
														<label>IP</label>
														<select class="form-control" id="Ip" name="Ip">
															<?php
															$options = array(
																"valor" => "Seleccione ...", "68", "56", "55", "54", 
																"23", "21", "00"
															);
															?>
															<?php foreach ($options as $valor): ?>
															<?php if($deta2["Ip"] == $valor): ?>
																<option value="<?=$deta2["Ip"];?>" selected><?=$deta2["Ip"];?></option>
															<?php else: ?>
																<option value="<?=$valor;?>"><?=$valor;?></option>
															<?php endif; ?>
															<?php endforeach; ?>
														</select>
													</div>

													<div class=" col-sm-4">
														<label>Insul Cls</label>
														<select class="form-control" id="Insul_Cls" name="Insul_Cls">
															<?php
															$options = array(
																"valor" => "Seleccione ...", "B", "F", "H", "Inverter Duty"
															);
															?>
															<?php foreach ($options as $valor): ?>
															<?php if($deta2["Insul_Cls"] == $valor): ?>
																<option value="<?=$deta2["Insul_Cls"];?>" selected><?=$deta2["Insul_Cls"];?></option>
															<?php else: ?>
																<option value="<?=$valor;?>"><?=$valor;?></option>
															<?php endif; ?>
															<?php endforeach; ?>
														</select>
													</div>

												</div>

											</div>

										</div>
									</div>
									<?php endforeach; ?>
									<?php endif; ?>
							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
						</div>
					</div>
				</div>

			</div>

		</form>
	</div>
</div>

<script>
	function marcar(elemento) {
		checkboxes = document.getElementsByTagName("input"); //obtenemos todos los controles del tipo Input
		for (i = 0; i < checkboxes.length; i++) { //recorremos todos los controles
			if (checkboxes[i].type == "checkbox" && checkboxes[i].id != "Urgente") { //solo si es un checkbox entramos y no es el checkbox "Urgente"
				checkboxes[i].checked = elemento.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}

		if ($("#Cancamo").is(":checked")) {
			$("#textcancamo").css("display", "block");
		} else {
			$("#textcancamo").css("display", "none");
		}

		if ($("#Acople").is(":checked")) {
			$("#textacople").css("display", "block");
		} else {
			$("#textacople").css("display", "none");
		}

		if ($("#Visor").is(":checked")) {
			$("#textvisor").css("display", "block");
		} else {
			$("#textvisor").css("display", "none");
		}

		if ($("#Otros").is(":checked")) {
			$("#textotros").css("display", "block");
		} else {
			$("#textotros").css("display", "none");
		}
	}

	$(document).ready(function () {

		let checkboxRellenados = true;

		$('input[type="checkbox"]').each(function (){
			if ($(this).attr("id") != "Urgente" && $(this).attr("id") != "Todas") {
				if (!$(this).is(":checked")) {
					checkboxRellenados = false;
				}
			}
		});

		if (checkboxRellenados) {
			$("#Todas").prop("checked", true);
		}else{
			$("#Todas").prop("checked", false);
		}

		if ($("#Cancamo").is(":checked")) {
			$("#textcancamo").css("display", "block");
		} else {
			$("#textcancamo").css("display", "none");
		}

		if ($("#Acople").is(":checked")) {
			$("#textacople").css("display", "block");
		} else {
			$("#textacople").css("display", "none");
		}

		if ($("#Visor").is(":checked")) {
			$("#textvisor").css("display", "block");
		} else {
			$("#textvisor").css("display", "none");
		}

		if ($("#Otros").is(":checked")) {
			$("#textotros").css("display", "block");
		} else {
			$("#textotros").css("display", "none");
		}
		
		$(document).on("click", "#Cancamo", function () {
			$("#textcancamo").toggle();
		});

		$(document).on("click", "#Acople", function () {
			$("#textacople").toggle();
		});

		$(document).on("click", "#Visor", function () {
			$("#textvisor").toggle();
		});

		$(document).on("click", "#Otros", function () {
			$("#textotros").toggle();
		});
	});
</script>