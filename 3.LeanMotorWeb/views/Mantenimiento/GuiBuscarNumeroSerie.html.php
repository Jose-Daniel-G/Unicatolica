<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>
<div class="card">
    <div class="card-header">
        <h4>
            <b>Numero de Serie</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="preliquidacionReg" autocomplete="off" action="<?=getUrl("Preliquidacion", "Preliquidacion", "RegistrarPreliquidacion", false, "ajax");  ?>">
            <div class="container-fluid">
				<div class="pt-3 row">
					<div class="col-12">
						<div class="justify-content-center row">
							<div class="col-2">
								<label for="numSerie">Número de Serie:</label>
							</div>
							<div class="input-group col-5">
								<input type="search" name="numSerie" id="numSerie" class="form-control" placeholder="Buscar" 
								data-url="<?=getUrl("Utilidades", "Utilidades", "autocompletarBuscador", false, "ajax");  ?>">
								<div class="input-group-append">
									<button class="btn btn-outline-primary" type="button" id="buscarNumeroSerie" 
									data-url="<?=getUrl("Mantenimiento", "Mantenimiento", "obtenerDatosEquipo", false, "ajax");  ?>">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="pt-4 justify-content-center row" id="datosDelEquipo">
					<div class="pb-3 border col-7">
					
						<div class="pb-3 row">
							<div class="p-0 col-12">
								<label class="header-blue">Datos del Equipo</label>
							</div>
						</div>

						<div class="row">
							<div class="col-12">

								<div class="row">
									<div class="col-2">
										<label for="cliente">Cliente:</label>
									</div>
									<div class="col-8">
										<span id="Cliente" class="font-weight-bold" data-field="cliente"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="marca">Marca:</label>
									</div>
									<div class="col-8">
										<span id="Marca" class="font-weight-bold" data-field="marca"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="tipo">Tipo:</label>
									</div>
									<div class="col-8">
										<span id="Tipo" class="font-weight-bold" data-field="tipo"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="potencia">Potencia:</label>
									</div>
									<div class="col-8">
										<span id="Potencia" class="font-weight-bold" data-field="potencia"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="velocidad">Velocidad:</label>
									</div>
									<div class="col-8">
										<span id="Velocidad" class="font-weight-bold" data-field="velocidad"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="voltaje">Voltaje:</label>
									</div>
									<div class="col-8">
										<span id="Voltaje" class="font-weight-bold" data-field="voltaje"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-4">
										<label for="cantOIS">Cantidad&nbsp;de&nbsp;OI'S&nbsp;Asociadas:</label>
									</div>
									<div class="col-6">
										<span id="CantOIS" class="font-weight-bold" data-field="cantidad"></span>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>

				<div class="pt-5 row">
					<div class="col-12">
						<div class="justify-content-center row" id="inputNuevoNumSerie" style="display: none;">
							<div class="col-2">
								<label for="numSerie">Nuevo&nbsp;Número&nbsp;de&nbsp;Serie:</label>
							</div>
							<div class="input-group col-5">
								<input type="search" name="nuevoNumSerie" id="nuevoNumSerie" class="form-control" placeholder="Buscar" 
								data-url="<?=getUrl("Mantenimiento", "Mantenimiento", "buscarNuevoNumeroSerie", false, "ajax");  ?>">
								<div class="input-group-append">
									<button class="btn btn-outline-primary" type="button" id="buscarNuevoNumSerie">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>

						<div class="pt-3 justify-content-center row" id="opcionesCambiarCancelar" style="display: none;">
							<div class="col-1 offset-2">
								<button class="btn btn-primary" type="button" id="opcionCambiar" 
								data-url="<?=getUrl("Mantenimiento", "Mantenimiento", "cambiarNumeroSerie", false, "ajax");  ?>">Cambiar</button>
							</div>
							<div class="col-1">
								<button class="btn btn-danger" type="button" id="opcionCancelar">Cancelar</button>
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

		$(document).on("keyup", "#numSerie", function (){
			$(this).typeahead({
				source: function (query, process) {
					return $.ajax({
						url: $(this)[0].$element.attr("data-url"),
						method: "post",
						dataType: "json",
						data: {
							tabla: "equipos",
							campo: "Numero_Serie"
						}
					}).done((res) => {
						return process(res);
					});
				}
			});

			$("#opcionesCambiarCancelar").hide();
		});

		$(document).on("click", "#buscarNumeroSerie", function (){
			let inputSearch = $($(this).parents()[1]).find("input");

			if (inputSearch.val() != "") {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						Numero_Serie: inputSearch.val()
					}
				}).done((res) => {
					if (res.length >= 1) {
						$("#datosDelEquipo").find("span").each(function () {
							$(this).text(res[0][$(this).attr("data-field")])
							$("#inputNuevoNumSerie").show(1000);
						});
					}else{
						swal({
							type: "error",
							title: "No se encontrarón datos de ese equipo"
						});
						$("#datosDelEquipo").find("span").each(function () { $(this).text("") });
						$("#inputNuevoNumSerie").hide();
					}
				});
			}
		});

		$(document).on("keyup", "#nuevoNumSerie", function (){
			let inputSearch = $($(this).parents()[1]).find("input");

			if (inputSearch.val() != "") {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						Numero_Serie: inputSearch.val()
					}
				}).done((res) => {
					if (res.numSerie == false) {
						$(this).css("border", "2px solid #28a745");
					}else{
						$(this).css("border", "2px solid #dc3545");
						$("#opcionesCambiarCancelar").hide();
					}
				});
			}else{
				$(this).css("border", "");
			}
		});

		$(document).on("click", "#buscarNuevoNumSerie", function (){
			let inputSearch = $($(this).parents()[1]).find("input");

			if (inputSearch.val() != "") {
				$.ajax({
					url: inputSearch.attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						Numero_Serie: inputSearch.val()
					}
				}).done((res) => {
					if (res.numSerie == false) {
						swal({
							type: "info",
							title: "El número de serie se encuentra disponible"
						});
						$("#opcionesCambiarCancelar").show(1000);
					}else{
						swal({
							type: "error",
							title: "El número de serie no se encuentra disponible"
						});
						$("#opcionesCambiarCancelar").hide();
					}
				});
			}

			$(document).on("click", "#opcionCancelar", function (){
				$("#nuevoNumSerie").val("");
				$("#nuevoNumSerie").css("border", "");
			});

			$(document).on("click", "#opcionCambiar", function (){

				if ($("#nuevoNumSerie").val() != "") {
					$.ajax({
						url: $(this).attr("data-url"),
						method: "post",
						dataType: "json",
						data: {
							Numero_Serie: $("#numSerie").val(),
							Nuevo_Numero_Serie: $("#nuevoNumSerie").val()
						}
					}).done((res) => {
						if (res.tipoRespuesta == true) {
							swal({
								type: "success",
								title: "El Número de Serie se ha cambiado correctamente"
							});
							swal({
								type: "success",
							 	title: "El Número de Serie se ha cambiado correctamente",
							 	showConfirmButton: true,
							 	allowOutsideClick: false,
							 	allowEscapeKey: false
							 }).then((result) => {
								 window.location.reload();
							 });
						}
					});
				}
			});
		});
	});
</script>