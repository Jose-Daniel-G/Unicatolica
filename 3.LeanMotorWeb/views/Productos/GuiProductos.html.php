       <div class="card">
            <div class="card-header">                         
                <h4>
					<b>Productos</b>
				</h4>
            </div>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
                        <form role="form" name="forProductos" id="forProductos" method="POST" action="<?php echo getUrl("Productos", "Productos", "InsertarProductos"); ?>"  autocomplete="off" >
						 <div class="table-responsive" >
								<table   class="table table- table-hover cliente">									
									<thead>
										<tr>
											<th bgcolor="#337ab7" colspan="6" style="color:white;">Productos</th>
										</tr>
								</table>
						</div><br>
							<div  style='width:100%;margin:auto;'>
								<a href="<?php echo getUrl("Productos", "Productos", "borar"); ?>" class="btn btn-primary" title="Nueva Marca"><span class="fa fa-file"></span></a>
								<button type="submit" id="CrearProductos" name="CrearProductos"  class="btn btn-primary" title="Grabar Marca"><i class="fa fa-save" aria-hidden="true"></i></button>							
								<button type="button" id="ListarProductos" data-VerListurl="<?php echo getUrl("Productos","Productos","listarProductos",false,"ajax");?>"
									data-url="<?php echo getUrl("Productos", "Productos", "buscarProductos", false, "ajax"); ?>"  data-toggle="modal" data-target="#myModalBuscar"  class="btn btn-primary" title="Listar Productos"><i class="fa fa-search" aria-hidden="true"></i></button>
								<a href="#" data-url="<?php echo getUrl('Productos','Productos','getEliminarProducto')?>" type="button" id="elimiProductos" class="btn btn-primary" title="Borrar Productos"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
							</div><br>
                         <div class="table-responsive" style='width:100%;margin:auto;'>
								<table   class="table table- table-hover">									
									<tbody id="cli">
										<tr>
											<td>Codigo</td>
											<td  width='10%'><input type="text" name="codigo" id="codigo" class="form-control" required></td>
										
											<td>Descripci&oacute;n</td>
											<td width='40%'><input type="text" name="desc" id="desc" class="form-control" required></td>
											
											<td>Grupo</td>
											<td><select name="grupo" id="grupo" class="form-control">   
												<?php 
												echo"<option value=''>Seleccione..</option>";
												foreach($grupos as $grupo)
												{
													echo"<option value='".$grupo[0]."'>".$grupo[1]."</option>";
												}
												?>
												</select>
											</td>
										</tr>
										</tbody>
										</table>
										<table class="table table- table-hover">		
										<tr>
											<td>Linea</td>
											<td width="30%"><select name="linea" id="linea" class="form-control">   
												<?php 
												echo"<option value=''>Seleccione..</option>";
												foreach($lineas as $linea)
												{
													echo"<option value='".$linea[0]."'>".$linea[1]."</option>";
												}
												?>
												</select>
											</td>
											<td>Marca</td>
											<td width="30%"><select name="marca" id="marca" class="form-control">   
												<?php 
												echo"<option value=''>Seleccione..</option>";
												foreach($marcas as $marca)
												{
													echo"<option value='".$marca[0]."'>".$marca[1]."</option>";
												}
												?>
												</select>
											</td>
											<td width="15%">Unidad de Medida</td>
											<td width="25%"><select name="unidad" id="unidad" class="form-control">   
												<?php 
												echo"<option value=''>Seleccione..</option>";
												foreach($unidades as $unidad)
												{
													echo"<option value='".$unidad[0]."'>".$unidad[1]."</option>";
												}
												?>
												</select>
											</td>
										</tr>
										</table>
										<table class="table table- table-hover">
										<tr>
											<td>Ubicaci&oacute;n Bodega</td>
											<td><input type="text" name="bodega" id="bodega" class="form-control" required></td>
											<td>Equivalencia</td>
											<td><input type="text" name="equivalencia" id="equivalencia" class="form-control " required></td>
											<td>Cantidad Existente</td>
											<td  width='10%'><input type="text" name="cantExi" id="cantExi" class="form-control" ></td>
											<td>Costo Promedio</td>
											<td width='10%'><input type="text" name="cosPromedio" id="cosPromedio" class="form-control" ></td>
										</tr>				
										</table>	
										<table class="table table- table-hover">
										<tr>				
											<td >Costo Total</td>
											<td width='10%'><input type="text" name="cosTotal" id="cosTotal" class="form-control " ></td>
											<td>Ultimo Costo</td>
											<td width='10%'><input type="text" name="ultCosto" id="ultCosto" class="form-control " ></td>
											<td>% Comisi&oacute;n</td>
											<td width='10%'><input type="text" name="comision" id="comision" class="form-control " ></td>
											<td >% Maximo Dto</td>
											<td width='10%'><input type="text" name="maxDto" id="maxDto" class="form-control " ></td>
											<td>Tipo Iva</td>
											<td width='12%'>
												<select name="iva" id="iva" class="form-control">
												<?php 
												echo"<option value=''>Seleccione ...</option>";
												foreach($ivas as $iva)
												{
													echo"<option value='".$iva[1]."'>".$iva[0]."</option>";
												}
												?>
											</select></td>
										</tr>
										</table>
										<table class="table table- table-hover">
											<tr>
												<td >Precio Venta 1</td>
												<td width=''><input type="text" name="venta1" id="venta1" class="form-control " ></td>
												<td >Iva Incluido</td>
												<td width=''><input type="text" name="iva1" id="iva1" class="form-control " ></td>
												<td >Precio Venta 2</td>
												<td width=''><input type="text" name="venta2" id="venta2" class="form-control " ></td>
												<td >Iva Incluido</td>
												<td width=''><input type="text" name="iva2" id="iva2" class="form-control " ></td>
											</tr>
											<tr>
												<td >Precio Venta 3</td>
												<td width='13%'><input type="text" name="venta3" id="venta3" class="form-control " ></td>
												<td >Iva Incluido</td>
												<td width='13%'><input type="text" name="iva3" id="iva3" class="form-control " ></td>
												<td >Precio Venta 4</td>
												<td width='13%'><input type="text" name="venta4" id="venta4" class="form-control " ></td>
												<td >Iva Incluido</td>
												<td width='13%'><input type="text" name="iva4" id="iva4" class="form-control " ></td>
											</tr>
											<tr>
												<td >Stock Minimo</td>
												<td width='13%'><input type="text" name="minimo" id="minimo" class="form-control " ></td>
												<td >Stock Maximo</td>
												<td width='13%'><input type="text" name="maximo" id="maximo" class="form-control " ></td>
												<td >Costo F.O.B us$</td>
												<td width='13%'><input type="text" name="costo" id="costo" class="form-control " ></td>
												<td >Venta F.O.B u$</td>
												<td width='13%'><input type="text" name="venta" id="venta" class="form-control " ></td>
											</tr>
										</table>
							</div>							
						</form>						
					</div>
				</div>
			</div>
		</div>

<!-- Modal BUSCAR Linea-->
	<div id="myModalBuscar" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:40%">
			<!-- Modal content-->
			<div class="modal-content" id="lisProductos">
				
			</div>
		</div>
	</div>
