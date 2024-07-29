


<?php 

include '../../../conexion.php';

$conn= $con;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


$query2 = "SELECT * FROM productos where producto_id = ?";
$stmt = $conn->prepare($query2);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administradore</title>
    <link rel="stylesheet" href="../../../../styles/estilos.css">
</head>
<body>
    <header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../../../indexproveedor.html">Inicio</a></li>
                  <li><a class=principal-btn href="../../administracion.html">Administración de productos</a></li>
                  <li><a class=principal-btn href="../../content/AdminProductos/inventario.html">Inventario</a></li>
                  <li><a class=principal-btn href="../../../AdminProductos/datospago.php">Datos de pago</a></li>
              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../../../../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>


    <br><a class=principal-btn  href="../../INVENTARIO/misproductos.php">Regresar</a>

    <div class="box-container"><h1> Promociónes </h1></div>


    <h1 class="centered-text" >  Agrega y gestiona tu promoción para este producto y asi 
    lograr una venta más rapida de ellos.</h1>

<div class="container2" >
    <a class="big-btn" href="../promociones/vistamodficarpro.php?id=<?php echo $id ; ?>">Gestionar promoción</a>
    <a class="big-btn" href="../promociones/vistaeliminarpro.php?id=<?php echo $id ; ?>">Eliminar promoción</a>
  </div>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../../../images/orgatito4.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>

</html>