<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">
    <div class="card-header">
        <h4>
            <?php if($_GET["tipo_doc"]=="CT"): ?>
            <b>Cotizaciones - Consultando</b>
            <?php elseif($_GET["tipo_doc"]=="CTGER"): ?>
            <b>Cotizaciones de Gerencia - Consultando</b>
            <?php endif; ?>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="formEditCotizacion" action="<?=getUrl("Cotizaciones", "Cotizaciones", "EditarCotizacion", false, "ajax");  ?>" autocomplete="off">
        <?php  foreach($cabeceraCT as $cabecera){} ?>

        <?php if($cabecera["Estado_Documento"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

        <input type="hidden" name="tipo_doc" id="tipo_doc" value="<?=$_GET["tipo_doc"];?>">

            <div class="container-fluid">
                <div class="pb-3 row">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-10">
                                <a href="<?=getUrl("Cotizaciones", "Cotizaciones", "crearCotizacion", array("tipo_doc" => $_GET["tipo_doc"])); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Cotización"><span class="fa fa-file"></span></a>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></button>

                                <button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosGER" title="Ver Datos Adicionales" data-url='<?=getUrl("Cotizaciones", "Cotizaciones", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosGER" style='cursor:pointer;' value="Ver Datos A."><i class="fa fa-search-plus"></i></button>

                                <a target="_blank" href="<?=getUrl("Cotizaciones", "Cotizaciones", "getCicloDeVida", array("numero_doc" => $_GET["numero_doc"], "tipo_doc" => $_GET["tipo_doc"], "nit_sede" => $_GET["nit_sede"])); ?>" class="btn text-white" style="background-color: DarkMagenta;" title="Estados del Documento"><span class="fa fa-align-justify"></span></a>

                                <a target="_blank" href="<?=getUrl("Ingresos", "Ingresos", "getCicloDeVida", array("numero_doc" => $ingresosCT[0]["Numero_Ingreso"], "serie" => $ingresosCT[0]["Numero_Serie"], "nit_sede" => $_GET["nit_sede"], "razon_social" => $cabeceraCT[0]["Razon_Social"])); ?>" class="btn text-white" style="background-color: DeepPink;" title="Ir al Ciclo de Vida"><span class="fa fa-recycle"></span></a>

                                <button type="button" class="btn text-white" style="background-color: Gainsboro;" name="PdfCT" title="Exportar a PDF"  id="PdfCT"><i class="fa fa-file-pdf"></i></button>

                                <button type="button" class="btn text-white" style="background-color: Gold;" title="Exportar a Word" name="WordCT" id="WordCT"><i class="fa fa-file-word"></i></button>

                                <button type="button" class="btn text-white" style="background-color: IndianRed;" title="Exportar a Excel" name="ExcelCT" id="ExcelCT"><i class="fa fa-file-excel"></i></button>
                            </div>
                            <div class="col-2">
                                <font id="estadoCotizacion" color="<?php echo $Estilo ?>"><?php echo $estado; ?></font>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
						<span class="font-weight-bold" style="font-size: 20px;">N°&nbsp;<?=$cabecera["Numero_Documento"];?></span>
						<input type="hidden" id="numCT" name="numCT" value="<?=$cabecera["Numero_Documento"];?>">
					</div>
    			</div>
    
                <div class="border-top pt-3 pb-3 row">

                    <input type="hidden" id="existeCT" name="existeCT" value="true">
                    <input type="hidden" name="tipo_documento" id="tipo_documento" value="CT">
                    
                    <?php if ($usua_perfil == 1): ?>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-2">
                                <label for="nit_sede">Sede</label>
                            </div>
                            <div class="col-10">
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

                    <div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="Fecha_Doc">Fecha</label>
							</div>
							<div class="p-0 col-6">
								<input type="text" name="Fecha_Doc" id="Fecha_Doc" class="form-control" style="font-size: 17px;" value="<?=substr($cabecera["Fecha_Documento"], 0, 10); ?>" readonly>
							</div>
						</div>
					</div>
				</div>
    
                <div class="pt-3 row">
    
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
                                <input type="hidden" name="nit_empresa" value="<?=$cabecera["Nit_Cliente"]; ?>">
                            </div>
                        </div>
                    </div>

                    <?php if($_GET["tipo_doc"]=="CT"): ?>

                    <?php  foreach($ingresosCT as $ingresos){} ?>
            
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
                                    data-urlcontacto="<?=geturl("Utilidades","Utilidades", "BuscarContactoCliente", false, "ajax"); ?>"
                                    data-urlvendedor="<?=geturl("Utilidades","Utilidades", "buscarVendedorPlanta", false, "ajax"); ?>" disabled>
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
                                <input type="hidden" name="planta" value="<?=$cabecera["Codigo_Planta"]; ?>">
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
                                    data-urlvendedor="<?=geturl("Utilidades","Utilidades", "buscarVendedorPlanta", false, "ajax"); ?>" disabled>
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
    
                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="dirigida">Dirigida</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="dirigida" id="dirigida" value="<?=$cabecera["Dirigido_A"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
    
                </div>

                <?php if($_GET["tipo_doc"]=="CT"): ?>

                <div class="border-top row">

                    <div class="col-4">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="dirigida">Dirigida</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="dirigida" id="dirigida" value="<?=$cabecera["Dirigido_A"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                     <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="nit">Nit</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nit" id="nit" class="form-control" value="<?=$cabecera["Nit_Cliente"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
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
                            <div class="col-4">
                                <label for="tel_empresa1">Teléfono</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" value="<?=$cabecera["Telefono1"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="ciudad_empresa">Ciudad</label>
                            </div>
                            <div class="p-0 col-8">
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

                <?php elseif($_GET["tipo_doc"]=="CTGER"): ?>

                <div class="border-top row">

                     <div class="col-2">
                        <div class="pt-3 pb-3 row">
                            <div class="col-3">
                                <label for="nit">Nit</label>
                            </div>
                            <div class="p-0 col-9">
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
                            <div class="col-4">
                                <label for="tel_empresa1">Teléfono</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="tel_empresa1" id="tel_empresa1" value="<?=$cabecera["Telefono1"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="pt-3 pb-3 row">
                            <div class="col-4">
                                <label for="ciudad_empresa">Ciudad</label>
                            </div>
                            <div class="p-0 col-8">
                                <input class="form-control" name="ciudad_empresa" id="ciudad_empresa" value="<?=$cabecera["Ciudad"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div class="border-top pt-3 pb-3 row">

                    <div class="header-blue">
                        <label>Datos del Equipo</label>
                    </div>

                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="equipo">Equipo</label>
                            </div>

                            <div class="col-10">
                                <select class="form-control" id="equipo" name="equipo" disabled>
                                    <option value=""></option>
                                    <?php foreach ($Tipos_Equipos as $Tipos_equipos): ?>
                                    <?php if ($cabecera["Equipo"] == $Tipos_equipos["Codigo_Tipo_Equipo"]): ?>
                                    <option value="<?=$Tipos_equipos["Codigo_Tipo_Equipo"];?>" selected><?=$Tipos_equipos["Descripcion"];?></option>
                                    <?php else: ?>
                                    <option value="<?=$Tipos_equipos["Codigo_Tipo_Equipo"];?>"><?=$Tipos_equipos["Descripcion"];?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="pt-3 pb-3 row">
                            <div class="col-2">
                                <label for="marca">Marca</label>
                            </div>

                            <div class="col-10">
                                <select class="form-control" id="marca" name="marca" disabled>
                                    <option value=""></option>
                                    <?php foreach ($marcas as $marca): ?>
                                    <?php if ($cabecera["Marca"] == $marca["Codigo_Marca"]): ?>
                                    <option value="<?=$marca["Codigo_Marca"];?>" selected><?=$marca["Descripcion"];?></option>
                                    <?php else: ?>
                                    <option value="<?=$marca["Codigo_Marca"];?>"><?=$marca["Descripcion"];?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 pb-3 row">

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="">N°&nbsp;Serie</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="serie" id="serie" class="form-control" value="<?=$cabecera["Serie"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-3">
                                <label for="fs">F.S</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="fs" id="fs" class="form-control" value="<?=$cabecera["Fs"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-4">
                                <label for="potencia">Potencia</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="potencia" id="potencia" class="form-control" value="<?=$cabecera["Potencia"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-3">
                                <label for="rpm">R.P.M</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="rpm" id="rpm" class="form-control" value="<?=$cabecera["Rpm"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="voltaje">Voltaje</label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="voltaje" id="voltaje" class="form-control" value="<?=$cabecera["Voltaje"]; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-top pt-3 pb-3 row">

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="insul">Insul&nbsp;Cls</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="insul" id="insul" class="form-control" value="<?=$cabecera["Insul_Cls"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="eficiencia">Eficiencia</label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="eficiencia" id="eficiencia" class="form-control" value="<?=$cabecera["Eficiencia"]; ?>" readonly>
                            </div>
                            <span>%</span>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <div class="col-2">
                                <label for="ip">Ip</label>
                            </div>
                            
                            <div class="col-6">
                            <select class="form-control" id="ip" name="ip" disabled>
                            <?php 
                            $options = array(
                                "valor" => "", "68", "56", "55", "54", 
                                "23", "21", "00"
                            );
                            ?>
                            <?php foreach ($options as $valor): ?>
                            <?php if($cabecera["Ip"] == $valor): ?>
                                <option value="<?=$cabecera["Ip"];?>" selected><?=$cabecera["Ip"];?></option>
                            <?php else: ?>
                                <option value="<?=$valor;?>"><?=$valor;?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">
                            <div class="col-3">
                                <label for="frame">Frame</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="frame" id="frame" class="form-control" value="<?=$cabecera["Frame"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                </div>

                <?php endif; ?>
                
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

                    <?php foreach($detalleCT as $detalle){
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

                        echo "<input type='hidden' id='subTempo' value='$tsubt'>";
                        echo "<input type='hidden' id='ivaTempo' value='$tiva'>";
                        echo "<input type='hidden' id='desTempo' value='$tdsto'>";
                    ?>

                    <div class="pt-2 pb-2 fila_DetalleGER row">

                        <div class="col-7">
                            <div class="row">
                                <div class="col-6">
                                    <select name="producto_Editar[]" id="producto<?=$i;?>" class="form-control productos_servicios" 
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
                                    <input type="text" name="detalle_Editar[]" id="detalle<?=$i;?>" class="form-control" value="<?=$detalle["Detalle"]; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="row">
                                <div class="col-3">
                                    <input type="number" name="cant_Editar[]" id="cant<?=$i;?>" class="form-control text-center cantDetalle" value="<?=$detalle["Cantidad"]; ?>" readonly>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="valor_Editar[]" id="valor<?=$i;?>" class="format number form-control text-right valorDetalle" value="<?=$detalle["Valor_Unitario"]; ?>" readonly>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="desc_Editar[]" id="desc<?=$i;?>" class="form-control text-center descDetalle" value="<?=$detalle["Porcentaje_Descuento"]; ?>" readonly>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="subtotal_Editar[]" id="subtotal<?=$i;?>" class="format form-control subtotalDetalle text-right" value="<?=$subt ;?>" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php
                $i++;
                }
                ?>
                </div>

                 <div class="pt-3 pb-3 row">
                    <div class="col-9">
                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="tservicio">Tipo Servicio</label>
                            </div>
                            <div class="col-3">
                                <select class="form-control" id="tservicio" name="tservicio" disabled>
                                    <option value=""></option>
                                    <?php foreach ($tipos_servicios as $tipo_servicio): ?>
									<?php if ($tipo_servicio["ts_codigo"] == $cabecera["Tipo_Servicio"]): ?>
									<option value="<?=$tipo_servicio["ts_codigo"];?>" selected><?=$tipo_servicio["ts_descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$tipo_servicio["ts_codigo"];?>"><?=$tipo_servicio["ts_descripcion"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-2">
                                <label for="vendedor">Vendedor</label>
                            </div>
                            <div class="p-0 col-4">
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
                        
                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="fpago">Forma&nbsp;de&nbsp;Pago</label>
                            </div>
                            <div class="col-4">
                                <select class="form-control" id="fpago" name="fpago" disabled>
                                    <option value=""></option>
                                    <?php foreach ($fp as $fpagos): ?>
									<?php if ($fpagos["Codigo_Forma_Pago"] == $cabecera["Forma_Pago"]): ?>
									<option value="<?=$fpagos["Codigo_Forma_Pago"];?>" selected><?=$fpagos["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$fpagos["Codigo_Forma_Pago"];?>"><?=$fpagos["Descripcion"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-1">
                                <label for="plazo">Plazo</label>
                            </div>
                            <div class="p-0 col-1">
                                <input type="text" name="plazo" id="plazo" class="form-control" value="<?=$cabecera["Dias_Plazo"]; ?>" readonly>
                            </div>
                            <div class="col-1">
                                <label>Días</label>
                            </div>

                            <div class="p-0 col-1">
                                <label for="tiempoE">Tiempo Entrega</label>
                            </div>
                            <div class="p-0 col-1">
                                <input type="text" name="tiempoE" id="tiempoE" class="form-control" value="<?=$cabecera["Prioridad"]; ?>" readonly>
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
                                <input type="text" name="garantia" class="form-control" value="<?=$cabecera["Garantia"]; ?>" readonly>
                            </div>
                            <div class="col-2">
                                <label for="garantia">Meses</label>
                            </div>

                            <div class="col-2">
                                <label for="fechaAprob">Fecha&nbsp;de&nbsp;aprob.</label>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-9">
                                        <input type="text" name="fecha_aprobGER" id="fecha_aprobGER" class="form-control"
                                        data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "ActualizarFechaAprobacion", false, "ajax"); ?>" style="font-size: 17px;" value="<?=substr($cabecera["FechaAprobacion"],0,10); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="orden_compra">Orden&nbsp;de&nbsp;Compra</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="orden_compra" id="orden_compra" 
                                data-url="<?=getUrl("Cotizaciones", "Cotizaciones", "ActualizarOrdenCompra", false, "ajax"); ?>" maxlength="100" value="<?=$cabecera["Orden_Compra"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="pb-4 row">
                            <div class="col-2">
                                <label for="observa">Observaciones</label>
                            </div>
                            <div class="col-9">
                                <textarea name="observa" id="observa" class="form-control" rows="2" cols="70" readonly><?=$cabecera[26]; ?></textarea>
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
                                <label for="tdescuento">Total&nbsp;Descuento</label>
                            </div>

                            <div class="col-6">
                                <input type="text" name="tdescuento" id="tdescuento" class="format form-control text-right" value="<?=$cabecera["Descuento"]; ?>" readonly>
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
                                <label for="tdoc">Total&nbsp;Cotización</label>
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