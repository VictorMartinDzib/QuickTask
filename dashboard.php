<?php

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: dashboard.php');
}

require_once('baseDatos.php');
$bd = BaseDeDatos::getInstancia();
$conexion = $bd -> getConexion();

$current_id = $_SESSION['idUser'];
require_once('template/header.php');
?>

<main><h4 class="title1">Tareas vencidas </h4>
        <div class="txt_btn">
                

                <p><button onclick="location.href='formulario.php'"
                 id="btn_agregar_id" type="button"
                    class="btn waves-effect blue-grey lighten-2">Agregar Tarea</button></p>
            </div>
            <br>

            <table class="highlight responsive-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tarea</th>
                        <th scope="col">Asignado por</th>
                        <th scope="col">Fecha Vencimiento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sentencia = "SELECT id_tarea, titulo, nombre_Apellido , fecah_venc FROM tareas 
                        INNER JOIN usuarios ON usuarios.id_usuario = tareas.id_asignador 
                        WHERE (fecah_venc < CURRENT_DATE) AND (id_user_asignado = '$current_id') AND 
                        (tareas.estatus = 1) ORDER BY id_tarea";

                        $consulta_dos = $conexion -> prepare($sentencia);
                        $consulta_dos -> execute();
                        $cont = 1;
                        while($fila = $consulta_dos -> fetch()){ ?>
                        <tr>
                            <th scope="row"><?php echo $cont++; ?></th>
                            <td><?php echo $fila['titulo']; ?></td>
                            <td><?php echo $fila['nombre_Apellido']; ?></td>
                            <td><?php echo $fila['fecah_venc']; ?></td>
                            <td> <button onclick="location.href='eliminarTarea.php?id_elim=<?php echo $fila['id_tarea']?>'" type="button" class="btn waves-effect deep-orange darken-4">X</button></td>
                           
                        </tr>
                        <?php
                        } 
                        ?>
                </tbody>
            </table><br>
            
            <h4>Tareas por realizar</h4><br>
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tarea</th>
                        <th scope="col">Asignado por</th>
                        <th scope="col">Fecha Vencimiento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                        <?php                        
                        $sentencia = "SELECT id_tarea, titulo, nombre_Apellido , fecah_venc FROM tareas 
                        INNER JOIN usuarios ON usuarios.id_usuario = tareas.id_asignador 
                        WHERE (id_user_asignado = '$current_id') AND 
                        (tareas.estatus = 1) AND (fecah_venc > CURRENT_DATE) ORDER BY id_tarea";

                        $consulta_dos = $conexion -> prepare($sentencia);
                        $consulta_dos -> execute();
                        
                        $datos = array();
                        //$_SESSION['Vencimiento'] = null;
                       
                        $cont = 1;
                        while($fila = $consulta_dos -> fetch()){ ?>
                       
                        <tr>
                       
                            <th scope="row"><?php echo $cont++; ?></th>
                            <td><?php echo $fila['titulo']; ?></td>
                            <td><?php echo $fila['nombre_Apellido']; ?></td>
                            <td><?php echo $fila['fecah_venc']; ?></td>
                            <td><button onclick="location.href='seguimiento.php?id_elim=<?php echo $fila['id_tarea']?>'" type="button" class="btn btn-info">Ver</button></td>                         
                        </tr>
                        <?php
                        }
                        $_SESSION['tareas'] = $datos;
                    ?>
                </tbody>
            </table><br>

            <h4>Tareas asignadas a otros</h4><br>
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tarea</th>
                        <th scope="col">Asignado a</th>
                        <th scope="col">Fecha Vencimiento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sentencia = "SELECT id_tarea, titulo, nombre_Apellido , fecah_venc FROM tareas 
                        INNER JOIN usuarios ON usuarios.id_usuario = tareas.id_user_asignado
                        WHERE id_asignador = '$current_id' AND 
                        (tareas.estatus = 1) ORDER BY id_tarea";

                        $consulta_tres = $conexion -> prepare($sentencia);
                        $consulta_tres -> execute();

                        $cont = 1;
                        while($fila = $consulta_tres -> fetch()){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $cont++; ?></th>
                        <td><?php echo $fila['titulo']; ?></td>
                        <td><?php echo $fila['nombre_Apellido']; ?></td>
                        <td><?php echo $fila['fecah_venc']; ?></td>
                        <td>
                            <button onclick="location.href='actualizacion.php?id_elim=<?php echo $fila['id_tarea']?>'" type="button" class="btn btn-primary">Editar</button>
                            <button onclick="location.href='eliminarTarea.php?id_elim=<?php echo $fila['id_tarea']?>'" type="button" class="btn waves-effect deep-orange darken-4">X</button>
                        </td>
                    </tr>

                    <?php
                        }
                    ?>
                </tbody>
            </table>
</main>

<?php require_once('template/footer.php'); ?>