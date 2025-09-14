<?php include_once "../../app/lib/helpers.php";?>
<?php @session_start();
include_once "../../config/env.php";
?>

<?php if (isset($_SESSION['user_role'])): ?>
  <?php if ($_SESSION["user_role"] == 2): ?>
      <?php header("Location: ./draw.view.php");?>
  <?php else:?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- jQuery 3.4.1 -->
    <!-- <script src="../../assets/vendor/jquery/jquery-3.4.1.min.js"></script> -->
     <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <?php include_once "../../web/partials/head.php"; ?>
</head>

<body class="skin-default-dark fixed-layout">
    <!-- <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">La Completa</p>
        </div>
    </div> -->

    <div id="main-wrapper">
        <!-- HEADER -->
        <?php include_once "../../web/partials/header.php"; ?>
        <div class="d-md-flex">
	          <!-- SIDE_BAR -->
				<?php include_once "../../web/partials/leftMenu.php";?>
				<div id="page-wrapper" class="p-4">
					<div class="container-fluid "  id="cargarVista" style="width: 70rem;">
			            <?php include_once "../../app/lib/ajax.php"; ?>
                        
					</div>
				</div>
			</div>
        <!-- FOOTER -->
        
        <!-- LOG OUT -->
	    <!-- Logout Modal-->
	    <?php include_once "../partials/logOut.php";?>
    </div>
    <!-- SCRIPTS -->
    <?php include_once "../../web/partials/scripts.php"; ?>
</body>

</html>
<?php endif;?>
    <!-- REDIRECT TO LOGIN -->
    <!-- SE REDIRIGE AL LOGIN SI NO HA INICIADO SESIÓN -->
<?php else:header("Location: ../../");?>
	<?php endif;?>