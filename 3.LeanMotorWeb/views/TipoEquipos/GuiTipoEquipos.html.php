        <div class="card">
            <div class="card-header">                         
                <h4><b>Tipo de Equipos</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forTEquipos" id="forTEquipos" method="POST" action="<?php echo getUrl("TipoEquipos", "TipoEquipos", "InsertarTipoEquipos"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Tipo de Equipos</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("TipoEquipos", "TipoEquipos", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearTEquipos" name="CrearTEquipos"  class="btn btn-primary" title="Grabar Tipo de Equipo"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarEquipos" data-VerListurl="<?php echo getUrl("TipoEquipos","TipoEquipos","listarTipoEquipos",false,"ajax");?>"
									data-url="<?php echo getUrl("TipoEquipos", "TipoEquipos", "buscarTipoEquipos", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar Marcas"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('TipoEquipos','TipoEquipos','getEliminarTipoEquipo')?>" type="button" id="elimiTipoEquipo" class="btn btn-primary" title="Borrar Marcas"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">
										<tr>
											<td>Descripcion</td>
											<td><input type="hidden" name="codigo" id="codigo">
											<input type="text" name="descripcion" id="descripcion" class="form-control" required></td>
										</tr>
										<tr>
											<td>Grupo</td>
											<td><select name="grupo" id="grupo" class="form-control">
												<?php 
												echo"<option value=''>Seleccione ...</option>";
												foreach($grupos as $grupo)
												{
													echo"<option value='".$grupo[0]."'>".$grupo[1]."</option>";
												}
												?>
											</select></td>
										</tr>										
									</tbody>
								</table>								
							</div>							
						</form>						
					</div>
				</div>
			</div>
		</div>

<!-- Modal BUSCAR Marca-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="listarTEquipos">
				
			</div>
		</div>
	</div>
