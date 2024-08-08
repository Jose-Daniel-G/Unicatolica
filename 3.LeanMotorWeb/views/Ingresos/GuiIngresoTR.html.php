<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso de Transformadores FA-06</b>
		</h4>
	</div>

	<div class="card-body">
		<form method="post" autocomplete="off" action="<?=getUrl("Ingresos", "Ingresos", "PostCrearTR"); ?>">

			<div class="container-fluid"> <!-- CONTAINER -->
				<div class="pb-3 row">
					<div class="col-3">
						<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearTR" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso TR"><i class="fa fa-file"></i></a>

						<button type="submit" class="btn btn-primary" name="RegIngresoTR" id="RegIngresoTR" value="Guardar"><i class="fa fa-save"></i></button>

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
								<label for="Codigo_Tipo_Equipo">Equipo&nbsp;*</label>
							</div>
							<div class="col-10">
								<select class="form-control select2" id="Codigo_Tipo_Equipo" name="Codigo_Tipo_Equipo" required>
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
								<input class="form-control" name="Numero_SerieTR" id="validNumeroSerie" data-url="<?=getUrl("Ingresos", "Ingresos", "ValidarNumeroSerie", false, "ajax"); ?>" required>
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
					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="cuba" id="cuba" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="cuba">Cuba</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="aislamientobt" id="aislamientobt" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="aislamientobt">Aislamientos&nbsp;BT</label>
							</div>
							<div class="col-4">
								<input type="number" name="textaislamientobt" id="textaislamientobt" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="tapones" id="tapones" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="tapones">Tapones</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="valvula" id="valvula" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-3">
								<label for="valvula">Valvula</label>
							</div>
							<div class="col-4">
								<input type="number" name="textvalvula" id="textvalvula" class="form-control" style="display: none;">
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
								<input class="form-control" name="tapa" id="tapa" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="tapa">Tapa Cuba</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="empaqueat" id="empaqueat" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="empaqueat">Empaques&nbsp;AT</label>
							</div>
							<div class="col-4">
								<input type="number" name="textempaqueat" id="textempaqueat" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="cancamos" id="cancamos" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="cancamos">Cancamos</label>
							</div>
							<div class="col-4">
								<input type="number" name="textcancamos" id="textcancamos" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="cambiador" id="cambiador" type="checkbox" style="width: 20px; margin: -5px 20px;">
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
								<input class="form-control" name="nucleo" id="nucleo" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="nucleo">Núcleo</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="empaquebt" id="empaquebt" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="empaquebt">Empaques&nbsp;BT</label>
							</div>
							<div class="col-4">
								<input type="number" name="textempaquebt" id="textempaquebt" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="tanqueEx" id="tanqueEx" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="tanqueEx">Tanque de Expansión</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="rele" id="rele" type="checkbox" style="width: 20px; margin: -5px 20px;">
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
								<input class="form-control" name="bobinas" id="bobinas" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="bobinas">Bobinas</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="bornera" id="bornera" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="bornera">Bornera</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="tanqueSi" id="tanqueSi" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="tanqueSi">Tanque Silica</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="cables" id="cables" type="checkbox" style="width: 20px; margin: -5px 20px;">
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
								<input class="form-control" name="aceite" id="aceite" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-3">
								<label for="aceite">Aceite</label>
							</div>
							<div class="col-4">
								<input type="number" name="textaceite" id="textaceite" class="form-control" style="display: none;">
							</div>
							<div class="col-1">
								<label class="font-weight-bold">GI</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="radiadores" id="radiadores" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="radiadores">Radiadores</label>
							</div>
							<div class="col-4">
								<input type="number" name="textradiadores" id="textradiadores" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="visor" id="visor" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="visor">Visor</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="placa" id="placa" type="checkbox" style="width: 20px; margin: -5px 20px;">
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
								<input class="form-control" name="aislamientoat" id="aislamientoat" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="aislamientoat">Aislamientos&nbsp;AT</label>
							</div>
							<div class="col-4">
								<input type="number" name="textaislamientoat" id="textaislamientoat" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="ventiladores" id="ventiladores" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-6">
								<label for="ventiladores">Ventiladores</label>
							</div>
							<div class="col-4">
								<input type="number" name="textventiladores" id="textventiladores" class="form-control" style="display: none;">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<input class="form-control" name="nivelAcite" id="nivelAcite" type="checkbox" style="width: 20px; margin: -5px 20px;">
							</div>
							<div class="col-10">
								<label for="nivelAcite">Indicador Nivel Aceite</label>
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
								<label for="Observaciones">Observaciones</label>
							</div>
							<div class="col-10">
								<textarea name="Observaciones" id="Observaciones" class="form-control" rows="4"></textarea>
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

