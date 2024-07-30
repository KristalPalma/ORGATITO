<?php

include '../conexion.php';

$conexion= $con;

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $direccion = $_POST['direccion'];
    $telefono	 = $_POST['telefono'];
    $correo = $_POST['correo'];
    $numero = $_POST['numero'];
    $concepto = $_POST['concepto'];
    $nombre_beneficiario = $_POST['nombre_beneficiario'];
    $mesAnio = $_POST['mes-anio'];

    $fecha_expiracion = $mesAnio . '-01';


    $peticionInsertar = "INSERT INTO proveedores (direccion, telefono, correo, numero, concepto, nombre_beneficiario, fecha_expiracion)
    VALUES ('$direccion','$telefono','$correo','$numero','$concepto', '$nombre_beneficiario','$fecha_expiracion')";

if (mysqli_query($conexion, $peticionInsertar)) {
    echo "ACTUALIZACION COMPLETA";
    header("location: MENSAJES/exitoso.html");
    
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
    <title>Datos de pago</title>
    <link rel="stylesheet" href="../../styles/estilos.css">
</head>

<body>

<header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../../indexproveedor.html">Inicio</a></li>
                  <li><a class=principal-btn href="../AdminProductos/administracion.html">Administración de productos</a></li>
                  <li><a class=principal-btn href="../../content/AdminProductos/inventario.html">Inventario</a></li>
                  <li><a class=principal-btn href="../AdminProductos/DatosPago.html">Datos de pago</a></li>
              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>


    <br><a class=principal-btn  href="../indexproveedor.html">Regresar</a>
<div class="box-container"><h1> Datos de Pago</h1></div> <br>

    <?php foreach ($errores as $error): ?>
        <div style="background-color: black; color: red;"><?php echo $error ?></div>
    <?php endforeach ?>

    <h2 style="transform: translate(18%, 40%); font-size: 25px;;" >En esta sección podrás agregar los datos de pago para un mejor control de ellos</h2>

    <div ><form  action="datospago.php" style="transform: translate(29%,9%); font-size: 25px;;"
     method="POST" enctype="multipart/form-data">


     <h4> Datos de contacto para entrega al cliente</h4>
     <h6> Estos datos serán visualizados por el cliente</h6>
        <label for=""> Direccion para recoger pedido</label>
        <input type="text" name="direccion" placeholder="Ingresa la direccion de local" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>

        <label for="">Telefono</label>
        <input type="number" name="telefono" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;" placeholder="Ingresa tu telefono de contacto">
        <br></br>   

        <label for="">Correo</label>
        <input type="email" name="correo" placeholder="Ingresa tu correo electonico" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>

        <h4> Datos de tarjeta a la que depositará/trasferirá el cliente</h4>
     <h6> Estos datos serán visualizados por el cliente</h6>

        <label for="">Numero de tarjeta</label>
        <input type="number" name="numero" placeholder="Ingresa el numero de tu tajeta" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>   

        <label for=""> Concepto para pago</label>
        <input type="text" name="concepto" placeholder="Ingresa el formato de concepto" maxlength="40" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>

        <label for="">Nombre beneficiario</label>
        <input type="text" name="nombre_beneficiario" placeholder="beneficiario en tajeta" maxlength="40" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>


        <label for="mes-anio">fecha de expiración de la tarjeta</label>
        <input type="month" name="mes-anio" placeholder="fecha de expiración" maxlength="40" style="background-color: #acf5ac; border-radius: 10px; width: 25%; font-size: 25px;">
        <br></br>

        <input type="submit" value="Envíar" style="background-color: #acf5ac; font-size:25px; border-radius:10px; transform: translate(260%, 50%) ">
        <br></br>
    </form> 
</div>

<br>
<h4>.<h4>

<div style="overflow: hidden; gap: 25px;">
  <div> <img src="../../images/orgatito2.png" alt="ORGATITO Logo" style="width: 500px; transform: translateX(100%);"></div>

</body>

</html>