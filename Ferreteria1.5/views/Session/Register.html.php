<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registrar</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!--<link rel='stylesheet' type='text/css' media='screen' href='main.css'>-->
    <link rel="stylesheet" href="../../assets/vendor/bootstrap4/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../../assets/vendor/sweetalert/css/sweetalert2.min.css" >
    <!--<script src='main.js'></script>-->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="p-5 col-lg-4 mx-md-auto">
                <div class="login-card card ">
                    <div class="card-header">
                        <h3 class="card-title">Registrar</h3>
                    </div>
                    <div class="card-body">
                        <form id="frm_register" action="" method="POST" autocomplete="off">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Usuario" name="user" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="contraseña" name="password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="verificar contraceña" name="verifyPassword">
                                </div>
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Registrar">
                            </fieldset>
                
                            <a href="javascript:window.history.back();">&laquo; Volver atrás</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../../assets/vendor/jquery/jquery.min.js"></script>
<script src="../../assets/vendor/sweetalert/js/sweetalert2.min.js"></script>
<script src="../../public/js/login.js"></script>

</html>