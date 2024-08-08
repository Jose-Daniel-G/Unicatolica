<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Gasto Directo de Fabricación - Consultando</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="formEditGastoDirecto" autocomplete="off" action="<?=getUrl("GastosDirectos", "GastosDirectos", "EditarGastoDirectoFabricacion", false, "ajax");  ?>">
        <?php  foreach($Gasto as $gasto){} ?>
        <?php  foreach($ingresosGD as $ingreso){} ?>
        <?php  foreach($Cliente as $cliente){} ?>

        <?php if($gasto["Estado_Documento"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

        <input type="hidden" id="tipo_documento" name="tipo_documento" value="GD">
        <input type="hidden" id="tipo_doc" name="tipo_doc" value="GD">

            <div class="container-fluid">
				<div class="row">
                    <div class="col-6">
                        <div class="pb-3 align-items-center row">
                            <div class="p-0 col-9">
                                <a href="<?=getUrl("GastosDirectos", "GastosDirectos", "crearGastoDirectoFabricacion"); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Gasto Directo"><span class="fa fa-file"></span></a>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></button>

                                <button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosGD" title="Ver Datos Adicionales" data-url='<?=getUrl("GastosDirectos", "GastosDirectos", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosGD" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>

                                <a target="_blank" href="<?=getUrl("Ingresos", "Ingresos", "getCicloDeVida", array("numero_doc" => $ingreso["Numero_Ingreso"], "serie" => $ingreso["Numero_Serie"], "nit_sede" => $_GET["nit_sede"], "razon_social" => $cliente["Razon_Social"])); ?>" class="btn text-white" style="background-color: DeepPink;" title="Ir al Ciclo de Vida"><span class="fa fa-recycle"></span></a>
                                
                                <button type="button" class="btn text-white" style="background-color: Gainsboro;" name="PdfGastoDirecto" title="Exportar a PDF"  id="PdfGastoDirecto"><i class="fa fa-file-pdf"></i></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Gold;" title="Exportar a Word" name="WordGastoDirecto" id="WordGastoDirecto"><i class="fa fa-file-word"></i></button>

                                <button type="button" class="btn text-white" style="background-color: IndianRed;" title="Exportar a Excel" name="ExcelGastoDirecto" id="ExcelGastoDirecto"><i class="fa fa-file-excel"></i></button>
                            </div>
                            <div class="col-3">
                                <font color="<?=$Estilo ?>" id="estadoGastoDirecto"><?=$estado; ?></font>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6">
                                <span class="font-weight-bold" style="font-size: 20px;">N°&nbsp;<?=$gasto["Numero_Documento"];?></span>
                                <input type="hidden" id="numGD" name="numGD" value="<?=$gasto["Numero_Documento"];?>">
                            </div>
                        </div>
                    </div>
    			</div>
    
                <div class="pt-3 pb-3 row">

                    <?php if ($usua_perfil == 1): ?>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit">Sede&nbsp;*</label>
                            </div>
                            <div class="col-9">
                            <?php foreach ($sedes as $sede): ?>
                                <input type="text" name="sede_nombre" class="form-control" readonly value="<?=$sede["nombre"];?>">
                                <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$gasto["Nit_Empresa"];?>">
						        <?php endforeach;?>
                            </div>
                            <?php else: ?>
						    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$gasto["Nit_Empresa"];?>">
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="p-0 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="Fecha_Doc">Fecha</label>
							</div>
							<div class="col-9">
								<input type="text" name="Fecha_Doc" id="Fecha_Doc" class="form-control" style="font-size: 17px;" value="<?=substr($gasto["Fecha_Documento"],0,10); ?>" readonly>
							</div>
						</div>
					</div>
    
    			</div>
    
                <div class="pt-3 pb-3 datoscliente row">
                
                    <div class="header-blue">
                        <label>Datos del Cliente</label>
                    </div>
    
                    <div class="col-7">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit_empresa">Empresa&nbsp;*</label>
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
								<label for="no_ingreso">N°&nbsp;Ingreso&nbsp;*</label>
							</div>
							<div class="col-8">
                                <input type="text" name="no_ingreso" id="no_ingreso" class="form-control" value="<?=$gasto["Numero_Ingreso"]; ?>" readonly>
							</div>
						</div>
					</div>
                </div>

                <div class="border-top pt-3 pb-3 datoscliente row">

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
                                <input type="text" name="nom_equipo" id="nom_equipo" class="form-control" readonly value="<?=$ingreso["Equipo"]; ?>">
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
                                <input type="text" name="nom_tipo" id="nom_tipo" class="form-control" readonly value="<?=$ingreso["Tipo_Equipo"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nom_marca">Marca</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="nom_marca" id="nom_marca" class="form-control" readonly value="<?=$ingreso["Marca"]; ?>">
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
                                <input type="text" name="serie" id="serie" class="form-control" readonly value="<?=$ingreso["Numero_Serie"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-3">
                                <label for="fases">Fases</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="fases" id="fases" class="form-control" readonly value="<?=$ingreso["No_Fases"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-4">
                                <label for="potencia">Potencia</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="potencia" id="potencia" class="form-control" readonly value="<?=$ingreso["Potencia"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-3">
                                <label for="rpm">R.P.M</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="rpm" id="rpm" class="form-control" readonly value="<?=$Velocidad; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="voltaje">Voltaje</label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="voltaje" id="voltaje" class="form-control" readonly value="<?=$Voltaje; ?>">
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
                                <input type="text" name="frame" id="frame" class="form-control" readonly value="<?=$ingreso["Frame"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="ubicacion">Ubicación</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="ubicacion" id="ubicacion" class="form-control" readonly value="<?=$ingreso["Ubicacion"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="p-0 col-4">
                                <label for="orden_servicio">Orden&nbsp;Servicio</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="orden_servicio" id="orden_servicio" class="form-control" readonly value="<?=$ingreso["Orden_Servicio"]; ?>">
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
								<input type="text" name="Fecha_Gasto" id="Fecha_Gasto" class="form-control" style="font-size: 17px;" value="<?=substr($gasto["Fecha_Gasto"], 0, 10); ?>" readonly>
							</div>
						</div>
					</div>
					
					<div class="col-3">
						<div class="row">
							<div class="col-2">
								<label for="Total">Valor</label>
							</div>
							<div class="col-8">
								<input type="text" name="Total" id="Total" class="form-control format" value="<?=$gasto["Total"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="Desc_Tipo_Iva">Tipo&nbsp;de&nbsp;IVA</label>
							</div>
							<div class="col-7">
								<select name="Desc_Tipo_Iva" id="Desc_Tipo_Iva" class="form-control" disabled>
									<option value=""></option>
                                    <?php foreach ($tipos_iva as $tipo_iva): ?>
									<?php if ($tipo_iva["Id_Iva"] == $gasto["Id_Iva"]): ?>
									<option value="<?=$tipo_iva["Descripcion"];?>" selected><?=$tipo_iva["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$tipo_iva["Descripcion"];?>"><?=$tipo_iva["Descripcion"];?></option>
									<?php endif; ?>
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
								<input type="text" name="NoDocumentoCruce" id="NoDocumentoCruce" class="form-control" value="<?=$gasto["NoDocumentoCruce"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-5">
						<div class="row">
							<div class="col-5">
								<label for="TipoDocumentoCruce">Tipo&nbsp;Documento&nbsp;Cruce</label>
							</div>
							<div class="col-6">
								<select name="TipoDocumentoCruce" id="TipoDocumentoCruce" class="form-control" disabled>
                                    <?php
                                        $option = array(
                                            "", "Factura", "Remision", "Cuenta de Cobro"
                                        );
                                        $valor = array(
                                            "", "FV", "RM", "CC"
                                        );
                                    ?>
                                    <?php foreach ($option as $index => $texto): ?>
                                    <?php if ($gasto["TipoDocumentoCruce"] == $valor[$index]): ?>
                                    <option value="<?=$valor[$index];?>" selected><?=$texto;?></option>
									<?php else: ?>
									<option value="<?=$valor[$index];?>"><?=$texto;?></option>
									<?php endif; ?>
                                    <?php endforeach; ?>
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
								<select name="Codigo_Cuenta_Contable" id="Codigo_Cuenta_Contable" class="form-control" disabled>
									<option value=""></option>
                                    <?php foreach($cuentasGasto as $cuentaGasto): ?>
                                    <?php if ($gasto["Codigo_Cuenta_Contable"] ==$cuentaGasto["Codigo_Cuenta"]): ?>
                                    <option value="<?=$cuentaGasto["Codigo_Cuenta"];?>" selected><?=$cuentaGasto["Nombre_Cuenta"];?></option>
									<?php else: ?>
									<option value="<?=$cuentaGasto["Codigo_Cuenta"];?>"><?=$cuentaGasto["Nombre_Cuenta"];?></option>
									<?php endif; ?>
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
								<select name="Unidad_Negocio" id="Unidad_Negocio" class="form-control" disabled>
									<option value=""></option>
                                    <?php foreach($unidadesNegocio as $unidadNegocio): ?>
                                    <?php if ($gasto["Unidad_Negocio"] ==$unidadNegocio["Codigo"]): ?>
                                    <option value="<?=$unidadNegocio["Codigo"];?>" selected><?=$unidadNegocio["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$unidadNegocio["Codigo"];?>"><?=$unidadNegocio["Descripcion"];?></option>
									<?php endif; ?>
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
						<textarea name="Detalle" id="Detalle" rows="5" class="form-control" readonly><?=$gasto["Detalle"]; ?></textarea>
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