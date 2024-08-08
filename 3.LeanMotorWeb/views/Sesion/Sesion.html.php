<?php
include_once "app/Lib/helpers.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Lean Motor Web 1.0</title>
	
	<link rel="icon" type="image/png" href="public/favicon.ico">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/sb-admin-2/lib/bootstrap/css/bootstrap.min.css?v=<?=rand(); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="vendor/sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/sb-admin-2/lib/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-4 mx-md-auto">
            <div class="login-card card">
                <div class="card-header">
                    <h3 class="card-title">Lean Motor</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" name="frm_sesion" action="<?="web/pages/" . getUrl("Sesion", "Sesion", "AbrirSesion", false, "ajax");?>" autocomplete="off">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Login" name="usuario" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Clave" name="contrasena" type="password">
                            </div>
                            
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Ingresar"></a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
