<?php


include '../../../conexion.php';

$conexion= $con;

$id = $_GET['id'];
$promocion = $_GET['promocion'];

$PeticionPro = "UPDATE productos set promocion = '$promocion' where producto_id ='$id' ";

if (mysqli_query($conexion, $PeticionPro)) {
echo "ACTUALIZACION COMPLETA";
header("location:../../MENSAJES/Actualizacion.html");

exit(); 
} else {
echo "no se pudo actualizar";
}

?>