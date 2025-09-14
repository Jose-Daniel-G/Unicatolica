<?php
// include_once "config/env.php";
@session_start();
@session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>La Surtida</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!--<link rel='stylesheet' type='text/css' media='screen' href='main.css'>-->
    <link rel="stylesheet" href="assets/vendor/bootstrap4/css/bootstrap.min.css" >
    <link rel="stylesheet" href="assets/vendor/sweetalert/css/sweetalert2.min.css" >
    <link rel="shortcut icon" href="public/img/favicon/logo.png" type="image/x-icon">

    <!--<script src='main.js'></script>-->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="p-5 col-lg-4 mx-md-auto">
                <div class="login-card card ">
                    <div class="card-header">

                    <div class="justify-content-center row">
							<div class="col-6">
								<img src="public/img/favicon/logo-ferreteria.png" alt="" class="img-fluid">
							</div>
						</div>
							
                    </div>
                    
                    <div class="card-body">
                        <form id="frm_session" method="POST" autocomplete="off">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Login" name="user" id="user" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                </div>
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Ingresar">
                            </fieldset>
                        </form>
                        <a href="views/Session/Register.html.php">Crear Usuario</a>       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/sweetalert/js/sweetalert2.min.js"></script>
<script src="public/js/login.js"></script>

</html>