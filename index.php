<?php
if(!isset($_SESSION)){
    session_start();
}

/* sin implementacion de autenticacion con tokens en login y limpieza de queris para evitar sql inyection */
include("./includes/login.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Tienda</title>
        <?php
        include_once("./includes/headconf.php");
        ?>
    </head>
    <body>
        <?php
        include("./includes/head.php");
        include("./includes/menu.php");
        ?>
        <main>
            <!-- Slideshow container -->
        <?php
        include_once("./funciones/verpro.php");
        include_once("./includes/loginmodal.php");
        require_once("./includes/sweetalertas.php");
        ?>
        </main>
    <?php
    include("./includes/foot.php");
    ?>
    <script>
        var slideIndex = 0;

        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none"; 
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1} 
            slides[slideIndex-1].style.display = "block"; 
            setTimeout(showSlides, 3000); 
        }
    </script>
    </body>
</html>