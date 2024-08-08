<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">                         
		<h4><b>Clientes</b></h4>
	</div>
	<div class="card-body" id='divcliente'>
		<form id="formCliente" method="post" action="<?=getUrl("Clientes", "Clientes", "postCrearCliente"); ?>" autocomplete='off'>
			<div class="container-fluid">
				<div class="row">
					<div class="header-blue">
						<label>Datos del Cliente</label>
					</div>

					<div class="col-5">
						<div class="pt-3 pb-3 row">
							<div class="col-12">
								<a href="<?=getUrl("Clientes", "Clientes", "crearCliente"); ?>" class="btn btn-primary" title="Nuevo Cliente"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearCliente" name="CrearCliente"  class="btn btn-primary" title="Guardar Cliente"><i class="fa fa-save" aria-hidden="true"></i></button>
								<button type="button" id="ListarCliente" data-url="<?=getUrl("Clientes", "Clientes", "modalBuscarCliente", false, "ajax");?>" class="btn btn-primary" title="Listar"><i class="fa fa-search" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="nit_sede">Sede</label>
							</div>
							<div class="col-9">
								<select name="nit_sede" id="nit_sede" class="form-control" required>
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

				<div class="border-top pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="nit">Nit</label>
							</div>
							<div class="col-9">
								<input type="text" name="nit" id="nit_clientes" data-url="<?=getUrl("Clientes", "Clientes", "validarNit", false, "ajax");?>" class="form-control validarNit" required>
							</div>
						</div>
					</div>

					<div class="col-8">
						<div class="row">
							<div class="col-2">
								<label for="razon_social">Razón Social</label>
							</div>
							<div class="col-10">
								<input type="text" name="razon_social" id="razon_social" class="form-control" required>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="pais">País</label>
							</div>
							<div class="col-9">
								<select name="pais" id="pais" class="form-control" data-url="<?=getUrl("Clientes", "Clientes", "ListarDepto", false,"ajax") ?>" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($paises as $pais): ?>
									<?php if ($pais[0] == "Colombia"): ?>
									<option value="<?=$pais[1];?>" selected><?=$pais[0];?></option>
									<?php else: ?>
									<option value="<?=$pais[1];?>"><?=$pais[0];?></option>
									<?php endif; ?>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="depto">Departamento</label>
							</div>
							<div class="col-8">
								<select name="depto" id="depto" class="form-control select2" data-url="<?=getUrl("Clientes", "Clientes", "ListarCiudad", false,"ajax") ?>" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($deptos as $depto): ?>
										<option value="<?=$depto[1];?>"><?=$depto[2];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="ciudad">Ciudad</label>
							</div>
							<div class="col-8">
								<select name="ciudad" id="ciudad" class="form-control select2" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($ciudades as $ciudad): ?>
										<option value="<?=$ciudad[0];?>"><?=$ciudad[1];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="zona">Zona</label>
							</div>
							<div class="col-9">
								<select name="zona" id="zona" class="form-control" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($zonas as $zona): ?>
										<option value="<?=$zona[0];?>"><?=$zona[1];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-8">
						<div class="row">
							<div class="col-2">
								<label for="direccion">Dirección</label>
							</div>
							<div class="col-10">
								<input type="text" name="direccion" id="direccion" class="form-control" required>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="tel1">Teléfono1</label>
							</div>
							<div class="col-9">
								<input type="text" name="tel1" id="tel1" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="tel2">Teléfono2</label>
							</div>
							<div class="col-8">
								<input type="text" name="tel2" id="tel2" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-2">
								<label for="email">Email</label>
							</div>
							<div class="col-10">
								<input type="email" name="email" id="email" class="form-control" required>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-6">
						<div class="row">
							<div class="col-2">
								<label for="contac">Contacto</label>
							</div>
							<div class="col-10">
								<input type="text" name="contac" id="contac" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="formaPago">Forma&nbsp;Pago</label>
							</div>
							<div class="col-8">
								<select name="formaPago" id="formaPago" class="form-control" required>
								<option value="">Seleccione ...</option>
									<?php foreach ($forma_pago as $formaPago): ?>
										<option value="<?=$formaPago[1];?>"><?=$formaPago[0];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="col-3">
								<label for="plazo">Plazo</label>
							</div>
							<div class="col-6">
								<input type="text" name="plazo" id="plazo" class="form-control" required>
							</div>
							<div class="p-0 col-3">
								<label>Días</label>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
						<div class="col-6">
							<div class="row">
								<div class="col-4">
									<label for="vendedor">Vendedor Asignado</label>
								</div>
								<div class="col-8">
									<select name="empleado" id="vendedor" class="form-control" data-url="<?=getUrl("Utilidades", "Utilidades", "buscarVendedorSede", false, "ajax");  ?>" required>
										<option value="">Seleccione ...</option>
									</select>
								</div>
							</div>
						</div>
					</div>

			</div>
		</form>
	</div>
</div>

<!-- Modal BUSCAR CLIENTE-->
<div class="modal fade" id="modalBuscarClientes">
	<div class="modal-dialog modal-lg" role="document" style="max-width: 80%;">
		<div class="modal-content">

			<div class="text-center modal-header">
				<h3 class="w-100 modal-title">Búsqueda de Clientes</h3>
				<button type="button" class="close" data-dismiss="modal" title="Cerrar">
					<i class="fa fa-window-close fa-2x text-danger"></i>
				</button>
			</div>

			<div class="modal-body">

			</div>

		</div>
	</div>
</div>