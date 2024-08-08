<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; $tipo_documento=$_GET['tipo_doc']?>
<div id="page-wrapper"> 
          
    <!-- /.row -->
    <div class="row">
       <div class="card">
            <div class="card-header">                         
                    <h4><b>Entrada a Bodega</b></h4>                                                                         
            </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" name="cotizacionEB" method="post" id="frm_CotizacionEB" autocomplete="off" action='<?php echo getUrl("EntradaBodega", "EntradaBodega", "RegistarEntradaBodega")  ?>' >
                            <?php foreach($cabeceraEB as $cabecera){}   ?>
                            <br>
                            <div class="container">
                                <div class="col-xs-2 left">
                                    <table> 
										<tr>
											<td><a href="index.php?modulo=EntradaBodega&controlador=EntradaBodega&funcion=crearEntradaBodega" class="btn btn-primary" title="Nueva Entrada a Bodega"><i class="fa fa-file" aria-hidden="true"></i></a></td>
												
                                            <td><button type="submit" class="btn btn-primary" name="RegEB" id="RegEB" style='cursor:pointer;' value="Guardar" title="Guardar Entrada a Bodega" /><i class="fa fa-save" aria-hidden="true"></i></button> 
                                            </td>  
                                            
                                            <td><button type="button" class="btn btn-primary" name="btnBuscarDocGeneral" id="btnBuscarDocGeneral" data-td='EB' data-url='<?php echo getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax")  ?>' 
											    style='cursor:pointer;' value="Buscar" /><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-primary" name="elimiEntradaBodega" id="elimiEntradaBodega" title="Anular Entrada a Bodega" data-td='EB' data-url='<?php echo getUrl('EntradaBodega','EntradaBodega','AnularEntradaBodega',false, "ajax")  ?>' 
											     style='cursor:pointer;' value="Eliminar" /><i class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-primary" name="ImprimirGER" title="Imprimir Entrada a Bodega"  id="ImprimirESB" style='cursor:pointer;' value="Imp" /> <i class="fa fa-print" aria-hidden="true"></i></button>
                                            </td>
                                            
                                            <td><button type="button" class="btn btn-primary" name="VerDatosEB" title="Ver Datos Adicionales" data-url='<?php echo getUrl("EntradaBodega", "EntradaBodega", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosEB" style='cursor:pointer;' value="Ver Datos A." />
                                                <i class="fa fa-search-plus" aria-hidden="true"></i></button>
                                            </td>

                                        </tr>
									</table>
								</div>
                            </div>
                            
                            
                            
                            
                             <div class="col-xs-4 center">
                                </div>
                    
                                <div class="container">
                                    
                                    <div class="col-xs-1" style="margin:8px 0 0 0%;width:30px; float:left; text-align:left;">
                                        No<input type="hidden" id="tipo_documento" name="tipo_documento" value="EB">
                                    </div>
                                        
                                        <div class="col-xs-2"><input type="number"  readonly id="numEB" name="numEB" class='form-control' value="<?php echo $cabecera[9]; ?>"></div>
                                        <?php
                                        
                                            if($usua_perfil==1)
                                            {
                                                echo"<div class='col-xs-1' style='margin:8px 0 0 0%; margin:8px 0 0 0%;width:45px; float:left; text-align:left;'>Sede</div>
                                                <div class='col-xs-3'><select name='nit_sede' id='nit_sede' class='form-control' data-nombre_campo='numEB' data-url='".getUrl("Utilidades", "Utilidades", "BuscarConsecutivoSede", false, "ajax")."'>";
                                                echo"<option value=''>Seleccione Sede</option>";
                                                $seleccion="";
                                                foreach($sedes as $sede)
                                                {
                                                    if($sede[0]==$cabecera[11])
                                                    {
                                                        $seleccion="selected";
                                                    }
                                                    echo"<option value='".$sede[0]."' $seleccion>".$sede[1]."</option>";
                                                    $seleccion="";
                                                }
                                                echo"</select>";
                                            }
                                            else
                                            {
                                                echo"<input type='hidden' name='nit_sede' id='nit_sede' value='<?php echo $cabecera[11]; ?>'>";
                                                echo'<div class="col-xs-3 center"></div>';
                                            }
                                        ?>
                                        
                                       
                                        
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
													$seleccion="";
													foreach($proveedores as $proveedor)
													{		
													    if($cabecera[0]==$proveedor[0])
													    {
													        $seleccion="selected";
													    }
														echo"<option value='".$proveedor[0]."' $seleccion>".$proveedor[1]."</option>";
														$seleccion="";
													}
													?>
												</select>
											</td>
										<td>Nit</td>
										<td><input type="text" readonly name="nit" id="nit" class="form-control"value='<?php echo $cabecera[0]; ?>'></td>
										<td>Direccion</td>
										<td><input type="text" readonly class="form-control" id="dir" name="dir" value='<?php echo $cabecera[2]; ?>'></td>
										<td>Telefono</td>
										<td><input type="text" readonly name="tel" id="tel" class="form-control" value='<?php echo $cabecera[3]; ?>'></td>
									</tr>                               
								</table>
								<table class='table table-table-hover' >
									<tr>       									
										<td>Ciudad</td>
										<td><input type="text" readonly name="ciudad"  id="ciudad" class="form-control" value='<?php echo $cabecera[4]; ?>'></td>
										<td>No Pedido</td>
										<td><input type="text" name="pedido"  id="pedido" class="form-control" value='<?php echo $cabecera[5]; ?>'></td>
										<td>Bodega</td>
											<td>
											<select name="bodega" id="bodega" class="form-control"> 											
												<?php
												$seleccion="";
												foreach($bodegas as $bodega)
												{
												    if($bodega[0]== $cabecera[6])
												    {
												        $seleccion="selected";
												    }
													echo"<option value='".$bodega[0]."' $seleccion>".$bodega[1]."</option>";
													$seleccion="";
												}
												?>
											</select>
										</td>
									</tr>
									<tr>									
										<td>Doc Cruce</td>
										<td><select name="doc"  id="doc" class="form-control">
										        <option value="<?php echo $cabecera[7]; ?>"><?php echo $cabecera[7]; ?></option>
										    </select>
										</td>
										<td>Numero</td>
										<td><input type="text" name="numero"  id="numero" class="form-control" value='<?php echo $cabecera[8]; ?>'></td>
										<td>Fecha</td>
										<td><input type="date" name="fecha"  id="fecha" class="form-control" value='<?php echo $cabecera[10]; ?>'></td>
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
									 <?php 
									    $descto=0;
									    $sbtotal=0;
									    $subt=0;
									    $i=0;
										$iva_total=0;
									    //dd($detalleEB);
									    foreach($detalleEB as $detalle){
									     $subt=$detalle[4] * $detalle[3];
									     $ivauno=$subt * ($detalle[7] / 100);
									     $iva_total+=$ivauno;
									     $sbtotal+=$subt;
									    ?>
										<tr class='tr_EB'>
											<td width='40%'>
												<input type="hidden" name="producto_id[]" id="producto_id0" value="<?php echo $detalle[0]; ?>">
												<input type="hidden" name="un[]" id="un<?php echo $i; ?>" value="<?php echo $detalle[2]; ?>">
											    <input type="hidden" name="iva[]" id="iva<?php echo $i; ?>" value="<?php echo $detalle[7]; ?>">
												<input type='text' name='producto[]' id='producto<?php echo $i; ?>' data-fila='<?php echo $i; ?>' class='form-control listproducto_EB' value="<?php echo $detalle[1]; ?>" data-url="<?php echo getUrl('EntradaBodega', 'EntradaBodega', 'BuscarProductoServicio', false,'ajax'); ?>"/></td>
											<td width='15%' style="text-align:right"><p align="right"><input type='number' name='cant[]' id='cant<?php echo $i; ?>' data-fila='<?php echo $i; ?>' class='form-control calcula_subtotalEB' value="<?php echo $detalle[3]; ?>"/></p></td>
											<td width='15%' style="text-align:right"><input type='number' name='valor[]' id='valor<?php echo $i; ?>' data-fila='<?php echo $i; ?>' class='form-control calcula_subtotalEB' value="<?php echo $detalle[4]; ?>"/></td>
											<td width='15%' style="text-align:right"><input type='number' name='subtotal_pro[]' id='subtotal_pro<?php echo $i; ?>' class='form-control' value="<?php echo $subt; ?>"/></td>
											<td align='center'><button type="button" name="btn_eliminarEB" id="btn_eliminarEB" class="btn btn-danger eliminar" title='Eliminar fila' ><i class="fa fa-trash-alt"></i></button></td>
										</tr>
									<?php
									     $i++;
									}
									
								    ?>
										<input type="hidden" name="cta_campos" id="cta_campos" value="<?php  echo $i-1; ?>">
												
										
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
								
								 <div class="col-xs-2 left">
                                        <p style='font-size:12pt'>Estado
                                           <?php
                                           if($cabecera[12]=="A")
                                           {
                                                echo"Activo";
                                           }
                                           else
                                           {
                                                echo"Inactivo";
                                           }
                                           ?>
                                        </p>
                                    </div>
								</div>							
										      
                                       
										<div class="col-lg-3">
											<table class='table table-table-hover' width="50%">
												<tr>
													<td>Subtotal</td>
													<td><input type="number" name="subtotal" id="subtotal" readonly class="form-control" value="<?php  echo $sbtotal;?>"></td>
												</tr>
												<tr>
													<td>Total Iva</td>
													<td><input type="number" name="tiva" id="tiva" readonly class="form-control" value="<?php  echo $iva_total; ?>"></td>
												</tr>
												<tr>
													<td>Total General</td>
													<td><input type="number" name="tdoc" id="tdoc" readonly class="form-control" value="<?php  echo $sbtotal + $iva_total ;?>"></td>
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
								</div>
							</div>   
                       
						</form> 
                    </div>  <!-- /.row (nested) -->
                </div> <!-- /.panel-body -->
            </div> 
        </div>
</div>

