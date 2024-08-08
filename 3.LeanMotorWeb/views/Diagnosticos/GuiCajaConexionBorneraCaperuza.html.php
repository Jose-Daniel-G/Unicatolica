<?php 
@session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Caja de Conexión, Bornera y Caperuza</b>
		</h4>
	</div>

	<div class="card-body">
		<form id="formIngresos" method="post" autocomplete="off" action="<?=getUrl("Ingresos", "Ingresos", "PostCrearAC"); ?>">

			<div class="container-fluid">
				<div class="row">
					<div class="col-4">
						<div class="row">
							<div class="col-12">
								<img src="../../views/Diagnosticos/img/svg/cajaConexion.svg" class="img-fluid" alt="cajaConexion">
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<img src="../../views/Diagnosticos/img/svg/bornera.svg" class="img-fluid" alt="bornera">
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<img src="../../views/Diagnosticos/img/svg/caperuza.svg" class="img-fluid" alt="caperuza">
							</div>
						</div>

						<div class="pt-5 row">
							<div class="col-4">
								<a href="<?=getUrl("Diagnosticos", "Diagnosticos", "menuDiagnosticos", array("numero_ingreso" => $_GET["numero_ingreso"])); ?>" id="motorBomba" class="btn btn-primary" role="button">Guardar</a>
							</div>
							<div class="col-4">
								<a href="#" id="motorBomba" class="btn btn-success" role="button">Siguiente</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
	</div>
</div>

<script>
$(document).ready(function (){
	$("#opcionesCancamo").find("input").each(function () {
		$(document).on("click", "#"+$(this).attr("id"), function (){
			if ($(this).attr("id") == "suministrarCancamo") {
				$("#inputReferenciaCancamo").show();
			}else{
				$("#inputReferenciaCancamo").hide();
			}
		});
	});

	$("#opcionesPlaca").find("input").each(function () {
		$(document).on("click", "#"+$(this).attr("id"), function (){
			if ($(this).attr("id") == "suministrarPlaca") {
				$("#inputReferenciaPlaca").show();
			}else{
				$("#inputReferenciaPlaca").hide();
			}
		});
	});
});
</script>