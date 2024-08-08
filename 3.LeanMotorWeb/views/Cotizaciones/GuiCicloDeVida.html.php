<div class="card">
	<div class="card-header">
		<h4>
			<b>Estados del Documento</b>
		</h4>
	</div>

	<input type="hidden" id="tipo_documento" value="<?=$_GET["tipo_doc"];?>">
	<?php if($_GET["tipo_doc"] == "CT"): ?>
	<input type="hidden" id="nit_cliente" value="<?=$Cliente[0]["Nit_Cliente"];?>">
	<input type="hidden" id="num_ingreso" value="<?=$ingresosCT[0]["Numero_Ingreso"];?>">
	<?php endif; ?>

	<div class="card-body">
		<div class="container-fluid">
			<div class="row">
				<div class="border col-4">
					<div class="row">
						<div class="text-center col-12">
							<span id="numero_documento" style="font-size: 25px;"><?=$numero_documento;?></span>
						</div>
					</div>
					<div class="row">
						<div class="text-center col-12">
							<span><?=strtoupper($Cliente[0]["Razon_Social"]);?></span>
						</div>
					</div>
					<div class="row">
						<div class="text-center col-12">
							<span id="nit_sede"><?=$_GET["nit_sede"];?></span>
						</div>
					</div>
					<div class="pt-3 row">
						<div class="text-center col-12">
							<span>Fecha: <span class="font-weight-bold"><?=substr($cabeceraCT[0]["Fecha_Documento"], 0,10);?></span></span>
						</div>
					</div>
					<?php if($cabeceraCT[0][27]=="I"){ $estado="ANULADO"; $Estilo="#FF0000";} else{ $estado="ACTIVO"; $Estilo="#337ab7";}?>
					<div class="pt-3 row">
						<div class="text-center col-12">
							<font size="4" color="<?=$Estilo;?>"><?=$estado;?></font>
						</div>
					</div>
				</div>

				<div class="col-7 offset-1">
					<div class="row">
						<div class="col-12" id="containerTablaEstadosCicloVida">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


<script>
$(document).ready(function () {
	$(function tablaEstadosCicloVida() {
		$.ajax({
			url: "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=tablaEstadosCicloVida",
			method: "post",
			dataType: "json",
			data: {
				Numero_Documento: $("#numero_documento").text(),
				tipo_doc: $("#tipo_documento").val(),
				num_ingreso: $("#num_ingreso").val(),
				nit_sede: $("#nit_sede").text(),
				nit_cliente: $("#nit_cliente").val(),
			}
		}).done((res) => {
			$("#containerTablaEstadosCicloVida").html(res.tablaEstadosCicloVida);
		});
	});
});
</script>