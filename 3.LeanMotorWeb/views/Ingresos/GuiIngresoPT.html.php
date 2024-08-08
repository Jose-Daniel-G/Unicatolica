<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso de Partes FA-06</b>
		</h4>
	</div>

	<div class="card-body">
		<form method="post" autocomplete="off" action="<?=getUrl("Ingresos", "Ingresos", "PostCrearPT"); ?>">

			<div class="container-fluid"> <!-- CONTAINER -->
				<div class="pb-3 row">
					<div class="col-3">
						<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearPT" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso PT"><i class="fa fa-file"></i></a>

						<button type="submit" class="btn btn-primary" name="RegIngresoPT" id="RegIngresoPT" value="Guardar"><i class="fa fa-save"></i></button>

						<button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarIngresos" data-url='<?=getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax"); ?>' id="btnBuscarIngresos" value="Buscar"><i class="fa fa-search"></i></button>
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

							<div class="col-9">
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

					<div class="col-3">
						<div class="row">
							<div class="col-5">
								<label for="cif">Tamaño&nbsp;CIF</label>
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
								data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax"); ?>">
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
							<div class="col-2">
								<label for="Codigo_Tipo_Equipo">Artículo&nbsp;*</label>
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

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="validNumeroSerie">N°&nbsp;Serie&nbsp;*</label>
							</div>
							<div class="p-0 col-8">
								<input class="form-control" name="Numero_SeriePT" id="validNumeroSerie" data-url="<?=getUrl("Ingresos", "Ingresos", "ValidarNumeroSerie", false, "ajax"); ?>" required>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="Codigo_Marca">Marca&nbsp;*</label>
							</div>
							<div class="p-0 col-9">
								<select class="form-control select2" id="Codigo_Marca" name="Codigo_Marca" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($Marca as $Marcas): ?>
									<option value="<?=$Marcas["Codigo_Marca"];?>"><?=$Marcas["Descripcion"];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="cantidad">Cantidad</label>
							</div>
							<div class="col-8">
								<input class="form-control" name="cantidad" id="cantidad">
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="referencia">Referencia</label>
							</div>
							<div class="p-0 col-9">
								<input class="form-control" name="referencia" id="referencia">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="tipo">Tipo</label>
							</div>
							<div class="p-0 col-9">
								<input class="form-control" name="tipo" id="tipo">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="modelo">Modelo</label>
							</div>
							<div class="p-0 col-8">
								<input class="form-control" name="modelo" id="modelo">
							</div>
						</div>
					</div>

				</div>

				
				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-5">
						<div class="row">
							<div class="col-3">
								<label for="dimensiones">Dimensiones</label>
							</div>
							<div class="p-0 col-9">
								<input class="form-control" name="dimensiones" id="dimensiones">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="col-5">
								<label for="voltaje">Voltaje</label>
							</div>
							<div class="p-0 col-7">
								<input type="number" class="form-control" name="voltaje" id="voltaje">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="col-6">
								<label for="amperaje">Amperaje</label>
							</div>
							<div class="p-0 col-6">
								<input type="number" class="form-control" name="amperaje" id="amperaje">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="velocidad">Velocidad</label>
							</div>
							<div class="p-0 col-5">
								<input type="number" class="form-control" name="velocidad" id="velocidad">
							</div>
							<div class="col-3">
								<label>Rpm</label>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-8">
						<div class="row">
							<div class="col-2">
								<label for="Ubicacion">Ubicación&nbsp;*</label>
							</div>
							<div class="col-10">
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


				<div class="pt-3 pb-3 row">

					<label class="header-blue">Datos Eléctricos</label>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="potencia">Potencia</label>
							</div>
							<div class="col-9">
								<input type="number" name="potencia" id="potencia" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="unidad">Unidad</label>
							</div>
							<div class="col-8">
								<select name="unidad" id="unidad" class="form-control select2">
									<option value=""></option>
									<option value="HP">HP</option>
									<option value="KW">KW</option>
									<option value="W">W</option>
									<option value="KVA">KVA</option>
									<option value="MVA">MVA</option>
									<option value="VA">VA</option>
									<option value="CV">CV</option>
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
								<input type="number" name="fases" id="fases" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-4">
								<label for="frecuencia">Frecuencia</label>
							</div>
							<div class="col-8">
								<input type="number" name="frecuencia" id="frecuencia" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vp">Vp</label>
							</div>
							<div class="col-7">
								<input type="number" name="vp" id="vp" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vs1">Vs 1</label>
							</div>
							<div class="col-7">
								<input type="number" name="vs1" id="vs1" class="form-control">
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
								<input type="number" name="vs2" id="vs2" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="ip">Ip</label>
							</div>
							<div class="col-9">
								<input type="number" name="ip" id="ip" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="is">Is</label>
							</div>
							<div class="col-9">
								<input type="number" name="is" id="is" class="form-control">
							</div>
						</div>
					</div>


					<div class="col-3">
						<div class="row">
							<div class="p-0 col-5">
								<label for="grupoconex">Grupo Conexión</label>
							</div>
							<div class="col-7">
								<select name="grupoconex" id="grupoconex" class="form-control select2">
									<option value=""></option>
									<option value="Dd0">Dd0</option>
									<option value="Yy0">Yy</option>
									<option value="Dz0">Dz0</option>
									<option value="Dy5">Dy5</option>
									<option value="Yd5">Yy5</option>
									<option value="Yz5">Yz5</option>
									<option value="Dd6">Dd6</option>
									<option value="Yy6">Yy6</option>
									<option value="Dz6">Dz6</option>
									<option value="Dy11">Dy11</option>
									<option value="Yd11">Yd11</option>
									<option value="Yz11">Yz11</option>
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
								<input type="text" name="conexion" id="conexion" class="form-control">
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
								<select name="regulacion" id="regulacion" class="form-control select2">
									<option value=""></option>
									<option value="+/-2 x 2.5%">+/-2 x 2.5%</option>
									<option value="+/-2 x 5%">+/-2 x 5%</option>
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
								<select name="insul" id="insul" class="form-control select2">
									<option value=""></option>
									<option value="B">B</option>
									<option value="F">F</option>
									<option value="H">H</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<label class="header-blue">Observaciones / Accesorios</label>
					<div class="col-12">
						<div class="row">
							<div class="col-12">
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


			</div> <!-- FIN CONTAINER -->
			
		</form>
	</div>
</div>