        <div class="card">
            <div class="card-header">                         
                <h4><b>Unidades de Negocio</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forTEquipos" id="forTEquipos" method="POST" action="<?php echo getUrl("UnidadNegocio", "UnidadNegocio", "InsertarUnidadNegocio"); ?>"   autocomplete="off">
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Unidades de Negocio</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("UnidadNegocio", "UnidadNegocio", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearUnidadNegocio" name="CrearUnidadNegocio"  class="btn btn-primary" title="Grabar Tipo de Equipo"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarUnidadN" data-VerListurl="<?php echo getUrl("UnidadNegocio","UnidadNegocio","listarUnidadNegocio",false,"ajax");?>"
									data-url="<?php echo getUrl("UnidadNegocio", "UnidadNegocio", "buscarUnidadNegocio", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar Marcas"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('UnidadNegocio','UnidadNegocio','getEliminarUnidadNegocio')?>" type="button" id="elimiUnidadNegocio" class="btn btn-primary" title="Borrar Marcas"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">
										<tr>
											<td>Descripcion</td>
											<td><input type="hidden" name="codigo" id="codigo" class="form-control" required value="<?php echo $num_doc; ?>">
										    <input type="text" name="descripcion" id="descripcion" class="form-control" required></td>
										</tr>
										<tr>
											<td>Porcentaje CIF</td>
											<td><input type="text" name="cif" id="cif" class="form-control" required></td>
										</tr>									
									</tbody>
								</table>								
							</div>							
						</form>						
					</div>
				</div>
			</div>
		</div>

<!-- Modal BUSCAR Marca-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="listarUN">
				
			</div>
		</div>
	</div>
