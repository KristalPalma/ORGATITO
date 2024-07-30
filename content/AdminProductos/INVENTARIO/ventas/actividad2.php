
<!DOCTYPE html>
<html>
<head>
    <title>Actividad</title>
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

<div class="box-container"><h1>   Ventas actuales y estatus</h1></div> <br> 

<div class="form-container">
    <form action="actividad.php" method="post">
        <input type="submit" value="Actualizar ..." >
    </form>
</div>


</body>
</html>

<?php
include '../../../conexion.php';

$conexion = $con;

// Obtener el ID del producto desde la URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Corregir la consulta SQL eliminando el uso incorrecto de *
$sql = "SELECT venta_id, clienteUsuario, cantidadventa, Importe, tipo_entrega, estatuspago, fechaventa FROM ventassss WHERE productov_id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Imprimir la tabla HTML
echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <th> <font face="lucida console">ID</font> </td>
          <th> <font face="lucida console">CLIENTE</font> </td> 
          <th> <font face="lucida console">CANTIDAD</font> </td> 
          <th> <font face="lucida console">IMPORTE TOTAL</font> </td> 
          <th> <font face="lucida console">TIPO DE ENVÍO </font> </td> 
          <th> <font face="lucida console">ESTATUS DE PAGO</font> </td> 
          <th> <font face="lucida console">FECHA DE VENTA </font> </td>
          <th> <font face="lucida console">ACCIONES</font> </td> 
      </tr>';

// Procesar los resultados de la consulta y mostrarlos en la tabla
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['venta_id']}</td>
        <td>{$row['clienteUsuario']}</td>
        <td>{$row['cantidadventa']}kg</td>
        <td>$ {$row['Importe']}</td>
        <td>{$row['tipo_entrega']}</td>
        <td>{$row['estatuspago']}</td>
        <td>{$row['fechaventa']}</td>
        <td>
            <a href='editar_venta.php?venta_id={$row['venta_id']}'>Editar</a> | 
            <a href='EliminarV.php?venta_id={$row['venta_id']} '>Eliminar</a>
        </td>
    </tr>";
}

echo '</table>';

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
?>
