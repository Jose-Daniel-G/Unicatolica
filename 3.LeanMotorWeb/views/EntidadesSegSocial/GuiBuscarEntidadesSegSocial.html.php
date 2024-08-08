
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Listar Entidades de Seguridad Social</h4>
			</div>
			<!-- START OF MODAL BODY-->      
			<div class="modal-body">          
				<form role="form" name="costoProduccion" method="post"  autocomplete="off"> 					
					<div class="table-responsive" id="scrollmarca" style='height:400px'>
						<table   class="table table- table-hover" >									
							<thead>
								<tr>
									<th bgcolor="#337ab7" colspan="6" style="color:white;">EntidadesSegSocial</th>
								</tr>
								<tr><h5>Dig&iacute;te los primeros caracteres</h5></tr>
								<tr>
									<td colspan='2'><input type="text" name="descripcion" id="descripcion" class="form-control busSeg" placeholder='Nombre' data-url="<?php echo getUrl("EntidadesSegSocial", "EntidadesSegSocial", "listarEntidadesSegSocial",false,"ajax") ?>"></td>								
									<td colspan='2'><select name="tipo" id="tipo" class="form-control busSeg" placeholder='Tipo' >
												<?php 
													echo"<option value=''>Seleccione Tipo</option>";
													foreach($TipoSeg as $tipo){
														echo"<option value='".$tipo[0]."'>".$tipo[1]."</option>";
													}
												?>
											</select></td>								
								</tr>
								<tr>
									<th width="20%">Nit</th>
									<th width="50%">Nombre</th>
									<th width="30%">Tipo</th>									
									<th width="30%">Estado</th>									
								</tr>								
							</thead>	
							<tbody id="respuestaEntidadesSegSocial" data-url="<?php echo getUrl ('EntidadesSegSocial','EntidadesSegSocial','getllenarEntidadesSegSocial',false,'ajax')?>">
							</tbody>
						</table>         
					</div>
				</form>
			</div>			
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>			
	
	
                             