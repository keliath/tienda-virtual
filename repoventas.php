<?php
require_once("./clases/securityad.php");
require_once("./includes/login.php");
if(!isset($_SESSION)){
    session_start();
}else{
    $user = $_SESSION["nivel"];
}
$stock = 0;
$sql_mostrar = sprintf("select a.id_compra,usu_mail, pro_nombre, cantidad , com_pvp, (cantidad * com_pvp) total, ven_fecha from (SELECT sum(ven_cantid) cantidad,id_compra, usu_mail, ven_fecha FROM `ventas` group by usu_mail) a inner join compras b on a.id_compra = b.id_compra inner join producto c on b.pro_codigo = c.pro_codigo");

$q_mostrar = mysqli_query($mysqli, $sql_mostrar) or die("error: ".mysqli_error($mysqli));
$r_mostrar = mysqli_fetch_assoc( $q_mostrar);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administracion</title>
        <?php
        include_once("./includes/headconf.php");
        ?>
    </head>
    <body class="main">
        <?php
        include("./includes/head.php");
        include("./includes/menuad.php");
        ?>

        <main>
            <div class="container">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>V.U</th>
                            <th>Total</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        do{
                            $cant = $r_mostrar["cantidad"];
                            $pro = $r_mostrar["pro_nombre"];
                            $vu = $r_mostrar["com_pvp"];
                            $cli = $r_mostrar["usu_mail"];
                            $total = $cant * $vu; 
                            $fecha = $r_mostrar["ven_fecha"];
                            echo "<tr>
                                <td>$cli</td>
                                <td>$pro</td>
                                <td>$cant</td>
                                <td>$vu</td>
                                <td>$total</td>
                                <td>$fecha</td>
                           </tr>";
                        }while($r_mostrar = mysqli_fetch_assoc($q_mostrar));
                        echo "<tr>
                       </tr>"
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
                            require_once("./includes/sweetalertas.php");
            ?>
        </main>

        <?php
        include_once("./includes/sweetalertas.php");
        ?>
    </body>
</html>