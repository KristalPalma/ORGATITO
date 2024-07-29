<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../../styles/jesus/carrito.css">
</head>
<body>
    <?php include "reutilizar/header.php"; ?>
    <h1>Carrito de Compras</h1>
    <div id="carrito">
        <?php if (!empty($_SESSION['carrito'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio por Kilo</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php 
                               $precio = $producto['precio_kilo'];
                                echo '$' . number_format($precio !== null ? $precio : 0, 2); 
                            ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td><?php echo '$' . number_format($producto['precio_kilo'] * $producto['cantidad'], 2); ?></td>
                        </tr>
                        <?php $total += $producto['precio_kilo'] * $producto['cantidad']; ?>

                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?php echo '$' . number_format($total, 2); ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="checkout.php" class="checkout-btn">Proceder al Pago</a>
        <?php else: ?>
            <p>No hay productos en el carrito.</p>
        <?php endif; ?>
    </div>
</body>
</html>
