

<?php 
include_once "../../config/Modify.php";
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<title>Modificar Estudiante</title>
</head>
<body>
	<h1>Modificar Estudiante</h1>

   <?php while ( $estudiante = $registros->fetch_assoc()) {?>
	<form id="modify-form" method="POST" action="../../app/controller/modify.controller.php">

		<table width="100%" border="1">
                <tr>
                  <td><b><center>ID</center></b></td>
                  <td><b><center>Facultad</center></b></td>
                  <td><b><center>Nombres</center></b></td>
                  <td><b><center>Cedula</center></b></td>
                  <td><b><center>Estado</center></b></td>

                </tr>
                <tr>
               
                
                  <td><label>ID</label><input type="text" id="id"       name="id"     value="<?php echo $estudiante['Id_Estudiante'] ?>" ></td>
                  <td><label>ID</label><input type="text" id="facultad" name="facultad"value="<?php echo $estudiante['Facultad'] ?>" ></td>
                  <td><label>ID</label><input type="text" id="nombres"  name="nombres" value="<?php echo $estudiante['Nombres'] ?>" ></td>
                  <td><label>ID</label><input type="text" id="cedula"   name="cedula"  value="<?php echo $estudiante['Cedula'] ?>" ></td>
                  <td><label>ID</label><input type="text" id="estado"   name="estado"  value="<?php echo $estudiante['Estado_Estudiante'] ?>" ></td>

                 
               
            </tr>
    </table>
                  <input type="hidden" name="2" value="<?php echo $estudiante['Apellido1'] ?>">
                  <input type="hidden" name="3" value="<?php echo $estudiante['Apellido2'] ?>">
                  <input type="hidden" name="4" value="<?php echo $estudiante['Email'] ?>">

     
    <input type="hidden" name="documentoAnt" value="<?php echo $estudiante['Id_Estudiante'] ?>">
    <input type="submit" value="Modificar" class="form-control btn btn-login">
	</form>
<?php } 
$sentence->close();
$conexion->close(); ?>
<!--<script type="public/js/Modify.js"></script>-->


</body>
</html>