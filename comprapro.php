<?php
require_once("./clases/securityad.php");
require_once("./includes/login.php");

$sql_prods = "select  * from producto";
$q_prods = mysqli_query($mysqli, $sql_prods);
$r_prods = mysqli_fetch_assoc($q_prods);

$codigo = $_GET["cod"];

$sql_producto = sprintf("SELECT pro_nombre FROM producto where pro_codigo = %s",
                        valida::convertir($mysqli, $codigo, "text"));
$q_producto = mysqli_query($mysqli, $sql_producto);
$r_producto = mysqli_fetch_assoc($q_producto);

if(isset($_POST["comprar"])){
    $date = date("Y-m-d");
    $sql_comprar = sprintf("INSERT INTO compras (pro_codigo, com_precio, com_pvp, com_cantid, com_fecha) VALUES 
    (%s, %s, %s, %s, %s)",
                           valida::convertir($mysqli, $codigo, "text"),
                           valida::convertir($mysqli, $_POST["precio"], "double"),
                           valida::convertir($mysqli, $_POST["pvp"], "double"),
                           valida::convertir($mysqli, $_POST["cantidad"], "int"),
                           valida::convertir($mysqli, $date, "date"));
    $q_comprar = mysqli_query($mysqli, $sql_comprar);

    if($q_comprar){
        header("location:./admin.php?com=1");
    }else{
        header("location:./admin.php?com=0");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administracion</title>
        <?php
        include_once("./includes/headconf.php");
        ?>
        <script>
        function nomenor(){
            var pvp = document.getElementById('pvp');
            var precio = parseFloat(document.getElementById('precio').value);
            var pvpval = parseFloat(pvp.value);
            if(pvpval < precio){
                pvp.focus();
                document.getElementById('pvperr').innerHTML = "El precio al publico no puede ser menor al de fabrica";
               }else{
                   document.getElementById('pvperr').innerHTML = " ";
               }
        }
        </script>
    </head>
    <body class="main">
        <?php
        include("./includes/head.php");
        include("./includes/menuad.php");
        ?>

        <main>
            <form action="" method="post" class="form" enctype="multipart/form-data">
                <div class="container">
                    <label for="name">Nombre del producto</label>
                    <input type="text" name="name" placeholder="Nombre del producto" value="<?php echo $r_producto["pro_nombre"];?>" readonly required>
                </div>
                <div class="container">
                    <label for="precio">Precio de fabrica:</label>
                    <input type="number" id="precio" name="precio" autocomplete="off" required>
                </div>
                <div class="container">
                    <label for="pvp">Precio de venta al publico:</label>
                    <input type="number" id="pvp" name="pvp" onblur="nomenor()" autocomplete="off" required>
                    <div id="pvperr" class="error peq">
                        
                    </div>
                </div>
                <div class="container">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" autocomplete="off" required>
                </div>

                <div class="container">
                    <input type="submit" name="comprar" class="ok" value="Comprar">
                </div>
            </form>

            <?php
            require_once("./includes/sweetalertas.php");
            ?>

        </main>

        <script>
            
        </script>
    </body>
</html>