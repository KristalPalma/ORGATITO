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
    $promocion = $_POST['promocion'];
    $tipo_entrega = $_POST['tipo_entrega'];

    $carpeta="imagenes";
    $nombreArchivo = uniqid(rand(), true). ".jpg";

    var_dump($archivo);

    if(!is_dir($carpeta)){
        mkdir($carpeta);}

    move_uploaded_file($archivo['tmp_name'], $carpeta."/".$nombreArchivo);

    $peticionInsertar = "INSERT INTO productos (nombre, categoria, cantidad, precio_kilo, imagen, promocion, tipo_entrega)
    VALUES ('$nombre','$categoria','$cantidad','$precio_kilo','$nombreArchivo','$promocion','$tipo_entrega')";

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
                  <li><a class=principal-btn href="../../content/AdminProductos/datospago.html">Datos de pago</a></li>
              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../../../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>


    <br><a class=principal-btn  href="../../AdminProductos/administracion.html">Regresar</a>
<div class="box-container"><h1>  Agregar productos </h1></div>

    <?php foreach ($errores as $error): ?>
        <div style="background-color: black; color: red;"><?php echo $error ?></div>
    <?php endforeach ?>



    <h1>INGRESO DE PRODUCTOS</h1>
    <h2>En esta sección podrás agregar los detalles de un nuevo producto.</h2>

    <div class="form-container"><form action="agregar.php" method="POST" enctype="multipart/form-data">


         <label for="">Tipo</label>
        <select name ="categoria" >
            <option value = "Verdura">Verdura</option>
            <option value = "Fruta">Fruta</option>
        </select>
        <br></br>

        <label for="">NOMBRE DEL PRODUCTO</label>
        <input type="text" name="nombre">
        <br></br>

        <label for="">CANTIDAD</label>
        <input type="int" name="cantidad">
        <br></br>

        <label for="">PRECIO</label>
        <input type="number" name="precio_kilo">
        <br></br>

        <label for="">PROMOCIÓN</label>
        <input type="int" name="promocion">
        <br></br>

        <label for="">TIPO DE ENTREGA</label>
        <select name ="tipo_entrega" >
            <option value = "Local">Local</option>
            <option value = "Domicilio">Domicilio</option>
        </select>
        <br></br>       

        <label for="">IMAGEN</label>
        <input type="file" name="archivo" accept="image/jpeg, image/png">
        <br></br>

        <input type="submit" value="Envíar">
        <br></br>
    </form></div>


</body>

</html>