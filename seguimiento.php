<?php

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: dashboard.php');
}

require_once('template/header.php');
require_once('baseDatos.php');
    $bd = BaseDeDatos::getInstancia();
    $conexion = $bd -> getConexion();

$id_tarea = $_GET['id_elim'];

$sentencia = "SELECT * FROM tareas where id_tarea = '$id_tarea'";

                        $consulta = $conexion -> prepare($sentencia);
                        $consulta -> execute();
                        $dato = $consulta -> fetch();

    echo $dato[0];
?>

  <main>
  <div id="texto" class="textos">
                <h5 class="title1">Seguimiento de la tarea</h5>
                <button onclick="location.href='actividades-form.php'" id="btn_add_act" type="button" class="btn btn-success">Agregar Actividad</button>
                <a class="btn btn-light" href="dashboard.php">ir a Dashboard</a>
            </div>
            <p>
                <h6>Nombre de la tarea: <i> <?php echo $dato[1]; ?></i></h6>
                <h6>Fecha de vencimiento: <?php echo $dato [3]; ?></h6><br>
                <h6>Actividades de la tarea:</h6>
            </p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Actividad</th>
                        <th scope="col">Detalles</th>
                        <th scope="col">Fecha/Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sentencia = "SELECT id_actividad, nombreActividad, detalles, fecha_hora FROM actividades where id_tarea = '$id_tarea'";

                        $consulta_dos = $conexion -> prepare($sentencia);
                        $consulta_dos -> execute();
                        $cont = 1;
                        while($fila = $consulta_dos -> fetch()){ ?>
                        <tr>
                            <th scope="row"><?php echo $cont++; ?></th>
                            <td><?php echo $fila['nombreActividad']; ?></td>
                            <td><?php echo $fila['detalles']; ?></td>
                            <td><?php echo $fila['fecha_hora']; ?></td>
                        <?php
                        } 
                        ?>
                    </tr>
                </tbody>
            </table>
            <br>
            <script src="js/funcionalidad.js"></script>
        </div>
  </main>

            
    
    <?php require_once('template/footer.php'); ?>