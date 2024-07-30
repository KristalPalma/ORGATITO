<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="../../../styles/productos.css">
    <link rel="stylesheet" href="../../../styles/estilos.css">
</head>
<body>


<!-- SECCION SUPERIOR DE NAVEGACIÓN  -->
<header :root class="header">
        <div class="container">
          <div class="logo">
            <img src="../../../images/logo orgatito.png" alt="ORGATITO Logo">
          </div>
            <nav>
              <ul>
                  <li><a class=principal-btn href="../../indexproveedor.php">Inicio</a></li>
                  <li><a class=principal-btn href="../administracion.html">Administración de productos</a></li><br>
                  <li><a class=principal-btn href="../../content/AdminProductos/inventario.html">Inventario</a></li>
                  <li><a class=principal-btn href="../../AdminProductos/datospago.php">Datos de pago</a></li>
              </ul>
          </nav>
          <div class="container">
            <div class="logo">
              <img src="../../../images/sesionn.png" alt="sesion Logo">
            </div> 
        </div>
    </header>

    <br><a class=principal-btn  href="../../../content/AdminProductos/administracion.html">Regresar</a><br>
<!-- FINAL DE LA SECCION SUPERIOR DE NAVEGACIÓN  -->


<div id="catalogo-container">
    <div id="titulo">
        <h1>Selección de Productos</h1>
    </div>

    <?php
    // Verificar si hay resultados
    include '../../conexion.php';
    $conn = $con;
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta para extraer los datos de la tabla 'productos'
    $sql = "SELECT producto_id, nombre, imagen FROM productos";
    $result = $conn->query($sql);
    
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        echo '<div id="catalogo">';
        while($row = $result->fetch_assoc()) {
            echo '<div class="producto">';
            echo '<img src="../CRUDPROV/imagenes/' . $row["imagen"] . '" alt="' . $row["nombre"] . '" />';
            echo '<div class="detalle-producto">';
            echo '<span class="cat-btn">Nombre: ' . $row["nombre"] . '</span><br>';
            echo '<div class="botones">';
            echo '<br>';;
            echo '<a href="prov1prod.php?id=' . $row["producto_id"] . '" class="catt-btn">Vista catalogo</a>';
            echo '</div>';
            echo '<br>';;
            echo '</div>';
            echo '<a class=principal-btn href="../CRUDPROV/vistamodificar.php?id=' . $row["producto_id"] . '">Modificar</a>';;
            echo '<a class=principal-btn href="../CRUDPROV/vistaeliminar.php?id=' . $row["producto_id"] . '">Eliminar</a><br>';;
            echo '<br>';;
            echo '<br><a class=cat-btn style=padding: 20px; href="../CRUDPROV/promociones/adminpro.php?id=' . $row["producto_id"] . '">....Promociones....</a>';;
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No se encontraron productos.";
    }
    
    //Cerrar conexión
    $conn->close();
    ?>
    
</div>





</body>
</html>
