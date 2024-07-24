<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
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
        #titulo {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }
        #titulo h1 {
            font-size: 1.5em;
            margin: 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #000; /* Línea negra debajo del texto */
        }
        #catalogo {
            display: flex;
            justify-content: flex-start; /* Alinea los elementos a la izquierda */
            padding: 20px;
            width: 100%; /* Asegura que el contenedor ocupe todo el ancho de la pantalla */
            box-sizing: border-box;
        }
        .producto {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
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
</body>
</html>
