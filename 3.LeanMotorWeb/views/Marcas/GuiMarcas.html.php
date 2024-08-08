        <div class="card">
            <div class="card-header">                         
                <h4><b>Marcas</b></h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forMarcas" id="forMarcas" method="POST" action="<?php echo getUrl("Marcas", "Marcas", "InsertarMarcas"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Marcas</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:70%;margin:auto;'>
								<a href="<?php echo getUrl("Marcas", "Marcas", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearMarcas" name="CrearMarcas"  class="btn btn-primary" title="Grabar Marca"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarMarca" data-VerListurl="<?php echo getUrl("Marcas","Marcas","listarMarcas",false,"ajax");?>"
									data-url="<?php echo getUrl("Marcas", "Marcas", "buscarMarcas", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar Marcas"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('Marcas','Marcas','getEliminarMarca')?>" type="button" id="elimiMarca" class="btn btn-primary" title="Borrar Marcas"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:70%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">
										<tr>
											<td>Nombre Marca</td>
											<td><input type="hidden" name="codigo" id="codigo">
											<input type="text" name="marca" id="marca" class="form-control" required></td>
										</tr>
										<tr>
											<td>Grupo</td>
											<td><select name="grupo" id="grupo" class="form-control">
												<option value=''>Seleccione</option>
												<option value='Motores'>Motores</option>
												<option value='Transformadores'>Transformadores</option>
												<option value='Otros'>Otros</option>
												<?php 
												/*echo"<option value=''>Seleccione ...</option>";
												foreach($paises as $pais)
												{
													echo"<option value='".$pais[1]."'>".$pais[0]."</option>";
												}*/
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
			<div class="modal-content" id="lisMarcas">
				
			</div>
		</div>
	</div>
