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
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="detalle-producto">';
    echo '<img src="' . $row["imagen"] . '" alt="' . $row["nombre"] . '" />';
    echo '<h1>' . $row["nombre"] . '</h1>';
    echo '<p>Categoría: ' . $row["categoria"] . '</p>';
    echo '<p>Cantidad: ' . $row["cantidad"] . '</p>';
    echo '<p>Precio: $' . number_format($row["precio_kilo"], 2) . '/kg</p>';
    echo '<p>Promoción: ' . $row["promocion"] . '</p>';
    echo '<p>Tipo de entrega: ' . $row["tipo_entrega"] . '</p>';
    echo '</div>';
} else {
    echo "No se encontró el producto.";
}

// Cerrar conexión
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/catalogo.css">
</head>
<body>
    
</body>
</html>
