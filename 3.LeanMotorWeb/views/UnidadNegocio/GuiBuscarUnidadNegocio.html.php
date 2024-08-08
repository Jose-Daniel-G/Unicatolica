
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Listar Unidades de Negocio</h4>
			</div>
			<!-- START OF MODAL BODY-->      
			<div class="modal-body">          
				<form role="form" name="costoProduccion" method="post"  autocomplete="off"> 					
					<div class="table-responsive" id="scrollmarca" style='height:400px'>
						<table   class="table table- table-hover" >									
							<thead>
								<tr>
									<th bgcolor="#337ab7" colspan="6" style="color:white;">Unidades de Negocio</th>
								</tr>							
								<tr>
									<th>Codigo</th>
									<th>Descripcion</th>
									<th>Porcentaje</th>									
									<th>Estado</th>									
								</tr>
							<tr>
								<th colspan='2'><input type="text" name="desUni" id="desUni" class="desUni form-control" data-url="<?php echo getUrl("UnidadNegocio", "UnidadNegocio", "listarUnidadNegocio",false,"ajax") ?>"></td></th>
								<td colspan="2"><select name="estadoBus" data-url="<?php echo getUrl("UnidadNegocio","UnidadNegocio","listarUnidadNegocio",false,"ajax");?>" id="estadoBus" class="form-control busUni" data-url="<?php echo getUrl("UnidadNegocio", "UnidadNegocio", "listarUnidadNegocio",false,"ajax") ?>">
										<option value="">Todos</option>
										<option value="A">Activos</option>
										<option value="I">Inactivo</option>
									</select></td>
									
								</tr>
								<tr>
									<th colspan='3'><h5>Dig&iacute;te los primeros caracteres</h5></th>
								</tr>
							</thead>	
							<tbody id="respuestaUnidad" data-url="<?php echo getUrl ('UnidadNegocio','UnidadNegocio','getllenarUnidadNegocio',false,'ajax')?>">
							</tbody>
						</table>         
					</div>
				</form>
			</div>			
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>			
	
	
                             