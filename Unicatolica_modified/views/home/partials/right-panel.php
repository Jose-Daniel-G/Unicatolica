<?php
// partials/right-panel.php
// Asume session_start() ya fue llamado antes de incluir este archivo
?>
<div class="col-12 col-md-6">

    <div class="row">
        <div class="p-0 col-11"> <!-- Logo Semana de la Ingeniería + botón salir -->
            <img src="../../public/img/logo-semana-6-2.png"
                alt="Semana de la Ingeniería"
                class="img-fluid">
        </div>
        <div class="align-self-center col-1">
            <button type="button"
                id="salir"
                class="btn btn-primary text-white"
                style="background: #428BCA;">
                <i class="fa fa-sign-out-alt"></i> Salir
            </button>
        </div>
    </div>

    <!-- Botones de acciones -->
    <div class="mt-4 row">
        <div class="col-12 col-lg-6 text-center mb-3 mb-lg-0">
            <!-- Botón abre modal maratón -->
            <button type="button"
                class="btn btn-primary w-100"
                data-toggle="modal"
                data-target="#maraton-program"
                style="background: #428BCA;">
                Maratón de la Programación
            </button>
            <div id="validarRegistroMaraton" class="mt-2"></div>
        </div>

        <div class="col-12 col-lg-6 text-center">
            <!-- Botón descargar reglamento -->
            <a class="btn btn-primary w-100"
                href="../../public/files/ReglamentoMaratonProgramacion.pdf"
                download="ReglamentoMaratonProgramacion"
                style="background: #428BCA;">
                Descargar reglamento
            </a>
        </div>
    </div>

    <!-- Tabla actividades seleccionadas -->
    <form id="formInscripciones" method="post">
        <div class="table-responsive">
            <table id="tablaAgregarActividad" class="table table-hover">
                <thead style="background: #428BCA; color: #fff;">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-center mt-4">
            <input type="submit"
                id="inscribir"
                class="btn btn-primary text-white mx-2"
                style="background: #428BCA;"
                value="Inscribir">

            <input type="button"
                id="verQR"
                class="btn btn-primary text-white mx-2"
                style="background: #428BCA;"
                value="Ver QR">
        </div>
    </form>

</div>