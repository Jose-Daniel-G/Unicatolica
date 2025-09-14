<div class="card">
    <div class="card-header">
        <h4>Clientes</h4>
    </div>
    <div class="card-body">
        <form action="" id="form_Customer" method="POST" autocomplete="off">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary" title="Crear Cliente"><i class="fa fa-save"></i> </button>

                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="SearchCustomer" title="Buscar"><i class="fa fa-search"></i> </button>

                            </div>
                            <div class="col-sm-1">
                                <button type="reset" class="btn btn-primary" id="reset" title="Limpiar"><i class="fa fa-file"></i> </button>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="idCard">Cedula</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="validateKey" name="idCard" required data='<?=json_encode(array("typeNit" => "cliente", "table" => "customer", "field" => "nit_costumer"));?>'>
                            </div>
                            <div class="col-sm-1">
                                <label for="name_customer">Nombres</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="name_customer" name="name_customer" required>
                            </div>
                            <div class="col-sm-1">
                                <label for="lastName_customer">Apellidos</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="lastName_customer" name="lastName_customer" required>
                            </div>

                        </div>
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="phone_customer">Telefono</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="phone_customer" required>
                            </div>
                            <div class="col-sm-1">
                                <label for="email_customer">Correo</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="email" class="form-control" name="email_customer" required>
                            </div>
                            <div class="col-sm-1">
                                <label for="address_customer">Direccion</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="address_customer" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="WaytoPay">Forma de Pago</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="WaytoPay" id="WaytoPay" class="form-control" required>
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($waytoPay as $pay) : ?>
                                        <option value="<?= $pay[1]; ?>"><?= $pay[0]; ?></option>
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
<!-- Modal SEARCH -->
<div class="modal fade" id="modalSearchCostumer">
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
<!--  -->
<script>
    $(document).ready(function() {
        /***************************/ //CREATE CLIENT// /**************************/
        $("#form_Customer").on("submit", function(event) {
            {
                event.preventDefault();

                var formData = new FormData(event.target);
                formData.append("modulo", "Customer");
                formData.append("controlador", "Customer");
                formData.append("funcion", "createCustomer");
                $.ajax({
                    url: "../../app/lib/ajax.php",
                    method: "POST",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false

                }).done((res) => {
                    if (res.typeAnswer == true) {

                        swal({
                            title: 'Cliente creado exitosamente',
                            type: 'success',
                        });
                    }

                });
            }
        });


        /*************************** END **************************/
    });
</script>