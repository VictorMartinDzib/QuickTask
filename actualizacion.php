<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header('Location: login.php');
    } 

    /** Recuperando conexion a base de datos */
    require_once('baseDatos.php');
    $bd = BaseDeDatos::getInstancia();
    $conexion = $bd -> getConexion();
    require_once('template/header.php');
    $id_del = $_GET['id_elim'];

    $sentencia = "SELECT * FROM tareas where id_tarea = '$id_del";

                        $consulta_tres = $conexion -> prepare($sentencia);
                        $consulta_tres -> execute();
                        $dato = $consulta_tres -> fetch();

    echo $dato[0];
?>

<main>
    <form action="actualizarDatos.php" method="POST">
        <h5>Agregar Nueva Tarea</h5>
                <p>
                    <a class="btn waves-effect blue-grey lighten-2" href="dashboard.php">   ir a Dashboard  </a></p>
                <table>
                    <tr>
                        <td> <label for="tarea_id"><h6>Codigo Tarea:</h6></label></td>
                        <td> <input name="id_tarea" id="tarea_id" type="text" value="<?php echo $id_del; ?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td> <label for="tarea_id"><h6>Titulo:</h6></label></td>
                        <td> <input name="titulo" id="tarea_id" type="text" value="<?php echo $dato[1]; ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="fecha_id"><h6>Fecha de creación:</h6></label></td>
                        <td><input name="fecha_asig" id="fecha_id" class="form-control" type="date" placeholder="Ejemplo tarea" required></td>
                    </tr>
                    <tr>
                        <td><label for="fechav_id"><h6>Fecha de vencimiento:</h6></label></td>
                        <td><input name="fecha_venc" id="fechav_id" class="form-control" type="date" placeholder="Ejemplo tarea" required>
                            </td>
                    </tr>
                    <tr>
                        <td><label for="asignado_id"><h6>Asignado a:</h6></label></td>
                        <td>
                        <div class="input-field col s12">
                            <select  class="form-control" name="id_user_asignado">
                                <option value="">Selecciona</option>
                                <?php
                                    $omitir = $_SESSION['nombreCompleto'];
                                    $sentencia = "SELECT nombre_Apellido, id_usuario FROM usuarios WHERE NOT nombre_Apellido = '$omitir' AND estatus = 1";
                                    $consulta = $conexion -> prepare($sentencia);
                                    $consulta -> execute();

                                    while($fila = $consulta -> fetch()){ ?>
                                            <option value="<?php echo $fila['id_usuario']; ?>"> <?php echo $fila['nombre_Apellido']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="descripcion_id"><h6>Descripcion:</h6></label></td>
                        <td><textarea name="descripcion" id="descripcion_id" class="materialize-textarea" id="exampleFormControlTextarea4" rows="3" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="status_id"><h6>Status: </h6></label></td>
                        <td><input name="estatus" id="status_id" class="form-control" type="text" placeholder="0" required>
                            </td>
                    </tr>
                    <tr>

                    
                   
                    </tr>
                </table><button type="submit"class="waves-effect waves-light btn light-blue accent-4" style="width:100%">  Guardar Tarea  </button>
                <br>
                
    </form>


</main>
            

<?php require_once('template/footer.php'); ?>