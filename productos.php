<?php
if(!isset($_SESSION)){
    session_start();
}
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
            <?php
            include("./funciones/verpro.php");
            
            ?>
        </main>
        <?php
        include_once("./includes/loginmodal.php");
        include_once("./includes/viewpromodal.php");
        require_once("./includes/sweetalertas.php");
        include("./includes/foot.php"); 
        ?>


    </body>
</html>