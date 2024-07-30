<!DOCTYPE html>
<html>
<head>
    <title>Editar Perfil</title>

    <link rel="stylesheet" href="ORGATITO/styles/estilos.css">
    <link rel="stylesheet" href="ORGATITO/styles/global.css">

</head>
<body>
    <div class="container">
        <h1>Perfil</h1>
        <form action="procesar_edicion.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" readonly>
            <button type="button">Modificar</button>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>">
            <button type="button">Modificar</button>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
            <button type="button">Modificar</button>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" value="">
            <button type="button">Modificar</button>

            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
