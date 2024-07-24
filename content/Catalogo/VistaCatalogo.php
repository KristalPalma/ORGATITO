<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="../../styles/estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C5FBAD;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .header {
            width: 100%;
            background-color: #0000FF; /* Color azul de la barra */
            padding: 15px; /* Ajusta el alto de la barra */
            box-sizing: border-box;
        }
        .header .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .header .logo img {
            width: 100px; /* Ajusta el ancho según sea necesario */
            height: auto;
        }
        nav ul {
            list-style: none;
            display: flex;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            background-color: #1b6500;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }
        #catalogo-container {
            width: 100%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 20px 40px;
            box-sizing: border-box;
        }
        #titulo {
            width: 90%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        #titulo h1 {
            font-size: 4.5em;
            margin: 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }
        #catalogo {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .producto {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px 0;
            padding: 10px;
            background-color: #fff;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .producto img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .detalle-producto {
            text-align: left;
            padding: 10px;
        }
        .nombre {
            font-size: 1.2em;
            font-weight: bold;
        }
        .precio {
            color: #1b6500;
            font-weight: bold;
            display: inline-block;
            margin-right: 10px;
        }
        .promocion {
            color: #ff0000;
            display: inline-block;
        }
        .botones {
            margin-top: 10px;
        }
        .botones button {
            background-color: #1b6500;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="logo">
            <img src="../../images/logo orgatito.png" alt="ORGATITO Logo">
        </div>
        <nav>
            <ul>
                <li><a class="principal-btn" href="../AdminProductos/administracion.html">Administración de productos</a></li>
                <li><a class="principal-btn" href="../../content/AdminProductos/inventario.html">Inventario</a></li>
                <li><a class="principal-btn" href="../../content/AdminProductos/datospago.html">Datos de pago</a></li>
            </ul>
        </nav>
        <div class="logo">
            <img src="../../images/sesionn.png" alt="sesion Logo">
        </div> 
    </div>
</header>

<div id="catalogo-container">
    <div id="titulo">
        <h1>Selección de Productos</h1>
    </div>
    <div id="catalogo">
        <div class="producto">
            <img src="imagen.jpg" alt="Producto">
            <div class="detalle-producto">
                <span class="nombre">Nombre del Producto</span><br>
                <span class="categoria">Categoría</span><br>
                <span class="cantidad">Cantidad</span><br>
                <div>
                    <span class="precio">$9.99/kg</span>
                    <span class="promocion">En promoción</span>
                </div>
                <div class="botones">
                    <button>1 kg</button>
                    <button>5 kg</button>
                    <button>10 kg</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
