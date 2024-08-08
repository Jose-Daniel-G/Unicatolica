<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Empleados</b>
		</h4>
	</div>

	<div class="card-body" id="divEmpleado">
		<form method="post" autocomplete="off" action="<?=getUrl("Empleados", "Empleados", "postCrearEmpleado");?>">
			<div class="container-fluid">
				<div class="row">
					<div class="header-blue">
						<label>Datos del Empleado</label>
					</div>

					<div class="col-6">
						<div class="pt-3 pb-3 row">
							<div class="col-12">
								<a href="<?=getUrl("Empleados", "Empleados", "crearEmpleado");?>" class="btn btn-primary" title="Nuevo Empleado"><i class="fa fa-file"></i></a>
								<button type="submit" id="CrearEmpleado" name="CrearEmpleado"  class="btn btn-primary" title="Grabar Empleado"><i class="fa fa-save" aria-hidden="true"></i></button>
								<button type="button" id="ListarEmpleado" data-url="<?=getUrl("Empleados", "Empleados", "modalBuscarEmpleado", false, "ajax");?>" class="btn btn-primary" title="Listar"><i class="fa fa-search" aria-hidden="true"></i></button>
								<button type="button" id="informeEmpleados" class="btn btn-primary" title="Informe de Empleados"><i class="fa fa-file-pdf" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="p-0 col-2">
						<div class="row">
							<div class="col-3">
								<label for="cod_emple">Código</label>
							</div>
							<div class="col-9">
								<input type="text" name="cod_emple" id="cod_emple" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="cedula_emple">Cedúla</label>
							</div>
							<div class="col-9">
								<input type="text" name="cedula_emple" id="cedula_emple" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="nom_emple">Nombres</label>
							</div>
							<div class="col-9">
								<input type="text" name="nom_emple" id="nom_emple" class="form-control">
							</div>
						</div>
					</div>

					<div class="p-0 col-3">
						<div class="row">
							<div class="col-3">
								<label for="apell_emple">Apellidos</label>
							</div>
							<div class="col-9">
								<input type="text" name="apell_emple" id="apell_emple" class="form-control">
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="p-0 col-3">
						<div class="row">
							<div class="col-3">
								<label for="dir_emple">Dirección</label>
							</div>
							<div class="col-9">
								<input type="text" name="dir_emple" id="dir_emple" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="tel1">Teléfono1</label>
							</div>
							<div class="col-9">
								<input type="text" name="tel1" id="tel1" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="tel2">Teléfono2</label>
							</div>
							<div class="col-9">
								<input type="text" name="tel2" id="tel2" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="mail_emple">Email</label>
							</div>
							<div class="p-0 col-9">
								<input type="text" name="mail_emple" id="mail_emple" class="form-control">
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="p-0 col-3">
						<div class="row">
							<div class="col-4">
								<label for="fnacimiento">Fecha de Nacimiento</label>
							</div>
							<div class="col-7">
								<input type="text" name="fnacimiento" id="fnacimiento" class="datepicker form-control" placeholder="aaaa-mm-dd" readonly>
							</div>
						</div>
					</div>

					<div class="p-0 col-3">
						<div class="row">
							<div class="col-4">
								<label for="lugarn">Lugar de Nacimiento</label>
							</div>
							<div class="pl-1 col-8">
								<select name="lugarn" id="lugarn" class="form-control select2">
									<option value="">Seleccione ...</option>
									<?php foreach ($ciudades as $ciudad): ?>
										<option value="<?=$ciudad[0];?>"><?=$ciudad[1];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="ciudad">Ciudad de Residencia</label>
							</div>
							<div class="col-8">
								<select name="ciudad" id="ciudad" class="form-control select2">
									<option value="">Seleccione ...</option>
									<?php foreach ($ciudades as $ciudad): ?>
										<option value="<?=$ciudad[0];?>"><?=$ciudad[1];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-5">
								<label for="salario_emple">Salario&nbsp;Básico</label>
							</div>
							<div class="p-0 col-7">
								<input type="number" name="salario_emple" id="salario_emple" class="form-control">
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="p-0 col-4">
						<div class="row">
							<div class="col-2">
								<label for="cargo_emple">Cargo</label>
							</div>
							<div class="col-10">
								<select name="cargo_emple" id="cargo_emple" class="form-control select2">
									<option value="">Seleccione ...</option>
									<?php foreach ($cargos as $cargo): ?>
										<option value="<?=$cargo[0];?>"><?=$cargo[1];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="centroCosto">Centro&nbsp;de&nbsp;Costos</label>
							</div>
							<div class="col-8">
								<select name="centroCosto" id="centroCosto" class="form-control">
									<option value="">Seleccione ...</option>
									<?php foreach ($costos as $costo): ?>
										<option value="<?=$costo[0];?>"><?=$costo[1];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>


					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="psig">Proceso&nbsp;SIG</label>
							</div>
							<div class="col-9">
								<select name="psig" id="psig" class="form-control">
									<option value="">Seleccione ...</option>
									<?php foreach ($procesosig as $sig): ?>
										<option value="<?=$sig[0];?>"><?=$sig[1];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="p-0 col-3">
						<div class="row">
							<div class="col-4">
								<label for="fingreso">Fecha de Ingreso</label>
							</div>
							<div class="col-7">
								<input type="text" name="fingreso" id="fingreso" class="datepicker form-control" placeholder="aaaa-mm-dd" readonly>
							</div>
						</div>
					</div>

					<div class="p-0 col-4">
						<div class="row">
							<div class="col-3">
								<label for="tvincula">Tipo Vinculación</label>
							</div>
							<div class="col-8">
								<select name="tvincula" id="tvincula" class="form-control">
									<option value="">Selecione...</option>
									<option value="Alternativa Empresarial">Alternativa Empresarial</option>
									<option value="Externa">Externa</option>
									<option value="Laboratorio Tecno Electrico">Laboratorio Tecno Electrico</option>
									<option value="Remel y Lte S.A.S">Remel y Lte S.A.S</option>
								</select>
							</div>
						</div>
					</div>


					<div class="p-0 col-2">
						<div class="row">
							<div class="col-1">
								<input class="form-control" name="firmaInfoTec" id="firmaInfoTec" class="form-control" type="checkbox" style="width: 20px; margin: -5px">
							</div>
							<div class="col-9">
								<label for="firmaInfoTec">Firma&nbsp;informe&nbsp;técnico</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-2">
								<label for="nit_sede">Sede</label>
							</div>
							<div class="col-10">
								<select name="nit_sede" id="nit_sede" class="form-control" data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "BuscarConsecutivo", false, "ajax");?>">
									<option value="">Seleccione ...</option>
									<?php if ($usua_perfil == 1): ?>
									<?php foreach ($sedes as $sede): ?>
										<option value="<?=$sede[0];?>"><?=$sede[1];?></option>
									<?php endforeach;?>
									<?php else: ?>
									<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$nit_Empresa_sede;?>">
									<?php endif;?>
								</select>
							</div>
						</div>
					</div>

				</div>

				<div id="detalleEmpl"></div>

			</div>
		</form>
	</div>
