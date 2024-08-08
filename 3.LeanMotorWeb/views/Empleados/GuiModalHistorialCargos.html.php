
	<!-- <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 class="modal-title" id="myModalLabel">Historial Cargos</h4>
	</div>
	
<div class="modal-body">          
	<form role="form" name="HisCargos" method="post"  autocomplete="off">
		<div class="table-responsive">
			<table   class="table table- table-hover">							
				<thead>
					<tr>
						<th bgcolor="#337ab7" colspan="6" style="color:white;">Cargos</th>
					</tr>
					<tr>
						<th width="8%">Codigo</th>					
						<th>Cargo</th>					
						<th>Fecha Cambio </th>	
						<input type="text" name="cedulaCargos" id="cedulaCargos" class="form-control">
					</tr>	
					<tr>
						<td width="8%"><input type="text" name="cedulaCargos" id="cedulaCargos" class="form-control"></td>
						<td width="8%"><input type="text" name="" id="" class="form-control"></td>
						<td><input type="text" name="" id="" class="form-control"></td>
						<td><input type="text" name="" id="" class="form-control"></td>
					</tr>
				</thead>				
			</table>         
		</div>
		<button type="submit" id="registrarSalario" name="registrarSalario"  class="btn btn-primary" ><i class="fa fa-save" aria-hidden="true"></i></button>							
		<button type="button" class="btn btn-primary" data-dismiss="modal">x</button>
		</form>
</div> -->














<div class="card">

	<label class="header-blue">Cargos</label>

	<div class="card-body">
		<form method="post" id="frm_retiEmpleado" 
		action="<?php echo getUrl("Empleados","Empleados", "insertarRetiro", false, "ajax"); ?>" autocomplete="off">
			
			<div class="container-fluid">
				
				<div class="pb-4 row">
				
					<div class="col-12">
						<div class="pt-4 pb-4 row">

							<div class="col-6">
								<div class="row">
									<div class="col-5">
										<label class="font-weight-bold" for="cedula">Fecha de Novedad</label>
									</div>

									<div class="col-5">
										<input type="text" name="fnovedad" id="fnovedad" class="datepicker form-control" placeholder="aaaa-mm-dd" readonly>
									</div>
								</div>
							</div>

							<div class="col-6">
								<div class="row">
									<div class="col-5">
										<label class="font-weight-bold" for="tipo">Tipo de Novedad</label>
									</div>

									<div class="col-5">
										<select name="tipo" id="tipo" class="form-control">
											<option value="">Seleccione ...</option>
											<option value='Retiro'>Retiro</option>
											<option value='Ingreso'>Ingreso</option>
										</select>
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