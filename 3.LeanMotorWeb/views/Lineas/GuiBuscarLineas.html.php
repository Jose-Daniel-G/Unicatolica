
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Listar L&iacute;neas</h4>
			</div>
			<!-- START OF MODAL BODY-->      
			<div class="modal-body">          
				<form role="form" name="costoProduccion" method="post"  autocomplete="off"> 					
					<div class="table-responsive" id="scrollmarca" style='height:400px'>
						<table   class="table table- table-hover" >									
							<thead>
								<tr>
									<th bgcolor="#337ab7" colspan="6" style="color:white;">L&iacute;neas</th>
								</tr>
								<tr><h5>Dig&iacute;te los primeros caracteres</h5></tr>
								<tr>
									<th width="20%">Codigo</th>
									<th width="50%">Descripci&oacute;n</th>
									<th width="30%">Estado</th>									
								</tr>
							<tr>
									<td  width="20%"><input type="text" name="codigolinea" id="codigolinea" class=" form-control busLinea" placeholder='Codigo' data-url="<?php echo getUrl("Lineas", "Lineas", "listarLineas",false,"ajax") ?>"></td>
									<td colspan=""  width="50%"><input type="text" name="desclinea" id="desclinea" class=" form-control busLinea"></td>
									<td width="30%"><select name="estlinea" id="estlinea" class="form-control busLinea">
										<option value="">Todos los estados</option>
										<option value="A">Activos</option>
										<option value="I">Inactivo</option>
									</select></td>
									
								</tr>
							</thead>	
							<tbody id="respuestaLineas" data-url="<?php echo getUrl ('Lineas','Lineas','getllenarLineas',false,'ajax')?>">
							</tbody>
						</table>         
					</div>
				</form>
			</div>			
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>			
	
	
                             