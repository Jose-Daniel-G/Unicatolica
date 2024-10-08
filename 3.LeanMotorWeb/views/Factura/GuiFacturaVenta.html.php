<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">
    <div class="card-header">
        <h4>
            <b>Facturas de Venta</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="facturaReg" action="<?=getUrl("Factura", "Factura", "RegistrarFactura", false, "ajax"); ?>" autocomplete="off">

            <input type="hidden" name="tipo_doc" id="tipo_doc" value="FVC">
            <input type="hidden" name="tipo_documento" id="tipo_documento" value="FVC">
            <?php if (!empty($_GET["num_ingreso"])): ?>
            <input type="hidden" name="numero_ingreso" id="num_ingreso" data-url="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarDatosIngreso", false, "ajax"); ?>" value="<?=$_GET["num_ingreso"]; ?>">
            <?php endif; ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" name="RegFVC" id="RegFVC" value="Guardar" title="Grabar Factura">
                                    <li class="fa fa-save"></li>
                                </button>

                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax"); ?>">
                                    <li class="fa fa-search"></li>
                                </button>

                                <button type="button" class="btn text-white" style="background-color: DarkGray;" name="seleccionIngresos" title="Selección de Ingresos" id="seleccionIngresos" data-url="<?=getUrl("Factura", "Factura", "seleccionIngresos", false, "ajax"); ?>">
                                    <i class="fa fa-cogs"></i>
                                </button>

                                <button type="button" class="btn text-white" style="background-color: Indigo;" name="cotizacionesAsociadas" title="Cotizaciones Asociadas" id="cotizacionesAsociadas" data-url="<?=getUrl("Factura", "Factura", "cotizacionesAsociadas", false, "ajax"); ?>">
                                    <i class="fa fa-plus"></i>
                                </button>

                                <button type="button" class="btn text-white" style="background-color: Chartreuse;" name="adicionarCotizaciones" title="Adicionar Cotizaciones" id="adicionarCotizaciones" data-url="<?=getUrl("Factura", "Factura", "adicionarCotizaciones", false, "ajax"); ?>">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (empty($_GET["num_ingreso"]) && empty($_GET["nit_sede"])): ?>
                <div class="border-top pt-3 pb-3 row">

                    <div class="border col-5">
                        <div class="row">
                            <label class="header-blue">Tipo de Factura&nbsp;*</label>
                            <div class="col-12">
                                <div class="pb-3 justify-content-center row">
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="tipo_factura" id="tipo_factura" value="Contado" required>
                                            </div>
                                            <div class="p-0 col-6">
                                                <label for="tipo_factura">Contado</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="tipo_factura" id="tipo_factura" value="Credito" required>
                                            </div>
                                            <div class="p-0 col-6">
                                                <label for="tipo_factura">Crédito</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="plazo">Plazo&nbsp;*</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="plazo" id="plazo" class="form-control" required>
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
                						<input class="form-control" id="numFVC" name="numFVC" readonly>
                					</div>
					            </div>
					        </div>
        
                            <div class="col-6">
        						<div class="row">
        							<div class="col-3">
        								<label for="Fecha_Documento">Fecha</label>
        							</div>
        							<div class="col-7">
                                        <?php date_default_timezone_set('America/Bogota'); ?>
        								<input type="text" name="Fecha_Documento" id="Fecha_Documento" class="form-control datepicker" value="<?=date("Y-m-d"); ?>" readonly>
        							</div>
        						</div>
        					</div>
					    </div>

					    <div class="row">
					        <div class="col-6">
					            <div class="row">
					                <div class="col-4">
                						<label for="num_cotizacion">Número Cotización</label>
                					</div>
                
                					<div class="col-8">
                						<input class="form-control" id="num_cotizacion" name="numero_cotizacion" readonly>
                					</div>
					            </div>
					        </div>
        
                            <div class="col-6">
                                <div class="row">
                                    <div class="p-0 col-2">
                                        <label for="nit">Sede&nbsp;*</label>
                                    </div>
                                    <div class="col-10">
                                        <select name="nit_sede" id="nit_sede" data-campo-1="#nit_empresa" data-campo-2="#numFVC" class="form-control" 
                                        data-url="<?=getUrl("Utilidades", "Utilidades", "buscarConsecutivoSedeYcliente", false, "ajax");?>" required>
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
					    </div>
					</div>

                </div>

                <?php else: ?>                    
                <div class="border-top pt-3 pb-3 row">
                    <div class="border col-5">
                        <div class="row">
                            <label class="header-blue">Tipo de Factura</label>
                            <div class="col-12">
                                <div class="pb-3 justify-content-center row">
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="tipo_factura" id="tipo_factura" value="Contado">
                                            </div>
                                            <div class="p-0 col-6">
                                                <label for="tipo_factura">Contado</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="tipo_factura" id="tipo_factura" value="Credito">
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
                                                <input type="text" name="plazo" id="plazo" class="form-control">
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
                						<input class="form-control" id="numFVC" name="numFVC" value="<?=$consecutivoFVC; ?>" readonly>
                					</div>
					            </div>
					        </div>
        
                            <div class="col-6">
        						<div class="row">
        							<div class="col-3">
        								<label for="Fecha_Documento">Fecha</label>
        							</div>
        							<div class="col-7">
                                        <?php date_default_timezone_set('America/Bogota'); ?>
        								<input type="text" name="Fecha_Documento" id="Fecha_Documento" class="form-control datepicker" value="<?=date("Y-m-d"); ?>" readonly>
        							</div>
        						</div>
        					</div>
					    </div>

					    <div class="row">
					        <div class="col-6">
					            <div class="row">
					                <div class="col-4">
                						<label for="numero_cotizacion">Número Cotización</label>
                					</div>
                
                					<div class="col-8">
                						<input class="form-control" id="numero_cotizacion" name="numero_cotizacion" value="<?=$numCT; ?>" readonly>
                					</div>
					            </div>
					        </div>
        
                            <div class="col-6">
                                <div class="row">
                                    <?php if ($usua_perfil == 1): ?>
                                    <div class="col-3">
                                        <label for="nit_sede">Sede&nbsp;*</label>
                                    </div>
                                    <div class="p-0 col-8">
                                        <?php foreach ($sedes as $sede): ?>
                                        <input type="text" name="sede_nombre" class="form-control" readonly value="<?=$sede["nombre"];?>">
                                        <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$_GET["nit_sede"];?>">
                                        <?php endforeach;?>
                                    </div>
                                    <?php else: ?>
                                    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$_GET["nit_sede"];?>">
                                    <?php endif;?>
                                </div>
                            </div>
					    </div>
					</div>

                </div>
                <?php endif; ?>

                <div class="pt-3 row">

                    <div class="header-blue">
                        <label>Datos del Cliente</label>
                    </div>

                    <?php if (empty($_GET["nit_cliente"])): ?>
                    <div class="col-6">
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
                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit_emp">Empresa&nbsp;*</label>
                            </div>
                            <div class="col-10">
                                <select name="nit_emp" id="nit_emp" class="form-control select2" 
                                data-url="<?=getUrl("Utilidades", "Utilidades", "BuscarDatosCliente", false, "ajax"); ?>"
                                data-urlplanta="<?=getUrl("Cotizaciones", "Cotizaciones", "ListarPlantaCliente", false, "ajax"); ?>"
                                data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>" required>
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

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="planta">Planta</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control" id="planta" name="planta" 
                                data-urlvendedor="<?=geturl("Utilidades","Utilidades", "buscarVendedorPlanta", false, "ajax"); ?>">
                                    <option value="0"></option>
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
                                <input type="text" name="nit" id="nit" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="border-top row">

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="Orden_Servicio">Orden&nbsp;Servicio</label>
                            </div>
                            <div class="col-8">
                                <?php if(empty($_GET["num_ingreso"])): ?>
                                <input type="text" class="form-control" id="Orden_Servicio" name="Orden_Servicio" readonly>
                                <?php else: ?>
                                <input type="text" class="form-control" id="Orden_Servicio" name="Orden_Servicio" value="<?=$orden_servicio; ?>" readonly>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" readonly>
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

                </div>

                <div class="border-top row">

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="tel_empresa1">Teléfono1</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="tel_empresa2">Teléfono2</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="tel_empresa2" id="tel_empresa2" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="vendedor">Vendedor</label>
                            </div>
                            <?php if(empty($_GET["nit_sede"])): ?>
                            <div class="col-9">
                                <select class="form-control" id="vendedor" name="vendedor" 
                                data-url="<?=getUrl("Utilidades", "Utilidades", "buscarVendedorSede", false, "ajax"); ?>">
                                    <option value="">Seleccione ...</option>
                                </select>
                            </div>
                            <?php else: ?>
                            <div class="col-9">
                                <select class="form-control" id="vendedor" name="vendedor" data-url="<?=getUrl("Utilidades", "Utilidades", "buscarVendedorSede", false, "ajax");  ?>">
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($vendedor as $vendedores): ?>
                                    <?php if ($vendedores["Cedula_Empleado"] == $_GET["nit_sede"]): ?>
                                    <option value="<?=$vendedores["Cedula_Empleado"];?>" selected><?=$vendedores["Nombre_Completo"];?></option>
                                    <?php else: ?>
                                    <option value="<?=$vendedores["Cedula_Empleado"];?>"><?=$vendedores["Nombre_Completo"];?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 header-blue">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="producto1">Producto o Servicio&nbsp;*</label>
                                    </div>

                                    <div class="col-6">
                                        <label for="detalle1">Detalle&nbsp;*</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="cant1">Cantidad&nbsp;*</label>
                                    </div>

                                    <div class="col-3">
                                        <label for="valor1">Valor&nbsp;*</label>
                                    </div>

                                    <div class="col-3">
                                        <label for="desc1">% Desc&nbsp;*</label>
                                    </div>

                                    <div class="col-3">
                                        <label for="subtotal1">Sub Total&nbsp;*</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1">
                                <button type="button" id="btn_agregarFilaGER" class="btn btn-dark fa fa-plus"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="Detalle_GER">

                    <div id="options_productos" style="display: none;">
                        <option value="">Seleccione ...</option>
                        <?php foreach ($servicios as $servicio): ?>
                        <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                        <?php endforeach;?>
                    </div>

                    <div class="pt-2 pb-2 fila_DetalleGER row" id="fila_DetalleFVC">

                        <div class="col-6">
                            <div class="row">
                                <input type="hidden" id="item1" name="item[]" class="itemDetalle" value="1">
                                <div class="col-6">
                                    <select name="producto[]" id="producto1" class="form-control select2 productos_servicios"
                                        data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "obtenerIvaProductoServicio", false, "ajax"); ?>" required>
                                        <option value="">Seleccione ...</option>
                                        <?php foreach ($servicios as $servicio): ?>
                                        <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <input type="hidden" name="iva[]" id="iva1" class="ivaDetalle">
                                <input type="hidden" name="valoriva[]" id="valoriva1" class="valorivaDetalle">

                                <div class="p-0 col-6">
                                    <input type="text" name="detalle[]" id="detalle1" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" name="cant[]" id="cant1" class="form-control text-center number cantDetalle" required>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="valor[]" id="valor1" class="format form-control text-right valorDetalle" required>
                                </div>

                                <div class="col-3">
                                    <input type="text" name="desc[]" id="desc1" class="form-control text-center number descDetalle" required>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="subtotal[]" id="subtotal1" class="format form-control text-right subtotalDetalle" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-1 align-self-center">
                            <button type="button" class="btn btn-danger fa fa-minus btn_eliminarGER" title="Eliminar fila"></button>
                        </div>
                    </div>
                </div>

                <div class="pt-3 pb-3 align-items-center row">

                    <div class="col-9">

                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="Orden_Compra">Orden&nbsp;de&nbsp;Compra&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <?php if (empty($_GET["num_ingreso"])): ?>
                                <input class="form-control" name="Orden_Compra" id="Orden_Compra" maxlength="100" style="color: red;" required>
                                <?php else: ?>
                                <input class="form-control" name="Orden_Compra" id="Orden_Compra" maxlength="100" style="color: red;" value="<?=$orden_compra[0]["Orden_Compra"]; ?>" required>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="observa">Observaciones</label>
                            </div>
                            <div class="col-9">
                                <textarea name="observa" id="observa" class="form-control" rows="3" cols="70"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="border col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="subtotal_doc">Sub Total</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="subtotal_doc" id="subtotal_doc" class="format form-control text-right"
                                    readonly>
                            </div>
                        </div>

                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="tiva">Total&nbsp;IVA</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tiva" id="tiva" class="format form-control text-right"
                                    readonly>
                            </div>
                        </div>

                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="tdoc">Total&nbsp;Factura</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tdoc" id="tdoc" class="format form-control text-right"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>

    </div>
