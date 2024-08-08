<div class="card-body">
	<form method="post" id="frm_BuscarClientes" 
	action="<?php echo getUrl("Clientes","Clientes", "ListarClientes", false, "ajax"); ?>" autocomplete="off">
		<div class="container-fluid">
			<div class="row">
				<label class="font-weight-bold">Digite los primeros caracteres</label>
			</div>
			
			<div class="align-items-center pb-4 border row">
				<label class="header-blue">Búsqueda de Clientes</label>

				<div class="col-8">
					<div class="row">

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="Nit_cliente">Nit</label>
							<input type="text" name="Nit_cliente" id="Nit_cliente" class="form-control">
						</div>

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="Razon_social">Razón Social</label>
							<input type="text" name="Razon_social" id="Razon_social" class="form-control">
						</div>

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="Ciudad">Ciudad</label>
							<input type="text" name="Ciudad" id="Ciudad" class="form-control">
						</div>

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="Estado">Estado</label>
							<select name="Estado" id="Estado" class="form-control">
								<option value="">Seleccione ...</option>
								<option value="T">Todos</option>
								<option value="A">Activos</option>
								<option value="I">Inactivos</option>
							</select>
						</div>

					</div>
				</div>

				<div class="mt-4 col-4">
					<div class="row">
						<div class="p-0 col-5 offset-1">

							<div id="menu-ir-a-Clientes" class="row" style="display: none;">
								<div class="col-5 offset-2">
									<div class="btn-group" role="group" aria-label="VerCliente">
										<div class="btn-group" role="group">
											<a id="btnVerCliente" class="btn btn-primary px-3 py-2" href="" target="_blank" style="text-decoration: none;">
												<span>Ver</span>
											</a>
										</div>
									</div>
								</div>

								<div class="col-5">
									<div class="btn-group" role="group" aria-label="EditarCliente">
										<div class="btn-group" role="group">
											<a id="btnEditarCliente" class="btn btn-primary px-3 py-2" href="" target="_blank" style="text-decoration: none;">
												<span>Editar</span>
											</a>
										</div>
									</div>
								</div>
	
							</div>

						</div>

						<div class="col-5 offset-1">
							<button type="submit" class="px-3 py-2 btn btn-primary" id="btnBuscarCliente" title="Buscar">
								<i class="fa fa-search"></i>
							</button>
							<button type="reset" class="px-3 py-2 btn btn-primary" id="btnNuevaBusqueda" title="Nueva búsqueda">
								<i class="fa fa-file"></i>
							</button>
						</div>

					</div>
				</div>

			</div>
		</div>
	</form>
</div>

<div class="container">
	<div class="nuevaBusqueda" id="containerTablaModalBuscarClientes" style="display: none;">
		<table id="tablaModalBuscarClientes" class="table-bordered table-hover" width="100%;">

			<thead class="table text-white bg-primary thead-primary">
				<tr>
					<th>Nit Cliente</th>
					<th>Nit Sede</th>
					<th>Razon Social</th>
					<th>Ciudad</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Estado</th>
				</tr>
			</thead>

			<tbody></tbody>

		</table>
	</div>
</div>
	
	
                             