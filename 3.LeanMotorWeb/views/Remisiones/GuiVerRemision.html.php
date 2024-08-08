<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Remisiones - Consultando</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" autocomplete="off">
        
        <?php foreach($cabeceraRM as $cabecera){} ?>

        <?php if($cabecera["Estado_Documento"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

        <input type="hidden" id="tipo_documento" name="tipo_documento" value="RM">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="pb-3 row">
                            <div class="col-7">
                                <a href="<?=getUrl("Remisiones", "Remisiones", "crearRemision", array("tipo_doc" => "RM")); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nueva Orden de Trabajo"><span class="fa fa-file"></span></a>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></button>

                                <button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosRM" title="Ver Datos Adicionales" data-url='<?=getUrl("Remisiones", "Remisiones", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosRM" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>

                                <a target="_blank" href="<?=getUrl("Ingresos", "Ingresos", "getCicloDeVida", array("numero_doc" => $ingresosRM[0]["Numero_Ingreso"], "serie" => $ingresosRM[0]["Numero_Serie"], "nit_sede" => $_GET["nit_sede"], "razon_social" => $cabeceraRM[0]["Razon_Social"])); ?>" class="btn text-white" style="background-color: DeepPink;" title="Ir al Ciclo de Vida"><span class="fa fa-recycle"></span></a>

                                <button type="button" class="btn text-white" style="background-color: Gainsboro;" name="PdfRM" title="Exportar a PDF"  id="PdfRM"><i class="fa fa-file-pdf"></i></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Gold;" title="Exportar a Word" name="WordRM" id="WordRM"><i class="fa fa-file-word"></i></button>

                                <button type="button" class="btn text-white" style="background-color: IndianRed;" title="Exportar a Excel" name="ExcelRM" id="ExcelRM"><i class="fa fa-file-excel"></i></button>
                            </div>
                            <div class="col-2">
                                <font color="<?=$Estilo ?>"><?=$estado; ?></font>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
						<span class="font-weight-bold" style="font-size: 20px;">N°&nbsp;<?=$cabecera["Numero_Documento"];?></span>
						<input type="hidden" id="numRM" name="numRM" value="<?=$cabecera["Numero_Documento"];?>">
					</div>
    			</div>
    
                <div class="pt-3 pb-3 align-items-center row">

                    <?php if ($usua_perfil == 1): ?>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit_sede">Sede</label>
                            </div>
                            <div class="col-9">
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

                    <div class="p-0 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="Fecha_Doc">Fecha</label>
							</div>
							<div class="col-9">
								<input type="text" name="Fecha_Doc" id="Fecha_Doc" class="form-control" style="font-size: 17px;" value="<?=substr($cabecera["Fecha_Documento"],0,10); ?>" readonly>
							</div>
						</div>
					</div>

                    <div class="border col-2">
						<div class="pt-2 row">
							<div class="col-3">
                                <?php if($detalleRM == null): ?>
								<input class="form-control" name="Tipo_Remision" id="TipoRemisionBasica" type="radio" style="width: 20px; margin: -5px 20px;" disabled checked>
                                <?php else: ?>
                                <input class="form-control" name="Tipo_Remision" id="TipoRemisionBasica" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
                                <?php endif; ?>
							</div>
							<div class="col-9">
								<label for="TipoRemisionBasica">Básica</label>
							</div>
						</div>

						<div class="row">
							<div class="col-3">
                                <?php if($detalleRM != null): ?>
								<input class="form-control" name="Tipo_Remision" id="TipoRemisionDetalle" type="radio" style="width: 20px; margin: -5px 20px;" disabled checked>
                                <?php else: ?>
                                <input class="form-control" name="Tipo_Remision" id="TipoRemisionDetalle" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
                                <?php endif; ?>
							</div>
							<div class="col-9">
								<label for="TipoRemisionDetalle">Con&nbsp;detalle</label>
							</div>
						</div>
					</div>

                    <div class="pl-5 col-4">
						<div class="border row">
							<div class="header-blue">
								<label>Esta Remisión fue:</label>
							</div>

							<div class="pt-2 pb-2 col-9">
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-4">
                                                <?php if($cabecera["TipoTrabajo"] == "G"): ?>
												<input class="form-control" name="TipoTrabajo" id="Garantia" type="radio" style="width: 20px; margin: -5px 20px;" value="G" disabled checked>
                                                <?php else: ?>
                                                <input class="form-control" name="TipoTrabajo" id="Garantia" type="radio" style="width: 20px; margin: -5px 20px;" value="G" disabled>
                                                <?php endif; ?>
											</div>
											<div class="col-7">
												<label for="Garantia">Garantía</label>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="row">
											<div class="col-4">
                                                <?php if($cabecera["TipoTrabajo"] == "D"): ?>
												<input class="form-control" name="TipoTrabajo" id="Devanado" type="radio" style="width: 20px; margin: -5px 20px;" value="D" disabled checked>
                                                <?php else: ?>
                                                <input class="form-control" name="TipoTrabajo" id="Devanado" type="radio" style="width: 20px; margin: -5px 20px;" value="D" disabled>
                                                <?php endif; ?>
											</div>
											<div class="col-7">
												<label for="Devanado">Dev.&nbsp;Sin&nbsp;reparar</label>
											</div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-4">
                                                <?php if($cabecera["TipoTrabajo"] == "O"): ?>
												<input class="form-control" name="TipoTrabajo" id="Obsequio" type="radio" style="width: 20px; margin: -5px 20px;" value="O" disabled checked>
                                                <?php else: ?>
                                                <input class="form-control" name="TipoTrabajo" id="Obsequio" type="radio" style="width: 20px; margin: -5px 20px;" value="O" disabled>
                                                <?php endif; ?>
											</div>
											<div class="col-7">
												<label for="Obsequio">Obsequio</label>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="row">
											<div class="col-4">
                                                <?php if($cabecera["TipoTrabajo"] == "F"): ?>
												<input class="form-control" name="TipoTrabajo" id="Facturado" type="radio" style="width: 20px; margin: -5px 20px;" value="F" disabled checked>
                                                <?php else: ?>
                                                <input class="form-control" name="TipoTrabajo" id="Facturado" type="radio" style="width: 20px; margin: -5px 20px;" value="F" disabled>
                                                <?php endif; ?>
											</div>
											<div class="col-7">
												<label for="Facturado">Facturado</label>
											</div>
										</div>
									</div>

								</div>
								
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-4">
                                                <?php if($cabecera["TipoTrabajo"] == "V"): ?>
												<input class="form-control" name="TipoTrabajo" id="VentaProducto" type="radio" style="width: 20px; margin: -5px 20px;" value="V" disabled checked>
                                                <?php else: ?>
                                                <input class="form-control" name="TipoTrabajo" id="VentaProducto" type="radio" style="width: 20px; margin: -5px 20px;" value="V" disabled>
                                                <?php endif; ?>
											</div>
											<div class="col-7">
												<label for="VentaProducto">Venta&nbsp;Producto</label>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="row">
											<div class="col-4">
                                                <?php if($cabecera["TipoTrabajo"] == "U"): ?>
												<input class="form-control" name="TipoTrabajo" id="Outsourcing" type="radio" style="width: 20px; margin: -5px 20px;" value="U" disabled checked>
                                                <?php else: ?>
                                                <input class="form-control" name="TipoTrabajo" id="Outsourcing" type="radio" style="width: 20px; margin: -5px 20px;" value="U" disabled>
                                                <?php endif; ?>
											</div>
											<div class="col-7">
												<label for="Outsourcing">Outsourcing</label>
											</div>
										</div>
									</div>

								</div>
							</div>
							
						</div>
					</div>
    
    			</div>
    
                <div class="pt-3 datoscliente row">
                
                    <div class="header-blue">
                        <label>Datos del Cliente</label>
                    </div>
    
                    <div class="col-5">
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

					<?php  foreach($ingresosRM as $ingresos){} ?>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="no_ingreso">N°&nbsp;Ingreso</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="no_ingreso" id="no_ingreso" class="form-control" value="<?=$ingresos["Numero_Ingreso"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="planta">Planta</label>
                            </div>
                            <div class="p-0 col-9">
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
        
                    </div>

                <div class="border-top datoscliente row">

                    <div class="p-0 col-2">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit">Nit</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="nit" id="nit" class="form-control" value="<?=$cabecera["Nit_Cliente"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="dir_empresa">Dirección</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="dir_empresa" name="dir_empresa" value="<?=$cabecera["Direccion"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="tel_empresa1">Teléfono</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" value="<?=$cabecera["Telefono1"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="ciudad_empresa">Ciudad</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" name="ciudad_empresa" id="ciudad_empresa" value="<?=$cabecera["Ciudad"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="pb-3 row">
        
                            <div class="col-12">
                                <div class="row">
                                    <div class="p-0 col-12">
                                        <div class="header-blue">
                                            <label>Datos del Ingreso</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-3">
                                <div class="pt-3 row">
                                    <div class="col-3">
                                        <label for="tipo">Tipo</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="nom_tipo" id="nom_tipo" class="form-control" value="<?=$ingresos["Tipo_Equipo"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-4">
                                <div class="pt-3 row">
                                    <div class="col-2">
                                        <label for="equipo">Equipo</label>
                                    </div>
                                    
                                    <div class="col-10">
                                        <input type="text" name="nom_equipo" id="nom_equipo" class="form-control" value="<?=$ingresos["Equipo"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="pt-3 row">
                                    <div class="col-2">
                                        <label for="nom_marca">Marca</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="nom_marca" id="nom_marca" class="form-control" value="<?=$ingresos["Marca"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
        
                        <div class="border-top pt-3 pb-3 row">
        
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="serie">N°&nbsp;Serie</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="serie" id="serie" class="form-control" value="<?=$ingresos["Numero_Serie"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-9">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" value="<?=$ingresos["Detalle_De_Equipo"]; ?>" maxlength="100" readonly>
                                    </div>
                                </div>
                            </div>
        
                        </div>
        
                        <div class="border-top pt-3 pb-3 row">

                            <div class="col-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="frame">Frame</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="frame" id="frame" class="form-control" value="<?=$ingresos["Frame"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="fases">Fases</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="fases" id="fases" class="form-control" value="<?=$ingresos["No_Fases"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="potencia">Potencia</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="potencia" id="potencia" class="form-control" value="<?=$ingresos["Potencia"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="rpm">R.P.M</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="rpm" id="rpm" class="form-control" value="<?=$Velocidad; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="voltaje">Voltaje</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="voltaje" id="voltaje" class="form-control" value="<?=$Voltaje; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                        
                        <div class="border-top row">
        
                            <div class="col-7">
                                <div class="pt-3 pb-3 row">
                                    <div class="col-2">
                                        <label for="ubicacion">Ubicación</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="<?=$ingresos["Ubicacion"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-5">
                                <div class="pt-3 pb-3 row">
                                    <div class="col-3">
                                        <label for="orden_servicio">Orden&nbsp;Servicio</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="orden_servicio" id="orden_servicio" class="form-control" value="<?=$ingresos["Orden_Servicio"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                        
                    </div>
                </div>

                <div class="Detalle_General row" style="display: none;">
                    <div class="col-12 header-blue">
                        <div class="row">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="producto1">Producto o Servicio</label>
                                    </div>

                                    <div class="col-7">
                                        <label for="detalle1">Detalle</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1">
                                <div class="row">
                                    <div class="p-0 col-3">
                                        <label for="cant1">Cantidad</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $i=1; ?>

                <div id="Detalle_General" class="Detalle_General">
                <?php foreach($detalleRM as $detalle): ?>

                    <div class="pt-2 pb-2 fila_Detalle_General row">

                        <div class="col-11">
                            <div class="row">
                                <div class="col-5">
                                    <select name="producto_Editar[]" id="producto<?=$i;?>" class="form-control productos_servicios" disabled>
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

                                <div class="col-7">
                                    <input type="text" name="detalle_Editar[]" id="detalle<?=$i;?>" class="form-control" value="<?=$detalle["Detalle"]; ?>" readonly>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-1">
                            <div class="row">
                                <div class="p-0 col-11">
                                    <input type="number" name="cant_Editar[]" id="cant<?=$i;?>" class="form-control text-center cantDetalle" value="<?=$detalle["Cantidad"]; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </div>

				<div id="Basica" style="display: none;">
					<div class="pt-3 pb-3 row">
						<div class="col-2">
							<label for="Observaciones">Observaciones</label>
						</div>
						<div class="col-10">
							<textarea name="Observaciones" id="Observaciones" class="form-control" rows="4" readonly><?=$cabecera["Observaciones"]; ?></textarea>
						</div>
					</div>
				</div>

				<div class="pt-4 pb-4 align-items-center row">
                    <div class="col-6">
                        <div class="row">
                            <div class="header-blue">
                                <label>Recibido por el Cliente</label>
                            </div>

                            <div class="col-6">
                                <div class="pt-3 pb-3 border row">
                                    <div class="col-6">
                                        <label for="fecha_EntregaRM">Fecha&nbsp;Recibido</label>
                                    </div>
                                    <div class="col-6" style="padding: 0px 8px 0px 0px !important;">
                                        <input type="text" name="Fecha_Entrega" id="fecha_EntregaRM" class="form-control" style="font-size: 17px;" placeholder="aaaa-mm-dd" 
                                        data-url="<?=getUrl("Remisiones", "Remisiones", "ActualizarFechaRecibido", false, "ajax"); ?>" value="<?=substr($cabecera["Fecha_Entrega"],0,10); ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="pt-3 pb-3 border row">
                                    <div class="col-6">
                                        <label for="tiempoE">Tiempo&nbsp;de&nbsp;Entrega</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="tiempoE" id="tiempoE" class="form-control" value="<?=$cabecera["Prioridad"]; ?>" readonly>
                                    </div>
                                    <div class="p-0 col-2">
                                        <label for="tiempoE">Días</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-6">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-2">
										<label for="Empleado">Empleado</label>
									</div>
									<div class="col-9">
										<select class="form-control" id="Empleado" name="Empleado" disabled>
											<option value=""></option>
											<?php foreach ($Empleado as $Empleados): ?>
                                            <?php if ($Empleados["Cedula_Empleado"] == $cabecera["Cedula_Empleado"]): ?>
                                            <option value="<?=$Empleados["Cedula_Empleado"];?>" selected><?=$Empleados["Nombre"];?></option>
                                            <?php else: ?>
                                            <option value="<?=$Empleados["Cedula_Empleado"];?>"><?=$Empleados["Nombre"];?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="align-items-center row">
                    <div class="col-12">
                        <div class="row" id="observacionesDetalle" style="display: none;">
                            <div class="col-2">
                                <label for="Observaciones">Observaciones</label>
                            </div>
                            <div class="col-10">
                                <textarea name="Observaciones" id="observa" class="form-control" rows="4" readonly><?=$cabecera["Observaciones"]; ?></textarea>
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

<script>
$(document).ready(function (){
    if ($("#TipoRemisionBasica").is(":checked")) {
        $(".Detalle_General").hide();
        $("#observacionesDetalle").hide();
        $("#observa").attr("disabled", true);
        $("#Basica").show();
        
        if ($("#nit_empresa").val() == "") {
            $(".fila_Detalle_General").find("input, select").each(function () {
                $(this).val("");
            });
        }
    }

    if ($("#TipoRemisionDetalle").is(":checked")) {
        $("#Basica").hide();
        $(".Detalle_General").show();
        $("#observacionesDetalle").show();
        $("#Observaciones").val("");
        $("#Observaciones").attr("disabled", true);

        if ($("#nit_empresa").val() == "") {
            $(".fila_Detalle_General").find("input, select").each(function () {
                $(this).val("");
            });
        }
    }
});
</script>