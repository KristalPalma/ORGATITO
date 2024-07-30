<?php
include '../../../conexion.php';

$conexion= $con;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $venta_id = $_POST['venta_id'];
    $productov_id = $_POST['productov_id'];
    $clienteUsuario = $_POST['clienteUsuario'];
    $cantidadventa = $_POST['cantidadventa'];
    $Importe = $_POST['Importe'];
    $tipo_entrega = $_POST['tipo_entrega'];
    $estatuspago = $_POST['estatuspago'];
    $fechaventa = $_POST['fechaventa'];

    // Iniciar transacción
    $conexion->begin_transaction();

    try {
        // Obtener la cantidadventa anterior
        $sql_select = "SELECT cantidadventa, estatuspago FROM ventassss WHERE venta_id = ?";
        $stmt_select = $conexion->prepare($sql_select);
        $stmt_select->bind_param("i", $venta_id);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();
        $venta_anterior = $result_select->fetch_assoc();

        // Actualizar datos en la tabla ventassss
        $sql_update = "UPDATE ventassss SET productov_id = ?, clienteUsuario = ?, cantidadventa = ?, Importe = ?, tipo_entrega = ?, estatuspago = ?, fechaventa = ? WHERE venta_id = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("isissssi", $productov_id, $clienteUsuario, $cantidadventa, $Importe, $tipo_entrega, $estatuspago, $fechaventa, $venta_id);

        if (!$stmt_update->execute()) {
            throw new Exception("Error al actualizar la venta: " . $stmt_update->error);
        }

        // Si el estatus de pago anterior era "PAGADO" y el nuevo es diferente, restaurar la cantidad en productos
        if ($venta_anterior['estatuspago'] == 'PAGADO' && $estatuspago != 'PAGADO') {
            $sql_restore = "UPDATE productos SET cantidad = cantidad + ? WHERE producto_id = ?";
            $stmt_restore = $conexion->prepare($sql_restore);
            $stmt_restore->bind_param("ii", $venta_anterior['cantidadventa'], $productov_id);
            if (!$stmt_restore->execute()) {
                throw new Exception("Error al restaurar la cantidad de productos: " . $stmt_restore->error);
            }
        }

        // Si el nuevo estatus de pago es "PAGADO", actualizar la cantidad en la tabla productos
        if ($estatuspago === 'PAGADO') {
            $sql_update_productos = "UPDATE productos SET cantidad = cantidad - ? WHERE producto_id = ?";
            $stmt_update_productos = $conexion->prepare($sql_update_productos);
            $stmt_update_productos->bind_param("ii", $cantidadventa, $productov_id);

            if (!$stmt_update_productos->execute()) {
                throw new Exception("Error al actualizar la cantidad de productos: " . $stmt_update_productos->error);
            }
        }

        // Confirmar transacción
        $conexion->commit();
        echo "Venta actualizada y cantidad de productos modificada exitosamente.";

    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conexion->rollback();
        echo $e->getMessage();
    }

    // Cerrar declaraciones y conexión
    $stmt_update->close();
    if (isset($stmt_restore)) {
        $stmt_restore->close();
    }
    if (isset($stmt_update_productos)) {
        $stmt_update_productos->close();
    }
    $conexion->close();
}
?>
