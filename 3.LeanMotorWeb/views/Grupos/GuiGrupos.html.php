        <div class="card">
            <div class="card-header">                         
                <h4><b>Grupos</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forGrupos" id="forGrupos" method="POST" action="<?php echo getUrl("Grupos", "Grupos", "InsertarGrupos"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Grupos</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("Grupos", "Grupos", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearGrupos" name="CrearGrupos"  class="btn btn-primary" title="Grabar Marca"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarGrupos" data-VerListurl="<?php echo getUrl("Grupos","Grupos","listarGrupos",false,"ajax");?>"
									data-url="<?php echo getUrl("Grupos", "Grupos", "buscarGrupos", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar Grupos"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('Grupos','Grupos','getEliminarGrupos')?>" type="button" id="elimiMarca" class="btn btn-primary" title="Borrar Grupos"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">
										<tr>
											<td>Codigo</td>
											<td><input type="text" name="codigo" id="codigo" class="form-control" required></td>
										</tr>
										<tr>
											<td>Nombre Grupo</td>
											<td><input type="text" name="desc" id="desc" class="form-control" required></td>
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

<!-- Modal BUSCAR Grupos-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="lisGrupos">
				
			</div>
		</div>
	</div>
