<?php  //script para mostrar los productos
require_once("./clases/conexion.php");

if(!isset($_SESSION)){
    $user = $_SESSION["user"];
}

$sql_mostrar = sprintf("SELECT d.pro_codigo, pro_nombre, pro_img,pro_catego, sum(com_cantid) - sum(ifnull(ven_cantid,0)) - sum(ifnull(car_cantid,0)) as stock from (select sum(com_cantid) com_cantid, pro_codigo, id_compra from compras group by pro_codigo) a left join (select sum(ven_cantid) ven_cantid, id_compra from ventas group by id_compra) b on a.id_compra = b.id_compra left join (select sum(car_cantid) car_cantid, pro_codigo from carrito group by pro_codigo) c on a.pro_codigo = c.pro_codigo inner join producto d on a.pro_codigo = d.pro_codigo group by d.pro_codigo");

if(isset($_GET["cat"])){
    if($_GET["cat"] === "per"){
        $sql_mostrar = "SELECT d.pro_codigo, pro_catego, pro_nombre, pro_img, sum(com_cantid) - sum(ifnull(ven_cantid,0)) - sum(ifnull(car_cantid,0)) as stock from (select sum(com_cantid) com_cantid, pro_codigo, id_compra from compras group by pro_codigo) a left join (select sum(ven_cantid) ven_cantid, id_compra from ventas group by id_compra) b on a.id_compra = b.id_compra left join (select sum(car_cantid) car_cantid, pro_codigo from carrito group by pro_codigo) c on a.pro_codigo = c.pro_codigo inner join producto d on a.pro_codigo = d.pro_codigo where pro_catego = 'perfumes' group by d.pro_codigo";
    }elseif($_GET["cat"] === "aro"){
        $sql_mostrar = "SELECT d.pro_codigo, pro_catego, pro_nombre, pro_img, sum(com_cantid) - sum(ifnull(ven_cantid,0)) - sum(ifnull(car_cantid,0)) as stock from (select sum(com_cantid) com_cantid, pro_codigo, id_compra from compras group by pro_codigo) a left join (select sum(ven_cantid) ven_cantid, id_compra from ventas group by id_compra) b on a.id_compra = b.id_compra left join (select sum(car_cantid) car_cantid, pro_codigo from carrito group by pro_codigo) c on a.pro_codigo = c.pro_codigo inner join producto d on a.pro_codigo = d.pro_codigo where pro_catego = 'ambientadores' group by d.pro_codigo ";
    }
}




$q_mostrar = mysqli_query($mysqli, $sql_mostrar);

if($q_mostrar){ 
    echo "<div class = 'contenedor'>";
    while($r_mostrar = mysqli_fetch_assoc($q_mostrar)){
        $titulo = $r_mostrar["pro_nombre"];
        $codigo = $r_mostrar["pro_codigo"];
        $stock = $r_mostrar["stock"];
        $img = $codigo. "." .$r_mostrar["pro_img"];
        if(isset($_SESSION["nivel"])){
            if($_SESSION["nivel"] == "admin"){
                echo (sprintf("<div class='producto'>
            <span class='titulo'>%s</span>
            <a href = './comprapro.php?cod=%s' class = 'vista' id='abrirno'><img class='pimg' src='./images/productos/%s' alt='Algo salio mal xd'></a>
            </div>",
                              $titulo,
                              $codigo,
                              $img));
            }else{
                if($stock >0){
                    echo (sprintf("<div class='producto'>
            <span class='titulo'>%s</span>
            <a href = './venta.php?cod=%s' class = 'vista' id='abrirno'><img src='./images/productos/%s' alt='Algo salio mal xd'></a>
            </div>",
                                  $titulo,
                                  $codigo,
                                  $img));
                }
            }
        }else{
            if($stock >0){
                echo (sprintf("<div class='producto'>
            <span class='titulo'>%s</span>
            <a href = './venta.php?cod=%s' class = 'vista' id='abrirno'><img src='./images/productos/%s' alt='Algo salio mal xd'></a>
            </div>",
                              $titulo,
                              $codigo,
                              $img));
            }
        }
    }
    echo "</div>";
}
