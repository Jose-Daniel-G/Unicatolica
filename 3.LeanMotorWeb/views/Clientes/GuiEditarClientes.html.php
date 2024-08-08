<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">                         
		<h4><b>Clientes - Editando</b></h4>
	</div>
	<div class="card-body" id="divclientes">
		<form method="post" action="<?=getUrl("Clientes", "Clientes", "postEditarCliente"); ?>" autocomplete='off'>
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
							<div class="col-7">
								<a href="<?=getUrl("Clientes", "Clientes", "crearCliente"); ?>" class="btn btn-primary" title="Nuevo Cliente"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearCliente" name="CrearCliente"  class="btn btn-primary" title="Guardar Cliente"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" type-of-view="editar" id="btnListarPlantas" data-url="<?=getUrl("Clientes", "Clientes", "ListarPlanta", false, "ajax"); ?>" class="btn btn-primary" title="Listar Planta" data-toggle="modal" data-target="#modalListarPlantas"><i class="fa fa-industry" aria-hidden="true"></i></button>
								<button type="button" id="ListarCliente" data-url="<?=getUrl("Clientes", "Clientes", "modalBuscarCliente", false, "ajax");?>" class="btn btn-primary" title="Listar"><i class="fa fa-search" aria-hidden="true"></i></button>
								<button type="button" id="elimicliente" class="btn btn-primary" title="Borrar Cliente" data-url="<?=getUrl('Clientes','Clientes','getEliminarCli')?>"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>
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
								<input type="text" id="sede_nombre" name="sede_nombre" class="form-control" readonly value="<?=$sede[1]; ?>" required>
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
								<input type="text" name="nit" id="nit" class="form-control" required value="<?=$cliente[7];?>" required>
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
								<input type="text" name="razon_social" id="razon_social" class="form-control" value="<?=$cliente[11];?>" required>
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
								<select name="depto" id="depto" class="form-control select2" data-url="<?=getUrl("Clientes", "Clientes", "ListarCiudad", false,"ajax") ?>" required>
									<option value="">Seleccione ...</option>
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
								<select name="ciudad" id="ciudad" class="form-control select2" required>
									<option value="">Seleccione ...</option>
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
								<select name="zona" id="zona" class="form-control" required>
									<option value="">Seleccione ...</option>
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
								<input type="text" name="direccion" id="direccion" class="form-control" value="<?=$cliente[3];?>" required>
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
								<input type="text" name="tel1" id="tel1" class="form-control" value="<?=$cliente[12];?>" required>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="tel2">Teléfono2</label>
							</div>
							<div class="col-8">
								<input type="text" name="tel2" id="tel2" class="form-control" value="<?=$cliente[13];?>" required>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-2">
								<label for="email">Email</label>
							</div>
							<div class="col-10">
								<input type="email" name="email" id="email" class="form-control" value="<?=$cliente[4];?>" required>
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
								<input type="text" name="contac" id="contac" class="form-control" value="<?=$cliente[17];?>" required>
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
								<input type="text" name="plazo" id="plazo" class="form-control" value="<?=$cliente[2];?>" required>
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
									<select name="empleado" id="empleado" class="form-control" required>
										<option value="">Seleccione ...</option>
										<?php foreach ($empleados as $empleado): ?>
										<?php if ($empleadoCliente[0][0]==$empleado[0]): ?>
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

<!-- PLANTAS -->
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

						<button type="button" class="btn btn-primary fa fa-industry" id="btnModalCrearPlanta" data-toggle="modal" data-target="#modalCrearPlanta" title="Nueva Planta">
							<span>Nueva</span>
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
								<th>Editar</th>
								<th>Eliminar</th>
								<th>Contactos</th>
								<th>Vendedores</th>
							</tr>
						</thead>

						<tbody></tbody>

					</table>
				</div>
			</div>
		</div>

		<!-- Modal CREAR PLANTA -->
		<div class="modal fade" id="modalCrearPlanta" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form id="formPlanta" method="post" action="<?=getUrl("Clientes", "Clientes", "postCrearPlanta", false, "ajax"); ?>" autocomplete="off">
						
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<label class="header-blue">Nueva Planta</label>
	
									<div class="col-12">
										<div class="pt-2 pb-2 row">
											<div class="col-1">
												<label for="nom_planta_insert">Nombre</label>
											</div>
											<div class="col-11">
												<input type="text" name="nom_planta" id="nom_planta_insert" class="form-control">
											</div>
										</div>
									</div>
	
									<div class="col-12">
										<div class="border-top pt-2 pb-2 row">
											<div class="col-1">
												<label for="dir_planta_insert">Dirección</label>
											</div>
											<div class="col-11">
												<input type="text" name="dir_planta" id="dir_planta_insert" class="form-control">
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary fa fa-save" title="Grabar Planta"></button>
							<button type="button" class="btn btn-primary" data-dismiss="modal" title="Cerrar">Cerrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>

		<!-- Modal EDITAR PLANTA -->
		<div class="modal fade" id="modalEditarPlanta" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form id="formEditarPlanta" method="post" action="<?=getUrl("Clientes", "Clientes", "postEditarPlanta", false, "ajax"); ?>" autocomplete="off">
						
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<label class="header-blue">Editar Planta</label>
	
									<input type="hidden" name="codigo_planta" id="codigo_planta_update">
	
									<div class="col-12">
										<div class="pt-2 pb-2 row">
											<div class="col-1">
												<label for="nom_planta_update">Nombre</label>
											</div>
											<div class="col-11">
												<input type="text" name="nom_planta" id="nom_planta_update" class="form-control">
											</div>
										</div>
									</div>
	
									<div class="col-12">
										<div class="border-top pt-2 pb-2 row">
											<div class="col-1">
												<label for="dir_planta_update">Dirección</label>
											</div>
											<div class="col-11">
												<input type="text" name="dir_planta" id="dir_planta_update" class="form-control">
											</div>
										</div>
									</div>
	
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary fa fa-save" title="Editar Planta"></button>
							<button type="button" class="btn btn-primary" data-dismiss="modal" title="Cerrar">Cerrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- FIN PLANTAS -->



