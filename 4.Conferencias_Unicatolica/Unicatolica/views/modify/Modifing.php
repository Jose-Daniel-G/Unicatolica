<?php
include_once "../../config/env.php";
@session_start();
@session_destroy();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html> 
 <head>
 	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../public/css/login.css">
		<link rel="stylesheet" href="../../vendor/sweetalert/css/sweetalert2.min.css">

 <title>Consultar Empleado</title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 </head>
<body>
	<div class="mt-5 container">
		<div class="justify-content-center row">
			<div class="col-md-6 col-md-offset-3">
				<div class="justify-content-center row">
					<div class="col-12">
			<p class="active" id="login-form-link"><h2><strong><em>Consultar Estudiantes</em></strong></h2></p>
 		</div>
 		<div class="col-6">
 			<img src="public/img/logo-unicatolica.png" alt="" class="img-fluid">
 		</div>
	</div>
		<form name="consult" action="Modify.view.php" method="post"">
	
			<label>ID estudiante</label> 
			<input type="text" name="documento" class="form-control"><br>
			<div class="form-group">
			<div class="row"><div class="col-12">
				<input type="submit" id="login" class="form-control btn btn-login" value="BUSCAR">
			</div>
		</div>
		</form>
		</div>
	</div>
</div>

</body> </html>