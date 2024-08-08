<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Orden de Trabajo FM-03 - Consultando</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" autocomplete="off">
        <?php  foreach($Orden as $orden){} ?>
        <?php  foreach($ingresoOrden as $ingreso){} ?>
        <?php  foreach($Cliente as $cliente){} ?>

        <?php if($orden["Estado"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>
        <input type="hidden" id="tipo_documento" name="tipo_documento" value="OT">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="pb-3 align-items-center row">
                            <div class="col-10">
                                <a href="<?=getUrl("OrdenTrabajo", "OrdenTrabajo", "crearOrdenTrabajo"); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nueva Orden de Trabajo"><span class="fa fa-file"></span></a>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></button>

                                <button type="button" class="btn text-white" style="background-color: SpringGreen;" name="btnBuscarIngresos" data-url='<?php echo getUrl("Utilidades", "Utilidades", "ModalBuscarIngresos", false, "ajax");  ?>' id="btnBuscarIngresos" value="Buscar" title="Buscar Ordenes de Ingreso"><i class="fa fa-search"></i></button>

                                <button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosOrdenTrabajo" title="Ver Datos Adicionales" data-url='<?=getUrl("OrdenTrabajo", "OrdenTrabajo", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosOrdenTrabajo" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>

                                <a target="_blank" href="<?=getUrl("Ingresos", "Ingresos", "getCicloDeVida", array("numero_doc" => $ingreso["Numero_Ingreso"], "serie" => $ingreso["Numero_Serie"], "nit_sede" => $_GET["nit_sede"], "razon_social" => $cliente["Razon_Social"])); ?>" class="btn text-white" style="background-color: DeepPink;" title="Ir al Ciclo de Vida"><span class="fa fa-recycle"></span></a>

                                <button type="button" class="btn text-white" style="background-color: Gainsboro;" name="PdfOrdenTrabajo" title="Exportar a PDF"  id="PdfOrdenTrabajo"><i class="fa fa-file-pdf"></i></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Gold;" title="Exportar a Word" name="WordOrdenTrabajo" id="WordOrdenTrabajo"><i class="fa fa-file-word"></i></button>

                                <button type="button" class="btn text-white" style="background-color: IndianRed;" title="Exportar a Excel" name="ExcelOrdenTrabajo" id="ExcelOrdenTrabajo"><i class="fa fa-file-excel"></i></button>
                            </div>
                            <div class="col-2">
                                <font color="<?=$Estilo ?>" id="estadoOrdenTrabajo"><?=$estado; ?></font>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6">
                                <?php if($orden["Tipo_Orden"] == "R"): ?>
                                <span class="font-weight-bold" style="font-size: 20px;" id="estadoReproceso">Reproceso</span>
                                <?php endif; ?>
                            </div>

                            <div class="col-6">
                                <span class="font-weight-bold" id="numOrden" style="font-size: 20px;">N°&nbsp;<?=$orden["Numero_Orden"];?></span>
                                <input type="hidden" id="numero_orden" name="numOrden" value="<?=$orden["Numero_Orden"];?>">
                                <input type="hidden" id="Orden_Maestra" name="Orden_Maestra" value="<?=$orden["Numero_Orden"];?>">
                            </div>
                        </div>
                    </div>
    			</div>
    
                <div class="pt-3 pb-3 row">

                    <?php if ($usua_perfil == 1): ?>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit">Sede&nbsp;</label>
                            </div>
                            <div class="col-9">
                            <?php foreach ($sedes as $sede): ?>
                                <input type="text" name="sede_nombre" class="form-control" readonly value="<?=$sede["nombre"];?>">
                                <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$orden["Nit_Empresa"];?>">
						        <?php endforeach;?>
                            </div>
                            <?php else: ?>
						    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$orden["Nit_Empresa"];?>">
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="col-2">
						<div class="pt-2 pb-2 row">
							<div class="p-0 col-2">
                                <?php if ($orden["Garantia"] == "S"): ?>
                                <input class="form-control" name="Garantia" id="Garantia" type="checkbox" style="width: 20px; margin: -5px 20px;" checked disabled>
								<?php else: ?>
								<input class="form-control" name="Garantia" id="Garantia" type="checkbox" style="width: 20px; margin: -5px 20px;" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Garantia">Garantía</label>
							</div>
						</div>
					</div>

                    <div class="p-0 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="Fecha_Doc">Fecha</label>
							</div>
							<div class="col-9">
								<input type="text" name="Fecha_Doc" id="Fecha_Doc" class="form-control" style="font-size: 17px;" value="<?=$orden["Fecha_Creada"]; ?>" readonly>
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
                                <label for="nit_empresa">Empresa&nbsp;</label>
                            </div>
                            <div class="col-10">
                                <select name="nit_empresa" id="nit_empresa" class="form-control" 
                                    data-url="<?=getUrl("Utilidades", "Utilidades", "BuscarDatosCliente", false, "ajax"); ?>"
                                    data-urlplanta="<?=getUrl("Cotizaciones", "Cotizaciones", "ListarPlantaCliente", false, "ajax"); ?>"
                                    data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>" disabled>
                                    <option value=""></option>
                                    <?php foreach ($empresas as $empresa): ?>
									<?php if ($empresa["Nit_Cliente"] == $ingreso["Nit_Cliente"]): ?>
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
							<div class="col-4">
								<label for="no_ingreso">N°&nbsp;Ingreso&nbsp;</label>
							</div>
							<div class="col-8">
                                <input type="text" name="no_ingreso" id="no_ingreso" class="form-control" value="<?=$orden["Numero_Ingreso"]; ?>" readonly>
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
									<?php if ($planta["Codigo_Planta"] == $ingreso["Codigo_Planta"]): ?>
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
                                <input type="text" name="nit" id="nit" class="form-control" readonly value="<?=$cliente["Nit_Cliente"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="dir_empresa">Dirección</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="dir_empresa" name="dir_empresa" readonly value="<?=$cliente["Direccion"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="tel_empresa1">Teléfono</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" readonly value="<?=$cliente["Telefono1"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="ciudad_empresa">Ciudad</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" name="ciudad_empresa" id="ciudad_empresa" readonly value="<?=$cliente["Ciudad"]; ?>">
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
                                        <input type="text" name="nom_tipo" id="nom_tipo" class="form-control" value="<?=$ingreso["Tipo_Equipo"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-4">
                                <div class="pt-3 row">
                                    <div class="col-2">
                                        <label for="equipo">Equipo</label>
                                    </div>
                                    
                                    <div class="col-10">
                                        <input type="text" name="nom_equipo" id="nom_equipo" class="form-control" value="<?=$ingreso["Equipo"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="pt-3 row">
                                    <div class="col-2">
                                        <label for="nom_marca">Marca</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="nom_marca" id="nom_marca" class="form-control" value="<?=$ingreso["Marca"]; ?>" readonly>
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
                                        <input type="text" name="serie" id="serie" class="form-control" value="<?=$ingreso["Numero_Serie"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-9">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" value="<?=$ingreso["Detalle_De_Equipo"]; ?>" maxlength="100" readonly>
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
                                        <input type="text" name="frame" id="frame" class="form-control" value="<?=$ingreso["Frame"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="fases">Fases</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="fases" id="fases" class="form-control" value="<?=$ingreso["No_Fases"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="potencia">Potencia</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="potencia" id="potencia" class="form-control" value="<?=$ingreso["Potencia"]; ?>" readonly>
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
                                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="<?=$ingreso["Ubicacion"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-5">
                                <div class="pt-3 pb-3 row">
                                    <div class="col-3">
                                        <label for="orden_servicio">Orden&nbsp;Servicio</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="orden_servicio" id="orden_servicio" class="form-control" value="<?=$ingreso["Orden_Servicio"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                        
                    </div>
                </div>

                <div class="border-top pt-3 pb-3 row">
					<div class="col-12">
						<div class="row">
							<div class="col-2">
								<label for="Requisitos_Cliente">Req's del cliente</label>
							</div>
							<div class="col-10">
								<input class="form-control" type="text" name="Requisitos_Cliente" id="Requisitos_Cliente" value="<?=$ingreso["Requisitos_Cliente"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>

                <div class="row">
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

                <div id="Detalle_General">
                <?php foreach($DetalleOrden as $detalle): ?>

                    <div class="pt-2 pb-2 fila_Detalle_General row">

                        <div class="col-11">
                            <div class="row">
                                <div class="col-5">
                                    <select name="producto_Editar[]" id="producto<?=$i;?>" class="form-control productos_servicios" disabled>
                                        <option value=""></option>
                                        <?php foreach ($servicios as $servicio): ?>
                                        <?php if ($servicio["Codigo"] == $detalle["Codigo_Actividad"]): ?>
                                        <option value="<?=$servicio["Codigo"];?>" selected><?=$servicio["Descripcion"];?></option>
                                        <?php else: ?>
                                        <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-7">
                                    <input type="text" name="detalle_Editar[]" id="detalle<?=$i;?>" class="form-control" value="<?=$detalle["Detalle_Actividad"]; ?>" readonly>
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

				<div class="pt-3 pb-3 row">
					<div class="col-6">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-2">
										<label for="Creada_Por">Creada&nbsp;por&nbsp;</label>
									</div>
									<div class="col-9">
                                        <select class="form-control" id="Creada_Por" name="Creada_Por" disabled>
                                            <option value=""></option>
                                            <?php foreach ($Empleado as $Empleados): ?>
                                            <?php if ($Empleados["Cedula_Empleado"] == $orden["Creada_Por"]): ?>
                                            <option value="<?=$Empleados["Cedula_Empleado"];?>" selected><?=$Empleados["Nombre_Completo"];?></option>
                                            <?php else: ?>
                                            <option value="<?=$Empleados["Cedula_Empleado"];?>"><?=$Empleados["Nombre_Completo"];?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
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
										<label for="Armado_Por">Armado&nbsp;por&nbsp;</label>
									</div>
									<div class="col-9">
                                        <select class="form-control" id="Armado_Por" name="Armado_Por" disabled>
                                            <option value=""></option>
                                            <?php foreach ($Empleado as $Empleados): ?>
                                            <?php if ($Empleados["Cedula_Empleado"] == $orden["Armado_Por"]): ?>
                                            <option value="<?=$Empleados["Cedula_Empleado"];?>" selected><?=$Empleados["Nombre_Completo"];?></option>
                                            <?php else: ?>
                                            <option value="<?=$Empleados["Cedula_Empleado"];?>"><?=$Empleados["Nombre_Completo"];?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

                <div id="fechaLimiteFormula" class="row" style="display: none;">
                    <div class="col-12">
                        <h5 class="text-center">Fecha + Prioridad - 1</h5>
                    </div>

                    <div class="col-12">
                        <table class="table-bordered table-hover">
                            <thead class="table text-white bg-primary thead-primary">
                                <tr>
                                    <th>Fecha OT</th>
                                    <th>Prioridad en la Cotización</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="text-center w-50" style="font-size: 17px;"><?=substr($orden["Fecha_Creada"],0,10); ?></td>
                                    <td class="text-center w-50" style="font-size: 17px;"><?=$Detalle[0]["Prioridad"]; ?></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="pt-3 pb-3 row">
                    <div class="col-8">
                        <span class="font-weight-bold" data-toggle="popover" data-html="true" title='<div class="text-center">Formúla (F.L.E)</div>'>
                        Fecha límite de entrega <?=$fechaEntrega; ?></span>
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
$(document).ready(function () {
    $('[data-toggle="popover"]').popover({
        trigger: "hover",
        html : true,
        content: () => {
            return $("#fechaLimiteFormula").html();
        }
    });
});
</script>