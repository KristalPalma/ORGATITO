<?php


include '../../conexion.php';

$conexion= $con;

$id = $_GET['id'];
$categoria	 = $_GET['categoria'];
$cantidad = $_GET['cantidad'];
$precio_kilo = $_GET['precio_kilo'];
//$imagen = $_POST['imagen'];
$tipo_entrega = $_GET['tipo_entrega'];

$PeticionEditar = "UPDATE productos set categoria = '$categoria', cantidad= '$cantidad',
 precio_kilo= '$precio_kilo', tipo_entrega= '$tipo_entrega' where producto_id ='$id' ";

if (mysqli_query($conexion, $PeticionEditar)) {
echo "ACTUALIZACION COMPLETA";
header("location:../MENSAJES/exitoso.html");

exit(); 
} else {
echo "no se pudo actualizar";
}

?>