<?php 
@session_start();
$usua_perfil = $_SESSION['usua_perfil'];
$nit_Empresa_sede = $_SESSION['Nit_Empresa'];?>
<div class="card">
	<div class="card-header">
		<h4>
			<b>Diagnósticos</b>
		</h4>
	</div>

	<div class="card-body">
			<div class="container-fluid">
				<div class="pb-5 row">
					<?php $this->menuDiagnosticos(); ?>
				</div>
			</div>
	</div>
</div>