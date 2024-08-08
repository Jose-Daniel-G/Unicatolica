        <div class="card">
            <div class="card-header">                         
                <h4><b>ARL</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forArl" id="forArl" method="POST" action="<?php echo getUrl("Arl", "Arl", "InsertarArl"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">ARL</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("Arl", "Arl", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearArl" name="CrearArl"  class="btn btn-primary" title="Grabar Marca"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarArl" data-VerListurl="<?php echo getUrl("Arl","Arl","listarArl",false,"ajax");?>"
									data-url="<?php echo getUrl("Arl", "Arl", "buscarArl", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar Arl"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('Arl','Arl','getEliminarArl')?>" type="button" id="elimiArl" class="btn btn-primary" title="Borrar Arl"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">										
										<tr>
											<td>Nit</td>
											<td><input type="number" name="nit" id="nit" size='4' class="form-control" required data-url="<?php echo getUrl('Arl','Arl','getllenarArl',false,'ajax'); ?>"></td>
											
											<td>Nombre</td>
											<td colspan='3'><input type="text" name="nombre" id="nombre" class="form-control" ></td>
										</tr>
																														
									</tbody>
								</table>								
							</div>							
						</form>						
					</div>
				</div>
			</div>
		</div>
<!-- Modal BUSCAR Arl-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="lisArl">
				
			</div>
		</div>
	</div>
