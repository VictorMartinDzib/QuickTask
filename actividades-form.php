<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: dashboard.php');
}
require_once('baseDatos.php');
$bd = BaseDeDatos::getInstancia();
$conexion = $bd -> getConexion();
require_once('template/header.php');
?>

  <main>
  
      <form class="col s12" action="insertActividad.php" method="POST">
      <p>
                    <a class="btn waves-effect blue-grey lighten-2" href="dashboard.php">   ir a Dashboard  </a></p>
            <h5>Agregar Nueva Actividad</h5>
            <div class="row">
                  <div class="input-field col s12">
                        <input name="nombreAct" id="na" type="text" class="validate" required>
                        <label for="na">Nombre de actividad</label>
                  </div>
            </div>

            <div class="row">
                  <div class="input-field col s6">
                        <input type="date" name="date_tarea" id="para"  class="validate" required>
                  </div>
                  <div class="input-field col s6">
                  <?php 
                        $current =  $_SESSION['nombreCompleto'];
                        $sentencia = "SELECT tareas.titulo, tareas.id_tarea FROM tareas
                        INNER JOIN usuarios ON usuarios.id_usuario = tareas.id_asignador
                        WHERE usuarios.nombre_Apellido = '$current' and tareas.estatus = 1"; 
                        $consulta = $conexion -> prepare($sentencia);
                        $consulta -> execute();
                        ?>

                        <select name="listatareas" id="lt" required>
                              <option value="" disabled selected>Asignar a tarea:</option>
                              <?php 
                              while($fila = $consulta -> fetch()){ ?>
                                    <option  value="<?php echo $fila['id_tarea']; ?>" > <?php echo $fila['titulo']; ?>
                                    </option>
                              <?php
                              }
                              ?>
                              
                        </select>
                  </div>
            </div>

            <div class="row">
                  <div class="input-field col s12">
                        <input name="detalles" id="detail" type="text" class="validate">
                        <label for="detail">Detalles</label>
                  </div>
            </div>
            <button type="submit"class="waves-effect waves-light btn light-blue accent-4" style="width:100%">  Guardar Actividad  </button>
      </form>
  </main>

            
    
<?php require_once('template/footer.php'); ?>