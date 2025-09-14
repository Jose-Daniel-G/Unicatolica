<div class="card">
    <div class="card-header">
        <h4>Editar Producto</h4>
    </div>
    <div class="card-body">
        <form action="" id="form_EditProduct" method="POST" autocomplete="off">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <!-- Botones -->
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary" title="Modificar Producto">
                                    <i class="fa fa-save"></i>
                                </button>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="Search" title="Buscar">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger" id="deleteProduct" title="Eliminar Producto">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div class="col-sm-3 offset-1">
                                <h4>
                                    <span class="badge badge-success" id="statProduct"><?= $product["product_status"]; ?></span>
                                </h4>
                            </div>
                        </div>

                        <!-- Campos del producto -->
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="code_Product">Codigo</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="code_Product" name="code_Product" value="<?= $product["code_product"]; ?>" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="product">Producto</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="product" name="product" value="<?= $product["product"]; ?>">
                            </div>
                            <div class="col-sm-1">
                                <label for="price">Valor Unitario</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="price" value="<?= $product["price"]; ?>">
                            </div>
                            <div class="col-sm-1">
                                <label for="amount">Cantidad</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="amount" name="amount" value="<?= $product["amount"]; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <label for="description">Descripcion</label>
                            </div>
                            <div class="col-sm">
                                <textarea rows="4" cols="4" class="form-control" id="description" name="description"><?= $product["description"]; ?></textarea>
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
                <!-- Aquí va contenido dinámico -->
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    // Editar Producto
    $(document).on("submit", "#form_EditProduct", function (event) {
        event.preventDefault();
        var formData = new FormData(event.target);
        formData.append("modulo", "Product");
        formData.append("controlador", "Product");
        formData.append("funcion", "EditProduct");
        $.ajax({
            url: "../../app/lib/ajax.php",
            method: "post",
            dataType: "json",
            data: formData,
            cache: false, 
            processData: false,
            contentType: false
        }).done((res) => {
            swal({ title: 'Producto modificado exitosamente', type: 'success' });
        });
    });

    // Eliminar Producto
    $(document).on("click", "#deleteProduct", function () {
        let status = $("#statProduct").text();
        if(status === "Existente"){
            swal({
                type: "warning",
                title: "Esta seguro que desea eliminar el registro?",
                showCancelButton: true,
                confirmButtonColor: "#337ab7",
                confirmButtonText: "Sí",
                cancelButtonColor: "#d33",
                cancelButtonText: "No",
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.value) {
                    var formData = new FormData($("#form_EditProduct")[0]);
                    formData.append("modulo", "Product");
                    formData.append("controlador", "Product");
                    formData.append("funcion", "deleteProduct");
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
                            swal({ title: 'Producto eliminado exitosamente', type: 'success' });
                        }
                    });
                }
            });
        }
    });
});
</script>
