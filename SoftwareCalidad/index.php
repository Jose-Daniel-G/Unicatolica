<?php include_once "./web/head.php"; ?>

<body class="bg-light">

  <div class="wrapper">
    <!-- HEADER -->
    <?php require_once("Config/Config.php");//Data que se usa al momento de conexion

    // require_once("Helpers/Helpers.php");
    include_once "./web/header.php";
    ?>
    <!-- HEADER -->
    <!-- SIDEBAR -->
    <?php include_once "./web/left_sidebar.php"; ?>
    <!-- !SIDEBAR -->
    <!-- CONTENT -->
    <?php //include_once "./views/content.php"; 
    ?>
    <!--------------Ajax-------------------->
    <!-- <div id="sincarga">
      <?php // include_once "app/lib/ajax.php";
      ?>

    </div> -->
    <?php
    //Se usa esta condición para navegar entre las pestañas de la vista inicial
    // $page  = isset($_GET['p']) ? strtolower($_GET['p']) : 'home';
    $page  = isset($_GET['p']) ? strtolower($_GET['p']) : 'dashboard';
    if ($page  == 'dashboard') {
      require_once 'views/dashboard/' . $page . '.php';
    } else {
      require_once 'views/' . $page . '.php';
    }
    ?>
    <!--------------Ajax-------------------->


    <!-- !CONTENT -->
    <!-- FOOTER -->
    <footer>
      <?php include_once "./web/footer.php"; ?>
    </footer>
    <!-- !FOOTER -->
    <script src="./vendor/jquery/jquery-3.3.1.min.js"></script>
	<!-- <script src="./vendor/datatable/js/datatables.min.js"></script>
	<script src="./vendor/select2/js/select2.min.js"></script> -->
	<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- <script src="./vendor/sweetalert/js/sweetalert2.min.js"></script> -->
	<script src="./public/js/app.js"></script>
    <!-- SCRIPTS -->
    <!-- <div id="scripts">
      <?php //include_once "./web/scripts.php"; 
      ?>
    </div> -->


</body>