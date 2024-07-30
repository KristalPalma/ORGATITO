<?php
include '../../../conexion.php';

$conexion = $con;

// Obtener el producto_id de la URL
$producto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el producto existe
$sql_producto = "SELECT * FROM productos WHERE producto_id = ?";
$stmt_producto = $conexion->prepare($sql_producto);
$stmt_producto->bind_param("i", $producto_id);
$stmt_producto->execute();
$result_producto = $stmt_producto->get_result();

if ($result_producto->num_rows == 0) {
    echo "Producto no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Venta</title>
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


<div class="box-container"><h1>  Agregar Venta </h1></div> <br>

    <div ><form style="transform: translate(30%,10%); font-size: 25px;" action="procesar_agregarV.php"  method="post">


        <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($producto_id); ?>">
        <input type="hidden" name="productov_id" value="<?php echo htmlspecialchars($producto_id); ?>">

        Cliente(usuario): <input type="text" name="clienteUsuario" required style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;" ><br>
        <br>

        Cantidad de Venta: <input type="number" name="cantidadventa" required style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;"><br>
        <br>

        Importe: <input type="number" step="0.01" name="Importe" required style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;"><br>
        <br>

        Tipo de Entrega:
        <select name="tipo_entrega" required style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
            <option value="domicilio">Domicilio</option>
            <option value="local">Local</option>
        </select><br>
        <br>



        Estatus de Pago:
        <select name="estatuspago" required style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
            <option value="PROCESANDO">Procesando</option>
            <option value="CANCELADO">Cancelado</option>
            <option value="PAGADO">Pagado</option>
        </select><br>
        <br>


        Fecha de Venta: <input type="date" name="fechaventa" required style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;"><br>
        <input type="submit" value="Agregar Venta" style="background-color: #acf5ac; font-size:25px; border-radius:10px; transform: translate(100%, 50%) " ><br>
    </form></div>


    <br></br>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../../../images/orgatito2.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>
</html>
