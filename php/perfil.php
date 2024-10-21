<?php

require_once 'sistema.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['ID_cliente'])) {
    header("Location: ../registro_inicio_sesion.html");
    exit();
}

// Obtener los datos del usuario
$user_id = $_SESSION['ID_cliente'];
$stmt = $conn->prepare("SELECT nombre, apellido, telefono, pais, direccion, email FROM clientes WHERE ID_cliente = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Obtener los productos en el carrito
$stmt = $conn->prepare("
    SELECT p.ID_producto, p.nombre_prod, COUNT(c.ID_producto) AS cantidad, (COUNT(c.ID_producto) * p.precio_prod) AS total
    FROM carrito c
    JOIN productos p ON c.ID_producto = p.ID_producto
    WHERE c.ID_cliente = ?
    GROUP BY p.ID_producto
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$carrito_result = $stmt->get_result();
$stmt->close();

$total_compra = 0;  // Variable para sumar el total de todos los productos

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/perfil.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <ul class="menu">
                <a href="../inicio.html"><li>Inicio</li></a>
            </ul>
        </nav>
    </header>
    <main class="main">
        <section class="informacion">
            <div class="datos">
                <h2>Perfil de Usuario</h2>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user['nombre']); ?></p>
                <p><strong>Apellido:</strong> <?php echo htmlspecialchars($user['apellido']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($user['telefono']); ?></p>
                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($user['direccion']); ?></p>
                <p><strong>País:</strong> <?php echo htmlspecialchars($user['pais']); ?></p>
            </div>
            <div class="logo">
                <img src="../imagenes/logo.png" alt="Logo">
            </div>
            <div class="carrito">
                <h2>Carrito:</h2>
                <?php if ($carrito_result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($producto = $carrito_result->fetch_assoc()) { 
                            $total_compra += $producto['total']; // Sumar el total de cada producto al total general
                        ?>
                            <tr>
                                <td id="nombre"><?php echo htmlspecialchars($producto['nombre_prod']); ?></td>
                                <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                                <td><?php echo htmlspecialchars(number_format($producto['total'], 2)); ?></td>
                                <td>
                                    <!-- Botón para eliminar el producto del carrito -->
                                    <form action="eliminar_producto.php" method="POST">
                                        <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($producto['ID_producto']); ?>">
                                        <button type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Mostrar el total de la compra -->
                <div class="total">
                    <h3>Total de la compra: $<?php echo number_format($total_compra, 2); ?></h3>
                </div>
                <form action="realizar_compra.php" method="POST">
                    <button type="submit">Realizar compra</button>
                </form>
                <?php else: ?>
                    <p>Sin productos en el carrito.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer>
        <section class="cerrar">
            <a href="../registro_inicio_sesion.html"><h1>Cerrar sesión</h1></a>
        </section>
    </footer>
</body>
</html>