<!-- CONTACTOS -->
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

						<button type="button" class="btn btn-primary fa fa-user" id="btnModalCrearContacto" data-toggle="modal" data-target="#modalCrearContacto" title="Nuevo Contacto">
							<span>Nuevo</span>
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
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>

						<tbody></tbody>

					</table>
				</div>
			</div>
		</div>

		<!-- Modal CREAR CONTACTO -->
		<div class="modal fade" id="modalCrearContacto" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form id="formContacto" method="post" action="<?=getUrl("Clientes", "Clientes", "postCrearContacto", false, "ajax"); ?>" autocomplete="off">
						
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<label class="header-blue">Nuevo Contacto</label>

									<input type="hidden" name="codigo_planta" id="codigo_planta_insert">
	
									<div class="col-12">
										<div class="pt-2 pb-2 row">
											<div class="col-1">
												<label for="nom_contacto_insert">Nombre</label>
											</div>
											<div class="col-11">
												<input type="text" name="nom_contacto" id="nom_contacto_insert" class="form-control">
											</div>
										</div>
									</div>
	
									<div class="col-12">
										<div class="border-top pt-2 pb-2 row">
											<div class="col-6">
												<div class="row">
													<div class="col-2">
														<label for="tel_contacto_insert">Teléfono</label>
													</div>
													<div class="col-10">
														<input type="text" name="tel_contacto" id="tel_contacto_insert" class="form-control">
													</div>
												</div>
											</div>

											<div class="col-6">
												<div class="row">
													<div class="col-2">
														<label for="email_contacto_insert">Email</label>
													</div>
													<div class="col-10">
														<input type="text" name="email_contacto" id="email_contacto_insert" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
	
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary fa fa-save" title="Grabar Contacto"></button>
							<button type="button" class="btn btn-primary" data-dismiss="modal" title="Cerrar">Cerrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>

		<!-- Modal EDITAR CONTACTO -->
		<div class="modal fade" id="modalEditarContacto" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form id="formEditarContacto" method="post" action="<?=getUrl("Clientes", "Clientes", "postEditarContacto", false, "ajax"); ?>" autocomplete="off">
						
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<label class="header-blue">Editar Contacto</label>

									<input type="hidden" name="codigo_contacto" id="codigo_contacto_update">
	
									<div class="col-12">
										<div class="pt-2 pb-2 row">
											<div class="col-1">
												<label for="nom_contacto_update">Nombre</label>
											</div>
											<div class="col-11">
												<input type="text" name="nom_contacto" id="nom_contacto_update" class="form-control">
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
														<input type="text" name="tel_contacto" id="tel_contacto_update" class="form-control">
													</div>
												</div>
											</div>

											<div class="col-6">
												<div class="row">
													<div class="col-2">
														<label for="email_contacto_update">Email</label>
													</div>
													<div class="col-10">
														<input type="text" name="email_contacto" id="email_contacto_update" class="form-control">
													</div>
												</div>
											</div>

										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary fa fa-save" title="Editar Contacto"></button>
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

						<button type="button" class="btn btn-primary fa fa-edit" id="btnModalEditarVendedor" data-toggle="modal" data-target="#modalEditarVendedor" title="Cambiar Vendedor">
							<span>Cambiar</span>
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

		<!-- Modal EDITAR VENDEDOR -->
		<div class="modal fade" id="modalEditarVendedor" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<form id="formVendedor" method="post" action="<?=getUrl("Clientes", "Clientes", "cambiarVendedorPlanta", false, "ajax"); ?>" autocomplete="off">
						
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<label class="header-blue">Cambiar Vendedor</label>
	
									<input type="hidden" name="codigo_planta" id="codigo_planta">
	
									<div class="col-12">
										<div class="row">
											<div class="col-2">
												<label for="vendedor">Vendedor</label>
											</div>
											<div class="col-10">
												<select name="vendedor" id="vendedor" class="form-control" required>
													<option value="">Seleccione ...</option>
													<?php foreach ($empleados as $empleado): ?>
													<option value="<?=$empleado[0];?>"><?=$empleado[1];?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
	
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary fa fa-save" title="Guardar"></button>
							<button type="button" class="btn btn-primary" data-dismiss="modal" title="Cerrar">Cerrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- FIN VENDEDORES -->