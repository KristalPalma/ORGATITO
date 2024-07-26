<?php
session_start();

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    include '../conexion.php';
    $conn = $con;

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT nombre, precio_kilo, imagen FROM productos WHERE producto_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        if (isset($_SESSION['carrito'][$productId])) {
            $_SESSION['carrito'][$productId]['cantidad'] += 1;
        } else {
            $_SESSION['carrito'][$productId] = [
                'nombre' => $product['nombre'],
                'precio' => $product['precio_kilo'],
                'imagen' => $product['imagen'],
                'cantidad' => 1
            ];
        }
    }

    $stmt->close();
    $conn->close();

    header("Location: carrito.php");
    exit;
}
?>
