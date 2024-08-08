<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">
    <div class="card-header">
        <h4>
            <b>Preliquidación FA-02</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="preliquidacionReg" autocomplete="off" action="<?=getUrl("Preliquidacion", "Preliquidacion", "RegistrarPreliquidacion", false, "ajax");  ?>">
            <div class="container-fluid">
                <div class="pb-3 row">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-12">
                                <a href="<?=getUrl("Preliquidacion", "Preliquidacion", "crearPreliquidacion", array("tipo_doc" => "PL")); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nueva Preliquidación"><i class="fa fa-file"></i></a>
                                
                                <button type="submit" class="btn btn-primary" name="RegPL" id="RegPL" value="Guardar" title="Grabar Preliquidación"><i class="fa fa-save"></i></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
    			</div>
    
                <div class="pt-3 pb-3 row">

                    <input type="hidden" id="tipo_doc" name="tipo_doc" value="<?=$_GET["tipo_doc"]; ?>">
					<input type="hidden" id="existePL" name="existePL" value="false">

                    <?php if (empty($_GET["nit_sede"])): ?>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit_sede">Sede&nbsp;*</label>
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
                                <label for="nit_sede">Sede&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <select name="nit_sede" id="nit_sede" data-campo="#nit_empresa" class="form-control" 
                                data-url="<?=getUrl("Utilidades", "Utilidades", "buscarClientesSede", false, "ajax");?>" required>
                                    <option value="">Seleccione ...</option>
                                    <?php if ($usua_perfil == 1): ?>
                                    <?php foreach ($sedes as $sede): ?>
                                    <?php if ($sede["nit_empresa"] == $_GET["nit_sede"]): ?>
									<option value="<?=$sede["nit_empresa"];?>" selected><?=$sede["nombre"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                    <?php else: ?>
                                    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$nit_Empresa_sede;?>">
                                    <?php endif;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="Prioridad">Prioridad&nbsp;*</label>
							</div>

							<div class="p-0 col-3">
								<input class="form-control" name="Prioridad" id="Prioridad" required>
							</div>

							<div class="col-2">
								<label for="Prioridad">Días</label>
							</div>
						</div>
					</div>
    
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
                                    data-urlplanta="<?=getUrl("Preliquidacion", "Preliquidacion", "ListarPlantaCliente", false, "ajax"); ?>"
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
                                    data-urlplanta="<?=getUrl("Preliquidacion", "Preliquidacion", "ListarPlantaCliente", false, "ajax"); ?>"
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
                                data-url="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarDatosIngreso", false, "ajax"); ?>" required>
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
    
                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="planta">Planta</label>
                            </div>
                            <div class="p-0 col-9">
                                <select class="form-control" id="planta" name="planta" 
                                    data-urlcontacto="<?=geturl("Utilidades","Utilidades", "BuscarContactoCliente", false, "ajax"); ?>">
                                    <option value="0"></option>
                                </select>
                            </div>
                        </div>
                    </div>
    
                </div>
    
                <div class="border-top datoscliente row">

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="dirigida">Dirigida&nbsp;*</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="dirigida" id="dirigida" required>
                            </div>
                        </div>
                    </div>

                     <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit">Nit</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nit" id="nit" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="dir_empresa">Dirección</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" id="dir_empresa" name="dir_empresa" readonly>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div class="border-top datoscliente row">
    
                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="tel_empresa1">Teléfono</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="ciudad_empresa">Ciudad</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="ciudad_empresa" id="ciudad_empresa" readonly>
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
                                        <input type="hidden" name="equipo" id="equipo">
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

                    <div class="pt-2 pb-2 fila_DetalleGER row">

                        <div class="col-6">
                            <div class="row">
                                    <input type="hidden" id="item1" name="item[]" class="itemDetalle" value="1">
                                <div class="col-6">
                                    <select name="producto[]" id="producto1" class="form-control select2 productos_servicios" data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "obtenerIvaProductoServicio", false, "ajax");  ?>" required>
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
                                    <input type="text" name="cant[]" id="cant1" class="form-control text-center number cantDetalle" value="1" required>
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

                <div class="pt-3 pb-3 row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-5">
                                <label for="tiempoE">Tiempo Entrega</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="tiempoE" id="tiempoE" class="form-control">
                            </div>
                            <div class="col-1">
                                <label>Días</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="garantia">Garantía</label>
                            </div>
                            <div class="col-5">
                                <input type="text" name="garantia" class="form-control">
                            </div>
                            <div class="col-2">
                                <label for="garantia">Meses</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row">
                            <div class="col-3">
                                <label for="vendedor">Responsable&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control select2" id="vendedor" name="responsable" data-url="<?=getUrl("Utilidades", "Utilidades", "buscarVendedorSede", false, "ajax");  ?>" required>
                                    <option value="">Seleccione ...</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pt-3 pb-3 row">
                    <div class="col-2">
                        <label for="observa">Observaciones</label>
                    </div>
                    <div class="col-10">
                        <textarea name="observa" class="form-control" rows="2" cols="70"></textarea>
                    </div>
                </div>

            </div>
        </form>
    </div>
    
</div>