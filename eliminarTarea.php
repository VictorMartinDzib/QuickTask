
<?php

    require_once('baseDatos.php');
    $bd = BaseDeDatos::getInstancia();
    $conexion = $bd -> getConexion();

    echo 'Entrando';

    $id_del = $_GET['id_elim'];
    $sentencia = "UPDATE tareas SET estatus = 0 WHERE id_tarea = '$id_del'";

    $delete = $conexion -> prepare($sentencia);
    $delete -> execute();

    header('Location: dashboard.php');
?>