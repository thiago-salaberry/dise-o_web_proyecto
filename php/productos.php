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
                <p>En este apartado encontrarás todo sobre nuestros productos de:(haga click en cualquiera para verlos mas rapido)</p>
                <ul>
                    <li><a href="#figuras">Figuras coleccionables</a></li>
                    <li><a href="#decoraciones">Decoraciones para el hogar</a></li>
                    <li><a href="#protesis">Protesis determinadas</a></li>
                </ul>
            </div>
        </section>
        <section id="#figuras">
            <?php
            $sql1 = "SELECT * FROM productos LIMIT 3";
            $result = $conn->query($sql1);
            $imagenes = [
                1 => '../imagenes/breaking bad.PNG',
                2 => '../imagenes/WALL-E.PNG',
                3 => '../imagenes/HAN-SOLO.PNG',
            ];
            while ($row = $result->fetch_assoc()) {
            $imagen = isset($imagenes[$row['ID_producto']]) ? $imagenes[$row['ID_producto']] : 'default.PNG'; // Imagen por defecto si no se encuentra

            echo '
            <div class="producto">
                <div>
                    <img src="' . $imagen . '" alt="' . $row["nombre_prod"] . '">
                </div>
                <div>
                <h3>' . $row["nombre_prod"] . '</h3>
                <p>' . $row["descripcion_prod"] . '</p>
                <h4>Precio: $' . $row["precio_prod"] . '</h4>
                <form action="carrito.php" method="post">
                    <input type="hidden" name="id_producto" value="' . $row['ID_producto'] . '">
                    <input type="hidden" name="id_cliente" value="' . $_SESSION['ID_cliente'] . '">
                <button type="submit">Agregar al carrito</button>
                </form>
                </div>
            </div>
            ';
            } 
            ?>
        </section>
        <section id="decoraciones">
            <?php
            $sql2 = "SELECT * FROM productos WHERE ID_producto >= 4 LIMIT 3";
            $result = $conn->query($sql2);            
            $imagenes = [
                4 => '../imagenes/RELOJ.PNG',
                5 => '../imagenes/SOPORTE-CELULAR.PNG',
                6 => '../imagenes/MASETA.PNG',
            ];
            while ($row = $result->fetch_assoc()) {
            $imagen = isset($imagenes[$row['ID_producto']]) ? $imagenes[$row['ID_producto']] : 'default.PNG'; // Imagen por defecto si no se encuentra

            echo '
            <div class="producto">
                <div>
                    <img src="' . $imagen . '" alt="' . $row["nombre_prod"] . '">
                </div>
                <div>
                    <h3>' . $row["nombre_prod"] . '</h3>
                    <p>' . $row["descripcion_prod"] . '</p>
                    <h4>Precio: $' . $row["precio_prod"] . '</h4>
                    <form action="carrito.php" method="post">
                        <input type="hidden" name="id_producto" value="' . $row['ID_producto'] . '">
                        <input type="hidden" name="id_cliente" value="' . $_SESSION['ID_cliente'] . '">
                    <button type="submit">Agregar al carrito</button>
                </form>
                </div>
            </div>
            ';
            }
            ?>
        </section>
        <section class="protesis">
            <?php
            $sql3 = "SELECT * FROM productos WHERE ID_producto >= 7 LIMIT 3";
            $result = $conn->query($sql3);            
            $imagenes = [
                7 => '../imagenes/MANO.PNG',
                8 => '../imagenes/BOTA-ORTOPEDICA.PNG',
                9 => '../imagenes/PATA-PERRO.PNG',
            ];
            while ($row = $result->fetch_assoc()) {
            $imagen = isset($imagenes[$row['ID_producto']]) ? $imagenes[$row['ID_producto']] : 'default.PNG'; // Imagen por defecto si no se encuentra

            echo '
            <div class="producto">
                <div>
                    <img src="' . $imagen . '" alt="' . $row["nombre_prod"] . '">
                </div>
                <div>
                    <h3>' . $row["nombre_prod"] . '</h3>
                    <p>' . $row["descripcion_prod"] . '</p>
                    <h4>Precio: $' . $row["precio_prod"] . '</h4>
                    <form action="carrito.php" method="post">
                        <input type="hidden" name="id_producto" value="' . $row['ID_producto'] . '">
                        <input type="hidden" name="id_cliente" value="' . $_SESSION['ID_cliente'] . '">
                    <button type="submit">Agregar al carrito</button>
                </form>
                </div>
            </div>
            ';
            }
            ?>
        </section>
    </main>
</body>
</html>