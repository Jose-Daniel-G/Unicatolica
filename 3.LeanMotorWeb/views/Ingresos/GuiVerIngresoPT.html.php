<?php @session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Ingreso de Partes FA-06 - Consultando</b>
		</h4>
	</div>

	<div class="card-body">
		<form method="post" autocomplete="off" action="">

			<?php 
				foreach($IngresoEqui as $Ingreso){}
				foreach($Equipo as $equi){}
				foreach($DEquipo as $Dequi){}
			?>

			<input type="hidden" id="Numero_Ingreso" value="<?=$Ingreso["Numero_Ingreso"];?>">

			<?php if($Ingreso["Estado"]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>

			<div class="container-fluid">
				<div class="pb-3 row">
					<div class="col-5">
						<div class="row">
							<div class="col-8">
								<a href="index.php?modulo=Ingresos&controlador=Ingresos&funcion=crearPT" class="btn text-white" style="background-color: CadetBlue;" title="Nuevo Ingreso PT"><i class="fa fa-file"></i></a>
		
								<button type="button" class="btn text-white" style="background-color: Cyan;" name="btnBuscarIngresos" data-url='<?=getUrl("Utilidades", "Utilidades", "BuscarIngresos", false, "ajax");  ?>' id="btnBuscarIngresos" style='cursor:pointer;' value="Buscar" title="Buscar Ingresos"><i class="fa fa-search"></i></button>
		
								<button type="button" class="btn text-white" style="background-color: DarkCyan;" name="VerDatosIngreso" title="Ver Datos Adicionales" data-url='<?=getUrl("Ingresos", "Ingresos", "VerDatosAdicionales", false, "ajax");  ?>' id="VerDatosIngreso" value="Ver Datos A."><i class="fa fa-search-plus"></i></button>
							</div>

							<div class="col-3">
								<font color="<?=$Estilo ?>"><?=$estado; ?></font>
							</div>
						</div>
					</div>
					<div class="col-2">
						<span class="font-weight-bold" style="font-size: 20px;">N°&nbsp;<?=$Ingreso["Numero_Ingreso"];?></span>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">

					<input type="hidden" id="tipo_documento" name="tipo_documento" value="OI">

					<div class="col-3">
						<div class="row">
							<?php if ($usua_perfil == 1): ?>
							<div class="col-3">
								<label for="nit_sede">Sede</label>
							</div>
							<div class="col-9">
								<?php foreach ($sedes as $sede): ?>
								<input type="text" name="sede_nombre" class="form-control" readonly value="<?=$sede["nombre"];?>">
								<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$Ingreso["Nit_Empresa"];?>">
								<?php endforeach;?>
							</div>
							<?php else: ?>
							<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$Ingreso["Nit_Empresa"];?>">
							<?php endif;?>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="col-4">
								<label for="Fecha_Ingreso">Fecha</label>
							</div>
							<div class="p-0 col-8">
								<input type="text" name="Fecha_Ingreso" class="form-control" style="font-size: 17px;" value="<?=substr($Ingreso["Fecha_Ingreso"], 0,10); ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-5">
								<label for="cif">Tamaño&nbsp;CIF</label>
							</div>
							<div class="p-0 col-6">
							<input type="text" name="cif" id="cif" class="form-control" value="<?=$Ingreso["Tamayo_Cif"]; ?>" readonly>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="Nit_Cliente">Empresa</label>
							</div>
							<div class="col-10">
								<select name="Nit_Cliente" id="Nit_Cliente" class="form-control" 
									data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax"); ?>" 
									data-url="<?=geturl("Ingresos", "Ingresos", "llenarplanta", false, "ajax"); ?>" disabled>
									<option value=""></option>
									<?php foreach ($Cliente as $Clientes): ?>
									<?php if ($Clientes["Nit_Cliente"] == $equi["Nit_Cliente"]): ?>
									<option value="<?=$Clientes["Nit_Cliente"];?>" selected><?=$Clientes["Razon_Social"];?></option>
									<?php else: ?>
									<option value="<?=$Clientes["Nit_Cliente"];?>"><?=$Clientes["Razon_Social"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-3">
								<label for="Codigo_Planta">Planta</label>
							</div>
							<div class="p-0 col-9">
								<select class="form-control" id="Codigo_Planta" name="Codigo_Planta" 
								data-urlcontacto="<?=geturl("Utilidades", "Utilidades", "BuscarContactoCliente", false, "ajax"); ?>" disabled>
									<?php if(!empty($Planta)): ?>
									<option value=""></option>
									<?php foreach ($Planta as $Plantas): ?>
									<?php if ($Plantas["Codigo_Planta"] == $equi["Codigo_Planta"]): ?>
									<option value="<?=$Plantas["Codigo_Planta"];?>" selected><?=$Plantas["Nombre"];?></option>
									<?php else: ?>
									<option value="<?=$Plantas["Codigo_Planta"];?>"><?=$Plantas["Nombre"];?></option>
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
						<div class="row">
							<div class="col-5">
								<label for="Orden_Servicio">Orden de Servicio</label>
							</div>
							<div class="p-0 col-7">
								<input class="form-control" name="Orden_Servicio" id="Orden_Servicio" value="<?=$Ingreso["Orden_Servicio"]; ?>" readonly>
							</div>
						</div>
					</div>

				</div>


				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="Codigo_Tipo_Equipo">Artículo</label>
							</div>
							<div class="col-10">
								<select class="form-control" id="Codigo_Tipo_Equipo" name="Codigo_Tipo_Equipo" disabled>
									<option value=""></option>
									<?php foreach ($Tipos_Equipos as $Tipos_equipos): ?>
									<?php if ($equi["Codigo_Tipo_Equipo"] == $Tipos_equipos["Codigo_Tipo_Equipo"]): ?>
									<option value="<?=$Tipos_equipos["Codigo_Tipo_Equipo"];?>" selected><?=$Tipos_equipos["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$Tipos_equipos["Codigo_Tipo_Equipo"];?>"><?=$Tipos_equipos["Descripcion"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-7">
						<div class="row">
							<div class="col-3">
								<label for="Detalle_De_Equipo">Detalle&nbsp;de&nbsp;Equipo</label>
							</div>
							<div class="col-9">
								<input type="text" name="Detalle_De_Equipo" id="Detalle_De_Equipo" class="form-control" value="<?=$Ingreso["Detalle_De_Equipo"]; ?>" maxlength="100" readonly>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="validNumeroSerie">N°&nbsp;Serie</label>
							</div>
							<div class="p-0 col-8">
								<input class="form-control" name="Numero_Serie" id="validNumeroSerie" data-url="" value="<?=$equi["Numero_Serie"];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="row">
							<div class="col-3">
								<label for="Codigo_Marca">Marca</label>
							</div>
							<div class="p-0 col-9">
								<select class="form-control" id="Codigo_Marca" name="Codigo_Marca" disabled>
									<option value=""></option>
									<?php foreach ($Marca as $Marcas): ?>
									<?php if ($equi["Codigo_Marca"] == $Marcas["Codigo_Marca"]): ?>
									<option value="<?=$Marcas["Codigo_Marca"];?>" selected><?=$Marcas["Descripcion"];?></option>
									<?php else: ?>
									<option value="<?=$Marcas["Codigo_Marca"];?>"><?=$Marcas["Descripcion"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="col-4">
								<label for="cantidad">Cantidad</label>
							</div>
							<div class="col-8">
								<input class="form-control" name="cantidad" id="cantidad" value="<?=$Ingreso["Cantidad"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">

				<div class="col-4">
					<div class="row">
						<div class="col-3">
							<label for="referencia">Referencia</label>
						</div>
						<div class="p-0 col-9">
							<input class="form-control" name="referencia" id="referencia" value="<?=$Ingreso["Referencia"]; ?>" readonly>
						</div>
					</div>
				</div>

				<div class="col-3">
					<div class="row">
						<div class="col-3">
							<label for="tipo">Tipo</label>
						</div>
						<div class="p-0 col-9">
							<input class="form-control" name="tipo" id="tipo" value="<?=$Ingreso["Tipo"]; ?>" readonly>
						</div>
					</div>
				</div>

				<div class="col-3">
					<div class="row">
						<div class="col-4">
							<label for="modelo">Modelo</label>
						</div>
						<div class="p-0 col-8">
							<input class="form-control" name="modelo" id="modelo" value="<?=$Ingreso["Modelo"]; ?>" readonly>
						</div>
					</div>
				</div>

			</div>

			
			<div class="border-top pt-3 pb-3 row">
			
				<div class="col-5">
					<div class="row">
						<div class="col-3">
							<label for="dimensiones">Dimensiones</label>
						</div>
						<div class="p-0 col-9">
							<input class="form-control" name="dimensiones" id="dimensiones" value="<?=$Ingreso["Dimensiones"]; ?>" readonly>
						</div>
					</div>
				</div>

				<div class="col-2">
					<div class="row">
						<div class="col-5">
							<label for="voltaje">Voltaje</label>
						</div>
						<div class="p-0 col-7">
							<input class="form-control" name="voltaje" id="voltaje" value="<?=$Dequi["Voltaje"]; ?>" readonly>
						</div>
					</div>
				</div>

				<div class="col-2">
					<div class="row">
						<div class="col-6">
							<label for="amperaje">Amperaje</label>
						</div>
						<div class="p-0 col-6">
							<input class="form-control" name="amperaje" id="amperaje" value="<?=$Dequi["Amperaje"]; ?>" readonly>
						</div>
					</div>
				</div>

				<div class="col-3">
					<div class="row">
						<div class="col-4">
							<label for="velocidad">Velocidad</label>
						</div>
						<div class="p-0 col-5">
							<input class="form-control" name="velocidad" id="velocidad" value="<?=$Ingreso["Velocidad_Parte"]; ?>" readonly>
						</div>
						<div class="col-3">
							<label>Rpm</label>
						</div>
					</div>
				</div>
			</div>


				<div class="border-top pt-3 pb-3 row">
				
					<div class="col-12">
						<div class="row">
							<div class="col-1">
								<label for="Ubicacion">Ubicación</label>
							</div>
							<div class="col-11">
								<input class="form-control" name="Ubicacion" id="Ubicacion" value="<?=$Ingreso["Ubicacion"];?>" readonly>
							</div>
						</div>
					</div>

				</div>


				<div class="pb-2 row">

					<label class="header-blue">Enviado Para</label>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Cotizacion"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Cotizacion" type="radio" value="Cotizacion" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Cotizacion" type="radio" value="Cotizacion" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Cotizacion">Cotización</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Reparacion"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Reparacion" type="radio" value="Reparacion" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Reparacion" type="radio" value="Reparacion" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Reparacion">Reparación</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Mantenimiento"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Mantenimiento" type="radio" value="Mantenimiento" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Mantenimiento" type="radio" value="Mantenimiento" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Mantenimiento">Mantenimiento</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Garantia"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Garantia" type="radio" value="Garantia" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Garantia" type="radio" value="Garantia" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Garantia">Garantía</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Outsourcing"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Outsourcing" type="radio" value="Outsourcing" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Outsourcing" type="radio" value="Outsourcing" disabled>
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Outsourcing">Outsourcing</label>
							</div>
						</div>
					</div>

					<div class="pt-2 col-2">
						<div class="row">
							<div class="p-0 col-2">
								<?php if ($Ingreso["Enviado_Para"]=="Otros"): ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Otros" type="radio" disabled checked>
								<?php else: ?>
								<input class="form-control" style="width: 20px; margin: -5px 20px;" name="Enviado_Para" id="Otros" type="radio" value="O disabledtros">
								<?php endif; ?>
							</div>
							<div class="col-10">
								<label for="Otros">Otros</label>
							</div>
						</div>
					</div>
				</div>


				<div class="pt-3 pb-3 row">

					<label class="header-blue">Datos Eléctricos</label>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="potencia">Potencia</label>
							</div>
							<div class="col-9">
								<input type="text" name="potencia" id="potencia" class="form-control" value="<?=$Dequi["Potencia"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="unidad">Unidad</label>
							</div>
							<div class="col-8">
								<select name="unidad" id="unidad" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "HP", "KW", "W", "KVA", "MVA", "VA", "CV"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Dequi["Unidad_De_Potencia"] == $valor): ?>
									<option value="<?=$Dequi["Unidad_De_Potencia"]; ?>" selected><?=$Dequi["Unidad_De_Potencia"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-3">
								<label for="fases">Fases</label>
							</div>
							<div class="col-6">
								<input type="text" name="fases" id="fases" class="form-control" value="<?=$equi["No_Fases"];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-4">
								<label for="frecuencia">Frecuencia</label>
							</div>
							<div class="col-8">
								<input type="text" name="frecuencia" id="frecuencia" class="form-control" value="<?=$Ingreso["Frecuencia"];?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vp">Vp</label>
							</div>
							<div class="col-7">
								<input type="text" name="vp" id="vp" class="form-control" value="<?=$Dequi["V_Primario"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vs1">Vs 1</label>
							</div>
							<div class="col-7">
								<input type="text" name="vs1" id="vs1" class="form-control" value="<?=$Dequi["V_Secundario1"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>


				<div class="border-top pt-3 pb-3 row">

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="vs2">Vs 2</label>
							</div>
							<div class="col-9">
								<input type="text" name="vs2" id="vs2" class="form-control" value="<?=$Dequi["V_Secundario2"]; ?>" readonly>
							</div>
						</div>
					</div>


					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="ip">Ip</label>
							</div>
							<div class="col-9">
								<input type="text" name="ip" id="ip" class="form-control" value="<?=$Dequi["I_Primario"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-2">
						<div class="row">
							<div class="p-0 col-2">
								<label for="is">Is</label>
							</div>
							<div class="col-9">
								<input type="text" name="is" id="is" class="form-control" value="<?=$Dequi["I_Secundario"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-5">
								<label for="grupoconex">Grupo Conexión</label>
							</div>
							<div class="col-7">
								<select name="grupoconex" id="grupoconex" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "Dd0", "Yy0", "Dz0", "Dy5", "Yd5", "Yz5", "Dd6", "Yy6",
											"Dz6", "Dy11", "Yd11", "Yz11"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Ingreso["Grupo_Conexion"] == $valor): ?>
									<option value="<?=$Ingreso["Grupo_Conexion"]; ?>" selected><?=$Ingreso["Grupo_Conexion"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-3">
								<label for="conexion">Conexión</label>
							</div>
							<div class="col-7">
								<input type="text" name="conexion" id="conexion" class="form-control" value="<?=$Ingreso["Conexion"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>


				<div class="border-top pt-3 pb-3 row">

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-3">
								<label for="regulacion">Regulación</label>
							</div>
							<div class="col-7">
								<select name="regulacion" id="regulacion" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "+/-2 x 2.5%", "+/-2 x 5%"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Ingreso["Regulacion"] == $valor): ?>
									<option value="<?=$Ingreso["Regulacion"]; ?>" selected><?=$Ingreso["Regulacion"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					

					<div class="col-3">
						<div class="row">
							<div class="p-0 col-3">
								<label for="insul">Insul Cls</label>
							</div>
							<div class="col-7">
								<select name="insul" id="insul" class="form-control" disabled>
									<?php
										$options = array(
											"valor" => "", "B", "F", "H"
										);
									?>
									<?php foreach ($options as $valor): ?>
									<?php if ($Ingreso["Insul_Cls"] == $valor): ?>
									<option value="<?=$Ingreso["Insul_Cls"]; ?>" selected><?=$Ingreso["Insul_Cls"]; ?></option>
									<?php else: ?>
									<option value="<?=$valor; ?>"><?=$valor; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<label class="header-blue">Observaciones / Accesorios</label>
					<div class="col-12">
						<div class="row">
							<div class="col-12">
								<textarea name="Observaciones" id="Observaciones" class="form-control" rows="4" readonly><?=$Ingreso["Observaciones"]; ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<label for="despachado_por">Despachado por</label>
							</div>
							<div class="col-8">
								<input type="text" class="form-control" id="despachado_por" name="despachado_por" value="<?=$Ingreso["Enviado_Por"]; ?>" readonly>
							</div>
						</div>
					</div>

					<div class="col-6">
						<div class="row">
							<div class="col-4">
								<label for="Cedula_Empleado">Recibido por</label>
							</div>
							<div class="col-8">
								<select class="form-control" id="Cedula_Empleado" name="Cedula_Empleado" disabled>
									<?php foreach ($Empleado as $Empleados): ?>
									<?php if ($Empleados["Cedula_Empleado"] == $Ingreso["Cedula_Empleado"]): ?>
									<option value="<?=$Empleados["Cedula_Empleado"];?>" selected><?=$Empleados["Nombre_Completo"];?></option>
									<?php else: ?>
									<option value="<?=$Empleados["Cedula_Empleado"];?>"><?=$Empleados["Nombre_Completo"];?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top pt-3 pb-3 row">
					<div class="col-12">
						<div class="row">
							<div class="col-2">
								<label for="Requisitos_Cliente">Req's del cliente</label>
							</div>
							<div class="col-10">
								<input class="form-control" type="text" name="Requisitos_Cliente" id="Requisitos_Cliente" value="<?=$Ingreso["Requisitos_Cliente"]; ?>" readonly>
							</div>
						</div>
					</div>
				</div>


			</div> <!-- FIN CONTAINER -->
			

		</form>
	</div>
</div>