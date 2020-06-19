<?php
if(!isset($_SESSION)){
    session_start();
}else{
    $user = $_SESSION["nivel"];
}

require_once("./clases/security.php");
require_once("./includes/login.php");

$sql_procan1 = sprintf("select id_carrit, pro_nombre, sum(car_cantid) cantidad, com_pvp, (sum(car_cantid)* com_pvp) sub from carrito a inner join producto b on a.pro_codigo = b.pro_codigo inner join (select * from compras group by pro_codigo order by pro_codigo desc) c on b.pro_codigo = c.pro_codigo where usu_mail = %s group by b.pro_codigo",
                      valida::convertir($mysqli, $_SESSION["user"], "text"));
$q_procan1 = mysqli_query($mysqli, $sql_procan1) or die (mysqli_error($mysqli));
$r_procan1 = mysqli_fetch_assoc($q_procan1);

if(isset($_POST["confirmar"])){
    $sql_pago = "";
    $q_pago = mysqli_query($mysqli, $sql_pago);
    
    if($q_pago){
        header("location:./enviodeta.php");
    }else{
        header("location:./?cfa");
    }
    
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
           <?php
                if(mysqli_num_rows($q_procan1) > 0){
                    ?>
            <div class="container ">
              
               <table class="tabla">
                   <thead>
                       <tr>
                           <th>Cantidad</th>
                           <th>Detalle</th>
                           <th>V.U</th>
                           <th>Sub Total</th>
                           <th>Opciones</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                        $total = 0;
                        $pago = [];
                        $acc = 0;
                       do{
                           $id = md5($r_procan1["id_carrit"]);
                           $cant = $r_procan1["cantidad"];
                           $pro = $r_procan1["pro_nombre"];
                           $vu = $r_procan1["com_pvp"];
                           $sub = number_format($r_procan1["sub"],2);
                           $total += $sub;
                           $total = number_format($total,2);
                           $pago[$acc]=array("product_name"=>"$pro","product_quantity"=>"$cant","product_price"=>"$vu");
                           
                           $acc ++;
                            
                           echo "<tr>
                                <td>$cant</td>
                                <td>$pro</td>
                                <td>$$vu</td>
                                <td>$$sub</td>
                                <td class='td'>
                                    <a href='deletep.php?id=$id'>
                                        <i class='fa fa-trash' aria-hidden='true'></i>
                                    </a>
                                </td>
                           </tr>";
                       }while($r_procan1 = mysqli_fetch_assoc($q_procan1));
                        $_SESSION["cart"]=$pago;
                       echo "<tr>
                                <td colspan='3' align=right><b>Total:</b></td>
                                <td>$$total</td>
                       </tr>";
                    $mail = $_SESSION["user"];
                    $sql_envio = "select * from denvio where usu_mail = '$mail' order by usu_mail desc limit 1";
                    $q_envio = mysqli_query($mysqli, $sql_envio)or die(mysqli_error($mysqli));
                    if(mysqli_num_rows($q_envio) > 0){
                        $ad = "./payprocess.php";
                    }else{
                        $ad = "./regenvio.php";
                    }
                       ?>
                   </tbody>
                   
               </table>
               
            </div>
            <div class="container">
                            <a href="<?php echo $ad;?>" class="ok" name="confirmar" style="text-decoration:none" target="_blank">Confirmar Compra</a>
            </div>
               <?php
                }else{
                    echo "<center><span class='btne'>no se ha anadido productos</span></center>";
                }?>
        </main>
        <?php
        include_once("./includes/loginmodal.php");
        require_once("./includes/sweetalertas.php");
        include("./includes/foot.php"); 
        ?>

    </body>
</html>