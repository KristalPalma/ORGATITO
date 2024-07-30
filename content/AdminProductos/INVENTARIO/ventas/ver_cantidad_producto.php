<?php
include '../../../conexion.php';

$conexion = $con;

// Obtener el ID del producto desde la URL
$producto_id = isset($_GET['producto_id']) ? (int)$_GET['producto_id'] : 0;

// Verificar que el ID se ha pasado correctamente
if ($producto_id == 0) {
    echo "ID de producto inválido.";
    exit;
}

// Consultar la cantidad actual del producto
$sql_producto = "SELECT cantidad FROM productos WHERE producto_id = ?";
$stmt_producto = $conexion->prepare($sql_producto);
if (!$stmt_producto) {
    echo "Error en la preparación de la consulta: " . $conexion->error;
    exit;
}

$stmt_producto->bind_param("i", $producto_id);
$stmt_producto->execute();
$result_producto = $stmt_producto->get_result();

if ($result_producto->num_rows == 0) {
    echo "Producto no encontrado.";
    exit;
}

$producto = $result_producto->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Cantidad del Producto</title>
    <link rel="stylesheet" href="../../../../styles/estilos.css">
    <link rel="stylesheet" href="../../../../styles/tabla.css">
    <style>
        .cantidad {
            font-size: 2em;
            color: #333;
        }
    </style>
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

<div class="box-container"><h1>  Cantidad Actual del Producto </h1></div> <br>
<h2 style="transform: translate(40%, 40%); font-size: 25px;;" >Stock Actual: <?php echo $producto['cantidad']; ?> kg</h2>
    </div>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../../../images/orgatito5.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>
</html>
