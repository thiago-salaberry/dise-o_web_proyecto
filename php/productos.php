<?php

require_once 'sistema.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['ID_cliente'])) {
    header("Location: ../registro_inicio_sesion.html"); // Redirigir a la página de inicio de sesión y registro
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/productos.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../inicio.html">Inicio</a></li>
                <li><a href="../php/productos.php">Productos</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
            <div>
                <a href="../php/perfil.php"><img class="perfil" src="../imagenes/foto_perfil.png" alt=""></a>
                <img class="logo"  src="../imagenes/logo.png" alt="">
            </div>
        </nav>
    </header>
    <main>
        <section class="introduccion">
            <div class="titulo">
                <h1>Diseños únicos, creados a partir de una base sólida</h1>
            </div>
            <div class="texto">
                <p>
                    ¿Buscas algo único y especial? En Printcraft3D te ofrecemos una amplia gama de diseños 
                    predefinidos que podrás personalizar a tu gusto. Desde prótesis funcionales y estéticas 
                    hasta decoraciones y figuras coleccionables, tenemos el modelo perfecto para ti. 
                    ¡Explora nuestro catálogo y encuentra el producto que encaja contigo!
                </p>
            </div>
            <div class="texto">
                <p>En nuestra página encontrarás más información sobre:</p>
                <ul>
                    <li>Nuestros productos y sus características</li>
                    <li>Precios competitivos</li>
                    <li>Cómo puedes encargar pedidos a tu gusto</li>
                </ul>
            </div>
            <div class="texto">
                <p>Para seguir explorando preciona el boton de perfil arriba a la derecha. En caso que no lo hagas se te reenviara directamente si sales de la pagina inicio</p>
            </div>
        </section>
    </main>
</body>
</html>