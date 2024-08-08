<div class="card">
	<div class="card-header">
		<h4>
			<b>Ciclo de Vida del Proceso</b>
		</h4>
	</div>
	<?php foreach($Ingreso as $ingreso){} ?>
	<?php foreach($Cliente as $cliente){} ?>
	<div class="card-body">
		<div class="container-fluid">
			<div class="row">
				<div class="border col-4">
					<div class="row">
						<div class="text-center col-12">
							<span id="numero_ingreso" style="font-size: 25px;"><?=$numero_ingreso;?></span>
						</div>
					</div>
					<div class="row">
						<div class="text-center col-12">
							<span><?=strtoupper($cliente["Razon_Social"]);?></span>
						</div>
					</div>
					<div class="row">
						<div class="text-center col-12">
							<span><?=$_GET["nit_sede"];?></span>
						</div>
					</div>
					<div class="pt-3 row">
						<div class="col-12">
							<span>Tipo de Equipo: <span class="font-weight-bold"><?=$ingreso["Tipo_Equipo"];?></span></span>
						</div>
					</div>
					<div class="pt-3 row">
						<div class="col-12">
							<span>Equipo: <span class="font-weight-bold"><?=$ingreso["Equipo"];?></span></span>
						</div>
					</div>
					<div class="pt-3 row">
						<div class="col-12">
							<span>Potencia: <span class="font-weight-bold"><?=$ingreso["Potencia"];?></span></span>
						</div>
					</div>
					<div class="pt-3 row">
						<div class="col-12">
							<span>Velocidad: <span class="font-weight-bold"><?=$Velocidad;?></span></span>
						</div>
					</div>
					<div class="pt-3 row">
						<div class="col-12">
							<span>Voltaje: <span class="font-weight-bold"><?=$Voltaje;?></span></span>
						</div>
					</div>
					<div class="pt-3 row">
						<div class="col-12">
							<span>Para: <span class="font-weight-bold"><?=$ingreso["Enviado_Para"];?></span></span>
						</div>
					</div>
				</div>

				<div class="col-6 offset-1">
					<div class="row">
						<div class="col-12" id="containerTablaProcesosCicloVida">
							
						</div>
					</div>
				</div>
			</div>

			<div class="pt-5 row">
				<div class="col-12">
					<table id="tablaCicloVida" class="table table-bordered table-hover">

						<thead class="text-white bg-primary thead-primary">
							<tr>
								<th>Documento</th>
								<th>N° de Documento</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Ver</th>
								<th>Editar</th>
							</tr>
						</thead>

						<tbody></tbody>

					</table>
				</div>
			</div>
		</div>
	</div>

</div>


<script>
$(document).ready(function () {

	$(function tablaProcesosCicloVida() {
		$.ajax({
			url: "ajax.php?modulo=Ingresos&controlador=Ingresos&funcion=tablaProcesosCicloVida",
			method: "post",
			dataType: "json",
			data: {
				Numero_Ingreso: $("#numero_ingreso").text()
			}
		}).done((res) => {
			$("#containerTablaProcesosCicloVida").html(res.tablaProcesosCicloVida);
		});
	});

	$(function tablaCicloVida() {
		let tablaCicloVida = $("#tablaCicloVida").DataTable({
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
				tablaCicloVida.columns.adjust();
			}
		});
	});

	$(function buscarCicloVida() {
		$(document).on("click", "#tablaProcesosCicloVida button", function () {
			let tablaCicloVida = $("#tablaCicloVida").DataTable({
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
					tablaCicloVida.columns.adjust();
				},
				createdRow: (row, data) => {
					if(data.factura == true){
						$(row).addClass("bg-lawn-green");
					}
					if (data.tipo_orden == "R") {
						$(row).css("background-color", "Cyan");
					}
				},
				ajax: {
					url: "ajax.php?modulo=Ingresos&controlador=Ingresos&funcion=buscarCicloVida",
					method: "post",
					data: {
						Numero_Ingreso: $("#numero_ingreso").text(),
						Tipo_Documento: $(this).attr("data-tipo-doc")
					}
				},
				columns: [
					{ data: "tipo_documento" },
					{ data: "numero_documento" },
					{ data: "fecha_documento" },
					{ data: "estado" },
					{ data: "ver" },
					{ data: "editar" }
				],
			});
		});

		$(document).on("click", "#tablaCicloVida button", function () {
			let data = $("#tablaCicloVida").DataTable().row($(this).parents("tr")).data(),
				url = "";
			if ($(this).attr("id") == "ver") {
				url = data.urlDoc.replace("&funcion=", "&funcion=getVer");
			} else if ($(this).attr("id") == "editar") {
				url = data.urlDoc.replace("&funcion=", "&funcion=getEditar");
			}
			window.open(url);
		});
	});
});
</script>