<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; //$tipo_documento=$_GET['tipo_doc']?>
       <div class="card">
            <div class="card-header">                         
                    <h4><b>Entrada a Bodega</b></h4>                                                                         
            </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" name="cotizacionEB" method="post" id="frm_CotizacionEB" autocomplete="off" action='<?php echo getUrl("EntradaBodega", "EntradaBodega", "RegistarEntradaBodega")  ?>' >
                        
                            <br>
                            <div class="container">
                                <div class="col-xs-2 left">
                                    <table> 
										<tr>
											<td><a href="<?php echo getUrl("EntradaBodega", "EntradaBodega", "borar"); ?>" class="btn btn-primary" title="Nuevo"><span class="fa fa-file"></span></a></td>
                                            <td><button type="submit" class="btn btn-primary" name="RegEB" id="RegEB" style='cursor:pointer;' value="Guardar" /><i class="fa fa-save" aria-hidden="true"></i></button> 
                                            </td>                                               
                                            <td><button type="button" class="btn btn-primary" name="btnBuscarDocGeneral" data-td='EB' data-url='<?php echo getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax")  ?>' 
												id="btnBuscarDocGeneral" style='cursor:pointer;' value="Buscar" /><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </td>
										   <td><a href="#" data-url="<?php echo getUrl('EntradaBodega','EntradaBodega','getEliminarEntradaBodega')?>" type="button" id="elimiEntradaBodega" 
												class="btn btn-primary" title="Borrar Marcas"><i class="fa fa-trash-alt" aria-hidden="true"></i></a></td>
                                        </tr>
									</table>
								</div>
                            </div>
                            
                            
                    
                                <div class="container-fluid">

									<div class="mt-4 row">
										
									
									<div class="col-sm-6">
										<div class="row">
											<div class="offset-sm-1">
												<label for="tipo_documento" style='margin-top: 6px;'>No</label>
											</div>

											<div class="col-sm-4">
												<input type="number"  readonly id="numEB" name="numEB" class='form-control' value="<?php echo $num_doc; ?>">
											</div>
										</div>
									</div>
                                        
                                        <?php
                                        
                                            if($usua_perfil==1)
                                            {
												echo"
												<div class='col-sm-6'>
												<div class='mb-4 row'>
													<div class='offset-sm-4'>
														<label for='nid_sede' style='margin-top: 6px;'>Sede</label>
													</div>

												<div class='col-sm-6'>
													<select name='nit_sede' id='nit_sede' class='form-control' data-nombre_campo='numEB' data-url='".getUrl("Utilidades", "Utilidades", "BuscarConsecutivoSede", false, "ajax")."'>";
                                                echo"<option value=''>Seleccione Sede</option>";
                                                foreach($sedes as $sede)
                                                {
                                                    echo"<option value='".$sede[0]."'>".$sede[1]."</option>";
                                                }
                                                echo"</select>";
                                            }
                                            else
                                            {
                                                echo"<input type='hidden' name='nit_sede' id='nit_sede' value='$nit_Empresa_sede'>";
                                                echo'</div></div></div>';
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
											
                            
                            
                            
                            <br>
								<table class='table table-table-hover'>
								<thead>
									<tr>
										<th bgcolor="#337ab7" colspan="8" style="color:white;">Entradas a Bodega</th>
									</tr>
								</thead>   
								<tbody>
									<tr>
										<td>Proveedor</td>
											<td colspan="">
												<select name="proveedor" id="proveedor" class="form-control" data-url="<?php echo getUrl('EntradaBodega', 'EntradaBodega', 'BuscarDatosProveedor', false, 'ajax'); ?>" >
														<option>....</option>
													<?php
													foreach($proveedores as $proveedor)
													{													
														echo"<option value='".$proveedor[0]."'>".$proveedor[1]."</option>";
													}
													?>
												</select>
											</td>
										<td>Nit</td>
										<td><input type="text" readonly name="nit" id="nit" class="form-control"></td>
										<td>Direccion</td>
										<td><input type="text" readonly class="form-control" id="dir" name="dir"></td>
										<td>Telefono</td>
										<td><input type="text" readonly name="tel" id="tel" class="form-control"></td>
									</tr>                               
								</table>
								<table class='table table-table-hover' >
									<tr>       									
										<td>Ciudad</td>
										<td><input type="text" readonly name="ciudad"  id="ciudad" class="form-control"></td>
										<td>No Pedido</td>
										<td><input type="text" name="pedido"  id="pedido" class="form-control"></td>
										<td>Bodega</td>
											<td>
											<select name="bodega" id="bodega" class="form-control"> 											
												<?php
												foreach($bodegas as $bodega)
												{
													echo"<option value='".$bodega[0]."'>".$bodega[1]."</option>";
												}
												?>
											</select>
										</td>
									</tr>
									<tr>									
										<td>Doc Cruce</td>
										<td><select name="doc"  id="doc" class="form-control">
										        <option value="">Seleccione</option>
    										    <option value="Factura de Compra">Factura de Compra</option>
    										    <option value="Remision">Remision</option>
    										    <option value="Cuenta de Cobro">Cuenta de Cobro</option>
										    </select>
										</td>
										<td>Numero</td>
										<td><input type="text" name="numero"  id="numero" class="form-control"></td>
										<td>Fecha</td>
										<td><input type="date" name="fecha"  id="fecha" class="form-control"></td>
									</tr>
								</tbody>
								</table>   
								<table  class='table table-table-hover'>							   
									<tr bgcolor="#337ab7" colspan="6" style="color:white;">
											
											<th>Producto</th>
											<th>Cantidad</th>
											<th>Valor Unitario</th>
											<th>Valor Total</th>
											<td align='center'><button type="button" name="btn_agregarFilaEB" id="btn_agregarFilaEB" class="btn btn-primary" title='Adicionar filar' data-fila='1' ><i>+</i></button></td>
									</tr>							   
									 <tbody id='Detalle_EB'> 
										<tr class='tr_EB'>
											<td width='40%'>
												<input type="hidden" name="producto_id[]" id="producto_id0">
												<input type="hidden" name="un[]" id="un0">
												<input type="hidden" name="iva[]" id="iva0">
												<input type='text' name='producto[]' id='producto0' class='form-control listproducto_EB' data-fila="0" data-url="<?php echo getUrl('EntradaBodega', 'EntradaBodega', 'BuscarProductoServicio', false,'ajax'); ?>"/></td>
											<td width='15%'><p align="right"><input type='number' name='cant[]' id='cant0' class='form-control'/></p></td>
											<td width='15%'><input type='number' name='valor[]' id='valor0' data-fila='0' class='form-control calcula_subtotalEB'/></td>
											<td width='15%'><input type='number' name='subtotal_pro[]' id='subtotal_pro0' class='form-control'/></td>
											<td align='center'><button type="button" name="btn_eliminarEB" id="btn_eliminarEB" class="btn btn-danger eliminar" title='Eliminar fila' ><i class="fa fa-trash-alt"></i></button></td>
										</tr>
									
										<input type="hidden" name="cta_campos" id="cta_campos" value="0">
												
										
									</tbody>									  
								</table>	
								
								<div id="resulProductos" ></div>
								<div class="row col-lg-12">
								<div class="col-lg-9 ">
								<table class='table table-table-hover'>
									<tr>									
										<td>Grupo</td>
										<td><input type="text" name="grupo"  id="grupo" class="form-control" readonly></td>
										<td>Marca</td>
										<td><input type="text" name="marca"  id="marca" class="form-control" readonly></td>
										<td>Unidad Medida</td>
										<td><input type="text" name="unidad"  id="unidad" class="form-control" readonly></td>
									</tr>
									<tr>									
										<td>Existencia</td>
										<td><input type="text" name="exis"  id="exis" class="form-control" readonly></td>
										<td>Dto Maximo</td>
										<td><input type="text" name="dtom"  id="dtom" class="form-control" readonly></td>
										<td>Ultimo Costo</td>
										<td><input type="text" name="ultcosto"  id="ultcosto" class="form-control" readonly></td>
									</tr>
								</tbody>
								</table>
								</div>							
										      

										<div class="col-lg-3">
											<table class='table table-table-hover' width="50%">
												<tr>
													<td>Subtotal</td>
													<td><input type="number" name="subtotal" id="subtotal" readonly class="form-control" value="0"></td>
												</tr>
												<tr>
													<td>Total Iva</td>
													<td><input type="number" name="tiva" id="tiva" readonly class="form-control" value="0"></td>
												</tr>
												<tr>
													<td>Total General</td>
													<td><input type="number" name="tdoc"  id="tdoc" readonly class="form-control" value="0"></td>
												</tr>
											</table>  
										</div>
								</div>
								<br>
								<div class="modal fade" id="VerDatos">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
											  <h3 class="modal-title">Datos Adicionales</h3>                  
											</div>
											<div class="modal-body">
											  <div id='div_Datos_Adicionales'>
												
											  </div>
											</div>
											<div class="modal-footer">                  
											  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											</div>
										</div>
									</div>	
                       
						</form> 
                    </div>  <!-- /.row (nested) -->
                </div> <!-- /.panel-body -->
            </div> 
        </div>
</div>

