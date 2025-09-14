<div class="card-body">
	<form method="POST" id="frm_SearchCustomer" action=""
		autocomplete="off">
		<div class="container-fluid">
			<div class="row">
				<label class="font-weight-bold">Digite los primeros caracteres</label>
			</div>
			<div class="align-items-center pb-4 border row">
				<div class="col-8">
					<div class="row">
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="nit">Cedula</label>

							<input type="text" name="nit" id="nit" class="form-control">
						</div>
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="name">Nombres</label>

							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="lastName">Apellidos</label>
							<input type="text" name="lastName" id="lastName" class="form-control">
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
	<div class="newSearch" id="containerModalSearchCustomer" style="display: none;">
		<table id="tableModalSearchCustomer" class="table-bordered table-hover" width="100%">

			<thead class="table text-white bg-primary thead-primary">
				<tr>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Direccion</th>
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
        $(document).on("submit", "#frm_SearchCustomer", function (event) {
			 event.preventDefault();
			
			$("#containerModalSearchCustomer").show();
				var status = $('select[name="status"] option:selected').text();
				$("#statusProduct").text(status);


			var tableModalSearchCustomer = $("#tableModalSearchCustomer").DataTable({
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
						tableModalSearchCustomer.columns.adjust();
					},
					ajax: {
						url: "../../app/lib/ajax.php",
						method: $(this).prop("method"),
						data: {
							modulo: "Customer",
							controlador: "Customer",
							funcion: "listCustomer",
                            "name": $("#name").val(),
                            "lastname": $("#lastName").val(),
                            "nit": $("#nit").val()
						},
					},
					columns: [
						{data: "nit_costumer"},
						{data: "name_customer"},
						{data: "lastName_customer"},
						{data: "address"},
						{data: "email"},
						{data: "creation_date"},
						{data: "btnVer"},
						{data: "btnEditar"}
					],
				});	
		});
	});
	$(function viewWatchCustomer() {
		$(document).on("click", "#viewWatchCustomer", function () {
			let data = $("#tableModalSearchCustomer").DataTable().row($(this).parents("tr")).data();
			// alert(data.nit_costumer);
			llamarVista("Customer", "Customer", "viewWatchCustomer", {nit_costumer: data.nit_costumer, waytopay: data.waytopay }, true);
		});
	});

	$(function viewEditCustomer() {
		$(document).on("click", "#viewEditCustomer", function () {
			let data = $("#tableModalSearchCustomer").DataTable().row($(this).parents("tr")).data();
			llamarVista("Customer", "Customer", "viewEditCustomer", {nit_costumer: data.nit_costumer, waytopay: data.waytopay}, true);
		});
	});
	
});
	
	
</script>