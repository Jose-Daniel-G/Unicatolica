<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <title>Agregar Cita</title>
</head>
<body>
    <!-- cabeza de la pagina--> 
    <?php 
    
        include ("header.php");
        $mensaje="";
        include ("controlador.php");
     

    ?>
    <!-- cuerpo de la pagina--> 
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-borderless">
                    <tr>
                        <td>ss</td>
                    </tr>
                    <tbody>
                        <tr>
                            <td>
                                <form method="POST">
                                    <table class="table"  align="center">
                                        <td colspan="2"><h1 align="center">Crear Cita Nuevo</h3></td>
                                        <tr>
                                            <td align="right">documento del dueño: </td>
                                            <td><input type="number" name="idMascota"></td>    
                                        </tr>
                                        <tr>
                                                <td align="right">procedimiento: </td>
                                                <td><input type="text" name="procedimiento"></td>    
                                            </tr>
                                        <tr>
                                            <td align="right">duracion: </td>
                                            <td><input type="number" name="duracion"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Fecha: </td>
                                            <td><input type="date" name="fecha"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">comentarios: </td>
                                            <td><input type="text" name="comentarios"></td>    
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="2">
                                                <div class="btn-group" role="group" aria-label="Basic example" align="center">
                                                    <button type="submit" name="crearCita" class="btn btn-light">Crear</button>
                                                    <button type="reset" class="btn btn-info">Limpiar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <div class="col">
            <table>
                <tr>
                    <td>ss</td>
                </tr>
                <tr>
                    <td>ss</td>
                </tr>
                <tr>
                        <td>''</td>
                    </tr>
                <tr>
                    <td><img src="imagen/agregarCita.jpg" class="rounded float-right" alt="..."></td>
                </tr>
                <tr>
                    <td>
                       <?php if(strlen($mensaje) > 0): ?>
                        <div class="alert alert-danger" role="alert">
                            <a href="#" class="alert-link"><?=$mensaje?></a>
                        </div>
                      <?php endif ?>
                    </td>
                </tr>
            </table>
        </div>
        </div>    
    </div>
    
    <?php 
    include ("footer.php");
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>