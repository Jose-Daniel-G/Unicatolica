<?php @session_start(); $usua_perfil=$_SESSION['usua_perfil']; $nit_Empresa_sede=$_SESSION['Nit_Empresa'];?>
<div class="card">
    <div class="card-header">
        <h4>
            <b>Nit de Cliente</b>
        </h4>
    </div>

    <div class="card-body">
        <form method="post" id="preliquidacionReg" autocomplete="off" action="<?=getUrl("Preliquidacion", "Preliquidacion", "RegistrarPreliquidacion", false, "ajax");  ?>">
            <div class="container-fluid">
				<div class="pt-3 row">
					<div class="col-12">
						<div class="justify-content-center row">
							<div class="col-2">
								<label for="nitCliente">Nit de Cliente:</label>
							</div>
							<div class="input-group col-5">
								<input type="search" name="nitCliente" id="nitCliente" class="form-control" placeholder="Buscar" 
								data-url="<?=getUrl("Utilidades", "Utilidades", "autocompletarBuscador", false, "ajax");  ?>">
								<div class="input-group-append">
									<button class="btn btn-outline-primary" type="button" id="buscarNitCliente" 
									data-url="<?=getUrl("Mantenimiento", "Mantenimiento", "obtenerDatosCliente", false, "ajax");  ?>">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="pt-4 justify-content-center row" id="datosDelCliente">
					<div class="pb-3 border col-7">
					
						<div class="pb-3 row">
							<div class="p-0 col-12">
								<label class="header-blue">Datos del Cliente</label>
							</div>
						</div>

						<div class="row">
							<div class="col-12">

								<div class="row">
									<div class="col-2">
										<label for="razon">Razón&nbsp;Social:</label>
									</div>
									<div class="col-8">
										<span id="Razon" class="font-weight-bold" data-field="cliente"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="nit">Nit:</label>
									</div>
									<div class="col-8">
										<span id="Nit" class="font-weight-bold" data-field="nit"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="ciudad">Ciudad:</label>
									</div>
									<div class="col-8">
										<span id="Ciudad" class="font-weight-bold" data-field="ciudad"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="direccion">Dirección:</label>
									</div>
									<div class="col-8">
										<span id="Direccion" class="font-weight-bold" data-field="direccion"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-2">
										<label for="telefono">Teléfono:</label>
									</div>
									<div class="col-8">
										<span id="Telefono" class="font-weight-bold" data-field="telefono"></span>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="pt-5 row">
					<div class="col-12">
						<div class="justify-content-center row" id="inputNuevoNitCliente" style="display: none;">
							<div class="col-2">
								<label for="numSerie">Nuevo&nbsp;Nit&nbsp;de&nbsp;Cliente:</label>
							</div>
							<div class="input-group col-5">
								<input type="search" name="nuevoNitCliente" id="nuevoNitCliente" class="form-control" placeholder="Buscar" 
								data-url="<?=getUrl("Mantenimiento", "Mantenimiento", "buscarNuevoNitCliente", false, "ajax");  ?>">
								<div class="input-group-append">
									<button class="btn btn-outline-primary" type="button" id="buscarNuevoNitCliente">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>

						<div class="pt-3 justify-content-center row" id="opcionesCambiarCancelar" style="display: none;">
							<div class="col-1 offset-2">
								<button class="btn btn-primary" type="button" id="opcionCambiar" 
								data-url="<?=getUrl("Mantenimiento", "Mantenimiento", "cambiarNitCliente", false, "ajax");  ?>">Cambiar</button>
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

		$(document).on("keyup", "#nitCliente", function (){
			$(this).typeahead({
				source: function (query, process) {
					return $.ajax({
						url: $(this)[0].$element.attr("data-url"),
						method: "post",
						dataType: "json",
						data: {
							tabla: "clientes",
							campo: "Nit_Cliente"
						}
					}).done((res) => {
						return process(res);
					});
				}
			});

			$("#opcionesCambiarCancelar").hide();
		});

		$(document).on("click", "#buscarNitCliente", function (){
			let inputSearch = $($(this).parents()[1]).find("input");

			if (inputSearch.val() != "") {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						Nit_Cliente: inputSearch.val()
					}
				}).done((res) => {
					if (res.length >= 1) {
						$("#datosDelCliente").find("span").each(function () {
							$(this).text(res[0][$(this).attr("data-field")])
							$("#inputNuevoNitCliente").show(1000);
						});
					}else{
						swal({
							type: "error",
							title: "No se encontrarón datos de ese cliente"
						});
						$("#datosDelCliente").find("span").each(function () { $(this).text("") });
						$("#inputNuevoNitCliente").hide();
					}
				});
			}
		});

		$(document).on("keyup", "#nuevoNitCliente", function (){
			let inputSearch = $($(this).parents()[1]).find("input");

			if (inputSearch.val() != "") {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						Nit_Cliente: inputSearch.val()
					}
				}).done((res) => {
					if (res.nitCliente == false) {
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

		$(document).on("click", "#buscarNuevoNitCliente", function (){
			let inputSearch = $($(this).parents()[1]).find("input");

			if (inputSearch.val() != "") {
				$.ajax({
					url: inputSearch.attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						Nit_Cliente: inputSearch.val()
					}
				}).done((res) => {
					if (res.nitCliente == false) {
						swal({
							type: "info",
							title: "El nit de cliente se encuentra disponible"
						});
						$("#opcionesCambiarCancelar").show(1000);
					}else{
						swal({
							type: "error",
							title: "El nit de cliente no se encuentra disponible"
						});
						$("#opcionesCambiarCancelar").hide();
					}
				});
			}

			$(document).on("click", "#opcionCancelar", function (){
				$("#nuevoNitCliente").val("");
				$("#nuevoNitCliente").css("border", "");
			});

			$(document).on("click", "#opcionCambiar", function (){

				if ($("#nuevoNitCliente").val() != "") {
					$.ajax({
						url: $(this).attr("data-url"),
						method: "post",
						dataType: "json",
						data: {
							Nit_Cliente: $("#nitCliente").val(),
							Nuevo_Nit_Cliente: $("#nuevoNitCliente").val()
						}
					}).done((res) => {
						if (res.tipoRespuesta == true) {
							swal({
								type: "success",
								title: "El Nit de Cliente se ha cambiado correctamente"
							});
							swal({
								type: "success",
							 	title: "El Nit de Cliente se ha cambiado correctamente",
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