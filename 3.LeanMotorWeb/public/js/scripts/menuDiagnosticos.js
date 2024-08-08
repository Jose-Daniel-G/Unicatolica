$(document).ready(function (){

	$(".validarDiagnostico").each(function () {
		$.ajax({
			url: "ajax.php?modulo=Diagnosticos&controlador=Diagnosticos&funcion=validarDiagnostico",
			method: "post",
			dataType: "json",
			data: {
				numero_ingreso: $("#resulIngreso").text(),
				tabla_diagnostico: $(this).attr("data-diagnostico"),
			}
		}).done((res) => {
			if (res[$(this).attr("data-diagnostico")] == true) {
				$(this).parent().find("button").css("background-color", "Green");
				$(this).parent().find("i").toggleClass("fa fa-times fa-2x fa fa-check fa-2x");
			}
		});
	});

	$(document).on("click", ".validarDiagnostico", function () {
		event.preventDefault();

		let self = this,
			camposRellenados = true,
			empleado = null,
			caja = null;

		$.ajax({
			url: "ajax.php?modulo=Diagnosticos&controlador=Diagnosticos&funcion=validarDiagnostico",
			method: "post",
			dataType: "json",
			data: {
				numero_ingreso: $("#resulIngreso").text(),
				tabla_diagnostico: $(this).attr("data-diagnostico"),
			}
		}).done((res) => {
			if (res[$(this).attr("data-diagnostico")] == false) {

				$(".filaEmpleadosCajas").each(function () {
					$(".filaEmpleadosCajas").find('select[name="empleado[]"]').each(function () {
						empleado = $(this).val();
					});

					$(".filaEmpleadosCajas").find('select[name="caja[]"]').each(function () {
						caja = $(this).val();
					});

					if (empleado == "" && caja == "") {
						event.preventDefault();
						camposRellenados = false;
					}

					if (!camposRellenados) {
						swal({
							type: "error",
							title: "Falta seleccionar la Caja y el Empleado Asignado",
						});
					} else {
						event.preventDefault();
						$("#formEmpleadosCajas").prop("action", $(self).prop("href"));
						$("#formEmpleadosCajas").submit();
					}
				});

			}
		});
	});

	// REODERNAR CONSECUTIVO PARA FORMULARIO DINÁMICO
	function reordenarConsecutivo(fila) {
		let cont = 1;

		// SE RECORRE EL ELEMENTO SELECCIONADO Y SE BUSCA SUS INPUTS Y SELECTS
		$(fila).each(function () {
			$(this).find("input, select").each(function () {
				// SE CAMBIA SU ATRIBUTO ID, POR UN NUEVO ID RESPETANDO EL ORDEN DEL CICLO
				$(this).prop("id", $(this).prop("id").replace(/\d/g, "") + cont);
			});
			cont++;
		});
	}

	$(document).on("click", "#agregarFilaEmpleadosCajas", function (){
		$(".filaEmpleadosCajas") ? cont = $(".filaEmpleadosCajas").length + 1 : cont = 1
		let optionsEmpleado = $("#empleado1").html();
		let fila = `
			<div class="filaEmpleadosCajas pt-3 row">

				<div class="col-7">
					<div class="row">
						<div class="p-0 col-2">
							<label for="empleado">Empleado</label>
						</div>
						<div class="col-10">
							<select name="empleado[]" id="empleado${cont}" class="form-control select2">
								${optionsEmpleado}
							</select>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="row">
						<div class="col-2">
							<label for="caja">Caja</label>
						</div>
						<div class="col-10">
							<select name="caja[]" id="caja${cont}" class="form-control select2">
								<option value="">Seleccione ...</option>
								<option value="1">100</option>
								<option value="2">101</option>
								<option value="3">102</option>
								<option value="4">103</option>
								<option value="5">104</option>
								<option value="6">105</option>
								<option value="7">106</option>
								<option value="8">108</option>
								<option value="9">109</option>
								<option value="10">110</option>
								<option value="11">111</option>
								<option value="12">112</option>
								<option value="13">113</option>
								<option value="14">114</option>
								<option value="15">115</option>
							</select>
						</div>
					</div>
				</div>

				<div class="col-1">
					<button type="button" class="btn btn-danger eliminarFilaEmpleadosCajas">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
		`;
		$("#contenedorEmpleadosCajas").append(fila);
		$(".select2").select2({
			language: "es",
			width: "100%",
			theme: "bootstrap"
		});
	});

	$(document).on("click", ".eliminarFilaEmpleadosCajas", function () {
		$(this).closest(".row").remove();
		reordenarConsecutivo(".filaEmpleadosCajas");
	});
});