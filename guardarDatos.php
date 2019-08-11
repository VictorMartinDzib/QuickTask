<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require_once('baseDatos.php');
    $bd = BaseDeDatos::getInstancia();
    $conexion = $bd -> getConexion();


    try{
        $titulo = $_POST["titulo"];
        $fecha_inicio = $_POST["fecha_ini"];
        $fecha_fin = $_POST["fecha_ven"];
        $current_id = $_SESSION["idUser"];

        if($_POST["asignador"] != 0)
        {
            $asignado = $_POST["asignador"];
        }

        $descripcion = $_POST["descripcion"];
        $fecha_creacion = $_POST["fecha_ini"];
        $estatus = $_POST["estatus"];

        $sentencia = "INSERT INTO tareas(titulo, fecha_asig, fecah_venc, id_asignador, id_user_asignado, decripcion, fecha_creacion, estatus) VALUES ('$titulo','$fecha_inicio','$fecha_fin','$current_id','$asignado','$descripcion','$fecha_creacion','$estatus')";
        $insetar = $conexion -> prepare($sentencia);

        /*$insetar -> bindParam(':titulo', $_POST["titulo"]);
        $insetar -> bindParam(':fecha_inicio', $_POST["fecha_ini"]);
        $insetar -> bindParam(':fecha_fin', $_POST["fecha_ven"]);
        $insetar -> bindParam(':current_id', $_SESSION['idUser']);

        if($_POST["asignador"] != 0){
            $insetar -> bindParam(':asignado', $_POST["asignador"]);
        }

        $insetar -> bindParam(':descripcion', $_POST["descripcion"]);
        $insetar -> bindParam(':fecha_creacion', $_POST["fecha_ini"]);
        $insetar -> bindParam(':estatus', $_POST["estatus"]);*/

        $fechI = $_POST['fecha_ini'];
        $fechF = $_POST['fecha_ven'];

        $nums = "
                <script src='http://momentjs.com/downloads/moment.min.js'></script>
                <script>
                    var fecha1 = moment('$fechI');
                    var fecha2 = moment('$fechF');                    
                    document.write(fecha2.diff(fecha1, 'days'));
                </script>
        ";

        //if($_POST["titulo"]!= null or $_POST["dias_faltantes"] != null){
        if(($_POST["fecha_ini"] != '0000-00-00') or ($_POST["fecha_ini"] != '0000-00-00') or ($_POST["titulo"]) != "") {
             $insetar -> execute();
        }

        header('Location: formulario.php');
        
        
    }catch(PDOexception $e){
        echo "No se lograron insertar los datos " . $e -> GetMessage();
        header('Location: formulario.php');
    }
}

?>