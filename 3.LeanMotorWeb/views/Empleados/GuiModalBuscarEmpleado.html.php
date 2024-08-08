<div class="card-body">
	<form method="post" id="frm_BuscarEmpleados" 
	action="<?php echo getUrl("Empleados","Empleados", "ListarEmpleados", false, "ajax"); ?>" autocomplete="off">
		<div class="container-fluid">
			<div class="row">
				<label class="font-weight-bold">Digite los primeros caracteres</label>
			</div>
			
			<div class="align-items-center pb-4 border row">
				<label class="header-blue">Búsqueda de Empleados</label>

				<div class="col-8">
					<div class="row">

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="cedula">Cedúla</label>
							<input type="text" name="cedula" id="cedula" class="form-control">
						</div>

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control">
						</div>

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="cargo">Cargo</label>
							<input type="text" name="cargo" id="cargo" class="form-control">
						</div>

						<div class="p-1 col-3">
							<label class="font-weight-bold" for="estado">Estado</label>
							<select name="estado" id="estado" class="estado form-control">
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

							<div id="menu-ir-a-Empleados" class="row" style="display: none;">

								<div class="col-5 offset-1">
									<div class="btn-group" role="group" aria-label="VerEmpleado">
										<div class="btn-group" role="group">
											<a id="btnVerEmpleado" class="btn btn-primary px-3 py-2" href="" target="_blank" style="text-decoration: none;">
												<span>Ver</span>
											</a>
										</div>
									</div>
								</div>

								<div class="col-5">
									<div class="btn-group" role="group" aria-label="EditarEmpleado">
										<div class="btn-group" role="group">
											<a id="btnEditarEmpleado" class="btn btn-primary px-3 py-2" href="" target="_blank" style="text-decoration: none;">
												<span>Editar</span>
											</a>
										</div>
									</div>
								</div>
	
							</div>

						</div>

						<div class="col-5 offset-1">
							<button type="submit" class="px-3 py-2 btn btn-primary" id="btnBuscarEmpleado" title="Buscar">
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
	<div class="nuevaBusqueda" id="containerTablaModalBuscarEmpleados" style="display: none;">
		<table id="tablaModalBuscarEmpleados" class="table-bordered table-hover" width="100%;">

			<thead class="table text-white bg-primary thead-primary">
				<tr>
					<th>#</th>
					<th>Cedúla</th>
					<th>Nombre</th>
					<th>Cargo</th>
					<th>Estado</th>
				</tr>
			</thead>

			<tbody></tbody>

		</table>
	</div>
</div>