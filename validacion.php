<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    /*Recuperando conexion*/
    require_once('baseDatos.php');
    $bd = BaseDeDatos::getInstancia();
    $conexion = $bd -> getConexion();

    $usuario = htmlentities(addslashes($_POST['usuario']));
    $contra = htmlentities(addslashes($_POST['contrasenia']));

    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $consulta = $conexion -> prepare("SELECT * FROM usuarios WHERE nombreUsuario=:usuario AND contrasenia=:contra");

    $consulta -> bindValue(":usuario", $usuario);
    $consulta -> bindValue(":contra", $contra);
    $consulta -> execute();

    $numero_registro = $consulta -> rowCount();

    if($numero_registro != 0){
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        $poner_nom = "SELECT nombre_Apellido FROM `usuarios` WHERE nombreUsuario = '$usuario'";
        $poner_id = "SELECT id_usuario FROM `usuarios` WHERE nombreUsuario = '$usuario'";
                $sql = $conexion -> query($poner_nom);
                $sql2 = $conexion -> query($poner_id);
                $fila = $sql->fetch();
                $fila2 = $sql2 -> fetch();
                $nombreC = $fila['nombre_Apellido'];
                $_SESSION['idUser'] = $fila2['id_usuario'];
                $_SESSION['nombreCompleto'] = $nombreC;
                    //echo $_SESSION['nombreCompleto']; 
        header('Location: dashboard.php'); 
    }else{
        header('Location: index.php?fallo=true'); 
    }
}

?>

