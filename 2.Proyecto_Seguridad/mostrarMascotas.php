<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <title>Mostrar Mascota Agregadas</title>
</head>
<body>
    <!-- cabeza de la pagina--> 
    <?php 
    
    include ("header.php");

    ?>
    <!-- cuerpo de la pagina--> 
    <div class="container">
        <table>
            <tr>
                <td>as</td>
            </tr>
            <tr>
                <td>as</td>
            </tr>
            <tr>
                <td>'''</td>
            </tr>
            <tr>
                <td>
                    {% block content %}
                    {% if mascota %}
                        <table class="table">
                            <thead class="bg-info">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Nombre del dueño</th>
                                    <th>documento del dueño</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                        {% for mascota in mascota %}
                            <tbody class="table-info">
                                <tr></tr>
                                    <td>{{mascota.Nombre}}</td>
                                    <td>{{mascota.telefono}}</td>
                                    <td>{{mascota.NombreDueño}}</td>
                                    <td>{{mascota.NDocumentoD}}</td>
                                    <td><a href="{% url 'Citas:eliminarMascota' mascota.id %}">eliminar </a></td>
                                </tr>
                            </tbody>
                        {% endfor %}
                        </table>
                    {% else %}
                        <h1 align="center">Actualmente no hay mascotas agregadas</h1>
                    {% endif %}
                    {% endblock %}
                </td>
                <td>
                    <table>
                        <tr>
                            <td><img src="imagen/MascotasAgregadas.jpg" class="rounded float-right" alt="..."></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <!-- pie de la pagina--> 
    <?php 
    include ("footer.php");
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
