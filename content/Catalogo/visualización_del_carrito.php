<?php
session_start();

// Manejar la eliminación de productos del carrito
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
    header("Location: visualización_del_carrito.php"); // Redirigir para evitar reenvío de formulario
    exit();
}
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
    <br><a class="principal-btn" href="<?php echo isset($_SESSION['url_retorno']) ? $_SESSION['url_retorno'] : 'Detalles_del_producto.php'; ?>">Regresar</a>
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
                        
                        <td><a href="visualización_del_carrito.php?action=remove&id=<?php echo $id; ?>" class="remove-btn">Eliminar</a></td> <!-- Mover el botón de eliminación aquí -->
                        </tr>

                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?php echo '$' . number_format($total, 2); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
            // Número de teléfono en formato internacional sin el símbolo "+"
            $telefono = '9848060908'; // Reemplazar con el número de WhatsApp real
            $mensaje = urlencode("Hola, me gustaría proceder con el pago de mi carrito. Mi total es de $" . number_format($total, 2));
            $url_whatsapp = "https://wa.me/$telefono?text=$mensaje";
            ?>
            
            <a href="<?php echo $url_whatsapp; ?>" class="checkout-btn">Proceder al Pago</a>
        <?php else: ?>
            <p>No hay productos en el carrito.</p>
        <?php endif; ?>
    </div>
</body>
</html>
