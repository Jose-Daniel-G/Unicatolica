<?php 
@session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Conexiones, Placa y Frame - Consultando</b>
		</h4>
	</div>

	<div class="card-body">
		<form id="formDiagnosticoEstandar" method="post" autocomplete="off" action="">

			<?php foreach($Diagnostico as $diagnostico){} ?>

			<input type="hidden" name="no_ingreso" value="<?=$_GET["numero_ingreso"]; ?>">

			<div class="container-fluid">
				<div class="row">
					<div class="col-1">
						<div class="row">
							<div class="col-12">
							<?php if(empty($_GET["tipo_vista"])){$urlMenuDiagnosticos = getUrl("Diagnosticos", "Diagnosticos", "menuDiagnosticos", array("numero_ingreso" => $_GET["numero_ingreso"])); } ?>
							<?php if(!empty($_GET["tipo_vista"])){$urlMenuDiagnosticos = getUrl("Diagnosticos", "Diagnosticos", "menuDiagnosticos", array("numero_ingreso" => $_GET["numero_ingreso"], "tipo_vista" => $_GET["tipo_vista"])); } ?>
							<a href="<?=$urlMenuDiagnosticos; ?>" class="btn btn-primary" role="button" title="Volver al Menú">
								<i class="fa fa-home fa-2x"></i>
							</a>
							</div>
						</div>
					</div>
					<div class="col-8">
						<div class="row">
							<div class="col-12">
								<img src="../../views/Diagnosticos/img/svg/conexionesPlacaFrame.svg" class="img-fluid" alt="imgConexionesPlacaFrame">
							</div>
						</div>
					</div>

					<div class="col-3">

						<div class="row">

							<div class="col-6">
								<div class="row">
									<div class="p-0 col-1">
										<label for="B">B</label>
									</div>
									<div class="col-11">
										<input type="number" name="B" id="B" class="form-control" value="<?=$diagnostico["B"]; ?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-6">
								<div class="row">
									<div class="p-0 col-1">
										<label for="C">C</label>
									</div>
									<div class="col-11">
										<input type="number" name="C" id="C" class="form-control" value="<?=$diagnostico["C"]; ?>" readonly>
									</div>
								</div>
							</div>

						</div>

						<div class="pt-3 row">

							<div class="col-6">
								<div class="row">
									<div class="p-0 col-1">
										<label for="E">E</label>
									</div>
									<div class="col-11">
										<input type="number" name="E" id="E" class="form-control" value="<?=$diagnostico["E"]; ?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-6">
								<div class="row">
									<div class="p-0 col-1">
										<label for="A">A</label>
									</div>
									<div class="col-11">
										<input type="number" name="A" id="A" class="form-control" value="<?=$diagnostico["A"]; ?>" readonly>
									</div>
								</div>
							</div>

						</div>

						<div class="pt-3 row">

							<div class="col-6">
								<div class="row">
									<div class="p-0 col-1">
										<label for="AB">AB</label>
									</div>
									<div class="col-11">
										<input type="number" name="AB" id="AB" class="form-control" value="<?=$diagnostico["AB"]; ?>" readonly>
									</div>
								</div>
							</div>

							<div class="col-6">
								<div class="row">
									<div class="p-0 col-1">
										<label for="H">H</label>
									</div>
									<div class="col-11">
										<input type="number" name="H" id="H" class="form-control" value="<?=$diagnostico["H"]; ?>" readonly>
									</div>
								</div>
							</div>

						</div>

						<div class="pt-3 row">

							<div class="col-6">
								<div class="row">
									<div class="p-0 col-1">
										<label for="HD">HD</label>
									</div>
									<div class="col-11">
										<input type="number" name="HD" id="HD" class="form-control" value="<?=$diagnostico["HD"]; ?>" readonly>
									</div>
								</div>
							</div>

						</div>

					</div>

				</div>

				<div class="pt-4 row">
		
					<div class="col-6">
						<div class="row">
							<div class="text-center col-12">
								<div class="row">
									<div class="col-3">
										<h5 class="font-weight-bold">Cancamo</h5>
									</div>
								</div>
								
								<div class="row">
									<div class="col-3">
										<img src="../../views/Diagnosticos/img/svg/cancamo.svg" class="img-fluid" alt="cancamo">
									</div>
								</div>
							</div>
						</div>

						<div class="pt-3 row">
							<div class="col-3">
								<div class="justify-content-center row">
									<div class="col-4">
										<?php if ($diagnostico["Cancamo_Tiene"] == "S"): ?>
										<input class="form-control tiene" name="Cancamo_Tiene" id="Cancamo_Tiene" type="radio" style="width: 20px; margin: -5px 20px;" disabled  checked>
										<?php else: ?>
										<input class="form-control tiene" name="Cancamo_Tiene" id="Cancamo_Tiene" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
										<?php endif; ?>
									</div>
									<div class="col-8">
										<label for="Cancamo_Tiene">Tiene</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row" id="opcionesBuenoMaloCancamo" style="display: none;">
							<div class="col-3 offset-1">
								<div class="row">
									<div class="col-4">
										<?php if ($diagnostico["Cancamo_Bueno"] == "S"): ?>
										<input class="form-control tiene" name="Cancamo_Bueno" id="Cancamo_Bueno" type="radio" style="width: 20px; margin: -5px 20px;" disabled  checked>
										<?php else: ?>
										<input class="form-control" name="Cancamo_Bueno" id="Cancamo_Bueno" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
										<?php endif; ?>
									</div>
									<div class="col-8">
										<label for="Cancamo_Bueno">Bueno</label>
									</div>
								</div>

								<div class="row">
									<div class="col-12">
										<i class="fa fa-plus bg-primary text-white" style="padding: 5px; margin-left: 18px; cursor: pointer;" id="Cancamo_Malo"></i>
										<label>Malo</label>
									</div>
								</div>
							</div>

						</div>
	

						<div class="row" id="opcionesSumistrarRepararCancamo" style="display: none;">
							<div class="col-12 offset-2">
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-3">
												<div class="row">
													<div class="col-4">
														<?php if ($diagnostico["Cancamo_Suministrar"] == "S"): ?>
														<input class="form-control Cancamo_Suministrar_Reparar" name="Cancamo_Suministrar" id="Cancamo_Suministrar" type="radio" style="width: 20px; margin: -5px 20px;" disabled  checked>
														<?php else: ?>
														<input class="form-control Cancamo_Suministrar_Reparar" name="Cancamo_Suministrar" id="Cancamo_Suministrar" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
														<?php endif; ?>
													</div>
													<div class="col-6">
														<label for="Cancamo_Suministrar">Suministrar</label>
													</div>
												</div>
											</div>
											
											<div class="col-6">
												<div class="row" id="inputReferenciaCancamo" style="display: none;">
													<div class="col-4">
														<label for="Cancamo_Referencia">REF/DES</label>
													</div>
													<div class="p-0 col-8">
														<input type="text" name="Cancamo_Referencia" id="Cancamo_Referencia" class="form-control" value="<?=$diagnostico["Cancamo_Referencia"]; ?>" readonly>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="col-12 offset-2">
								<div class="row">
									<div class="col-1">
										<?php if ($diagnostico["Cancamo_Reparar"] == "S"): ?>
										<input class="form-control Cancamo_Suministrar_Reparar" name="Cancamo_Reparar" id="Cancamo_Reparar" type="radio" style="width: 20px; margin: -5px 20px;" disabled  checked>
										<?php else: ?>
										<input class="form-control Cancamo_Suministrar_Reparar" name="Cancamo_Reparar" id="Cancamo_Reparar" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
										<?php endif; ?>
									</div>
									<div class="col-8">
										<label for="Cancamo_Reparar">Reparar</label>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="col-6">
						<div class="row">
							<div class="text-center col-12">
								<div class="row">
									<div class="col-3">
										<h5 class="font-weight-bold">Placa</h5>
									</div>
								</div>
								
								<div class="row">
									<div class="col-3">
										<img src="../../views/Diagnosticos/img/svg/placa.svg" class="img-fluid" alt="placa">
									</div>
								</div>
							</div>
						</div>

						<div class="pt-3 row">
							<div class="col-3">
								<div class="justify-content-center row">
									<div class="col-4">
										<?php if ($diagnostico["Placa_Tiene"] == "S"): ?>
										<input class="form-control" name="Placa_Tiene" id="Placa_Tiene" type="radio" style="width: 20px; margin: -5px 20px;" disabled checked>
										<?php else: ?>
										<input class="form-control" name="Placa_Tiene" id="Placa_Tiene" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
										<?php endif; ?>
									</div>
									<div class="col-8">
										<label for="Placa_Tiene">Tiene</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row" id="opcionesBuenoMaloPlaca" style="display: none;">
							<div class="col-3 offset-1">
								<div class="row">
									<div class="col-4">
										<?php if ($diagnostico["Placa_Bueno"] == "S"): ?>
										<input class="form-control" name="Placa_Bueno" id="Placa_Bueno" type="radio" style="width: 20px; margin: -5px 20px;" disabled checked>
										<?php else: ?>
										<input class="form-control" name="Placa_Bueno" id="Placa_Bueno" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
										<?php endif; ?>
									</div>
									<div class="col-8">
										<label for="Placa_Bueno">Bueno</label>
									</div>
								</div>

								<div class="row">
									<div class="col-12">
										<i class="fa fa-plus bg-primary text-white" style="padding: 5px; margin-left: 18px; cursor: pointer;" id="Placa_Malo"></i>
										<label>Malo</label>
									</div>
								</div>
							</div>

						</div>
	

						<div class="row" id="opcionesSumistrarRepararPlaca" style="display: none;">
							<div class="col-12 offset-2">
								<div class="row">
									<div class="col-12">
										<div class="row">
											<div class="col-3">
												<div class="row">
													<div class="col-4">
														<?php if ($diagnostico["Placa_Suministrar"] == "S"): ?>
														<input class="form-control Placa_Suministrar_Reparar" name="Placa_Suministrar" id="Placa_Suministrar" type="radio" style="width: 20px; margin: -5px 20px;" disabled checked>
														<?php else: ?>
														<input class="form-control Placa_Suministrar_Reparar" name="Placa_Suministrar" id="Placa_Suministrar" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
														<?php endif; ?>
													</div>
													<div class="col-6">
														<label for="Placa_Suministrar">Suministrar</label>
													</div>
												</div>
											</div>
											
											<div class="col-6">
												<div class="row" id="inputReferenciaPlaca" style="display: none;">
													<div class="col-4">
														<label for="Placa_Referencia">REF/DES</label>
													</div>
													<div class="p-0 col-8">
														<input type="text" name="Placa_Referencia" id="Placa_Referencia" class="form-control" value="<?=$diagnostico["Placa_Referencia"]; ?>" readonly>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="col-12 offset-2">
								<div class="row">
									<div class="col-1">
										<?php if ($diagnostico["Placa_Reparar"] == "S"): ?>
										<input class="form-control Placa_Suministrar_Reparar" name="Placa_Reparar" id="Placa_Reparar" type="radio" style="width: 20px; margin: -5px 20px;" disabled checked>
										<?php else: ?>
										<input class="form-control Placa_Suministrar_Reparar" name="Placa_Reparar" id="Placa_Reparar" type="radio" style="width: 20px; margin: -5px 20px;" disabled>
										<?php endif; ?>
									</div>
									<div class="col-8">
										<label for="Placa_Reparar">Reparar</label>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

				<div class="pt-5 text-center row">
					<div class="col-8">
						<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "cajaConexionBorneraCaperuza", array("numero_ingreso" => $_GET["numero_ingreso"])); ?>" class="btn btn-success" role="button">Siguiente</a>
					</div>
				</div>

			</div>
	</div>
