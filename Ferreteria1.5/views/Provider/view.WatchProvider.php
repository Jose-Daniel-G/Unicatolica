<div class="card">
    <div class="card-header">
        <h4>Ver Proveedor</h4>
    </div>
    <div class="card-body">
        <form action="" id="form_watchProvider" method="POST" autocomplete="off" >
            <?php foreach($sqlProvider as $provider){}?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="SearchProvider" title="Buscar"><i class="fa fa-search"></i> </button>
                                
                            </div>
                        </div>
                       
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="idCard">Nit Proveedor</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="validateKey" name="idCard" value="<?=$provider["Nit_Provider"];?>"readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="name_provider">Proveedor</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="name_provider" name="name_provider" value="<?=$provider["Provider"];?>" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="address_provider">Direccion</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="address_provider" name="address_provider" value="<?=$provider["Address_Provider"];?>" readonly>
                            </div>

                        </div>
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <label for="phone_provider">Telefono</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="phone_provider" name="phone_provider" value="<?=$provider["Phone_Provider"];?>" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label for="email_provider">Correo</label>
                            </div>

                            <div class="col-sm-3">
                                <input type="email" class="form-control" name="email_provider" value="<?=$provider["Email_Provider"];?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal SEARCH -->
<div class="modal fade" id="modalSearchProvider">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 80%;">
        <div class="modal-content">

            <div class="text-center modal-header">
                <h3 class="w-100 modal-title">Búsqueda de Proveedores</h3>
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