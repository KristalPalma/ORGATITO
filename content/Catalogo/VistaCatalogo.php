<?php
session_start();

// Verificar si el usuario está autenticado y es cliente
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipo_usuario'] !== 'cliente') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="../../styles/jesus/catalogo.css">
    <link rel="stylesheet" href="../../styles/estilos.css">
</head>
<body>

<header class="header">
    <div class="container">
        <div class="logo">
            <img src="../../images/logo orgatito.png" alt="ORGATITO Logo">
        </div>
        <nav>
            <ul>
                <li><a class="principal-btn" href="../../content/AdminProductos/datospago.html">Datos de pago</a></li>
            </ul>
        </nav>
        <div class="container">
            <div class="logo">
                <img src="../../images/sesionn.png" alt="sesion Logo">
            </div>
        </div>
    </div>
</header>

<div id="catalogo-container">
    <div id="titulo">
        <h1>Selección de Productos</h1>
    </div>

    <?php
    // Verificar si hay resultadosssssssss
    include '../conexion.php';
    $conn = $con;
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta para extraer los datos de la tabla 'productos'
    $sql = "SELECT producto_id, nombre, categoria, cantidad, precio_kilo, imagen, promocion, tipo_entrega FROM productos";
    $result = $conn->query($sql);
    
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        echo '<div id="catalogo">';
        while($row = $result->fetch_assoc()) {
            echo '<div class="producto">';
            echo '<img src="../AdminProductos/CRUDPROV/imagenes/' . $row["imagen"] . '" alt="' . $row["nombre"] . '" />';
            echo '<div class="detalle-producto">';
            echo '<span class="nombre">Nombre: ' . $row["nombre"] . '</span><br>';
            echo '<span class="categoria">Categoría: ' . $row["categoria"] . '</span><br>';
            echo '<span class="cantidad">Cantidad: ' . $row["cantidad"] . '</span><br>';
            echo '<span class="precio">Precio: $' . number_format($row["precio_kilo"], 2) . '/kg</span><br>';
            echo '<span class="promocion">Promoción: ' . $row["promocion"] . '</span><br>';
            echo '<span class="tipo_de_entrega">Tipo de entrega: ' . $row["tipo_entrega"] . '</span><br>';
            echo '<div class="botones">';
            echo '<a href="Detalles_del_producto.php?id=' . $row["producto_id"] . '" class="ver-mas-btn">Ver más</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No se encontraron productos.";
    }
    
    // Cerrar conexión
    $conn->close();
    ?>
    
    
    

</div>

<a class=principal-btn href="/../AdminProductos/CRUDPROV/imagenes">Inicio</a>

</body>
</html>