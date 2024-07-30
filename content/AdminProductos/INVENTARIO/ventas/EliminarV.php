<?php
include '../../../conexion.php';

$conexion = $con;

// Obtener el ID de la venta de la URL
$venta_id = isset($_GET['venta_id']) ? (int)$_GET['venta_id'] : 0;

// Verificar que la venta existe
$sql_venta = "SELECT * FROM ventassss WHERE venta_id = ?";
$stmt_venta = $conexion->prepare($sql_venta);
$stmt_venta->bind_param("i", $venta_id);
$stmt_venta->execute();
$result_venta = $stmt_venta->get_result();

if ($result_venta->num_rows == 0) {
    echo "Venta no encontrada.";
    exit;
}

$venta = $result_venta->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Venta</title>
    <link rel="stylesheet" href="../../../styles/productos.css">
    <link rel="stylesheet" href="../../../styles/estilos.css">
</head>
<body>
    <h1>Eliminar Venta</h1>
    <form action="procesar_eliminar_venta.php" method="post">
        <input type="hidden" name="venta_id" value="<?php echo htmlspecialchars($venta_id); ?>">
        <p>¿Está seguro de que desea eliminar la siguiente venta?</p>
        <table border="1">
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($venta['venta_id']); ?></td>
            </tr>
            <tr>
                <th>Producto ID</th>
                <td><?php echo htmlspecialchars($venta['producto_id']); ?></td>
            </tr>
            <tr>
                <th>Cliente Usuario</th>
                <td><?php echo htmlspecialchars($venta['clienteUsuario']); ?></td>
            </tr>
            <tr>
                <th>Cantidad de Venta</th>
                <td><?php echo htmlspecialchars($venta['cantidadventa']); ?></td>
            </tr>
            <tr>
                <th>Importe</th>
                <td><?php echo htmlspecialchars($venta['Importe']); ?></td>
            </tr>
            <tr>
                <th>Tipo de Entrega</th>
                <td><?php echo htmlspecialchars($venta['tipo_entrega']); ?></td>
            </tr>
            <tr>
                <th>Estatus de Pago</th>
                <td><?php echo htmlspecialchars($venta['estatuspago']); ?></td>
            </tr>
            <tr>
                <th>Fecha de Venta</th>
                <td><?php echo htmlspecialchars($venta['fechaventa']); ?></td>
            </tr>
        </table>
        <br>
        <input type="submit" value="Eliminar Venta">
        <a href="ventas_lista.php">Cancelar</a>
    </form>
</body>
</html>
