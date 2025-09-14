<?php
// partials/left-panel.php
// Asume session_start() ya fue llamado antes de incluir este archivo
?>
<div class="col-12 col-md-6">
    <div class="row">
        <div class="col-12">
            <!-- Logo -->
            <img src="../../public/img/logo-unicatolica.png" alt="Logo Unicatólica" class="img-fluid">
        </div>
    </div>
    <!-- Bienvenida + botón Mis actividades -->
    <div class="mt-4 row">
        <div class="mt-2 col-4 col-md-6 col-lg-6">
            <h5 class="font-weight-bold">BIENVENIDO!!</h5>
        </div>
        <div class="col-4 col-lg-4">
            <!-- Botón abre modal de actividades -->
            <button type="button" id="btnMisActividades" class="btn btn-primary" data-toggle="modal" data-target="#misactividades" aria-label="Mis actividades" style="background: #428BCA;">
                Mis actividades <span id="cantidadActividades" class="badge badge-light ml-2"></span>
            </button>
        </div>
    </div>

    <!-- Nombre de usuario -->
    <div class="row col-12">
        <strong id="usuarioNombre"><?= htmlspecialchars($_SESSION['nombreUsuario'] ?? '') ?></strong>
    </div>

    <!-- Selección de actividad -->
    <div class="form-group row">
        <label for="selectActividades" class="col-sm-4 col-form-label font-weight-bold">Selecciona tu actividad:</label>
        <div class="col-sm-8">
            <select name="selectactividades" id="selectActividades" class="form-control"></select>
        </div>
    </div>

    <!-- Detalles de la actividad -->
    <div class="form-group row">
        <label class="col-sm-4 col-form-label font-weight-bold">Fecha:</label>
        <div class="col-sm-8">
            <input type="text" id="fecha" name="fecha" class="form-control" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label font-weight-bold">Hora:</label>
        <div class="col-sm-8">
            <input type="text" id="hora" name="hora" class="form-control" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label font-weight-bold">Sede:</label>
        <div class="col-sm-8">
            <input type="text" id="sede" name="sede" class="form-control" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label font-weight-bold">Expositor:</label>
        <div class="col-sm-8">
            <input type="text" id="expositor" name="expositor" class="form-control" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="font-weight-bold">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="5" class="form-control" readonly></textarea>
    </div>

    <!-- Botón Agregar actividad -->
    <div class="text-center my-3">
        <button type="button"
            id="botonAgregarActividad"
            class="btn btn-primary"
            style="background: #428BCA;"
            title="Agregar actividad">
            <span class="d-none d-md-inline"><i class="fa fa-sign-out-alt"></i> Agregar</span>
            <span class="d-inline d-md-none"><i class="fa fa-sign-out-alt fa-2x fa-rotate-90"></i></span>
        </button>
        <div class="small text-muted mt-2">Agregar actividad a tu lista</div>
    </div>

</div>
