<?php
include '../../../conexion.php';

$conexion = $con;

// Obtener el ID de la venta desde la URL
$venta_id = isset($_GET['venta_id']) ? (int)$_GET['venta_id'] : 0;

// Verificar que el ID se ha pasado correctamente
if ($venta_id == 0) {
    echo "ID de venta inválido.";
    exit;
}

// Verificar que la venta existe
$sql_venta = "SELECT * FROM ventassss WHERE venta_id = ?";
$stmt_venta = $conexion->prepare($sql_venta);
if (!$stmt_venta) {
    echo "Error en la preparación de la consulta: " . $conexion->error;
    exit;
}

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
    <title>Editar Venta</title>
    <link rel="stylesheet" href="../../../../styles/estilos.css">
    <link rel="stylesheet" href="../../../../styles/tabla.css">
</head>
<body>

<!-- SECCION SUPERIOR DE NAVEGACIÓN  -->
<header class="header">
    <div class="container">
        <div class="logo">
            <img src="../../../../images/logo orgatito.png" alt="ORGATITO Logo">
        </div>
        <nav>
            <ul>
                <li><a class="principal-btn" href="../../../indexproveedor.html">Inicio</a></li>
                <li><a class="principal-btn" href="../../administracion.html">Administración de productos</a></li><br>
                <li><a class="principal-btn" href="../../../content/AdminProductos/inventario.html">Inventario</a></li>
                <li><a class="principal-btn" href="../../../AdminProductos/datospago.php">Datos de pago</a></li>
            </ul>
        </nav>
        <div class="container">
            <div class="logo">
                <img src="../../../../images/sesionn.png" alt="sesion Logo">
            </div>
        </div>
    </div>
</header>

<br><a class="principal-btn" href="../../../AdminProductos/INVENTARIO/gestion.php">Regresar</a><br>
<!-- FINAL DE LA SECCION SUPERIOR DE NAVEGACIÓN  -->

    <h1>Editar Venta</h1>
    <form action="procesar_editar_venta.php" method="post">
        <input type="hidden" name="venta_id" value="<?php echo $venta['venta_id']; ?>">
        Producto ID: <input type="number" name="productov_id" value="<?php echo $venta['productov_id']; ?>" required><br>
        Cliente Usuario: <input type="text" name="clienteUsuario" value="<?php echo $venta['clienteUsuario']; ?>" required><br>
        Cantidad de Venta: <input type="number" name="cantidadventa" value="<?php echo $venta['cantidadventa']; ?>" required><br>
        Importe: <input type="number" step="0.01" name="Importe" value="<?php echo $venta['Importe']; ?>" required><br>
        Tipo de Entrega:
        <select name="tipo_entrega" required>
            <option value="domicilio" <?php echo ($venta['tipo_entrega'] == 'domicilio') ? 'selected' : ''; ?>>Domicilio</option>
            <option value="local" <?php echo ($venta['tipo_entrega'] == 'local') ? 'selected' : ''; ?>>Local</option>
        </select><br>
        Estatus de Pago:
        <select name="estatuspago" required>
            <option value="PROCESANDO" <?php echo ($venta['estatuspago'] == 'PROCENSADO') ? 'selected' : ''; ?>>Procesando</option>
            <option value="CANCELADO" <?php echo ($venta['estatuspago'] == 'CANCELADO') ? 'selected' : ''; ?>>Cancelado</option>
            <option value="PAGADO" <?php echo ($venta['estatuspago'] == 'PAGADO') ? 'selected' : ''; ?>>Pagado</option>
        </select><br>
        Fecha de Venta: <input type="date" name="fechaventa" value="<?php echo $venta['fechaventa']; ?>" required><br>
        <input type="submit" value="Actualizar Venta">
    </form>
</body>
</html>
