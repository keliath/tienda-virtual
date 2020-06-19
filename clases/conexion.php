<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "protienda";

$userO = "proyectsistemas_aro";
$passO = "proyectsistemas_aro";
$dbO = "proyectsistemas_aro";

$hol = 0;

if($hol == 1){
    $mysqli = mysqli_connect($host, $userO, $passO, $dbO);
}else{
    $mysqli = mysqli_connect($host, $user, $pass, $db);
}


if(!$mysqli){
    
}