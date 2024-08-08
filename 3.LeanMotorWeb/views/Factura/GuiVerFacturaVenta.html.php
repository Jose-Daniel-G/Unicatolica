<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">
    <div class="card-header">
        <h4>
            <b>Facturas de Venta - Consultando</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="formViewFactura" autocomplete="off">
        <?php  foreach($cabeceraFVC as $cabecera){} ?>
        <?php  foreach($ingresosFVC as $ingreso){} ?>

        <input type="hidden" name="tipo_doc" id="tipo_doc" value="<?=$_GET["tipo_doc"];?>">

        <?php if($cabecera["Estado_Documento"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-9">
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></button>

                                <button type="button" class="btn text-white" style="background-color: Indigo;" name="cotizacionesAsociadas" title="Cotizaciones Asociadas" id="cotizacionesAsociadas" data-url="<?=getUrl("Factura", "Factura", "cotizacionesAsociadas", false, "ajax"); ?>">
                                    <i class="fa fa-plus"></i>
                                </button>

                                <button type="button" class="btn text-white" style="background-color: Gainsboro;" name="PdfFVC" title="Exportar a PDF"  id="PdfFVC"><i class="fa fa-file-pdf"></i></button>

                                <button type="button" class="btn text-white" style="background-color: Gold;" title="Exportar a Word" name="WordFVC" id="WordFVC"><i class="fa fa-file-word"></i></button>

                                <button type="button" class="btn text-white" style="background-color: IndianRed;" title="Exportar a Excel" name="ExcelFVC" id="ExcelFVC"><i class="fa fa-file-excel"></i></button>

                                <button type="button" class="btn text-white" class="btn text-white" style="background-color: Red;" name="AnularFactura" title="Anular Factura"  data-url='<?=getUrl("Factura", "Factura", "AnularFactura", false, "ajax")  ?>' id="AnularFactura" value="Anular"><i class="fa fa-trash-alt"></i></button>
                            </div>

                            <div class="col-3">
                                <font color="<?php echo $Estilo ?>"><?php echo $estado; ?></font>
                            </div>
                        </div>
                    </div>
    			</div>

                <div class="border-top pt-3 pb-3 row">
					<div class="border col-5">
						<div class="row">
							<label class="header-blue">Tipo de Factura</label>
							<div class="col-12">
								<div class="row">
                                <?php if ($cabecera["Dias_Plazo"] > 0) {$credito="checked"; $contado=null;} else {$contado="checked"; $credito=null;}?>
									<div class="col-4">
										<div class="row">
											<div class="col-1">
												<input type="radio" name="tipo_factura" id="tipo_factura" value="Contado" <?=$contado;?> disabled>
											</div>
											<div class="p-0 col-6">
												<label for="tipo_factura">Contado</label>
											</div>
										</div>
									</div>

									<div class="col-3">
										<div class="row">
											<div class="col-1">
												<input type="radio" name="tipo_factura" id="tipo_factura" value="Credito" <?=$credito;?> disabled>
											</div>
											<div class="p-0 col-6">
												<label for="tipo_factura">Crédito</label>
											</div>
										</div>
									</div>

									<div class="col-5">
										<div class="row">
											<div class="col-3">
												<label for="plazo">Plazo</label>
											</div>
											<div class="col-6">
												<input type="text" name="plazo" id="plazo" class="form-control" value="<?=$cabecera["Dias_Plazo"]; ?>" readonly>
											</div>
											<div class="p-0 col-1">
												<label>Días</label>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>

					<div class="border col-6 offset-1">

					    <div class="pt-3 pb-3 row">
					        <div class="col-6">
					            <div class="row">
					                <div class="col-4">
                						<label for="numFVC">Número</label>
                					</div>
                
                					<div class="col-8">
                						<input class="form-control" id="numFVC" name="numFVC" value="<?=$cabecera["Numero_Documento"]; ?>" readonly>
                					</div>
					            </div>
					        </div>
        
                            <div class="col-6">
        						<div class="row">
        							<div class="col-3">
        								<label for="Fecha_Documento">Fecha</label>
        							</div>
        							<div class="col-7">
        								<input type="text" name="Fecha_Documento" id="Fecha_Documento" class="form-control" style="font-size: 17px;" value="<?=substr($cabecera["Fecha_Documento"], 0, 10);?>" readonly>
        							</div>
        						</div>
        					</div>
					    </div>

					    <div class="row">
					        <div class="col-6">
					            <div class="row">
					                <div class="col-4">
                						<label for="numCT">Número Cotización</label>
                					</div>
                
                					<div class="col-8">
                						<input class="form-control" id="numCT" name="numCT" value="<?=$cabecera["Numero_Cotizacion"]; ?>" readonly>
                					</div>
					            </div>
					        </div>
        
                            <div class="col-6">
                                <div class="row">
                                    <?php if ($usua_perfil == 1): ?>
                                    <div class="col-3">
                                        <label for="nit_sede">Sede</label>
                                    </div>
                                    <div class="p-0 col-8">
                                        <?php foreach ($sedes as $sede): ?>
                                        <input type="text" name="sede_nombre" class="form-control" readonly value="<?=$sede["nombre"];?>">
                                        <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$cabecera["NIT_Empresa"];?>">
                                        <?php endforeach;?>
                                    </div>
                                    <?php else: ?>
                                    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$cabecera["NIT_Empresa"];?>">
                                    <?php endif;?>
                                </div>
                            </div>
					    </div>
					</div>
					
				</div>

                <div class="pt-3 row">
    
                    <div class="header-blue">
                        <label>Datos del Cliente</label>
                    </div>
    
                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit_empresa">Empresa</label>
                            </div>
                            <div class="col-10">
                                <select name="nit_empresa" id="nit_empresa" class="form-control" 
                                    data-url="<?=getUrl("Utilidades", "Utilidades", "BuscarDatosCliente", false, "ajax"); ?>"
                                    data-urlplanta="<?=getUrl("Cotizaciones", "Cotizaciones", "ListarPlantaCliente", false, "ajax"); ?>"
                                    data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>" disabled>
                                    <option value=""></option>
                                    <?php foreach ($empresas as $empresa): ?>
									<?php if ($empresa["Nit_Cliente"] == $cabecera["Nit_Cliente"]): ?>
									<option value="<?=$empresa["Nit_Cliente"];?>" selected><?=$empresa["Razon_Social"];?></option>
									<?php else: ?>
									<option value="<?=$empresa["Nit_Cliente"];?>"><?=$empresa["Razon_Social"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="planta">Planta</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control" id="planta" name="planta" 
                                    data-urlcontacto="<?=geturl("Utilidades","Utilidades", "BuscarContactoCliente", false, "ajax"); ?>" disabled>
                                    <?php if(!empty($plantas)): ?>
                                    <option value=""></option>
									<?php foreach ($plantas as $planta): ?>
									<?php if ($planta["Codigo_Planta"] == $cabecera["Codigo_Planta"]): ?>
									<option value="<?=$planta["Codigo_Planta"];?>" selected><?=$planta["Nombre"];?></option>
									<?php else: ?>
									<option value="<?=$planta["Codigo_Planta"];?>"><?=$planta["Nombre"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
									<?php else: ?>
									<option value="0"></option>
									<?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit">Nit</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="nit" id="nit" class="form-control" value="<?=$cabecera["Nit_Cliente"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
    
                </div>
    
                <div class="border-top row">
                    <?php if(!empty($ingreso["Orden_Servicio"])){$orden_servicio=$ingreso["Orden_Servicio"];}else{$orden_servicio=null;} ?>
                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="orden_servicio">Orden&nbsp;Servicio</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="orden_servicio" name="orden_servicio" value="<?=$orden_servicio;?>" readonly>
                            </div>
                        </div>
                    </div>

                    <?php if(!empty($ingreso["Detalle_De_Equipo"])){$detalle_equipo=$ingreso["Detalle_De_Equipo"];}else{$detalle_equipo=null;} ?>
                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" value="<?=$detalle_equipo; ?>" maxlength="100" readonly>
                            </div>
                        </div>
                    </div>

                     <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="dir_empresa">Dirección</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="dir_empresa" name="dir_empresa" value="<?=$cabecera["Direccion"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div class="border-top row">

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="tel_empresa1">Teléfono1</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" value="<?=$cabecera["Telefono1"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="tel_empresa2">Teléfono2</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="tel_empresa2" id="tel_empresa2" value="<?=$cabecera["Telefono2"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="vendedor">Vendedor</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control" id="vendedor" name="vendedor" disabled>
                                    <option value=""></option>
                                    <?php foreach ($vendedor as $vendedores): ?>
									<?php if ($vendedores["Cedula_Empleado"] == $cabecera["Cedula_Empleado"]): ?>
									<option value="<?=$vendedores["Cedula_Empleado"];?>" selected><?=$vendedores["Nombre_Completo"];?></option>
									<?php else: ?>
									<option value="<?=$vendedores["Cedula_Empleado"];?>"><?=$vendedores["Nombre_Completo"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-12 header-blue">
                        <div class="row">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="producto1">Producto o Servicio</label>
                                    </div>

                                    <div class="col-6">
                                        <label for="detalle1">Detalle</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="cant1">Cantidad</label>
                                    </div>

                                    <div class="col-3">
                                        <label for="valor1">Valor</label>
                                    </div>

                                    <div class="col-3">
                                        <label for="desc1">% Desc</label>
                                    </div>

                                    <div class="col-3">
                                        <label for="subtotal1">Sub Total</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  
                    $subt=0;
                    $tsubt=0;
                    $i=1;
                    $dsto=0;
                    $tdsto=0;
                    $tiva=0;
                ?>
                <div id="Detalle_GER">

                    <div id="options_productos" style="display: none;">
                        <option value=""></option>
                        <?php foreach ($servicios as $servicio): ?>
                        <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                        <?php endforeach;?>
                    </div>

                    <?php foreach($detalleFVC as $detalle){
                        $valor_Bruto=$detalle["Valor_Unitario"] * $detalle["Cantidad"];
                        if($detalle["Porcentaje_Descuento"] > 0){
                            $destouno=$valor_Bruto   * ($detalle["Porcentaje_Descuento"]/100);
                            $subt= $valor_Bruto - $destouno;   
                        }
                        else{
                            $destouno=0;
                            $subt= $valor_Bruto;
                        }

                        $tsubt+=$subt;
                        $tdsto+=$destouno;
                        $tiva+= $detalle["Valor_Iva"];
                    ?>

                    <div class="pt-2 pb-2 fila_DetalleGER row">

                        <div class="col-7">
                            <div class="row">
                                <input type="hidden" name="numCT[]" value="<?=$detalle["Numero_Cotizacion"]; ?>">
                                <?php if ($detalle["Numero_Ingreso"] != ""): ?>
                                <input type="hidden" name="no_ingreso[]" value="<?=$detalle["Numero_Ingreso"]; ?>">
                                <?php else: ?>
                                <input type="hidden" name="no_ingreso[]" value="<?=null; ?>">
                                <?php endif; ?>
                                <div class="col-6">
                                    <select name="producto[]" id="producto<?=$i;?>" class="form-control productos_servicios" 
                                    data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "obtenerIvaProductoServicio", false, "ajax");  ?>" disabled>
                                        <option value=""></option>
                                        <?php foreach ($servicios as $servicio): ?>
                                        <?php if ($servicio["Codigo"] == $detalle["Codigo_Producto"]): ?>
                                        <option value="<?=$servicio["Codigo"];?>" selected><?=$servicio["Descripcion"];?></option>
                                        <?php else: ?>
                                        <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="p-0 col-6">
                                    <input type="text" name="detalle[]" id="detalle<?=$i;?>" class="form-control" value="<?=$detalle["Detalle"]; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="row">
                                <div class="col-3">
                                    <input type="number" name="cant[]" id="cant<?=$i;?>" class="form-control text-center cantDetalle" value="<?=$detalle["Cantidad"]; ?>" readonly>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="valor[]" id="valor<?=$i;?>" class="format number form-control text-right valorDetalle" value="<?=$detalle["Valor_Unitario"]; ?>" readonly>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="desc[]" id="desc<?=$i;?>" class="form-control text-center descDetalle" value="<?=$detalle["Porcentaje_Descuento"]; ?>" readonly>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="subtotal[]" id="subtotal<?=$i;?>" class="format form-control subtotalDetalle text-right" value="<?=$subt ;?>" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php
                $i++;
                }
                ?>
                </div>

                 <div class="pt-3 pb-3 align-items-center row">
                    <div class="col-9">

                        <div class="pb-4 row">
                            <div class="col-2">
								<label for="Orden_Compra">Orden&nbsp;de&nbsp;Compra</label>
							</div>
							<div class="col-9">
								<input class="form-control" name="Orden_Compra" id="Orden_Compra" maxlength="100" value="<?=$cabecera["Orden_Compra"];?>" readonly>
							</div>
                        </div>

                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="observacionesFactura">Observaciones</label>
                            </div>
                            <div class="col-9">
                                <textarea name="observacionesFactura" id="observacionesFactura" class="form-control" rows="3" cols="70"><?=$cabecera["Observaciones"]; ?></textarea>
                            </div>
                            <div class="text-center p-0 col-1" id="iconoEditarObservacionesFactura" style="display: none;">
                                <button type="button" class="btn btn-primary" data-url="<?=getUrl("Factura", "Factura", "actualizarObservacionesFactura", false, "ajax"); ?>">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <p class="text-primary font-weight-bold">Editar</p>
                            </div>
                        </div>

                    </div>

                    <div class="border col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="subtotal_doc">Sub Total</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="subtotal_doc" id="subtotal_doc" class="format form-control text-right" value="<?=$cabecera["Subtotal"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="tiva">Total&nbsp;IVA</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tiva" id="tiva" class="format form-control text-right" value="<?=$cabecera["Iva"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="tdoc">Total&nbsp;Factura</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tdoc" id="tdoc" class="format form-control text-right" value="<?=$cabecera["Total"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
                 </div>

            </div>

            <!--MODAL ADICIONAR DATOS-->
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

        </form>
    </div>
    
</div>

<div class="modal fade" id="modalCotizacionesAsociadas">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 45%;">
        <div class="modal-content">

            <div class="text-center modal-header">
                <h3 class="w-100 modal-title">Cotizaciones Asociadas</h3>
                <button type="button" class="close" data-dismiss="modal" title="Cerrar">
                    <i class="fa fa-window-close fa-2x text-danger"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablaModalCotizacionesAsociadas" class="table-bordered table-hover" width="100%;">

                        <thead class="table text-white bg-primary thead-primary">
                            <tr>
                                <th>N° de Documento</th>
                                <th>N° de Ingreso</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>