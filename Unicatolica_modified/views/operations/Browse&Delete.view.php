<?php include_once "../../app/controller/operaciones.controller.php";

@session_start();
@session_destroy();?>
<html>
<head>
  <title>Administrador</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">



    <center><h1>Administrador de Estudiantes</h1></center>

    <form method="POST" action="" >

    <div class="form-group">
      <label for="doc">ID:</label>
      <input type="text" name="doc" class="form-control" id="doc">
    </div>
   <div class="form-group">
      <label for="facultad">Facultad </label>
      <input type="text" name="facultad" class="form-control" id="dir">
  </div>

   <div class="form-group">
      <label for="nombre">Nombres</label>
      <input type="text" name="nombre" class="form-control" id="nombre">
  </div>

   <div class="form-group">
      <label for="cedula">Cedula</label>
      <input type="text" name="cedula" class="form-control" id="cedula">
  </div>
 
    <center>
      <input type="submit" value="Ingresar" class="btn btn-success" name="ingresar">
      <input type="submit" value="Consultar" class="btn btn-info" name="btn2">
      <input type="submit" value="Eliminar" class="btn btn-success" name="btn3">

    </center>
    <br>
      <center>
        <button class="btn btn-success"><a href="../modify/Modifing.php" >Modificar por ID</a></button>
      </center>
    

  </form>

<?php
include_once "../../app/controller/abrir_conexion.php";


@session_start();
@session_destroy();
    
?>

 



  </div>
  <div class="col-md-4"></div>
</div>



  
  
</body>
</html>