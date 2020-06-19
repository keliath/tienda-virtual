<?php
require_once("./clases/conexion.php");
require_once("./clases/securityad.php");
require("./clases/valida.php");

if(isset($_POST["guardar"])){
    $tmpName = $_FILES["file"]["tmp_name"];
    $partes = $_FILES["file"]["name"];
    $partes = explode(".", $partes);
    $ext = end($partes);

    $date = date("Y-m-d");

    $sql_guardar = sprintf("INSERT INTO producto VALUES (%s, %s, %s, %s, %s, %s)",
                           valida::convertir($mysqli, $_POST["code"], "text"),
                           valida::convertir($mysqli, $_POST["name"], "text"),
                           valida::convertir($mysqli, $_POST["descri"], "text"),
                           valida::convertir($mysqli, $ext, "text"),
                           valida::convertir($mysqli, $_POST["cat"], "text"),
                           valida::convertir($mysqli, $date, "date"));
    $q_guardar = mysqli_query($mysqli, $sql_guardar) or die(mysqli_error($mysqli));

    if($q_guardar){
        $carpetaDestino = "./images/productos/";
        $nombre = $_POST["code"] . "." .$ext;
        $destino = $carpetaDestino . $nombre;
        move_uploaded_file($tmpName, $destino);
        header("location:./admin.php?npro=1");
    }else{
        header("location:./admin.php?npro=0");
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
    </head>
    <body class="main">
        <?php
        include("./includes/head.php");
        include("./includes/menuad.php");
        ?>
        <main>
            <form action="" method="post" class="form" enctype="multipart/form-data">
                
                <div class="container">
                    <label for="code">Codigo del producto</label>
                    <input type="text" name="code" placeholder="Codigo del producto" required >
                </div>
                <div class="container">
                    <label for="name">Nombre del producto</label>
                    <input type="text" name="name" placeholder="Nombre del producto" required>
                </div>
                <div class="container">
                    <label for="cat">Seleccione la Categoria</label>
                    <select name="cat" id="cat" required>
                        <option value="">Seleccionar categoria</option>
                        <option value="ambientadores">Ambietadores</option>
                        <option value="perfumes">Perfumes</option>
                    </select>
                </div>
                <div class="container">
                    <label for="name">Imagen del producto</label>
                    <input type="file" name="file" accept="image/x-png, image/jpeg, image/gif " required>
                </div>
                <div class="container">
                    <label for="descri">Descripcion del producto</label>
                    <textarea name="descri" id="" cols="30" rows="10" placeholder="Descripcion"></textarea>
                </div>
                <div class="container">
                    <input type="submit" name="guardar" class="ok" value="Guardar">
                </div>
            </form>

           <?php
            require_once("./includes/sweetalertas.php");
            ?>
            
        </main>
    </body>
</html>