<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Gasto Directo de Fabricación</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="gastoDirectoReg" autocomplete="off" action="<?=getUrl("GastosDirectos", "GastosDirectos", "RegistrarGastoDirecto", false, "ajax");  ?>">

        <input type="hidden" id="tipo_documento" name="tipo_documento" value="GD">
        <input type="hidden" id="tipo_doc" name="tipo_doc" value="GD">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-5">
                        <div class="pb-3 row">
                            <div class="col-12">
                                <a href="<?=getUrl("GastosDirectos", "GastosDirectos", "crearGastoDirectoFabricacion"); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Gasto Directo"><span class="fa fa-file"></span></a>
                                
                                <button type="submit" class="btn btn-primary" name="RegGD" id="RegGD" value="Guardar" title="Grabar Gasto Directo"><li class="fa fa-save"></li></button>
                                
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
									<?php else: ?>
									<option value="<?=$sede["nit_empresa"];?>"><?=$sede["nombre"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                    <?php endif;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
    			</div>
    
                <div class="pt-3 pb-3 datoscliente row">
                
                    <div class="header-blue">
                        <label>Datos del Cliente</label>
                    </div>
    
                    <?php if (empty($_GET["nit_cliente"])): ?>
                    <div class="col-7">
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
                    <div class="col-7">
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
									<?php else: ?>
									<option value="<?=$empresa["Nit_Cliente"];?>"><?=$empresa["Razon_Social"];?></option>
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
								<select class="form-control select2" name="no_ingreso" id="no_ingreso" 
								data-url="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarDatosIngreso", false, "ajax"); ?>" required>
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
								<select class="form-control select2" name="num_ingreso" id="num_ingreso" 
								data-url="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarDatosIngreso", false, "ajax"); ?>">
								<option value="">Seleccione ...</option>
								<?php foreach ($Ingresos as $ingreso): ?>
								<?php if ($ingreso["Numero_Ingreso"] == $_GET["num_ingreso"]): ?>
								<option value="<?=$ingreso["Numero_Ingreso"];?>" selected><?=$ingreso["Numero_Ingreso"];?></option>
								<?php else: ?>
								<option value="<?=$ingreso["Numero_Ingreso"];?>"><?=$ingreso["Numero_Ingreso"];?></option>
								<?php endif; ?>
								<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<?php endif; ?>
                </div>

                <div class="border-top pt-3 pb-3 datoscliente row">

                     <div class="p-0 col-2">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit">Nit</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="nit" id="nit" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="dir_empresa">Dirección</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="dir_empresa" name="dir_empresa" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="tel_empresa1">Teléfono</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="ciudad_empresa">Ciudad</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" name="ciudad_empresa" id="ciudad_empresa" readonly>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div class="pt-3 pb-3 row">

                    <div class="header-blue">
                        <label>Datos del Ingreso</label>
                    </div>

                    <div class="col-5">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="equipo">Equipo</label>
                            </div>
                            
                            <div class="col-9">
                                <input type="text" name="nom_equipo" id="nom_equipo" class="form-control" readonly>
                                <input type="hidden" name="equipo" id="equipo">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="tipo">Tipo</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nom_tipo" id="nom_tipo" class="form-control" readonly>
                                <input type="hidden" name="tipo" id="tipo">
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nom_marca">Marca</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="nom_marca" id="nom_marca" class="form-control" readonly>
                                <input type="hidden" name="marca" id="marca">
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

                <div class="border-top pt-3 pb-3 row">

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="frame">Frame</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="frame" id="frame" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="ubicacion">Ubicación</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="ubicacion" id="ubicacion" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="p-0 col-4">
                                <label for="orden_servicio">Orden&nbsp;Servicio</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="orden_servicio" id="orden_servicio" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                </div>

				<div class="pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
							<div class="col-4">
								<label for="Fecha_Gasto">Fecha&nbsp;Gasto</label>
							</div>
							<div class="p-0 col-4">
								<?php date_default_timezone_set('America/Bogota'); ?>
								<input type="text" name="Fecha_Gasto" id="Fecha_Gasto" class="form-control datepicker" value="<?=date("Y-m-d"); ?>" readonly>
							</div>
						</div>
					</div>
					
					<div class="col-3">
						<div class="row">
							<div class="col-2">
								<label for="Total">Valor</label>
							</div>
							<div class="col-8">
								<input type="text" name="Total" id="Total" class="form-control format">
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="Desc_Tipo_Iva">Tipo&nbsp;de&nbsp;IVA</label>
							</div>
							<div class="col-7">
								<select name="Desc_Tipo_Iva" id="Desc_Tipo_Iva" class="form-control select2">
									<option value="">Seleccione ...</option>
                                    <?php foreach($tipos_iva as $tipo_iva): ?>
                                    <option value="<?=$tipo_iva["Descripcion"];?>"><?=$tipo_iva["Descripcion"];?></option>
                                    <?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="pt-3 pb-3 row">
					<div class="col-4">
						<div class="row">
							<div class="col-5">
								<label for="NoDocumentoCruce">No&nbsp;Documento&nbsp;Cruce</label>
							</div>
							<div class="col-6">
								<input type="text" name="NoDocumentoCruce" id="NoDocumentoCruce" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-5">
						<div class="row">
							<div class="col-5">
								<label for="TipoDocumentoCruce">Tipo&nbsp;Documento&nbsp;Cruce</label>
							</div>
							<div class="col-6">
								<select name="TipoDocumentoCruce" id="TipoDocumentoCruce" class="form-control select2">
									<option value="">Seleccione ...</option>
                                    <option value="FV">Factura</option>
                                    <option value="RM">Remisión</option>
                                    <option value="CC">Cuenta de Cobro</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="pt-3 pb-3 row">
					<div class="col-5">
						<div class="row">
							<div class="col-3">
								<label for="Codigo_Cuenta_Contable">Cuenta&nbsp;Gasto</label>
							</div>
							<div class="col-8">
								<select name="Codigo_Cuenta_Contable" id="Codigo_Cuenta_Contable" class="form-control select2">
									<option value="">Seleccione ...</option>
                                    <?php foreach($cuentasGasto as $cuentaGasto): ?>
                                    <option value="<?=$cuentaGasto["Codigo_Cuenta"];?>"><?=$cuentaGasto["Nombre_Cuenta"];?></option>
                                    <?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-7">
						<div class="row">
							<div class="col-3">
								<label for="Unidad_Negocio">Unidad&nbsp;de&nbsp;Negocio</label>
							</div>
							<div class="col-9">
								<select name="Unidad_Negocio" id="Unidad_Negocio" class="form-control select2">
									<option value="">Seleccione ...</option>
                                    <?php foreach($unidadesNegocio as $unidadNegocio): ?>
                                    <option value="<?=$unidadNegocio["Codigo"];?>"><?=$unidadNegocio["Descripcion"];?></option>
                                    <?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="pt-3 pb-3 row">
					<div class="col-1">
						<label for="Detalle">Detalle</label>
					</div>
					<div class="col-11">
						<textarea name="Detalle" id="Detalle" rows="5" class="form-control"></textarea>
					</div>
				</div>
            </div>
        </form>
    </div>
    
</div>