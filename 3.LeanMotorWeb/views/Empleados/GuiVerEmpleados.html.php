<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Empleados - Consultando</b>
		</h4>
	</div>

	<div class="card-body">
		<form method="post" autocomplete="off" action="<?=getUrl("Empleados", "Empleados", "postEditarEmpleado");?>">
			<?php 
				foreach($empleados as $empleado){}
			?>
			
			<div class="container-fluid">
				<div class="align-items-center row">
					<div class="header-blue">
						<label>Datos del Empleado</label>
					</div>

					<div class="col-5">
						<div class="pt-3 pb-3 row">
							<div class="col-12">
								<a href="<?=getUrl("Empleados", "Empleados", "crearEmpleado");?>" class="btn btn-primary" title="Nuevo Empleado"><i class="fa fa-file"></i></a>
								<button type="button" id="ListarEmpleado" data-url="<?=getUrl("Empleados", "Empleados", "modalBuscarEmpleado", false, "ajax");?>" class="btn btn-primary" title="Listar"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="<?=getUrl("Empleados", "Empleados", "informeEmpleados");?>"><button type="button" class="btn btn-primary"  title="Informe Empleados"><i class="fa fa-file-pdf" aria-hidden="true"></i></button></a>
								<button type="button" id="HistCargo" data-url="<?=getUrl("Empleados", "Empleados", "historialCargos", false, "ajax");?>"  data-toggle="modal" data-target="#myModalCargos" class="btn btn-primary" title="Ver Historial de Cargos"><i class="fa fa-file-alt" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
					
					<div class="col-2">
						<div class="row">
							<div class="col-12">
								<?php if($empleado[4]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>
								<font color="<?php echo $Estilo ?>"><?php echo $estado; ?></font>
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
								<input type="text" name="cod_emple" id="cod_emple" class="form-control" value="<?=$empleado[6];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="cedula_emple">Cedúla</label>
							</div>
							<div class="col-9">
								<input type="text" name="cedula_emple_update" id="cedula_emple_update" class="form-control" value="<?=$empleado[0];?>" readonly>
								<input type="hidden" name="cedula_emple" id="cedula_emple" class="form-control" value="<?=$empleado[0];?>">
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="nom_emple">Nombres</label>
							</div>
							<div class="col-9">
								<input type="text" name="nom_emple" id="nom_emple" class="form-control" value="<?=$empleado[1];?>" readonly>
							</div>
						</div>
					</div>

					<div class="p-0 col-3">
						<div class="row">
							<div class="col-3">
								<label for="apell_emple">Apellidos</label>
							</div>
							<div class="col-9">
								<input type="text" name="apell_emple" id="apell_emple" class="form-control" value="<?=$empleado[2];?>" readonly>
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
								<input type="text" name="dir_emple" id="dir_emple" class="form-control" value="<?=$empleado[3];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="tel1">Teléfono1</label>
							</div>
							<div class="col-9">
								<input type="text" name="tel1" id="tel1" class="form-control" value="<?=$empleado[13];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="tel2">Teléfono2</label>
							</div>
							<div class="col-9">
								<input type="text" name="tel2" id="tel2" class="form-control" value="<?=$empleado[14];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="mail_emple">Email</label>
							</div>
							<div class="p-0 col-9">
								<input type="text" name="mail_emple" id="mail_emple" class="form-control" value="<?=$empleado[20];?>" readonly>
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
								<input type="text" name="fnacimiento" id="fnacimiento" class="form-control" placeholder="dd-mm-aaaa" value="<?=substr($empleado[5], 0,10); ?>" style="font-size: 17px;" readonly>
							</div>
						</div>
					</div>

					<div class="p-0 col-3">
						<div class="row">
							<div class="col-4">
								<label for="lugarn">Lugar de Nacimiento</label>
							</div>
							<div class="pl-1 col-8">
								<select name="lugarn" id="lugarn" class="form-control" disabled>
									<option value="">Seleccione ...</option>
									<?php foreach ($ciudades as $ciudad): ?>
									<?php if ($empleado[19]==$ciudad[0]): ?>
									<option value="<?=$ciudad[0];?>" selected><?=$ciudad[1];?></option>
									<?php else: ?>
									<option value="<?=$ciudad[0];?>"><?=$ciudad[1];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<select name="ciudad" id="ciudad" class="form-control" disabled>
									<option value="">Seleccione ...</option>
									<?php foreach ($ciudades as $ciudad): ?>
									<?php if ($empleado[18]==$ciudad[0]): ?>
									<option value="<?=$ciudad[0];?>" selected><?=$ciudad[1];?></option>
									<?php else: ?>
									<option value="<?=$ciudad[0];?>"><?=$ciudad[1];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<input type="number" name="salario_emple" id="salario_emple" class="form-control" value="<?=$empleado[10];?>" readonly>
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
								<select name="cargo_emple" id="cargo_emple" class="form-control" disabled>
									<option value="">Seleccione ...</option>
									<?php foreach ($cargos as $cargo): ?>
									<?php if ($empleado[8]==$cargo[0]): ?>
									<option value="<?=$cargo[0];?>" selected><?=$cargo[1];?></option>
									<?php else: ?>
									<option value="<?=$cargo[0];?>"><?=$cargo[1];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<select name="centroCosto" id="centroCosto" class="form-control" disabled>
									<option value="">Seleccione ...</option>
									<?php foreach ($costos as $costo): ?>
									<?php if ($empleado[7]==$costo[0]): ?>
									<option value="<?=$costo[0];?>" selected><?=$costo[1];?></option>
									<?php else: ?>
									<option value="<?=$costo[0];?>"><?=$costo[1];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<select name="psig" id="psig" class="form-control" disabled>
									<option value="">Seleccione ...</option>
									<?php foreach ($procesosig as $sig): ?>
									<?php if ($empleado[16]==$sig[0]): ?>
									<option value="<?=$sig[0];?>" selected><?=$sig[1];?></option>
									<?php else: ?>
									<option value="<?=$sig[0];?>"><?=$sig[1];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<input type="text" name="fingreso" id="fingreso" class="form-control" placeholder="dd-mm-aaaa" value="<?=substr($empleado[12], 0,10); ?>" style="font-size: 17px;" readonly>
							</div>
						</div>
					</div>

					<div class="p-0 col-4">
						<div class="row">
							<div class="col-3">
								<label for="tvincula">Tipo Vinculación</label>
							</div>
							<div class="col-8">
								<select name="tvincula" id="tvincula" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "Alternativa Empresarial", "Externa", "Laboratorio Tecno Electrico",
											"Remel y Lte S.A.S"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($empleado[15] == $valor): ?>
									<option value="<?=$empleado[15]; ?>" selected><?=$empleado[15]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>


					<div class="p-0 col-2">
						<div class="row">
							<div class="col-1">
								<?php if ($empleado[17] == "S"): ?>
								<input class="form-control" name="firmaInfoTec" id="firmaInfoTec" class="form-control" type="checkbox" style="width: 20px; margin: -5px" disabled checked>
								<?php else: ?>
								<input class="form-control" name="firmaInfoTec" id="firmaInfoTec" class="form-control" type="checkbox" style="width: 20px; margin: -5px"disabled>
								<?php endif; ?>
							</div>
							<div class="col-9">
								<label for="firmaInfoTec">Firma&nbsp;informe&nbsp;técnico</label>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
						<?php if ($usua_perfil == 1): ?>
						<div class="col-2">
							<label for="sede_nombre">Sede</label>
						</div>
						<div class="col-10">
							<?php foreach ($sedes as $sede): ?>
								<input type="text" id="sede_nombre" name="sede_nombre" class="form-control" readonly value="<?=$sede[1]; ?>">
								<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$empleado[21];?>">
							<?php endforeach;?>
						</div>
						<?php else: ?>
							<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$empleado[21];?>">
						<?php endif;?>
						</div>
					</div>

				</div>

				<div id="detalleEmpl"></div>

			</div>
		</form>
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

<!-- Modal RETIRO EMPLEADO-->
<div id="myModalRetiro" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%">
		<!-- Modal content-->
		<div class="modal-content" id="restiroEmpleado">
			
		</div>
	</div>
</div>

<!-- Modal AUMENTO SALARIO-->
<div id="myModalSalario" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%">
		<!-- Modal content-->
		<div class="modal-content" id="salarioEmpleado">
			
		</div>
	</div>
</div>

<!-- Modal HISTORIA CARGOS-->
<div id="myModalCargos" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%">
		<!-- Modal content-->
		<div class="modal-content" id="cargos">
			
		</div>
	</div>
</div>