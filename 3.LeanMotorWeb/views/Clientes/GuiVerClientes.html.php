<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">                         
		<h4><b>Clientes - Consultando</b></h4>
	</div>
	<div class="card-body" id="divclientes">
		<form id="formViewCliente" autocomplete='off'>
			<?php 
				foreach($clientes as $cliente){}
			?>
			<div class="container-fluid">
				<div class="align-items-center row">
					<div class="header-blue">
						<label>Datos del Cliente</label>
					</div>
					
					<div class="col-5">
						<div class="pt-3 pb-3 row">
							<div class="col-5">
								<a href="<?=getUrl("Clientes", "Clientes", "crearCliente"); ?>" class="btn btn-primary" title="Nuevo Cliente"><span class="fa fa-file"></span></a>
								<button type="button" type-of-view="ver" id="btnListarPlantas" data-url="<?=getUrl("Clientes", "Clientes", "ListarPlanta", false, "ajax"); ?>" class="btn btn-primary" title="Listar Planta" data-toggle="modal" data-target="#modalListarPlantas"><i class="fa fa-industry" aria-hidden="true"></i></button>
								<button type="button" id="ListarCliente" data-url="<?=getUrl("Clientes", "Clientes", "modalBuscarCliente", false, "ajax");?>" class="btn btn-primary" title="Listar"><i class="fa fa-search" aria-hidden="true"></i></button>
							</div>
							<div class="col-3">
								<?php if($cliente[20]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>
								<font color="<?php echo $Estilo ?>"><?php echo $estado; ?></font>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
						<?php if ($usua_perfil == 1): ?>
						<div class="col-3">
							<label for="sede_nombre">Sede</label>
						</div>
						<div class="col-9">
							<?php foreach ($sedes as $sede): ?>
								<input type="text" id="sede_nombre" name="sede_nombre" class="form-control" readonly value="<?=$sede[1]; ?>">
								<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$cliente[18];?>">
							<?php endforeach;?>
						</div>
						<?php else: ?>
							<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$cliente[18];?>">
						<?php endif;?>
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
								<input type="text" name="nit" id="nit" class="form-control" required value="<?=$cliente[7];?>" readonly>
								<input type="hidden" name="nit_cliente" id="nit_cliente" class="form-control" value="<?=$cliente[7];?>">
							</div>
						</div>
					</div>

					<div class="col-8">
						<div class="row">
							<div class="col-2">
								<label for="razon_social">Razón Social</label>
							</div>
							<div class="col-10">
								<input type="text" name="razon_social" id="razon_social" class="form-control" value="<?=$cliente[11];?>" readonly>
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
								<select name="pais" id="pais" class="form-control" data-url="<?=getUrl("Clientes", "Clientes", "ListarDepto", false,"ajax") ?>" disabled>
									<option value=""></option>
									<?php foreach ($paises as $pais): ?>
									<?php if ($cliente[15]==$pais[1]): ?>
									<option value="<?=$pais[1];?>" selected><?=$pais[0];?></option>
									<?php else: ?>
									<option value="<?=$pais[1];?>"><?=$pais[0];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<select name="depto" id="depto" class="form-control select2" data-url="<?=getUrl("Clientes", "Clientes", "ListarCiudad", false,"ajax") ?>" disabled>
									<option value=""></option>
									<?php foreach ($deptos as $depto): ?>
									<?php if ($cliente[16]==$depto[1]): ?>
									<option value="<?=$depto[1];?>" selected><?=$depto[2];?></option>
									<?php else: ?>
									<option value="<?=$depto[1];?>"><?=$depto[2];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<select name="ciudad" id="ciudad" class="form-control select2" disabled>
									<option value=""></option>
									<?php foreach ($ciudades as $ciudad): ?>
									<?php if ($cliente[10]==$ciudad[0]): ?>
									<option value="<?=$ciudad[0];?>" selected><?=$ciudad[1];?></option>
									<?php else: ?>
									<option value="<?=$ciudad[0];?>"><?=$ciudad[1];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<select name="zona" id="zona" class="form-control" disabled>
									<option value=""></option>
									<?php foreach ($zonas as $zona): ?>
									<?php if ($cliente[14]==$zona[0]): ?>
									<option value="<?=$zona[0];?>" selected><?=$zona[1];?></option>
									<?php else: ?>
									<option value="<?=$zona[0];?>"><?=$zona[1];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<input type="text" name="direccion" id="direccion" class="form-control" value="<?=$cliente[3];?>" readonly>
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
								<input type="number" name="tel1" id="tel1" class="form-control" value="<?=$cliente[12];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="tel2">Teléfono2</label>
							</div>
							<div class="col-8">
								<input type="number" name="tel2" id="tel2" class="form-control" value="<?=$cliente[13];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-2">
								<label for="email">Email</label>
							</div>
							<div class="col-10">
								<input type="email" name="email" id="email" class="form-control" value="<?=$cliente[4];?>" readonly>
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
								<input type="text" name="contac" id="contac" class="form-control" value="<?=$cliente[17];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="formaPago">Forma&nbsp;Pago</label>
							</div>
							<div class="col-8">
								<select name="formaPago" id="formaPago" class="form-control" readonly>
									<option value=""></option>
									<?php foreach ($forma_pago as $formaPago): ?>
									<?php if ($cliente[6]==$formaPago[1]): ?>
									<option value="<?=$formaPago[1];?>" selected><?=$formaPago[0];?></option>
									<?php else: ?>
									<option value="<?=$formaPago[1];?>"><?=$formaPago[0];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
								<input type="text" name="plazo" id="plazo" class="form-control" value="<?=$cliente[2];?>" readonly>
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
									<label for="empleado">Vendedor Asignado</label>
								</div>
								<div class="col-8">
									<select name="empleado" id="empleado" class="form-control" disabled>
										<option value=""></option>
										<?php foreach ($empleados as $empleado): ?>
										<?php if ($cliente[0]==$empleado[0]): ?>
										<option value="<?=$empleado[0];?>" selected><?=$empleado[1];?></option>
										<?php else: ?>
										<option value="<?=$empleado[0];?>"><?=$empleado[1];?></option>
										<?php endif; ?>
										<?php endforeach; ?>
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

<div id="divplantas" style="display: none;">
	<div class="container-fluid">
		<div class="row">
			<div class="header-blue">
				<label>Datos Plantas</label>
			</div>

			<div class="col-4">
				<div class="pt-3 pb-3 row">
					<div class="col-12">
						<button type="button" class="btn btn-primary fa fa-reply" id="AtrasPlanta" title="Atrás">
							<span>Atrás</span>
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="table-responsive-lg">
					<table id="tablaListarPlantas" class="table table-bordered table-hover">
					
						<thead class="text-white bg-primary thead-primary">
							<tr>
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Ver</th>
								<th>Contactos</th>
								<th>Vendedores</th>
							</tr>
						</thead>

						<tbody></tbody>

					</table>
				</div>
			</div>
		</div>

		<!-- Modal VER PLANTA -->
		<div class="modal fade" id="modalVerPlanta" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form id="formViewPlanta">
						
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<label class="header-blue">Ver Planta</label>
	
									<div class="col-12">
										<div class="pt-2 pb-2 row">
											<div class="col-1">
												<label for="nom_planta_update">Nombre</label>
											</div>
											<div class="col-11">
												<input type="text" id="nom_planta_update" class="form-control" readonly>
											</div>
										</div>
									</div>
	
									<div class="col-12">
										<div class="border-top pt-2 pb-2 row">
											<div class="col-1">
												<label for="dir_planta_update">Dirección</label>
											</div>
											<div class="col-11">
												<input type="text" id="dir_planta_update" class="form-control" readonly>
											</div>
										</div>
									</div>
	
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal" title="Cerrar">Cerrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>

	</div>
</div>




<div id="divcontactos" style="display: none;">
	<div class="container-fluid">
		<div class="row">
			<div class="header-blue">
				<label>Datos Contactos</label>
			</div>

			<div class="col-4">
				<div class="pt-3 pb-3 row">
					<div class="col-12">
						<button type="button" class="btn btn-primary fa fa-reply" id="AtrasContacto" title="Atrás">
							<span>Atrás</span>
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="table-responsive-lg">
					<table id="tablaListarContactos" class="table table-bordered table-hover">
					
						<thead class="text-white bg-primary thead-primary">
							<tr>
								<th>Nombre</th>
								<th>Email</th>
								<th>Teléfono</th>
								<th>Ver</th>
							</tr>
						</thead>

						<tbody></tbody>

					</table>
				</div>
			</div>
		</div>
	</div>

		<!-- Modal VER CONTACTO -->
		<div class="modal fade" id="modalVerContacto" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form id="formvViewContacto">
						
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<label class="header-blue">Ver Contacto</label>
	
									<div class="col-12">
										<div class="pt-2 pb-2 row">
											<div class="col-1">
												<label for="nom_contacto_update">Nombre</label>
											</div>
											<div class="col-11">
												<input type="text" name="nom_contacto" id="nom_contacto_update" class="form-control" readonly>
											</div>
										</div>
									</div>
	
									<div class="col-12">
										<div class="border-top pt-2 pb-2 row">
											<div class="col-6">
												<div class="row">
													<div class="col-2">
														<label for="tel_contacto_update">Teléfono</label>
													</div>
													<div class="col-10">
														<input type="text" name="tel_contacto" id="tel_contacto_update" class="form-control" readonly>
													</div>
												</div>
											</div>

											<div class="col-6">
												<div class="row">
													<div class="col-2">
														<label for="email_contacto_update">Email</label>
													</div>
													<div class="col-10">
														<input type="text" name="email_contacto" id="email_contacto_update" class="form-control" readonly>
													</div>
												</div>
											</div>
										</div>
									</div>

							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal" title="Cerrar">Cerrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>

	</div>
</div>


<!-- VENDEDORES -->
<div id="divvendedores" style="display: none;">
	<div class="container-fluid">
		<div class="row">
			<div class="header-blue">
				<label>Datos Vendedores</label>
			</div>

			<div class="col-4">
				<div class="pt-3 pb-3 row">
					<div class="col-12">
						<button type="button" class="btn btn-primary fa fa-reply" id="AtrasVendedor" title="Atrás">
							<span>Atrás</span>
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="table-responsive-lg">
					<table id="tablaListarVendedor" class="table table-bordered table-hover">
					
						<thead class="text-white bg-primary thead-primary">
							<tr>
								<th>Código Planta</th>
								<th>Nombre</th>
								<th>Cédula</th>
							</tr>
						</thead>

						<tbody></tbody>

					</table>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- FIN VENDEDORES -->