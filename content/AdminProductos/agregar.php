<?php

include '../conexion.php';

$conexion= $con;

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $categoria	 = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    $precio_kilo = $_POST['precio_kilo'];
    $imagen = $_POST['imagen'];
    $promocion = $_POST['promocion'];
    $tipo_entrega = $_POST['tipo_entrega'];



    $peticionInsertar = "INSERT INTO productos (nombre, categoria, cantidad, precio_kilo, imagen, promocion, tipo_entrega)
    VALUES ('$nombre','$categoria','$cantidad','$precio_kilo','$imagen','$promocion','$tipo_entrega')";

if (mysqli_query($conexion, $peticionInsertar)) {
    echo "ACTUALIZACION COMPLETA";
    header("location: ./MENSAJES/exitoso.html ");
    
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
</head>

<body>

    <a href="./OpcionesProductos.html">Regresar</a>
    <?php foreach ($errores as $error): ?>
        <div style="background-color: black; color: red;"><?php echo $error ?></div>
    <?php endforeach ?>



    <h1>INGRESO DE PRODUCTOS</h1>
    <h2>En esta sección podrás agregar los detalles de un nuevo producto.</h2>
    <form action="agregar.php" method="POST">


         <label for="">TIPO</label>
        <select name ="categoria" >
            <option value = "Verdura">Verdura</option>
            <option value = "Fruta">Fruta</option>
        </select>

        <label for="">NOMBRE DEL PRODUCTO</label>
        <input type="text" name="nombre">
        <br></br>

        <label for="">CANTIDAD</label>
        <input type="int" name="cantidad">

        <label for="">PRECIO</label>
        <input type="number" name="precio_kilo">

        <label for="">PROMOCIÓN</label>
        <input type="int" name="promocion">

        <label for="">TIPO DE ENTREGA</label>
        <select name ="tipo_entrega" >
            <option value = "Local">Local</option>
            <option value = "Domicilio">Domicilio</option>
        </select>       

        <label for="">IMAGEN</label>
        <input type="text" name="imagen">

        <input type="submit" value="Envíar">
    </form>
</body>

</html>