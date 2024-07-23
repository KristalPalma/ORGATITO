<?php

include '../../content/conexion.php';


$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];
    

    $peticionInsertar = "INSERT INTO usuarios (usuario, correo, telefono, contraseña)
    VALUES ('$usuario','$correo','$telefono','$contraseña')";
    if ($isbn === '') {
      $errores[] = 'Debes ingresar un ISBN';
    }

    if ($nombre === '') {
      $errores[] = 'Debes ingresar un Nombre';
    }
    if ($autor === '') {
      $errores[] = 'Debes ingresar un Autor';
    }
    if ($precio === '') {
      $errores[] = 'Debes ingresar un Precio';
    }
    if ($editorial === '') {
      $errores[] = 'Debes ingresar un Editorial';
    }
    if ($imagen === '') {
      $errores[] = 'Debes ingresar un Imagen';
    }

    echo "<pre>";
    var_dump($errores);
    echo "</pre>";

if (mysqli_query($conexion, $peticionInsertar)) {
    echo "Tu registro se ha completado con éxito";
    header("location: ../MENSAJES/exitoso.html");
    exit(); 
} else {
   echo "no se pudo actualizar";
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
    <link rel="stylesheet" href="../../styles/login.css">
    <a href="../../index.html">Regresar</a>

</head>
<body>

<div class="registro-container">
  <h2>ORGATITO </h2>
  <h3>Regístrate</h3>
  <form action="procesar_login.php" method="post">
    <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
    <input type="text" id="correo" name="correo" placeholder="Correo" required>
    <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <select id="tipoUsuario" name="tipoUsuario" required>
      <option value="">Seleccionar tipo de usuario</option>
      <option value="cliente">Cliente</option>
      <option value="proveedor">Proveedor</option>
    </select>
    <input type="submit" value="Registrarse">
  </form>
  <a href="inicio_sesion.html">¿Ya tienes una cuenta? Inicia sesión aquí</a>
</div>

</body>
</html>
