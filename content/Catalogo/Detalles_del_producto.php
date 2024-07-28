<?php
session_start(); // Inicia sesión para usar $_SESSION
include '../conexion.php';
$conn = $con;

// Verifica conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obteniene el ID del producto desde la URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Consulta la base de datos para obtener los detalles del producto
$sql = "SELECT producto_id, nombre, categoria, cantidad, precio_kilo, imagen, promocion, tipo_entrega FROM productos WHERE producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica si se encontró el producto
$product = null;
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $precio_kilo = isset($_POST['precio_kilo']) ? $_POST['precio_kilo'] : 0; 
    $cantidad = $_POST['cantidad'];

   
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto_id] = [
            'nombre' => $nombre,
            'precio_kilo' => $precio_kilo,
            'cantidad' => $cantidad
        ];
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
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
                    <img src="../AdminProductos/CRUDPROV/imagenes/<?php echo htmlspecialchars($product['imagen']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>" />
                </div>
                <div class="detalle-producto">
                    <h1 class="nombre"><?php echo htmlspecialchars($product['nombre']); ?></h1>
                    <p>Categoría: <?php echo htmlspecialchars($product['categoria']); ?></p>
                    <p>Cantidad: <?php echo htmlspecialchars($product['cantidad']); ?></p>
                    <p>Precio: <?php echo isset($product['precio_kilo']) ? '$' . number_format($product['precio_kilo'], 2) : 'N/A'; ?>/kg</p>
                    <p class="promocion">Promoción: <?php echo htmlspecialchars($product['promocion'] ?? ''); ?></p>
                    <p>Tipo de entrega: <?php echo htmlspecialchars($product['tipo_entrega']); ?></p>
                    
                    <!-- Formulario para agregar al carrito -->
                    <form method="POST">
    <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($product['producto_id']); ?>">
    <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($product['nombre']); ?>">
    <input type="hidden" name="precio_kilo" value="<?php echo htmlspecialchars($product['precio_kilo']); ?>">
    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>
    <button type="submit" name="add_to_cart">Agregar al carrito</button>
</form>


                </div>
            </div>
        <?php else: ?>
            <p>No se encontró el producto.</p>
        <?php endif; ?>
    </div>
</body>
</html>
