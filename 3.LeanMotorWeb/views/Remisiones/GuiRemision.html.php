<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa']; ?>
<div class="card">

    <div class="card-header">
        <h4>
            <b>Remisiones</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="remisionesReg" autocomplete="off" action="<?=getUrl("Remisiones", "Remisiones", "RegistrarRemision", false, "ajax");  ?>">

        <input type="hidden" id="tipo_documento" name="tipo_documento" value="RM">
        <input type="hidden" id="tipo_doc" name="tipo_doc" value="RM">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-5">
                        <div class="pb-3 row">
                            <div class="col-12">
                                <a href="<?=getUrl("Remisiones", "Remisiones", "crearRemision", array("tipo_doc" => "RM")); ?>" class="btn text-white" style="background-color: CadetBlue;" title="Nueva Orden de Trabajo"><span class="fa fa-file"></span></a>
                                
                                <button type="submit" class="btn btn-primary" name="RegGER" id="RegGER" value="Guardar" title="Grabar Orden de Trabajo"><li class="fa fa-save"></li></button>
                                
                                <button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarDocGeneral" data-url="<?=getUrl("Utilidades", "Utilidades", "ModalBuscarDocumento", false, "ajax");  ?>" id="btnBuscarDocGeneral" value="Buscar" title="Buscar Documentos"><li class="fa fa-search"></li></div>
                        </div>
                    </div>
    			</div>
    
                <div class="pt-3 pb-3 align-items-center row">

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

                    <div class="border col-2">
						<div class="pt-2 row">
							<div class="col-3">
                                <input class="form-control" name="Tipo_Remision" id="TipoRemisionBasica" type="radio" style="width: 20px; margin: -5px 20px;" value="RemisionBasica">
							</div>
							<div class="col-9">
								<label for="TipoRemisionBasica">Básica</label>
							</div>
						</div>

						<div class="row">
							<div class="col-3">
                                <input class="form-control" name="Tipo_Remision" id="TipoRemisionDetalle" type="radio" style="width: 20px; margin: -5px 20px;" value="RemisionDetalle" checked>
							</div>
							<div class="col-9">
								<label for="TipoRemisionDetalle">Con&nbsp;detalle</label>
							</div>
						</div>
					</div>

                    <div class="offset-1 col-4">
						<div class="border row">
							<div class="header-blue">
								<label>Esta Remisión fue:&nbsp;*</label>
							</div>

							<div class="pt-2 pb-2 col-9">
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-4">
												<input class="form-control" name="TipoTrabajo" id="Garantia" type="radio" style="width: 20px; margin: -5px 20px;" value="G" required>
											</div>
											<div class="col-7">
												<label for="Garantia">Garantía</label>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="row">
											<div class="col-4">
												<input class="form-control" name="TipoTrabajo" id="Devanado" type="radio" style="width: 20px; margin: -5px 20px;" value="D" required>
											</div>
											<div class="col-7">
												<label for="Devanado">Dev.&nbsp;Sin&nbsp;reparar</label>
											</div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-4">
												<input class="form-control" name="TipoTrabajo" id="Obsequio" type="radio" style="width: 20px; margin: -5px 20px;" value="O" required>
											</div>
											<div class="col-7">
												<label for="Obsequio">Obsequio</label>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="row">
											<div class="col-4">
												<input class="form-control" name="TipoTrabajo" id="Facturado" type="radio" style="width: 20px; margin: -5px 20px;" value="F" required>
											</div>
											<div class="col-7">
												<label for="Facturado">Facturado</label>
											</div>
										</div>
									</div>

								</div>
								
								<div class="row">
									<div class="col-6">
										<div class="row">
											<div class="col-4">
												<input class="form-control" name="TipoTrabajo" id="VentaProducto" type="radio" style="width: 20px; margin: -5px 20px;" value="V" required>
											</div>
											<div class="col-7">
												<label for="VentaProducto">Venta&nbsp;Producto</label>
											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="row">
											<div class="col-4">
												<input class="form-control" name="TipoTrabajo" id="Outsourcing" type="radio" style="width: 20px; margin: -5px 20px;" value="U" required>
											</div>
											<div class="col-7">
												<label for="Outsourcing">Outsourcing</label>
											</div>
										</div>
									</div>

								</div>
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
        
                </div>

                <div class="border-top datoscliente row">

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

                <div class="Detalle_General row">
                    <div class="col-12 header-blue">
                        <div class="row">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="producto1">Producto o Servicio&nbsp;*</label>
                                    </div>

                                    <div class="col-7">
                                        <label for="detalle1">Detalle&nbsp;*</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1">
                                <div class="row">
                                    <div class="p-0 col-3">
                                        <label for="cant1">Cantidad&nbsp;*</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1">
                                <button type="button" id="btn_agregarFilaDetalle_General" class="btn btn-dark fa fa-plus"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="Detalle_General" class="Detalle_General">

                    <div id="options_productos" style="display: none;">
                        <option value="">Seleccione ...</option>
                        <?php foreach ($servicios as $servicio): ?>
                        <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                        <?php endforeach;?>
                    </div>

                    <div class="pt-2 pb-2 fila_Detalle_General row">

                        <div class="col-10">
                            <div class="row">
                                    <input type="hidden" id="item1" name="item[]" class="itemDetalle" value="1">
                                <div class="col-5">
                                    <select name="producto[]" id="producto1" class="form-control select2 productos_servicios" required>
                                        <option value="">Seleccione ...</option>
                                        <?php foreach ($servicios as $servicio): ?>
                                        <option value="<?=$servicio["Codigo"];?>"><?=$servicio["Descripcion"];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="col-7">
                                    <input type="text" name="detalle[]" id="detalle1" class="form-control" required>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-1">
                            <div class="row">
                                <div class="p-0 col-11">
                                    <input type="text" name="cant[]" id="cant1" class="form-control text-center number cantDetalle">
                                </div>
                            </div>
                        </div>

                        <div class="col-1 align-self-center">
                            <button type="button" class="btn btn-danger fa fa-minus btn_eliminarFilaDetalle_General" title="Eliminar fila"></button>
                        </div>
                    </div>
                </div>

				<div id="Basica" style="display: none;">
					<div class="pt-3 pb-3 row">
						<div class="col-2">
							<label for="observacionBasica">Observaciones</label>
						</div>
						<div class="col-10">
							<textarea name="observacionBasica" id="observacionBasica" class="form-control" rows="4"></textarea>
						</div>
					</div>
				</div>

				<div class="pt-4 pb-4 align-items-center row">
					<div class="col-6">
						<div class="row">
							<div class="offset-1 col-6">
                                <div class="pb-3 border row">

                                    <div class="header-blue">
                                        <label>Recibido por el Cliente</label>
                                    </div>
                                    <div class="pt-3 col-6">
                                        <label for="tiempoE">Tiempo&nbsp;de&nbsp;Entrega</label>
                                    </div>
                                    <div class="pt-3 col-4">
                                        <input type="text" name="tiempoE" id="tiempoE" class="form-control">
                                    </div>
                                    <div class="pt-3 p-0 col-2">
                                        <label for="tiempoE">Días</label>
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
										<label for="Empleado">Empleado&nbsp;*</label>
									</div>
									<div class="col-9">
										<select class="form-control select2" id="Empleado" name="Empleado" required>
											<option value="">Seleccione ...</option>
											<?php foreach ($Empleado as $Empleados): ?>
											<option value="<?=$Empleados["Cedula_Empleado"];?>"><?=$Empleados["Nombre_Completo"];?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="align-items-center row">
                    <div class="col-12">
                        <div class="row" id="observacionesDetalle">
                            <div class="col-2">
                                <label for="observacionDetalle">Observaciones</label>
                            </div>
                            <div class="col-10">
                                <textarea name="observacionDetalle" id="observa" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
				</div>

            </div>
        </form>
    </div>
    
</div>

<script>
$(document).ready(function (){
	$(document).on("click", "#TipoRemisionBasica", function (){
		$(".Detalle_General").hide();
        $("#observacionesDetalle").hide();
        $("#Basica").show();
        
        if ($("#nit_empresa").val() == "") {
            $(".fila_Detalle_General").find("input, select").each(function () {
                $(this).val("");
            });
        }
	});

	$(document).on("click", "#TipoRemisionDetalle", function (){
		$("#Basica").hide();
        $(".Detalle_General").show();
        $("#observacionesDetalle").show();
        $("#observacionBasica").val("");

        if ($("#nit_empresa").val() == "") {
            $(".fila_Detalle_General").find("input, select").each(function () {
                $(this).val("");
            });
        }
	});
});
</script>