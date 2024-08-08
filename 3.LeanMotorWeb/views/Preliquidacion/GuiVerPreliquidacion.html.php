<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>
<div class="card">
    <div class="card-header">
        <h4>
            <b>Preliquidación FA-02 - Consultando</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="formEditPreliquidacion" action="" autocomplete="off">
        <?php  foreach($cabeceraPL as $cabecera){} ?>

            <?php if($cabecera["Estado_Documento"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

            <div class="container-fluid">
                <div class="pb-3 row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9">
                                <a href="<?=getUrl("Preliquidacion", "Preliquidacion", "crearPreliquidacion", array("tipo_doc" => $_GET["tipo_doc"])); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nueva Preliquidación"><span class="fa fa-file"></span></a>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></button>

                                <button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosPL" title="Ver Datos Adicionales" data-url='<?=getUrl("Preliquidacion", "Preliquidacion", "VerDatosAdicionales", false, "ajax")  ?>' id="VerDatosPL" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>

                                <a target="_blank" href="<?=getUrl("Ingresos", "Ingresos", "getCicloDeVida", array("numero_doc" => $ingresosPL[0]["Numero_Ingreso"], "serie" => $ingresosPL[0]["Numero_Serie"], "nit_sede" => $_GET["nit_sede"], "razon_social" => $cabeceraPL[0]["Razon_Social"])); ?>" class="btn text-white" style="background-color: DeepPink;" title="Ir al Ciclo de Vida"><span class="fa fa-recycle"></span></a>

                                <button type="button" class="btn text-white" style="background-color: Gainsboro;" name="PdfPL" title="Exportar a PDF"  id="PdfPL"><i class="fa fa-file-pdf"></i></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Gold;" title="Exportar a Word" name="WordPL" id="WordPL"><i class="fa fa-file-word"></i></button>

                                <button type="button" class="btn text-white" style="background-color: IndianRed;" title="Exportar a Excel" name="ExcelCT" id="ExcelCT"><i class="fa fa-file-excel"></i></button>
                            </div>
                            <div class="col-2">
                                <font color="<?=$Estilo ?>"><?=$estado; ?></font>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
						<span class="font-weight-bold" style="font-size: 20px;">N°&nbsp;<?=$cabecera["Numero_Documento"];?></span>
						<input type="hidden" id="numPL" name="numPL" value="<?=$cabecera["Numero_Documento"];?>">
					</div>
    			</div>
    
                <div class="border-top pt-3 pb-3 row">

                    <input type="hidden" id="tipo_doc" name="tipo_doc" value="PL">
                    <input type="hidden" id="existePL" name="existePL" value="true">

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
							<div class="col-4">
								<label for="Prioridad">Prioridad</label>
							</div>

							<div class="p-0 col-4">
								<input class="form-control" name="Prioridad" id="Prioridad" required value="<?=$cabecera["Prioridad"];?>" readonly>
							</div>

							<div class="col-2">
								<label for="Prioridad">Días</label>
							</div>
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

                    <?php  foreach($ingresosPL as $ingresos){} ?>

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
                                <input type="hidden" name="planta" value="<?=$cabecera["Codigo_Planta"]; ?>">
                            </div>
                        </div>
                    </div>
    
                </div>
    
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

                    <?php foreach($detallePL as $detalle){
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
                    ?>

                    <div class="pt-2 pb-2 fila_DetalleGER row">

                        <div class="col-7">
                            <div class="row">
                                <div class="col-6">
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

                                <div class="p-0 col-6">
                                    <input type="text" name="detalle_Editar[]" id="detalle<?=$i;?>" class="form-control" value="<?=$detalle["Detalle"]; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="row">
                                <div class="col-3">
                                    <input type="number" name="cant_Editar[]" id="cant<?=$i;?>" data-fila="<?=$i;?>" class="form-control text-center cantDetalle" value="<?=$detalle["Cantidad"]; ?>" readonly>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="valor_Editar[]" id="valor<?=$i;?>" data-fila="<?=$i;?>" class="format form-control text-right valorDetalle" value="<?=$detalle["Valor_Unitario"]; ?>" readonly>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="desc_Editar[]" id="desc<?=$i;?>" data-fila="<?=$i;?>" class="form-control text-center descDetalle" value="<?=$detalle["Porcentaje_Descuento"]; ?>" readonly>
                                </div>

                                <div class="p-0 col-3">
                                    <input type="text" name="subtotal_Editar[]" id="subtotal<?=$i;?>" class="format form-control text-right subtotalDetalle" value="<?=$subt ;?>" readonly>
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
                    <div class="col-4">
                        <div class="row">
                            <div class="col-5">
                                <label for="tiempoE">Tiempo Entrega</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="tiempoE" id="tiempoE" class="form-control" value="<?=$cabecera["Tiempo_Entrega"]; ?>" readonly>
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
                                <input type="text" name="garantia" id="garantia" class="form-control" value="<?=$cabecera["Garantia"]; ?>" readonly>
                            </div>
                            <div class="col-2">
                                <label for="garantia">Meses</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row">
                            <div class="col-3">
                                <label for="responsable">Responsable</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control" id="responsable" name="responsable" disabled>
                                    <option value=""></option>
                                        <?php foreach ($responsable as $responsables): ?>
                                        <?php if ($responsables["Cedula_Empleado"] == $cabecera["Cedula_Empleado"]): ?>
                                        <option value="<?=$responsables["Cedula_Empleado"];?>" selected><?=$responsables["Nombre_Completo"];?></option>
                                        <?php else: ?>
                                        <option value="<?=$responsables["Cedula_Empleado"];?>"><?=$responsables["Nombre_Completo"];?></option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
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
                        <textarea name="observa" class="form-control" rows="2" cols="70" readonly><?=$cabecera["Observaciones"]; ?></textarea>
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