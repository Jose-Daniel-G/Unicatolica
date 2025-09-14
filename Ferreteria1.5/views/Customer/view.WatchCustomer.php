<div class="card">
    <div class="card-header">
        <h4>Ver Cliente</h4>
    </div>
    <div class="card-body">
        <form action="" id="form_EditProduct" method="POST" autocomplete="off" >
            <?php foreach($sqlCustomer as $customer){}?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="SearchCustomer" title="Buscar"><i class="fa fa-search"></i> </button>
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
                                <input type="text" class="form-control" id="name_customer" name="name_customer" value="<?=$customer["Name_Customer"];?>" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="lastName_customer">Apellidos</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="lastName_customer" name="lastName_customer" value="<?=$customer["LastName_Customer"];?>" readonly>
                            </div>

                        </div>
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="phone_customer">Telefono</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="phone_customer" value="<?=$customer["Phone_Customer"];?>" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="email_customer">Correo</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="email_customer" value="<?=$customer["Email"];?>" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="address_customer">Direccion</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="address_customer" value="<?=$customer["Address"];?>" readonly>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="WaytoPay">Forma de Pago</label>
                            </div>
                            <?php foreach($sqlwaytoPay as $pay){}?>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="WaytoPay" value="<?= $pay["Description"];?>" readonly>
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
