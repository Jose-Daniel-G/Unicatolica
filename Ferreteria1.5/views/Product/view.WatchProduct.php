<div class="card">
    <div class="card-header">
        <h4>Ver Producto</h4>
    </div>
    <div class="card-body">
        <form action="" id="frm_Product" method="POST" autocomplete="off" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <div class="row pb-3">
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary" title="Crear Producto"><i class="fa fa-save"></i> </button>
                                
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="Search" title="Buscar"><i class="fa fa-search"></i> </button>
                                
                            </div>
                            <div class="col-sm-1">
                                <button type="reset" class="btn btn-primary" id="reset" title="Limpiar"><i class="fa fa-file"></i> </button> 
                            </div>
                            <div class="col-sm-3 offset-1">
								<h4><span class="badge badge-success" id = "statProduct" ><?=$product["product_status"];?></span></h4>
                            </div>
                        </div>
                       
                        <div class="row pb-3">
                             <div class="col-sm-3">
                                <label for="code">Codigo del producto</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" value="<?=$product["code_product"];?>" readonly>
                            </div>
                            <div class="col-sm">
                                <label for="product">Producto</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="product" value="<?=$product["product"];?>" readonly>
                            </div>
                            <div class="col-sm">
                                <label for="amount">Cantidad</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="amount" value="<?=$product["amount"];?>" readonly>
                            </div>
                        </div>
                        <!-- <div class="row pb-3">
                            <div class="col-sm-3">
                                <label for="status">Estado</label>

                            </div>
                            <div class="col-sm-4">
                            <select name="status" id="status" class="form-control">
                                    <option value="">Seleccione ...</option>
                                    <option value="T">Todos</option>
                                    <option value="Cargado">Cargado</option>
                                    <option value="Agotado"></option>
                                </select>
                            </div>
                        </div> -->
                        <div class="row">
                            
                            <div class="col-sm-3">
                                <label for="description">Descripcion</label>
                            </div>
                            <div class="col-sm">
                                <textarea rows="4" cols="4" class="form-control" id="description"  readonly><?=$product["description"];?></textarea>
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
