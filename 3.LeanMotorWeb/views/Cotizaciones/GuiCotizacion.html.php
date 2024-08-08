<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <?php if($_GET["tipo_doc"]=="CT"): ?>
            <b>Cotizaciones</b>
            <?php elseif($_GET["tipo_doc"]=="CTGER"): ?>
            <b>Cotizaciones de Gerencia</b>
            <?php endif; ?>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="cotizacionReg" autocomplete="off" action="<?=getUrl("Cotizaciones", "Cotizaciones", "RegistrarCotizacion", false, "ajax");  ?>">
            
        <input type="hidden" id="tipo_doc" name="tipo_doc" value="<?=$_GET["tipo_doc"];?>">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-5">
                        <div class="pb-3 row">
                            <div class="col-12">
                                <a href="<?=getUrl("Cotizaciones", "Cotizaciones", "crearCotizacion", array("tipo_doc" => $_GET["tipo_doc"])); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Cotización"><span class="fa fa-file"></span></a>
                                
                                <button type="submit" class="btn btn-primary" name="RegGER" id="RegGER" value="Guardar" title="Grabar Cotización"><li class="fa fa-save"></li></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></div>
                        </div>
                    </div>
    			</div>
    
                <div class="pt-3 pb-3 row">

                    <input type="hidden" id="tipo_documento" name="tipo_documento" value="CT">
                    
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
                                    <?php elseif($_GET["tipo_doc"]=="CTGER"): ?>
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
                                    <?php elseif($_GET["tipo_doc"]=="CTGER"): ?>
                                    <input type="hidden" name="nit_sede" id="nit_sede" value="<?=$nit_Empresa_sede;?>">
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

                    <?php if($_GET["tipo_doc"]=="CT"): ?>
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
                                        data-urlcontacto="<?=geturl("Utilidades","Utilidades", "BuscarContactoCliente", false, "ajax"); ?>"
                                        data-urlvendedor="<?=geturl("Utilidades","Utilidades", "buscarVendedorPlanta", false, "ajax"); ?>">
                                        <option value="0"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <?php elseif($_GET["tipo_doc"]=="CTGER"): ?>
                        <div class="col-3">
                            <div class="pt-3 pb-3 row">
                                <div class="col-3">
                                    <label for="planta">Planta</label>
                                </div>
                                <div class="p-0 col-9">
                                    <select class="form-control" id="planta" name="planta" 
                                        data-urlcontacto="<?=geturl("Utilidades","Utilidades", "BuscarContactoCliente", false, "ajax"); ?>"
                                        data-urlvendedor="<?=geturl("Utilidades","Utilidades", "buscarVendedorPlanta", false, "ajax"); ?>">
                                        <option value="0"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-4">
                            <div class="pt-3 pb-3 row">
                                <div class="col-3">
                                    <label for="dirigida">Dirigida&nbsp;*</label>
                                </div>
                                <div class="p-0 col-8">
                                    <input type="text" class="form-control" name="dirigida" id="dirigida" required>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
        
                    </div>

                <?php if($_GET["tipo_doc"]=="CT"): ?>

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

                <?php elseif($_GET["tipo_doc"]=="CTGER"): ?>

                <div class="border-top pt-3 pb-3 datoscliente row">

                     <div class="col-2">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="nit">Nit</label>
                            </div>
                            <div class="p-0 col-9">
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
                            <div class="col-4">
                                <label for="tel_empresa1">Teléfono</label>
                            </div>
                            <div class="p-0 col-8">
                                <input type="text" class="form-control" name="tel_empresa1" id="tel_empresa1" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="ciudad_empresa">Ciudad</label>
                            </div>
                            <div class="p-0 col-8">
                                <input type="text" class="form-control" name="ciudad_empresa" id="ciudad_empresa" readonly>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div class="border-top pt-3 pb-3 row">

                    <div class="header-blue">
                        <label>Datos del Equipo&nbsp;*</label>
                    </div>

                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="equipo">Equipo&nbsp;*</label>
                            </div>
                            <div class="col-10">
                                <select class="form-control select2" id="equipo" name="equipo" required>
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($Clase_Equipos as $Clase_Equipo): ?>
                                    <option value="<?=$Clase_Equipo["Codigo_Tipo_Equipo"];?>"><?=$Clase_Equipo["Descripcion"];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="marca">Marca&nbsp;*</label>
                            </div>
                            <div class="col-10">
                                <select class="form-control select2" id="marca" name="marca" required>
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($marcas as $marca): ?>
                                    <option value="<?=$marca["Codigo_Marca"];?>"><?=$marca["Descripcion"];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="border-top pt-3 pb-3 row">

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="serie">N°&nbsp;Serie&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="serie" id="serie" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-3">
                                <label for="fs">F.S&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="fs" id="fs" class="form-control number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-5">
                                <label for="potencia">Potencia&nbsp;*</label>
                            </div>
                            <div class="col-7">
                                <input type="text" name="potencia" id="potencia" class="form-control number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-4">
                                <label for="rpm">R.P.M&nbsp;*</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="rpm" id="rpm" class="form-control number" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-4">
                                <label for="voltaje">Voltaje&nbsp;*</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="voltaje" id="voltaje" class="form-control number" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 pb-3 row">

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="insul">Insul&nbsp;Cls&nbsp;*</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="insul" id="insul" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">
                            <div class="col-4">
                                <label for="eficiencia">Eficiencia&nbsp;*</label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="eficiencia" id="eficiencia" class="form-control number" required>
                            </div>
                            <span>%</span>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-2">
                                <label for="ip">Ip&nbsp;*</label>
                            </div>
                            <div class="col-7">
                            <select class="form-control select2" id="ip" name="ip" required>
                                <option value=""></option>
                                <option value="68">68</option>
                                <option value="56">56</option>
                                <option value="55">55</option>
                                <option value="54">54</option>
                                <option value="23">23</option>
                                <option value="21">21</option>
                                <option value="00">00</option>
							</select>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="frame">Frame&nbsp;*</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="frame" id="frame" class="form-control" required>
                            </div>
                        </div>
                    </div>

                </div>

                <?php endif; ?>

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
                                    <input type="text" name="cant[]" id="cant1" class="form-control text-center cantDetalle number" required>
                                </div>
    
                                <div class="p-0 col-3">
                                    <input type="text" name="valor[]" id="valor1" class="format form-control text-right valorDetalle" required>
                                </div>
    
                                <div class="col-3">
                                    <input type="text" name="desc[]" id="desc1" class="form-control text-center descDetalle number" required>
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
                    <div class="col-9">
                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="tservicio">Tipo Servicio&nbsp;*</label>
                            </div>
                            <div class="col-3">
                                <select class="form-control" id="tservicio" name="tservicio" required>
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($tipos_servicios as $tipo_servicio): ?>
                                    <option value="<?=$tipo_servicio["ts_codigo"];?>"><?=$tipo_servicio["ts_descripcion"];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="col-2">
                                <label for="vendedor">Vendedor</label>
                            </div>
                            <?php if(empty($_GET["nit_sede"])): ?>
                            <div class="p-0 col-4">
                                <select class="form-control" id="vendedor" name="vendedor" data-url="<?=getUrl("Utilidades", "Utilidades", "buscarVendedorSede", false, "ajax");  ?>">
                                    <option value="">Seleccione ...</option>
                                </select>
                            </div>
                            <?php else: ?>
                            <div class="p-0 col-4">
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
                        
                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="fpago">Forma&nbsp;de&nbsp;Pago</label>
                            </div>
                            <div class="col-4">
                                <select class="form-control" id="fpago" name="fpago">
                                    <option value="">Seleccione ...</option>
                                    <?php foreach ($fpagos as $fpago): ?>
                                    <option value="<?=$fpago["Codigo_Forma_Pago"];?>"><?=$fpago["Descripcion"];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="col-1">
                                <label for="plazo">Plazo</label>
                            </div>
                            <div class="p-0 col-1">
                                <input type="text" name="plazo" id="plazo" class="form-control">
                            </div>
                            <div class="col-1">
                                <label>Días</label>
                            </div>

                            <div class="p-0 col-1">
                                <label for="tiempoE">Tiempo Entrega</label>
                            </div>
                            <div class="p-0 col-1">
                                <input type="text" name="tiempoE" id="tiempoE" class="form-control">
                            </div>
                            <div class="col-1">
                                <label>Días</label>
                            </div>
                        </div>
                        
                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="garantia">Garantía</label>
                            </div>
                            <div class="col-2">
                                <input type="text" id="garantia" name="garantia" class="form-control">
                            </div>
                            <div class="col-2">
                                <label for="garantia">Meses</label>
                            </div>

                            <div class="col-2">
                                <label for="fechaAprob">Fecha&nbsp;de&nbsp;aprob.</label>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="fecha_aprobGER" id="fechaAprob" class="form-control datepicker" placeholder="aaaa-mm-dd" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="Orden_Compra">Orden&nbsp;de&nbsp;Compra&nbsp;*</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="Orden_Compra" id="Orden_Compra" maxlength="100" data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "ValidarOrdenCompra", false, "ajax");?>" required>
                            </div>
                        </div>

                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="observa">Observaciones</label>
                            </div>
                            <div class="col-9">
                                <textarea name="observa" id="observa" class="form-control" rows="2" cols="70"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="border col-3 align-self-center">
                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="subtotal_doc">Sub Total</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="subtotal_doc" id="subtotal_doc" class="format form-control text-right" value="0" readonly>
                            </div>
                        </div>

                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="tdescuento">Total&nbsp;Descuento</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tdescuento" id="tdescuento" class="format form-control text-right" value="0" readonly>
                            </div>
                        </div>

                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="tiva">Total&nbsp;IVA</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tiva" id="tiva" class="format form-control text-right" value="0" readonly>
                            </div>
                        </div>

                        <div class="pt-3 pb-3 row">
                            <div class="col-6">
                                <label for="tdoc">Total&nbsp;Cotización</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tdoc" id="tdoc" class="format form-control text-right" value="0" readonly>
                            </div>
                        </div>
                    </div>
                 </div>

            </div>
        </form>
    </div>
    
</div>


<script>
$(document).on("change", "#planta", function () {
    var urlvendedor = $(this).attr("data-urlvendedor");

    var planta = $(this).val();

    if (planta == "") {
        $("#vendedor").val("");
    }
    $.ajax({
        url: urlvendedor,
        method: "post",
        dataType: "json",
        data: {
            planta: planta
        }
    }).done((res) => {
        $("#vendedor").val(res.Vendedor);
    });
});
</script>