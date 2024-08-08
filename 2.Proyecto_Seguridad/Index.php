<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<link rel="stylesheet" type="text/css" href="{% static 'css/w3.css' %}">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>index</title>
</head>
<body>
    <!-- cabeza de la pagina--> 
    <?php 
    
    include ("header.php");

    ?>
    <!-- cuerpo de la pagina-->   
   
    <main>
        <section id="banner">
            <img src="imagen/perro.jpg">
            <div class="contenedor">
                <h2>Mascotas y niños felices</h2>
                <p>¿Cuál es la mejor mascota para usted?</p>
                <a href="agregarMascota.php">agregar tu mascota</a>
            </div>
        </section>
            
        <section id="bienvenidos">
            <div class="contenedor">
                <h2>BIENVENIDOS A NUESTRO CLUB</h2>
                <p>“El perro es el único ser en el mundo que te amará más de lo que se ama a sí mismo”, John Billings.</p>
            </div>
        </section>
            
        
         <!-- carrusel--> 
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="imagen/publicidad.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="imagen/publicidad2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="imagen/publicidad3.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>  
        </div>
        <!-- seccion de imagenes perritos-->      
        <section id="info">
            <h3>Para muchos de nosotros las mascotas no son simples compañeros, son miembros de la familia.</h3>
            <div class="contenedor">
                <div class="info-pet">
                    <img src="imagen/max.jpg" alt="">
                    <h4>Max</h4>
                </div>
                <div class="info-pet">
                    <img src="imagen/jerry.jpg" alt="">
                    <h4>Jerry</h4>
                </div>
                <div class="info-pet">
                    <img src="imagen/tom.jpg" alt="">
                    <h4>Tom</h4>
                </div>
                <div class="info-pet">
                    <img src="imagen/sam.jpg" alt="">
                    <h4>Sam</h4>
                </div>
            </div>
        </section>
       
    </main>



    <!-- pie de la pagina--> 
    <?php 
    include ("footer.php");
    ?>
 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>