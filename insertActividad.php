<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require_once('baseDatos.php');
    $bd = BaseDeDatos::getInstancia();
    $conexion = $bd -> getConexion();


        $nombreActividad = $_POST["nombreAct"];
        $detalle = $_POST['detalles'];
        $fecha_hora = $_POST["date_tarea"];
        $id_tarea = $_POST["listatareas"];

        
        $senten = "INSERT INTO actividades(nombreActividad, detalles, fecha_hora, id_tarea) VALUES ('$nombreActividad','$detalle','$fecha_hora','$id_tarea')";
        $insertar = $conexion -> prepare($senten);

        $insertar -> execute();

        if($_POST["date_tarea"] != '0000-00-00') {
             
        }
        header('Location: actividades-form.php');

        

        //if($_POST["titulo"]!= null or $_POST["dias_faltantes"] != null){
        

        
    
}

?>