</div>


<div class="modal fade" id="modalSeleccionIngresos">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 60%;">
        <div class="modal-content">

            <div class="text-center modal-header">
                <h3 class="w-100 modal-title">Seleccione los ingresos que desee Facturar</h3>
                <button type="button" class="close" data-dismiss="modal" title="Cerrar">
                    <i class="fa fa-window-close fa-2x text-danger"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablaModalSeleccionIngresos" class="table-bordered table-hover" width="100%;">

                        <thead class="table text-white bg-primary thead-primary">
                            <tr>
                                <th>N° de Ingreso</th>
                                <th>Fecha</th>
                                <th>Potencia</th>
                                <th>Velocidad</th>
                                <th>Voltaje</th>
                                <th>Ver Cotización</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalCotizacionesIngreso">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 60%;">
        <div class="modal-content">

            <div class="text-center modal-header">
                <h3 class="w-100 modal-title">Cotizaciones Ingreso</h3>
                <button type="button" class="close" data-dismiss="modal" title="Cerrar">
                    <i class="fa fa-window-close fa-2x text-danger"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablaModalCotizacionesIngreso" class="table-bordered table-hover" width="100%;">

                        <thead class="table text-white bg-primary thead-primary">
                            <tr>
                                <th>N° de Documento</th>
                                <th>Fecha</th>
                                <th>Agregar al Detalle</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>

                </div>
            </div>

            <div class="pt-3 pb-3 row justify-content-center">
                <div class="col-4">
                    <div class="aceptar-cancelarDetalleCotizacion row" style="display: none;">
                        <div class="col-6">
                            <button class="btn btn-primary aceptar-DetalleCotizacion">Aceptar</button>
                        </div>

                        <div class="col-6">
                            <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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

