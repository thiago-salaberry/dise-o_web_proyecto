<?php

require_once 'sistema.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['ID_cliente'])) {
    header("Location: ../registro_inicio_sesion.html"); // Redirigir a la página de inicio de sesión y registro
    exit();
}

// Obtener los datos del usuario
$user_id = $_SESSION['ID_cliente'];
$stmt = $conn->prepare("SELECT nombre, apellido, telefono, pais, direccion, email FROM clientes WHERE ID_cliente = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Cerrar la conexión
$stmt->close();
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
                <p><strong>Pais:</strong> <?php echo htmlspecialchars($user['pais']); ?></p>
            </div>
            <div class="logo">
                <img src="../imagenes/logo.png" alt="Logo">
            </div>
        </section>
    </main>
    <footer>
        <section class="cerrar">
            <a href="../registro_inicio_sesion.html"><h2>cerrar sesion</h2></a>
        </section>
    </footer>
</body>
</html>