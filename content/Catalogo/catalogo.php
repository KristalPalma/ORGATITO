<?php
// Este archivo simularía agregar el producto al carrito de compras

// Recibir datos del producto y peso desde la URL
$producto = $_GET['producto'];
$peso = $_GET['peso'];

// Aquí podrías implementar la lógica para agregar el producto al carrito
// Por ejemplo, podrías guardar estos datos en una sesión o una base de datos

// Redirigir de vuelta al catálogo
header('Location: catalogo.php');
exit;
?>