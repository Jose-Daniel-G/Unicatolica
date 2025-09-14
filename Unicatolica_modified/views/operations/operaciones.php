<?php

@session_start();

include_once "../../config/env.php";

?>

<?php if (isset($_SESSION["Id_Estudiante"])):  ?>

<?php if ($_SESSION["Id_Estudiante"] == 16882523): ?>
<?php header("Location: ./draw.view.php"); ?>

<?php else: ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="../../public/img/logo-unicatolica.png" type="image/x-icon">
	<link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../vendor/datatable/css/datatables.min.css">
	<link rel="stylesheet" href="../../vendor/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../../vendor/sweetalert/css/sweetalert2.min.css">
	<link rel="stylesheet" href="../../vendor/select2/css/select2.min.css">
	<link rel="stylesheet" href="../../public/css/styles.css">
	<title>Operaciones</title>
</head>

<body>
	<form method="post" id="buscar">
	<div class="container">
		<div class="mt-4 form-group row">
			<div class="col-3">
				<label for="">Estudiante:</label>
			</div>
			<div class="col-9">
				<select name="nombreEstudiante[]" id="selectEstudiantes" class="select2 form-control"></select>
			</div>
		</div>
    </div>
	</form>
    </div>

	<div class="container">
		<div class="mt-2 row">

			<div class="col-12 col-md-6">
				<div class="container" id="maraton-program" tabindex="-1" role="dialog" aria-labelledby="maraton-programLabel"
				 aria-hidden="true">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							

							<form method="post" id="formMaraton">
								<div class="container">
									<div class="mt-4 form-group row">
										<div class="col-3">
											<label for="">Estudiante:</label>
										</div>
										<div class="col-9">
											<select name="nombreEstudiante[]" id="selectEstudiantes" class="select2 form-control"></select>
										</div>
									</div>

									<div class="mt-5 row">
										<div class="text-center col-12">
											<button type="button" id="botonAgregarEstudiante" class="text-white btn" style="background: #428BCA;">
												<i class="fa fa-sign-out-alt fa-3x fa-rotate-90"></i>
											</button>
										</div>
									</div>

									<div class="row">
										<div class="col-12">
											<p class="text-center">Agregar</p>
										</div>
									</div>

									<div class="mt-5 form-group row">
										<div class="col-12">
											<table id="tablaAgregarEstudiante" class="table table-hover">
												<thead class="text-white" style="background: #428BCA;">
													<tr>
														<th>idEstudiante</th>
														<th>Participantes</th>
														<th></th>
														<th>idRegistro</th>
													</tr>
												</thead>

												<tbody></tbody>
											</table>
										</div>
									</div>

									<div class="form-group row">
										<div class="text-center col-12">
											<input type="submit" id="inscribirEstudiante" class="text-white btn" style="background: #428BCA;" value="Inscribir">
										</div>
									</div>

								</div>
							</form>

						</div>
					</div>
				</div>
				<!-- FIN MODAL MARATÓN PROGRAMACIÓN -->

				


				
			</div>

			

		</div>

	</div>


	</div>
	</div>

	<script src="../../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../../vendor/datatable/js/datatables.min.js"></script>
	<script src="../../vendor/select2/js/select2.min.js"></script>
	<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../vendor/sweetalert/js/sweetalert2.min.js"></script>
	<script src="../../public/js/app.js"></script>
</body>

</html>
<?php endif;?>

<!-- SE REDIRIGE AL LOGIN SI NO HA INICIADO SESIÓN -->
<?php else:header("Location: ../../");?>
<?php endif;?>
