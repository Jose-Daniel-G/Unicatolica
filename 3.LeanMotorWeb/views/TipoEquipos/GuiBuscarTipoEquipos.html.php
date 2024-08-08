
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Listar Tipo de Equipos</h4>
			</div>
			<!-- START OF MODAL BODY-->      
			<div class="modal-body">          
				<form role="form" name="costoProduccion" method="post"  autocomplete="off"> 					
					<div class="table-responsive" id="scrollmarca" style='height:400px'>
						<table   class="table table- table-hover" >									
							<thead>
								<tr>
									<th bgcolor="#337ab7" colspan="6" style="color:white;">Tipo de Equipos</th>
								</tr>
								<tr>
									<th colspan='3'><input type="text" name="desEqui" id="desEqui" class="desEqui form-control" data-url="<?php echo getUrl("TipoEquipos", "TipoEquipos", "listarTipoEquipos",false,"ajax") ?>"></td></th>
								</tr>
								<tr>
									<th colspan='3'><h5>Dig&iacute;te los primeros caracteres</h5></th>
								</tr>
								<tr>
									<th>Codigo</th>
									<th>Descripcion</th>
									<th>Estado</th>									
								</tr>								
							</thead>	
							<tbody id="respuestaEquipos" data-url="<?php echo getUrl ('TipoEquipos','TipoEquipos','getllenarTipoEquipos',false,'ajax')?>">
							</tbody>
						</table>         
					</div>
				</form>
			</div>			
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>			
	
	
                             