<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>QuickTask++</title>
      <link rel="stylesheet" href="css/materialize/materialize.min.css">
      <link rel="stylesheet" href="css/materialize/material-icons.css">
      <link rel="stylesheet" href="css/estilos.css">

</head>
<body>

<header>
<nav>
    <div class="nav-wrapper light-blue darken-3">
    <span><img src="img/tareas.png" alt="logoApp" width="60px"></span>
      <a href="#" class="brand-logo">QuickTask++</a>
      <span style="font-size: 20px;" href="#" class="brand-logo center">Monitor de tareas</span>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a><?php 
                    echo $_SESSION['nombreCompleto'];
                ?> </a></li>
        <li><a href="cierreSesion.php"> <b>Salir</b> </a></li>
      </ul>
    </div>
  </nav>
</header>
      
