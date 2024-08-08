
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Listar Marcas Productos</h4>
			</div>
			<!-- START OF MODAL BODY-->      
			<div class="modal-body">          
				<form role="form" name="costoProduccion" method="post"  autocomplete="off"> 					
					<div class="table-responsive" id="scrollmarca" style='height:400px'>
						<table   class="table table- table-hover" >									
							<thead>
								<tr>
									<th bgcolor="#337ab7" colspan="6" style="color:white;">Marcas Productos</th>
								</tr>
								<tr><h5>Dig&iacute;te los primeros caracteres</h5></tr>								
								<tr>
									<td><input type="text" name="descripcion" id="descripcion" class="form-control busMarPro" placeholder='Descripcion' data-url="<?php echo getUrl("MarcasProductos", "MarcasProductos", "listarMarcasProductos",false,"ajax") ?>"></td>								
								</tr>
								<tr>									
									<th>Codigo</th>																
									<th>Descripci&oacute;n</th>																
									<th>Estado</th>																
								</tr>
							</thead>	
							<tbody id="resMarcasProduc" data-url="<?php echo getUrl ('MarcasProductos','MarcasProductos','getllenarMarcasProductos',false,'ajax')?>">
							</tbody>
						</table>         
					</div>
				</form>
			</div>			
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>			
	
	
                             