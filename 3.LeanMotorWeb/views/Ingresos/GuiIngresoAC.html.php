<?php 
@session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso Equipo AC</b>
		</h4>
	</div>

	<div class="card-body">
		<form id="formIngresos" method="post" autocomplete="off" action="<?=getUrl("Ingresos", "Ingresos", "PostCrearAC"); ?>">

			<div class="container-fluid">
				<!-- CONTAINER -->
				<div class="pb-3 row">
					<div class="col-3">

						<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearAC" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso AC"><i class="fa fa-file"></i></a>

						<button type="submit" class="btn btn-primary" name="RegIngresoAC" id="RegIngresoAC" value="Guardar"><i class="fa fa-save"></i></button>

						<button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarIngresos" data-url='<?php echo getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax");  ?>' id="btnBuscarIngresos" value="Buscar"><i class="fa fa-search"></i></button>

						<button type="button" class="btn text-white" style="background-color: DarkViolet;" id="btn_datos_ElecEquiAC" title="Datos eléctricos" data-toggle="modal" data-target="#ModalEquipoAC"><i class="fa fa-bolt"></i></button>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">

					<input type="hidden" id="tipo_documento" name="tipo_documento" value="OI">

					<div class="col-5">
						<div class="row">
							<?php if ($usua_perfil == 1): ?>
							<div class="col-2">
								<label for="nit_sede">Sede&nbsp;*</label>
							</div>
		
							<div class="col-7">
								<select name="nit_sede" id="nit_sede" data-campo="#Nit_Cliente" class="form-control" 
									data-url="<?=getUrl("Utilidades", "Utilidades", "buscarClientesSede", false, "ajax"); ?>" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($sedes as $sede): ?>
									<option value="<?=$sede["nit_empresa"];?>"><?=$sede["nombre"];?></option>
									<?php endforeach;?>
								</select>
							</div>
							<?php else: ?>
							<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$nit_Empresa_sede;?>">
							<?php endif;?>
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
								data-urlcontacto="<?=geturl("Utilidades","Utilidades", "BuscarContactoCliente", false, "ajax"); ?>">
									<option value="0"></option>
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
								<input class="form-control" name="Orden_Servicio" id="Orden_Servicio">
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
									<option value="<?=$Tipos_equipos["Codigo_Tipo_Equipo"];?>"><?=$Tipos_equipos["Descripcion"];?></option>
									<?php endforeach;?>
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
								<input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" maxlength="100" required>
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
								<input class="form-control" name="no_fases" id="no_fases">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="validNumeroSerie">N°&nbsp;Serie&nbsp;*</label>
							</div>
							<div class="p-0 col-8">
								<input class="form-control" name="Numero_SerieAC" id="validNumeroSerie" data-url="<?=getUrl("Ingresos", "Ingresos", "ValidarNumeroSerie", false, "ajax"); ?>" required>
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
									<option value="<?=$Marcas["Codigo_Marca"];?>"><?=$Marcas["Descripcion"];?></option>
									<?php endforeach;?>
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
								<input class="form-control" name="Ubicacion" id="Ubicacion" required>
							</div>
						</div>
					</div>

				</div>


				<div class="pb-2 row">

					<label class="header-blue">Enviado Para&nbsp;*</label>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Cotizacion" type="radio" value="Cotizacion" required>
							</div>
							<div class="col-10">
								<label for="Cotizacion">Cotización</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Reparacion" type="radio" value="Reparacion" required>
							</div>
							<div class="col-10">
								<label for="Reparacion">Reparación</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Mantenimiento" type="radio" value="Mantenimiento" required>
							</div>
							<div class="col-10">
								<label for="Mantenimiento">Mantenimiento</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Garantia" type="radio" value="Garantia" required>
							</div>
							<div class="col-10">
								<label for="Garantia">Garantía</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Outsourcing" type="radio" value="Outsourcing" required>
							</div>
							<div class="col-10">
								<label for="Outsourcing">Outsourcing</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="otros" type="radio" value="Otros" required>
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
								<input class="form-control" name="Estator" id="Estator" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Estator">Estator</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Caja_Conexiones" id="Caja_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Caja_Conexiones">Caja Conexión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Contratapas" id="Contratapas" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Contratapas">Contratapas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Escobillas" id="Escobillas" type="checkbox" style="width: 20px; margin: -5px 20px;">
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
								<input class="form-control" name="Inventario_Rotor" id="Inventario_Rotor" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Inventario_Rotor">Rotor</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Tapa_Conexiones" id="Tapa_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Tapa_Conexiones">Tapa Caja Conexión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Tornillos" id="Tornillos" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Tornillos">Tornillos Tapas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Colector" id="Colector" type="checkbox" style="width: 20px; margin: -5px 20px;">
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
								<input class="form-control" name="ventiladorInt" id="ventiladorInt" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="ventiladorInt">Ventilador Interno</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Cancamo" id="Cancamo" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="Cancamo">Cancamo</label>
							</div>
							<div class="col-4">
								<input type="number" name="textcancamo" id="textcancamo" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Flejes" id="Flejes" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Flejes">Flejes</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Flanje" id="Flanje" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Flanje">Flanje</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Caperuza" id="Caperuza" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Caperuza">Caperuza</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Acople" id="Acople" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-3">
								<label for="Acople">Acople</label>
							</div>
							<div class="col-7">
								<input type="text" name="textacople" id="textacople" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Cunas" id="Cunas" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Cunas">Cuña</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Bornera" id="Bornera" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Bornera">Bornera</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Patas" id="Patas" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Patas">Patas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Polea" id="Polea" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Polea">Polea</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Blower" id="Blower" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Blower">Blower</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Placa_Datos" id="Placa_Datos" type="checkbox" style="width: 20px; margin: -5px 20px;">
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
								<input class="form-control" name="Reglete_de_Conexiones" id="Reglete_de_Conexiones" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Reglete_de_Conexiones">Reglete de Conexión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Brida" id="Brida" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Brida">Tapa Brida</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Portaescobillas" id="Portaescobillas" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="Portaescobillas">Portaescobillas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="Otros" id="Otros" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-3">
								<label for="Otros">Otros</label>
							</div>
							<div class="col-7">
								<input type="text" name="textotros" id="textotros" class="form-control" style="display: none;">
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
								<input class="form-control" type="text" name="Requisitos_Cliente" id="Requisitos_Cliente">
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
								<textarea name="Observaciones" id="Observaciones" class="form-control" rows="4"></textarea>
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
								<input type="text" class="form-control" id="despachado_por" name="despachado_por" required>
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
									<option value="<?=$Empleados["Cedula_Empleado"];?>"><?=$Empleados["Nombre_Completo"];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
				</div>

			</div> <!-- FIN CONTAINER -->


			<!-- Modal Datos Eléctricos AC -->
			<div class="modal fade" id="ModalEquipoAC" role="dialog">

				<div class="modal-dialog modal-lg" role="document">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Datos eléctricos AC</h4>
						</div>
						<div class="modal-body">
							<div id="datosElectAC">
								<table class="table table-borderless table-hover">
									<tbody id="tbody_datosElectricosAC">
										<tr>
											<th>Potencia</th>
											<th>Unidad</th>
											<th>R.P.M.</th>
											<th>Voltaje</th>
											<th>Amperaje</th>
											<td><button type='button' id='agregarDatosElectricosAC' class="btn btn-primary btn-circle"> + </button></td>
										</tr>
										<tr class="datosElectricos type-number">
											<td width="20%">
												<input type="text" class="form-control" name="PotenciaInsert[]" id="Potencia1"></td>
											<td width="20%">
												<select class="form-control select2" id="Unidad_De_Potencia1" name="Unidad_De_PotenciaInsert[]">
													<option value="" selected></option>
													<option value="HP">HP</option>
													<option value="KW">KW</option>
													<option value="W">W</option>
													<option value="KVA">KVA</option>
													<option value="MVA">MVA</option>
													<option value="VA">VA</option>
													<option value="CV">CV</option>
												</select>
											</td>
											<td width="20%"><input type="text" class="form-control" name="Revoluciones_Por_MinutoInsert[]" id="Revoluciones_Por_Minuto1"></td>
											<td width="20%"><input type="text" class="form-control" name="VoltajeInsert[]" id="Voltaje1"></td>
											<td width="20%"><input type="text" class="form-control" name="AmperajeInsert[]" id="Amperaje1"></td>
											<td><button type="button" name="btnserie" class="btn btn-danger btn-circle eliminar"> - </button></td>
										</tr>
									</tbody>
								</table>

								<div class="container">
									<div class="row">

										<div class=" col-sm-4">
											<label>Frame</label>
											<input class="form-control" name="Frame" id="Frame">
										</div>

										<div class=" col-sm-4">
											<label>Tipo</label>
											<input class="form-control" name="Tipo" id="Tipo">
										</div>

										<div class=" col-sm-4">
											<label>Mod</label>
											<input class="form-control" name="Mod" id="Mod">
										</div>
									</div>

									<div class="row">
										<div class=" col-sm-4">
											<label>Cos <i class="fa fa-cos"></i></label>
											<input class="form-control" name="Cos" id="Cos">
										</div>

										<div class=" col-sm-4">
											<label>Eficiencia %</label>
											<input class="form-control" name="Eficiencia" id="Eficiencia">
										</div>

										<div class=" col-sm-4">
											<label>Frecuencia Hz</label>
											<input class="form-control" name="Frecuencia" id="Frecuencia">
										</div>
									</div>

									<div class="row">

										<div class="col-sm-12">
											<div class="row">
												<div class=" col-sm-4">
													<label>Conexion</label>
													<select class="form-control" id="Conexion" name="Conexion">
														<option value="">Seleccione ...</option>
														<option value="Y/2Y">Y/2Y</option>
														<option value="D/Y">D/Y</option>
														<option value="D/2D">D/2D</option>
														<option value="Y">Y</option>
														<option value="D">D</option>
														<option value="Dos Velocidades">Dos Velocidades</option>
														<option value="Tres Velocidades">Tres Velocidades</option>
														<option value="Part Winding">Part Winding</option>
														<option value="Dahlander">Dahlander</option>
														<option value="Tres Velocidades (Dahlander)">Tres Velocidades (Dahlander)</option>
														<option value="Especial">Especial</option>
													</select>
												</div>

												<div class="col-sm-4">
													<label>F.S.</label>
													<select class="form-control" id="Fs" name="Fs">
														<option value="">Seleccione ...</option>
														<option value="1.0">1.0</option>
														<option value="1.05">1.05</option>
														<option value="1.10">1.10</option>
														<option value="1.15">1.15</option>
														<option value="1.20">1.20</option>
														<option value="1.25">1.25</option>
														<option value="1.30">1.30</option>
														<option value="1.35">1.35</option>
														<option value="1.40">1.40</option>
														<option value="1.50">1.50</option>
														<option value="1.60">1.60</option>
														<option value="1.75">1.75</option>
														<option value="2.0">2.0</option>
													</select>
												</div>

												<div class=" col-sm-4">
													<label>Encl</label>
													<select class="form-control" id="Encl" name="Encl">
														<option value="">Seleccione ...</option>
														<option value="TEFC">TEFC</option>
														<option value="ODP">ODP</option>
														<option value="EXP">EXP</option>
														<option value="PROOF">PROOF</option>
														<option value="Severy Duty">Severy Duty</option>
													</select>
												</div>
											</div>

											<div class="row">
												<div class=" col-sm-4">
													<label>IP</label>
													<select class="form-control" id="Ip" name="Ip">
														<option value="">Seleccione ...</option>
														<option value="68">68</option>
														<option value="56">56</option>
														<option value="55">55</option>
														<option value="54">54</option>
														<option value="23">23</option>
														<option value="21">21</option>
														<option value="00">00</option>
													</select>
												</div>

												<div class=" col-sm-4">
													<label>Insul Cls</label>
													<select class="form-control" id="Insul_Cls" name="Insul_Cls">
														<option value="">Seleccione ...</option>
														<option value="B">B</option>
														<option value="F">F</option>
														<option value="H">H</option>
														<option value="Inverter Duty">Inverter Duty</option>
													</select>
												</div>

												<div class=" col-sm-4">
													<label>Rotor</label>
													<select class="form-control" id="RotorDetalle" name="RotorDetalle">
														<option value="">Seleccione ...</option>
														<option value="Jaula de Ardilla">Jaula de Ardilla</option>
														<option value="Devanado">Devanado</option>
													</select>
												</div>

											</div>
										</div>

									</div>
								</div>
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
	checkboxes=document.getElementsByTagName("input"); //obtenemos todos los controles del tipo Input
	for(i=0; i<checkboxes.length; i++) { //recorremos todos los controles
		if(checkboxes[i].type == "checkbox" && checkboxes[i].id != "Urgente") { //solo si es un checkbox entramos y no es el checkbox "Urgente"
			checkboxes[i].checked=elemento.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
		}
	}
	
	if ($("#Cancamo").is(":checked")) {
		$("#textcancamo").css("display", "block");
	}else{
		$("#textcancamo").css("display", "none");
	}

	if ($("#Acople").is(":checked")) {
		$("#textacople").css("display", "block");
	}else{
		$("#textacople").css("display", "none");
	}

	if ($("#Otros").is(":checked")) {
		$("#textotros").css("display", "block");
	}else{
		$("#textotros").css("display", "none");
	}
}

$(document).ready(function () {
	$(document).on("click", "#Cancamo", function () {
		$("#textcancamo").toggle();
	});

	$(document).on("click", "#Acople", function () {
		$("#textacople").toggle();
	});

	$(document).on("click", "#Otros", function () {
		$("#textotros").toggle();
	});
});
</script>