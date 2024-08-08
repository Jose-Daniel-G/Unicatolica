<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Informe Técnico Reparación y Pruebas - Consultando</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="formEditInformeTecnico" autocomplete="off" action="<?=getUrl("Informes", "Informes", "EditarInformeTecnico", false, "ajax");  ?>">
            <?php  foreach($Informe as $informe){} ?>
            <?php  foreach($Ingreso as $ingreso){} ?>
            <?php  foreach($Cliente as $cliente){} ?>

            <?php if($informe["Estado_Documento"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

        <input type="hidden" id="tipo_documento" name="tipo_documento" value="IT">
        <input type="hidden" id="tipo_doc" name="tipo_doc" value="IT">

            <div class="container-fluid">
                <div class="pb-3 row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9">
                                <a href="<?=getUrl("Informes", "Informes", "crearInformeTecnico"); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Informe Técnico"><span class="fa fa-file"></span></a>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></button>

                                <button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosInformeTecnico" title="Ver Datos Adicionales" data-url='<?=getUrl("Informes", "Informes", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosInformeTecnico" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>

                                <a target="_blank" href="<?=getUrl("Ingresos", "Ingresos", "getCicloDeVida", array("numero_doc" => $ingreso["Numero_Ingreso"], "serie" => $ingreso["Numero_Serie"], "nit_sede" => $_GET["nit_sede"], "razon_social" => $cliente["Razon_Social"])); ?>" class="btn text-white" style="background-color: DeepPink;" title="Ir al Ciclo de Vida"><span class="fa fa-recycle"></span></a>

                                <button type="button" class="btn text-white" style="background-color: Gainsboro;" name="PdfInformeTecnico" title="Exportar a PDF"  id="PdfInformeTecnico"><i class="fa fa-file-pdf"></i></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Gold;" title="Exportar a Word" name="WordInformeTecnico" id="WordInformeTecnico"><i class="fa fa-file-word"></i></button>

                                <button type="button" class="btn text-white" style="background-color: IndianRed;" title="Exportar a Excel" name="ExcelInformeTecnico" id="ExcelInformeTecnico"><i class="fa fa-file-excel"></i></button>
                            </div>
                            <div class="col-3">
                                <font color="<?=$Estilo ?>"><?=$estado; ?></font>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
						<span class="font-weight-bold" style="font-size: 20px;">N°&nbsp;<?=$informe["Numero_Documento"];?></span>
						<input type="hidden" id="numInforme" name="numInforme" value="<?=$informe["Numero_Documento"];?>">
					</div>
    			</div>
    
                <div class="pt-3 pb-3 row">

                <?php if ($usua_perfil == 1): ?>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit_sede">Sede</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="sede_nombre" class="form-control" readonly value="<?=$informe["Sede"];?>">
                                <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$informe["Nit_Empresa"];?>">
                            </div>
                            <?php else: ?>
						    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$informe["Nit_Empresa"];?>">
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="col-3">
						<div class="row">
							<div class="p-0 col-2">
								<label for="Fecha_Doc">Fecha</label>
							</div>
							<div class="col-6">
								<input type="text" name="Fecha_Doc" id="Fecha_Doc" class="form-control" style="font-size: 17px;" value="<?=$informe["Fecha_Documento"]; ?>" readonly>
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
                                <select name="nit_empresa" id="nit_empresa" class="form-control select2" 
                                    data-url="<?=getUrl("Utilidades", "Utilidades", "BuscarDatosCliente", false, "ajax"); ?>"
                                    data-urlplanta="<?=getUrl("Cotizaciones", "Cotizaciones", "ListarPlantaCliente", false, "ajax"); ?>"
                                    data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>" disabled>
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($empresas as $empresa): ?>
									<?php if ($empresa["Nit_Cliente"] == $informe["Nit_Cliente"]): ?>
									<option value="<?=$empresa["Nit_Cliente"];?>" selected><?=$empresa["Razon_Social"];?></option>
									<?php else: ?>
									<option value="<?=$empresa["Nit_Cliente"];?>"><?=$empresa["Razon_Social"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                </select>
                                <input type="hidden" name="nit_empresa" value="<?=$informe["Nit_Cliente"]; ?>">
                            </div>
                        </div>
                    </div>

					<?php  foreach($Ingreso as $ingreso){} ?>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="num_ingreso">N°&nbsp;Ingreso</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="num_ingreso" id="num_ingreso" class="form-control" type-of-view="ver" data-urlDetalle="<?=getUrl("Informes", "Informes", "cargarDetalleRevisionIngreso", false, "ajax"); ?>" value="<?=$ingreso["Numero_Ingreso"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="Ingeniero_Planta">Ing.&nbsp;de&nbsp;Planta</label>
                            </div>
                            <div class="col-8">
                                <select class="form-control select2" id="Ingeniero_Planta" name="Ingeniero_Planta" disabled>
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($Ingeniero as $ingeniero): ?>
									<?php if ($ingeniero["Cedula_Empleado"] == $informe["Ingeniero_Planta"]): ?>
									<option value="<?=$ingeniero["Cedula_Empleado"];?>" selected><?=$ingeniero["Nombre_Completo"];?></option>
									<?php else: ?>
									<option value="<?=$ingeniero["Cedula_Empleado"];?>"><?=$ingeniero["Nombre_Completo"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
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
                    <div class="col-3">
                        <div class="align-items-center row">
                            <div class="col-5">
                                <label for="causaFalla">Causa&nbsp;de&nbsp;la&nbsp;falla:</label>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn far fa-list-alt fa-2x" data-toggle="modal" data-target="#modalCausaFalla" title="Observaciones para la Causa de la falla"></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="row">
                            <div class="p-0 col-5 offset-3">
                                <label class="font-weight-bold">Resultado</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="row">
                            <div class="p-0 col-5 offset-10">
                                <label class="font-weight-bold">Realizada</label>
                            </div>
                        </div>
                    </div>
                </div>
                        
                <div class="modal fade" id="modalCausaFalla" tabindex="-1" role="dialog" aria-labelledby="modalCausaFalla" aria-hidden="true" data-backdrop="false" style="margin-top: 250px; margin-left: 50px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <textarea name="Observaciones_Causa_Falla" id="Observaciones_Causa_Falla" rows="5" class="form-control" readonly><?=$informe["Observaciones_Causa_Falla"]; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" title="Guardar">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <table id="tablaRevisionIngreso" class="table-bordered table-hover" width="100%;">

                        <thead class="table text-white bg-primary thead-primary">
                            <tr>
                                <th>Parte Revisada</th>
                                <th>B</th>
                                <th>M</th>
                                <th>Acción Correctiva</th>
                                <th>S</th>
                                <th>N</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>
                </div>

				<div class="pt-3 pb-3 row">
                    <div class="col-8">
                        <div class="align-items-center row">
                            <div class="col-2">
                                <label for="Observaciones">Observaciones:</label>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn far fa-list-alt fa-2x" data-toggle="modal" data-target="#modalObservacionesInspeccion" title="Observaciones para la Inspección"></button>
                            </div>
                        </div>
                    </div>
				</div>

                <div class="modal fade" id="modalObservacionesInspeccion" tabindex="-1" role="dialog" aria-labelledby="modalObservacionesInspeccion" aria-hidden="true" data-backdrop="false" style="margin-top: 250px; margin-left: 50px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <textarea name="Observaciones_Inspeccion" id="Observaciones_Inspeccion" rows="5" class="form-control" readonly><?=$informe["Observaciones_Inspeccion"]; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" title="Guardar">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-3 row">
                    <div class="col-4">
                        <div class="col-12">
                            <div class="pb-3 border row">
                                <div class="header-blue">
                                    <label>Pruebas Eléctricas</label>
                                </div>
    
                                <div class="col-12">
                                    <div class="pt-2 row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-7">
                                                    <label for="">Volt. de Prueba</label>
                                                </div>
                                                <div class="p-0 col-5">
                                                    <input type="text" name="Volt_Prueba" id="Volt_Prueba" class="form-control" value="<?=$informe["Volt_Prueba"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">Hipot&nbsp;mA</label>
                                                </div>
                                                <div class="p-0 col-5">
                                                    <input type="text" name="Hipot_mA" id="Hipot_mA" class="form-control" value="<?=$informe["Hipot_mA"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row">
    
                                        <div class="text-center col-12">
                                            <label>SURGE&nbsp;(IMPULSO)</label>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Surge_Impulso_F1">F1</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Surge_Impulso_F1" id="Surge_Impulso_F1" class="form-control" value="<?=$informe["Surge_Impulso_F1"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Surge_Impulso_F2">F2</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Surge_Impulso_F2" id="Surge_Impulso_F2" class="form-control" value="<?=$informe["Surge_Impulso_F2"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Surge_Impulso_F3">F3</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Surge_Impulso_F3" id="Surge_Impulso_F3" class="form-control" value="<?=$informe["Surge_Impulso_F3"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="pt-2 row">
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="Volt_Prueba2">Volt.&nbsp;de&nbsp;Prueba</label>
                                                </div>
                                                <div class="pr-2 pl-0 col-4">
                                                    <input type="text" name="Volt_Prueba2" id="Volt_Prueba2" class="form-control" value="<?=$informe["Volt_Prueba2"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="pt-2 row">
                                        <div class="col-12">
                                            <div class="align-items-center row">
                                                <div class="col-3">
                                                    <label for="">R.&nbsp;Aisl.</label>
                                                </div>
                                                <div class="col-7">
                                                    <input type="text" name="R_Aisl_Gohm" id="R_Aisl_Gohm" class="form-control" value="<?=$informe["R_Aisl_Gohm"]; ?>" readonly>
                                                </div>
                                                <div class="p-0 col-2">
                                                    <button type="button" class="btn far fa-list-alt fa-2x" data-toggle="modal" data-target="#modalPruebasElectricas" title="Observaciones para las Pruebas Eléctricas"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="modal fade" id="modalPruebasElectricas" tabindex="-1" role="dialog" aria-labelledby="modalPruebasElectricas" aria-hidden="true" data-backdrop="false" style="margin-top: 400px; margin-left: -280px;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <textarea name="Observaciones_Pru_elec" id="Observaciones_Pru_elec" rows="5" class="form-control" readonly><?=$informe["Observaciones_Pru_elec"]; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal" title="Guardar">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="col-12">
                            <div class="pb-3 border row">
                                <div class="header-blue">
                                    <label>Análisis Vibracional (Vel/Pulg/Seg)</label>
                                </div>
    
                                <div class="col-12">
                                    <div class="justify-content-end pt-2 row">
                                        <div class="col-4 text-center">
                                            <label>L.C</label>
                                        </div>
                                        <div class="col-4 text-center">
                                            <label>L.O.C</label>
                                        </div>
                                    </div>

                                    <div class="pt-2 row">
                                        <div class="col-12">
                                            <div class="align-items-center row">
                                                <div class="col-4">
                                                    <label for="Axial_Lc">AXIAL</label>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Axial_Lc" id="Axial_Lc" class="form-control" value="<?=$informe["Axial_Lc"]; ?>" readonly>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Axial_Loc" id="Axial_Loc" class="form-control" value="<?=$informe["Axial_Loc"]; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="align-items-center pt-2 row">
                                                <div class="col-4">
                                                    <label for="Vertical_Lc">VERTICAL</label>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Vertical_Lc" id="Vertical_Lc" class="form-control" value="<?=$informe["Vertical_Lc"]; ?>" readonly>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Vertical_Loc" id="Vertical_Loc" class="form-control" value="<?=$informe["Vertical_Loc"]; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="align-items-center pt-2 row">
                                                <div class="col-4">
                                                    <label for="Horizontal_Lc">HORIZONTAL</label>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Horizontal_Lc" id="Horizontal_Lc" class="form-control" value="<?=$informe["Horizontal_Lc"]; ?>" readonly>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Horizontal_Loc" id="Horizontal_Loc" class="form-control" value="<?=$informe["Horizontal_Loc"]; ?>" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="pt-2 row">
                                        <div class="col-12">
                                            <div class="justify-content-end row">
                                                <div class="p-0 col-2">
                                                    <button type="button" class="btn far fa-list-alt fa-2x" data-toggle="modal" data-target="#modalAnalisisVibracional" title="Observaciones para el Análisis Vibracional"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="modal fade" id="modalAnalisisVibracional" tabindex="-1" role="dialog" aria-labelledby="modalAnalisisVibracional" aria-hidden="true" data-backdrop="false" style="margin-top: 400px; margin-left: 120px;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <textarea name="Observaciones_Analisis_Vib" id="Observaciones_Analisis_Vib" rows="5" class="form-control" readonly><?=$informe["Observaciones_Analisis_Vib"]; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal" title="Guardar">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
    
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="col-12">
                            <div class="pb-3 border row">
                                <div class="header-blue">
                                    <label>Pruebas Sin Carga</label>
                                </div>
    
                                <div class="col-12">
                                    <div class="pt-2 row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="text-center col-12">
                                                    <label for="Ten_De_Pruebas">Ten.&nbsp;de&nbsp;Prueba</label>
                                                    <input type="text" name="Ten_De_Pruebas" id="Ten_De_Pruebas" class="form-control" value="<?=$informe["Ten_De_Pruebas"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="row">
                                                <div class="text-center col-12">
                                                    <label for="">Conexión</label>
                                                    <select class="form-control select2" id="Conexion" name="Conexion" disabled>
                                                        <?php
                                                        $options = array(
                                                            "valor" => "Seleccione ...", "Y/2Y", "D/Y", "D/2D", "Y", 
                                                            "D", "Dos Velocidades", "Tres Velocidades", 
                                                            "Part Winding", "Dahlander", "Tres Velocidades (Dahlander)",
                                                            "Especial"
                                                        );
                                                        ?>
                                                        <?php foreach ($options as $valor): ?>
                                                        <?php if($informe["Conexion"] == $valor): ?>
                                                            <option value="<?=$informe["Conexion"];?>" selected><?=$informe["Conexion"];?></option>
                                                        <?php else: ?>
                                                            <option value="<?=$valor;?>"><?=$valor;?></option>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="pt-4 row">
    
                                        <div class="text-center col-12">
                                            <label>Corriente</label>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Corriente_F1">F1</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Corriente_F1" id="Corriente_F1" class="form-control" value="<?=$informe["Corriente_F1"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Corriente_F2">F2</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Corriente_F2" id="Corriente_F2" class="form-control" value="<?=$informe["Corriente_F2"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Corriente_F3">F3</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Corriente_F3" id="Corriente_F3" class="form-control" value="<?=$informe["Corriente_F3"]; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-3 row">
                                        <div class="col-12">
                                            <div class="justify-content-end row">
                                                <div class="p-0 col-2">
                                                    <button type="button" class="btn far fa-list-alt fa-2x" data-toggle="modal" data-target="#modalPruebasSinCarga" title="Observaciones para las Pruebas Sin Carga"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="modal fade" id="modalPruebasSinCarga" tabindex="-1" role="dialog" aria-labelledby="modalPruebasSinCarga" aria-hidden="true" data-backdrop="false" style="margin-top: 400px; margin-left: 420px;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <textarea name="Observaciones_Pru_Sin_Carga" id="Observaciones_Pru_Sin_Carga" rows="5" class="form-control" readonly><?=$informe["Observaciones_Pru_Sin_Carga"]; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal" title="Guardar">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
    
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pt-3 row">
                    <div class="col-1">
                        <label for="vendedor">Responsable</label>
                    </div>
                    <div class="col-4">
                        <select class="form-control select2" id="Cedula_Responsable" name="Cedula_Responsable" disabled>
                                <option value="">Seleccione ...</option>
                                <?php foreach ($responsable as $responsables): ?>
                                <?php if ($responsables["Cedula_Empleado"] == $informe["Cedula_Responsable"]): ?>
                                <option value="<?=$responsables["Cedula_Empleado"];?>" selected><?=$responsables["Nombre_Completo"];?></option>
                                <?php else: ?>
                                <option value="<?=$responsables["Cedula_Empleado"];?>"><?=$responsables["Nombre_Completo"];?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                        </select>
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