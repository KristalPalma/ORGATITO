<?php
// Incluir la conexión a la base de datos
require '../../conexion.php';

// Inicializar un array para almacenar errores
$errores = [];

$usuario = $correo = $telefono = $contrasena = $tipo_usuario_id = "";

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $usuario = trim($_POST['usuario']);
  $correo = trim($_POST['correo']);
  $telefono = trim($_POST['telefono']);
  $contrasena = trim($_POST['contrasena']);
  $tipo_usuario_id = $_POST['tipo_usuario_id']; 

  // Validar el nombre de usuario
  if (empty($usuario)) {
    $errores[] = 'Por favor, ingrese un nombre de usuario.';
  } elseif (!preg_match('/\w+/', $usuario)) {
    $errores[] = 'El nombre de usuario solo puede contener letras, números y guion bajo.';
  } else {
    // Verificar si el nombre de usuario ya está en uso
    $sql = "SELECT usuario_id FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
      $errores[] = 'Este nombre de usuario ya está en uso.';
    }
    mysqli_stmt_close($stmt);
  }

  // Validar el correo electrónico
  if (empty($correo)) {
    $errores[] = 'Por favor, ingrese un correo electrónico.';
  } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El correo electrónico no es válido.';
  }

  // Validar la contraseña
  if (empty($contrasena)) {
    $errores[] = 'Por favor, ingrese una contraseña.';
  } elseif (strlen($contrasena) < 6) {
    $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
  }

  // Validar el teléfono
  if (empty($telefono)) {
    $errores[] = 'Por favor, ingrese un número de teléfono.';
  }

  // Si no hay errores, registrar al usuario
  if (empty($errores)) {
    // Hash la contraseña
    $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Preparar la consulta para registrar al usuario
    $sql = "INSERT INTO usuarios (usuario, correo, telefono, contrasena, tipo_usuario_id, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $usuario, $correo, $telefono, $contrasenaHash, $tipo_usuario_id);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
      // Redireccionar a la página de éxito
      header('Location: registro_exitoso.html');
      exit();
    } else {
      // En caso de error, mostrar un mensaje
      echo "Error al registrar el usuario: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="../../content/styles/global.css">
  <link rel="stylesheet" href="../../../styles/login.css">
  <a href="../../../index.html">Regresar</a>

</head>
<body>

<div class="login-container">
  <h2>ORGATITO</h2>
  <h3>Regístrate</h3>
  <form action="crear_cuenta.php" method="post">
    <label for="usuario">Ingresa un nombre de usuario:</label>
    <input type="text" id="usuario" name="usuario" required>

    <label for="correo">Ingresa un correo:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="telefono">Ingresa un telefono:</label>
    <input type="tel" id="telefono" name="telefono" required>

    <label for="contrasena">Ingresa una contraseña (debe tener al menos 6 caracteres):</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <label for="tipo_usuario_id">Selecciona tipo de usuario:</label>
    <select id="tipo_usuario_id" name="tipo_usuario_id" required>
        <option value="1">cliente</option>
        <option value="2">proveedor</option>
        <!-- Agrega más opciones según los tipos de usuario que tengas -->
    </select>

    <input type="submit" value="Registrarse">
  </form>
  <a href="inicio_sesion.html">¿Ya tienes una cuenta? Inicia sesión aquí</a>
</div>

</body>
</html>
