<?php 
	include_once "../../config/configuracion.php";
	//error_reporting(0); //No me muestra errores
	$mysqli = new mysqli($server, $user, $password, $database);
	$temp="";
	if ($mysqli->connect_errno) {
	    echo "Nuestro sitio experimenta fallos....";
	    exit();
	}
	if(isset($_POST['btn2']))
    {

        $doc = $_POST['doc'];
        if($doc=="") //VERIFICO QUE AGREGEN UN DOCUMENTO OBLIGATORIAMENTE.
          {echo "Digita un documento por favor. (Ej: 123)";}
        else
        {  
          $resultados = mysqli_query($mysqli,"SELECT * FROM estudiantes WHERE Id_Estudiante = $doc");
          while($consulta = mysqli_fetch_array($resultados))
          {
            echo 
            "
              <table width=\"100%\" border=\"1\">
                <tr>
                  <td><b><center>ID</center></b></td>
                  <td><b><center>Facultad</center></b></td>
                  <td><b><center>Nombres</center></b></td>
                  <td><b><center>Cedula</center></b></td>
                  <td><b><center>Estado</center></b></td>

                </tr>
                <tr>
                  <td>".$consulta['Id_Estudiante']."</td>
                  <td>".$consulta['Facultad']."</td>
                  <td>".$consulta['Nombres']."</td>
                  <td>".$consulta['Cedula']."</td>
                  <td>".$consulta['Estado_Estudiante']."</td>




                </tr>
              </table>
            ";
          }
        }

    mysqli_close($mysqli);
      
    }
    if(isset($_POST['btn3']))
    {

        $doc = $_POST['doc'];
        if($doc=="") //VERIFICO QUE AGREGEN UN DOCUMENTO OBLIGATORIAMENTE.
          {echo "Digita un documento por favor. (Ej: 123)";}
        else
        {  
          $resultados = mysqli_query($mysqli,"SELECT * FROM estudiantes WHERE Id_Estudiante = $doc");
        while($consulta = mysqli_fetch_array($resultados))
          {
            echo 
            "
              <table width=\"100%\" border=\"1\">
                <tr>
                  <td><b><center>ID</center></b></td>
                  <td><b><center>Facultad</center></b></td>
                  <td><b><center>Nombres</center></b></td>
                  <td><b><center>Cedula</center></b></td>
                  <td><b><center>Estado</center></b></td>

                </tr>
                <tr>
                  <td>".$consulta['Id_Estudiante']."</td>
                  <td>".$consulta['Facultad']."</td>
                  <td>".$consulta['Nombres']."</td>
                  <td>".$consulta['Cedula']."</td>
                  <td>".$consulta['Estado_Estudiante']."</td>




                </tr>
              </table>
            ";
          	$sql = "DELETE FROM estudiantes WHERE Id_Estudiante = $doc";

			if (!$mysqli->query($sql)) {
				printf("Problemas en el Delete.\n". $mysqli->error . "\n"); 
			} else{
				echo "<br><strong>REGISTRO ELIMINADO !OK!</strong><br>";
			}
   		}
    }

    mysqli_close($mysqli);
      
    }

?>