<?php

//Iniciar sesion
session_start();

if (isset($_SESSION["user"])) {
    // Si ya hay una sesion iniciada, redirigir al perfil
    header('Location: profile.php');
    exit;
}

// Verificar si se envio el formulario
if (isset($_POST['submit'])) {

// Aqui se obtienen los datos del formulario
    $Usuario = $_POST['Usuario'];
    $Email = $_POST['Email'];
    $Pelicula = $_POST['Pelicula'];
    $Libro = $_POST['Libro'];
    $Color = $_POST['Color'];
    $Password = $_POST['Password'];
    $Data_User = $_POST['Data_User'];

// Se guarda los datos de la sesion
$_SESSION['user'] = [
    'Usuario' => $Usuario,
    'Email' => $Email,
    'Pelicula' => $Pelicula,
    'Libro' => $Libro,
    'Color' => $Color,
    'Data_User' => $Data_User];


//Guarda Fecha y hora de inicio de sesion de una cookie
setcookie('inicio_sesion', date('Y-m-d H:i:s'), time() + (86400 * 30), '/'); //La operacion usada de 86400 * 30 se utiliza ya que son los segundos que tiene el dia * 30 

// Redirigir al perfil
header('Location: profile.php');
exit;
}

if(isset($_FILES['archivo'])) {
	$archivo = $_FILES['archivo'];
	$nombre_archivo = $archivo['name'];
	$tipo_archivo = $archivo['type'];
	$tamano_archivo = $archivo['size'];
	$ruta_archivo = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$nombre_archivo;

	if(move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
		echo "El archivo ".$nombre_archivo." ha sido subido correctamente.";
	} else {
		echo "Ha ocurrido un error al subir el archivo.";
	}
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
    <title> Loging </title>
</head>
<body>
<h1> Crea una cuenta para iniciar sesión </h1>
<div class="card-body">
    <form action="index.php" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nombre</span>
            <input type="text" required name="Usuario" class="form-control" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Correo Electronico</span>
            <input type="text" required name="Email" class="form-control" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Pelicula Favorita</span>
            <input type="text" required name="Pelicula" class="form-control" aria-describedby="basic-addon1">  
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Libro Favorito</span>
            <input type="text" required name="Libro" class="form-control" aria-describedby="basic-addon1"> 
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Color Favorito</span>
            <input type="text" required name="Color" class="form-control" aria-describedby="basic-addon1"> 
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Contraseña</span>
            <input type="password" required name="Password" class="form-control" aria-describedby="basic-addon1"> 
        </div>
        <div class="input-group mb-3"></div>
               <span class="date-text" id="basic-addon1"> Ingresa tu fecha de nacimiento: </span>
                <input type="date" name="Data_User" class="form-control" aria-describedby="basic-addon1" required pattern="\d{4}-\d{2}-\d{2}"/>
                <span class="validity"></span>
        </div>
    </form>
</div>
    <div class="update-file">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="archivo">Selecciona un archivo:</label>
        <input type="file" name="archivo" id="archivo"><br><br>
    </form>
    </div>
    
<div class="btn-login"> 
    <button type="submit" name="submit" class="btn btn-primary btn-lg">Registrate</button>      
</div>   
</body>
</html>