<div class="modal fade" id="modalAdicionarCotizaciones">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 45%;">
        <div class="modal-content">

            <div class="text-center modal-header">
                <h3 class="w-100 modal-title">Adicionar Cotizaciones a la Factura #<span id="numFacturaCT"></span></h3>
                <button type="button" class="close" data-dismiss="modal" title="Cerrar">
                    <i class="fa fa-window-close fa-2x text-danger"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablaModalAdicionarCotizaciones" class="table-bordered table-hover" width="100%;">

                        <thead class="table text-white bg-primary thead-primary">
                            <tr>
                                <th>N° de Documento</th>
                                <th>N° de Ingreso</th>
                                <th>Fecha</th>
                                <th>Agregar al Detalle</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>
                </div>
            </div>

            <div class="pt-3 pb-3 row justify-content-center">
                <div class="col-4">
                    <div class="aceptar-cancelarDetalleCotizacion row" style="display: none;">
                        <div class="col-6">
                            <button class="btn btn-primary aceptar-DetalleCotizacion">Aceptar</button>
                        </div>

                        <div class="col-6">
                            <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
$(function buscarVendedorPlanta() {
    $(document).on("change", "#planta", function () {
        var urlvendedor = $(this).attr("data-urlvendedor");

        var planta = $(this).val();

        if (planta == "") {
            $("#vendedor").val("");
        }
        $.ajax({
            url: urlvendedor,
            data: "planta=" + planta,
            dataType: "json",
            type: "POST",
            success: function (res) {
                $("#vendedor").val(res.Vendedor);
            }
        });
    });
});

$(function buscarConsecutivoSedeYcliente() {
    $(document).on("change", "#nit_sede", function () {
        let nit_cliente = $(this).attr("data-campo-1");
        let numero = $(this).attr("data-campo-2");
        let url = $(this).attr('data-url');
        let nit_sede = $(this).val();
        let tipo_doc = $('#tipo_doc').val();

        /* Si el usuario selecciona de nuevo una sede se reinica el valor
        	de la planta y los datos del cliente */
        $("#Codigo_Planta").html('<option value=""></option>');
        $("#planta").html('<option value=""></option>');
        $(".datoscliente").find("input").val("");
        /*-----------------------------------------------*/

        $.ajax({
            url: url,
            method: "post",
            dataType: "json",
            data: {
                "nit_sede": nit_sede,
                "tipo_doc": tipo_doc
            },
        }).done((res) => {
            $(numero).val(res.consecutivo_doc);
            $(nit_cliente).html(res.selectNitCliente);
        });
    });
});
</script>