<?php
if(!isset($_SESSION)){
    session_start();
}

include("./includes/login.php");

if(isset($_POST["enviar"])){
    
    header("location:./?sug");
}
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
            <form action="" method="post" class="form">
                <div class="container">
                    <label for="code">Nombre</label>
                    <input type="text" name="nombre" placeholder="Su nombre" required autocomplete="off">
                </div>
                <div class="container">
                    <label for="name">Apellido</label>
                    <input type="text" name="apellido" placeholder="Su apellido" required autocomplete="off">
                </div>
                <div class="container">
                    <label for="descri">Pregunta</label>
                    <textarea name="pregunta" id="" cols="30" rows="10" placeholder="Descripcion"></textarea>
                </div>
                <div class="container">
                    <input type="submit" name="enviar" value="Enviar" class="ok">
                </div>
            </form>
            <?php
            include_once("./includes/loginmodal.php");
            require_once("./includes/sweetalertas.php");
            ?>
        </main>
        <?php include("./includes/foot.php"); ?>
    </body>
</html>