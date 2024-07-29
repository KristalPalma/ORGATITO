
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
                  <li><a class=principal-btn href="../../AdminProductos/datospago.php">Datos de pago</a></li>
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

<div class="box-container"><h1>  Agregar productos </h1></div> <br>

    <h2 style="transform: translate(18%, 40%); font-size: 25px;;" >En esta sección podrás modificar los detalles de venta de tu producto.</h2><br>

    <div ><form  action="modificar.php" style="transform: translate(30%,10%); font-size: 25px;;"
     method="GET" enctype="multipart/form-data">


     <h2 class="nombre"><?php echo htmlspecialchars($product['nombre']); ?></h2>
     <br></br>

        <label for="">Tipo</label>
        <select style="background-color: #acf5ac; border-radius: 4px; width: 15%; font-size: 25px;" name="categoria">
        <option value="Verdura" <?php echo $product['categoria'] == 'Verdura' ? 'selected' : ''; ?>>Verdura</option>
        <option value="Fruta" <?php echo $product['categoria'] == 'Fruta' ? 'selected' : ''; ?>>Fruta</option>
        <option value="<?php echo htmlspecialchars($product['categoria']); ?>" <?php echo !in_array($product['categoria'], ['Verdura', 'Fruta']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($product['categoria']); ?></option>
        </select>
        <br><br>    

        <label for="">CANTIDAD</label>
        <input value="<?php echo htmlspecialchars($product['cantidad']); ?>" 
        type="int" name="cantidad" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;" placeholder="Cantidad de tu producto en kilos">
        <br></br>   

        <label for="">PRECIO</label>
        <input value="<?php echo number_format($product['precio_kilo'], 2); ?>" 
        type="number" name="precio_kilo" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;"  placeholder="Precio de tu producto por kilo">
        <br></br>
  
        <label for="">TIPO DE ENTREGA</label>
        <select name="tipo_entrega" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <option value="Local" <?php echo ($product['tipo_entrega'] == 'Local') ? 'selected' : ''; ?>>Local</option>
        <option value="Domicilio" <?php echo ($product['tipo_entrega'] == 'Domicilio') ? 'selected' : ''; ?>>Domicilio</option>
        </select>
        <br></br>


        <input type="hidden" name="id" value="<?php echo $id ?>"> 

        <input type="submit" value="Actualizar" style="background-color: #acf5ac; font-size:25px; border-radius:10px; transform: translate(260%, 50%) ">
        <br></br>
    </form> 

</div>

<br>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../../images/orgatito2.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>

</html>