</div>

<script>
$(document).ready(function () {
	if ($("#Cancamo_Tiene").is(":checked")) {
		$("#opcionesBuenoMaloCancamo").show(500);
	}
	if (!$("#Cancamo_Bueno").is(":checked")) {
		$("#opcionesSumistrarRepararCancamo").toggle(500);
		$("#Cancamo_Malo").toggleClass("fa fa-minus fa fa-plus");
		$("#Cancamo_Bueno").prop("checked", false);
		$("#inputReferenciaCancamo").hide();
		$("#opcionesSumistrarRepararCancamo").find("input").each(function () {
			$(this).prop("checked", false);
		});
	} else {
		$("#opcionesSumistrarRepararCancamo").hide(500);
		$("#Cancamo_Malo").removeClass("fa fa-minus").addClass("fa fa-plus");
		$("#inputReferenciaCancamo").hide();
		$("#opcionesSumistrarRepararCancamo").find("input").each(function () {
			$(this).prop("checked", false);
		});
	}

	$("#opcionesSumistrarRepararCancamo").find("input").each(function () {
		if ($(this).attr("id") == "Cancamo_Suministrar") {
			if ($(this).attr("checked")) {
				$("#inputReferenciaCancamo").show();
				$("#Cancamo_Suministrar").prop("checked", true);
				$("#Cancamo_Reparar").prop("checked", false);
			}
		} else if ($(this).attr("id") == "Cancamo_Reparar") {
			if ($(this).attr("checked")) {
				$("#inputReferenciaCancamo").hide();
				$("#Cancamo_Reparar").prop("checked", true);
				$("#Cancamo_Suministrar").prop("checked", false);
				if ($("#Cancamo_Referencia").val() == "") {
					$("#Cancamo_Referencia").val("");
				}
			}
		}
	});

	// -----------------------------------------------------------------------------------------------

	if ($("#Placa_Tiene").is(":checked")) {
		$("#opcionesBuenoMaloPlaca").show(500);
	}
	if (!$("#Placa_Bueno").is(":checked")) {
		$("#opcionesSumistrarRepararPlaca").toggle(500);
		$("#Placa_Malo").toggleClass("fa fa-minus fa fa-plus");
		$("#Placa_Bueno").prop("checked", false);
		$("#inputReferenciaPlaca").hide();
		$("#opcionesSumistrarRepararPlaca").find("input").each(function () {
			$(this).prop("checked", false);
		});
	} else {
		$("#opcionesSumistrarRepararPlaca").hide(500);
		$("#Placa_Malo").removeClass("fa fa-minus").addClass("fa fa-plus");
		$("#inputReferenciaPlaca").hide();
		$("#opcionesSumistrarRepararPlaca").find("input").each(function () {
			$(this).prop("checked", false);
		});
	}

	$("#opcionesSumistrarRepararPlaca").find("input").each(function () {
		if ($(this).attr("id") == "Placa_Suministrar") {
			if ($(this).attr("checked")) {
				$("#inputReferenciaPlaca").show();
				$("#Placa_Suministrar").prop("checked", true);
				$("#Placa_Reparar").prop("checked", false);
			}
		} else if ($(this).attr("id") == "Placa_Reparar") {
			if ($(this).attr("checked")) {
				$("#inputReferenciaPlaca").hide();
				$("#Placa_Reparar").prop("checked", true);
				$("#Placa_Suministrar").prop("checked", false);
				if ($("#Placa_Referencia").val() == "") {
					$("#Placa_Referencia").val("");
				}
			}
		}
	});
});
</script>