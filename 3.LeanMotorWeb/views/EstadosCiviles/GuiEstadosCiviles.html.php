        <div class="card">
            <div class="card-header">                         
                <h4><b>Estados Civiles</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forEstadosCiviles" id="forEstadosCiviles" method="POST" action="<?php echo getUrl("EstadosCiviles", "EstadosCiviles", "InsertarEstadosCiviles"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Estados Civiles</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("EstadosCiviles", "EstadosCiviles", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearEstadosCiviles" name="CrearEstadosCiviles"  class="btn btn-primary" title="Grabar Estados Civiles"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarEstadosCiviles" data-VerListurl="<?php echo getUrl("EstadosCiviles","EstadosCiviles","listarEstadosCiviles",false,"ajax");?>"
									data-url="<?php echo getUrl("EstadosCiviles", "EstadosCiviles", "buscarEstadosCiviles", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar EstadosCiviles"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('EstadosCiviles','EstadosCiviles','getEliminarEstadosCiviles')?>" type="button" id="elimiEstCivil" class="btn btn-primary" title="Borrar EstadosCiviles"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">
										
										<tr>
											<td>Descripcion</td>
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

<!-- Modal BUSCAR EstadosCiviles-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="lisEstadosCiviles">
				
			</div>
		</div>
	</div>
