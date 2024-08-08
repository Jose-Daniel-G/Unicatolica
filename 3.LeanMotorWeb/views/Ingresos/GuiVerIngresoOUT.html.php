<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso de Outsourcing - Consultando</b>
		</h4>
	</div>

	<div class="card-body">
		<form method="post" autocomplete="off" action="">
			
			<?php 
				foreach($IngresoEqui as $Ingreso){}
				foreach($Equipo as $equi){}
				foreach($Clase_Equipos as $Clase_equipos){}
				foreach($Codigo_grupo as $codigo_grupo){}
			?>

			<input type="hidden" id="Numero_Ingreso" value="<?=$Ingreso["Numero_Ingreso"];?>">

			<?php if($Ingreso["Estado"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

			<div class="container-fluid">
				<!-- CONTAINER -->
				<div class="pb-3 row">
					<div class="col-5">
						<div class="row">
							<div class="col-8">
								<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearOT" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso OT"><i class="fa fa-file"></i></a>
		                        
		                        <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarIngresos" data-url='<?=getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax")  ?>' id="btnBuscarIngresos" value="Buscar" title="Buscar Ingresos"><i class="fa fa-search"></i></button>
		                        
								<button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosIngreso" title="Ver Datos Adicionales" data-url='<?=getUrl("Ingresos", "Ingresos", "VerDatosAdicionales", false, "ajax") ?>' id="VerDatosIngreso" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>
								
		                        <button type="button" class="btn text-white" style="background-color: DarkViolet;" id="btn_datos_ElecEquiOT" title="Datos eléctricos" data-toggle="modal" data-target="#ModalEquipoOT"><i class="fa fa-bolt"></i></button>
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
								<label for="nit_sede">Sede</label>
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

					<div class="col-4">
						<div class="row">
							<div class="col-5">
								<label for="Codigo_Tipo_Equipo">Tipo de Equipo</label>
							</div>
							<div class="col-7">
								<select class="form-control" id="Codigo_Tipo_Equipo" name="Codigo_Tipo_Equipo"
								data-url="<?=geturl("Ingresos","Ingresos", "BuscarClaseEquipo", false, "ajax"); ?>" disabled>
									<option value=""></option>
									<?php foreach ($Tipo_Equipos as $Tipo_equipos): ?>
									<?php if ($Codigo_grupo[0]["Codigo_Grupo"]==$Tipo_equipos["Codigo_Grupo"]): ?>
									<option value="<?=$Tipo_equipos["Codigo_Grupo"];?>" selected><?=$Tipo_equipos["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$Tipo_equipos["Codigo_Grupo"];?>"><?=$Tipo_equipos["Descripcion"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
							<div class="col-5">
								<label for="Codigo_Actividad_Produccion">Servicio de Outsourcing</label>
							</div>
							<div class="col-7">
								<select class="form-control" id="Codigo_Actividad_Produccion" name="Codigo_Actividad_Produccion" disabled>
									<option value=""></option>
									<?php foreach ($Servicios as $servicios): ?>
									<?php if ($Ingreso["Codigo_Actividad_Produccion"] == $servicios["Codigo"]): ?>
									<option value="<?=$servicios["Codigo"];?>" selected><?=$servicios["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$servicios["Codigo"];?>"><?=$servicios["Descripcion"];?></option>
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
					<div class="col-2">
						<div class="row">
							<div class="col-5">
								<label for="no_fases">Fases</label>
							</div>
							<div class="p-0 col-5">
								<input class="form-control" name="no_fases" id="no_fases" value="<?=$equi["No_Fases"];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="validNumeroSerie">N°&nbsp;Serie</label>
							</div>
							<div class="col-8">
								<input class="form-control" name="Numero_Serie" id="validNumeroSerie" value="<?=$Ingreso["Numero_Serie"];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-2">
								<label for="Codigo_Marca">Marca</label>
							</div>
							<div class="col-9">
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
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Otros" type="radio" value="Otros" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Otros" type="radio" value="Otros" disabled>
								<?php endif; ?>
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
						<label for="Codigo_Tipo_Equipo_Out">Clase de Equipo</label>
						<select class="form-control" id="Codigo_Tipo_Equipo_Out" name="Codigo_Tipo_Equipo_Out" disabled>
							<option value=""></option>
							<?php foreach ($Clase_Equipos as $Clase_equipos): ?>
							<?php if ($Ingreso["Codigo_Tipo_Equipo_Out"] == $Clase_equipos["Codigo_Tipo_Equipo"]): ?>
							<option value="<?=$Clase_equipos["Codigo_Tipo_Equipo"];?>" selected><?=$Clase_equipos["Descripcion"];?></option>
							<?php else: ?>
							<option value="<?=$Clase_equipos["Codigo_Tipo_Equipo"];?>"><?=$Clase_equipos["Descripcion"];?></option>
							<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-3">
						<label for="Codigo_Aplicacion_Out">Aplicación</label>
						<select class="form-control" id="Codigo_Aplicacion_Out" name="Codigo_Aplicacion_Out" disabled>
							<option value=""></option>
							<?php foreach ($Aplicacion as $aplicacion): ?>
							<?php if ($Ingreso["Codigo_Aplicacion_Out"] == $aplicacion["Codigo"]): ?>
							<option value="<?=$aplicacion["Codigo"];?>" selected><?=$aplicacion["Descripcion"];?></option>
							<?php else: ?>
							<option value="<?=$aplicacion["Codigo"];?>"><?=$aplicacion["Descripcion"];?></option>
							<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-3">
						<label for="Codigo_Tipo_Arranque_Out">Tipo de Arranque</label>
						<select class="form-control" id="Codigo_Tipo_Arranque_Out" name="Codigo_Tipo_Arranque_Out" disabled>
							<option value=""></option>
							<?php foreach ($Arranque as $arranque): ?>
							<?php if ($Ingreso["Codigo_Tipo_Arranque_Out"] == $arranque["Codigo"]): ?>
							<option value="<?=$arranque["Codigo"];?>" selected><?=$arranque["Descripcion"];?></option>
							<?php else: ?>
							<option value="<?=$arranque["Codigo"];?>"><?=$arranque["Descripcion"];?></option>
							<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-3">
						<label for="Codigo_Acoplamiento_Out">Acoplamiento Correcto</label>
						<select class="form-control" id="Codigo_Acoplamiento_Out" name="Codigo_Acoplamiento_Out" disabled>
							<option value=""></option>
							<?php foreach ($Acoplamiento as $acoplamiento): ?>
							<?php if ($Ingreso["Codigo_Acoplamiento_Out"] == $acoplamiento["Codigo"]): ?>
							<option value="<?=$acoplamiento["Codigo"];?>" selected><?=$acoplamiento["Descripcion"];?></option>
							<?php else: ?>
							<option value="<?=$acoplamiento["Codigo"];?>"><?=$acoplamiento["Descripcion"];?></option>
							<?php endif; ?>
							<?php endforeach; ?>
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
								<input class="form-control" type="text" name="Requisitos_Cliente" id="Requisitos_Cliente" value="<?=$Ingreso["Requisitos_Cliente"]; ?>" readonly>
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
									<option value=""></option>
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


			<!-- Modal Datos Eléctricos OT -->
			<div class="modal fade" id="ModalEquipoOT" role="dialog">

				<div class="modal-dialog modal-lg" role="document">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Datos eléctricos OT</h4>
						</div>
						<div class="modal-body">
							<div id="datosElectOT">
									<table class="table table-borderless table-hover">
										<tr>
											<th>Potencia</th>
											<th>Unidad</th>
											<th>R.P.M.</th>
											<th>VA</th>
											<th>VC</th>
											<th>IA</th>
											<th>IC</th>
										</tr>
										<?php $cont=1; ?>

										<tbody id="tbody_datosElectricosOT">
										
										<?php if ($Detalle != null): ?>
											<?php foreach ($Detalle as $deta): ?>
											<tr class="datosElectricos type-number">
												<td width="13%">
													<input type="text" class="form-control" name="PotenciaEditar[]" id="Potencia<?=$cont; ?>" value="<?=$deta["Potencia"]; ?>" readonly></td>
												<td width="13%">
													<select class="form-control" id="Unidad_De_Potencia<?=$cont; ?>" name="Unidad_De_PotenciaEditar[]" disabled>
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
													<input type="text" class="form-control" name="Revoluciones_Por_MinutoEditar[]" id="Revoluciones_Por_Minuto<?=$cont; ?>"value="<?=$deta["Revoluciones_Por_Minuto"]; ?>" readonly>
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="VaEditar[]" id="Va<?=$cont; ?>"value="<?=$deta["Va"]; ?>" readonly>
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="VcEditar[]" id="Vc<?=$cont; ?>"value="<?=$deta["Vc"]; ?>" readonly>
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="IaEditar[]" id="Ia<?=$cont; ?>" value="<?=$deta["Ia"]; ?>" readonly>
												</td>
												<td width="13%">
													<input type="text" class="form-control" name="IcEditar[]" id="Ic<?=$cont; ?>" value="<?=$deta["Ic"]; ?>" readonly>
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
												<input class="form-control" name="Frame" id="Frame" value="<?=$deta2["Frame"]; ?>" readonly>
											</div>

											<div class=" col-sm-4">
												<label>Tipo</label>
												<input class="form-control" name="Tipo" id="Tipo" value="<?=$deta2["Tipo"]; ?>" readonly>
											</div>

											<div class="col-sm-4">
												<label>Mod</label>
												<input class="form-control" name="Mod" id="Mod" value="<?=$deta2["Modulo"]; ?>" readonly>
											</div>
										</div>

										<div class="row">
											<div class=" col-sm-4">
												<label>Style</label>
												<input class="form-control" name="Style" id="Style" value="<?=$deta2["Style"]; ?>" readonly>
											</div>

											<div class=" col-sm-4">
												<label>Form</label>
												<input class="form-control" name="Form" id="Form" value="<?=$deta2["Form"]; ?>" readonly>
											</div>

											<div class=" col-sm-4">
												<label>Frecuencia Hz</label>
												<input class="form-control" name="Frecuencia" id="Frecuencia" value="<?=$deta2["Frecuencia"]; ?>" readonly>
											</div>
										</div>

										<div class="row">
											<div class="col-12">
												<div class="row">
													<div class=" col-sm-4">
														<label>Conexion</label>
														<select class="form-control" id="Conexion" name="Conexion" disabled>
															<?php
															$options = array(
																"valor" => "", "Y/2Y", "D/Y", "D/2D", "Y", 
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
														<select class="form-control" id="Fs" name="Fs" disabled>
															<?php
															$options = array(
																"valor" => "", "1.0", "1.05", "1.10", "1.15", 
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
														<select class="form-control" id="Encl" name="Encl" disabled>
															<?php
															$options = array(
																"valor" => "", "TEFC", "ODP", "EXP", "PROOF", 
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
														<select class="form-control" id="Ip" name="Ip" disabled>
															<?php
															$options = array(
																"valor" => "", "68", "56", "55", "54", 
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
														<select class="form-control" id="Insul_Cls" name="Insul_Cls" disabled>
															<?php
															$options = array(
																"valor" => "", "B", "F", "H", "Inverter Duty"
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

													<div class=" col-sm-4">
														<label>Rotor</label>
														<select class="form-control" id="RotorDetalle" name="RotorDetalle" disabled>
															<?php
															$options = array(
																"valor" => "", "Jaula de Ardilla", "Devanado",
															);
															?>
															<?php foreach ($options as $valor): ?>
															<?php if($deta2["Rotor"] == $valor): ?>
																<option value="<?=$deta2["Rotor"];?>" selected><?=$deta2["Rotor"];?></option>
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