<?php
include '../../../conexion.php';

$conexion = $con;

// Verificar si se ha enviado el ID de la venta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $venta_id = isset($_POST['venta_id']) ? (int)$_POST['venta_id'] : 0;

    // Iniciar transacción
    $conexion->begin_transaction();

    try {
        // Obtener la venta antes de eliminarla para actualizar la cantidad del producto
        $sql_get = "SELECT producto_id, cantidadventa FROM ventassss WHERE venta_id = ?";
        $stmt_get = $conexion->prepare($sql_get);
        $stmt_get->bind_param("i", $venta_id);
        $stmt_get->execute();
        $result_get = $stmt_get->get_result();

        if ($result_get->num_rows === 0) {
            throw new Exception("Venta no encontrada.");
        }

        $venta = $result_get->fetch_assoc();

        // Actualizar la cantidad en la tabla productos
        $sql_update = "UPDATE productos SET cantidad = cantidad + ? WHERE producto_id = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("ii", $venta['cantidadventa'], $venta['producto_id']);

        if (!$stmt_update->execute()) {
            throw new Exception("Error al actualizar la cantidad del producto: " . $stmt_update->error);
        }

        // Eliminar la venta
        $sql_delete = "DELETE FROM ventassss WHERE venta_id = ?";
        $stmt_delete = $conexion->prepare($sql_delete);
        $stmt_delete->bind_param("i", $venta_id);

        if (!$stmt_delete->execute()) {
            throw new Exception("Error al eliminar la venta: " . $stmt_delete->error);
        }

        // Confirmar transacción
        $conexion->commit();
        header("location: http://localhost/ORGATITO/content/AdminProductos/MENSAJES/eliminadoexitosodatoventa.html");

    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conexion->rollback();
        echo $e->getMessage();
    }

    // Cerrar declaraciones y conexión
    $stmt_get->close();
    $stmt_update->close();
    $stmt_delete->close();
    $conexion->close();
}
?>