<script>
function marcar(elemento) {
	checkboxes=document.getElementsByTagName("input"); //obtenemos todos los controles del tipo Input
	for(i=0; i<checkboxes.length; i++) { //recorremos todos los controles
		if(checkboxes[i].type == "checkbox" && checkboxes[i].id != "Urgente") { //solo si es un checkbox entramos y no es el checkbox "Urgente"
			checkboxes[i].checked=elemento.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
		}
	}
	
	if ($("#aislamientobt").is(":checked")) {
		$("#textaislamientobt").css("display", "block");
	}else{
		$("#textaislamientobt").css("display", "none");
	}

	if ($("#valvula").is(":checked")) {
		$("#textvalvula").css("display", "block");
	}else{
		$("#textvalvula").css("display", "none");
	}

	if ($("#empaqueat").is(":checked")) {
		$("#textempaqueat").css("display", "block");
	}else{
		$("#textempaqueat").css("display", "none");
	}

	if ($("#cancamos").is(":checked")) {
		$("#textcancamos").css("display", "block");
	}else{
		$("#textcancamos").css("display", "none");
	}

	if ($("#empaquebt").is(":checked")) {
		$("#textempaquebt").css("display", "block");
	}else{
		$("#textempaquebt").css("display", "none");
	}

	if ($("#aceite").is(":checked")) {
		$("#textaceite").css("display", "block");
	}else{
		$("#textaceite").css("display", "none");
	}

	if ($("#radiadores").is(":checked")) {
		$("#textradiadores").css("display", "block");
	}else{
		$("#textradiadores").css("display", "none");
	}

	if ($("#aislamientoat").is(":checked")) {
		$("#textaislamientoat").css("display", "block");
	}else{
		$("#textaislamientoat").css("display", "none");
	}

	if ($("#ventiladores").is(":checked")) {
		$("#textventiladores").css("display", "block");
	}else{
		$("#textventiladores").css("display", "none");
	}

	if ($("#Otros").is(":checked")) {
		$("#textotros").css("display", "block");
	}else{
		$("#textotros").css("display", "none");
	}
}

$(document).ready(function () {
	$(document).on("click", "#aislamientobt", function () {
		$("#textaislamientobt").toggle();
	});

	$(document).on("click", "#valvula", function () {
		$("#textvalvula").toggle();
	});

	$(document).on("click", "#empaqueat", function () {
		$("#textempaqueat").toggle();
	});
	
	$(document).on("click", "#cancamos", function () {
		$("#textcancamos").toggle();
	});

	$(document).on("click", "#empaquebt", function () {
		$("#textempaquebt").toggle();
	});

	$(document).on("click", "#aceite", function () {
		$("#textaceite").toggle();
	});

	$(document).on("click", "#radiadores", function () {
		$("#textradiadores").toggle();
	});

	$(document).on("click", "#aislamientoat", function () {
		$("#textaislamientoat").toggle();
	});

	$(document).on("click", "#ventiladores", function () {
		$("#textventiladores").toggle();
	});

	$(document).on("click", "#Otros", function () {
		$("#textotros").toggle();
	});
});
</script>