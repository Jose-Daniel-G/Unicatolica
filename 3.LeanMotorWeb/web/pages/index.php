<?php
@session_start();
include_once "../../app/Lib/helpers.php";
?>

<?php if (isset($_SESSION["usua_perfil"])): ?>

<!DOCTYPE html>
<html lang="es">
<!-- HEAD -->

<head>
  <!-- jQuery -->
  <script src="../../vendor/sb-admin-2/lib/jquery/jquery-3.3.1.min.js"></script>
  <?php include_once "../../web/partials/head.php";?>
</head>

<body>

  <div class="wrapper">
    <!-- HEADER -->
    <header class="align-items-start app-header flex-column flex-md-row navbar navbar-expand-md navbar-light">
      <?php include_once "../../web/partials/header.php";?>
    </header>

    <div class="d-md-flex">
      <!-- SIDEBAR -->
      <?php include_once "../../web/partials/menu_izquierdo.php";?>
      <div id="page-wrapper" class="p-4">
        <!-- BODY -->
        <?=cargarPrincipal();?>
      </div>
    </div>


    <div class="modal fade" id="ayuda">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Lean Motor Web Vers. 1.0</h3>
          </div>
          <div class="modal-body">
            <p>Diseñado y Desarrollado por Ingesoftware</p>
            <p>Gerente de Proyecto: Ing. Rocio Amaya R.</p>
            <p>Director de Proyecto: Ing. Santiago Zuniga Shaik</p>
            <!-- <p>Web Developer: Ing. Maria Doneya Restrepo Velarde</p> -->
            <p>Web Developer: Tnlgo. Daniel Alexander Paz Rodríguez</p>
            <p>Todos los derechos reservados 2018</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modalBuscarIngresos">
      <div class="modal-dialog modal-lg" role="document" style="max-width: 80%;">
        <div class="modal-content">

          <div class="text-center modal-header">
            <h3 class="w-100 modal-title">Consulta de OIs</h3>
            <button type="button" class="close" data-dismiss="modal" title="Cerrar">
              <i class="fa fa-window-close fa-2x text-danger"></i>
            </button>
          </div>

          <div class="modal-body">

          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="ModalBuscarDocumento">
      <div class="modal-dialog modal-lg" role="document" style="max-width: 80%;">
        <div class="modal-content">

          <div class="text-center modal-header">
            <h3 class="w-100 modal-title">Búsqueda de Documentos</h3>
            <button type="button" class="close" data-dismiss="modal" title="Cerrar">
              <i class="fa fa-window-close fa-2x text-danger"></i>
            </button>
          </div>

          <div class="modal-body">
            
          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="VerDatosAdicionales">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Datos Adicionales</h3>
          </div>
          <div class="modal-body">
            <div id='div_DatosAdicionales'>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- FOOTER -->
    <footer>
      <?php include_once "../../web/partials/footer.php";?>
    </footer>

    <!-- SCRIPTS -->
    <div id="scripts">
      <?php include_once "../../web/partials/scripts.php";?>
    </div>
    

</body>

<!-- REDIRECT TO LOGIN -->
<?php else: ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include_once "../../web/partials/head.php";?>
</head>
<body>
  <?=messageSweetAlert("La sesión ha expirado", "", "warning", "", "si", "boton", "../../");?>
</body>

<?php endif;?>
</html>