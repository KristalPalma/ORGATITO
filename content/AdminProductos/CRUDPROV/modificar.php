<?php


include '../../conexion.php';

$conexion= $con;

$id = $_GET['id'];
$nombre = $_GET['nombre'];
$categoria	 = $_GET['categoria'];
$cantidad = $_GET['cantidad'];
$precio_kilo = $_GET['precio_kilo'];
//$imagen = $_POST['imagen'];
$archivo=$_FILES['archivo'];
$tipo_entrega = $_GET['tipo_entrega'];



$PeticionEditar = "UPDATE productos set nombre = '$nombre', categoria = '$categoria', cantidad= '$cantidad',
 precio_kilo= '$precio_kilo', imagen= '$archivo', tipo_entrega= '$tipo_entrega' WHERE producto_id = ?";

if (mysqli_query($conexion, $PeticionEditar)) {
echo "ACTUALIZACION COMPLETA";
header("location:../MENSAJES/exitoso.html");

exit(); 
} else {
echo "no se pudo actualizar";
}

?>