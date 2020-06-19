<?php
require_once("../clases/conexion.php");
require("../clases/security.php");
require("../clases/valida.php");
if(!isset($_SESSION)){
    session_start();
}

$cod = '%'.$_POST["usu"].'%'; //nombre del producto 
$tabla = "";//tabla del pdf

$sql_reporte = sprintf("SELECT * FROM producto where pro_codigo like %s order by pro_codigo DESC",
                       valida::convertir($mysqli, $cod, "text"));
$q_reporte = mysqli_query($mysqli, $sql_reporte) or die ("error: ".mysqli_error($mysqli));
$t_reporte = mysqli_num_rows($q_reporte);

echo "<div class = 'contenedor'>";
if($t_reporte != 0){ 
    while($r_reporte = mysqli_fetch_assoc($q_reporte)){
        $titulo = $r_reporte["pro_nombre"];
        $img = $r_reporte["pro_codigo"]. "." .$r_reporte["pro_img"];
        echo (sprintf("<div class='producto'>
            <span class='titulo'>%s</span>
            <a href = './comprapro.php?cod=%s' class = 'vista' id='abrirno'><img class='pimg' src='./images/productos/%s' alt='Algo salio mal xd'></a>
            </div>",
                      $titulo,
                      $r_reporte["pro_codigo"],
                      $img));
    }
    
}else{
        echo "No se han encontrado resultados :(";
    }
echo "</div>";


/*$sql_datos = sprintf("select pro_img, pro_descri, com_pvp, com_cantid from producto a inner join compras b on a.pro_codigo = b.pro_codigo where pro_codigo = %s",
                     valida::convertir($mysqli, $codigo, "text"));
$sql_datos = "select * producto where pro_codigo = $codigo"; 
$q_datos = mysqli_query($mysqli, $sql_datos) or die(mysqli_error($mysqli));
$r_datos = mysqli_fetch_assoc($q_datos);
$ext = $r_datos["pro_img"];
$descri = $r_datos["pro_descri"];

$img = $codigo .".". $ext;
echo "<javascript>alert('sad')</javascript>";exit;
$content = sprintf("
        <div class='login container '>
                <img src='./images/productos/%s' alt='' class='proimg'>
                <input type='text' id='idimg'>
                <label for='precio' class='propre'>Precio: 33</label>
            </div>

            <div>
                <input type='submit' name='comprar' class='ok' value='Comprar'>
            </div>
            <div>
                <p>%s</p>
        </div>",
            $img,
            $descri);

echo $content;
*/