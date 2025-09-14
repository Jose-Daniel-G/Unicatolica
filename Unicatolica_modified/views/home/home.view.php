<?php
@session_start();
include_once "../../config/env.php";
?>

<?php if (isset($_SESSION["Id_Estudiante"])): ?>
	<?php if ($_SESSION["Id_Estudiante"] == 16882523): ?>
		<?php header("Location: ./draw.view.php"); ?>
	<?php else: ?>
		<!DOCTYPE html>
		<html lang="es">
		<head>
			<?php include 'partials/head.php'; ?>
		</head>
		<body>
			<!-- Modal Semana de la Ingeniería 6 -->
			<div class="modal fade" id="modalSemana6" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="container-fluid">
						<div class="justify-content-center row">
							<div class="col-12">
								<img src="../../public/img/logo-semana-6.png" alt="Logo Semana 6" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container ">
				<div class="mt-2 row">
					<?php include 'partials/left-panel.php'; ?>
					<?php include 'partials/right-panel.php'; ?>
				</div>
			</div>
			<?php include 'partials/modal-actividades.php'; ?><!--  Tabla Actividades -->
			<?php include 'partials/modal-maraton.php'; ?>
			<?php include 'partials/modal-equipo.php'; ?>

			<?php include 'partials/scripts.php'; ?>
		</body>
		</html>
	<?php endif; ?>
<?php else: header("Location: ../../"); ?>
<?php endif; ?>