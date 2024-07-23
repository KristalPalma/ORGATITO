<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frutasyverduras";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos han sido enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $origen = $_POST['origen'];
    $precio = $_POST['precio'];
    $promocion = $_POST['promocion'];

    // Preparar y enlazar
    $stmt = $conn->prepare("INSERT INTO productos (nombre, tipo, origen, precio, promocion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $tipo, $origen, $precio, $promocion);

    // Ejecutar consulta
    if ($stmt->execute()) {
        echo "Nueva fruta o verdura agregada exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar declaración
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>
