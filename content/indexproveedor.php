<?php
session_start();

// Verificar si el usuario está autenticado y es cliente
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipo_usuario_id'] !== 'proveedor') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administradore</title>
    <link rel="stylesheet" href="../styles/estilos.css">
</head>
<body>

    <header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../content/indexproveedor.php">Inicio</a></li>
                  <li><a class=principal-btn href="../content/AdminProductos/administracion.html">Administración de productos</a></li>
                  <li><a class=principal-btn href="../content/AdminProductos/inventario.html">Inventario</a></li>
                  <li><a class=principal-btn href="../content/AdminProductos/datospago.php">Datos de pago</a></li>
                  <li><a class=principal-btn href="../cerrar_sesion.php">Cerrar sesion</a></li>

              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>

    <br><a class=principal-btn href="../index.php">Regresar</a></br>

    <div class="box-container"><h1> ¡Bienvenido Proveedor! </h1></div>


    <h1 class="centered-text" > En esta sección, podrás gestionar y supervisar  tu información de contacto, productos y 
      ventas, permitiéndote actualizar y revisar tus productos. Puedes navegar por las secciones desde la parte superior o 
      en la seccion inferior de esta ventana</h1>

<div class="container2" >
    <a class=big-btn href="./AdminProductos/administracion.html"> Administración de productos</a>
    <a class=big-btn href="../content/AdminProductos/inventario.html">Inventario</a>
    <a class=big-btn href="../content/AdminProductos/DatosPago.html">Datos de pago</a>
  </div>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../images/orgatito1.png" alt="ORGATITO Logo" style="width: 200px; float: left; margin-right: 45px"></div><h2 style="line-height: 1.6; text-align: justify; width: 80%;"> En el botón de administración puedes agregar y ver tus productos 
    agregados, en inventario visualizaras una gestión de tus ventas 
    y en datos de pago tendras la opcion de agregar o modificar la 
    forma en que te pagaran tus clientes.</h2></div>

</body>

</html>