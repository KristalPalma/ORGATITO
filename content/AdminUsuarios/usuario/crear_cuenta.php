<?php
// Incluir la conexión a la base de datos
include('../../conexion.php');

// Inicializar un array para almacenar errores
$errores = [];

$usuario = $contrasena = $confirm_password = $telefono = "";

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $usuario = trim($_POST['usuario']);
  $correo = trim($_POST['correo']);
  $contrasena = trim($_POST['contrasena']);
  $telefono = trim($_POST['telefono']);


  // Validar el nombre de usuario
  if (empty($usuario)) {
    $errores[] = 'Por favor, ingrese un nombre de usuario.';
  } elseif (!preg_match('/\w+/', $usuario)) {
    $errores[] = 'El nombre de usuario solo puede contener letras, números y guion bajo.';
  } else {
    // Verificar si el nombre de usuario ya está en uso
    $sql = "SELECT id FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($link, $sql);
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
  
  // Validar la confirmación de contraseña
  if (empty($_POST['confirm_password'])) {
    $errores[] = 'Por favor, confirme su contraseña.';
  } elseif ($_POST['confirm_password'] !== $contrasena) {
    $errores[] = 'Las contraseñas no coinciden.';
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
    $sql = "INSERT INTO usuarios (usuario, correo, telefono, contrasena) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $usuario, $correo, $telefono, $contrasenaHash);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
      // Redireccionar a la página de éxito
      header('Location: registro_exitoso.html');
      exit();
    } else {
      // En caso de error, mostrar un mensaje
      echo "Error al registrar el usuario: " . mysqli_error($link);
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

    <a href="inicio_sesion.html">Regresar</a>

</head>
<body>

<div class="login-container">
  <h2>ORGATITO </h2>
  <h3>Regístrate</h3>
  <form action="procesar_login.php" method="post">
    <label for="">Ingresa un nombre de usuario</label>
    <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
    <label for="">Ingresa un correo</label>
    <input type="text" id="correo" name="correo" placeholder="Correo" required>
    <label for="">Ingresa un telefono</label>
    <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" required>
    <label for="">Ingresa una contraseña (debe tener al menos 6 caracteres)</label>
    <input type="password" id="password" name="contrasena" placeholder="Contraseña" required>
    <select id="tipoUsuario" name="tipoUsuario" required>
    <label for="">Ingresa el tipo de usuario</label>

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
