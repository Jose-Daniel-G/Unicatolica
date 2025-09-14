<div class="card">
    <div class="card-header">
        <h4>Producto</h4>
    </div>
    <div class="card-body">
        <form action="" id="frm_Product" method="POST" autocomplete="off" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary" title="Crear Producto" onclick="this.form.reset();"><i class="fa fa-save"></i> </button>
                                
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="Search" title="Buscar"><i class="fa fa-search"></i> </button>
                                
                            </div>
                            <div class="col-sm-1">
                                <button type="reset" class="btn btn-primary" id="reset" title="Limpiar"><i class="fa fa-file"></i> </button> 
                            </div>
                        </div>
                       
                        <div class="row pb-3">
                             <div class="col-sm-1">
                                <label for="validateKey">Codigo</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="validateKey" name="code" required 
                                data='<?=json_encode(array("typeNit" => "producto", "table" => "product", "field" => "Code_Product"));?>'>
                            </div>
                            <div class="col-sm-1">
                                <label for="product">Producto</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="product" required>
                            </div>
                            <div class="col-sm-1">
                                <label for="price">Valor Unitario</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="price" required>
                            </div>
                            <div class="col-sm-1">
                                <label for="amount">Cantidad</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="amount" required >
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-3">
                                <label for="description">Descripcion</label>
                            </div>
                            <div class="col-sm">
                                <textarea rows="4" cols="4" class="form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal BUSCAR -->
<div class="modal fade" id="modalSearchProduct">
	<div class="modal-dialog modal-lg" role="document" style="max-width: 80%;">
		<div class="modal-content">

			<div class="text-center modal-header">
				<h3 class="w-100 modal-title">Búsqueda de productos</h3>
				<button type="button" class="close" data-dismiss="modal" title="Cerrar">
					<i class="fa fa-window-close fa-2x text-danger"></i>
				</button>
			</div>

			<div class="modal-body">

			</div>

		</div>
	</div>
</div>
<!--  -->
<script>
$(document).ready(function () {
    /***************************/ //CREATE PRODUCT// /**************************/
    $(function RegistrarProducto() {
		$(document).on("submit", "#frm_Product", function (event) {
			event.preventDefault();
			
			var formData = new FormData(event.target);
			formData.append("modulo", "Product");
			formData.append("controlador", "Product");
			formData.append("funcion", "CreateProduct");
			$.ajax({
				url: "../../app/lib/ajax.php",
				method: "POST",
				dataType: "json",
				data: formData,
				cache: false, 
				processData: false,
				contentType: false
			}).done((res) => {
                if (res.typeAnswer == true) {
                    
                    swal({ title: 'Producto Ingresado exitosamente', type: 'success', });
                    // $("#frm_Product")[0].reset();
                    // $("#frm_Product").trigger("reset");
                    // $("#frm_Product").get(0).reset();

                } 
			});
		});
	});
  
    /*************************** END **************************/

    
    
  
});
</script>