<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>
<div class="card">
    <div class="card-header">
        <h4>
            <b>Editar Datos del Equipo</b>
        </h4>
    </div>

    <div class="card-body">
		<div class="container-fluid">
			<div class="pt-3 row">
				<div class="col-12">
					<div class="justify-content-center row">
						<?php if ($usua_perfil == 1): ?>
						<div class="col-2">
							<label for="numSerie">Sede:</label>
						</div>
						<div class="col-5">
						<select name="nit_sede" id="nit_sede" data-campo="#Nit_Cliente" class="form-control">
							<option value="">Seleccione ...</option>
							<?php foreach ($sedes as $sede): ?>
							<option value="<?=$sede[0];?>"><?=$sede[1];?></option>
							<?php endforeach;?>
						</select>
						</div>
						<?php else: ?>
						<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$nit_Empresa_sede;?>">
						<?php endif; ?>
					</div>
				</div>
			</div>
			
			<div class="pt-3 row">
				<div class="col-12">
					<div class="justify-content-center row">
						<div class="col-2">
							<label for="numSerie">Número de Serie:</label>
						</div>
						<div class="input-group col-5">
							<input type="search" name="numSerie" id="numSerie" class="form-control" placeholder="Buscar" data-url="<?=getUrl("Mantenimiento", "Mantenimiento", "buscarDatosEquipo", false, "ajax");  ?>">
							<div class="input-group-append">
								<button class="btn btn-outline-primary" type="button" id="buscar">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="pt-4 justify-content-center row">
				<div class="pb-3 border col-8">

					<div class="pb-3 row">
						<div class="p-0 col-12">
							<label class="header-blue">Datos del Equipo</label>
						</div>
					</div>

					<div class="row">
						<div class="col-2">
							<label for="cliente">Cliente:</label>
						</div>
						<div class="d-flex input-group col-10">
							<div class="flex-fill">
								<select name="cliente" id="cliente" class="form-control select2"></select>
							</div>
							<div class="input-group-append">
								<button class="btn btn-outline-primary enabledSelect2" type="button">
									<i class="fa fa-edit"></i>
								</button>
							</div>
						</div>
					</div>

					<div class="pt-3 row">
						<div class="col-2">
							<label for="marca">Marca:</label>
						</div>
						<div class="d-flex input-group col-10">
							<div class="flex-fill">
								<select name="marca" id="marca" class="form-control select2"></select>
							</div>
							<div class="input-group-append">
								<button class="btn btn-outline-primary enabledSelect2" type="button">
									<i class="fa fa-edit"></i>
								</button>
							</div>
						</div>
					</div>

					<div class="pt-3 row">
						<div class="col-2">
							<label for="tipo">Tipo:</label>
						</div>
						<div class="d-flex input-group col-10">
							<div class="flex-fill">
								<select name="tipo" id="tipo" class="form-control select2"></select>
							</div>
							<div class="input-group-append">
								<button class="btn btn-outline-primary enabledSelect2" type="button">
									<i class="fa fa-edit"></i>
								</button>
							</div>
						</div>
					</div>

					<div class="pt-3 justify-content-start row">
						<div class="col-6">
							<div class="row">
								<div class="col-7">
									<label for="cantOIS">Cantidad&nbsp;de&nbsp;OI'S&nbsp;Asociadas:</label>
								</div>
								<div class="p-0 col-2">
									<input type="text" name="cantOIS" id="cantOIS" class="form-control" value="5" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="pt-4 justify-content-center row">
				<div class="pb-3 border col-8">

					<div class="pb-3 row">
						<div class="p-0 col-12">
							<label class="header-blue">Datos Eléctricos</label>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="table-responsive">
								<table id="tablaDatosElectricos" class="table-bordered table-hover" width="100%;">

									<thead class="table text-white bg-primary thead-primary">
										<tr>
											<th>Potencia</th>
											<th>Velocidad</th>
											<th>Unidad</th>
											<th>Va</th>
											<th>Vc</th>
											<th>Ia</th>
											<th>Ic</th>
										</tr>
									</thead>

									<tbody></tbody>

								</table>
							</div>
						</div>
					</div>

					<div class="pt-3 justify-content-center row">
						<div class="offset-3 col-2">
							<button class="btn btn-primary" type="button">Guardar</button>
						</div>
						<div class="col-2">
							<button class="btn btn-danger" type="button">Cancelar</button>
						</div>
					</div>

				</div>
			</div>

		</div>
    </div>
    
</div>

<script>
$(document).ready(function () {
	$(".select2").prop("disabled", true);
	$("#numSerie").prop("disabled", true);

	$(document).on("click", "#nit_sede", function () {
		if ($(this).val() != "" && $(this).val() != 0) {
			$("#numSerie").prop("disabled", false);
		}else{
			$("#numSerie").prop("disabled", true);
		}
	});

	$(document).on("click", "#buscar", function () {
		if ($(this).parents().eq(1).find("input").val()) {
			$.ajax({
					url: $(this).parents().eq(1).find("input").attr("data-url"),
					method: "post",
					// dataType: "json",
					data: {
						"Numero_Serie": $(this).parents().eq(1).find("input").val(),
						"Nit_Sede": $("#nit_sede").val()
					},
				}).done((res) => {
					console.log(res);
			var tablaDatosElectricos = $("#tablaDatosElectricos").DataTable({
				language: {
					"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
				},
				destroy: true,
				ordering: false,
				pageLength: 10,
				autoWidth: false,
				lengthChange: false,
				columnDefs: [{
					"className": "text-center",
					"targets": "_all"
				}],
				drawCallback: () => {
					tablaDatosElectricos.columns.adjust();
				},
				ajax: {
					url: $(this).parents().eq(1).find("input").attr("data-url"),
					method: "post",
					data: {
						"Numero_Serie": $(this).parents().eq(1).find("input").val(),
						"Nit_Sede": $("#nit_sede").val()
					},
				},
				columns: [
					{ data: "Potencia" },
					{ data: "Velocidad" },
					{ data: "Unidad" },
					{ data: "Va" },
					{ data: "Vc" },
					{ data: "Ia" },
					{ data: "Ic" }
				],
			});
			});
		}
	});
});
</script>