</div>

<div class="card-body" id="divInforme" style="display: none;">
		<div class="container-fluid">

			<div class="pb-4 row">
				<div class="col-5">
					<button class="btn btn-primary" id="btnActivos" data-url="<?=getUrl("Empleados", "Empleados", "listarInformeEmpleado", false, "ajax");?>" value="Activos">Activos</button>
					<button class="btn btn-primary" id="btnInactivos" data-url="<?=getUrl("Empleados", "Empleados", "listarInformeEmpleado", false, "ajax");?>" value="Inactivos">Inactivos</button>
					<button class="btn btn-primary" id="btnTodos" data-url="<?=getUrl("Empleados", "Empleados", "listarInformeEmpleado", false, "ajax");?>" value="Todos">Todos</button>
					<button class="btn btn-primary" id="btnArchivoPlano">Archivo Plano</button>
					<button class="btn btn-primary" id="btnCerrar">Cerrar</button>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="table-responsive-lg">
						<table id="tablaInformeEmpleados" class="table-bordered table-hover" style="font-size: 12px;">
						
							<thead class="table text-white bg-primary thead-primary">
								<tr>
								<th>Código</th>
								<th>Cedúla</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Ingreso</th>
								<th>Cargo</th>
								<th>Centro Costo</th>
								<th>Fecha Ult. Aumento</th>
								<th>Salario</th>
								<th>Salario Anterior</th>
								<th>Fecha de Nacimiento</th>
								<th>Dirección</th>
								<th>Teléfono1</th>
								<th>Teléfono2</th>
								<th>Email</th>
								<th>Ciudad de Residencia</th>
								<th>Lugar de Nacimiento</th>
								</tr>
							</thead>

							<tbody></tbody>

						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>

<!-- Modal BUSCAR EMPLEADO-->
<div class="modal fade" id="modalBuscarEmpleados">
	<div class="modal-dialog modal-lg" role="document" style="max-width: 80%;">
		<div class="modal-content">

			<div class="text-center modal-header">
				<h3 class="w-100 modal-title">Búsqueda de Empleados</h3>
				<button type="button" class="close" data-dismiss="modal" title="Cerrar">
					<i class="fa fa-window-close fa-2x text-danger"></i>
				</button>
			</div>

			<div class="modal-body">

			</div>

		</div>
	</div>
</div>

<!----------SELECIONAR TODOS LOS CHECKBOX-------------->
<script type="text/javascript">
	function marcar(elemento) {
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0; i<checkboxes.length; i++) { //recorremos todos los controles
			if(checkboxes[i].type == "checkbox" && checkboxes[i].id != "firmaInfoTec") { //solo si es un checkbox entramos
				checkboxes[i].checked=elemento.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>