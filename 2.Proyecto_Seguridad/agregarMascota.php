<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <title>Agregar Mascota</title>
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
                                <form method="POST" name="agregarMascota">
                                    <table class="table"  align="center">
                                        <td colspan="2"><h1 align="center">Crear Mascota Nuevo</h3></td>
                                        <tr>
                                            <td align="right">Nombre: </td>
                                            <td><input type="text" name="nombre"></td>
                                        </tr>
                                        <tr>
                                            <td align="right">Tipo: </td>
                                                <td><input type="text" name="tipo"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Raza: </td>
                                            <td><input type="text" name="raza"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Genero: </td>
                                            <td><input type="text" name="genero"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Numero de documento del dueño: </td>
                                            <td><input type="number" name="idDueño"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Edad: </td>
                                            <td><input type="number" name="edad"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Esterilisada: </td>
                                            <td><input type="text" name="Esterilisada"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Nombre del dueño: </td>
                                            <td><input type="text" name="nombreDue"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Telefono: </td>
                                            <td><input type="number" name="telefono"></td>    
                                        </tr>
                                        <tr>
                                            <td align="right">Direccion: </td>
                                            <td><input type="text" name="direccion"></td>    
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="2">
                                                <div class="btn-group" role="group" aria-label="Basic example" align="center">
                                                    <button type="submit" name="crear" class="btn btn-light">Crear</button>
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
                    <td><img src="imagen/agregar.jpg" class="rounded float-right" alt="..."></td>
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