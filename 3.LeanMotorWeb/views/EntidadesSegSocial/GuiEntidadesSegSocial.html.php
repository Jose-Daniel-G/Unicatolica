<div id="page-wrapper">          
    <!-- /.row -->
    <div class="row">
        <div class="card">
            <div class="card-header">                         
                <h4><b>Entidades de Seguridad Social</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forEntidadesSegSocial" id="forEntidadesSegSocial" method="POST" action="<?php echo getUrl("EntidadesSegSocial", "EntidadesSegSocial", "InsertarEntidadesSegSocial"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Entidades de Seguridad Social</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("EntidadesSegSocial", "EntidadesSegSocial", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearEntidadesSegSocial" name="CrearEntidadesSegSocial"  class="btn btn-primary" title="Grabar Marca"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarEntidadesSegSocial" data-VerListurl="<?php echo getUrl("EntidadesSegSocial","EntidadesSegSocial","listarEntidadesSegSocial",false,"ajax");?>"
									data-url="<?php echo getUrl("EntidadesSegSocial", "EntidadesSegSocial", "buscarEntidadesSegSocial", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar EntidadesSegSocial"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('EntidadesSegSocial','EntidadesSegSocial','getEliminarEntidadesSegSocial')?>" type="button" id="elimiSegSocial" class="btn btn-primary" title="Borrar EntidadesSegSocial"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">										
										<tr>
											<td>Nit</td>
											<td><input type="number" name="nit" id="nit" size='4' class="form-control"required></td>
											
											<td>Tipo</td>
											<td><select name="tipo" id="tipo" class="form-control" >
												<?php 
													echo"<option value=''>Seleccione Tipo</option>";
													foreach($TipoSeg as $tipo){
														echo"<option value='".$tipo[0]."'>".$tipo[1]."</option>";
													}
												?>
											</select></td>
										</tr>
										<tr>
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
	</div>	
</div>
<!-- Modal BUSCAR EntidadesSegSocial-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="lisEntidadesSegSocial">
				
			</div>
		</div>
	</div>
