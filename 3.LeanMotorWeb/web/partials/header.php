<?php
@session_start();

if (count($_SESSION) > 0) {
    $usu_nombre = $_SESSION['usua_nombreCompleto'];
} else {
    $usu_nombre = "";
}

?>

    <div class="align-items-baseline d-flex flex-row navbar-brand p-lg-3 pl-3 pr-3 pt-3">
        <a style="navbar-brand" href="index.php/../"><span class="text-primary">Lean Motor Web</span></a>
        <button class="collapsed ml-auto navbar-toggler" type="button" data-toggle="collapse" data-target="#side-menu-wrapper" aria-controls="side-menu"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <ul class="nav navbar-nav ml-md-auto flex-row navbar-top-links">
        <li class="nav-item dropdown">
            <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i>
                <strong>
                    <?=$usu_nombre;?>
                </strong>
                </i>
            </a>

            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="">
                        <i class="fa fa-user fa-fw"></i>Perfil Usuario</a>
                </li>
                <div class="dropdown-divider"></div>
                <li>
                    <a href="">
                        <i class="fa fa-gear fa-fw"></i>Config. Usuario</a>
                </li>
            </ul>
        </li>

        <li id="img_ayuda" class="nav-item dropdown">
            <a class="nav-link" style="cursor: pointer; color: #337ab7;">
                <i class="fa fa-question-circle fa-2x"></i>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" href="index.php?modulo=Sesion&controlador=Sesion&funcion=cerrarSesion" style="color: #337ab7;">
                <i class="fa fa-sign-out-alt"></i> Salida Segura</a>
        </li>
    </ul>