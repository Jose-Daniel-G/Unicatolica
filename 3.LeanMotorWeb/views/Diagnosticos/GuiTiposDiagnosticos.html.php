<?php 
@session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Diagnósticos</b>
		</h4>
	</div>

	<div class="card-body">
		<form id="formIngresos" method="post" autocomplete="off" action="<?=getUrl("Ingresos", "Ingresos", "PostCrearAC"); ?>">

			<div class="container-fluid">
				<div class="pb-5 row">
					<?php if (empty($_GET["nit_sede"])): ?>
					<div class="col-3">
						<div class="row">
							<?php if ($usua_perfil == 1): ?>
							<div class="col-3">
								<label for="nit_sede">Sede&nbsp;*</label>
							</div>
		
							<div class="p-0 col-9">
								<select name="nit_sede" id="nit_sede" data-campo="#nit_empresa" class="form-control" 
									data-url="<?=getUrl("Utilidades", "Utilidades", "buscarClientesSede", false, "ajax"); ?>" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($sedes as $sede): ?>
									<option value="<?=$sede["nit_empresa"];?>"><?=$sede["nombre"];?></option>
									<?php endforeach;?>
								</select>
							</div>
							<?php else: ?>
							<input type="hidden" name="nit_sede" id="nit_sede" value="<?=$nit_Empresa_sede;?>">
							<?php endif;?>
						</div>
					</div>
					<?php else: ?>
					<div class="col-3">
						<div class="row">
							<?php if ($usua_perfil == 1): ?>
							<div class="col-3">
								<label for="nit_sede">Sede&nbsp;*</label>
							</div>
		
							<div class="p-0 col-9">
								<select name="nit_sede" id="nit_sede" data-campo="#nit_empresa" class="form-control" 
									data-url="<?=getUrl("Utilidades", "Utilidades", "buscarClientesSede", false, "ajax"); ?>" required>
									<option value="">Seleccione ...</option>
									<?php foreach ($sedes as $sede): ?>
									<?php if ($sede["nit_empresa"] == $_GET["nit_sede"]): ?>
									<option value="<?=$sede["nit_empresa"];?>" selected><?=$sede["nombre"];?></option>
									<?php else: ?>
									<option value="<?=$sede["nit_empresa"];?>"><?=$sede["nombre"];?></option>
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

					<?php if (empty($_GET["nit_cliente"])): ?>
					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="nit_empresa">Empresa&nbsp;*</label>
							</div>
							<div class="col-10">
								<select name="nit_empresa" id="nit_empresa" class="form-control select2" 
								data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>" required>
                                    <option value="">Seleccione ...</option>
                                </select>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="col-5">
						<div class="row">
							<div class="col-2">
								<label for="nit_emp">Empresa&nbsp;*</label>
							</div>
							<div class="col-10">
								<select name="nit_emp" id="nit_emp" class="form-control select2" 
								data-urlIngreso="<?=getUrl("Preliquidacion", "Preliquidacion", "BuscarIngresoCliente", false, "ajax"); ?>" required>
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

					<?php if(empty($_GET["numero_ingreso"])): ?>
					<div class="col-3">
						<div class="row">
							<div class="col-5">
								<label for="no_ingreso">N°&nbsp;Ingreso&nbsp;*</label>
							</div>
							<div class="p-0 col-7">
								<select class="form-control select2" name="no_ingreso" id="no_ingreso" required>
								<option value="">Seleccione ...</option>
								</select>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="col-3">
						<div class="row">
							<div class="col-5">
								<label for="num_ingreso">N°&nbsp;Ingreso&nbsp;*</label>
							</div>
							<div class="p-0 col-7">
								<select class="form-control select2" name="num_ingreso" id="num_ingreso" required>
								<option value="">Seleccione ...</option>
								<?php foreach ($Ingresos as $ingreso): ?>
								<?php if ($ingreso["Numero_Ingreso"] == $_GET["numero_ingreso"]): ?>
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

				<div class="pb-3 align-items-center row">
					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoMotorEstandar"); ?>" id="motorEstandar" data-diagnostico="diagnostico_1" class="btn btn-white disabled validarDiagnostico" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/motorEstandar.svg" class="img-fluid" alt="motorEstandar">
							<i class="text-success fa fa-check fa-4x" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;"></i>
						</a>
						<h6 class="font-weight-bold">MOTOR ESTÁNDAR</h6>
					</div>

					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoMotorBomba"); ?>" id="motorBomba" class="btn btn-white disabled" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/motorBomba.svg" class="img-fluid" alt="motorBomba">
						</a>
						<h6 class="font-weight-bold">MOTOR BOMBA</h6>
					</div>

					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoMotorDC"); ?>" id="motorDC" class="btn btn-white disabled" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/motorDC.svg" class="img-fluid" alt="motorDC">
						</a>
						<h6 class="font-weight-bold">MOTOR D.C</h6>
					</div>

					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoMotorReductor"); ?>" id="motorReductor" class="btn btn-white disabled" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/motorReductor.svg" class="img-fluid" alt="motorReductor">
						</a>
						<h6 class="font-weight-bold">MOTOR REDUCTOR</h6>
					</div>
				</div>


				<div class="pb-3 align-items-center row">
					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoGenerador"); ?>" id="generador" class="btn btn-white disabled" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/generador.svg" class="img-fluid" alt="generador">
						</a>
						<h6 class="font-weight-bold">GENERADOR</h6>
					</div>

					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoMotorBlowerCentrifugo"); ?>" id="motorBlowerCentrifugo" class="btn btn-white disabled" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/motorBlowerCentrifugo.svg" class="img-fluid" alt="motorBlowerCentrifugo">
						</a>
						<h6 class="font-weight-bold">MOTOR BLOWER CENTRÍFUGO</h6>
					</div>

					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoBlowerHusillo"); ?>" id="blowerHusillo" class="btn btn-white disabled" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/blowerHusillo.svg" class="img-fluid" alt="blowerHusillo">
						</a>
						<h6 class="font-weight-bold">BLOWER HUSILLO</h6>
					</div>

					<div class="text-center col-3">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "diagnosticoMotorTurbina"); ?>" id="motorTurbina" class="btn btn-white disabled" role="button" aria-disabled="true">
							<img src="../../views/Diagnosticos/img/svg/motorTurbina.svg" class="img-fluid" alt="motorTurbina">
						</a>
						<h6 class="font-weight-bold">MOTOR TURBINA</h6>
					</div>
				</div>
			</div> <!-- FIN CONTAINER -->

		</form>
	</div>
