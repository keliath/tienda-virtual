<?php
if(!isset($_SESSION)){
    session_start();
}else{
    $user = $_SESSION["nivel"];
}

require_once("./includes/login.php");

$sql_prods = "select  * from producto a inner join compras b on a.pro_codigo = b.pro_codigo";
$q_prods = mysqli_query($mysqli, $sql_prods);
$r_prods = mysqli_fetch_assoc($q_prods);

$codigo = $_GET["cod"];

$sql_stock = sprintf("SELECT sum(com_cantid) - sum(ifnull(ven_cantid,0)) - sum(ifnull(car_cantid,0)) as stock from (select sum(com_cantid) com_cantid, pro_codigo, id_compra from compras group by pro_codigo) a left join (select sum(ven_cantid) ven_cantid, id_compra from ventas group by id_compra) b on a.id_compra = b.id_compra left join (select sum(car_cantid) car_cantid, pro_codigo from carrito group by pro_codigo) c on a.pro_codigo = c.pro_codigo where a.pro_codigo = %s",
                        valida::convertir($mysqli, $codigo, "text"));
$q_stock = mysqli_query($mysqli, $sql_stock);
$r_stock = mysqli_fetch_assoc($q_stock);

$stock = $r_stock["stock"];
$img = $codigo .".". $r_prods["pro_img"];
$name = $r_prods["pro_nombre"];
$descri = $r_prods["pro_descri"];

if(isset($_POST["comprar"])){
    if(isset($_SESSION["nivel"])){
        $sql_carro = sprintf("INSERT INTO carrito (usu_mail, pro_codigo, car_cantid) values (%s, %s, %s)",
                            valida::convertir($mysqli, $_SESSION["user"], "text"),
                            valida::convertir($mysqli, $codigo, "text"),
                            valida::convertir($mysqli, $_POST["cantid"], "text"));
        
        $q_carro = mysqli_query($mysqli, $sql_carro);
        
        header("location:./?cok");
    }else{
        header("location:./?war");
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
        <script>
            function inversion(obj){
                var can = obj.value;
                var pvp = <?php echo $r_prods["com_pvp"]?>;
                var total = can * pvp;
                document.getElementById('inv').innerHTML = "$"+total;
            }
        </script>
    </head>
    <body>
        <?php
        include("./includes/head.php");
        include("./includes/menu.php");
        ?>

        <main>
            <div class="container">
                <div class="row">
                    <div class="form-comprar-img">
                        <img class="vista" src="./images/productos/<?php echo $img;?>" alt="perfume/aromatizante <?php echo $name?>">
                    </div>
                    <div class="form-comprar">
                        <form action="" class="" method="post">
                            <input type="submit" name="comprar" class="ok" value="Añadir al carro">
                            <input type="number" id="cantid" name="cantid" placeholder="Cantidad" min="1" max="<?php echo $stock?>" oninput="inversion(this)" required>
                            <label for="number">Disponibles: <span><?php echo $stock;?></span></label>
                            <label for="">Inversión: <span id="inv"></span></label>
                        </form>
                    </div>
                </div>
                <div class="row descrip">
                  <label for="">Precio: </label>
                   <span id="precio"><?php echo $r_prods["com_pvp"]?></span>
                    <br>
                    <h3>Descripcion del Producto:</h3>
                    <p>
                        <?php echo $descri;?>
                    </p>
                </div>
            </div>
        </main>
        <?php
        include_once("./includes/loginmodal.php");
        require_once("./includes/sweetalertas.php");
        include("./includes/foot.php"); 
        ?>


    </body>
</html>