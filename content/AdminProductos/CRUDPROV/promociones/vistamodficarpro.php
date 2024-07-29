
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


if (isset($product['promocion']) !== '') {
    $promocion = (float)$product['promocion'];
} else {
    $promocion = 0; // Valor predeterminado 0 si es nulo, vacío o no es numérico
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="../../../../styles/estilos.css">
</head>

<body>

<!-- SECCION SUPERIOR DE NAVEGACIÓN  -->
<header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
              <li><a class=principal-btn href="../../../indexproveedor.html">Inicio</a></li>
                  <li><a class=principal-btn href="../../../AdminProductos/administracion.html">Administración de productos</a></li>
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
    <br><a class=principal-btn  href="../../../AdminProductos/INVENTARIO/misproductos.php">Regresar</a>
    
<!-- SECCION SUPERIOR DE NAVEGACIÓN  -->

<div class="box-container"><h1> Gestión de promoción </h1></div> <br>

    <h2 style="transform: translate(18%, 40%); font-size: 25px;;" > Agrega el valor de descuento en pesos que deseas aplicar a tu 
    producto.</h2><br>

    <div ><form  action="modificarpro.php" style="transform: translate(30%,10%); font-size: 25px;;"
     method="GET" >


     <h2 class="nombre"><?php echo htmlspecialchars($product['nombre']); ?></h2>

     <h5 class="nombre">Promoción actual: $<?php echo $promocion; ?></h5>
     <h5 class="nombre">Precio inicial:$<?php echo htmlspecialchars($product['precio_kilo']); ?></h5>
     <br></br>

     <label for="">PROMOCIÓN</label>
        <input type="numero" name="promocion" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>


        <input type="hidden" name="id" value="<?php echo $id ?>"> 

        <input type="submit" value="Subir" style="background-color: #acf5ac; font-size:25px; border-radius:10px; transform: translate(260%, 50%) ">
        <br></br>
    </form> 

</div>

<br>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../../../images/orgatito2.png" alt="ORGATITO" style="width: 500px; transform: translateX(100%);"></div>

</body>

</html>