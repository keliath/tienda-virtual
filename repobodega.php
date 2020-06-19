<?php
require_once("./clases/securityad.php");
require_once("./includes/login.php");
if(!isset($_SESSION)){
    session_start();
}else{
    $user = $_SESSION["nivel"];
}
$stock = 0;
$sql_mostrar = sprintf("SELECT d.pro_codigo,com_pvp, pro_nombre, pro_catego, sum(com_cantid) - sum(ifnull(ven_cantid,0)) as stock from (select sum(com_cantid) com_cantid,com_pvp, pro_codigo, id_compra from compras group by pro_codigo) a left join (select sum(ven_cantid) ven_cantid, id_compra from ventas group by id_compra) b on a.id_compra = b.id_compra inner join producto d on a.pro_codigo = d.pro_codigo group by d.pro_codigo");

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
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        do{
                            $cant = $r_mostrar["stock"];
                            $pro = $r_mostrar["pro_nombre"];
                            $vu = $r_mostrar["com_pvp"];
                            $stock += $cant; 
                            echo "<tr>
                                <td>$pro</td>
                                <td>$cant</td>
                           </tr>";
                        }while($r_mostrar = mysqli_fetch_assoc($q_mostrar));
                        echo "<tr>
                                <td colspan='3' align=right><b>Total Stock: $stock</b></td>
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