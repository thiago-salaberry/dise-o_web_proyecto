<?php

require_once 'sistema.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['ID_cliente'])) {
    header("Location: ../registro_inicio_sesion.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    // Obtener el ID del cliente y del producto
    $user_id = $_SESSION['ID_cliente'];
    $producto_id = $_POST['producto_id'];

    // Preparar la consulta para eliminar el producto del carrito
    $stmt = $conn->prepare("DELETE FROM carrito WHERE ID_cliente = ? AND ID_producto = ?");
    $stmt->bind_param("ii", $user_id, $producto_id);
    
    if ($stmt->execute()) {
        // Redirigir al perfil del usuario después de eliminar
        header("Location: perfil.php");
    } else {
        echo "Error al eliminar el producto.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Solicitud no válida.";
}

?>