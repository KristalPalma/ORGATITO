<?php

$conexion = mysqli_connect('localhost', 'root', '', 'sm32');

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'];
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $editorial = $_POST['editorial'];
    $imagen = $_POST['imagen'];


    $peticionInsertar = "INSERT INTO libros (isbn, nombre, autor, precio, editorial, imagen) VALUES ('$isbn','$nombre','$autor','$precio','$editorial','$imagen')";

    if ($isbn === '') {
        $errores[] = header("location: http://localhost/TAREASAPPS/Admin/libros/mensaje_error.php");
    }

    if ($nombre === '') {
        $errores[] = header("location: http://localhost/TAREASAPPS/Admin/libros/mensaje_error.php");
    }
    if ($autor === '') {
        $errores[] = header("location: http://localhost/TAREASAPPS/Admin/libros/mensaje_error.php");
    }
    if ($precio === '') {
        $errores[] = header("location: http://localhost/TAREASAPPS/Admin/libros/mensaje_error.php");
    }
    if ($editorial === '') {
        $errores[] = header("location: http://localhost/TAREASAPPS/Admin/libros/mensaje_error.php");
    }
    if ($imagen === '') {
        $errores[] = header("location: http://localhost/TAREASAPPS/Admin/libros/mensaje_error.php");
    }


    if (empty($errores)) {
        if (mysqli_query($conexion, $peticionInsertar)) {
            header("location: http://localhost/TAREASAPPS/Admin/ ");
            exit(); 
        } else {
           header("location: http://localhost/TAREASAPPS/Admin/libros/mensaje_error.php"  . urlencode($conexion->error ));
        }

    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear un libro</title>
</head>

<body>

<style>
body {
   background: #E8D0DD;
}

a {
  outline: none;
  text-decoration:none;
  display: inline-block;
  width: 10.5%;
  text-align: center;
  line-height: 2;
  color: black;

}

a:link {
  color: purple;
}

a:link,
a:focus {
  background: #D4E8D0;
}

a:hover {
  background: #D0E8E3;
}

a:active {
  background: pink;
  color: purple;
}

</style>


    <a href="/libreria/admin/index.php">Regresar</a>
    <?php foreach ($errores as $error): ?>
        <div style="background-color: black; color: red;"><?php echo $error ?></div>
    <?php endforeach ?>
    <form action="crear.php" method="POST">
        <label for="">ISBN</label>
        <input type="text" name="isbn">
        <label for="">Nombre</label>
        <input type="text" name="nombre">
        <label for="">Autor</label>
        <input type="text" name="autor">
        <label for="">Precio</label>
        <input type="number" name="precio">
        <label for="">Editorial</label>
        <input type="text" name="editorial">
        <label for="">Imagen</label>
        <input type="text" name="imagen">
        <input type="submit" value="Envíar">
    </form>
</body>

</html>