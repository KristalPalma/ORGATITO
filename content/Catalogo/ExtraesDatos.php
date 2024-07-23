<?php
include '../conexion.php';

$conn= $con;z

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para extraer los datos de la tabla 'productos'
$sql = "SELECT nombre, categoria, cantidad, precio_kilo, imagen, promocion, tipo_entrega FROM productos";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los datos en formato HTML
    echo '<div id="catalogo">';
    while($row = $result->fetch_assoc()) {
        echo '<article class="producto">';
        echo '<img src="' . $row["imagen"] . '" alt="' . $row["nombre_del_producto"] . '" />';
        echo '<span class="nombre">Nombre: ' . $row["nombre_del_producto"] . '</span>';
        echo '<span class="cantidad">Cantidad: ' . $row["cantidad"] . '</span>';
        echo '<span class="precio">Precio: $' . number_format($row["precio"], 2) . '</span>';
        echo '<span class="promocion">Promoción: ' . $row["promocion"] . '</span>';
        echo '<span class="tipo_de_entrega">Tipo de entrega: ' . $row["tipo_de_entrega"] . '</span>';
        echo '</article>';
    }
    echo '</div>';
} else {
    echo "No se encontraron productos.";
}

// Cerrar conexión
$conn->close();
?>

