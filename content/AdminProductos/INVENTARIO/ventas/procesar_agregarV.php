<?php
include '../../../conexion.php';

$conexion = $con;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
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
        // Insertar datos en la tabla ventassss
        $sql_insert = "INSERT INTO ventassss (producto_id, productov_id, clienteUsuario, cantidadventa, Importe, tipo_entrega, estatuspago, fechaventa)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("iisissss", $producto_id, $productov_id, $clienteUsuario, $cantidadventa, $Importe, $tipo_entrega, $estatuspago, $fechaventa);

        if (!$stmt_insert->execute()) {
            throw new Exception("Error al agregar la venta: " . $stmt_insert->error);
        }

        // Si el estatus de pago es "PAGADO", actualizar la cantidad en la tabla productos
        if ($estatuspago === 'PAGADO') {
            $sql_update = "UPDATE productos SET cantidad = cantidad - ? WHERE producto_id = ?";
            $stmt_update = $conexion->prepare($sql_update);
            $stmt_update->bind_param("ii", $cantidadventa, $productov_id);

            if (!$stmt_update->execute()) {
                throw new Exception("Error al actualizar la cantidad de productos: " . $stmt_update->error);
            }
        }

        // Confirmar transacción
        $conexion->commit();
        header("location: http://localhost/ORGATITO/content/AdminProductos/MENSAJES/Actualizacion.html");;

    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conexion->rollback();
        echo $e->getMessage();
    }

    // Cerrar declaraciones y conexión
    $stmt_insert->close();
    if (isset($stmt_update)) {
        $stmt_update->close();
    }
    $conexion->close();
}
?>
