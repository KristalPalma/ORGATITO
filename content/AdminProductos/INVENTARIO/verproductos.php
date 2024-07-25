<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="../../../styles/productos.css">
    <link rel="stylesheet" href="../../../styles/estilos.css">
</head>
<body>

<header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../../indexproveedor.html">Inicio</a></li>
                  <li><a class=principal-btn href="../administracion.html">Administración de productos</a></li>
                  <li><a class=principal-btn href="../../content/AdminProductos/inventario.html">Inventario</a></li>
                  <li><a class=principal-btn href="../../content/AdminProductos/datospago.html">Datos de pago</a></li>
              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../../../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>

<div id="catalogo-container">
    <div id="titulo">
        <h1>Selección de Productos</h1>
    </div>

    <?php
    // Verificar si hay resultados
    include '../../conexion.php';
    $conn = $con;
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta para extraer los datos de la tabla 'productos'
    $consulta = "SELECT * FROM productos";

$resultado = mysqli_query($conn, $consulta);

$ProductosObtenidos = array();

while ($producto = mysqli_fetch_assoc($resultado)) {
    $ProductosObtenidos[] = $producto;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
</head>

<body>
    <?php foreach ($ProductosObtenidos as $Productoitem): ?>

        <h1>Título: <?php echo $Productoitem['nombre'] ?></h1>
        <img src="imagenes/<?php echo $Productoitem['imagen'] ?>" alt="">
        <p><?php echo $Productoitem['imagen'] ?></p>

    <?php endforeach ?>
</body>

</html>
    
    
</div>

</html>
