<?php
if(!isset($_SESSION)){
    session_start();
}else{
    $user = $_SESSION["nivel"];
}

require_once("./clases/security.php");
require_once("./includes/login.php");

$user = $_SESSION["user"];
$facco = "factura" . $user;
$facco = md5($facco);
if(isset($_GET["faco"]) and $_GET["faco"]  == $facco ){
    $date = date("Y-m-d");
    $sql_fac = sprintf("insert into factura(usu_mail,fac_pagado, fac_fecha) values(%s, 1, %s)",
                       valida::convertir($mysqli, $user, "text"),
                       valida::convertir($mysqli, $date, "date"));
    $q_fac = mysqli_query($mysqli, $sql_fac);

    $sql_procan1 = sprintf("select id_carrit,id_compra, pro_nombre, sum(car_cantid) cantidad, com_pvp, (sum(car_cantid)* com_pvp) sub from carrito a inner join producto b on a.pro_codigo = b.pro_codigo inner join (select * from compras group by pro_codigo order by pro_codigo desc) c on b.pro_codigo = c.pro_codigo where usu_mail = %s group by b.pro_codigo",
                           valida::convertir($mysqli, $user, "text"));
    $q_procan1 = mysqli_query($mysqli, $sql_procan1) or die (mysqli_error($mysqli));

    while($r_procan1 = mysqli_fetch_assoc($q_procan1)){
        $idCompra = $r_procan1["id_compra"];
        $venCan = $r_procan1["cantidad"];
        $sql_ventas = sprintf("insert into ventas (id_compra, usu_mail, ven_fecha, ven_cantid) values (%s, %s, %s, %s)",
                              valida::convertir($mysqli, $idCompra, "int"),
                              valida::convertir($mysqli, $user, "text"),
                              valida::convertir($mysqli, $date, "text"),
                              valida::convertir($mysqli, $venCan, "int"));
        $q_ventas = mysqli_query($mysqli, $sql_ventas) or die(mysqli_error($q_ventas));
    }

    $sql_deltem = "delete from carrito where usu_mail = '$user'";
    $q_deltem = mysqli_query($mysqli, $sql_deltem);

    $mail = $_SESSION["user"];
    $sql_envio = "select * from denvio where usu_mail = '$mail' order by usu_mail desc limit 1";
    $q_envio = mysqli_query($mysqli, $sql_envio)or die(mysqli_error($mysqli));
    $r_envio = mysqli_fetch_assoc($q_envio);
    
    $template=file_get_contents("templates/envio.html");
	
	$diccionario=array(
		'**nombre**'=>$r_envio['usu_mail'],
		'**cedula**'=>$r_envio['den_provin'],
		'**email**'=>$r_envio['den_ciudad'],
		'**fono**'=>$r_envio['den_direcc'],
		'**h3**'=>$r_envio['den_telefo']
	);
	foreach($diccionario as $clave=>$valor){
		$template=str_replace($clave, $valor, $template);
	}
	
	require_once("html2pdf/html2pdf.class.php");
	$pdf=new HTML2PDF();
	$pdf->writeHTML($template);
	$cedula=$r_envio['id_denvio'];
	if(!file_exists('pdfs')){
		mkdir('pdfs');
	}
	$path="./pdfs/$cedula.pdf";
	$pdf->Output($path,'F');
	
	echo"<a href='$path'target='_blank'><img src='./images/pdf.png' width='100px'></a>";
}else{
    header("location:./?sec"); 
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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Pago realizado exitosamente</h1>
                    <a href="./?comok" class="btn btn-default">Regresar</a>
                </div>

            </div>
        </div>

    </body>
</html>