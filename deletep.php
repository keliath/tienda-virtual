<?php
require_once("./clases/conexion.php");

$id = $_GET['id'];

$sql_pre = "select pro_codigo from carrito where md5(id_carrit) = '$id' limit 1";
$q_pre = mysqli_query($mysqli, $sql_pre);
$r_pre = mysqli_fetch_assoc($q_pre);
$pro = $r_pre['pro_codigo'];

$sql_del = sprintf("Delete from carrito where pro_codigo = '$pro'");
$q_del = mysqli_query($mysqli, $sql_del);
header("location:./carrito.php");