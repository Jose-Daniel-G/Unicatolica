<div class="card-body">
	<form method="POST" id="frm_SearchProduct" action=""
		autocomplete="off">
		<div class="container-fluid">
			<div class="row">
				<label class="font-weight-bold">Digite los primeros caracteres</label>
			</div>
			<div class="align-items-center pb-4 border row">
				<div class="col-8">
					<div class="row">
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="codes">Codigo</label>

							<input type="text" name="codes" id="codes" class="form-control">
						</div>
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="products">Producto</label>

							<input type="text" name="products" id="products" class="form-control">
						</div>
						<div class="p-1 col-4">
							<label class="font-weight-bold" for="status">Estado</label>
							<select name="status" id="status" class="form-control">
								<option value="">Seleccione ...</option>
								<option value="T">Todos</option>
								<option value="Cargado">Cargado</option>
								<option value="Agotado"></option>
							</select>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="row">
						<div class="p-0 col-5 offset-1">
							<div id="menu-ir-a-FondoCesantias" class="row" style="display: none;" >
								<div class="col-5 offset-1">
									<div class="btn-group" role="group">
										<div class="btn-group" role="group">
											<a id="btnVerFondoCesantias" class="btn btn-primary px-3 py-2" href="" target="_blank" style="text-decoration: none;">
												<span>Ver</span>
											</a>
										</div>
									</div>
								</div>

								<div class="col-5">
									<div class="btn-group" role="group" aria-label="EditProduct">
										<div class="btn-group" role="group"><a id="btnEditProduct" class="btn btn-primary px-3 py-2" href="" target="_blank" style="text-decoration: none;">
												<span>Editar</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>
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
	<div class="newSearch" id="containerModalSearchProduct" style="display: none;">
		<table id="tableModalSearchProduct" class="table-bordered table-hover" width="100%">

			<thead class="table text-white bg-primary thead-primary">
				<tr>
					<th>Codigo</th>
					<th>Producto</th>
					<th>Estado</th>
					<th>Cantidad</th>
					<th>Descripcion</th>

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
        $(document).on("submit", "#frm_SearchProduct", function (event) {
			 event.preventDefault();
			
        if ($("#codes").val()||$("#products").val()||$("#status").val()) {
			$("#containerModalSearchProduct").show();
			var formData = new FormData(event.target);
            formData.append("function", "searchProduct");

			var tableModalSearchProduct = $("#tableModalSearchProduct").DataTable({
						dom: "Bfrtip",
						buttons: [{
						extend: "excelHtml5",
						text: '<i class="fa fa-file-excel"></i>',
						titleAttr: "Exportar a Excel",
						className: "bg-success",
						filename: "CajaCompensacion",
						sheetName: "CajaCompensacion"
					}],
					language: {
						"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
					},
					destroy: true,
					pageLength: 10,
					autoWidth: false,
					lengthChange: false,
					columnDefs: [{
						"className": "text-center",
						"targets": "_all"
					}],
					ajax: {
						url: '../../app/controller/ProductController.php',
						method: $(this).prop("method"),
						data: { function: "searchProduct",
								"codes": $("#codes").val(),
								"products": $("#products").val(),
								"status": $("#status").val(),
								"description": $("#description").val()
						},
					},
					columns: [
						{data: "product_status", "width": "20%"},
						{data: "product"},
						{data: "status"},
						{data: "amount"},
						{data: "description"}
					],
				});

          
			} else {
				swal({
					type: "warning",
					title: "Seleccione un criterio de búsqueda"
				});
			}
		});
	});
	});
	
</script>