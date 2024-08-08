        <div class="card">
            <div class="card-header">                         
                <h4><b>Tipo de Seguridad Social</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forTipoSeg" id="forTipoSeg" method="POST" action="<?php echo getUrl("TipoSeg", "TipoSeg", "InsertarTipoSeg"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Tipo de Seguridad Social</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("TipoSeg", "TipoSeg", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearTipoSeg" name="CrearTipoSeg"  class="btn btn-primary" title="Grabar Marca"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarTipoSeg" data-VerListurl="<?php echo getUrl("TipoSeg","TipoSeg","listarTipoSeg",false,"ajax");?>"
									data-url="<?php echo getUrl("TipoSeg", "TipoSeg", "buscarTipoSeg", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar TipoSeg"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('TipoSeg','TipoSeg','getEliminarTipoSeg')?>" type="button" id="elimiVivienda" class="btn btn-primary" title="Borrar TipoSeg"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">										
										<tr>
											<td>Descripcion</td>
											<td><input type="hidden" name="codigo" id="codigo"  value="<?php echo $cod; ?>">
											<input type="text" name="desc" id="desc" class="form-control" required></td>
										</tr>
								</table>								
							</div>							
						</form>						
					</div>
				</div>
			</div>
		</div>
<!-- Modal BUSCAR TipoSeg-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="lisTipoSeg">
				
			</div>
		</div>
	</div>
