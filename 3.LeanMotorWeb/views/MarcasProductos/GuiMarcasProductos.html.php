        <div class="card">
            <div class="card-header">
                <h4><b>Marcas Productos</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forMarcasProductos" id="forMarcasProductos" method="POST" action="<?php echo getUrl("MarcasProductos", "MarcasProductos", "InsertarMarcasProductos"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Marcas Productos</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("MarcasProductos", "MarcasProductos", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearMarcasProductos" name="CrearMarcasProductos"  class="btn btn-primary" title="Grabar Marca"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarMarcaProductos" data-VerListurl="<?php echo getUrl("MarcasProductos","MarcasProductos","listarMarcasProductos",false,"ajax");?>"
									data-url="<?php echo getUrl("MarcasProductos", "MarcasProductos", "buscarMarcasProductos", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar "><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('MarcasProductos','MarcasProductos','getEliminarMarcasProductos')?>" type="button" id="elimiMarcaPro" class="btn btn-primary" title="Borrar "><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">
										
										<tr>
											<td>Nombre Marca</td>
											<td><input type="hidden" name="codigo" id="codigo"  value="<?php echo $cod; ?>">
											<input type="text" name="desc" id="desc" class="form-control" required></td>
										</tr>										
										</tr>										
									</tbody>
								</table>								
							</div>							
						</form>						
					</div>
				</div>
			</div>
		</div>

<!-- Modal BUSCAR MarcasProductos-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="lisMarcasProductos">
				
			</div>
		</div>
	</div>
