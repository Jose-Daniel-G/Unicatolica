			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Listar Actividades</h4>
			</div>
			<!-- START OF MODAL BODY-->      
			<div class="modal-body">          
				<form role="form" name="costoProduccion" method="post"  autocomplete="off"> 					
					<div class="table-responsive" id="scrollmarca" style='height:400px'>
						<table   class="table table- table-hover" >									
							<thead>
								
								<tr>
									<th bgcolor="#337ab7" colspan="6" style="color:white;">Busqueda de Actividades</th>
								</tr>
								<tr><h5>Dig&iacute;te los primeros caracteres</h5></tr>
								<tr>
									<th width="10%">Codigo</th>
									<th width="30%">Descripcion</th>
									<th width="30%">Estado</th>									
									<th width="30%">Unidad de Negocio</th>									
								</tr>
								<tr>
									<td  width="10%"><input type="text" name="codigo" id="codigo" class="codigo form-control busAct" placeholder='Codigo' data-url="<?php echo getUrl("Actividades", "Actividades", "listarActividades",false,"ajax") ?>"></td>
									<td colspan=""  width="30%"><input type="text" name="descripcion" id="descripcion" class="descripcion form-control busAct"></td>
									<td width="30%"><select name="estado" id="estado" class="estado form-control busAct">
										<option value="">Todos los estados</option>
										<option value="A">Activos</option>
										<option value="I">Inactivo</option>
									</select></td>
									<td width="30%"></td>
								</tr>
																
							</thead>	
							<tbody id="respuestaActividad" data-url="<?php echo getUrl ('Actividades','Actividades','getllenarActividades',false,'ajax')?>">
							</tbody>
						</table>         
					</div>
				</form>
			</div>			
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>			
	
	
                             