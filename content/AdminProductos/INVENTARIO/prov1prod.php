<?php
include '../../conexion.php';
$conn = $con;

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}




// Obtener el ID del producto desde la URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Consultar la base de datos para obtener los detalles del producto
$sql = "SELECT nombre, categoria, cantidad, precio_kilo, imagen, promocion, tipo_entrega FROM productos WHERE producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró el producto
$product = null;
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="../../../styles/oneproduct.css">
    <link rel="stylesheet" href="">
    

</head>
<body>

<!-- SECCION SUPERIOR DE NAVEGACIÓN  -->
<header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../../indexproveedor.php">Inicio</a></li>
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

    <br><a class=principal-btn  href="../../../content/AdminProductos/INVENTARIO/misproductos.php">Regresar</a>
<!-- FINAL DE LA SECCION SUPERIOR DE NAVEGACIÓN  -->

    <div id="catalogo-container">
        <?php if ($product): ?>
            <div class="producto">

                <div class="img-especifica">
                    <img src="../CRUDPROV/imagenes/<?php echo $product['imagen']; ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>" />
                </div>
                <div class="detalle-producto">
                    <h1 class="nombre"><?php echo htmlspecialchars($product['nombre']); ?></h1>
                    <p>Categoría: <?php echo htmlspecialchars($product['categoria']); ?></p>
                    <p>Cantidad: <?php echo htmlspecialchars($product['cantidad']); ?>/kg</p>
                    <p>Precio: $<?php echo number_format($product['precio_kilo'], 2); ?>/kg</p>
                    <p class="promocion">Promoción: <?php echo htmlspecialchars($product['promocion'] ?? ''); ?></p>
                    <p>Tipo de entrega: <?php echo htmlspecialchars($product['tipo_entrega']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>No se encontró el producto.</p>
        <?php endif; ?>
    </div>

    <div style="overflow: hidden; gap: 25px;">
    <div> <img src="../../../images/orgatito4.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>
</html>
