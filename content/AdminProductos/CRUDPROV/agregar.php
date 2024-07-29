<?php

include '../../conexion.php';

$conexion= $con;

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $categoria	 = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    $precio_kilo = $_POST['precio_kilo'];
    //$imagen = $_POST['imagen'];
    $archivo=$_FILES['archivo'];
    $tipo_entrega = $_POST['tipo_entrega'];

    $carpeta="imagenes";
    $nombreArchivo = uniqid(rand(), true). ".jpeg";

    var_dump($archivo);

    if(!is_dir($carpeta)){
        mkdir($carpeta);}

    move_uploaded_file($archivo['tmp_name'], $carpeta."/".$nombreArchivo);

    $peticionInsertar = "INSERT INTO productos (nombre, categoria, cantidad, precio_kilo, imagen, tipo_entrega)
    VALUES ('$nombre','$categoria','$cantidad','$precio_kilo','$nombreArchivo','$tipo_entrega')";

if (mysqli_query($conexion, $peticionInsertar)) {
    echo "ACTUALIZACION COMPLETA";
    header("location: ../MENSAJES/exitoso.html");
    
    exit(); 
} else {
   echo "no se pudo actualizar";
 }

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

    <?php foreach ($errores as $error): ?>
        <div style="background-color: black; color: red;"><?php echo $error ?></div>
    <?php endforeach ?>

    <h2 style="transform: translate(18%, 40%); font-size: 25px;;" >En esta sección podrás agregar los detalles de un nuevo producto.</h2><br>

    <div ><form  action="agregar.php" style="transform: translate(30%,10%); font-size: 25px;;"
     method="POST" enctype="multipart/form-data">

         <label  for="">Tipo</label>
        <select style="background-color: #acf5ac; border-radius: 4px; width: 15%; font-size: 25px;" name ="categoria" >
            <option value = "Verdura">Verdura</option>
            <option value = "Fruta">Fruta</option>
        </select>
        <br></br>

        <label for="">NOMBRE DEL PRODUCTO</label>
        <input type="text" name="nombre" placeholder="Nombre de tu producto" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>

        <label for="">CANTIDAD</label>
        <input type="number" name="cantidad" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;" placeholder="Cantidad de tu producto en kilos">
        <br></br>   

        <label for="">PRECIO</label>
        <input type="number" name="precio_kilo" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;"  placeholder="Precio de tu producto por kilo">
        <br></br>

        <label for="">TIPO DE ENTREGA</label>
        <select name ="tipo_entrega" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
            <option value = "Local">Local</option>
            <option value = "Domicilio">Domicilio</option>
        </select>
        <br></br>       

        <label for="">IMAGEN</label>
        <input type="file" name="archivo" accept="image/jpeg, image/png" style="background-color: #acf5ac">
        <br></br>

        <input type="submit" value="Envíar" style="background-color: #acf5ac; font-size:25px; border-radius:10px; transform: translate(260%, 50%) ">
        <br></br>
    </form> 
</div>

<br>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../../images/orgatito2.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>

</html>