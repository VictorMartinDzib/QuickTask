
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/materialize/materialize.min.css">
    <link rel="stylesheet" href="css/materialize/material-icons.css">
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body{
            background: #0288d1;
        }
    </style>
    <title>QuickTask++</title>
</head>
<?php
       if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
       { ?>
          <div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Inicio de sesion fallido</strong> El usuario y la contraseña no coinciden!
            <button onclick="location.href='index.php'" type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
       <?php
       }
?>
<body> 
    <nav class="nav-wrapper light-blue darken-3">
    <a href="#" class="brand-logo"><span><img src="img/tareas.png" alt="logoApp" width="60px"></span></a>
    <a href="" class="brand-logo center">QuickTask++</a>
    </nav>

    <div class="card">
    <form action="validacion.php" method="POST">
    <span class="card-title">Bienvenido, Inicia sesion</span>
        <div class="row">
                <div class="input-field col s12">
                <input name="usuario" id="email" type="text" required>
                <label for="email">Nombre de usuario</label>
                </div>
        </div>

        <div class="row">
                <div class="input-field col s12">
                <input name="contrasenia" id="password" type="password" required>
                <label for="password">Contraseña</label>
                </div>
        </div>

                <button id="acceder" type="submit" class="waves-effect waves-light btn cyan accent-4">Acceder</button>
                <button id="cancel" type="button" class="waves-effect waves-light btn  deep-orange darken-2">Cancelar</button>
                <br><br>
                <a id="btn_oc_id" href="">Olvidé mi contraseña</a>
        </form>		
    </div>




    <script src="js/materialize.min.js"></script>   

    
</body>
</html>

