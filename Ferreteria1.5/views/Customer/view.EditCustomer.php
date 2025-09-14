<div class="card">
    <div class="card-header">
        <h4>Editar Cliente</h4>
    </div>
    <div class="card-body">
        <form action="" id="form_EditCustomer" method="POST" autocomplete="off" >
            <?php foreach($sqlCustomer as $customer){}?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary" title="Modificar Producto"><i class="fa fa-save"></i> </button>   
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="SearchCustomer" title="Buscar"><i class="fa fa-search"></i> </button>     
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger" id="deleteCustomer" title="Eliminar Producto"><i class="fas fa-trash-alt"></i> </button>  
                            </div>
                            
                        </div>
                       
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="idCard">Cedula</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="validateKey" name="idCard" value="<?=$customer["nit_costumer"];?>"readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="name_customer">Nombres</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="name_customer" name="name_customer" value="<?=$customer["Name_Customer"];?>">
                            </div>
                            <div class="col-sm-1">
                                <label for="lastName_customer">Apellidos</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="lastName_customer" name="lastName_customer" value="<?=$customer["LastName_Customer"];?>">
                            </div>

                        </div>
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="phone_customer">Telefono</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="phone_customer" value="<?=$customer["Phone_Customer"];?>">
                            </div>
                            <div class="col-sm-1">
                                <label for="email_customer">Correo</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="email" class="form-control" name="email_customer" value="<?=$customer["Email"];?>">
                            </div>
                            <div class="col-sm-1">
                                <label for="address_customer">Direccion</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="address_customer" value="<?=$customer["Address"];?>">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="waytoPay">Forma de Pago</label>
                            </div>
                            <?php foreach($sqlwaytoPay as $pay){}?>
                            <div class="col-sm-3">
                                <select name="waytoPay" id="waytoPay" class="form-control" required>
                                    <option value="<?= $pay["Code_Way_Pay"]; ?>"><?= $pay["Description"];?></option>
                                    <?php foreach ($waytoPay as $way) : ?>
                                        <option value="<?= $way[1]; ?>"><?= $way[0]; ?></option>
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
$(document).ready( function(){
    $(function EditProduct() {
		$(document).on("submit", "#form_EditCustomer", function (event) {
			event.preventDefault();
			
			var formData = new FormData(event.target);
			formData.append("modulo", "Customer");
			formData.append("controlador", "Customer");
			formData.append("funcion", "EditCustomer");
			$.ajax({
				url: "../../app/lib/ajax.php",
				method: "post",
				dataType: "json",
				data: formData,
				cache: false, 
				processData: false,
				contentType: false
			}).done((res) => {
                swal({ title: 'Cliente modificado exitosamente', type: 'success', });
			});
		});
    });
    $(function deleteCustomer() {
        $(document).on("click", "#deleteCustomer", function () {
           
                
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
                    var formData = new FormData($("#form_EditCustomer")[0]);
                    formData.append("modulo", "Customer");
                    formData.append("controlador", "Customer");
                    formData.append("funcion", "deleteCustomer");
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

                            swal({ title: 'Cliente Eliminado exitosamente', type: 'success', });
                        } 
                    });
                }
            });   
        });
    });
    
});

</script>
