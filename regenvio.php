<?php
if(!isset($_SESSION)){
    session_start();
}else{
    $user = $_SESSION["nivel"];
}

require_once("./clases/security.php");
require_once("./includes/login.php");
$user = $_SESSION["user"];

if(isset($_POST["guardar"])){
    $sql_direnvio = sprintf("insert into denvio (usu_mail, den_provin, den_ciudad, den_direcc, den_telefo) values (%s, %s, %s, %s, %s)",
                            valida::convertir($mysqli, $user, "text"),
                            valida::convertir($mysqli, $_POST["provin"], "text"),
                            valida::convertir($mysqli, $_POST["ciudad"], "text"),
                            valida::convertir($mysqli, $_POST["direccion"], "text"),
                            valida::convertir($mysqli, $_POST["telefono"], "text"));
    $q_direnvio = mysqli_query($mysqli, $sql_direnvio)or die (mysqli_error($mysqli));
    header("location:./payprocess.php");
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
            <div class="container">
                <di class="row">
                    <form action="" method="post" class="form">
                        <div class="container">
                            <input type="text" name="provin" placeholder="Ingrese la provincia">
                        </div>
                        <div class="container">
                            <input type="text" name="ciudad" placeholder="Ingrese la provincia">
                        </div>
                        <div class="container">
                            <input type="text" name="direccion" placeholder="Ingrese la provincia">
                        </div>
                        <div class="container">
                            <input type="text" name="telefono" placeholder="Ingrese la provincia"></div>
                        <div class="container"></div>
                        <div class="container">
                             <input type="submit" class="ok" name="guardar" value="Guardar">
                        </div>
                       
                    </form>
                </di>
            </div>
        </main>
        <?php
        include_once("./includes/loginmodal.php");
        require_once("./includes/sweetalertas.php");
        include("./includes/foot.php"); 
        ?>

    </body>
</html>