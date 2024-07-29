<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
        <link rel="stylesheet" href="../../../styles/login.css">
        <a href="../../../index.php">Regresar</a>
</head>
<body>

<div class="login-container">
    <h2>ORGATITO </h2>
    <h3>Inicia sesión</h3>
    <form action="procesar_login.php" method="POST">
        <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
        <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
        <select id="tipo_usuario_id" name="tipo_usuario_id" required>
            <option value="">Seleccionar tipo de usuario</option>
            <option value="cliente">cliente</option>
            <option value="proveedor">proveedor</option>
          </select>          
        <div>
            <input type="checkbox" class="checkbox" id="remember" name="remember">
            <label for="remember">Recuérdame</label>
        </div>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <a href="recuperar_contra.html">¿Olvidaste tu contraseña?</a> | <a href="crear_cuenta.php">Regístrate</a>
</div>

</body>
</html>

