<?php
include '../conexion.php'; // Asegúrate de que la conexión a la base de datos esté correcta

$conn = $con;

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para extraer los datos de la tabla 'productos'
$sql = "SELECT nombre, categoria, cantidad, precio_kilo, imagen, promocion, tipo_entrega FROM productos";
$result = $conn->query($sql);

// Verificar si hay resultados
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #catalogo {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .producto {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            width: 250px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .producto img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .nombre, .categoria, .cantidad, .precio, .promocion, .tipo_de_entrega {
            display: block;
            margin: 8px 0;
        }
        .precio {
            color: green;
            font-weight: bold;
        }
        .promocion {
            color: red;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Catálogo de Productos</h1>
    <div id="catalogo">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<article class="producto">';
                echo '<img src="' . $row["imagen"] . '" alt="' . htmlspecialchars($row["nombre"]) . '" />';
                echo '<span class="nombre">Nombre: ' . htmlspecialchars($row["nombre"]) . '</span>';
                echo '<span class="categoria">Categoría: ' . htmlspecialchars($row["categoria"]) . '</span>';
                echo '<span class="cantidad">Cantidad: ' . htmlspecialchars($row["cantidad"]) . '</span>';
                echo '<span class="precio">Precio por kilo: $' . number_format($row["precio_kilo"], 2) . '</span>';
                echo '<span class="promocion">Promoción: ' . htmlspecialchars($row["promocion"]) . '</span>';
                echo '<span class="tipo_de_entrega">Tipo de entrega: ' . htmlspecialchars($row["tipo_entrega"]) . '</span>';
                echo '</article>';
            }
        } else {
            echo "<p>No se encontraron productos.</p>";
        }
        ?>
    </div>
</body>
</html>
<?php
// Cerrar conexión
$conn->close();
?>

