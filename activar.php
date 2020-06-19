<?php
require_once("./clases/valida.php");
require_once("./clases/conexion.php");
include("./includes/login.php");

$activa = false;

if(isset($_GET["cod"])){
    $code = $_GET["cod"];
    $sql_activa = sprintf("SELECT * FROM usuarios where usu_vercod = %s",
                          valida::convertir($mysqli, $code, "text"));
    $q_activa = mysqli_query($mysqli, $sql_activa);
    $r_activa = mysqli_num_rows($q_activa);

    if($r_activa === 1){
        $sql_valido = sprintf("UPDATE usuarios SET usu_activa = 1 where usu_vercod = %s",
                              valida::convertir($mysqli, $code, "text"));
        $q_valido = mysqli_query($mysqli, $sql_valido);
        $activa = true;
    }   
}
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Activación</title>
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
            if($activa){
                echo "Cuenta Activada";
            }else{
                echo "Error en activación de la cuenta";
            }
            ?>
            <?php
            include_once("./includes/loginmodal.php");
            require_once("./includes/sweetalertas.php");
            ?>
        </main>

        <?php include("./includes/foot.php"); ?>
    </body>
</html>