<?php
session_start();

if(!isset($_SESSION['user'])) {
  header('Location: index.php');
  exit;
}   
//Verifica si la variable se sesion 'usuarios' es un array, sino, inicializa como un array vacio
if (!is_array($_SESSION['user'])) {
    $_SESSION['user'] = array();
}

//Agrega los nuevos datos del usuario al array de 'usuarios' de la sesion
$usuario = array(
    'Usuario' => $_SESSION['Usuario'],
    'Email' => $_SESSION['Email'],
    'Data_User' => $_SESSION['Data_User'],
    'Pelicula' => $_SESSION['Pelicula'],
    'Libro' => $_SESSION['Libro'],
    'Color' => $_SESSION['Color']
);

array_push($_SESSION['user'], $usuario);

$usuario = $_SESSION['user'];
//Con la variable $usuarios para mostrar los datos de cada usuario en la sesion.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Guardados</title>
</head>
<body>
    <h1>Usuarios conectados</h1>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Correo Electronico</th>
                <th>Fecha de Nacimiento</th>
                <th>Pelicula Favorita</th>
                <th>Libro Favorito</th>
                <th>Color Favorito</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $user): ?>
              <tr>
                <td> <?php echo $user['Usuario']; ?> </td>
                <td> <?php echo $user['Email']; ?> </td>
                <td> <?php echo $user['Data_User']; ?> </td>
                <td> <?php echo $user['Pelicula']; ?> </td>
                <td> <?php echo $user['Libro']; ?> </td>
                <td> <?php echo $user['Color']; ?> </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>