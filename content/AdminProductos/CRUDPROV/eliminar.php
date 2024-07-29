<?php


include '../../conexion.php';

$conexion= $con;

$id = $_GET['id'];

$peticioneliminar = "DELETE FROM productos WHERE producto_id ='$id'";;

if (mysqli_query($conexion, $peticioneliminar)) {
echo "ACTUALIZACION COMPLETA";
header("location:../MENSAJES/eliminadoexitoso.html");

exit(); 
} else {
echo "no se pudo actualizar";
}


?>