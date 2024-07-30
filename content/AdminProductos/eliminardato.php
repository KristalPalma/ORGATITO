<?php
// Configuración de la conexión a la base de datos
include '../conexion.php';

$conn= $con;


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado un ID para eliminar
if (isset($_GET['proveedor_id'])) {
    $proveedor_id = $_GET['proveedor_id'];

    // Consulta SQL para eliminar el proveedor
    $sql_delete = "DELETE FROM proveedores WHERE proveedor_id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $proveedor_id);

    if ($stmt->execute()) {
        header("location: MENSAJES/eliminadoexitosodato.html");
    } else {
        echo "<p>Error al eliminar el proveedor.</p>";
    }
    $stmt->close();
} else {
    echo "<p>ID de proveedor no proporcionado.</p>";
}

$conn->close();
?>

<a href="listar_proveedores.php">Volver a la lista de proveedores</a>
