<div class="card-body">
	<form method="POST" id="frm_SearchProvider" action=""
		autocomplete="off">
		<div class="container-fluid">
			<div class="row">
				<label class="font-weight-bold">Digite los primeros caracteres</label>
			</div>
			<div class="align-items-center pb-4 border row">
				<div class="col-8">
					<div class="row">
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="nit">Nit Proveedor</label>

							<input type="text" name="nit" id="nit" class="form-control">
						</div>
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="name">Proveedor</label>

							<input type="text" name="name" id="name" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						<div class="col-5 offset-1">
							<button type="submit" class="px-3 py-2 btn btn-primary" id="btnSearchProduct" title="Buscar">
								<i class="fa fa-search"></i>
							</button>
							<button type="reset" class="px-3 py-2 btn btn-primary" id="btnNewSearch" title="Nueva búsqueda">
								<i class="fa fa-file"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<style>
	div.dataTables_wrapper {
		margin: 0 auto;
		width: 80%;
	}
</style>

<div class="container">
	<div class="newSearch" id="containerModalSearchProvider" style="display: none;">
		<table id="tableModalSearchProvider" class="table-bordered table-hover" width="100%">

			<thead class="table text-white bg-primary thead-primary">
				<tr>
					<th>Nit</th>
					<th>Proveedor</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Correo</th>
					<th>Creacion</th>
					<th>Ver</th>
					<th>Editar</th>

				</tr>
            </thead>
            
			<tbody></tbody>
		</table>
	</div>
</div>
<script>
	$(document).ready(function () {
	  /***************************LIST PRODUCT**************************/
	  $(function listProduct() {
        $(document).on("submit", "#frm_SearchProvider", function (event) {
			 event.preventDefault();
			
			$("#containerModalSearchProvider").show();
				var status = $('select[name="status"] option:selected').text();
				$("#statusProduct").text(status);


			var tableModalSearchProvider = $("#tableModalSearchProvider").DataTable({
					dom: "Bfrtip",
					buttons: [{
						extend: "excelHtml5",
						text: '<i class="fa fa-file-excel"></i>',
						titleAttr: "Exportar a Excel",
						className: "bg-success",
						filename: "Cliente",
						sheetName: "Cliente"
					}],
					language: {
						"url": "../../assets/vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
					},
					destroy: true,
					pageLength: 10,
					autoWidth: false,
					lengthChange: false,
					columnDefs: [{
						"className": "text-center",
						"targets": "_all"
                    }],
                    drawCallback: () => {
						tableModalSearchProvider.columns.adjust();
					},
					ajax: {
						url: "../../app/lib/ajax.php",
						method: $(this).prop("method"),
						data: {
							modulo: "Provider",
							controlador: "Provider",
							funcion: "listProvider",
                            "name": $("#name").val(),
                            "lastname": $("#lastName").val(),
                            "nit": $("#nit").val()
						},
					},
					columns: [
						{data: "nit_provider"},
						{data: "name_provider"},
						{data: "address"},
						{data: "phone"},
						{data: "email"},
						{data: "creation_date"},
						{data: "btnVer"},
						{data: "btnEditar"}
					],
				});	
		});
	});
	$(function viewWatchProvider() {
		$(document).on("click", "#viewWatchProvider", function () {
			let data = $("#tableModalSearchProvider").DataTable().row($(this).parents("tr")).data();
			// alert(data.nit_Provider);
			llamarVista("Provider", "Provider", "viewWatchProvider", {nit_provider: data.nit_provider}, true);
		});
	});

	$(function viewEditProvider() {
		$(document).on("click", "#viewEditProvider", function () {
			let data = $("#tableModalSearchProvider").DataTable().row($(this).parents("tr")).data();
			llamarVista("Provider", "Provider", "viewEditProvider", {nit_provider: data.nit_provider}, true);
		});
	});
	
});
	
	
</script>