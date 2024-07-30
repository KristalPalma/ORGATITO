<?php
// Configuración de la conexión a la base de datos
include '../conexion.php';

$conn= $con;



// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de los proveedores
$sql = "SELECT proveedor_id, direccion, telefono, correo, numero, concepto, nombre_beneficiario, fecha_expiracion FROM proveedores";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Proveedores</title>
    <link rel="stylesheet" href="../../styles/estilos.css">

    <header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../../content/indexproveedor.php">Inicio</a></li>
                  <li><a class=principal-btn href="../AdminProductos/administracion.html">Administración de productos</a></li>
                  <li><a class=principal-btn href="../../content/AdminProductos/inventario.html">Inventario</a></li>
                  <li><a class=principal-btn href="../../content/AdminProductos/DatosPago.html">Datos de pago</a></li>
              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>

    <style>
        .proveedor {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #e2d5e9;
        }
        .proveedor h2 {
            margin-top: 0;
        }
        .proveedor div {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<br><a class=principal-btn  href="DatosPago.html">Regresar</a>
<div class="box-container"><h1>  Lista de Datos de pago </h1></div>

<?php
if ($result->num_rows > 0) {
    // Salida de datos por cada fila
    while($row = $result->fetch_assoc()) {
        echo "<div class='proveedor'>
                <h2>Proveedor</h2>
                <div><strong>Dirección:</strong> " . $row["direccion"]. "</div>
                <div><strong>Teléfono:</strong> " . $row["telefono"]. "</div>
                <div><strong>Correo:</strong> " . $row["correo"]. "</div>
                <div><strong>Número:</strong> " . $row["numero"]. "</div>
                <div><strong>Concepto:</strong> " . $row["concepto"]. "</div>
                <div><strong>Nombre del Beneficiario:</strong> " . $row["nombre_beneficiario"]. "</div>
                <div><strong>Fecha de Expiración:</strong> " . $row["fecha_expiracion"]. "</div>
                <div><a href='eliminardato.php?proveedor_id=" . $row["proveedor_id"] . "' class='button'>Eliminar</a></div>
              </div>";
    }
} else {
    echo "<p>No se encontraron resultados</p>";
}
$conn->close();
?>

</body>
</html>