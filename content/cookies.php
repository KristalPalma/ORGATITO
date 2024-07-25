<?php
// Iniciar sesión si es necesario
session_start();

// Crear una cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre_cookie = "usuario";
    $valor_cookie = $_POST['nombre_usuario'];
    $tiempo_expiracion = time() + (30 * 24 * 60 * 60); // 30 días desde ahora
    setcookie($nombre_cookie, $valor_cookie, $tiempo_expiracion, "/");

    echo "La cookie ha sido establecida.<br>";
}

// Leer la cookie
if (isset($_COOKIE["usuario"])) {
    echo "El valor de la cookie 'usuario' es: " . $_COOKIE["usuario"] . "<br>";
} else {
    echo "La cookie 'usuario' no está establecida.<br>";
}

// Eliminar la cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    setcookie("usuario", "", time() - 3600, "/");
    echo "La cookie ha sido eliminada.<br>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cookies</title>
</head>
<body>

<h2>Gestión de Cookies</h2>

<form action="gestionar_cookies.php" method="post">
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required>
    <button type="submit" name="crear">Crear Cookie</button>
</form>

<form action="gestionar_cookies.php" method="post">
    <button type="submit" name="eliminar">Eliminar Cookie</button>
</form>

</body>
</html>
