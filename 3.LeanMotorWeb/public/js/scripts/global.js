/**********************QUITAR AUTOCOMPLETAR**************************
    $("form").attr('autocomplete', 'off');*/

$(document).ready(function () {
	// EVITAR QUE SE ENVIE EL FORMULARIO CON ENTER
	$("form").keypress(function (e) {
		if (e.which == 13) {
			return false;
		}
	});

	// EVITAR DATOS DUPLICADOS EN EL DATATABLE
	function filtrarDatatableSinDuplicados(table, index) {
		var allowFilter = [table];
		var key,
			array = [];
		$.fn.dataTableExt.afnFiltering.push(
			function (oSettings, aData, iDataIndex) {
				if ($.inArray(oSettings.nTable.getAttribute("id"), allowFilter) == -1) {
					// if not table should be ignored
					return true;
				}
				if (array[iDataIndex]) return true;
				key = aData[index];
				if (array.indexOf(key) < 0) {
					array[iDataIndex] = key;
					return true;
				} else {
					return false;
				}
			}
		);
	}

	// COLOCAR EL NOMBRE DEL FORMULARIO ACTUAL EN LA PESTAÑA DEL NAVEGADOR
	if ($(document).find("b").text()) {
		$("#titlePage").text($(document).find("b").text());
	}

	// SCRIPT SELECT 2
	$(".select2").select2({
		language: "es",
		width: "100%",
		theme: "bootstrap"
	});

	// HABILITAR SELECT 2
	$(document).on("click", ".enabledSelect2", function () {
		if ($(this).parents().eq(1).find("select").val() != "" && $(this).parents().eq(1).find("select").val() != 0) {
			$(this).parents().eq(1).find("select").prop("disabled", false);
		}
	});

	// DESHABILITAR SELECT 2
	$(document).on("click", ".disabledSelect2", function () {
		if ($(this).parents().eq(1).find("select").val() != "" && $(this).parents().eq(1).find("select").val() != 0) {
			$(this).parents().eq(1).find("select").prop("disabled", true);
		}
	});
	// FIN SCRIPT SELECT 2

	// REODERNAR CONSECUTIVO PARA FORMULARIO DINÁMICO
	function reordenarConsecutivo(fila){
		let cont = 1;
		
		// SE RECORRE EL ELEMENTO SELECCIONADO Y SE BUSCA SUS INPUTS Y SELECTS
		$(fila).each(function (){
			$(this).find('input[type="text"], select').each(function (){
				// SE CAMBIA SU ATRIBUTO ID, POR UN NUEVO ID RESPETANDO EL ORDEN DEL CICLO
				$(this).prop("id", $(this).prop("id").replace(/\d/g,"") + cont);
			});
			cont++;
		});
	}

	// SCRIPT DATEPICKER
	$(".datepicker").css({
		fontSize: 17,
	});
	$(".datepicker").datepicker({
		changeYear: true,
		dateFormat: "yy-mm-dd",
		yearRange: "1940:2040",
		showMonthAfterYear: true,
	});
	$(document).on("click", ".removeDatepicker", function () {
		$(this).parent().parent().find("input").val("");
	});
	// FIN SCRIPT DATEPICKER

	// SCRIPT NUMERAL-> FORMATEAR NUMEROS
	$(".format").each(function () {
		$(this).val(numeral($(this).val()).format("0,0"));
	});
	$(".format").on({
		"input": function (event) {
			this.value = this.value.replace(/[^0-9]/g, '');
		},
		"keyup": function (event) {
			$(event.target).val(numeral($(event.target).val()).format("0,0"));
		}
	});
	// FIN SCRIPT NUMERAL

	// NO PERMITIR LETRAS, SOLO NÚMEROS
	$(".number").on({
		"input": function (event) {
			this.value = this.value.replace(/[^0-9]/g, '');
		}
	});
	// FIN NO PERMITIR LETRAS, SOLO NÚMEROS
	

	// SCRIPTS DEL FORMULARIO PRUEBAS ELÉCTRICAS
	$(function validarFormPruelec() {
		$("#RegIngresoPruebaElectrica").click(function (event) {
			if (!$("#formPruebasElectricas").parsley().isValid()) {
				swal({
					type: "error",
					title: "Oops...",
					text: "Por favor, revise los campos marcados con el mensaje de error!",
				});
			}
		});
		$("#resetTacaConexiones").on("click", function () {
			$("#TacaConexionesView").find("input").prop("checked", false);
		});
		$("#resetCajaConexiones").on("click", function () {
			$("#CajaConexionesView").find("input").prop("checked", false);
		});
		$("#resetBornera").on("click", function () {
			$("#borneraView").find("input").prop("checked", false);
			$("#pruelecBorneraView").addClass("d-none");
		});
		$("#resetPruelecBornera").on("click", function () {
			$("#pruelecBorneraView").find("input").prop("checked", false).prop("disabled", false);
		});
	});

	$(function togglePruelecBornera() {
		$("input[id=Bornera_Trae]").on("click", function () {
			$("#pruelecBorneraView").removeClass("d-none");
		});
		$("input[id=Bornera_NoTrae]").on("click", function () {
			$("#pruelecBorneraView").addClass("d-none");
		});
		$("input[id=aterrizadaSi]").on("click", function () {
			$("input[id=pasaPruebaNo]").prop("checked", true);
			$("input[id=pasaPruebaSi]").prop("disabled", true);
			$("input[id=pasaPruebaNo]").prop("disabled", false);
			$("input[id=repararBornera]").prop("disabled", false);
			$("input[id=cambiarBornera]").prop("disabled", false);
			$("input[id=mantenimientoBornera]").prop("disabled", false);
		});
		$("input[id=aterrizadaNo]").on("click", function () {
			$("input[id=pasaPruebaSi]").prop("checked", true);
			$("input[id=pasaPruebaNo]").prop("disabled", true);
			$("input[id=pasaPruebaSi]").prop("disabled", false);
			$("input[id=repararBornera]").prop("disabled", true);
			$("input[id=cambiarBornera]").prop("disabled", true);
			$("input[id=mantenimientoBornera]").prop("disabled", true);
		});
	});

	$(function toggleBobinarEstator() {
		$("#bobinarEstator").on("click", function () {
			$("#bobinarEstatorView").toggle();
		});
	});
	// FIN SCRIPTS DEL FORMULARIO PRUEBAS ELÉCTRICAS

	$(document).on("click", "#btncprouccion", function () {

		var ayo = $('#ayo').val();
		var mes = $('#mes').val();
		var oi = $('#num_oi').val();
		var cliente = $('#cliente').val();
		var uneg = $('#unineg').val();
		var url = $(this).attr("data-url");

		$.ajax({
			url: url,
			data: "ayo=" + ayo + "&mes=" + mes + "&oi=" + oi + "&cliente=" + cliente + "&uneg=" + uneg,
			type: "POST",
			success: function (dato) {

				$("#list_costoProduccion").html(dato);
			}


		});

	});

	$(document).on("blur", "#num_oi", function () {

		var oi = $('#num_oi').val();
		var url = $(this).attr("data-url");

		$.ajax({
			url: url,
			data: "oi=" + oi,
			type: "POST",
			success: function (dato) {

				$("#datosequi_oi").html(dato);

			}


		});

	});


	$(document).on("click", "#btnoi", function () {
		var url = $(this).attr("data-url");
		var oi = $('#num_oi').val();

		$.ajax({
			url: url,
			data: "oi=" + oi,
			type: "POST",
			success: function (dato) {
				$("#listaOi").html(dato);
				$("#ModalVerOi").modal('show');
			}


		});


	});

	$(document).on("click", "#mo", function () {
		var url = $(this).attr("data-url");
		var uneg = $(this).attr("data-id");

		$.ajax({
			url: url,
			data: "&uneg=" + uneg,
			type: "POST",
			success: function (dato) {
				$("#listaMO").html(dato);
				$("#ModalVerMO").modal('show');
			}

		});

	});

	$(document).on("click", "#mp", function () {
		var url = $(this).attr("data-url");
		var uneg = $(this).attr("data-id");

		$.ajax({
			url: url,
			data: "&uneg=" + uneg,
			type: "POST",
			success: function (dato) {
				$("#listaMO").html(dato);
				$("#ModalVerMO").modal('show');
			}

		});

	});

	$(document).on("click", "#gd", function () {
		var url = $(this).attr("data-url");
		var uneg = $(this).attr("data-id");

		$.ajax({
			url: url,
			data: "&uneg=" + uneg,
			type: "POST",
			success: function (dato) {
				$("#listaMO").html(dato);
				$("#ModalVerMO").modal('show');
			}

		});

	});


	$(document).on("click", "#fact", function () {
		var url = $(this).attr("data-url");
		var uneg = $(this).attr("data-id");

		$.ajax({
			url: url,
			data: "&uneg=" + uneg,
			type: "POST",
			success: function (dato) {
				$("#listaMO").html(dato);
				$("#ModalVerMO").modal('show');
			}

		});
	});


	$(document).on("change", ".producto", function () {
		var datoPro = $(this).val();
		var url = (this).attr('data-url');
		// alert('doneya Restrepo'+datopro);
		$.ajax({
			url: url,
			data: "desc=" + datoPro,
			type: "POST",
			success: function (dato) {
				$('#info_productoSerGER').html(dato);
				$("#info_productoSerGER").css({
					"overflow": "auto",
					"height": "100px"
				});
			}
		});
	});

	$(document).on("click", "#img_ayuda", function () {
		$('#ayuda').modal('show');
	});


	$(document).on("click", "#cif", function () {
		var uneg = $(this).attr("data-id");
		var url = $(this).attr("data-url");

		$.ajax({
			url: url,
			data: "uneg=" + uneg,
			type: 'POST',
			success: function (dato) {
				$("#listaMO").html(dato);
				$("#ModalVerMO").modal('show');

			}

		});


	});

	$(document).on("click", "#btn_agregarFilaGER", function () {
		let cont = parseInt($(".fila_DetalleGER").find(".itemDetalle").last().val()) + 1;
		if (!cont) {
			cont = 1;
		}
		let options_productos = $("#options_productos").html();
		let item = $(".fila_DetalleGER").length + 1;
		let fila = `
			<div class="pt-2 pb-2 fila_DetalleGER row">

				<div class="col-6">
					<div class="row">
							<input type="hidden" id="item${cont}" name="item[]" class="itemDetalle" value="${item}">
						<div class="col-6">
							<select name="producto[]" id="producto${cont}" class="form-control select2 productos_servicios" data-url="ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=obtenerIvaProductoServicio" required>
								${options_productos}
							</select>
						</div>
	
						<input type="hidden" name="iva[]" id="iva${cont}" class="ivaDetalle">
						<input type="hidden" name="valoriva[]" id="valoriva${cont}" class="valorivaDetalle">
	
						<div class="p-0 col-6">
							<input type="text" name="detalle[]" id="detalle${cont}" class="form-control" required>
						</div>
					</div>
				</div>
	
				<div class="col-5">
					<div class="row">
						<div class="col-3">
							<input type="text" name="cant[]" id="cant${cont}" class="form-control text-center cantDetalle number" value="1" required>
						</div>
	
						<div class="p-0 col-3">
							<input type="text" name="valor[]" id="valor${cont}" class="format form-control text-right valorDetalle" required>
						</div>
	
						<div class="col-3">
							<input type="text" name="desc[]" id="desc${cont}" class="form-control text-center descDetalle number" required>
						</div>
	
						<div class="p-0 col-3">
							<input type="text" name="subtotal[]" id="subtotal${cont}" class="format form-control text-right subtotalDetalle" required>
						</div>
					</div>
				</div>
	
				<div class="col-1 align-self-center">
					<button type="button" class="btn btn-danger fa fa-minus btn_eliminarGER" title="Eliminar fila"></button>
				</div>

			</div>`;
		fila += `
			<div class="col-1" id="btn_agregarFila2GER">
				<div class="row">
					<div class="col-6">
						<button type="button" id="btn_agregarFilaGER" class="btn btn-dark"><i class="fa fa-plus"></i></button>
					</div>
					<div class="col-6">
						<button type="submit" class="btn btn-primary" title="Grabar"><i class="fa fa-save"></i></button>
					</div>
				</div>
			</div>`;
		$("#btn_agregarFila2GER").last().remove();
		$("#Detalle_GER").append(fila);
		$(".select2").select2({
			language: "es",
			width: "100%",
			theme: "bootstrap"
		});
		$(".format").each(function () {
			$(this).val(numeral($(this).val()).format("0,0"));
		});
		$(".format").on({
			"input": function (event) {
				this.value = this.value.replace(/[^0-9]/g, '');
			},
			"keyup": function (event) {
				let format = numeral($(event.target).val());
				$(event.target).val(format.format("0,0"));
			}
		});
		$(".number").on({
			"input": function (event) {
				this.value = this.value.replace(/[^0-9]/g, '');
			}
		});
		cont++;
	});


	$(document).on("click", "#btn_agregarFilaDetalle_General", function () {
		let cont = parseInt($(".fila_Detalle_General").find(".itemDetalle").last().val()) + 1;
		if (!cont) {
			cont = 1;
		}
		let options_productos = $("#options_productos").html();
		let item = $(".fila_Detalle_General").length + 1;
		let fila = `
			<div class="pt-2 pb-2 fila_Detalle_General row">

				<div class="col-10">
					<div class="row">
						<input type="hidden" id="item${cont}" name="item[]" class="itemDetalle" value="${item}">
						<div class="col-5">
							<select name="producto[]" id="producto${cont}" class="form-control select2 productos_servicios" required>
								${options_productos}
							</select>
						</div>

						<div class="col-7">
							<input type="text" name="detalle[]" id="detalle${cont}" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="col-1">
					<div class="row">
						<div class="p-0 col-11">
							<input type="text" name="cant[]" id="cant${cont}" class="form-control text-center number cantDetalle" required>
						</div>
					</div>
				</div>

				<div class="col-1 align-self-center">
					<button type="button" class="btn btn-danger fa fa-minus btn_eliminarFilaDetalle_General" title="Eliminar fila"></button>
				</div>
			</div>`;
			fila += `
			<div class="col-1" id="btn_agregarFila2Detalle_General">
				<div class="row">
					<div class="col-6">
						<button type="button" id="btn_agregarFilaDetalle_General" class="btn btn-dark"><i class="fa fa-plus"></i></button>
					</div>
					<div class="col-6">
						<button type="submit" class="btn btn-primary" title="Grabar"><i class="fa fa-save"></i></button>
					</div>
				</div>
			</div>`;
		$("#btn_agregarFila2Detalle_General").last().remove();
		$("#Detalle_General").append(fila);
		$(".select2").select2({
			language: "es",
			width: "100%",
			theme: "bootstrap"
		});
		$(".number").on({
			"input": function (event) {
				this.value = this.value.replace(/[^0-9]/g, '');
			}
		});
		cont++;
	});

	$(document).on("click", ".btn_eliminarFilaDetalle_General", function () {
		$(this).closest(".row").remove();

		if ($(".fila_Detalle_General").length <= 1) {
			$("#btn_agregarFila2Detalle_General").last().remove();
		}

		let numeroRegistro = $(this).closest(".row").find('input[name="Numero_Registro_Editar[]"]').val();
		let tipo_doc = $("#tipo_documento").val();
		let url = $(this).attr("data-url");

		if (numeroRegistro && tipo_doc && url) {
			$(document).on("submit", "form", function () {
				$.ajax({
					url: url,
					method: "post",
					data: {
						"tipo_doc": tipo_doc,
						"Numero_Registro": numeroRegistro
					}
				});
			});
		}
	});

	$(document).on("click", "#reprocesoOrdenTrabajo", function () {
		if ($("#estadoOrdenTrabajo").text() == "ACTIVO") {
			if ($("#estadoReproceso").text() != "Reproceso") {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						Orden_Maestra: $("#Orden_Maestra").val()
					}
				}).done((res) => {
					if (res.estadoReproceso == false) {
						$("#numOrden").hide();
						$("#Detalle_General").empty();
						$("#formEditOrdenTrabajo").attr("id", "ordenTrabajoReg").attr("action", "ajax.php?modulo=OrdenTrabajo&controlador=OrdenTrabajo&funcion=RegistrarOrdenTrabajo");
					} else {
						swal({
							type: "error",
							title: "La Orden de Trabajo ya tiene un Reproceso",
							html: `<h2 class="swal2-title">Número: <span class="badge badge-secondary">${res.numReproceso}</span></h2>
								   <div class="swal2-content" style="display: block;">Desea Verlo?</div>`,
							showCancelButton: true,
							confirmButtonColor: "#337ab7",
							confirmButtonText: "Sí",
							cancelButtonColor: "#d33",
							cancelButtonText: "No",
							allowOutsideClick: false,
							allowEscapeKey: false,
						}).then((result) => {
							if (result.value) {
								window.open(
									`index.php?modulo=OrdenTrabajo&controlador=OrdenTrabajo&funcion=getEditarOrdenTrabajo
										&numero_doc=${res.numReproceso}&nit_sede=${$("#nit_sede").val()}
									`);
							}
						});
					}
				});
			} else {
				swal({
					type: "error",
					title: "La Orden de Trabajo ya es un Reproceso"
				});
			}
		} else {
			swal({
				type: "error",
				title: "La Orden de Trabajo se encuentra Anulada"
			});
		}
	});

	$(document).on("click", "#actualizarOrdenTrabajo", function () {
		if ($("#estadoOrdenTrabajo").text() == "ACTIVO") {
			$("#nit_sede").val();
			$.ajax({
				url: "ajax.php?modulo=OrdenTrabajo&controlador=OrdenTrabajo&funcion=BuscarDetalleIngreso",
				method: "post",
				data: {
					ingreso: $("#no_ingreso").val(),
					nit_sede: $("#nit_sede").val()
				},
			}).done((res) => {
				$("#Detalle_General").html(res);
				swal({
					type: "success",
					title: "Detalle actualizado con éxito"
				});
			});
		} else {
			swal({
				type: "error",
				title: "La Orden de Trabajo se encuentra Anulada"
			});
		}
	});

	$(document).on("click", "#PdfOrdenTrabajo", function () {
		var numero_doc = $("#numero_orden").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/OrdenTrabajo/GuiImprimirOrdenTrabajo.html.php?";

		window.open(url + "numero_doc=" + numero_doc + "&nit_sede=" + nit_sede);
	});

	$(document).on("click", "#WordOrdenTrabajo", function () {
		var numero_doc = $("#numero_orden").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/OrdenTrabajo/GuiWordOrdenTrabajo.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc + "&nit_sede=" + nit_sede;
	});

	$(document).on("click", "#PdfGastoDirecto", function () {
		var numero_doc = $("#numGD").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/GastosDirectos/GuiImprimirGD.html.php?";

		window.open(url + "numero_doc=" + numero_doc + "&nit_sede=" + nit_sede);
	});

	$(document).on("click", "#WordGastoDirecto", function () {
		var numero_doc = $("#numGD").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/GastosDirectos/GuiWordGD.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc + "&nit_sede=" + nit_sede;
	});

	function calcularTotalDetalle() {
		var tot = 0;
		var tdesc = 0;
		var total_iva = 0;
		var tsub = 0;
		var ivauno = 0;

		$(".fila_DetalleGER").each(function () {
			var valor = numeral($(this).find(".valorDetalle").val()).value();
			var cant = $(this).find(".cantDetalle").val();
			var descto = $(this).find(".descDetalle").val();
			var ivapro = $(this).find(".ivaDetalle").val();
			var valor_iva = 0;
			var subtotal = valor * cant;

			if (ivapro === "") {
				valor_iva = 0;
			} else {
				valor_iva = ($(this).find(".ivaDetalle").val() / 100) * subtotal;
			}

			if (descto == "") {
				descto = 0;
				$(this).find(".descDetalle").val(descto);
			} else {
				destouno = subtotal * ($(this).find(".descDetalle").val() / 100);
				subtotal = subtotal - destouno;
			}
			$(this).find(".subtotalDetalle").val(numeral(subtotal).format("0,0"));
			$(this).find(".valorivaDetalle").val(valor_iva);

			subtotaluno = $(this).find(".cantDetalle").val() * numeral($(this).find(".valorDetalle").val()).value();
			destouno = subtotaluno * ($(this).find(".descDetalle").val() / 100);
			subt = subtotaluno - destouno;
			ivauno = subt * ($(this).find(".ivaDetalle").val() / 100);
			tsub = tsub + subt;
			tot = tot + subt + ivauno;
			tdesc = tdesc + destouno;
			total_iva = total_iva + ivauno;
		});

		$("#subtotal_doc").val(numeral(tsub).format("0,0"));
		$("#tdescuento").val(numeral(tdesc).format("0,0"));
		$("#tdoc").val(numeral(tot).format("0,0"));
		$("#tiva").val(numeral(total_iva).format("0,0"));
	}

	function ordenarItemDetalle() {
		$(".fila_DetalleGER").each(function (index) {
			$(this).find(".itemDetalle").val(index + 1);
		});
	}

	$(document).on("blur", ".fila_DetalleGER", function () {
		calcularTotalDetalle();
	});

	$(document).on("click", ".btn_eliminarGER", function () {
		$(this).closest(".row").remove();

		if ($(".fila_DetalleGER").length <= 1) {
			$("#btn_agregarFila2GER").last().remove();
		}

		var tot = 0;
		var tdesc = 0;
		var total_iva = 0;
		var tsub = 0;
		var ivauno = 0;
		var item = 1;

		$(".fila_DetalleGER").each(function () {
			$(this).find(".itemDetalle").val(item);
			subtotaluno = $(this).find(".cantDetalle").val() * numeral($(this).find(".valorDetalle").val()).value();
			destouno = subtotaluno * ($(this).find(".descDetalle").val() / 100);
			subt = subtotaluno - destouno;
			ivauno = subt * ($(this).find(".ivaDetalle").val() / 100);
			tsub = tsub + subt;
			tot = tot + subt + ivauno;
			tdesc = tdesc + destouno;
			total_iva = total_iva + ivauno;
			item++;
		});

		$("#subtotal_doc").val(numeral(tsub).format("0,0"));
		$("#tdescuento").val(numeral(tdesc).format("0,0"));
		$("#tdoc").val(numeral(tot).format("0,0"));
		$("#tiva").val(numeral(total_iva).format("0,0"));

		let numeroRegistro = $(this).closest(".row").find('input[name="Numero_Registro_Editar[]"]').val();
		let tipo_doc = $("#tipo_documento").val();
		let url = $(this).attr("data-url");

		if (numeroRegistro && tipo_doc && url) {
			$(document).on("submit", "form", function () {
				$.ajax({
					url: url,
					method: "post",
					data: {
						"tipo_doc": tipo_doc,
						"Numero_Registro": numeroRegistro
					}
				});
			});
		}
	});

	$(document).on("change", ".productos_servicios", function () {
		let codigo = $(this).val();

		if (codigo != "") {
			$.ajax({
				url: $(this).attr("data-url"),
				method: "post",
				dataType: "json",
				data: {
					Codigo: codigo
				}
			}).done((res) => {
				$(this).closest(".row").find(".ivaDetalle").val(res.Porcentaje_Iva)
			});
		}
	});

	$(document).on("click", ".listProGer", function () {
		var dato = $(this).attr("data-id");
		var descProServ = $(this).attr('data-desc');
		var destino = $(this).attr('data-destino');
		var iva = $(this).attr('data-iva');

		$('#producto_id' + destino).val(dato);
		$('#producto' + destino).val(descProServ);
		$("#iva" + destino).val(iva);
		$('#info_productoSerGER').hide();
	});

	$(document).on("click", "#VerDatosGER", function () {
		var url = $(this).attr('data-url');
		var numCT = $('#numCT').val();
		var tipo_doc = $('#tipo_doc').val();
		var nit_sede = $('#nit_sede').val();

		$.ajax({
			url: url,
			data: {
				numCT: numCT,
				tipo_doc: tipo_doc,
				nit_sede: nit_sede
			},
			type: "POST",
			success: function (dato) {
				$('#div_Datos_Adicionales').html(dato);
				$('#VerDatos').modal('show');
			}
		});
	});

	$(document).on("click", "#VerDatosIngreso", function () {
		var url = $(this).attr('data-url');
		var num_doc = $('#Numero_Ingreso').val();
		var sede = $('#nit_sede').val();

		$.ajax({
			url: url,
			data: "num_doc=" + num_doc + "&nit_sede=" + sede,
			type: "POST",
			success: function (dato) {
				$('#div_DatosAdicionales').html(dato);
				$('#VerDatosAdicionales').modal('show');
			}
		});
	});

	$(document).on("click", "#AnularGER", function () {
		var url = $(this).attr('data-url');
		var numCT = $('#numCT').val();
		var tipo_doc = $('#tipo_doc').val();
		var nit_sede = $('#nit_sede').val();

		if (numCT != "") {
			var msjAnular = confirm("Desea Anular la Cotizacion!");

			if (msjAnular == true) {
				var razonAnula = prompt("Ingrese la Razon por la cual Anula");
				if (razonAnula != "") {

					$.ajax({
						url: url,
						data: "numCT=" + numCT + "&tipo_doc=" + tipo_doc + "&Razon_Anula=" + razonAnula + "&nit_sede=" + nit_sede,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}

	});

	$(document).on("click", "#AnularFactura", function () {
		var url = $(this).attr('data-url');
		var numFVC = $('#numFVC').val();
		var nit_sede = $('#nit_sede').val();

		if (numFVC != "") {
			var msjAnular = confirm("Desea Anular la Factura!");

			if (msjAnular == true) {
				var razonAnula = prompt("Ingrese la Razon por la cual Anula");
				if (razonAnula != "") {

					$.ajax({
						url: url,
						data: "numFVC=" + numFVC + "&tipo_doc=" + "FVC" + "&Razon_Anula=" + razonAnula + "&nit_sede=" + nit_sede,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}

	});


	$(document).on("click", "#AnularIngreso", function () {
		var url = $(this).attr('data-url');
		var num_doc = $('#Numero_Ingreso').val();
		var nit_sede = $('#nit_sede').val();

		if (num_doc != "") {
			var msjAnular = confirm("Desea Anular el Ingreso!");

			if (msjAnular == true) {
				var razonAnula = prompt("Ingrese la Razon por la cual Anula");
				if (razonAnula != "") {

					$.ajax({
						url: url,
						data: "num_doc=" + num_doc + "&nit_sede=" + nit_sede + "&Razon_Anula=" + razonAnula,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
							window.location.href = "index.php";
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}
	});

	$(document).on("keyup", ".type-number", function (event) {
		$(this).find("input").each(function () {
			this.value = this.value.replace(/[^0-9]/g, '');
		});
	});

	$(document).on("submit", "#formIngresos", function (event) {

		let camposRellenados = true;

		$(".datosElectricos").find("input, select").each(function () {
			if ($(this).val() == "") {
				event.preventDefault();
				camposRellenados = false;
			}
		});

		if (!camposRellenados) {
			swal({
				type: "error",
				title: "Complete los datos eléctricos",
			});
		}
	});

	$(function validarNumeroSerie() {
		$(document).on("keyup", "#validNumeroSerie", function () {
			$.ajax({
				url: $(this).attr("data-url"),
				method: "post",
				dataType: "json",
				data: {
					Numero_Serie: $(this).val()
				},
			}).done((res) => {
				window.submit = false;
				
				if (res.existeNumSerie == true) {
					
					$(document).on("submit", "form", function (event) {
						
						if (submit == false) {
							swal({
								type: "error",
								title: "Ese número de serie ya existe",
								width: "600px",
								html: `
									<div class="row">
										<div class="col-12">
											<div class="table-responsive">
												<table class="table-bordered table-hover">
													<thead class="table text-white bg-primary thead-primary">
														<tr>
															<th>Cliente</th>
															<th>Tipo</th>
															<th>Potencia</th>
															<th>Velocidad</th>
															<th>Voltaje</th>
														</tr>
													</thead>
			
													<tbody>
														<tr>
															<td class="text-center w-50" style="font-size: 17px;">
																${res.Cliente}
															</td>
															<td class="text-center w-50" style="font-size: 17px;">
																${res.Tipo_Equipo}
															</td>
															<td class="text-center w-50" style="font-size: 17px;">
																${res.Potencia}
															</td>
															<td class="text-center w-50" style="font-size: 17px;">
																${res.Velocidad}
															</td>
															<td class="text-center w-50" style="font-size: 17px;">
																${res.Voltaje}
															</td>
														</tr>
													</tbody>
			
												</table>
											</div>
										</div>
									</div>
		
									<div class="pt-4 row">
										<div class="col-12">
											<p class="swal2-content">Desea Continuar?</p>
										</div>
									</div>
								`,
								showCancelButton: true,
								confirmButtonColor: "#337ab7",
								confirmButtonText: "Sí",
								confirmButtonClass: "class1",
								cancelButtonColor: "#d33",
								cancelButtonText: "No",
								allowOutsideClick: false,
								allowEscapeKey: false,
							}).then((result) => {
								if (result.value) {
									submit = true;
									setTimeout(() => {
										$(this).submit();
									}, 250);
								}
							});
						}
						return submit;
					});
				}
			});
		});
	});


	// $(function validarNumeroSerie() {
	// 	$(document).on("keyup", "#validNumeroSerie", function () {
	// 		$.ajax({
	// 			url: $(this).attr("data-url"),
	// 			method: "post",
	// 			dataType: "json",
	// 			data: {
	// 				Numero_Serie: $(this).val()
	// 			},
	// 		}).done((res) => {
	// 			if (res == true) {
	// 				$(this)[0].setCustomValidity("Ese número de serie ya existe");
	// 			} else {
	// 				$(this)[0].setCustomValidity("");
	// 			}
	// 		});
	// 	});
	// });

	$(function ValidarOrdenCompra(){
		$(document).on("keyup", "#Orden_Compra, #orden_compra", function () {
			$.ajax({
				url: "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=ValidarOrdenCompra",
				method: "post",
				dataType: "json",
				data: {
					Orden_Compra: $(this).val(),
					Nit_Sede: $("#nit_sede").val(),
					Numero_Documento: $("#numCT").val(),
				},
			}).done((res) => {
				if (res === true) {
					$(this)[0].setCustomValidity("Esa orden de compra ya existe");
				} else {
					$(this)[0].setCustomValidity("");
				}
			});
		});
	});

	$(document).on("change", "#orden_compra", function () {
		$.ajax({
			url: "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=ValidarOrdenCompra",
			method: "post",
			dataType: "json",
			data: {
				Orden_Compra: $(this).val(),
				Numero_Documento: $("#numCT").val(),
				Nit_Sede: $("#nit_sede").val(),
			},
		}).done((res) => {
			if (res === false) {
				var valOrden = false;
				var OrdenCompra = $(this).val();
				var tipo = $("#tipo_doc").val();
				var num_doc = $("#numCT").val();
				var sede = $("#nit_sede").val();
				var url = $(this).attr("data-url");

				valOrden = confirm("Desea actualizar la Orden de Compra?");
				if (valOrden == true) {
					$.ajax({
						url: url,
						data: "num_doc=" + num_doc + "&nit_sede=" + sede + "&tipo_doc=" + tipo + "&OrdenCompra=" + OrdenCompra,
						type: "post",
						success: function () {
							alert("Orden actualizada con éxito!!");
						}
					});
				}
			} else {
				swal({
					type: "error",
					title: "No se puede actualizar, la orden de compra ya existe en otro documento"
				});
			}
		});
	});

	$(document).on("change", "#Codigo_Tipo_Equipo", function () {
		$.ajax({
			url: $(this).attr("data-url"),
			method: "post",
			dataType: "json",
			data: {
				codigo_tipo_equipo: $(this).val()
			}
		}).done((res) => {
			$("#Codigo_Tipo_Equipo_Out").html(res.selectClaseEquipos);
		});
	});

	$(document).on("click", "#btnBuscarIngresos", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#modalBuscarIngresos .modal-body").html(res);
			$("#modalBuscarIngresos").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});

	$(document).on("click", "#FacturarCotizacion", function (event) {
		let estadoCotizacion = $("#estadoCotizacion").text();
		if (estadoCotizacion == "ACTIVO") {
			$.ajax({
				url: $(this).attr("data-url"),
				method: "post",
				dataType: "json",
				data: {
					"numero_doc": $("#numCT").val(),
					"tipo_doc": $("#tipo_doc").val(),
					"nit_sede": $("#nit_sede").val()
				}
			}).done((res) => {
				if (res.factura_venta == false) {
					let data_url = $(this).attr("data-url").replace("ajax", "index").replace("validarFacturaCotizacion", "FacturarCotizacion"),
						parametros = "&numero_doc=" + $("#numCT").val() + "&tipo_doc=" + $("#tipo_doc").val() + "&nit_sede=" + $("#nit_sede").val() + "",
						url = data_url + parametros;
					window.location.href = url;
				} else {
					swal({
						type: "error",
						title: "La cotización ya se encuentra facturada",
						html: `<h2 class="swal2-title">Número: <span class="badge badge-secondary">${res.numFVC}</span></h2>
							   <div class="swal2-content" style="display: block;">Desea Verla?</div>`,
						showCancelButton: true,
						confirmButtonColor: "#337ab7",
						confirmButtonText: "Sí",
						cancelButtonColor: "#d33",
						cancelButtonText: "No",
						allowOutsideClick: false,
						allowEscapeKey: false,
					}).then((result) => {
						if (result.value) {
							window.open(
								`index.php?modulo=Factura&controlador=Factura&funcion=getVerFactura
									&numero_doc=${res.numFVC}&tipo_doc=FVC&nit_sede=${$("#nit_sede").val()}
								`);
						}
					});
				}
			});
		} else if (estadoCotizacion == "ANULADO") {
			swal({
				type: "warning",
				title: "La cotización se encuentra anulada"
			});
		}
	});

	$(document).on("click", "#btnBuscarIngresoGeneral", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#modalBuscarIngresos .modal-body").html(res);
			$("#modalBuscarIngresos").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});

	$(document).on("click", "#btnNuevaBusqueda", function () {
		$(".nuevaBusqueda").hide();
		$("#add-menu-ir-a-Ing").hide();
		$("#add-menu-ir-a-Doc").hide();
		$("#opc_fecha").prop("disabled", false);
		$("#opc_noIngreso_cliente").prop("disabled", false);
		$(this).parents("form").find("select").each(function (){
			$(this).val("").trigger("change");
		});
	});

	$(function BuscarIngresoEquipos() {
		$(document).on("click", "#opc_todos", function () {
			$("#buscarIngresoDesdeHasta").show();
			$("#buscarIngresoPorNoIngreso").hide();
			$("#buscarIngresoPorNoSerie").hide();
			$("#buscarIngresoPorNoReferencia").hide();
			$("#frm_BuscarIngresos").find('input[type="number"]').val("");
		});

		$(document).on("click", "#opc_cliente", function () {
			$("#buscarIngresoPorCliente").show();
			$("#buscarIngresoPorNoIngreso").hide();
			$("#buscarIngresoPorNoSerie").hide();
			$("#buscarIngresoPorNoReferencia").hide();
			$("#frm_BuscarIngresos").find('input[type="number"]').val("").trigger('change')
		});

		$(document).on("click", "#opc_ingreso", function () {
			$("#buscarIngresoPorNoIngreso").show();
			$("#buscarIngresoDesdeHasta").hide();
			$("#buscarIngresoPorCliente").hide();
			$("#buscarIngresoPorNoSerie").hide();
			$("#buscarIngresoPorNoReferencia").hide();
			$("#frm_BuscarIngresos").find('input, select[id="Nit_Cliente"]').val("").trigger('change')
		});

		$(document).on("click", "#opc_serie", function () {
			$("#buscarIngresoPorNoSerie").show();
			$("#buscarIngresoDesdeHasta").hide();
			$("#buscarIngresoPorCliente").hide();
			$("#buscarIngresoPorNoIngreso").hide();
			$("#buscarIngresoPorNoReferencia").hide();
			$("#frm_BuscarIngresos").find('input, select[id="Nit_Cliente"]').val("").trigger('change')
		});

		$(document).on("click", "#opc_ref", function () {
			$("#buscarIngresoPorNoReferencia").show();
			$("#buscarIngresoDesdeHasta").hide();
			$("#buscarIngresoPorCliente").hide();
			$("#buscarIngresoPorNoIngreso").hide();
			$("#buscarIngresoPorNoSerie").hide();
			$("#frm_BuscarIngresos").find('input, select[id="Nit_Cliente"]').val("").trigger('change')
		});

		$(document).on("submit", "#frm_BuscarIngresos", function (event) {

			event.preventDefault();

			if ($("#fecha_desde").val() && $("#fecha_hasta").val() || $("#empresa").val() || $("#numero_ingreso").val() || $("#numero_serie").val() || $("#numero_ref").val() || $("#estado_doc").val()) {
				if ($("#sedeIng").val()) {

					$("#containerTablaModalBuscarIngresos").show();
					$("#menu-ir-a-Ing").hide();

					var tablaModalBuscarIngresos = $("#tablaModalBuscarIngresos").DataTable({
						language: {
							"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
						},
						destroy: true,
						ordering: false,
						pageLength: 10,
						autoWidth: false,
						lengthChange: false,
						columnDefs: [{
							"className": "text-center",
							"targets": "_all"
						}],
						drawCallback: () => {
							tablaModalBuscarIngresos.columns.adjust();
						},
						fnRowCallback: (row, data) => {
							$.ajax({
								url: $(this).prop("action").replace("ListarIngresos", "BuscarPotenciaVelocidadVoltaje"),
								method: "post",
								dataType: "json",
								data: "Numero_Ingreso=" + data.numero_ingreso + "&Nit_Empresa=" + data.nit_empresa,
							}).done((res) => {
								$("#tdIngPotencia" + res.numero_ingreso).html(res.potencia);
								$("#tdIngVelocidad" + res.numero_ingreso).html(res.velocidad);
								$("#tdIngVoltaje" + res.numero_ingreso).html(res.voltaje);
							});
						},
						ajax: {
							url: $(this).prop("action"),
							method: $(this).prop("method"),
							data: {
								"fecha_desde": $("#fecha_desde").val(),
								"fecha_hasta": $("#fecha_hasta").val(),
								"nit_empresa": $("#empresa").val(),
								"numero_ingreso": $("#numero_ingreso").val(),
								"numero_serie": $("#numero_serie").val(),
								"numero_ref": $("#numero_ref").val(),
								"estado_doc": $("#estado_doc").val(),
								"nit_sede": $("#sedeIng").val(),
							},
						},
						columns: [
							{data: "botonVerIngreso"},
							{data: "tipo_ingreso"},
							{data: "fecha_ingreso"},
							{data: "numero_serie"},
							{data: "descripcion"},
							{data: "razon_social"},
							{data: "potencia"},
							{data: "velocidad"},
							{data: "voltaje"},
							{data: "estado"}
						],
					});
				} else {
					swal({
						type: "warning",
						title: "Debe seleccionar la sede"
					});
				}
			} else {
				swal({
					type: "warning",
					title: "Seleccione un criterio de búsqueda"
				});
			}
		});

		$(document).on("click", "#tablaModalBuscarIngresos button", function () {
			let data = $("#tablaModalBuscarIngresos").DataTable().row($(this).parents("tr")).data();
			$("#menu-ir-a-Ing").hide();
			$("#menu-ir-a-Ing").show(500);

			let pagina = "index.php";
			let numero_ingreso = "&numero_doc=" + data.numero_ingreso;
			let numero_serie = "&serie=" + data.numero_serie;
			let nit_sede = "&nit_sede=" + data.nit_empresa;
			let modulo = "?modulo=Ingresos";
			let controlador = "&controlador=Ingresos";

			$("#ir-a-ingreso-cicloVida").on("click", function () {
				let funcion = "&funcion=getCicloDeVida";
				let parametros = numero_ingreso + numero_serie + nit_sede;
				let url = pagina + modulo + controlador + funcion + parametros;
				$(this).attr("href", url);
			});

			$("#ir-a-ingreso-equipoVer").on("click", function () {
				let funcion = "&funcion=getVer" + data.tipo_ingreso;
				let parametros = numero_ingreso + numero_serie + nit_sede;
				let url = pagina + modulo + controlador + funcion + parametros;
				$(this).attr("href", url);
			});

			$("#ir-a-ingreso-equipoEditar").on("click", function () {
				let funcion = "&funcion=getEditar" + data.tipo_ingreso;
				let parametros = numero_ingreso + numero_serie + nit_sede;
				let url = pagina + modulo + controlador + funcion + parametros;
				$(this).attr("href", url);
			});

			$.ajax({
				url: $(this).attr("data-url"),
				method: "post",
				dataType: "json",
				data: {
					Numero_Ingreso: data.numero_ingreso,
				}
			}).done((res) => {
				// IR A DIAGNÓSTICO
				if (res.urlDocDiag != false) {
					$("#ir-a-diagnostico-equipoVer").off("click");
					$("#ir-a-diagnostico-equipoVer").on("click", function () {
						let url = res.urlDocDiag.replace("&funcion=", "&funcion=tiposDiagnosticos&tipo_vista=ver");
						$(this).attr("href", url);
					});
					$("#ir-a-diagnostico-equipoEditar").on("click", function () {
						let url = res.urlDocDiag.replace("&funcion=", "&funcion=tiposDiagnosticos&tipo_vista=editar");
						$(this).attr("href", url);
					});
				} else {
					let pagina = "index.php";
					let modulo = "?modulo=Diagnosticos";
					let controlador = "&controlador=Diagnosticos";
					let funcion = "&funcion=tiposDiagnosticos";
					let num_ingreso = "&numero_ingreso=" + data.numero_ingreso + "";
					let nit_sede = "&nit_sede=" + data.nit_empresa + "";
					let nit_cliente = "&nit_cliente=" + data.nit_cliente + "";
					let parametros = num_ingreso + nit_sede + nit_cliente;
					let url = pagina + modulo + controlador + funcion + parametros;

					$("#ir-a-diagnostico-equipoVer").on("click", function (event) {
						event.preventDefault();

						swal({
							type: "warning",
							title: "El Documento no existe",
						});
					});
					$("#ir-a-diagnostico-equipoEditar").on("click", function () {
						$(this).attr("href", url);
					});
				}
				// FIN IR A DIAGNÓSTICO
				
				// IR A PRELIQUIDACIÓN
				if (res.urlDocPL != false) {
					$("#ir-a-preliquidacion-equipoVer").off("click");
					$("#ir-a-preliquidacion-equipoVer").on("click", function () {
						let url = res.urlDocPL.replace("&funcion=", "&funcion=getVer");
						$(this).attr("href", url);
					});
					$("#ir-a-preliquidacion-equipoEditar").on("click", function () {
						let url = res.urlDocPL.replace("&funcion=", "&funcion=getEditar");
						$(this).attr("href", url);
					});
				} else {
					let pagina = "index.php";
					let modulo = "?modulo=Preliquidacion";
					let controlador = "&controlador=Preliquidacion";
					let funcion = "&funcion=crearPreliquidacion";
					let tipo_doc = "&tipo_doc=PL";
					let num_ingreso = "&num_ingreso=" + data.numero_ingreso + "";
					let nit_sede = "&nit_sede=" + data.nit_empresa + "";
					let nit_cliente = "&nit_cliente=" + data.nit_cliente + "";
					let parametros = tipo_doc + num_ingreso + nit_sede + nit_cliente;
					let url = pagina + modulo + controlador + funcion + parametros;

					$("#ir-a-preliquidacion-equipoVer").on("click", function (event) {
						event.preventDefault();

						swal({
							type: "warning",
							title: "El Documento no existe",
						});
					});
					$("#ir-a-preliquidacion-equipoEditar").on("click", function () {
						$(this).attr("href", url);
					});
				}
				// FIN IR A PRELIQUIDACIÓN

				// IR A COTIZACIÓN
				if (res.urlDocCT != false) {
					$("#ir-a-cotizacion-equipoVer").off("click");
					$("#ir-a-cotizacion-equipoVer").on("click", function () {
						let url = res.urlDocCT.replace("&funcion=", "&funcion=getVer");
						$(this).attr("href", url);
					});
					$("#ir-a-cotizacion-equipoEditar").on("click", function () {
						let url = res.urlDocCT.replace("&funcion=", "&funcion=getEditar");
						$(this).attr("href", url);
					});
				} else {
					let pagina = "index.php";
					let modulo = "?modulo=Cotizaciones";
					let controlador = "&controlador=Cotizaciones";
					let funcion = "&funcion=crearCotizacion";
					let tipo_doc = "&tipo_doc=CT";
					let num_ingreso = "&num_ingreso=" + data.numero_ingreso + "";
					let nit_sede = "&nit_sede=" + data.nit_empresa + "";
					let nit_cliente = "&nit_cliente=" + data.nit_cliente + "";
					let parametros = tipo_doc + num_ingreso + nit_sede + nit_cliente;
					let url = pagina + modulo + controlador + funcion + parametros;

					$("#ir-a-cotizacion-equipoVer").on("click", function () {
						event.preventDefault();
						
						swal({
							type: "warning",
							title: "El Documento no existe",
						});
					});
					$("#ir-a-cotizacion-equipoEditar").on("click", function () {
						$(this).attr("href", url);
					});
				}
				// FIN IR A COTIZACIÓN

				// IR A REMISIÓN
				if (res.urlDocRM != false) {
					$("#ir-a-remision-equipoVer").off("click");
					$("#ir-a-remision-equipoVer").on("click", function () {
						let url = res.urlDocRM.replace("&funcion=", "&funcion=getVer");
						$(this).attr("href", url);
					});
					$("#ir-a-remision-equipoEditar").on("click", function () {
						let url = res.urlDocRM.replace("&funcion=", "&funcion=getEditar");
						$(this).attr("href", url);
					});
				} else {
					let pagina = "index.php";
					let modulo = "?modulo=Remisiones";
					let controlador = "&controlador=Remisiones";
					let funcion = "&funcion=crearRemision";
					let tipo_doc = "&tipo_doc=RM";
					let num_ingreso = "&num_ingreso=" + data.numero_ingreso + "";
					let nit_sede = "&nit_sede=" + data.nit_empresa + "";
					let nit_cliente = "&nit_cliente=" + data.nit_cliente + "";
					let parametros = tipo_doc + num_ingreso + nit_sede + nit_cliente;
					let url = pagina + modulo + controlador + funcion + parametros;

					$("#ir-a-remision-equipoVer").on("click", function () {
						event.preventDefault();
						
						swal({
							type: "warning",
							title: "El Documento no existe",
						});
					});
					$("#ir-a-remision-equipoEditar").on("click", function () {
						$(this).attr("href", url);
					});
				}
				// FIN IR A REMISIÓN

				// IR A FACTURACIÓN
				if (res.urlDocFVC != false) {
					$("#ir-a-factura-equipoVer").off("click");
					$("#ir-a-factura-equipoVer").on("click", function () {
						let url = res.urlDocFVC.replace("&funcion=", "&funcion=getVer");
						$(this).attr("href", url);
					});
				} else {
					let pagina = "index.php";
					let modulo = "?modulo=Factura";
					let controlador = "&controlador=Factura";
					let funcion = "&funcion=crearFactura";
					let tipo_doc = "&tipo_doc=FVC";
					let num_ingreso = "&num_ingreso=" + data.numero_ingreso + "";
					let nit_sede = "&nit_sede=" + data.nit_empresa + "";
					let nit_cliente = "&nit_cliente=" + data.nit_cliente + "";
					let parametros = tipo_doc + num_ingreso + nit_sede + nit_cliente;
					let url = pagina + modulo + controlador + funcion + parametros;

					$("#ir-a-factura-equipoVer").on("click", function () {
						event.preventDefault();
						
						swal({
							type: "warning",
							title: "El Documento no existe",
						});
					});
					$("#ir-a-factura-equipoEditar").on("click", function () {
						$(this).attr("href", url);
					});
				}
				// FIN IR A FACTURACIÓN

				// IR A ORDEN TRABAJO
				if (res.urlDocOrden != false) {
					$("#ir-a-ordenTrabajo-equipoVer").off("click");
					$("#ir-a-ordenTrabajo-equipoVer").on("click", function () {
						let url = res.urlDocOrden.replace("&funcion=", "&funcion=getVer");
						$(this).attr("href", url);
					});
					$("#ir-a-ordenTrabajo-equipoEditar").on("click", function () {
						let url = res.urlDocOrden.replace("&funcion=", "&funcion=getEditar");
						$(this).attr("href", url);
					});
				} else {
					let pagina = "index.php";
					let modulo = "?modulo=OrdenTrabajo";
					let controlador = "&controlador=OrdenTrabajo";
					let funcion = "&funcion=crearOrdenTrabajo";
					let num_ingreso = "&num_ingreso=" + data.numero_ingreso + "";
					let nit_sede = "&nit_sede=" + data.nit_empresa + "";
					let nit_cliente = "&nit_cliente=" + data.nit_cliente + "";
					let parametros = num_ingreso + nit_sede + nit_cliente;
					let url = pagina + modulo + controlador + funcion + parametros;

					$("#ir-a-ordenTrabajo-equipoVer").on("click", function () {
						event.preventDefault();
						
						swal({
							type: "warning",
							title: "El Documento no existe",
						});
					});
					$("#ir-a-ordenTrabajo-equipoEditar").on("click", function () {
						$(this).attr("href", url);
					});
				}
				// FIN IR A ORDEN TRABAJO

				// IR A INFORME TÉCNICO
				if (res.urlDocInforme != false) {
					$("#ir-a-informeTecnico-equipoVer").off("click");
					$("#ir-a-informeTecnico-equipoVer").on("click", function () {
						let url = res.urlDocInforme.replace("&funcion=", "&funcion=getVer");
						$(this).attr("href", url);
					});
					$("#ir-a-informeTecnico-equipoEditar").on("click", function () {
						let url = res.urlDocInforme.replace("&funcion=", "&funcion=getEditar");
						$(this).attr("href", url);
					});
				} else {
					let pagina = "index.php";
					let modulo = "?modulo=Informes";
					let controlador = "&controlador=Informes";
					let funcion = "&funcion=crearInformeTecnico";
					let num_ingreso = "&num_ingreso=" + data.numero_ingreso + "";
					let nit_sede = "&nit_sede=" + data.nit_empresa + "";
					let nit_cliente = "&nit_cliente=" + data.nit_cliente + "";
					let parametros = num_ingreso + nit_sede + nit_cliente;
					let url = pagina + modulo + controlador + funcion + parametros;

					$("#ir-a-informeTecnico-equipoVer").on("click", function () {
						event.preventDefault();
						
						swal({
							type: "warning",
							title: "El Documento no existe",
						});
					});
					$("#ir-a-informeTecnico-equipoEditar").on("click", function () {
						$(this).attr("href", url);
					});
				}
				// FIN IR A INFORME TÉCNICO
			});
		});
	});


	// INGRESO Y EDITAR DE LAS PRELIQUIDACIONES 
	$(document).on("submit", "#preliquidacionReg", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			dataType: "json",
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha realizado con éxito.",
				html: `<h2 class="swal2-title">Número de Documento: <span class="badge badge-secondary">${res.numPL}</span></h2>
							   <div class="swal2-content" style="display: block;">Desea Imprimir?</div>`,
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/Preliquidacion/GuiImprimirPL.html.php?";
					window.open(url + "numero_doc=" + res.numPL + "&tipo_doc=" + $("#tipo_doc").val() + "&nit_sede=" + $("#nit_sede").val());
					window.location.href = window.location = `index.php?modulo=Preliquidacion&controlador=Preliquidacion&funcion=getEditarPreliquidacion
						&numero_doc=${res.numPL}&tipo_doc=PL&nit_sede=${$("#nit_sede").val()}`;
				} else {
					window.location.href = "index.php?modulo=Preliquidacion&controlador=Preliquidacion&funcion=crearPreliquidacion&tipo_doc=PL";
				}
			});
		});
	});

	$(document).on("submit", "#formEditPreliquidacion", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha actualizado con éxito:",
				text: "Desea Imprimir?",
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/Preliquidacion/GuiImprimirPL.html.php?";
					window.open(url + "numero_doc=" + $("#numPL").val() + "&tipo_doc=" + $("#tipo_doc").val() + "&nit_sede=" + $("#nit_sede").val());
				}
			});
		});
	});
	// FIN INGRESO Y EDITAR DE LAS PRELIQUIDACIONES

	// INGRESO Y EDITAR DE LAS COTIZACIONES 
	$(document).on("submit", "#formEditCotizacion", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			data: {
				case: "obtenerConsecutivo",
				existeCT: $("#existeCT").val(),
				numCT: $("#numCT").val(),
				nit_sede: $("#nit_sede").val(),
				tipo_doc: $("#tipo_doc").val(),
			},
		}).done((res) => {
			var numCT = res.numCT;
			swal({
				type: "warning",
				title: "Desea generar el consecutivo:",
				html: `<h2 class="swal2-title"><span class="badge badge-secondary">${numCT}</span></h2>`,
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let formData = new FormData(event.target);
					formData.append("case", "EditarCotizacion");
					$.ajax({
						url: $(this).attr("action"),
						method: $(this).attr("method"),
						data: formData,
						processData: false,
						contentType: false
					}).done((res) => {
						swal({
							type: "success",
							title: "El registro se ha actualizado con éxito:",
							text: "Desea Imprimir?",
							showCancelButton: true,
							confirmButtonColor: "#337ab7",
							confirmButtonText: "Sí",
							cancelButtonColor: "#d33",
							cancelButtonText: "No",
							allowOutsideClick: false,
							allowEscapeKey: false,
						}).then((result) => {
							if (result.value) {
								let url = "../../views/Cotizaciones/GuiImprimirCT.html.php?";
								window.open(url + "numero_doc=" + numCT + "&tipo_doc=" + $("#tipo_doc").val() + "&nit_sede=" + $("#nit_sede").val());
								window.location.href = window.location = `index.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=getEditarCotizacion
									&numero_doc=${numCT}&tipo_doc=CT&nit_sede=${$("#nit_sede").val()}`;
							}
						});
					});
				}else{
					$(this).attr("id", "cotizacionReg").attr("action", "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=RegistrarCotizacion");
					$(this).submit();
				}
			});
		});
	});

	$(document).on("submit", "#cotizacionReg", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			dataType: "json",
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha realizado con éxito.",
				html: `<h2 class="swal2-title">Número de Documento: <span class="badge badge-secondary">${res.numCT}</span></h2>
							   <div class="swal2-content" style="display: block;">Desea Imprimir?</div>`,
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/Cotizaciones/GuiImprimirCT.html.php?";
					window.open(url + "numero_doc=" + res.numCT + "&tipo_doc=" + $("#tipo_doc").val() + "&nit_sede=" + $("#nit_sede").val());
					window.location.href = window.location = `index.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=getEditarCotizacion
						&numero_doc=${res.numCT}&tipo_doc=${$("#tipo_doc").val()}&nit_sede=${$("#nit_sede").val()}`;
				} else {
					window.location.href = "index.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=crearCotizacion&tipo_doc=" + $("#tipo_doc").val();
				}
			});
		});
	});
	// FIN INGRESO Y EDITAR DE LAS COTIZACIONES  

	if ($("#observacionesFactura")) {
		let valorInput = $("#observacionesFactura").val();

		$(document).on("keyup", "#observacionesFactura", function () {
			if (valorInput != $(this).val()) {
				$("#iconoEditarObservacionesFactura").show(500);
			} else {
				$("#iconoEditarObservacionesFactura").hide(500);
			}
		});

		$(document).on("click", "#iconoEditarObservacionesFactura button", function () {
			let valAprobacion = confirm("Desea actualizar las observaciones?");

			if (valAprobacion == true) {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						numFVC: $("#numFVC").val(),
						nit_sede: $("#nit_sede").val(),
						observaciones: $("#observacionesFactura").val()
					}
				}).done((res) => {
					if (res.tipoRespuesta == true) {
						alert("Observaciones actualizadas con éxito");
					}
				});
			}
		});
	}

	// INGRESO DE LAS FACTURAS 
	$(document).on("submit", "#facturaReg", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha realizado con éxito:",
				text: "Desea Imprimir?",
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/Factura/GuiImprimirFVC.html.php?";
					$.ajax({
						url: "ajax.php?modulo=Factura&controlador=Factura&funcion=copiasFactura",
						method: "post",
						dataType: "json",
					}).done((res) => {
						for (let index = 0; index < res.Circularizacion[0].length; index++) {
							window.open(url + "numero_doc=" + $("#numFVC").val() + "&tipo_doc=" + $("#tipo_doc").val() + "&nit_sede=" + $("#nit_sede").val() + "&circularizacion=" + res.Circularizacion[0][index] + "");
						}
					});
					window.location = "index.php?modulo=Factura&controlador=Factura&funcion=getVerFactura&numero_doc=" + $("#numFVC").val() + "&tipo_doc=" + "FVC" + "&nit_sede=" + $("#nit_sede").val() + "";
				} else {
					window.location = "index.php?modulo=Factura&controlador=Factura&funcion=crearFactura&tipo_doc=" + $("#tipo_documento").val() + "";
				}
			});
		});
	});
	// FIN INGRESO DE LAS FACTURAS

	// INGRESO Y EDITAR DE LA ORDEN DE TRABAJO 
	$(document).on("submit", "#ordenTrabajoReg", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			dataType: "json",
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha realizado con éxito.",
				html: `<h2 class="swal2-title">Número de Documento: <span class="badge badge-secondary">${res.numOrden}</span></h2>
							   <div class="swal2-content" style="display: block;">Desea Imprimir?</div>`,
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/OrdenTrabajo/GuiImprimirOrdenTrabajo.html.php?";
					window.open(url + "numero_doc=" + res.numOrden + "&nit_sede=" + $("#nit_sede").val());
					window.location.href = window.location = `index.php?modulo=OrdenTrabajo&controlador=OrdenTrabajo&funcion=getEditarOrdenTrabajo
						&numero_doc=${res.numOrden}&nit_sede=${$("#nit_sede").val()}`;
				} else {
					window.location.href = "index.php?modulo=OrdenTrabajo&controlador=OrdenTrabajo&funcion=crearOrdenTrabajo";
				}
			});
		});
	});

	$(document).on("submit", "#formEditOrdenTrabajo", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha actualizado con éxito:",
				text: "Desea Imprimir?",
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/OrdenTrabajo/GuiImprimirOrdenTrabajo.html.php?";
					window.open(url + "numero_doc=" + $("#numero_orden").val() + "&nit_sede=" + $("#nit_sede").val());
				}
			});
		});
	});
	// FIN INGRESO Y EDITAR DE LA ORDEN DE TRABAJO

	// INGRESO Y EDITAR DE LAS REMISIONES 
	$(document).on("submit", "#remisionesReg", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			dataType: "json",
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha realizado con éxito.",
				html: `<h2 class="swal2-title">Número de Documento: <span class="badge badge-secondary">${res.numRM}</span></h2>
							   <div class="swal2-content" style="display: block;">Desea Imprimir?</div>`,
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/Remisiones/GuiImprimirRM.html.php?";
					window.open(url + "numero_doc=" + res.numRM + "&tipo_doc=" + $("#tipo_documento").val() + "&nit_sede=" + $("#nit_sede").val());
					window.location.href = window.location = `index.php?modulo=Remisiones&controlador=Remisiones&funcion=getEditarRemision
						&numero_doc=${res.numRM}&tipo_doc=RM&nit_sede=${$("#nit_sede").val()}`;
				} else {
					window.location.href = "index.php?modulo=Remisiones&controlador=Remisiones&funcion=crearRemision&tipo_doc=RM";
				}
			});
		});
	});

	$(document).on("submit", "#formEditRemision", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha actualizado con éxito:",
				text: "Desea Imprimir?",
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/Remisiones/GuiImprimirRM.html.php?";
					window.open(url + "numero_doc=" + $("#numRM").val() + "&tipo_doc=" + $("#tipo_documento").val() + "&nit_sede=" + $("#nit_sede").val());
				}
			});
		});
	});
	// FIN INGRESO Y EDITAR DE LAS REMISIONES


	// INGRESO Y EDITAR DEL GASTO DIRECTO 
	$(document).on("submit", "#gastoDirectoReg", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			dataType: "json",
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha realizado con éxito.",
				html: `<h2 class="swal2-title">Número de Documento: <span class="badge badge-secondary">${res.numGasto}</span></h2>
							   <div class="swal2-content" style="display: block;">Desea Imprimir?</div>`,
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/GastosDirectos/GuiImprimirGD.html.php?";
					window.open(url + "numero_doc=" + res.numGasto + "&nit_sede=" + $("#nit_sede").val());
					window.location.href = window.location = `index.php?modulo=GastosDirectos&controlador=GastosDirectos&funcion=getEditarGastoDirectoFabricacion
						&numero_doc=${res.numGasto}&nit_sede=${$("#nit_sede").val()}`;
				} else {
					window.location.href = "index.php?modulo=GastosDirectos&controlador=GastosDirectos&funcion=crearGastoDirectoFabricacion";
				}
			});
		});
	});

	$(document).on("submit", "#formEditGastoDirecto", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(event.target),
			processData: false,
			contentType: false
		}).done((res) => {
			swal({
				type: "success",
				title: "El registro se ha actualizado con éxito:",
				text: "Desea Imprimir?",
				showCancelButton: true,
				confirmButtonColor: "#337ab7",
				confirmButtonText: "Sí",
				cancelButtonColor: "#d33",
				cancelButtonText: "No",
				allowOutsideClick: false,
				allowEscapeKey: false,
			}).then((result) => {
				if (result.value) {
					let url = "../../views/GastosDirectos/GuiImprimirGD.html.php?";
					window.open(url + "numero_doc=" + $("#numGD").val() + "&nit_sede=" + $("#nit_sede").val());
				}
			});
		});
	});
	// FIN INGRESO Y EDITAR DEL GASTO DIRECTO

	$(document).on("click", "#AnularRM", function () {
		var url = $(this).attr('data-url');
		var numRM = $('#numRM').val();
		var nit_sede = $('#nit_sede').val();

		if (numRM != "") {
			var msjAnular = confirm("Desea Anular la Remision!");

			if (msjAnular == true) {
				var razonAnula = prompt("Ingrese la Razon por la cual Anula");
				if (razonAnula != "") {

					$.ajax({
						url: url,
						data: "numRM=" + numRM + "&tipo_doc=" + "RM" + "&Razon_Anula=" + razonAnula + "&nit_sede=" + nit_sede,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}
	});

	$(document).on("click", "#VerDatosRM", function () {
		var url = $(this).attr("data-url");
		var numRM = $("#numRM").val();

		$.ajax({
			url: url,
			data: "numRM=" + numRM,
			type: "POST",
			success: function (dato) {
				$("#div_Datos_Adicionales").html(dato);
				$("#VerDatos").modal("show");
			}
		});
	});

	$(document).on("click", "#AnularOrdenTrabajo", function () {
		var url = $(this).attr('data-url');
		var numOrden = $('#numero_orden').val();
		var nit_sede = $('#nit_sede').val();

		if (numOrden != "") {
			var msjAnular = confirm("Desea Anular la Orden de Trabajo!");

			if (msjAnular == true) {
				var razonAnula = prompt("Ingrese la Razon por la cual Anula");
				if (razonAnula != "") {
					$.ajax({
						url: url,
						data: "numOrden=" + numOrden + "&Razon_Anula=" + razonAnula + "&nit_sede=" + nit_sede,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}
	});

	$(document).on("click", "#AnularGastoDirecto", function () {
		var url = $(this).attr('data-url');
		var numGD = $('#numGD').val();
		var nit_sede = $('#nit_sede').val();

		if (numGD != "") {
			var msjAnular = confirm("Desea Anular el Gasto Directo!");

			if (msjAnular == true) {
				var razonAnula = prompt("Ingrese la Razon por la cual Anula");
				if (razonAnula != "") {
					$.ajax({
						url: url,
						data: "numGD=" + numGD + "&Razon_Anula=" + razonAnula + "&nit_sede=" + nit_sede,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}
	});

	$(document).on("click", "#VerDatosGD", function () {
		var url = $(this).attr('data-url');
		var numGD = $('#numGD').val();
		var nit_sede = $('#nit_sede').val();

		$.ajax({
			url: url,
			data: {
				numGD: numGD,
				nit_sede: nit_sede
			},
			type: "POST",
			success: function (dato) {
				$('#div_Datos_Adicionales').html(dato);
				$('#VerDatos').modal('show');
			}
		});
	});

	$(document).on("click", "#VerDatosOrdenTrabajo", function () {
		var url = $(this).attr("data-url");
		var numOrden = $("#numero_orden").val();

		$.ajax({
			url: url,
			data: "numOrden=" + numOrden,
			type: "POST",
			success: function (dato) {
				$("#div_Datos_Adicionales").html(dato);
				$("#VerDatos").modal("show");
			}
		});
	});

	$(document).on("click", "#PdfRM", function () {
		var numero_doc = $("#numRM").val();
		var tipo_doc = $("#tipo_documento").val();
		var nit_sede = $("#nit_sede").val();
		var url = "../../views/Remisiones/GuiImprimirRM.html.php?";

		window.open(url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede);
	});

	$(document).on("click", "#WordRM", function () {
		var numero_doc = $("#numRM").val();
		var tipo_doc = $("#tipo_documento").val();
		var nit_sede = $("#nit_sede").val();
		var url = "../../views/Remisiones/GuiWordRM.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede;
	});


	$(document).on("keyup", "#plazo", function () {
		this.value = this.value.replace(/[^0-9]/g, '');
		if ($(this).val() > 0) {
			if ($("#tipo_factura")) {
				$('input[id="tipo_factura"][value="Credito"]').prop("checked", true);
			}
		} else {
			$('input[id="tipo_factura"][value="Contado"]').prop("checked", true);
		}
	});

	$(function tablaModalCotizacionesAsociadas() {
		$(document).on("click", "#cotizacionesAsociadas", function () {
			$("#modalCotizacionesAsociadas").modal({
				backdrop: "static",
				keyboard: false
			});
			var tablaModalCotizacionesAsociadas = $("#tablaModalCotizacionesAsociadas").DataTable({
				language: {
					"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
				},
				destroy: true,
				pageLength: 10,
				autoWidth: false,
				lengthChange: false,
				order: [
					[0, "desc"]
				],
				columnDefs: [{
					"className": "text-center",
					"targets": "_all"
				}],
				drawCallback: () => {
					tablaModalCotizacionesAsociadas.columns.adjust();
				},
			});
			if ($('input[name="numCT[]"]').val() && $('input[name="no_ingreso[]"]').val()) {
				let numCT = $('input[name="numCT[]"]');
				let no_ingreso = $('input[name="no_ingreso[]"]');
				for (let index = 0; index < numCT.length; index++) {
					agregarCotizacionesAsociadas($(numCT[index]).val(), $(no_ingreso[index]).val());
				}
			}
		});
	});

	function agregarCotizacionesAsociadas(cotizacion, ingreso) {
		$("#tablaModalCotizacionesAsociadas").DataTable().row.add([
			cotizacion,
			ingreso,
		]).draw();
		filtrarDatatableSinDuplicados("tablaModalCotizacionesAsociadas", 0);
	}

	$(function seleccionIngresos() {
		$(document).on("click", "#seleccionIngresos", function () {
			
			$("#nit_empresa").val() ? nit_cliente = $("#nit_empresa").val() : nit_cliente = $("#nit_emp").val()

			if ($("#nit_empresa").val() || $("#nit_emp").val()) {
				$("#modalSeleccionIngresos").modal({
					backdrop: "static",
					keyboard: false
				});
				var tablaModalSeleccionIngresos = $("#tablaModalSeleccionIngresos").DataTable({
					language: {
						"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
					},
					destroy: true,
					ordering: false,
					pageLength: 10,
					autoWidth: false,
					lengthChange: false,
					columnDefs: [{
						"className": "text-center",
						"targets": "_all"
					}],
					drawCallback: () => {
						tablaModalSeleccionIngresos.columns.adjust();
					},
					ajax: {
						url: $(this).attr("data-url"),
						method: "post",
						data: {
							"nit_cliente": nit_cliente
						},
					},
					columns: [
						{data: "numero_ingreso"},
						{data: "fecha_ingreso"},
						{data: "potencia"},
						{data: "velocidad"},
						{data: "voltaje"},
						{data: "ver_cotizacion"}
					],
				});
			} else {
				swal({
					type: "warning",
					title: "Debe seleccionar el cliente"
				});
			}
		});

		$(document).on("click", "#tablaModalSeleccionIngresos button", function () {
			let data = $("#tablaModalSeleccionIngresos").DataTable().row($(this).parents("tr")).data();
			$("#modalCotizacionesIngreso").modal({
				backdrop: "static",
				keyboard: false
			});

			var tablaModalCotizacionesIngreso = $("#tablaModalCotizacionesIngreso").DataTable({
				language: {
					"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
				},
				destroy: true,
				ordering: false,
				pageLength: 10,
				autoWidth: false,
				lengthChange: false,
				columnDefs: [{
					"className": "text-center",
					"targets": "_all"
				}],
				drawCallback: () => {
					tablaModalCotizacionesIngreso.columns.adjust();
				},
				createdRow: (row, data, index) => {
					$('input[name="numCT[]"]').each(function () {
						if (data.numero_documento == $(this).val()) {
							$(row).find("td").eq(3).html('<i class="fa fa-check"></i>').attr("data-estado", "check");
						}
					});
				},
				ajax: {
					url: $(this).attr("data-url"),
					method: "post",
					data: {
						num_ingreso: data.numero_ingreso
					},
				},
				columns: [
					{data: "numero_documento"},
					{data: "fecha_documento"},
					{data: "agregar_detalle"},
					{data: "estado"}
				],
			});
		});
	});

	$(function adicionarGER() {
		$(document).on("click", "#adicionarCotizaciones", function () {

			$("#nit_empresa").val() ? nit_cliente = $("#nit_empresa").val() : nit_cliente = $("#nit_emp").val()

			if ($("#nit_empresa").val() || $("#nit_emp").val()) {
				$("#numFacturaCT").text($("#numFVC").val());
				$("#modalAdicionarCotizaciones").modal({
					backdrop: "static",
					keyboard: false
				});
				var tablaModalAdicionarCotizaciones = $("#tablaModalAdicionarCotizaciones").DataTable({
					language: {
						"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
					},
					destroy: true,
					ordering: false,
					pageLength: 10,
					autoWidth: false,
					lengthChange: false,
					columnDefs: [{
						"className": "text-center",
						"targets": "_all"
					}],
					drawCallback: () => {
						tablaModalAdicionarCotizaciones.columns.adjust();
					},
					createdRow: (row, data, index) => {
						$('input[name="numCT[]"]').each(function () {
							if (data.numero_documento == $(this).val()) {
								$(row).find("td").eq(4).html('<i class="fa fa-check"></i>').attr("data-estado", "check");
							}
						});
					},
					ajax: {
						url: $(this).attr("data-url"),
						method: "post",
						data: {
							"nit_cliente": nit_cliente,
						},
					},
					columns: [
						{data: "numero_documento"},
						{data: "numero_ingreso"},
						{data: "fecha_documento"},
						{data: "agregar_detalle"},
						{data: "estado"}
					],
				});
			} else {
				swal({
					type: "warning",
					title: "Debe seleccionar el cliente"
				});
			}
		});
	});

	$(document).on("click", "#tablaModalCotizacionesIngreso button, #tablaModalAdicionarCotizaciones button", function () {
		$(this).parents("table").attr("id") == "tablaModalAdicionarCotizaciones" ? eqIndex = 4 : eqIndex = 3

		let data = $(this).parents("table").DataTable().row($(this).parents("tr")).data(),
			estado = $(this).parents("tr").find("td").eq(eqIndex).attr("data-estado"),
			detalleCotizacion,
			estadoDetalle;

		$("#modalCotizacionesIngreso, #modalAdicionarCotizaciones").on("hidden.bs.modal", function () {
			$(".aceptar-cancelarDetalleCotizacion").hide();
			detalleCotizacion = null;
			estadoDetalle = null;
		});

		if (estado) {
			if (estado == "check") {
				swal({
					type: "warning",
					title: "Ya se seleccionó ese detalle"
				});
			}
		} else {
			$(".aceptar-cancelarDetalleCotizacion").show(1000);

			$.ajax({
				url: $(this).attr("data-url"),
				method: "post",
				dataType: "json",
				data: {
					num_cotizacion: data.numero_documento
				}
			}).done((res) => {
				detalleCotizacion = res.detalleCotizacion;
				estadoDetalle = res.estadoDetalle;
				if (detalleCotizacion) {
					$(document).on("click", ".aceptar-DetalleCotizacion", function () {
						$("#Detalle_GER").append(detalleCotizacion);
						$("#Orden_Compra").val(res.ordenCompra);
						$("#Orden_Servicio").val(res.ordenServicio);
						$("#num_cotizacion").val(res.numCotizacion);

						swal({
							title: "El detalle se agregado con éxito",
							type: "success",
							showConfirmButton: true,
							allowOutsideClick: false,
							allowEscapeKey: false
						}).then((result) => {
							if (result.value) {
								$("#modalCotizacionesIngreso, #modalAdicionarCotizaciones").modal("hide");
							}
						});

						$("#fila_DetalleFVC").find("input, select").each(function () {
							if ($(this).val() == "") {
								$("#fila_DetalleFVC").remove();
							}
						});
						if ($(".fila_DetalleGER").length + 1 >= 1) {
							let btn_agregarFila2GER = `
								<div class="col-1" id="btn_agregarFila2GER">
									<div class="row">
										<div class="col-6">
											<button type="button" id="btn_agregarFilaGER" class="btn btn-dark"><i class="fa fa-plus"></i></button>
										</div>
										<div class="col-6">
											<button type="submit" class="btn btn-primary" title="Grabar"><i class="fa fa-save"></i></button>
										</div>
									</div>
								</div>`;
							$("#btn_agregarFila2GER").last().remove();
							$("#Detalle_GER").append(btn_agregarFila2GER);
						}
						calcularTotalDetalle();
						ordenarItemDetalle();
						if ($(this).parents("table").attr("id") == "tablaModalCotizacionesIngreso") {
							agregarCotizacionesAsociadas(data.numero_documento, data.numero_ingreso);
						}
					});
				}
				if (estadoDetalle == true) {
					let filaCotizacion = $(this).parents()[1];
					$(filaCotizacion).find("td").eq(eqIndex).html('<i class="fa fa-check"></i>').attr("data-estado", "check");
				}
			});
		}
	});

	$(document).on("click", "#btnBuscarDoc", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#ModalBuscarDocumento .modal-body").html(res);
			$("#ModalBuscarDocumento").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});

	$(document).on("click", "#btnBuscarDocGeneral", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#ModalBuscarDocumento .modal-body").html(res);
			$("#ModalBuscarDocumento").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});

	$(function BuscarDocumentos() {
		$(document).on("keyup change", "#numero_doc, #tipo_doc", function () {
			if ($("#tipo_doc").val() != "" && $("#numero_doc").val() != "") {
				$("#buscarDocumentoDesdeHasta").css("display", "none");
				$("#buscarDocumentoDesdeHasta").find("input").val("");
				$("#buscarDocumentoNoIngreso-Cliente").css("display", "none");
				$("#buscarDocumentoNoIngreso-Cliente").find("input").val("");
				$("#opc_fecha").prop("disabled", true);
				$("#opc_fecha").prop("checked", false);
				$("#opc_noIngreso_cliente").prop("disabled", true);
				$("#opc_noIngreso_cliente").prop("checked", false);
			} else {
				$("#buscarDocumentoDesdeHasta").find("input").prop("disabled", false);
				$("#buscarDocumentoNoIngreso-Cliente").find("input").prop("disabled", false);
				$("#opc_fecha").prop("disabled", false);
				$("#opc_fecha").prop("checked", false);
				$("#opc_noIngreso_cliente").prop("disabled", false);
				$("#opc_noIngreso_cliente").prop("checked", false);
			}
		});

		$(document).on("click", "#opc_fecha", function () {
			$("#buscarDocumentoDesdeHasta").show();
		});

		$(document).on("click", "#opc_noIngreso_cliente", function () {
			$("#buscarDocumentoNoIngreso-Cliente").show();
		});

		$(document).on("submit", "#frm_BuscarDocumentos", function (event) {

			event.preventDefault();

			if ($("#sin_fecha").is(':checked')) {
				$("#sin_fecha").val(1);
			} else {
				$("#sin_fecha").val("");
			}

			if ($('#tipo_docum').val() || $('#numero_doc').val() || $('#fecha_desde').val() && $('#fecha_hasta').val() || $('#sin_fecha').val() || $('#numero_ingreso').val() || $('#empresa').val() || $('#estado_doc').val()) {
				if ($("#tipo_docum").val()) {
					if ($("#sedeDoc").val()) {

						if ($("#tipo_docum").val() == "CT") {

							$("#ir-a-documento-cicloVida").css("display", "block");
							$("#btnDropdownEditarDoc").css("display", "block");

						} else {
							if ($("#tipo_docum").val() == "FVC" || $("#tipo_docum").val() == "FCT") {
								$("#btnDropdownVer").css("display", "block");
								$("#btnDropdownEditarDoc").css("display", "none");
							} else {
								$("#btnDropdownVer").css("display", "block");
								$("#btnDropdownEditarDoc").css("display", "block");
							}
							$("#ir-a-documento-cicloVida").css("display", "none");
						}

						$("#containerTablaModalBuscarDocumentos").show();
						$("#menu-ir-a-Doc").hide();
						
						var index = 0;

						var tablaModalBuscarDocumentos = $("#tablaModalBuscarDocumentos").DataTable({
							language: {
								"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
							},
							destroy: true,
							ordering: false,
							pageLength: 10,
							autoWidth: false,
							lengthChange: false,
							dom: "Bfrtip",
							buttons: [
								{
									extend: "excelHtml5",
									text: '<i class="fa fa-file-excel"></i>',
									titleAttr: "Exportar a Excel",
									className: "bg-success ml-5",
									filename: "Documentos",
									sheetName: "Documentos"
								}
							],
							columnDefs: [{
								"className": "text-center",
								"targets": "_all"
							}],
							drawCallback: () => {
								tablaModalBuscarDocumentos.columns.adjust();
							},
							createdRow: (row, data) => {
								if(data.factura == true){
									$(row).addClass("bg-lawn-green");
									if (index == 0) {
										tablaModalBuscarDocumentos.button().add(0, {
											text: "Facturadas",
											className: "cursor-default btn btn-lawn-green btn-outline-lawn-green text-dark border-dark"
										});
									}
									index++;
								}
								if (data.tipo_orden == "R") {
									$(row).addClass("bg-cyan");
									if (index == 0) {
										tablaModalBuscarDocumentos.button().add(0, {
											text: "Reprocesos",
											className: "cursor-default btn btn-cyan btn-outline-cyan text-dark border-dark"
										});
									}
									index++;
								}
							},
							ajax: {
								url: $(this).prop("action"),
								method: $(this).prop("method"),
								data: {
									"fecha_desde": $("#fecha_desde").val(),
									"fecha_hasta": $("#fecha_hasta").val(),
									"sin_fecha": $("#sin_fecha").val(),
									"tipo_doc": $("#tipo_docum").val(),
									"numero_doc": $("#numero_doc").val(),
									"numero_ingreso": $("#numero_ingreso").val(),
									"nit_empresa": $("#empresa").val(),
									"estado_doc": $("#estado_doc").val(),
									"nit_sede": $("#sedeDoc").val(),
								},
							},
							columns: [
								{data: "botonVerDoc"},
								{data: "fecha_documento"},
								{data: "razon_social"},
								{data: "numero_ingreso"},
								{data: "usuario_crea"},
								{data: "sede"},
								{data: "estado"}
							],
						});
					} else {
						swal({
							type: "warning",
							title: "Debe seleccionar la sede"
						});
					}
				} else {
					swal({
						type: "warning",
						title: "Debe seleccionar el tipo de documento"
					});
				}
			} else {
				swal({
					type: "warning",
					title: "Seleccione un critero de búsqueda"
				});
			}
		});

		$(document).on("click", "#tablaModalBuscarDocumentos button", function () {
			let data = $("#tablaModalBuscarDocumentos").DataTable().row($(this).parents("tr")).data();

			$("#menu-ir-a-Doc").hide();
			$("#menu-ir-a-Doc").show(500);

			$("#btnDropdownVerDoc").on("click", function () {
				let url = data.urlDoc.replace("&funcion=", "&funcion=getVer");
				$(this).attr("href", url);
			});

			$("#btnDropdownEditarDoc").on("click", function () {
				let url = data.urlDoc.replace("&funcion=", "&funcion=getEditar");
				$(this).attr("href", url);
			});

			$("#ir-a-documento-cicloVida").on("click", function () {
				let url = data.urlDoc.replace("&funcion=Cotizacion", "&funcion=getCicloDeVida");
				$(this).attr("href", url);
			});
		});
	});

	// INFORME TÉCNICO
	$(function InformeTecnico(){

        $(document).on("change", "#no_ingreso, #num_ingreso", function () {
			let columnsDefs = [],
				columns = [];

			if ($(this).attr("type-of-view") == "registrar") {
				columnsDefs = [
					{ "className": "d-none", "targets": [0] },
					{ "className": "text-center", "targets": [1, 2, 3, 5, 6, 7] },
					{ "className": "text-center tdAccionCorrectiva", "targets": [4] },
				];
				
				columns = [
                    {data: "codigo_revision"},
                    {data: "parte_revisada"},
                    {data: "opcion_bueno"},
                    {data: "opcion_malo"},
                    {data: "accion_correctiva"},
                    {data: "opcion_si"},
                    {data: "opcion_no"},
                    {data: "opcion_borrar"}
				];
			}else if ($(this).attr("type-of-view") == "ver") {
				columnsDefs = [
					{ "className": "text-center", "targets": [0, 1, 2, 3, 4, 5] },
				];
				
				columns = [
                    {data: "parte_revisada"},
                    {data: "opcion_bueno"},
                    {data: "opcion_malo"},
                    {data: "accion_correctiva"},
                    {data: "opcion_si"},
                    {data: "opcion_no"},
				];
			}else if ($(this).attr("type-of-view") == "editar") {
				columnsDefs = [
					{ "className": "d-none", "targets": [0] },
					{ "className": "d-none", "targets": [1] },
					{ "className": "text-center", "targets": [2, 3, 5, 6, 7, 8] },
					{ "className": "text-center tdAccionCorrectiva", "targets": [4] },
				];
				
				columns = [
					{data: "numero_registro"},
                    {data: "codigo_revision"},
                    {data: "parte_revisada"},
                    {data: "opcion_bueno"},
                    {data: "opcion_malo"},
                    {data: "accion_correctiva"},
                    {data: "opcion_si"},
                    {data: "opcion_no"},
                    {data: "opcion_borrar"}
				];
			}

            var tablaRevisionIngreso = $("#tablaRevisionIngreso").DataTable({
                language: {
                    "url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json",
                },
                destroy: true,
                scrollY:  "350px",
                scrollCollapse: true,
                ordering: false,
                searching: false,
                bPaginate: false,
                info: false,
                autoWidth: false,
                lengthChange: false,
                columnDefs: columnsDefs,
                drawCallback: () => {
					tablaRevisionIngreso.columns.adjust();

					if ($(this).attr("type-of-view") == "ver") {
						$(".Accion_Correctiva").select2({
							language: "es",
							width: "100%",
							theme: "bootstrap",
							minimumResultsForSearch: -1
						});
						$("b[role=presentation]").hide();
					}else if($(this).attr("type-of-view") == "editar"){
						$(".Accion_Correctiva").select2({
							language: "es",
							width: "100%",
							theme: "bootstrap",
						});
						$("b[role=presentation]").hide();
					}
				},
                ajax: {
                    url: $(this).attr("data-urlDetalle"),
                    method: "post",
                    data: {
                        "Numero_Ingreso": $(this).val(),
                        "Tipo_Vista": $(this).attr("type-of-view")
                    },
                },
                columns: columns
			});
			
            $(document).on("click", "#tablaRevisionIngreso tr td.tdAccionCorrectiva", function () {
				let data = $("#tablaRevisionIngreso").DataTable().row($(this).parents("tr")).data();
				
                if (!$(this).html()) {
                    $.ajax({
                        url: "ajax.php?modulo=Informes&controlador=Informes&funcion=cargarActividadOrdenTrabajo",
                        method: "post",
                        dataType: "json",
                        data: {
                            Numero_Ingreso: $("#no_ingreso, #num_ingreso").val(),
                            Index: data.index,
                        },
                    }).done((res) => {
						if (res.tipoRespuesta == true) {
							$(this).html(res.selectAccionCorrectiva);
						}else{
							swal({
								type: "warning",
								title: "No se encontraron datos de la orden de trabajo"
							});
						}
					});
                }
			});
			
			$(document).on("change", ".Accion_Correctiva", function () {
				$('#tablaRevisionIngreso').DataTable().columns.adjust().responsive.recalc();
			});
			
			$(document).on("click", "#tablaRevisionIngreso button", function () {
				let data = $("#tablaRevisionIngreso").DataTable().row($(this).parents("tr")).data();
				let numeroRegistro = $(data.numero_registro).val();
				let tipo_doc = $("#tipo_documento").val();
				let url = $(this).attr("data-url");
		
                if ($("#tablaRevisionIngreso").DataTable().data().count() >= 2) {
                    $("#tablaRevisionIngreso").DataTable().row($(this).parents("tr")).remove().draw();
                } else {
                    swal({
                        type: "info",
                        title: "No se puede eliminar la última fila"
                    });
				}
				if (numeroRegistro && tipo_doc && url) {
					$(document).on("submit", "form", function () {
						$.ajax({
							url: url,
							method: "post",
							data: {
								"Numero_Registro": numeroRegistro,
								"tipo_doc": tipo_doc
							}
						});
					});
				}
			});

			$(document).on("click", "#tablaRevisionIngreso tr", function () {
				$(this).find("input[type=radio], select").each(function (){
					$(this).attr("required", true);
				});
			});
		});
		
		// INGRESO Y EDITAR DEL INFORME TÉCNICO
		$(document).on("submit", "#informeTecnicoReg", function (event) {
			event.preventDefault();

			$.ajax({
				url: "ajax.php?modulo=Informes&controlador=Informes&funcion=cargarActividadOrdenTrabajo",
				method: "post",
				dataType: "json",
				data: {
					Numero_Ingreso: $("#no_ingreso, #num_ingreso").val(),
				},
			}).done((res) => {
				if (res.tipoRespuesta == true) {
					$.ajax({
						url: $(this).attr("action"),
						method: $(this).attr("method"),
						data: new FormData(event.target),
						dataType: "json",
						processData: false,
						contentType: false
					}).done((res) => {
						swal({
							type: "success",
							title: "El registro se ha realizado con éxito.",
							html: `<h2 class="swal2-title">Número de Documento: <span class="badge badge-secondary">${res.numInforme}</span></h2>
										<div class="swal2-content" style="display: block;">Desea Imprimir?</div>`,
							showCancelButton: true,
							confirmButtonColor: "#337ab7",
							confirmButtonText: "Sí",
							cancelButtonColor: "#d33",
							cancelButtonText: "No",
							allowOutsideClick: false,
							allowEscapeKey: false,
						}).then((result) => {
							if (result.value) {
								let url = "../../views/Informes/GuiImprimirInformeTecnico.html.php?";
								window.open(url + "numero_doc=" + res.numInforme + "&nit_sede=" + $("#nit_sede").val());
								window.location.href = window.location = `index.php?modulo=Informes&controlador=Informes&funcion=getEditarInformeTecnico
									&numero_doc=${res.numInforme}&nit_sede=${$("#nit_sede").val()}`;
							} else {
								window.location.href = "index.php?modulo=Informes&controlador=Informes&funcion=crearInformeTecnico";
							}
						});
					});
				} else {
					swal({
						type: "error",
						title: "Error al Registrar, no se encontraron datos de la orden de trabajo"
					});
				}
			});
		});

		$(document).on("submit", "#formEditInformeTecnico", function (event) {
			event.preventDefault();
	
			$.ajax({
				url: $(this).attr("action"),
				method: $(this).attr("method"),
				data: new FormData(event.target),
				processData: false,
				contentType: false
			}).done((res) => {
				swal({
					type: "success",
					title: "El registro se ha actualizado con éxito:",
					text: "Desea Imprimir?",
					showCancelButton: true,
					confirmButtonColor: "#337ab7",
					confirmButtonText: "Sí",
					cancelButtonColor: "#d33",
					cancelButtonText: "No",
					allowOutsideClick: false,
					allowEscapeKey: false,
				}).then((result) => {
					if (result.value) {
						let url = "../../views/Informes/GuiImprimirInformeTecnico.html.php?";
						window.open(url + "numero_doc=" + $("#numInforme").val() + "&nit_sede=" + $("#nit_sede").val());
					}
				});
			});
		});
		// FIN INGRESO Y EDITAR DEL INFORME TÉCNICO

		$(document).on("click", "#AnularInformeTecnico", function () {
			var url = $(this).attr("data-url");
			var numInforme = $("#numInforme").val();
			var nit_sede = $("#nit_sede").val();
	
			if (numInforme != "") {
				var msjAnular = confirm("Desea Anular el Informe Técnico!");
	
				if (msjAnular == true) {
					var razonAnula = prompt("Ingrese la Razon por la cual Anula");
					if (razonAnula != "") {
	
						$.ajax({
							url: url,
							data: "numInforme=" + numInforme + "&Razon_Anula=" + razonAnula + "&nit_sede=" + nit_sede,
							type: "POST",
							success: function () {
								alert('Registro Anulado con Exito');
							}
						});
					} else {
						alert("Proceso Cancelado");
					}
				} else {
					alert("Proceso Cancelado");
				}
			}
	
		});

		$(document).on("click", "#VerDatosInformeTecnico", function () {
			var url = $(this).attr("data-url");
			var numInforme = $("#numInforme").val();
	
			$.ajax({
				url: url,
				data: "numInforme=" + numInforme,
				type: "POST",
				success: function (dato) {
					$("#div_Datos_Adicionales").html(dato);
					$("#VerDatos").modal("show");
				}
			});
		});
	});

	$(document).on("click", "#PdfInformeTecnico", function () {
		var numero_doc = $("#numInforme").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/Informes/GuiImprimirInformeTecnico.html.php?";

		window.open(url + "numero_doc=" + numero_doc  + "&nit_sede=" + nit_sede);
	});
	
	$(document).on("click", "#WordInformeTecnico", function () {
		var numero_doc = $("#numInforme").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/Informes/GuiWordInformeTecnico.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc  + "&nit_sede=" + nit_sede;
	});
	// FIN INFORME TÉCNICO

	$(document).on("click", ".tr_VerIngreso", function () {
		var url = "index.php?modulo=Ingresos&controlador=Ingresos";
		var numero_doc = $(this).attr('data-numdoc');
		var serie = $(this).attr('data-serie');
		var nit_sede = $(this).attr('data-nit_sede');
		var tipo_oi = $(this).attr('data-tipo_oi');
		var funcion = "&funcion=getEditar" + tipo_oi;


		window.location.href = url + funcion + "&numero_doc=" + numero_doc + "&serie=" + serie + "&nit_sede=" + nit_sede;

	});

	$(document).on("click", "#PdfFVC", function () {
		var numero_doc = $('#numFVC').val();
		var tipo_doc = $('#tipo_doc').val();
		var nit_sede = $('#nit_sede').val();
		var url = "../../views/Factura/GuiImprimirFVC.html.php?";


		$.ajax({
			url: "ajax.php?modulo=Factura&controlador=Factura&funcion=copiasFactura",
			method: "post",
			dataType: "json",
		}).done((res) => {
			for (let index = 0; index < res.Circularizacion[0].length; index++) {
				window.open(url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede + "&circularizacion=" + res.Circularizacion[0][index] + "");
			}
		});
	});

	$(document).on("click", "#PdfCT", function () {
		var numero_doc = $("#numCT").val();
		var tipo_doc = $("#tipo_doc").val();
		var nit_sede = $("#nit_sede").val();
		var url = "../../views/Cotizaciones/GuiImprimirCT.html.php?";

		window.open(url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede);
	});

	$(document).on("click", "#WordCT", function () {
		var numero_doc = $("#numCT").val();
		var tipo_doc = $("#tipo_doc").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/Cotizaciones/GuiWordCT.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede;
	});

	$(document).on("click", "#WordFVC", function () {
		var numero_doc = $('#numFVC').val();
		var tipo_doc = $('#tipo_doc').val();
		var nit_sede = $('#nit_sede').val();

		var url = "../../views/Factura/GuiWordFVC.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede;
	});

	$(document).on("click", "#ImprimirESB", function () {
		var numero_doc = $('#numEB').val();
		var tipo_doc = $('#tipo_documento').val();
		var nit_sede = $('#nit_sede').val();

		var url = "../../views/EntradaBodega/GuiImprimir.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede;
		target = "_blank";
	});

	$(function buscarClientesSede() {
		$(document).on("change", "#nit_sede", function () {
			let nit_cliente = $(this).attr("data-campo");
			let url = $(this).attr('data-url');
			let nit_sede = $(this).val();

			$.ajax({
				url: url,
				method: "post",
				dataType: "json",
				data: {
					"nit_sede": nit_sede,
				},
			}).done((res) => {
				$(nit_cliente).html(res.selectNitCliente);
			});
		});
	});

	$(function buscarVendedorSede() {
		$(document).ready(function () {
			if ($("#nit_sede").val()) {
				$("#nit_sede").trigger("change");
			}
		});

		$(document).on("change", "#nit_sede", function () {
			let url = $("#vendedor").attr("data-url");
			let nit_sede = $(this).val();

			$.ajax({
				url: url,
				method: "post",
				dataType: "json",
				data: {
					"nit_sede": nit_sede,
				},
			}).done((res) => {
				$("#vendedor").html(res.selectVendedor);
			});
		});
	});

	$(document).on("change", "#Nit_Cliente", function () {

		var url = $(this).attr('data-url');
		var nit = $(this).val();
		var url_contacto = $(this).attr('data-urlcontacto');
		var planta = "";
		$("#despachado_por").val();

		$.ajax({
			url: url,
			data: "nit=" + nit,
			type: "POST",
			success: function (dato) {
				$('#Codigo_Planta').html(dato);
			}
		});

		// $.ajax({
		// 	url: url_contacto,
		// 	data: "nit_cliente=" + nit + "&planta=" + planta,
		// 	dataType: "json",
		// 	type: "POST",
		// 	success: function (info_contacto) {
		// 		$('#despachado_por').val(info_contacto.Nombre_Contacto);
		// 	}
		// });

	});


	$(document).on("click", "#BuscarEqui", function () {
		var oi = $('#buscar_Equi').val();
		var url = $(this).attr('data-url');
		$.ajax({
			url: url,
			data: "oi=" + oi,
			type: "post",
			success: function (dato) {

				$('#page-wrapper').html(dato);
			}
		});
	});

	$(document).on("click", "#CerrarElect", function () {
		var Potencia = $('#serie1').val();
		var Revoluciones_Por_Minuto = $('#serie2').val();
	});

	$(document).on("click", "#elimiEntradaBodega", function () {
		var num_doc = $('#numEB').val();
		var url = $(this).attr('data-url');

		if (num_doc != "") {
			var msjAnular = confirm("Desea Anular la Entrada a Bodega!");

			if (msjAnular == true) {
				var razonAnula = prompt("Escriba la Razon ");
				if (razonAnula != "") {

					$.ajax({
						url: url,
						data: "num_doc=" + num_doc + "&tipo_doc=" + "EB" + "&Razon_Anula=" + razonAnula,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}

	});

	$(document).on("click", "#VerDatosEB", function () {
		var num_doc = $('#numEB').val();
		var url = $(this).attr('data-url');
		var sede = $('#nit_sede').val();

		$.ajax({
			url: url,
			data: "num_doc=" + num_doc + "&nit_sede=" + sede,
			type: "post",
			success: function (dato) {
				$('#div_DatosAdicionales').html(dato);
				$('#VerDatosAdicionales').modal('show');
			}

		});
	});

	$(document).on("change", "#fecha_aprobGER", function () {
		var valAprobacion = false;
		var fechApro = $(this).val();
		var tipo = $("#tipo_doc").val();
		var num_doc = $("#numCT").val();
		var sede = $("#nit_sede").val();
		var url = $(this).attr("data-url");

		valAprobacion = confirm("Desea actualizar la fecha de Aprobación?");
		if (valAprobacion == true) {
			$.ajax({
				url: url,
				data: "num_doc=" + num_doc + "&nit_sede=" + sede + "&tipo_doc=" + tipo + "&fechApro=" + fechApro,
				type: "post",
				success: function () {
					alert("Fecha actualizada con éxito!!");
				}
			});
		}
	});

	$(document).on("change", "#fecha_EntregaRM", function () {
		var valRecibido = false;
		var fechRecib = $(this).val();
		var tipo = $("#tipo_documento").val();
		var num_doc = $("#numRM").val();
		var sede = $("#nit_sede").val();
		var url = $(this).attr("data-url");

		valRecibido = confirm("Desea actualizar la fecha de Recibido?");
		if (valRecibido == true) {
			$.ajax({
				url: url,
				data: "num_doc=" + num_doc + "&nit_sede=" + sede + "&tipo_doc=" + tipo + "&fechRecib=" + fechRecib,
				type: "post",
				success: function () {
					alert("Fecha actualizada con éxito!!");
				}
			});
		}
	});

	// $(document).on("change", "#orden_compra", function () {
	// 	var valOrden = false;
	// 	var OrdenCompra = $(this).val();
	// 	var tipo = $("#tipo_doc").val();
	// 	var num_doc = $("#numCT").val();
	// 	var sede = $("#nit_sede").val();
	// 	var url = $(this).attr("data-url");

	// 	valOrden = confirm("Desea actualizar la Orden de Compra?");
	// 	if (valOrden == true) {
	// 		$.ajax({
	// 			url: url,
	// 			data: "num_doc=" + num_doc + "&nit_sede=" + sede + "&tipo_doc=" + tipo + "&OrdenCompra=" + OrdenCompra,
	// 			type: "post",
	// 			success: function () {
	// 				alert("Orden actualizada con éxito!!");
	// 			}
	// 		});
	// 	}
	// });

	$(document).on("change", "#Codigo_Planta", function () {
		var nit = "";
		var url_contacto = $(this).attr('data-urlcontacto');
		var planta = $(this).val();
		var despachado = $('#despachado_por').val();

		$.ajax({
			url: url_contacto,
			data: "nit_cliente=" + nit + "&planta=" + planta,
			dataType: "json",
			type: "POST",
			success: function (info_contacto) {
				$('#despachado_por').val(info_contacto.Nombre_Contacto);
			}
		});

	});

	$(document).on("click", "#ActGERDoneya", function () {
		var num_doc = $('#numCT').val();
		var sede = $('#nit_sede').val();
		//var url=$(this).attr('data-url');
		var producto = $('#producto_id0').val();

		if (num_doc != "" && sede != "" && producto != "") {
			var num = $('#numCT').val().indexOf("-");
			if (num > 0) {
				var cant_caracter = $('#numCT').val().length;
				var ultimoDigito = num_doc.substr(cant_caracter - 1, 1);
				if (ultimoDigito === 5) {
					var url_Modificar = "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=ActualizarCotizacion";
					$.ajax({
						url: url_Modificar,
						data: $('#VercotizacionGER').serialize(),
						success: function () {
							alert('salio de Actualizar');
						}

					});
				} else {
					valAprobacion = confirm("Desea modifiar y generar -#?");
					if (valAprobacion == true) {
						var url_Crear = "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=RegistrarCotizacion";
						$.ajax({
							url: url_Crear,
							data: $("#VercotizacionGER").serialize(),
							success: function () {
								alert('salio de Registrar');
							}

						});
					}
				}
			} else {
				valAprobacion = confirm("Desea modifiar y generar -#?");
				if (valAprobacion == true) {
					var url_Crear = "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=RegistrarCotizacion";
					$.ajax({
						url: url_Crear,
						data: $('#cotizacionRegGER').serialize(),
						type: "post",
						success: function () {

						}

					});
				}

			}
		} else {
			alert('Falta datos !!!');
		}


	});

	//Doneya Julio 18 de 2018
	$(document).on("click", "#verPoVeVol_Ingreso", function () {
		var url = $(this).attr('data-url');
		var num_doc = $(this).attr('data-numdoc');
		var nit_sede = $(this).attr('data-nit_sede');

		$.ajax({
			url: url,
			data: "num_doc=" + num_doc + "&nit_sede=" + nit_sede,
			type: "get",
			success: function (datoEquipo) {
				var datos = JSON.parse(datoEquipo);

				$('#tdIngPotencia' + num_doc).val(datos['Potencia']);
				$('#tdIngVelocidad' + num_doc).val(datos['Velocidad']);
				$('#tdIngVoltaje' + num_doc).val(datos['Voltaje']);
			}
		});
	});

	$(document).on("click", "#agregarDatosElectricosAC", function () {
		let cont = $("#tbody_datosElectricosAC tr").length;
		cont == 0 ? cont = 1 : cont = $("#tbody_datosElectricosAC tr").length;
		let fila = `<tr class="type-number">
			<td width="20%">
                <input type="text" class="form-control" name="PotenciaInsert[]" id="Potencia${cont}">
            </td>

            <td width="20%">
                <select class="form-control select2" id="Unidad_De_Potencia${cont}" name="Unidad_De_PotenciaInsert[]">
                      <option value="" selected></option>
                      <option value="HP">HP</option>
                      <option value="KW" >KW</option>
                      <option value="W">W</option>
                      <option value="KVA" >KVA</option>
                      <option value="MVA">MVA</option>
                      <option value="VA" >VA</option>
                      <option value="CV">CV</option>
                </select>
            </td>

            <td width="20%">
                <input type="text" class="form-control" name="Revoluciones_Por_MinutoInsert[]" id="Revoluciones_Por_Minuto${cont}">
            </td>

            <td width="20%">
                <input type="text" class="form-control" name="VoltajeInsert[]" id="Voltaje${cont}">
            </td>

            <td width="20%">
                <input type="text" class="form-control" name="AmperajeInsert[]" id="Amperaje${cont}">
            </td>

            <td><button type='button' name='btnserieDC' class='btn btn-danger btn-circle eliminar'> - </button></td>

		  </tr>`;
		$("#tbody_datosElectricosAC").append(fila);
		$(".select2").select2({
			language: "es",
			width: "100%",
			theme: "bootstrap"
		});
		cont++;
	});

	$(document).on("click", "#agregarDatosElectricosDC", function () {
		let cont = $("#tbody_datosElectricosDC tr").length;
		cont == 0 ? cont = 1 : cont = $("#tbody_datosElectricosDC tr").length;
		let fila = `<tr class="type-number">
			<td width="13%">
                <input type="text" class="form-control" name="PotenciaInsert[]" id="Potencia${cont}">
            </td>

            <td width="13%">
                <select class="form-control select2" id="Unidad_De_Potencia${cont}" name="Unidad_De_PotenciaInsert[]">
                      <option value="" selected></option>
                      <option value="HP">HP</option>
                      <option value="KW" >KW</option>
                      <option value="W">W</option>
                      <option value="KVA" >KVA</option>
                      <option value="MVA">MVA</option>
                      <option value="VA" >VA</option>
                      <option value="CV">CV</option>
                </select>
            </td>

            <td width="13%">
                <input type="text" class="form-control" name="Revoluciones_Por_MinutoInsert[]" id="Revoluciones_Por_Minuto${cont}">
            </td>

            <td width="13%">
                <input type="text" class="form-control" name="VaInsert[]" id="Va${cont}">
            </td>

            <td width="13%">
                <input type="text" class="form-control" name="VcInsert[]" id="Vc${cont}">
            </td>

            <td width="13%">
             <input type="text" class="form-control" name="IaInsert[]" id="Ia${cont}">
            </td>

            <td width="13%">
               <input type="text" class="form-control" name="IcInsert[]" id="Ic${cont}">
            </td>

            <td><button type='button' id="btnEliminarDatoElectricoDC" class='btn btn-danger btn-circle eliminar'> - </button></td>

		  </tr>`;
		$("#tbody_datosElectricosDC").append(fila);
		$(".select2").select2({
			language: "es",
			width: "100%",
			theme: "bootstrap"
		});
		cont++;
	});

	$(document).on("click", "#agregarDatosElectricosOT", function () {
		let cont = $("#tbody_datosElectricosOT tr").length;
		cont == 0 ? cont = 1 : cont = $("#tbody_datosElectricosOT tr").length;
		let fila = `<tr class="type-number">
			<td width="13%">
                <input type="text" class="form-control" name="PotenciaInsert[]" id="Potencia${cont}">
            </td>

            <td width="13%">
                <select class="form-control select2" id="Unidad_De_Potencia${cont}" name="Unidad_De_PotenciaInsert[]">
                      <option value="" selected></option>
                      <option value="HP">HP</option>
                      <option value="KW" >KW</option>
                      <option value="W">W</option>
                      <option value="KVA" >KVA</option>
                      <option value="MVA">MVA</option>
                      <option value="VA" >VA</option>
                      <option value="CV">CV</option>
                </select>
            </td>

            <td width="13%">
                <input type="text" class="form-control" name="Revoluciones_Por_MinutoInsert[]" id="Revoluciones_Por_Minuto${cont}">
            </td>

            <td width="13%">
                <input type="text" class="form-control" name="VaInsert[]" id="Va${cont}">
            </td>

            <td width="13%">
                <input type="text" class="form-control" name="VcInsert[]" id="Vc${cont}">
            </td>

            <td width="13%">
             <input type="text" class="form-control" name="IaInsert[]" id="Ia${cont}">
            </td>

            <td width="13%">
               <input type="text" class="form-control" name="IcInsert[]" id="Ic${cont}">
            </td>

            <td><button type='button' id="btnEliminarDatoElectricoOUT" class='btn btn-danger btn-circle eliminar'> - </button></td>

		  </tr>`;
		$("#tbody_datosElectricosOT").append(fila);
		$(".select2").select2({
			language: "es",
			width: "100%",
			theme: "bootstrap"
		});
		cont++;
	});

	$(document).on("click", ".btnEliminarDatoElectrico", function () {
		$(this).closest("tr").remove();
		let numeroRegistro = $(this).closest("tr").find('input[name="Numero_RegistroEditar[]"]').val();
		let url = $(this).attr("data-url");

		$(document).on("submit", "form", function () {
			$.ajax({
				url: url,
				method: "post",
				data: {
					"Numero_Registro": numeroRegistro
				}
			});
		});
	});
	/**************************KATHE********************************/
	/**************************pais-departamento********************************/
	$(document).on("change", "#pais", function () {
		var pais = $(this).val();
		var url = $(this).attr('data-url');
		//alert('ajhfajsfdasd'+pais);
		$.ajax({
			url: url,
			data: "pais=" + pais,
			type: "post",
			success: function (dato) {
				$('#depto').html(dato);
			}
		});
	});
	/**************************departamento-ciudad********************************/
	$(document).on("change", "#depto", function () {
		var depto = $(this).val();
		var url = $(this).attr('data-url');
		//alert('ajhfajsfdasd'+pais);
		$.ajax({
			url: url,
			data: "depto=" + depto,
			type: "post",
			success: function (dato) {
				$('#ciudad').html(dato);
			}
		});
	});

	/*******************MODALES**********************/
	/****Abrir MODAL BUSCAR CLIENTES**/
	$(document).on("click", "#ListarCliente", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#modalBuscarClientes .modal-body").html(res);
			$("#modalBuscarClientes").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});

	/*****************************PLANTA**********************************************************************************/

	/*LISTAR LAS PLANTAS*/
	$(document).on("click", "#btnListarPlantas", function () {
		$("#divclientes").hide();
		$("#divplantas").show();

		$(document).on("click", "#AtrasPlanta", function () {
			$("#divplantas").hide();
			$("#divclientes").show();
		});

		let tipoVista = $(this).attr("type-of-view");
		let columns = [];

		if (tipoVista == "ver") {
			columns = [
				{data: "nombre"},
				{data: "direccion"},
				{data: "ver"},
				{data: "contactos"},
				{data: "vendedores"}
			];
		} else if (tipoVista == "editar") {
			columns = [
				{data: "nombre"},
				{data: "direccion"},
				{data: "editar"},
				{data: "eliminar"},
				{data: "contactos"},
				{data: "vendedores"}
			];
		}

		var tablaListarPlantas = $("#tablaListarPlantas").DataTable({
			language: {
				"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
			},
			destroy: true,
			pageLength: 10,
			lengthChange: false,
			autoWidth: false,
			columnDefs: [{
				"className": "text-center",
				"targets": "_all"
			}],
			drawCallback: () => {
				tablaListarPlantas.columns.adjust();
				$(document).on("click", "#btnModalCrearPlanta", function () {
					$("#formPlanta")[0].reset();
				});
			},
			ajax: {
				url: $(this).attr("data-url"),
				method: "post",
				data: {
					"nit_cliente": $("#nit_cliente").val(),
					"tipo_vista": tipoVista
				},
			},
			columns: columns
		});
	});

	$(document).on("submit", "#formPlanta", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			data: {
				nom_planta: $("#nom_planta_insert").val(),
				dir_planta: $("#dir_planta_insert").val(),
				empleado: $("#empleado").val(),
				nit_cliente: $("#nit_cliente").val(),
				nit_sede: $("#nit_sede").val(),
			}
		}).done((res) => {
			if (res.tipoRespuesta == true) {
				swal({
					type: "success",
					title: "El registro se ha realizado con éxito",
					showConfirmButton: false,
					timer: 2500
				});
				$("#tablaListarPlantas").DataTable().ajax.reload();
				$(this)[0].reset();
			}
		});
	});

	$(document).on("click", "#tablaListarPlantas .btnModalEditarPlanta", function () {
		let data = $("#tablaListarPlantas").DataTable().row($(this).parents("tr")).data();

		$("#codigo_planta_update").val(data.codigo_planta);
		$("#nom_planta_update").val(data.nombre);
		$("#dir_planta_update").val(data.direccion);
	});

	$(document).on("submit", "#formEditarPlanta", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			data: {
				codigo_planta: $("#codigo_planta_update").val(),
				nom_planta: $("#nom_planta_update").val(),
				dir_planta: $("#dir_planta_update").val()
			}
		}).done((res) => {
			if (res.tipoRespuesta == true) {
				swal({
					type: "success",
					title: "El registro se ha actualizado con éxito",
					showConfirmButton: false,
					timer: 2500
				});
				$("#tablaListarPlantas").DataTable().ajax.reload();
			}
		});
	});

	$(document).on("click", "#tablaListarPlantas .btnEliminarPlanta", function () {
		let data = $("#tablaListarPlantas").DataTable().row($(this).parents("tr")).data();

		swal({
			title: "Estás seguro(a) que deseas eliminar esta planta?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#337ab7",
			confirmButtonText: "Sí, quiero eliminarla!",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						codigo_planta: data.codigo_planta,
					}
				}).done((res) => {
					if (res.tipoRespuesta == true) {
						swal({
							type: "success",
							title: "La planta se ha eliminado correctamente!",
							showConfirmButton: false,
							timer: 2500,
						});
						$("#tablaListarPlantas").DataTable().ajax.reload();
					}
				});
			}
		});
	});

	/*************************CLIENTE***************************************************************************************/
	/*LISTAR LOS CLIENTES*/

	$(function BuscarClientes() {

		$(document).on("submit", "#frm_BuscarClientes", function (event) {

			event.preventDefault();

			if ($('#Nit_cliente').val() || $('#Razon_social').val() || $('#Ciudad').val() || $('#Estado').val()) {

				$("#containerTablaModalBuscarClientes").show();
				$("#add-menu-ir-a").hide();

				var tablaModalBuscarClientes = $("#tablaModalBuscarClientes").DataTable({
					language: {
						"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
					},
					destroy: true,
					ordering: false,
					pageLength: 10,
					autoWidth: false,
					lengthChange: false,
					columnDefs: [{
						"className": "text-center",
						"targets": "_all"
					}],
					drawCallback: () => {
						tablaModalBuscarClientes.columns.adjust();
					},
					ajax: {
						url: $(this).prop("action"),
						method: $(this).prop("method"),
						data: {
							"Nit_cliente": $("#Nit_cliente").val(),
							"Razon_social": $("#Razon_social").val(),
							"Ciudad": $("#Ciudad").val(),
							"Estado": $("#Estado").val()
						},
					},
					columns: [
						{data: "botonVerEditar"},
						{data: "nit_sede"},
						{data: "razon_social"},
						{data: "ciudad"},
						{data: "direccion"},
						{data: "telefono"},
						{data: "estado"}
					],
					initComplete: () => {
						$(document).on("click", "#tablaModalBuscarClientes button", function () {
							let data = $("#tablaModalBuscarClientes").DataTable().row($(this).parents("tr")).data();

							$("#menu-ir-a-Clientes").hide();
							$("#menu-ir-a-Clientes").show(500);

							let pagina = "index.php";
							let nit_sede = "&nit_sede=" + data.nit_sede;
							let nit_cliente = "&nit_cliente=" + data.nit_cliente;
							let modulo = "?modulo=Clientes";
							let controlador = "&controlador=Clientes";

							$("#btnVerCliente").on("click", function () {
								let funcion = "&funcion=getVerCliente";
								let parametros = nit_sede + nit_cliente;
								let url = pagina + modulo + controlador + funcion + parametros;
								$(this).attr("href", url);
							});

							$("#btnEditarCliente").on("click", function () {
								let modulo = "?modulo=Clientes";
								let controlador = "&controlador=Clientes";
								let funcion = "&funcion=getEditarCliente";
								let parametros = nit_sede + nit_cliente;
								let url = pagina + modulo + controlador + funcion + parametros;
								$(this).attr("href", url);
							});

						});
					},
				});
			} else {
				swal({
					type: "warning",
					title: "Seleccione un criterio de búsqueda"
				});
			}
		});
	});
	/***************ELIMINAR CLIENTE*******************/
	$(document).on("click", "#elimicliente", function () {
		var nit = $('#nit').val();
		var url = $(this).attr("data-url");
		var urlcompleta = url + "&nit=" + nit;

		$('#elimicliente').attr("href", urlcompleta);
	});
	/*******************************************CONTACTO**************************************************************/
	$(document).on("click", "#tablaListarPlantas #btnListarContactos", function () {
		let data = $("#tablaListarPlantas").DataTable().row($(this).parents("tr")).data();

		$("#divplantas").hide();
		$("#divcontactos").show();

		$(document).on("click", "#AtrasContacto", function () {
			$("#divplantas").show();
			$("#divcontactos").hide();
		});

		let tipoVista = $(this).attr("type-of-view");
		let columns = [];

		if (tipoVista == "ver") {
			columns = [
				{data: "nombre"},
				{data: "email"},
				{data: "telefono"},
				{data: "ver"}
			];
		} else if (tipoVista == "editar") {
			columns = [
				{data: "nombre"},
				{data: "email"},
				{data: "telefono"},
				{data: "editar"},
				{data: "eliminar"}
			];
		}

		var tablaListarContactos = $("#tablaListarContactos").DataTable({
			language: {
				"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
			},
			destroy: true,
			pageLength: 10,
			autoWidth: true,
			lengthChange: false,
			columnDefs: [{
				"className": "text-center",
				"targets": "_all"
			}],
			drawCallback: () => {
				tablaListarContactos.columns.adjust();
				$(document).on("click", "#btnModalCrearContacto", function () {
					$("#formContacto")[0].reset();
					$("#codigo_planta_insert").val(data.codigo_planta);
				});
			},
			ajax: {
				url: $(this).attr("data-url"),
				method: "post",
				data: {
					"codigo_planta": data.codigo_planta,
					"tipo_vista": tipoVista
				},
			},
			columns: columns
		});
	});

	$(document).on("submit", "#formContacto", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			data: {
				codigo_planta: $("#codigo_planta_insert").val(),
				nom_contacto: $("#nom_contacto_insert").val(),
				dir_contacto: $("#dir_contacto_insert").val(),
				tel_contacto: $("#tel_contacto_insert").val(),
				email_contacto: $("#email_contacto_insert").val(),
			}
		}).done((res) => {
			if (res.tipoRespuesta == true) {
				swal({
					type: "success",
					title: "El registro se ha realizado con éxito",
					showConfirmButton: false,
					timer: 2500
				});
				$("#tablaListarContactos").DataTable().ajax.reload();
				$("#tablaListarPlantas").DataTable().ajax.reload();
				$(this)[0].reset();
			}
		});
	});

	$(document).on("click", "#tablaListarContactos .btnModalEditarContacto", function () {
		let data = $("#tablaListarContactos").DataTable().row($(this).parents("tr")).data();

		$("#codigo_contacto_update").val(data.codigo_contacto);
		$("#nom_contacto_update").val(data.nombre);
		$("#dir_contacto_update").val(data.direccion);
		$("#tel_contacto_update").val(data.telefono);
		$("#email_contacto_update").val(data.email);
	});

	$(document).on("submit", "#formEditarContacto", function (event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			dataType: "json",
			data: {
				codigo_contacto: $("#codigo_contacto_update").val(),
				nom_contacto: $("#nom_contacto_update").val(),
				dir_contacto: $("#dir_contacto_update").val(),
				tel_contacto: $("#tel_contacto_update").val(),
				email_contacto: $("#email_contacto_update").val(),
			}
		}).done((res) => {
			if (res.tipoRespuesta == true) {
				swal({
					type: "success",
					title: "El registro se ha actualizado con éxito",
					showConfirmButton: false,
					timer: 2500
				});
				$("#tablaListarContactos").DataTable().ajax.reload();
			}
		});
	});

	$(document).on("click", "#tablaListarContactos .btnEliminarContacto", function () {
		let data = $("#tablaListarContactos").DataTable().row($(this).parents("tr")).data();

		swal({
			title: "Estás seguro(a) que deseas eliminar este contacto?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#337ab7",
			confirmButtonText: "Sí, quiero eliminarlo!",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					url: $(this).attr("data-url"),
					method: "post",
					dataType: "json",
					data: {
						codigo_contacto: data.codigo_contacto,
					}
				}).done((res) => {
					if (res.tipoRespuesta == true) {
						swal({
							type: "success",
							title: "El contacto se ha eliminado correctamente!",
							showConfirmButton: false,
							timer: 2500,
						});
						$("#tablaListarContactos").DataTable().ajax.reload();
						$("#tablaListarPlantas").DataTable().ajax.reload();
					}
				});
			}
		});
	});
	/***************************VENDEDORES**************************/
	$(document).on("click", "#tablaListarPlantas #btnListarVendedores", function () {
		let data = $("#tablaListarPlantas").DataTable().row($(this).parents("tr")).data();

		$("#divplantas").hide();
		$("#divvendedores").show();

		$(document).on("click", "#AtrasVendedor", function () {
			$("#divplantas").show();
			$("#divvendedores").hide();
		});

		let tipoVista = $(this).attr("type-of-view");
		let columns = [];

		if (tipoVista == "ver") {
			columns = [{
					data: "codigo_planta"
				},
				{
					data: "nombre"
				},
				{
					data: "cedula"
				}
			];
		} else if (tipoVista == "editar") {
			columns = [{
					data: "codigo_planta"
				},
				{
					data: "nombre"
				},
				{
					data: "cedula"
				}
			];
		}

		var tablaListarVendedor = $("#tablaListarVendedor").DataTable({
			language: {
				"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
			},
			destroy: true,
			pageLength: 10,
			autoWidth: true,
			lengthChange: false,
			columnDefs: [{
				"className": "text-center",
				"targets": "_all"
			}],
			drawCallback: () => {
				tablaListarVendedor.columns.adjust();
				$(document).on("click", "#btnModalEditarVendedor", function () {
					$("#formVendedor")[0].reset();
					$("#codigo_planta").val(data.codigo_planta);
				});
			},
			ajax: {
				url: $(this).attr("data-url"),
				method: "post",
				data: {
					"codigo_planta": data.codigo_planta,
					"tipo_vista": tipoVista
				},
			},
			columns: columns
		});

		$(document).on("submit", "#formVendedor", function (event) {
			event.preventDefault();

			$.ajax({
				url: $(this).attr("action"),
				method: $(this).attr("method"),
				dataType: "json",
				data: {
					codigo_planta: $("#codigo_planta").val(),
					vendedor: $("#vendedor").val(),
				}
			}).done((res) => {
				if (res.tipoRespuesta == true) {
					swal({
						type: "success",
						title: "El registro se ha actualizado con éxito",
						showConfirmButton: false,
						timer: 2500
					});
					$("#tablaListarVendedor").DataTable().ajax.reload();
					$("#tablaListarPlantas").DataTable().ajax.reload();
					$(this)[0].reset();
				}
			});
		});
	});


	/***************************EMPLEADOS**************************/
	/***************************LISTAR EMPLEADOS**************************/
	/****Abrir MODAL BUSCAR EMPLEADO**/
	$(document).on("click", "#ListarEmpleado", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#modalBuscarEmpleados .modal-body").html(res);
			$("#modalBuscarEmpleados").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});
	/********* Buscar Empleado**************/
	$(function BuscarEmpleados() {

		$(document).on("submit", "#frm_BuscarEmpleados", function (event) {

			event.preventDefault();

			if ($('#cedula').val() || $('#nombre').val() || $('#cargo').val() || $('#estado').val()) {

				$("#containerTablaModalBuscarEmpleados").show();
				$("#add-menu-ir-a").hide();

				var tablaModalBuscarEmpleados = $("#tablaModalBuscarEmpleados").DataTable({
					dom: "Bfrtip",
					buttons: [{
						extend: "excelHtml5",
						text: '<i class="fa fa-file-excel"></i>',
						titleAttr: "Exportar a Excel",
						className: "bg-success",
						filename: "Empleados",
						sheetName: "Empleados"
					}],
					language: {
						"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
					},
					destroy: true,
					pageLength: 10,
					autoWidth: true,
					lengthChange: false,
					columnDefs: [{
						"className": "text-center",
						"targets": "_all"
					}],
					ajax: {
						url: $(this).prop("action"),
						method: $(this).prop("method"),
						data: {
							"cedula": $("#cedula").val(),
							"nombre": $("#nombre").val(),
							"cargo": $("#cargo").val(),
							"estado": $("#estado").val()
						},
					},
					columns: [
						{data: "numeroEmpleado"},
						{data: "cedula"},
						{data: "nombre"},
						{data: "cargo"},
						{data: "estado"}
					],
				});

				$(document).on("click", "#tablaModalBuscarEmpleados button", function () {
					let data = $("#tablaModalBuscarEmpleados").DataTable().row($(this).parents("tr")).data();

					$("#menu-ir-a-Empleados").hide();
					$("#menu-ir-a-Empleados").show(500);

					let pagina = "index.php";
					let cedula = "&cedula=" + data.cedula;
					let nit_sede = "&nit_sede=" + data.nit_empresa;
					let modulo = "?modulo=Empleados";
					let controlador = "&controlador=Empleados";

					$("#btnVerEmpleado").on("click", function () {
						let funcion = "&funcion=getVerEmpleado";
						let parametros = cedula + nit_sede;
						let url = pagina + modulo + controlador + funcion + parametros;
						$(this).attr("href", url);
					});

					$("#btnEditarEmpleado").on("click", function () {
						let funcion = "&funcion=getEditarEmpleado";
						let parametros = cedula + nit_sede;
						let url = pagina + modulo + controlador + funcion + parametros;
						$(this).attr("href", url);
					});

				});
			} else {
				swal({
					type: "warning",
					title: "Seleccione un criterio de búsqueda"
				});
			}
		});
	});
	/*********Consulta llenar empleado**************/
	$(document).on("blur", "#cedula_emple", function () {

		var cedula = $(this).val();
		var url = "ajax.php?modulo=Empleados&controlador=Empleados&funcion=getllenarEmple";

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarE=" + cedula,
			success: function (res) {

				var resultados = JSON.parse(res);

				// $("#cedula_emple").val(resultados['Cedula_Empleado']);
				if (resultados['Cedula_Empleado'] != null) {
					$(".cedula").val(resultados['Cedula_Empleado']);
					$("#cedula_retiro").val(resultados['Cedula_Empleado']);
					$("#nom_emple").val(resultados['Nombres']);
					$("#apell_emple").val(resultados['Apellidos']);

					//$("#cod_emple").val(resultados['Codigo']);
					$("#dir_emple").val(resultados['Direccion']);
					$("#tel1").val(resultados['tel1']);
					$("#tel2").val(resultados['tel2']);
					$("#mail_emple").val(resultados['email']);
					$("#fnacimiento").val(resultados['fnacimiento']);
					$("#lugarn").val(resultados['lugarn']);

					$("#ciudad").val(resultados['ciudadreside']);
					$("#salario_emple").val(resultados['salario']);
					$("#cargo_emple").val(resultados['cargo']);
					$("#centroCosto").val(resultados['costos']);
					$("#nit_sede").val(resultados['nit_sede']);

					$("#psig").val(resultados['sig']);
					$("#fingreso").val(resultados['fingreso']);
					$("#tvincula").html("<option value='" + resultados['vinculacion'] + "'>" + resultados['vinculacion'] + "</option>");

					if (resultados['firma'] === "S") {
						$("#firma").prop('checked', true);
					} else {
						$("#firma").prop('checked', false);
					}
				}

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove(); //eliminamos el backdrop del modal
				$('#detalleEmpl').show();
			}
		});

		$.ajax({
			url: "ajax.php?modulo=Empleados&controlador=Empleados&funcion=LlenarDetalleEmpleado",
			data: "emp_id=" + cedula,
			type: "post",
			success: function (detalles) {
				$('#detalleEmpl').html(detalles);
			}
		});

		$.ajax({
			url: "ajax.php?modulo=Empleados&controlador=Empleados&funcion=LlenarPantalla",
			data: "emp_id=" + cedula,
			type: "post",
			success: function (pantalla) {
				$('#tbodypantallas').html(pantalla);
			}
		});

	});



	$(document).on("click", ".filaE", function () {

		var llenarE = $(this).find("#llenarE").html();
		var url = $("#reslistarEmpleado").attr("data-url");
		//alert(url);

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarE=" + llenarE,
			success: function (res) {

				var resultados = JSON.parse(res);

				//$("#cedula_emple").val(resultados['Cedula_Empleado']);
				if (resultados['Cedula_Empleado'] != null) {
					$("#cedula_emple").val(resultados['Cedula_Empleado']);
					$("#cod_emple").val(resultados['Codigo']);
					$("#cedula_retiro").val(resultados['Cedula_Empleado']);
					$("#nom_emple").val(resultados['Nombres']);
					$("#apell_emple").val(resultados['Apellidos']);

					$("#cod_emple").val(resultados['Codigo']);
					$("#dir_emple").val(resultados['Direccion']);
					$("#tel1").val(resultados['tel1']);
					$("#tel2").val(resultados['tel2']);
					$("#mail_emple").val(resultados['email']);
					$("#fnacimiento").val(resultados['fnacimiento']);
					$("#lugarn").val(resultados['lugarn']);

					$("#ciudad").val(resultados['ciudadreside']);
					$("#salario_emple").val(resultados['salario']);
					$("#cargo_emple").val(resultados['cargo']);
					$("#centroCosto").val(resultados['costos']);
					$("#nit_sede").val(resultados['nit_sede']);

					$("#psig").val(resultados['sig']);
					$("#fingreso").val(resultados['fingreso']);
					$("#tvincula").html("<option value='" + resultados['vinculacion'] + "'>" + resultados['vinculacion'] + "</option>");
					//$("#firma").val(resultados['firma']);

					if (resultados['firma'] === "S") {
						$("#firma").prop('checked', true);
					} else {
						$("#firma").prop('checked', false);

					}


					$("#myModalBuscar").hide();
					$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
					$('.modal-backdrop').remove(); //eliminamos el backdrop del modal
					$('#detalleEmpl').show();
				}
			}
		});

		$.ajax({
			url: "ajax.php?modulo=Empleados&controlador=Empleados&funcion=LlenarDetalleEmpleado",
			data: "emp_id=" + llenarE,
			type: "post",
			success: function (detalles) {
				$('#detalleEmpl').html(detalles);
			}
		});


		$.ajax({
			url: "ajax.php?modulo=Empleados&controlador=Empleados&funcion=LlenarPantalla",
			data: "emp_id=" + llenarE,
			type: "post",
			success: function (pantalla) {
				$('#tbodypantallas').html(pantalla);
			}
		});
	});

	//});

	/***************ELIMINAR EMPLEADOS*******************/
	$(document).on("click", "#EliminarEmple", function () {
		var cedula = $('#cedula_emple').val();
		var url = $(this).attr("data-url");
		var urlcompleta = url + "&cedula=" + cedula;

		$('#EliminarEmple').attr("href", urlcompleta);
	});
	/*********************MODAL RETIRO EMPLEADOs*************************/
	$(document).on("click", "#RetiroEmple", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#modalRetiroEmpleado .modal-body").html(res);
			// $("#cedula_emple").val();
			$("#modalRetiroEmpleado").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});

	/****MODAL SALARIO EMPLEADO**/
	$(document).on("click", "#NuevoSalaEmple", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#modalAumentoSalario .modal-body").html(res);
			// $("#cedula_emple").val();
			$("#modalAumentoSalario").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});

	/****MODAL Historial Cargo**/
	$(document).on("click", "#HistCargo", function () {
		$.ajax({
			url: $(this).attr("data-url"),
		}).done((res) => {
			$("#modalHistorialCargos .modal-body").html(res);
			// $("#cedula_emple").val();
			$("#modalHistorialCargos").modal({
				backdrop: "static",
				keyboard: false
			});
		});
	});
	/**********************INFORME EMPLEADO************************/
	$(document).on("click", "#informeEmpleados", function (event) {

		$("#divEmpleado").hide();
		$("#divInforme").show();

		var tablaInformeEmpleados = $("#tablaInformeEmpleados").DataTable({
			language: {
				"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
			},
			bDestroy: true,
			responsive: true,
			ordering: false,
			pageLength: 10,
			autoWidth: false,
			lengthChange: false,
			columnDefs: [{
				"className": "text-center",
				"targets": "_all"
			}],
			drawCallback: () => {
				tablaInformeEmpleados.columns.adjust();
			},
		});
	});

	$(document).on("click", "#btnActivos, #btnInactivos, #btnTodos, #btnCerrar", function (event) {

		if ($(this).attr("id") == "btnCerrar") {
			$("#divEmpleado").show();
			$("#divInforme").hide();
			$("#tablaInformeEmpleados").DataTable().clear().draw();
		} else {
			$("#tablaInformeEmpleados").DataTable({
				language: {
					"url": "../../vendor/sb-admin-2/lib/datatables/language/datatablesSpanish.json"
				},
				destroy: true,
				ordering: false,
				pageLength: 10,
				autoWidth: false,
				lengthChange: false,
				columnDefs: [{
					"className": "text-center",
					"targets": "_all"
				}],
				ajax: {
					url: $(this).attr("data-url"),
					method: "post",
					data: {
						"estado": $(this).val(),
					},
				},
				columns: [{
						data: "codigo"
					},
					{
						data: "cedula"
					},
					{
						data: "nombres"
					},
					{
						data: "apellidos"
					},
					{
						data: "ingreso"
					},
					{
						data: "cargo"
					},
					{
						data: "centro_costo"
					},
					{
						data: "fecha_aumento"
					},
					{
						data: "salario"
					},
					{
						data: "salario_anterior"
					},
					{
						data: "fecha_nacimiento"
					},
					{
						data: "direccion"
					},
					{
						data: "telefono1"
					},
					{
						data: "telefono2"
					},
					{
						data: "email"
					},
					{
						data: "ciudad_residencia"
					},
					{
						data: "lugar_nacimiento"
					}
				],
			});
		}
	});
	// $(document).on("click", ".btn_ConsultaEmp", function () {
	// 	var url = $(this).attr('data-url');
	// 	var estados = $(this).attr('data-dato');

	// 	$("#divInforme").css({
	// 		"overflow": "auto",
	// 		"height": "400px"
	// 	});

	// 	$.ajax({
	// 		url: url,
	// 		data: "estados=" + estados,
	// 		type: "GET",
	// 		success: function (respuesta) {

	// 			$("#resInforme").html(respuesta);
	// 			var cant = $('#cantEmpleado').val();
	// 			var estados = $('#estados').val();

	// 			$('#totales').val(cant);
	// 			$('#nom').val(estados);
	// 		}
	// 	});
	// });

	/*******************************listar cargos segun empleado************************************/
	$(document).on("click", "#HistCargo", function () {
		var url = $(this).attr("data-VerListurl");
		var vIngresadonom = "";
		var nit = $('#nit_cliente').val();
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadonom=" + vIngresadonom + "&nit=" + nit,
			success: function (respuesta) {
				$("#lisPlanta").html(respuesta);
			}
		});
	});

	/*--------------------------MARCAS---------------------------*/

	/************************Modal LISTAR MARCAS******************************/
	$(document).on("click", "#ListarMarca", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisMarcas").html(respuesta);
			}
		});

	});
	/*******************************listar registro Marcas************************************/
	$(document).on("click", "#ListarMarca", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaMarcas").html(respuesta);
			}

		});

	});
	/*********Consulta Marcas**************/
	$(document).on("keyup", ".busMarca", function () {

		var vIngresadodesc = $('#descripcion').val();
		var url = $(".busMarca").attr("data-url");
		//alert(url);
		// $("#buscarEmpleado").css({"overflow":"auto","height":"400px"});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaMarcas').html(respuesta);
			}
		});
	});

	/*********Consulta llenar Marcas**************/
	$(document).on("click", ".filaMarcas", function () {

		var llenarMarcas = $(this).find("#llenarM").html();
		var url = $("#respuestaMarcas").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarMarcas=" + llenarMarcas,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo_Marca']);
				$("#marca").val(resultados['Descripcion']);
				$("#grupo").val(resultados['Tipo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR MARCA*****************************/
	$(document).on("click", "#elimiMarca", function () {

		if (confirm('Esta seguro de Eliminar la Marca')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiMarca').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Marcas&controlador=Marcas&funcion=crearMarcas';
			return false;
		}
	});
	/*--------------------------TIPO DE EQUIPOS---------------------------*/

	/************************Modal LISTAR TIPO DE EQUIPOS******************************/
	$(document).on("click", "#ListarEquipos", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#listarTEquipos").html(respuesta);
			}
		});

	});
	/*******************************listar registro TIPO DE EQUIPOS************************************/
	$(document).on("click", "#ListarEquipos", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaEquipos").html(respuesta);
			}

		});

	});
	/*********Consulta Tipo Equipos**************/
	$(document).on("keyup", ".desEqui", function () {

		//alert('ghfishg');
		var vIngresadodesc = $('#desEqui').val();
		var url = $(".desEqui").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaEquipos').html(respuesta);
			}
		});
	});
	/*********Consulta llenar TIPO DE EQUIPOS**************/
	$(document).on("click", ".filaEquipos", function () {

		var llenarEquipos = $(this).find("#llenarTE").html();
		var url = $("#respuestaEquipos").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarEquipos=" + llenarEquipos,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo_Tipo_Equipo']);
				$("#descripcion").val(resultados['Descripcion']);
				$("#grupo").val(resultados['Codigo_Grupo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR TIPO DE EQUIPOS*****************************/
	$(document).on("click", "#elimiTipoEquipo", function () {

		if (confirm('??Estas seguro Eliminar?')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiTipoEquipo').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=TipoEquipos&controlador=TipoEquipos&funcion=crearTipoEquipos';
			return false;
		}
	});

	/*--------------------------UNIDAD DE NEGOCIO---------------------------*/

	/************************Modal LISTAR UNIDAD DE NEGOCIO******************************/
	$(document).on("click", "#ListarUnidadN", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#listarUN").html(respuesta);
			}
		});

	});
	/*******************************listar registro UNIDAD DE NEGOCIO************************************/
	$(document).on("click", "#ListarUnidadN", function () {

		var url = $(this).attr("data-VerListurl");
		//var urlBus = $(".busUni").attr("data-url");
		var vIngresaestado = $('#estadoBus').val();
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresaestado=" + vIngresaestado + "&vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaUnidad").html(respuesta);
			}

		});


	});

	$(document).on("click", "#estadoBus", function () {

		var url = $(this).attr("data-url");
		var vIngresaestado = $(this).val();
		var vIngresadodesc = "";

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresaestado=" + vIngresaestado + "&vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaUnidad").html(respuesta);
			}

		});


	});
	/*********Consulta Unidad Medida**************/
	$(document).on("keyup", ".desUni", function () {

		//alert('ghfishg');
		var vIngresadodesc = $('#desUni').val();
		var url = $(".desUni").attr("data-url");
		var vIngresaestado = $('#estadoBus').val();

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresaestado=" + vIngresaestado + "&vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaUnidad').html(respuesta);
			}
		});
	});

	/*********Consulta llenar UNIDAD DE NEGOCIO**************/
	$(document).on("click", ".filaUN", function () {

		var llenarUnidades = $(this).find("#llenarUN").html();
		var url = $("#respuestaUnidad").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarUnidades=" + llenarUnidades,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo']);
				$("#descripcion").val(resultados['Descripcion']);
				$("#cif").val(resultados['Porcentaje_Inductor_Costo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR UNIDAD DE NEGOCIO*****************************/
	$(document).on("click", "#elimiUnidadNegocio", function () {

		if (confirm('Esta seguro de Eliminar la Unidad de Negocio')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiUnidadNegocio').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=UnidadNegocio&controlador=UnidadNegocio&funcion=crearUnidadNegocio';
			return false;
		}
	});
	/*--------------------------ACTIVIDADES---------------------------*/

	/************************Modal LISTAR ACTIVIDADES*****************************/
	$(document).on("click", "#ListarActividades", function () {

		var url = $(this).attr('data-url');
		var data_url = $(this).attr("data-VerListurl");
		var vIngresadocodigo = $('.codigo').val();
		var vIngresadodesc = $('.descripcion').val();
		var vIngresadoestado = $('#estado').val();

		$.ajax({
			url: url,
			type: "post",
			data: "",
			success: function (respuesta) {
				$("#lisActividades").html(respuesta);
			}
		});

		$.ajax({
			url: data_url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$("#respuestaActividad").html(respuesta);
			}

		});

	});

	/*********Consulta ACTIVIDADES**************/
	$(document).on("keyup", ".busAct", function () {

		var vIngresadocodigo = $('.codigo').val();
		var vIngresadodesc = $('.descripcion').val();
		var vIngresadoestado = $('#estado').val();
		var url = $(".busAct").attr("data-url");
		//alert(url);
		$("#buscarEmpleado").css({
			"overflow": "auto",
			"height": "400px"
		});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$(respuestaActividad).html(respuesta);
			}
		});
	});
	/*********Consulta llenar ACTIVIDADES**************/
	$(document).on("click", ".filaAct", function () {

		var llenarActividades = $(this).find("#llenarAct").html();
		var url = $("#respuestaActividad").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarActividades=" + llenarActividades,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo']);
				$("#descripcion").val(resultados['Descripcion']);
				$("#iva").val(resultados['Porcentaje_Iva']);
				$("#unidad").val(resultados['Unidad_Medida']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR ACTIVIDADES*****************************/
	$(document).on("click", "#elimiActividades", function () {

		if (confirm('??Estas seguro Eliminar?')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiActividades').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Actividades&controlador=Actividades&funcion=crearActividades';
			return false;
		}
	});

	/*--------------------------LINEAS---------------------------*/

	/************************Modal LISTAR LINEAS******************************/
	$(document).on("click", "#ListarLineas", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisLineas").html(respuesta);
			}
		});

	});

	/************************Modal LISTAR ACTIVIDADES LINEA*****************************/
	$(document).on("click", "#ListarLineas", function () {

		var url = $(this).attr('data-url');
		var data_url = $(this).attr("data-VerListurl");
		var vIngresadocodigo = $('#codigo').val();
		var vIngresadodesc = $('#desc').val();
		var vIngresadoestado = $('#estado').val();

		$.ajax({
			url: url,
			type: "post",
			data: "",
			success: function (respuesta) {
				$("#lisLineas").html(respuesta);
			}
		});

		$.ajax({
			url: data_url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$("#respuestaLineas").html(respuesta);
			}

		});

	});

	/*********Consulta   LINEA**************/
	$(document).on("keyup", ".busLinea", function () {

		var vIngresadocodigo = $('#codigolinea').val();
		var vIngresadodesc = $('#desclinea').val();
		var vIngresadoestado = $('#estlinea').val();
		var url = $(".busLinea").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$('#respuestaLineas').html(respuesta);
			}
		});
	});



	/*********Consulta llenar LINEAS**************/
	$(document).on("click", ".filaLineas", function () {

		var llenarLineas = $(this).find("#llenarM").html();
		var url = $("#respuestaLineas").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarLineas=" + llenarLineas,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo_Linea']);
				$("#desc").val(resultados['Descripcion']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR LINEAS*****************************/
	$(document).on("click", "#elimiLineas", function () {

		if (confirm('?? Estas seguro Eliminar ?')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiLineas').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Lineas&controlador=Lineas&funcion=crearLineas';
			return false;
		}
	});

	/*--------------------------GRUPOS---------------------------*/

	/************************Modal LISTAR GRUPOS******************************/
	$(document).on("click", "#ListarGrupos", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisGrupos").html(respuesta);
			}
		});

	});

	/************************Modal LISTAR GRUPOS*****************************/
	$(document).on("click", "#ListarGrupos", function () {

		var url = $(this).attr('data-url');
		var data_url = $(this).attr("data-VerListurl");
		var vIngresadocodigo = $('.codigo').val();
		var vIngresadodesc = $('.desc').val();
		var vIngresadoestado = $('#estado').val();

		$.ajax({
			url: url,
			type: "post",
			data: "",
			success: function (respuesta) {
				$("#lisGrupos").html(respuesta);
			}
		});

		$.ajax({
			url: data_url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$("#respuestaGrupos").html(respuesta);
			}

		});

	});

	/*********Consulta GRUPOS**************/
	$(document).on("keyup", ".busGrupo", function () {

		var vIngresadocodigo = $('.codigo').val();
		var vIngresadodesc = $('.desc').val();
		var vIngresadoestado = $('#estado').val();
		var url = $(".busGrupo").attr("data-url");
		//alert(url);

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$(respuestaGrupos).html(respuesta);
			}
		});
	});


	/*********Consulta llenar GRUPOS**************/
	$(document).on("click", ".filaGrupos", function () {

		var llenarGrupo = $(this).find("#llenarM").html();
		var url = $("#respuestaGrupos").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarGrupo=" + llenarGrupo,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo_Grupo']);
				$("#desc").val(resultados['Nombre_Grupo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR GRUPOS*****************************/
	$(document).on("click", "#elimiGrupos", function () {

		if (confirm('�0�9�� Estas seguro Eliminar ?')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiLineas').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Grupos&controlador=Grupos&funcion=crearGrupos';
			return false;
		}
	});



	/*************************************ENTRADA BODEGA****************************************************/
	/*************************CAJAS REPETITIVAS DETALLE***********************/
	var filaEB = 0;

	$(document).on("click", "#btn_agregarFilaEB", function () {


		filaEB = $('#cta_campos').val();
		filaEB++;
		var nueva_fila = "<tr class='tr_EB' data-fila='" + filaEB + "'>";
		nueva_fila += "<td width='40%'><input type='hidden' name='producto_id[]' id='producto_id" + filaEB + "'><input type='hidden' name='un[]' id='un" + filaEB + "'><input type='hidden' name='iva[]' id='iva" + filaEB + "'>";
		nueva_fila += "<input type='text' name='producto[]' id='producto" + filaEB + "' class='form-control listproducto_EB' data-fila='" + filaEB + "' data-url='ajax.php?modulo=EntradaBodega&controlador=EntradaBodega&funcion=BuscarProductoServicio' </td>";
		nueva_fila += "<td width='15%'><input type='number' name='cant[]' id='cant" + filaEB + "' class='form-control calcula_subtotalEB'/></td>";
		nueva_fila += "<td width='15%'><input type='number' name='valor[]' id='valor" + filaEB + "' data-fila='" + filaEB + "' class='form-control calcula_subtotalEB'/></td>";
		nueva_fila += "<td width='15%'><input type='number' name='subtotal_pro[]' id='subtotal_pro" + filaEB + "' data-fila='" + filaEB + "' class='form-control'/></td>";
		nueva_fila += "<td align='center'><button type='button' name='btn_eliminarEB' id='btn_eliminarEB' class='btn btn-danger eliminar' title='Eliminar fila' ><i class='far fa-trash-alt'></i></button></td>";
		nueva_fila += "</tr>";
		$("#Detalle_EB").append(nueva_fila);


		$('#cta_campos').val(filaEB);
	});

	/******************calcular subtotal*******************/
	$(document).on("blur", ".calcula_subtotalEB", function () {
		var fila = $(this).attr('data-fila');
		var valor = $('#valor' + fila).val();
		var cant = $('#cant' + fila).val();
		var porc_iva = $('#iva' + fila).val();

		var subtotal = valor * cant;

		if (porc_iva > 0) {
			iva_pro = subtotal * (porc_iva / 100);
		} else {
			iva_pro = 0;
		}

		$('#subtotal_pro' + fila).val(subtotal);


		var tot = 0;
		var numreg = $('#cta_campos').val();
		var ivaT = 0;
		var sub = 0;

		for (i = 0; i <= numreg; i = i + 1) {
			subtotaluno = $('#valor' + i).val() * $('#cant' + i).val();
			ivauno = subtotaluno * ($('#iva' + i).val() / 100);
			sub = sub + subtotaluno;
			ivaT = ivaT + ivauno;
		}

		tot = sub + ivaT;
		$('#subtotal').val(sub);
		$('#tiva').val(ivaT);
		$('#tdoc').val(tot);

	});

	$(document).on("click", ".eliminar", function () {
		$(this).closest("tr").remove();
	});
	/******************AJAX PRODUCTOS *********************/
	$(document).on("keyup", ".listproducto_EB", function () {
		var servicio = $(this).val();
		var url = $(this).attr('data-url');
		var data_fila = $(this).attr('data-fila');

		$.ajax({
			url: url,
			data: "desc_serv=" + servicio + "&data_fila=" + data_fila,
			type: "POST",
			success: function (dato) {
				$('#resulProductos').show();
				$('#resulProductos').html(dato);
				$("#resulProductos").css({
					"overflow": "auto",
					"height": "100px"
				});
			}
		});


	});
	/**************************PASAR DATOS AJAX****************************/
	$(document).on("click", ".listPro_EB", function () {
		var dato = $(this).attr('data-id');
		var descProServ = $(this).attr('data-desc');
		var grupos = $(this).attr('data-grupo');
		var marcas = $(this).attr('data-marca');
		var unidades = $(this).attr('data-um');
		var ultcostos = $(this).attr('data-ultimo');
		var destino = $(this).attr('data-destino');
		var un = $(this).attr('data-un');
		var iva = $(this).attr('data-iva');

		$('#producto_id' + destino).val(dato);
		$('#producto' + destino).val(descProServ);
		$('#un' + destino).val(un);
		$('#iva' + destino).val(iva);
		$('#grupo').val(grupos);
		$('#marca').val(marcas);
		$('#unidad').val(unidades);
		$('#ultcosto').val(ultcostos);
		$('#resulProductos').hide();
	});

	/*****************************productos********************************/
	/****************PASAR DATOS PROVEEDOR*************************/
	$(document).on("change", "#proveedor", function () {

		var proveedor = $("#proveedor").val();
		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			data: "proveedor=" + proveedor,
			type: "POST",
			success: function (dato) {
				var datos_proveedor = JSON.parse(dato);

				$('#dir').val(datos_proveedor[1]);
				$('#nit').val(datos_proveedor[0]);
				$('#tel').val(datos_proveedor[2]);
				$('#ciudad').val(datos_proveedor[3]);


			}
		});
	});
	/************************Modal LISTAR PROVEEDOR******************************/
	$(document).on("click", "#ListarProductos", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisProductos").html(respuesta);
			}
		});

	});

	/************************Modal LISTAR Productos *****************************/
	$(document).on("click", "#ListarProductos", function () {

		var url = $(this).attr('data-url');
		var data_url = $(this).attr("data-VerListurl");
		var vIngresadocodigo = $('#codigo').val();
		var vIngresadodesc = $('#desc').val();
		var vIngresadoestado = $('#estado').val();

		$.ajax({
			url: url,
			type: "post",
			data: "",
			success: function (respuesta) {
				$("#lisProductos").html(respuesta);
			}
		});

		$.ajax({
			url: data_url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$("#respuestaProductos").html(respuesta);
			}

		});

	});

	/*********Consulta Productos**************/
	$(document).on("keyup", ".busPro", function () {

		var vIngresadocodigo = $('.codigo').val();
		var vIngresadodesc = $('.desc').val();
		var vIngresadoestado = $('#estado').val();
		var url = $(".busPro").attr("data-url");
		//alert(vIngresadoestado);

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadocodigo=" + vIngresadocodigo + "&vIngresadodesc=" + vIngresadodesc + "&vIngresadoestado=" + vIngresadoestado,
			success: function (respuesta) {
				$('#respuestaProductos').html(respuesta);
			}
		});
	});


	/*********Consulta llenar Productos**************/
	$(document).on("click", ".filaProductos", function () {
		//alert('dfdvd');
		var llenarProductos = $(this).find("#llenarP").html();
		var url = $("#respuestaProductos").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarProductos=" + llenarProductos,
			success: function (res) {
				var resultados = JSON.parse(res);
				//alert(resultados);

				$("#codigo").val(resultados['Codigo']);
				$("#desc").val(resultados['Descripcion']);
				$("#grupo").val(resultados['grupo']);
				$("#linea").val(resultados['linea']);
				$("#marca").val(resultados['marca']);
				$("#unidad").val(resultados['unidad']);
				$("#bodega").val(resultados['Ubicacion_Bodega']);
				$("#equivalencia").val(resultados['Equivalencia']);
				$("#UltCosto").val(resultados['Ultimo_Costos']);
				$("#comision").val(resultados['Porcentaje_Comision']);
				$("#iva").val(resultados['Porcentaje_Iva']);
				$("#venta1").val(resultados['Precio_Venta1']);
				$("#venta2").val(resultados['Precio_Venta2']);
				$("#venta3").val(resultados['Precio_Venta3']);
				$("#venta4").val(resultados['Precio_Venta4']);
				$("#minimo").val(resultados['Stock_Minimo']);
				$("#maximo").val(resultados['Stock_Maximo']);
				$("#costo").val(resultados['Costo_Fob']);
				$("#venta").val(resultados['Venta_Fob']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR Productos*****************************/
	$(document).on("click", "#elimiProductos", function () {

		if (confirm('�0�9�� Estas seguro Eliminar ?')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiProductos').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Productos&controlador=Productos&funcion=crearProductos';
			return false;
		}
	});

	/*--------------------------MARCAS PRODUCTOS---------------------------*/

	/************************Modal LISTAR MARCAS PRODUCTOS******************************/
	$(document).on("click", "#ListarMarcaProductos", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisMarcasProductos").html(respuesta);
			}
		});

	});
	/*******************************listar registro MARCAS PRODUCTOS************************************/
	$(document).on("click", "#ListarMarcaProductos", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#resMarcasProduc").html(respuesta);
			}

		});

	});
	/*********Consulta MARCAS PRODUCTOS**************/
	$(document).on("keyup", ".busMarPro", function () {

		var vIngresadodesc = $('#descripcion').val();
		var url = $(".busMarPro").attr("data-url");
		//alert(url);
		// $("#buscarEmpleado").css({"overflow":"auto","height":"400px"});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#resMarcasProduc').html(respuesta);
			}
		});
	});

	/*********Consulta llenar MARCAS PRODUCTOS**************/
	$(document).on("click", ".filaMarP", function () {

		var llenarMarcasP = $(this).find("#llenarMaP").html();
		var url = $("#resMarcasProduc").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarMarcasP=" + llenarMarcasP,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo']);
				$("#desc").val(resultados['Descripcion']);
				// $("#grupo").val(resultados['Tipo']);								

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();

			}
		});
	});
	/******************************ELIMINAR MARCAS PRODUCTOS*****************************/
	$(document).on("click", "#elimiMarcaPro", function () {

		if (confirm('Esta seguro de Eliminar la Marca')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiMarcaPro').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=MarcasProductos&controlador=MarcasProductos&funcion=crearMarcasProductos';
			return false;
		}
	});

	/*--------------------------ESTADOS CIVILES---------------------------*/

	/************************Modal LISTAR ESTADOS CIVILES*****************************/
	$(document).on("click", "#ListarEstadosCiviles", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisEstadosCiviles").html(respuesta);
			}
		});

	});
	/*******************************listar registro ESTADOS CIVILES***********************************/
	$(document).on("click", "#ListarEstadosCiviles", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaEstadosCiviles").html(respuesta);
			}

		});

	});
	/*********Consulta ESTADOS CIVILES**************/
	$(document).on("keyup", ".busEstCivil", function () {

		var vIngresadodesc = $('#descripcion').val();
		var url = $(".busEstCivil").attr("data-url");
		//alert(url);
		// $("#buscarEmpleado").css({"overflow":"auto","height":"400px"});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaEstadosCiviles').html(respuesta);
			}
		});
	});

	/*********Consulta llenar ESTADOS CIVILES**************/
	$(document).on("click", ".filaEstCivil", function () {

		var llenarEstCivil = $(this).find("#llenarEstCi").html();
		var url = $("#respuestaEstadosCiviles").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarEstCivil=" + llenarEstCivil,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo']);
				$("#desc").val(resultados['Descripcion']);
				// $("#grupo").val(resultados['Tipo']);								

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR ESTADOS CIVILES*****************************/
	$(document).on("click", "#elimiEstCivil", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiEstCivil').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=EstadosCiviles&controlador=EstadosCiviles&funcion=crearEstadosCiviles';
			return false;
		}
	});

	/*--------------------------VIVIENDAS---------------------------*/

	/************************Modal LISTAR VIVIENDAS*****************************/
	$(document).on("click", "#ListarViviendas", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisViviendas").html(respuesta);
			}
		});

	});
	/*******************************listar registro VIVIENDAS**********************************/
	$(document).on("click", "#ListarViviendas", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaViviendas").html(respuesta);
			}

		});

	});
	/*********Consulta VIVIENDAS**************/
	$(document).on("keyup", ".busVivienda", function () {

		var vIngresadodesc = $('#descripcion').val();
		var url = $(".busVivienda").attr("data-url");
		//alert(url);
		// $("#buscarEmpleado").css({"overflow":"auto","height":"400px"});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaViviendas').html(respuesta);
			}
		});
	});

	/*********Consulta llenar VIVIENDAS**************/
	$(document).on("click", ".filaViviendas", function () {

		var llenarViviendas = $(this).find("#llenarViviendas").html();
		var url = $("#respuestaViviendas").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarViviendas=" + llenarViviendas,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo']);
				$("#desc").val(resultados['Descripcion']);
				// $("#grupo").val(resultados['Tipo']);								

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR VIVIENDAS*****************************/
	$(document).on("click", "#elimiVivienda", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiVivienda').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Viviendas&controlador=Viviendas&funcion=crearViviendas';
			return false;
		}
	});

	/*--------------------------PROFESIONES---------------------------*/

	/************************Modal LISTAR PROFESIONES*****************************/
	$(document).on("click", "#ListarProfesiones", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisProfesiones").html(respuesta);
			}
		});

	});
	/*******************************listar registro PROFESIONES**********************************/
	$(document).on("click", "#ListarProfesiones", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaProfesiones").html(respuesta);
			}

		});

	});
	/*********Consulta PROFESIONES**************/
	$(document).on("keyup", ".busProfesiones", function () {

		var vIngresadodesc = $('#descripcion').val();
		var url = $(".busProfesiones").attr("data-url");
		//alert(url);
		// $("#buscarEmpleado").css({"overflow":"auto","height":"400px"});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaProfesiones').html(respuesta);
			}
		});
	});

	/*********Consulta llenar PROFESIONES**************/
	$(document).on("click", ".filaProfe", function () {

		var llenarProfesiones = $(this).find("#llenarProfe").html();
		var url = $("#respuestaProfesiones").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarProfesiones=" + llenarProfesiones,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo']);
				$("#desc").val(resultados['Descripcion']);
				// $("#grupo").val(resultados['Tipo']);								

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR PROFESIONES*****************************/
	$(document).on("click", "#elimiProfesiones", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;

			$('#elimiProfesiones').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Viviendas&controlador=Viviendas&funcion=crearViviendas';
			return false;
		}
	});
	/*--------------------------CARGO---------------------------*/

	/************************Modal LISTAR CARGO*****************************/
	$(document).on("click", "#ListarCargos", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisCargos").html(respuesta);
			}
		});

	});
	/*******************************listar registro CARGO**********************************/
	$(document).on("click", "#ListarCargos", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaCargos").html(respuesta);
			}

		});

	});
	/*********Consulta CARGO**************/
	$(document).on("keyup", ".busCargos", function () {

		var vIngresadodesc = $('#descripcion').val();
		var url = $(".busCargos").attr("data-url");
		//alert(url);
		// $("#buscarEmpleado").css({"overflow":"auto","height":"400px"});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaCargos').html(respuesta);
			}
		});
	});

	/*********Consulta llenar CARGO**************/
	$(document).on("click", ".filaCargos", function () {

		var llenarCargos = $(this).find("#llenarCargo").html();
		var url = $("#respuestaCargos").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarCargos=" + llenarCargos,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['CodigoCargo']);
				$("#desc").val(resultados['Descripcion']);
				// $("#grupo").val(resultados['Tipo']);								

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR CARGO*****************************/
	$(document).on("click", "#elimiCargos", function () {

		if (confirm('Esta seguro de Eliminar ')) {

			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;



			$('#elimiCargos').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Cargos&controlador=Cargos&funcion=crearCargos';
			return false;
		}
	});



	/*--------------------------TipoSeguridad---------------------------*/

	/************************Modal LISTAR TipoSeguridad*****************************/
	$(document).on("click", "#ListarTipoSeg", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisTipoSeg").html(respuesta);
			}
		});

	});
	/*******************************listar registro TipoSeguridad**********************************/
	$(document).on("click", "#ListarTipoSeg", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";
		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaTipoSeg").html(respuesta);
			}

		});

	});
	/*********Consulta TipoSeguridad**************/
	$(document).on("keyup", ".busTipoSeg", function () {

		var vIngresadodesc = $('#descripcion').val();
		var url = $(".busTipoSeg").attr("data-url");
		//alert(url);
		// $("#buscarEmpleado").css({"overflow":"auto","height":"400px"});

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaTipoSeg').html(respuesta);
			}
		});
	});

	/*********Consulta llenar TipoSeguridad**************/
	$(document).on("click", ".filaTipoSeg", function () {

		var llenarTipoSeg = $(this).find("#llenarTipoSeg").html();
		var url = $("#respuestaTipoSeg").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarTipoSeg=" + llenarTipoSeg,
			success: function (res) {
				var resultados = JSON.parse(res);
				$("#codigo").val(resultados['Codigo']);
				$("#desc").val(resultados['Descripcion']);
				// $("#grupo").val(resultados['Tipo']);								

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR TipoSeguridad*****************************/
	$(document).on("click", "#elimiTipoSeg", function () {

		if (confirm('Esta seguro de Eliminar ')) {

			var cod = $('#codigo').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&cod=" + cod;



			$('#elimiTipoSeg').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=TipoSeg&controlador=TipoSeg&funcion=crearTipoSeg';
			return false;
		}
	});


	/*--------------------------EPS---------------------------*/

	/************************Modal LISTAR EPS*****************************/
	$(document).on("click", "#ListarEps", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisEps").html(respuesta);
			}
		});

	});
	/*******************************listar registro EPS**********************************/
	$(document).on("click", "#ListarEps", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaEps").html(respuesta);
			}
		});
	});
	/*********Consulta EPS**************/
	$(document).on("keyup", ".busEps", function () {

		var vIngresadodesc = $('#descripcion').val();

		var url = $(".busEps").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaEps').html(respuesta);
			}
		});
	});

	/*********Consulta llenar EPS**************/
	$(document).on("click", ".filaEps", function () {

		var llenarEps = $(this).find("#llenarEps").html();
		var url = $("#respuestaEps").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarEps=" + llenarEps,
			success: function (res) {

				var resultados = JSON.parse(res);
				$("#nit").val(resultados['Nit']);
				$("#nombre").val(resultados['Nombre']);
				$("#tipo").val(resultados['Tipo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR EPS*****************************/
	$(document).on("click", "#elimiEps", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var nit = $('#nit').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&nit=" + nit;

			$('#elimiEps').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Eps&controlador=Eps&funcion=crearEps';
			return false;
		}
	});

	/*******************************LLENAR FORMULARIO SI EXITE EPS******************************/

	$(document).on("blur", "#nit", function () {

		var nit = $(this).val();
		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarEps=" + nit,
			success: function (res) {
				var resultados = JSON.parse(res);

				if (resultados['Nit'] != null) {
					$("#nit").val(resultados['Nit']);
					$("#nombre").val(resultados['Nombre']);
					$("#tipo").val(resultados['Tipo']);
				}

			}
		});

	});
	/*--------------------------ARL---------------------------*/

	/************************Modal LISTAR ARL*****************************/
	$(document).on("click", "#ListarArl", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisArl").html(respuesta);
			}
		});

	});
	/*******************************listar registro ARL**********************************/
	$(document).on("click", "#ListarArl", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaArl").html(respuesta);
			}
		});
	});
	/*********Consulta ARL**************/
	$(document).on("keyup", ".busArl", function () {

		var vIngresadodesc = $('#descripcion').val();

		var url = $(".busArl").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaArl').html(respuesta);
			}
		});
	});

	/*********Consulta llenar ARL**************/
	$(document).on("click", ".filaArl", function () {

		var llenarArl = $(this).find("#llenarArl").html();
		var url = $("#respuestaArl").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarArl=" + llenarArl,
			success: function (res) {

				var resultados = JSON.parse(res);
				$("#nit").val(resultados['Nit']);
				$("#nombre").val(resultados['Nombre']);
				$("#tipo").val(resultados['Tipo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR ARL*****************************/
	$(document).on("click", "#elimiArl", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var nit = $('#nit').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&nit=" + nit;

			$('#elimiArl').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Arl&controlador=Arl&funcion=crearArl';
			return false;
		}
	});

	/*******************************LLENAR FORMULARIO SI EXITE ARL******************************/

	$(document).on("blur", "#nit", function () {

		var nit = $(this).val();
		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarArl=" + nit,
			success: function (res) {
				var resultados = JSON.parse(res);

				if (resultados['Nit'] != null) {
					$("#nit").val(resultados['Nit']);
					$("#nombre").val(resultados['Nombre']);
					$("#tipo").val(resultados['Tipo']);
				}

			}
		});

	});


	/*--------------------------CC---------------------------*/

	/************************Modal LISTAR cc*****************************/
	$(document).on("click", "#ListarCc", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisCc").html(respuesta);
			}
		});

	});
	/*******************************listar registro cc**********************************/
	$(document).on("click", "#ListarCc", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaCc").html(respuesta);
			}
		});
	});
	/*********Consulta CC**************/
	$(document).on("keyup", ".busCc", function () {

		var vIngresadodesc = $('#descripcion').val();

		var url = $(".busCc").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaCc').html(respuesta);
			}
		});
	});

	/*********Consulta llenar CC**************/
	$(document).on("click", ".filaCc", function () {

		var llenarCc = $(this).find('#llenarCc').html();
		var url = $("#respuestaCc").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarCc=" + llenarCc,
			success: function (res) {

				var resultados = JSON.parse(res);
				$("#nit").val(resultados['Nit']);
				$("#nombre").val(resultados['Nombre']);
				$("#tipo").val(resultados['Tipo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR CC*****************************/
	$(document).on("click", "#elimiCc", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var nit = $('#nit').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&nit=" + nit;

			$('#elimiCc').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Cc&controlador=Cc&funcion=crearCc';
			return false;
		}
	});

	/*******************************LLENAR FORMULARIO SI EXITE CC******************************/

	$(document).on("blur", "#nit", function () {

		var nit = $(this).val();
		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarCc=" + nit,
			success: function (res) {
				var resultados = JSON.parse(res);

				if (resultados['Nit'] != null) {
					$("#nit").val(resultados['Nit']);
					$("#nombre").val(resultados['Nombre']);
					$("#tipo").val(resultados['Tipo']);
				}

			}
		});

	});
	/*--------------------------FP---------------------------*/

	/************************Modal LISTAR FP*****************************/
	$(document).on("click", "#ListarFp", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisFp").html(respuesta);
			}
		});

	});
	/*******************************listar registro FP**********************************/
	$(document).on("click", "#ListarFp", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaFp").html(respuesta);
			}
		});
	});
	/*********Consulta FP**************/
	$(document).on("keyup", ".busFp", function () {

		var vIngresadodesc = $('#descripcion').val();

		var url = $(".busFp").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaFp').html(respuesta);
			}
		});
	});

	/*********Consulta llenar FP**************/
	$(document).on("click", ".filaFp", function () {

		var llenarFp = $(this).find('#llenarFp').html();
		var url = $("#respuestaFp").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarFp=" + llenarFp,
			success: function (res) {

				var resultados = JSON.parse(res);
				$("#nit").val(resultados['Nit']);
				$("#nombre").val(resultados['Nombre']);
				$("#tipo").val(resultados['Tipo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR FP*****************************/
	$(document).on("click", "#elimifp", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var nit = $('#nit').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&nit=" + nit;

			$('#elimifp').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Fp&controlador=Fp&funcion=crearFp';
			return false;
		}
	});

	/****************************LLENAR FORMULARIO  FP*******************************/

	$(document).on("blur", "#nit", function () {

		var nit = $(this).val();
		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarFp=" + nit,
			success: function (res) {
				var resultados = JSON.parse(res);

				if (resultados['Nit'] != null) {
					$("#nit").val(resultados['Nit']);
					$("#nombre").val(resultados['Nombre']);
					$("#tipo").val(resultados['Tipo']);
				}

			}
		});

	});

	/*--------------------------FC---------------------------*/

	/************************Modal LISTAR FC*****************************/
	$(document).on("click", "#ListarFc", function () {

		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "post",
			success: function (respuesta) {
				$("#lisFc").html(respuesta);
			}
		});

	});
	/*******************************listar registro FC**********************************/
	$(document).on("click", "#ListarFc", function () {

		var url = $(this).attr("data-VerListurl");
		var vIngresadodesc = "";

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$("#respuestaFc").html(respuesta);
			}
		});
	});
	/*********Consulta FC**************/
	$(document).on("keyup", ".busFc", function () {

		var vIngresadodesc = $('#descripcion').val();

		var url = $(".busFc").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "vIngresadodesc=" + vIngresadodesc,
			success: function (respuesta) {
				$('#respuestaFc').html(respuesta);
			}
		});
	});

	/*********Consulta llenar FC**************/
	$(document).on("click", ".filaFc", function () {

		var llenarFc = $(this).find('#llenarFc').html();
		var url = $("#respuestaFc").attr("data-url");

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarFc=" + llenarFc,
			success: function (res) {

				var resultados = JSON.parse(res);
				$("#nit").val(resultados['Nit']);
				$("#nombre").val(resultados['Nombre']);
				$("#tipo").val(resultados['Tipo']);

				$("#myModalBuscar").hide();
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();
			}
		});
	});
	/******************************ELIMINAR FP*****************************/
	$(document).on("click", "#elimiFc", function () {

		if (confirm('Esta seguro de Eliminar ')) {
			var nit = $('#nit').val();
			var url = $(this).attr("data-url");
			var urlcompleta = url + "&nit=" + nit;

			$('#elimiFc').attr("href", urlcompleta);
		} else {
			window.location.href = 'index.php?modulo=Fc&controlador=Fc&funcion=crearFc';
			return false;
		}
	});

	/****************************LLENAR FORMULARIO  FC*******************************/

	$(document).on("blur", "#nit", function () {

		var nit = $(this).val();
		var url = $(this).attr('data-url');

		$.ajax({
			url: url,
			type: "GET",
			data: "llenarFc=" + nit,
			success: function (res) {
				var resultados = JSON.parse(res);

				if (resultados['Nit'] != null) {
					$("#nit").val(resultados['Nit']);
					$("#nombre").val(resultados['Nombre']);
					$("#tipo").val(resultados['Tipo']);
				}

			}
		});

	});

	/*************************PRELIQUIDACION*************************/


	/******************************LLENAR CLIENTE E INGRESO******************************/

	$(document).ready(function () {
		if ($("#nit_emp").val()) {
			$("#nit_emp").trigger("change");
		}
	});

	$(document).on("change", "#nit_empresa, #nit_emp", function () {
		var nit_cliente = $(this).val();
		var tipo_doc = $("#tipo_doc").val();
		var url = $(this).attr('data-url');
		var urlplanta = $(this).attr('data-urlplanta');
		var urlcontacto = $("#planta").attr('data-urlcontacto');
		var urlIngreso = $(this).attr('data-urlIngreso');

		$.ajax({
			url: urlIngreso,
			data: {
				nit_cliente: nit_cliente,
				tipo_doc: tipo_doc
			},
			type: "POST",
			dataType: "json",
			success: function (res) {
				$("#no_ingreso").html(res.selectIngresosCliente);
			}
		});

		$.ajax({
			url: urlcontacto,
			data: "nit_cliente=" + nit_cliente,
			dataType: "json",
			type: "POST",
			success: function (res) {
				$("#dirigida").val(res.Nombre_Contacto);
			}
		});

		$.ajax({
			url: urlplanta,
			data: "nit_cliente=" + nit_cliente,
			dataType: "json",
			type: "POST",
			success: function (res) {
				$("#planta").html(res.selectPlanta);
			}
		});

		$.ajax({
			url: url,
			data: "nit_cliente=" + nit_cliente,
			dataType: "json",
			type: "POST",
			success: function (datocli) {
				$("#dir_empresa").val(datocli["Direccion"]);
				$("#nit").val(datocli["Nit_Cliente"]);
				$("#tel_empresa1").val(datocli["Telefono1"]);
				$("#tel_empresa2").val(datocli["Telefono2"]);
				$("#plazo").val(datocli["Dias_Plazo"]);
				$("#fpago").val(datocli["Forma_Pago"]);
				$("#vendedor").val(datocli["Cedula_Empleado"]);
				$("#ciudad_empresa").val(datocli["Ciudad_Cliente"]);
				if (datocli["Dias_Plazo"] > 0) {
					if ($("#tipo_factura")) {
						$('input[id="tipo_factura"][value="Credito"]').prop("checked", true);
					}
				} else {
					$('input[id="tipo_factura"][value="Contado"]').prop("checked", true);
				}
			}
		});
	});

	$(document).on("change", "#planta", function () {
		var urlcontacto = $(this).attr('data-urlcontacto');

		var planta = $(this).val();

		if (planta == "") {
			$("#dirigida").val("");
		}
		$.ajax({
			url: urlcontacto,
			data: "planta=" + planta,
			dataType: "json",
			type: "POST",
			success: function (res) {
				$("#dirigida").val(res.Nombre_Contacto);
			}
		});
	});
	/******************************LLENAR INGRESOS******************************/

	$(document).ready(function () {
		if ($("#num_ingreso").val()) {
			$("#num_ingreso").trigger("change");
		}
	});

	$(document).on("change", "#no_ingreso, #num_ingreso", function () {

		var ingreso = $(this).val();
		var url = $(this).attr("data-url");
		var tipo_doc = $("#tipo_documento").val();

		$.ajax({
			url: url,
			method: "post",
			dataType: "json",
			data: {
				ingreso: ingreso
			}
		}).done((res) => {
			$("#equipo").val(res["Codigo_Clase_Equipo"]);
			$("#nom_equipo").val(res["Clase_Equipo"]);
			$("#tipo").val(res["Codigo_Tipo_Equipo"]);
			$("#nom_tipo").val(res["Tipo_Equipo"]);
			$("#marca").val(res["Codigo_Marca"]);
			$("#nom_marca").val(res["Marca"]);
			$("#serie").val(res["Numero_Serie"]);
			$("#fases").val(res["No_Fases"]);
			$("#frame").val(res["Frame"]);
			$("#potencia").val(res["Potencia"]);
			$("#rpm").val(res["Velocidad"]);
			$("#voltaje").val(res["Voltaje"]);
			$("#planta").val(res["Planta"]);
			$("#ubicacion").val(res["Ubicacion"]);
			$("#orden_servicio").val(res["Orden_Servicio"]);
			$("#tservicio").val(res["Tipo_Servicio"]);
			$("#tiempoE").val(res["Tiempo_Entrega"]);
			$("#vendedor").val(res["Vendedor"]).trigger("change");
			$("#garantia").val(res["Garantia"]);
			$("#observa").val(res["Observaciones"]);
			$("#Detalle_De_Equipo").val(res["Detalle_De_Equipo"]);
		})

		if (tipo_doc === "CT") {
			let nit_sede = $("#nit_sede").val();
			let url_detalle = "ajax.php?modulo=Cotizaciones&controlador=Cotizaciones&funcion=BuscarDetalleIngresoPL";
			$.ajax({
				url: url_detalle,
				data: "ingreso=" + ingreso + "&nit_sede=" + nit_sede,
				type: "POST",
				success: function (info) {
					$("#Detalle_GER").html(info);
					calcularTotalDetalle();
				}
			});
		} else if (tipo_doc === "FVC") {
			let nit_sede = $("#nit_sede").val();
			let url_detalle = "ajax.php?modulo=Factura&controlador=Factura&funcion=BuscarDetalleIngresoCT";
			$.ajax({
				url: url_detalle,
				data: "ingreso=" + ingreso + "&nit_sede=" + nit_sede,
				type: "POST",
				success: function (info) {
					$("#Detalle_GER").html(info);
					calcularTotalDetalle();
				}
			});
		} else if (tipo_doc === "OT") {
			let nit_sede = $("#nit_sede").val();
			let url_detalle = "ajax.php?modulo=OrdenTrabajo&controlador=OrdenTrabajo&funcion=BuscarDetalleIngreso";
			$.ajax({
				url: url_detalle,
				data: "ingreso=" + ingreso + "&nit_sede=" + nit_sede,
				type: "POST",
				success: function (info) {
					$("#Detalle_General").html(info);
				}
			});
		}else if (tipo_doc === "RM") {
			let nit_sede = $("#nit_sede").val();
			let url_detalle = "ajax.php?modulo=Remisiones&controlador=Remisiones&funcion=BuscarDetalleIngreso";
			$.ajax({
				url: url_detalle,
				data: "ingreso=" + ingreso + "&nit_sede=" + nit_sede,
				type: "POST",
				success: function (info) {
					$("#Detalle_General").html(info);
				}
			});
		}
	});
	/******************************FIN LLENAR INGRESOS******************************/
	$(document).on("click", "#VerDatosPL", function () {
		var url = $(this).attr('data-url');
		var numPL = $('#numPL').val();

		$.ajax({
			url: url,
			data: "numPL=" + numPL,
			type: "POST",
			success: function (dato) {
				$('#div_Datos_Adicionales').html(dato);
				$('#VerDatos').modal('show');
			}
		});
	});

	$(document).on("click", "#AnularPL", function () {
		var url = $(this).attr('data-url');
		var numPL = $('#numPL').val();
		var nit_sede = $('#nit_sede').val();

		if (numPL != "") {
			var msjAnular = confirm("Desea Anular la Preliquidacion!");

			if (msjAnular == true) {
				var razonAnula = prompt("Ingrese la Razon por la cual Anula");
				if (razonAnula != "") {

					$.ajax({
						url: url,
						data: "numPL=" + numPL + "&tipo_doc=" + "PL" + "&Razon_Anula=" + razonAnula + "&nit_sede=" + nit_sede,
						type: "POST",
						success: function () {
							alert('Registro Anulado con Exito');
						}
					});
				} else {
					alert("Proceso Cancelado");
				}
			} else {
				alert("Proceso Cancelado");
			}
		}

	});

	$(document).on("click", "#PdfPL", function () {
		var numero_doc = $("#numPL").val();
		var tipo_doc = $("#tipo_doc").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/Preliquidacion/GuiImprimirPL.html.php?";

		window.open(url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede);
	});

	$(document).on("click", "#WordPL", function () {
		var numero_doc = $("#numPL").val();
		var tipo_doc = $("#tipo_doc").val();
		var nit_sede = $("#nit_sede").val();

		var url = "../../views/Preliquidacion/GuiWordPL.html.php?";

		window.location.href = url + "numero_doc=" + numero_doc + "&tipo_doc=" + tipo_doc + "&nit_sede=" + nit_sede;
	});
	/*************************PRELIQUIDACION*************************/



});