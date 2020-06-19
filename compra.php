<?php
require_once("./clases/securityad.php");
require_once("./includes/login.php");

$sql_prods = "select  * from producto";
$q_prods = mysqli_query($mysqli, $sql_prods);
$r_prods = mysqli_fetch_assoc($q_prods);

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
               <form action="" class="form">
                   <input type="text" name="search" id="search" oninput="ajax('./funciones/ajax.php','productos', this)" placeholder="Ingrese el codigo del producto que desea buscar">
               </form>
            </div>
            <div id="productos">
                
            </div>
           <?php
            require_once("./includes/sweetalertas.php");
            ?>
            
        </main>

    </body>
</html>