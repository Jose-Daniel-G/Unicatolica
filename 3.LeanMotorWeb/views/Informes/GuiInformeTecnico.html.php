<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Informe Técnico Reparación y Pruebas</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="informeTecnicoReg" autocomplete="off" action="<?=getUrl("Informes", "Informes", "RegistrarInformeTecnico", false, "ajax");  ?>">

        <input type="hidden" id="tipo_documento" name="tipo_documento" value="IT">
        <input type="hidden" id="tipo_doc" name="tipo_doc" value="IT">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-5">
                        <div class="pb-3 row">
                            <div class="col-12">
                                <a href="<?=getUrl("Informes", "Informes", "crearInformeTecnico"); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Informe Técnico"><span class="fa fa-file"></span></a>
                                
                                <button type="submit" class="btn btn-primary" name="RegGER" id="RegGER" value="Guardar" title="Grabar Informe Técnico"><li class="fa fa-save"></li></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></div>
                        </div>
                    </div>
    			</div>
    
                <div class="pt-3 pb-3 row">

                    <?php if (empty($_GET["nit_sede"])): ?>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit">Sede&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <select name="nit_sede" id="nit_sede" data-campo="#nit_empresa" class="form-control" 
                                data-url="<?=getUrl("Utilidades", "Utilidades", "buscarClientesSede", false, "ajax");?>" required>
                                    <option value="">Seleccione ...</option>
                                    <?php if ($usua_perfil == 1): ?>
                                    <?php foreach ($sedes as $sede): ?>
                                        <option value="<?=$sede["nit_empresa"];?>"><?=$sede["nombre"];?></option>
                                    <?php endforeach;?>
                                    <?php else: ?>
                                    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$nit_Empresa_sede;?>">
                                    <?php endif;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit">Sede&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <select name="nit_sede" id="nit_sede" data-campo-="#nit_empresa" class="form-control" 
                                data-url="<?=getUrl("Utilidades", "Utilidades", "buscarClientesSede", false, "ajax");?>" required>
                                    <option value="">Seleccione ...</option>
                                    <?php if ($usua_perfil == 1): ?>
                                    <?php foreach ($sedes as $sede): ?>
                                    <?php if ($sede["nit_empresa"] == $_GET["nit_sede"]): ?>
									<option value="<?=$sede["nit_empresa"];?>" selected><?=$sede["nombre"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                    <?php endif;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
    
    			</div>
    
                <div class="pt-3 datoscliente row">
                
                    <div class="header-blue">
                        <label>Datos del Cliente</label>
                    </div>
    
                    <?php if (empty($_GET["nit_cliente"])): ?>
                    <div class="col-5">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit_empresa">Empresa&nbsp;*</label>
                            </div>
                            <div class="col-10">
                                <select name="nit_empresa" id="nit_empresa" class="form-control select2" 
                                    data-url="<?=getUrl("Utilidades", "Utilidades", "BuscarDatosCliente", false, "ajax"); ?>"
                                    data-urlplanta="<?=getUrl("Cotizaciones", "Cotizaciones", "ListarPlantaCliente", false, "ajax"); ?>"
                                    data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>" required>
                                    <option value="">Seleccione ...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-5">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit_emp">Empresa&nbsp;*</label>
                            </div>
                            <div class="col-10">
                                <select name="nit_emp" id="nit_emp" class="form-control select2" 
                                    data-url="<?=getUrl("Utilidades", "Utilidades", "BuscarDatosCliente", false, "ajax"); ?>"
                                    data-urlplanta="<?=getUrl("Cotizaciones", "Cotizaciones", "ListarPlantaCliente", false, "ajax"); ?>"
                                    data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>">
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($empresas as $empresa): ?>
									<?php if ($empresa["Nit_Cliente"] == $_GET["nit_cliente"]): ?>
									<option value="<?=$empresa["Nit_Cliente"];?>" selected><?=$empresa["Razon_Social"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

					<?php if(empty($_GET["num_ingreso"])): ?>
					<div class="col-3">
						<div class="pt-3 pb-3 row">
							<div class="col-4">
								<label for="no_ingreso">N°&nbsp;Ingreso&nbsp;*</label>
							</div>
							<div class="col-8">
								<select class="form-control select2" name="no_ingreso" id="no_ingreso" type-of-view="registrar" 
                                data-url="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarDatosIngreso", false, "ajax"); ?>"
								data-urlDetalle="<?=getUrl("Informes", "Informes", "cargarDetalleRevisionIngreso", false, "ajax"); ?>" required>
								<option value="">Seleccione ...</option>
								</select>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="col-3">
						<div class="pt-3 pb-3 row">
							<div class="col-4">
								<label for="num_ingreso">N°&nbsp;Ingreso&nbsp;*</label>
							</div>
							<div class="col-8">
								<select class="form-control select2" name="num_ingreso" id="num_ingreso" type-of-view="registrar" 
                                data-url="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarDatosIngreso", false, "ajax"); ?>"
                                data-urlDetalle="<?=getUrl("Informes", "Informes", "cargarDetalleRevisionIngreso", false, "ajax"); ?>">
								<option value="">Seleccione ...</option>
								<?php foreach ($Ingresos as $ingreso): ?>
								<?php if ($ingreso["Numero_Ingreso"] == $_GET["num_ingreso"]): ?>
								<option value="<?=$ingreso["Numero_Ingreso"];?>" selected><?=$ingreso["Numero_Ingreso"];?></option>
								<?php endif; ?>
								<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<?php endif; ?>
                    
                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="Ingeniero_Planta">Ing.&nbsp;de&nbsp;Planta&nbsp;*</label>
                            </div>
                            <div class="col-8">
                                <select class="form-control select2" id="Ingeniero_Planta" name="Ingeniero_Planta" required>
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($Ingeniero as $ingeniero): ?>
                                        <option value="<?=$ingeniero["Cedula_Empleado"];?>"><?=$ingeniero["Nombre_Completo"];?></option>
                                    <?php endforeach;?>
                                </select>
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
                                        <input type="text" name="nom_tipo" id="nom_tipo" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-4">
                                <div class="pt-3 row">
                                    <div class="col-2">
                                        <label for="equipo">Equipo</label>
                                    </div>
                                    
                                    <div class="col-10">
                                        <input type="text" name="nom_equipo" id="nom_equipo" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="pt-3 row">
                                    <div class="col-2">
                                        <label for="nom_marca">Marca</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="nom_marca" id="nom_marca" class="form-control" readonly>
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
                                        <input type="text" name="serie" id="serie" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-9">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" maxlength="100" readonly>
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
                                        <input type="text" name="frame" id="frame" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="fases">Fases</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="fases" id="fases" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="potencia">Potencia</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="potencia" id="potencia" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="rpm">R.P.M</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="rpm" id="rpm" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="voltaje">Voltaje</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="voltaje" id="voltaje" class="form-control" readonly>
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
                                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-5">
                                <div class="pt-3 pb-3 row">
                                    <div class="col-3">
                                        <label for="orden_servicio">Orden&nbsp;Servicio</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="orden_servicio" id="orden_servicio" class="form-control" readonly>
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
                                    <div class="p-0 col-5 offset-6">
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
                                                    <textarea name="Observaciones_Causa_Falla" id="Observaciones_Causa_Falla" rows="5" class="form-control"></textarea>
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

                <div class="container-fluid">
                    <table id="tablaRevisionIngreso" class="table-bordered table-hover" width="100%;">

                        <thead class="table text-white bg-primary thead-primary">
                            <tr>
                                <th class="d-none"></th>
                                <th>Parte Revisada&nbsp;*</th>
                                <th>B&nbsp;*</th>
                                <th>M&nbsp;*</th>
                                <th>Acción Correctiva&nbsp;*</th>
                                <th>S&nbsp;*</th>
                                <th>N&nbsp;*</th>
                                <th>Borrar</th>
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
                                            <textarea name="Observaciones_Inspeccion" id="Observaciones_Inspeccion" rows="5" class="form-control"></textarea>
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
                                                    <input type="text" name="Volt_Prueba" id="Volt_Prueba" class="form-control number">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">Hipot&nbsp;mA</label>
                                                </div>
                                                <div class="p-0 col-5">
                                                    <input type="text" name="Hipot_mA" id="Hipot_mA" class="form-control">
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
                                                    <input type="text" name="Surge_Impulso_F1" id="Surge_Impulso_F1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Surge_Impulso_F2">F2</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Surge_Impulso_F2" id="Surge_Impulso_F2" class="form-control">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Surge_Impulso_F3">F3</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Surge_Impulso_F3" id="Surge_Impulso_F3" class="form-control">
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
                                                    <input type="text" name="Volt_Prueba2" id="Volt_Prueba2" class="form-control number">
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
                                                    <input type="text" name="R_Aisl_Gohm" id="R_Aisl_Gohm" class="form-control">
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
                                                                <textarea name="Observaciones_Pru_elec" id="Observaciones_Pru_elec" rows="5" class="form-control"></textarea>
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
                                                    <input type="text" name="Axial_Lc" id="Axial_Lc" class="form-control">
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Axial_Loc" id="Axial_Loc" class="form-control">
                                                </div>
                                            </div>

                                            <div class="align-items-center pt-2 row">
                                                <div class="col-4">
                                                    <label for="Vertical_Lc">VERTICAL</label>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Vertical_Lc" id="Vertical_Lc" class="form-control">
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Vertical_Loc" id="Vertical_Loc" class="form-control">
                                                </div>
                                            </div>

                                            <div class="align-items-center pt-2 row">
                                                <div class="col-4">
                                                    <label for="Horizontal_Lc">HORIZONTAL</label>
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Horizontal_Lc" id="Horizontal_Lc" class="form-control">
                                                </div>
                                                <div class="pr-2 pl-0 col-4 text-center">
                                                    <input type="text" name="Horizontal_Loc" id="Horizontal_Loc" class="form-control">
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
                                                                <textarea name="Observaciones_Analisis_Vib" id="Observaciones_Analisis_Vib" rows="5" class="form-control"></textarea>
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
                                                    <input type="text" name="Ten_De_Pruebas" id="Ten_De_Pruebas" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="row">
                                                <div class="text-center col-12">
                                                    <label for="">Conexión</label>
                                                    <select class="form-control select2" id="Conexion" name="Conexion">
														<option value="">Seleccione ...</option>
														<option value="Y/2Y">Y/2Y</option>
														<option value="D/Y">D/Y</option>
														<option value="D/2D">D/2D</option>
														<option value="Y">Y</option>
														<option value="D">D</option>
														<option value="Dos Velocidades">Dos Velocidades</option>
														<option value="Tres Velocidades">Tres Velocidades</option>
														<option value="Part Winding">Part Winding</option>
														<option value="Dahlander">Dahlander</option>
														<option value="Tres Velocidades (Dahlander)">Tres Velocidades (Dahlander)</option>
														<option value="Especial">Especial</option>
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
                                                    <input type="text" name="Corriente_F1" id="Corriente_F1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Corriente_F2">F2</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Corriente_F2" id="Corriente_F2" class="form-control">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Corriente_F3">F3</label>
                                                </div>
                                                <div class="p-0 col-7">
                                                    <input type="text" name="Corriente_F3" id="Corriente_F3" class="form-control">
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
                                                                <textarea name="Observaciones_Pru_Sin_Carga" id="Observaciones_Pru_Sin_Carga" rows="5" class="form-control"></textarea>
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
                   <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <label for="vendedor">Responsable&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control select2" id="vendedor" name="Cedula_Responsable" data-url="<?=getUrl("Utilidades", "Utilidades", "buscarVendedorSede", false, "ajax");  ?>" required>
                                    <option value="">Seleccione ...</option>
                                </select>
                            </div>
                        </div>
                   </div>
                </div>

            </div>
        </form>
    </div>
    
</div>