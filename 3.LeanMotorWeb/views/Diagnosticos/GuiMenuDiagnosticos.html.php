<div class="container-fluid">
	<header class="row border" id="header-menu-diagnosticos">

		<div class="col-12">
			<div class="pt-3 pb-3 pl-3 row">
				<button type="button" class="btn btn-dark" title="Ver o Agregar Empleados y Cajas de Herramientas" id="botonAsignarEmpleadosCajas" data-toggle="modal" data-target="#asignarEmpleadosCajas">
					<i class="fas fa-toolbox fa-2x"></i>
				</button>
			</div>
		</div>

		<!-- Modal ASIGNAR EMPLEADOS Y CAJAS DE HERRAMIENTAS-->
		<div class="modal fade" id="asignarEmpleadosCajas">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">

					<div class="text-center modal-header">
						<h3 class="w-100 modal-title">Asignar Empleados y Cajas de Heramientas</h3>
					</div>

					<div class="modal-body">
						<form id="formEmpleadosCajas" method="post">
							<div class="container-fluid" id="contenedorEmpleadosCajas">
	
								<div class="filaEmpleadosCajas row">
	
									<div class="col-7">
										<div class="row">
											<div class="p-0 col-2">
												<label for="empleado1">Empleado</label>
											</div>
											<div class="col-10">
												<select name="empleado[]" id="empleado1" class="form-control select2">
													<option value="">Seleccione ...</option>
													<?php foreach ($Empleado as $empleado): ?>
													<option value="<?=$empleado["Cedula_Empleado"];?>"><?=$empleado["Nombre_Completo"];?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
	
									<div class="col-4">
										<div class="row">
											<div class="col-2">
												<label for="caja1">Caja</label>
											</div>
											<div class="col-10">
												<select name="caja[]" id="caja1" class="form-control select2">
													<option value="">Seleccione ...</option>
													<option value="100">100</option>
													<option value="101">101</option>
													<option value="102">102</option>
													<option value="103">103</option>
													<option value="104">104</option>
													<option value="105">105</option>
													<option value="106">106</option>
													<option value="107">107</option>
													<option value="108">108</option>
													<option value="109">109</option>
													<option value="110">110</option>
													<option value="111">111</option>
													<option value="112">112</option>
													<option value="113">113</option>
													<option value="114">114</option>
													<option value="115">115</option>
												</select>
											</div>
										</div>
									</div>
	
									<div class="col-1">
										<button type="button" class="btn btn-dark" id="agregarFilaEmpleadosCajas">
											<i class="fa fa-plus"></i>
										</button>
									</div>
								</div>
	
							</div>
						</form>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" title="Cerrar">Cerrar</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-4">
			<div class="row">
			<?php foreach ($ingresos as $ingreso){} ?>
			<?php foreach ($Cliente as $cliente){} ?>
				<div class="col-12">

					<div class="pb-3 row">
						<div class="p-0 col-12">
							<label class="text-center header-blue">Datos del Equipo</label>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulFecha">Fecha:</label>
						</div>
						<div class="col-9">
							<span id="resulFecha" class="font-weight-bold"><?=substr($ingreso["Fecha_Ingreso"], 0, 10); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulIngreso">Ingreso:</label>
						</div>
						<div class="col-9">
							<span id="resulIngreso" class="font-weight-bold"><?=strtoupper($ingreso["Numero_Ingreso"]); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulSerie">Serie:</label>
						</div>
						<div class="col-9">
							<span id="resulSerie" class="font-weight-bold"><?=strtoupper($ingreso["Numero_Serie"]); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulCliente">Cliente:</label>
						</div>
						<div class="col-9">
							<span id="resulCliente" class="font-weight-bold"><?=strtoupper($cliente["Razon_Social"]); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulUbicacion">Ubicacion:</label>
						</div>
						<div class="col-9">
							<span id="resulUbicacion" class="font-weight-bold"><?=strtoupper($ingreso["Ubicacion"]); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulUbicacion">Req's&nbsp;Cliente:</label>
						</div>
						<div class="col-9">
							<span id="resulUbicacion" class="font-weight-bold"><?=strtoupper($ingreso["Requisitos_Cliente"]); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulMarca">Marca:</label>
						</div>
						<div class="col-9">
							<span id="resulMarca" class="font-weight-bold"><?=strtoupper($ingreso["Marca"]); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulTipo">Tipo:</label>
						</div>
						<div class="col-9">
							<span id="resulTipo" class="font-weight-bold"><?=strtoupper($ingreso["Tipo_Equipo"]); ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulFrame">Frame:</label>
						</div>
						<div class="col-9">
							<span id="resulFrame" class="font-weight-bold"><?=$ingreso["Frame"]; ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulCos">Cos <i class="fa fa-cos"></i>:</label>
						</div>
						<div class="col-9">
							<span id="resulCos" class="font-weight-bold"><?=$ingreso["Cos"]; ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulFases">N°&nbsp;Fases:</label>
						</div>
						<div class="col-9">
							<span id="resulFases" class="font-weight-bold"><?=$ingreso["No_Fases"]; ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulPotencia">Potencia:</label>
						</div>
						<div class="col-9">
							<span id="resulPotencia" class="font-weight-bold"><?=$ingreso["Potencia"]; ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulVelocidad">Velocidad:</label>
						</div>
						<div class="col-9">
							<span id="resulVelocidad" class="font-weight-bold"><?=$Velocidad; ?></span>
						</div>
					</div>

					<div class="pt-1 row">
						<div class="col-3">
							<label for="resulVoltaje">Voltaje:</label>
						</div>
						<div class="col-9">
							<span id="resulVoltaje" class="font-weight-bold"><?=$Voltaje; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-8" id="gruposDiagnostico">

			<!-- PRIMERA FILA DEL MENÚ -->
			<div class="border-bottom row">

				<div class="col-3" style="background-color: rgb(233, 147, 26);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "conexionesPlacaFrame", array("numero_ingreso" => $_GET["numero_ingreso"])); ?>" class="validarDiagnostico" data-diagnostico="diagnostico_1">CONEXIONES, PLACA Y FRAME</a>
				</div>

				<div class="col-3" style="background-color: rgb(22, 145, 190);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "cajaConexionBorneraCaperuza"); ?>" class="validarDiagnostico">CAJA DE CONEXIÓN, BORNERA Y CAPERUZA</a>
				</div>

				<div class="col-3" style="background-color: rgb(22, 107, 162);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">CABLE DE CONEXIÓN, CLAVIJA Y VENTILADOR</a>
				</div>

				<div class="col-3" style="background-color: rgb(208, 101, 3);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">ACOPLE, TIPO DE ACOPLE Y CANASTILLA BLOWER</a>
				</div>

				<div class="col-3" style="background-color: rgb(27, 54, 71);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">CUÑA, PRISIONERO Y PATAS</a>
				</div>

			</div>
			<!-- FIN PRIMERA FILA DEL MENÚ -->
			

			<!-- SEGUNDA FILA DEL MENÚ -->
			<div class="border-bottom row">
				<div class="col-3" style="background-color: rgb(233, 147, 26);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">TAPA L.C Y TAPA L.O.C</a>
				</div>

				<div class="col-3" style="background-color: rgb(22, 145, 190);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">RODAMIENTO L.C, RODAMIENTO L.O.C Y ARANDELA DE PRESIÓN</a>
				</div>

				<div class="col-3" style="background-color: rgb(22, 107, 162);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">CONTRA TAPA L.C Y CONTRA TAPA L.O.C</a>
				</div>

				<div class="col-3" style="background-color: rgb(208, 101, 3);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">ACCESORIOS</a>
				</div>

				<div class="col-3" style="background-color: rgb(27, 54, 71);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">PRUEBAS ELÉCTRICAS</a>
				</div>
			</div>
			<!-- FIN SEGUNDA FILA DEL MENÚ -->


			<!-- TERCERA FILA DEL MENÚ -->
			<div class="row">
				<div class="col-3" style="background-color: rgb(233, 147, 26);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">PRUEBAS ELÉCTRICAS A EQUIPOS ADICIONALES</a>
				</div>

				<div class="col-3" style="background-color: rgb(22, 145, 190);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">DIAGNÓSTICO DE EJE</a>
				</div>

				<div class="col-3" style="background-color: rgb(22, 107, 162);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">DIAGNÓSTICO DE TAPAS, BOCINES Y CHUMACERA</a>
				</div>

				<div class="col-3" style="background-color: rgb(208, 101, 3);">
					<button class="icon btn btn-lg text-white" style="background-color: Red;">
						<i class="fa fa-times fa-2x"></i>
					</button>
					<a href="" class="validarDiagnostico">DIAGNÓSTICO DE VENTILADOR</a>
				</div>

			</div>
			<!-- FIN TERCERA FILA DEL MENÚ -->
			
		</div>

	</header>
</div>

<script src="../../public/js/scripts/menuDiagnosticos.js"></script>
