
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Listar Marcas</h4>
			</div>
			<!-- START OF MODAL BODY-->      
			<div class="modal-body">          
				<form role="form" name="costoProduccion" method="post"  autocomplete="off"> 					
					<div class="table-responsive" id="scrollmarca" style='height:400px'>
						<table   class="table table- table-hover" >									
							<thead>
								<tr>
									<th bgcolor="#337ab7" colspan="6" style="color:white;">Marcas</th>
								</tr>
								<tr>
									<th colspan='3'>Descripci&oacute;n</th>
								</tr>								
								<tr>
									<th colspan='3'><input type="text" name="descripcion" id="descripcion" class="descripcion form-control busMarca" data-url="<?php echo getUrl("Marcas", "Marcas", "listarMarcas",false,"ajax") ?>"></td></th>
								</tr>
								<tr>
									<th colspan='3'><h5>Dig&iacute;te los primeros caracteres</h5></th>
								</tr>
								<tr>
									<th>Codigo</th>
									<th>Nombre</th>
									<th>Estado</th>									
								</tr>								
							</thead>	
							<tbody id="respuestaMarcas" data-url="<?php echo getUrl ('Marcas','Marcas','getllenarMarcas',false,'ajax')?>">
							</tbody>
						</table>         
					</div>
				</form>
			</div>			
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>			
	
	
                             