</div>


<script>
$(document).ready(function (){
	$(document).on("change", "#nit_sede", function () {
		setTimeout(() => {
			$("#nit_empresa, #nit_emp").each(function () {
				if ($(this).val() == "") {
					$(this).trigger("change");
				}
			});
		}, 250);
	});

	$(document).on("change", "#no_ingreso, #num_ingreso", function () {
		let self = this;

		$(".validarDiagnostico").each(function () {
			if ($(self).val() != "") {
				$.ajax({
					url: "ajax.php?modulo=Diagnosticos&controlador=Diagnosticos&funcion=validarDiagnostico",
					method: "post",
					dataType: "json",
					data: {
						numero_ingreso: $(self).val(),
						tabla_diagnostico: $(this).attr("data-diagnostico"),
					}
				}).done((res) => {
					if (res[$(this).attr("data-diagnostico")] == true) {
						$(this).removeClass("disabled");
						$(this).find("i").show();
					} else {
						$(this).removeClass("disabled");
						$(this).find("i").hide();
					}
				});
			}
		});

		$(document).on("change", "#nit_empresa, #nit_emp", function () {
			setTimeout(() => {
				$("#no_ingreso, #num_ingreso").each(function () {
					if ($(this).val() == "") {
						$("a").addClass("disabled");
						$("a").find("i").hide();
					}
				});
			}, 250);
		});
	});

	if ($("#nit_sede").val() && $("#num_ingreso").val() && $("#nit_emp").val()) {
		$("#nit_sede").trigger("change");
		$("#nit_emp").trigger("change");
		$("#num_ingreso").trigger("change");
	}

	$(document).on("click", "a", function (event) {
		event.preventDefault();
		window.location.href = $(this).attr("href") + `&numero_ingreso=${$("#no_ingreso").val()}`;
	});
});
</script>