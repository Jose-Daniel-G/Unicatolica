<div class="card">

	<label class="header-blue">Modificar Salario</label>

	<div class="card-body">
		<form method="post" id="frm_retiEmpleado" 
		action="<?php echo getUrl("Empleados","Empleados", "insertarSalario", false, "ajax"); ?>" autocomplete="off">
			
			<div class="container-fluid">
				
				<div class="pb-4 row">
				
					<div class="col-12">
						<div class="pt-4 pb-4 row">

							<div class="col-6">
								<div class="row">
									<div class="col-5">
										<label class="font-weight-bold" for="cedula">Fecha&nbsp;Modifica&nbsp;Salario</label>
									</div>

									<div class="col-5">
										<input type="text" name="fmodifica" id="fmodifica" class="datepicker form-control" placeholder="aaaa-mm-dd" readonly>
									</div>
								</div>
							</div>

							<div class="col-6">
								<div class="row">
									<div class="col-5">
										<label class="font-weight-bold" for="valor">Valor&nbsp;Nuevo&nbsp;Salario</label>
									</div>

									<div class="col-5">
										<input type="number" name="valor" id="valor" class="form-control">
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>

				<div class="border-top pt-4 pb-4 row">
					<div class="col-12">
						<label class="font-weight-bold" for="obser">Observaciones</label>
						<textarea  name="obser" id="obser" class="form-control" rows="4"></textarea>
					</div>
				</div>

				<div class="border-top pt-4 pb-4 justify-content-end row">
					<div class="p-0 col-2">
						<button type="submit" id="registrarRetiro" name="registrarRetiro" class="btn btn-primary">
							<i class="fa fa-save" aria-hidden="true"></i>
						</button>
		
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
				
			</div>
			
		</form>
	</div>
</div>

<script>
$(".datepicker").css({
fontSize: 17,
});
$(".datepicker").datepicker({
changeYear: true,
dateFormat: "yy-mm-dd",
yearRange: "1940:2040",
showMonthAfterYear: true,
});
</script>