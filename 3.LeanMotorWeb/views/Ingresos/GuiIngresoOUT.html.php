<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso de Outsourcing</b>
		</h4>
	</div>

	<div class="card-body">
		<form id="formIngresos" method="post" autocomplete="off" action="<?=getUrl("Ingresos", "Ingresos", "PostCrearOT"); ?>">

			<div class="container-fluid">
				<!-- CONTAINER -->
				<div class="pb-3 row">
					<div class="col-3">
						<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearOT" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso OT"><i class="fa fa-file"></i></a>

						<button type="submit" class="btn btn-primary" name="RegIngresoOT" id="RegIngresoOT" value="Guardar"><i class="fa fa-save"></i></button>

						<button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarIngresos" data-url='<?php echo getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax");  ?>' id="btnBuscarIngresos" value="Buscar"><i class="fa fa-search"></i></button>

						<button type="button" class="btn text-white" style="background-color: DarkViolet;" title="Datos eléctricos" data-toggle="modal" data-target="#ModalEquipoOT"><i class="fa fa-bolt"></i></button>
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

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="Codigo_Tipo_Equipo">Tipo&nbsp;de&nbsp;Equipo&nbsp;*</label>
							</div>
							<div class="col-7">
								<select class="form-control" id="Codigo_Tipo_Equipo" name="Codigo_Tipo_Equipo"
								data-url="<?=geturl("Ingresos","Ingresos", "BuscarClaseEquipo", false, "ajax"); ?>" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($Tipos_Equipos as $Tipos_equipos): ?>
									<option value="<?=$Tipos_equipos["Codigo_Grupo"];?>"><?=$Tipos_equipos["Descripcion"];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-5">
								<label for="cif">Tamaño CIF</label>
							</div>
							<div class="p-0 col-6">
								<input type="text" name="cif" id="cif" class="form-control" value="1">
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
								data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax" ); ?>"
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
								data-urlcontacto="<?=geturl("Utilidades","Utilidades", "BuscarContactoCliente", false, "ajax" ); ?>">
									<option value="0"></option>
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
								<input class="form-control" name="Orden_Servicio" id="Orden_Servicio">
							</div>
						</div>
					</div>

				</div>


				<div class="border-top pt-3 pb-3 row">

					<div class="col-5">
						<div class="row">
							<div class="col-5">
								<label for="Codigo_Actividad_Produccion">Servicio de Outsourcing</label>
							</div>
							<div class="col-7">
								<select class="form-control select2" id="Codigo_Actividad_Produccion" name="Codigo_Actividad_Produccion">
									<option value="">Seleccione ...</option>
									<?php foreach ($Servicios as $servicios): ?>
									<option value="<?=$servicios["Codigo"];?>"><?=$servicios["Descripcion"];?></option>
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
							<div class="col-8">
								<input class="form-control" name="Numero_SerieOT" id="validNumeroSerie" data-url="<?=getUrl("Ingresos", "Ingresos", "ValidarNumeroSerie", false, "ajax"); ?>" required>
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
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Otros" type="radio" value="Otros" required>
							</div>
							<div class="col-10">
								<label for="Otros">Otros</label>
							</div>
						</div>
					</div>
				</div>

				<div class="pb-3 pt-3 row">
					<label class="header-blue">Descripción General del Outsourcing</label>

					<div class="col-3">
						<label for="Codigo_Tipo_Equipo_Out">Clase de Equipo&nbsp;*</label>
						<select class="form-control select2" id="Codigo_Tipo_Equipo_Out" name="Codigo_Tipo_Equipo_Out" required>
							<option value="">Seleccione ...</option>
						</select>
					</div>

					<div class="col-3">
						<label for="Codigo_Aplicacion_Out">Aplicación</label>
						<select class="form-control" id="Codigo_Aplicacion_Out" name="Codigo_Aplicacion_Out">
							<option value="">Seleccione ...</option>
							<?php foreach ($Aplicacion as $Aplicaciones): ?>
							<option value="<?=$Aplicaciones["Codigo"];?>"><?=$Aplicaciones["Descripcion"];?></option>
							<?php endforeach;?>
						</select>
					</div>

					<div class="col-3">
						<label for="Codigo_Tipo_Arranque_Out">Tipo de Arranque</label>
						<select class="form-control" id="Codigo_Tipo_Arranque_Out" name="Codigo_Tipo_Arranque_Out">
							<option value="">Seleccione ...</option>
							<?php foreach ($Arranque as $Arranques): ?>
							<option value="<?=$Arranques["Codigo"];?>"><?=$Arranques["Descripcion"];?></option>
							<?php endforeach;?>
						</select>
					</div>

					<div class="col-3">
						<label for="Codigo_Acoplamiento_Out">Acoplamiento Correcto</label>
						<select class="form-control" id="Codigo_Acoplamiento_Out" name="Codigo_Acoplamiento_Out">
							<option value="">Seleccione ...</option>
							<?php foreach ($Acoplamiento as $Acoplamientos): ?>
							<option value="<?=$Acoplamientos["Codigo"];?>"><?=$Acoplamientos["Descripcion"];?></option>
							<?php endforeach;?>
						</select>
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


			<!-- Modal Datos Eléctricos OT -->
			<div class="modal fade" id="ModalEquipoOT" role="dialog">

				<div class="modal-dialog modal-lg" role="document">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Datos eléctricos OUT</h4>
						</div>
						<div class="modal-body">
							<div id="datosElectOT">
								<table class="table table-borderless table-hover">
									<tbody id="tbody_datosElectricosOT">
										<tr>
											<th>Potencia</th>
											<th>Unidad</th>
											<th>R.P.M.</th>
											<th>VA</th>
											<th>VC</th>
											<th>IA</th>
											<th>IC</th>
											<td><button type='button' id='agregarDatosElectricosOT' class="btn btn-primary btn-circle"> + </button></td>
										</tr>
										<tr class="datosElectricos type-number">
											<td width="13%">
												<input type="text" class="form-control" name="PotenciaInsert[]" id="Potencia1"></td>
											<td width="13%">
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
											<td width="13%"><input type="text" class="form-control" name="Revoluciones_Por_MinutoInsert[]" id="Revoluciones_Por_Minuto1"></td>
											<td width="13%"><input type="text" class="form-control" name="VaInsert[]" id="Va1"></td>
											<td width="13%"><input type="text" class="form-control" name="VcInsert[]" id="Vc1"></td>
											<td width="13%"><input type="text" class="form-control" name="IaInsert[]" id="Ia1"></td>
											<td width="13%"><input type="text" class="form-control" name="IcInsert[]" id="Ic1"></td>
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
											<label>Style</label>
											<input class="form-control" name="Style" id="Style">
										</div>

										<div class=" col-sm-4">
											<label>Form</label>
											<input class="form-control" name="Form" id="Form">
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