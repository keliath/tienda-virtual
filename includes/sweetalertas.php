<?php
if(isset($_GET["sec"])){
    echo "<script> alerta('Error en login', 'Usuario no autorizado', 'error'); </script>";
}
if(isset($_GET["verif"])){
    echo "<script> alerta('Error en login', 'Usuario no verificado', 'error'); </script>";
}
if(isset($_GET["err"])){
    echo "<script> alerta('Error en login', 'Usuario no registrado o no verificado', 'error'); </script>";
}
if(isset($_GET["sug"])){
    echo "<script> alerta('Listo', 'Hemos recibido comentario', 'success'); </script>";
}
if(isset($_GET["war"])){
    echo "<script> alerta('Error', 'Debe tener una sesion iniciada para poder realizar la compra', 'error'); </script>";
}
if(isset($_GET["cok"])){
    echo "<script> alerta('Listo', 'Se ha añadido al carrito el producto', 'success'); </script>";
}
if(isset($_GET["cfa"])){
    echo "<script> alerta('Error', 'Ha habido un error en la confirmacion', 'error'); </script>";
}
if(isset($_GET["comok"])){
    echo "<script> alerta('Exito', 'La compra se ha realizado', 'success'); </script>";
}

if(isset($_GET["reg"])){
    switch($_GET["reg"]){
        case 0:
            echo "<script> alerta('Error en registro', 'No se pudo registrar correctamente', 'error'); </script>";
            break;
        case 1:
            echo "<script> alerta('Registro exitoso', 'Revise su correo para confirmar su registro', 'success'); </script>";
            break;
        case 2:
            echo "<script> alerta('Error en registro', 'No se pudo enviar email de activación', 'error'); </script>";
            $sql_fail = sprintf("DELETE FROM usuarios where usu_mail = %s",
                                valida::convertir($mysqli, $mail, "text"));
            $q_fail = mysqli_query($mysqlo, $sql_fail);
            break;
        case 3:
            echo "<script> alerta('Registro exitoso', 'Revise su correo para confirmar su registro', 'success'); </script>";
            break;
    }
}

if(isset($_GET["npro"])){
    switch($_GET{"npro"}){
        case 0:
            echo "<script> alerta('Error', 'No se pudo registrar el producto', 'error'); </script>";
            break;
        case 1:
            echo "<script> alerta('Exito', 'El producto fue registrado correctamente', 'success'); </script>";
            break;
    }
}

if(isset($_GET["com"])){
    switch($_GET{"com"}){
        case 0:
            echo "<script> alerta('Error', 'No se pudo comprar el producto', 'error'); </script>";
            break;
        case 1:
            echo "<script> alerta('Exito', 'El producto fue registrado correctamente', 'success'); </script>";
            break;
    }
}

if(isset($_GET["pag"])){
    switch($_GET{"pag"}){
        case 0:
            echo "<script> alerta('Error', 'No se pudo realizar el pago de la compra', 'error'); </script>";
            break;
        case 1:
            echo "<script> alerta('Exito', 'El pago se realizo correctamente', 'success'); </script>";
            break;
    }
}