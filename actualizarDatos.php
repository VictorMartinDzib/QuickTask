<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require_once('baseDatos.php');
    $bd = BaseDeDatos::getInstancia();
    $conexion = $bd -> getConexion();


    try{
        $id_tarea = $_POST['id_tarea'];
        $titulo = $_POST["titulo"];
        $fecha_asig = $_POST['fecha_asig'];
        $fecah_venc = $_POST['fecha_venc'];
        $id_user_asignado = $_POST['id_user_asignado'];
        $descripcion = $_POST['descripcion'];
        $fecha_creacion = $_POST['fecha_asig'];
        $estatus = $_POST['estatus'];

        $actualizacion = ("UPDATE tareas SET 
            titulo = '$titulo',
            fecha_asig = '$fecha_asig',
            fecah_venc = '$fecah_venc',
            id_user_asignado = '$id_user_asignado',
            decripcion = '$descripcion',
            fecha_creacion = '$fecha_creacion',
            estatus = '$estatus'
            where id_tarea = '$id_tarea'");

        $insetar = $conexion -> prepare($actualizacion);

        if(($_POST["fecha_asig"] != '0000-00-00') or ($_POST["fecha_venc"] != '0000-00-00')) {
             $insetar -> execute();
        }

        header('Location: dashboard.php');
        
        
    }catch(PDOexception $e){
        echo "No se lograron insertar los datos " . $e -> GetMessage();
        header('Location: formulario.php');
    }
}

?>