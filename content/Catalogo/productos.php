<?php
include '../conexion.php';
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
    <link rel="stylesheet" href="../../styles/jesus/vista.css">
    

</head>
<body>
    <?php include "reutilizar/header.php"; ?>
    <div id="catalogo-container">
        <?php if ($product): ?>
            <div class="producto">
                <div class="img-especifica">
                    <img src="../AdminProductos/CRUDPROV/imagenes/<?php echo $product['imagen']; ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>" />
                </div>
                <div class="detalle-producto">
                    <h1 class="nombre"><?php echo htmlspecialchars($product['nombre']); ?></h1>
                    <p>Categoría: <?php echo htmlspecialchars($product['categoria']); ?></p>
                    <p>Cantidad: <?php echo htmlspecialchars($product['cantidad']); ?></p>
                    <p>Precio: $<?php echo number_format($product['precio_kilo'], 2); ?>/kg</p>
                    <p class="promocion">Promoción: <?php echo htmlspecialchars($product['promocion'] ?? ''); ?></p>

                    <p>Tipo de entrega: <?php echo htmlspecialchars($product['tipo_entrega']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>No se encontró el producto.</p>
        <?php endif; ?>
    </div>
</body>
</html>
