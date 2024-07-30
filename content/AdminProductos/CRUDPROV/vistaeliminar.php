
<?php 

include '../../conexion.php';

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
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="../../../styles/estilos.css">
</head>

<body>

<!-- SECCION SUPERIOR DE NAVEGACIÓN  -->
<header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../../indexproveedor.html">Inicio</a></li>
                  <li><a class=principal-btn href="../administracion.html">Administración de productos</a></li>
                  <li><a class=principal-btn href="../../content/AdminProductos/inventario.html">Inventario</a></li>
                  <li><a class=principal-btn href="../../AdminProductos/DatosPago.htmlv">Datos de pago</a></li>
              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../../../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>
    <br><a class=principal-btn  href="../../AdminProductos/administracion.html">Regresar</a>
    
<!-- SECCION SUPERIOR DE NAVEGACIÓN  -->


<h1 class="box-container2">"Esta seguro de eliminar el producto?"</h1>
<h2 style="transform: translate(18%, 40%); font-size: 25px;;" >Una vez eliminado no habrá forma de recuperarlo.</h2><br>
 
    <div ><form  action="eliminar.php" style="transform: translate(30%,10%); font-size: 25px;;"
     method="GET" >


        <input type="hidden" name="id" value="<?php echo $id ?>"> 

        <input type="submit" value="Estoy seguro de eliminar" style="background-color: #acf5ac; font-size:25px; border-radius:10px; transform: translate(260%, 50%) ">
        <br></br>
    </form> 

</div> <br>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../../images/orgatito2.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>

</html>