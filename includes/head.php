<?php
if(isset($_SESSION["user"])){
    $sql_procan = sprintf("select id_carrit,pro_codigo, sum(car_cantid), usu_mail from carrito where usu_mail = %s   group by pro_codigo",
                         valida::convertir($mysqli, $_SESSION["user"], "text"));
    $q_procan = mysqli_query($mysqli, $sql_procan);
    $r_procan = mysqli_fetch_assoc($q_procan);
    $n = mysqli_num_rows($q_procan);
    if($n > 0){
        $add = "<div class='carro'>$n</div>";
    }else{
        $add = "";
    }
    echo ("
    <header>
        <div>
            <a href='./'><img src='./images/logo2.png' alt='logo perfumes y aromatizantes'></a>
        </div>
        <div>
            <span class='log' id = ''><i id='car' class='fa fa-shopping-cart' aria-hidden='true' style='margin-right:10px;'>$add</i><pan id='close'>Cerrar Sesion</span</span>
        </div>
    </header>
    ");
}else{
    echo ("
    <header>
        <div>
            <a href='./'><img src='./images/logo2.png' alt='logo perfumes y aromatizantes'></a>
        </div>
        <div>
            <span class='log' id='login'>Iniciar sesion</span>
        </div>
    </header>
    ");
}
?>


<script>
    var close = document.getElementById('close');
    var carrito = document.getElementById('car');
    carrito.onclick = function(){
         window.location = "./carrito.php";
    }
    close.onclick = function(){
        window.location = "./clases/close.php";
    }
</script>