(function validarModificacion() {
	$("#modify-form").on("submit", function (event) {
		event.preventDefault(); // Evitar ejecutar el submit del formulario.

		var id = $("#id").val();
		var facultad = $("#facultad").val();
		var nombres = $("#nombres").val();
		var cedula = $("#cedula").val();
		var estado = $("#estado").val(); 


		if (id != "" && facultad != "" && nombres != "" && cedula != "" && estado != "") {
			var formData = new FormData(event.target);
			formData.append("funcion", "modificar_estudiante");
			$.ajax({
				url: "app/controller/modify.controller.php",
				method: "post",
				dataType: "json",
				data: formData,
				cache: false, 
				contentType: false, 
				processData: false
			}).done((res) => {
				if (res.tipoRespuesta == "success") {
					location.href = "views/modify/mostrar.php";
				} else if (res.tipoRespuesta == "error") {
					swal({
						title: 'El usuario ingresado no existe',
						type: 'warning',
					});
				}
			});
		}
	});
}());