<?php
session_start();

 var_dump($_SESSION);
if (empty($_SESSION )){
  echo "no hay sesión";

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORGATITO</title>

    <link rel="stylesheet" href="styles/estilos.css">

    <link rel="stylesheet" href="styles/global.css">

</head>
<body>

  <header :root class="header">
    <div class="container">
      <div class="logo">
        <img src="images/logo orgatito.png" alt="ORGATITO Logo">
      </div>
        <nav class="nav-gato">
          <ul >
            <li><a class=principal-btn href="content/Catalogo/VistaCatalogo.php">Ver catálogo</a></li>
            <li><a class=principal-btn href="content/AdminUsuarios/usuario/login.php">Iniciar sesión</a></li>
          </ul>
        </nav>
        <a href="cerrar_sesion.php">cerrar sesión </a>
</header>

    <div class="box-container"><h2>Experimenta el verdadero sabor de la frescura.</h2></div>
    <h2>Productos frescos y de temporada.</h2></div>


<section class="hero">
     <div class="container"> <!--añadele una id al container y a esa id metele css, creo q te servirian display:flex, flex-direction:column, align-items:center, depende de q quieras hacer -->
        <h2>Nuestra aplicación busca asociarse con granjas locales para obtener productos frescos de temporada.</h2>
        <p>En ORGATITO, creemos en la importancia de apoyar a los pequeños agricultores y a las comunidades locales. Por eso, nos sentimos orgullosos de trabajar con Doña Lucy, una agricultora apasionada que dedica su vida a cultivar productos frescos y de alta calidad. Al elegir los productos de Doña Lucy, no solo está disfrutando de una deliciosa comida, sino que también está apoyando a una familia y a una forma de vida valiosa.</p>
    </div>
</section>

<section class="productos">
    <div class="container"><!-- igual aqui-->
        <h2>Productos frescos y de temporada</h2>
        <div class="productos-grid">
            </div>
    </div>
</section>

<section class="sobre-nosotros">
    <div class="container"><!-- igual aqui-->
        <h2>¿Quiénes somos?</h2>
        <p>ORGATITO es una empresa comprometida con ofrecer productos frescos, 
        saludables y de origen local. Trabajamos directamente con agricultores locales 
        para garantizar la calidad y frescura de nuestros productos. Además, nos preocupamos
        por el medio ambiente y la sostenibilidad, por lo que implementamos prácticas agrícolas
        amigables con el planeta.</p>
    </div>
</section>

<footer>
    <div class="container"> <!--este ta bien creo, total es el foot-->
        <p>&copy; 2024 ORGATITO. Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>
