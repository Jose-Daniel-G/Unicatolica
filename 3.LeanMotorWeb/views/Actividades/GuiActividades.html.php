        <div class="card">
            <div class="card-header">                         
                <h4><b>Actividades</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forActividades" id="forActividades" method="POST" action="<?php echo getUrl("Actividades", "Actividades", "InsertarActividades"); ?>"  autocomplete="off">
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Actividades</th>
										</tr>
								</table>
						</div><br>
									<div  style='width:70%;margin:auto;'>
										<a href="<?php echo getUrl("Actividades", "Actividades", "borar"); ?>" class="btn btn-primary" title="Nueva Actividades"><span class="fa fa-file"></span></a>
										<button type="submit" id="CrearActividades" name="CrearActividades"  class="btn btn-primary" title="Grabar Actividades"><i class="fa fa-save" aria-hidden="true"></i></button>							
										<button type="button" id="ListarActividades" data-VerListurl="<?php echo getUrl("Actividades","Actividades","listarActividades",false,"ajax");?>"
											data-url="<?php echo getUrl("Actividades", "Actividades", "buscarActividades", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar Actividades"><i class="fa fa-search" aria-hidden="true"></i></button>
										<a href="#" data-url="<?php echo getUrl('Actividades','Actividades','getEliminarActividades')?>" type="button" id="elimiActividades" class="btn btn-primary" title="Borrar Actividades"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
									</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
							
								<table   class="table table- table-hover">		
									
									<tbody id="cli">
										<tr>
											<td colspan='6'>Descripcion
											<input type="hidden" name="codigo" id="codigo"  value="<?php echo $num_doc; ?>">
											<input type="text" name="descripcion" id="descripcion" class="form-control" required></td>
										</tr>
										<tr>
											<td colspan='5'>Porcentaje IVA
											<select name="iva" id="iva" class="form-control">
												<?php 
												echo"<option value=''>Seleccione ...</option>";
												foreach($ivas as $iva)
												{
													echo"<option value='".$iva[1]."'>".$iva[0]."</option>";
												}
												?>
											</select></td>
											<td>Unidad de Negocio
											<select name="unidad" id="unidad" class="form-control">
												<?php 
												echo"<option value=''>Seleccione ...</option>";
												foreach($Unidades as $Unidad)
												{
													echo"<option value='".$Unidad[0]."'>".$Unidad[1]."</option>";
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
		<div class="modal-dialog" style="width:80%">
			<!-- Modal content-->
			<div class="modal-content" id="lisActividades">
				
			</div>
		</div>
	</div>
