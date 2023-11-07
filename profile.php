<?php

//iniciar sesion
session_start();

// verifica si no hay una sesion iniciada
if (!isset($_SESSION['user'])) {

// si no hay una sesion iniciada, se redirige al formulario
header('location: index.php');
exit;
}


// Se obtiene los datos del usuario de la sesion
$Usuario = $_SESSION['user']['Usuario'];
$Pelicula = $_SESSION['user']['Pelicula'];
$Libro = $_SESSION['user']['Libro'];
$Color = $_SESSION['user']['Color'];
$Email = $_SESSION['user']['Email'];
$Data_User = $_SESSION['user'][ 'Data_User'];

// ahora se obtiene los datos de hora y fecha que inicia sesion de la cookie 

$inicio_sesion = isset($_COOKIE['inicio_sesion']) ? $_COOKIE['inicio_sesion'] : '';


// Calcular el tiempo desde el último inicio de sesión
$tiempo_transcurrido = '';
if ($inicio_sesion) {
  $fecha_actual = new DateTime();
  $fecha_inicio_sesion = new DateTime($inicio_sesion);
  $intervalo = $fecha_actual->diff($fecha_inicio_sesion);
  $tiempo_transcurrido = $intervalo->format('%a días, %h horas y %i minutos');
}


    // Cerrar sesión
    if (isset($_POST['cerrar_sesion'])) {

   
    // Eliminar la sesión y la cookie
    session_start();
    session_unset();
    session_destroy();
    setcookie('inicio_sesion', '', time() - 3600, '/');
   
   
    // Redirigir al usuario al formulario de inicio de sesion 
    header('Location: index.php');
    var_dump($_POST);
    exit;
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Perfil del usuario</title>
</head>
<body>
<h1>Bienvenid@, <?php echo $Usuario; ?>!</h1>
    <p>Tus datos:</p>
    <ul>
        <li>Nombre: <?php echo $Usuario; ?></li>
        <li>Correo electrónico: <?php echo $Email; ?></li>
        <li>Fecha de nacimiento: <?php echo $Data_User; ?></li>
        <li>Pelicula Favorita: <?php echo $Pelicula; ?></li>
        <li>Libro Favorito: <?php echo $Libro; ?></li>
        <li>color: <?php echo $Color; ?></li>
    </ul>
    <p>Último inicio de sesión: <?php echo $inicio_sesion; ?></p>
    <p>Tiempo transcurrido desde el último inicio de sesión: <?php echo $tiempo_transcurrido; ?></p>
    <form action="profile.php" method="post">
        <input type="hidden" name="cerrar_sesion" value="true">
        <button class="btn btn-primary btn-lg" type="submit">Cerrar sesión</button>
    </form>


    <?php
    // Verificar si se ha enviado el formulario de cerrar sesión
    if (isset($_POST['cerrar_sesion']) && $_POST['cerrar_sesion'] == 'true') {
        cerrar_sesion();
    }
    ?>
</body>
</html>
