<?php
require_once 'sistema.php';
// Verificar si el usuario está logueado
if (!isset($_SESSION['ID_cliente'])) {
    header("Location: ../registro_inicio_sesion.html");
    exit();
}
// Obtener el ID del cliente
$user_id = $_SESSION['ID_cliente'];
// Iniciar la transacción
$conn->begin_transaction();

try {
    // Eliminar todos los productos del carrito del usuario
    $stmt = $conn->prepare("DELETE FROM carrito WHERE ID_cliente = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        // Confirmar la transacción
        $conn->commit();
        echo "<script>alert('Compra realizada,¡muchas gracias! '); window.history.back();</script>";
    } else {
        throw new Exception("Error al procesar la compra.");
    }

    $stmt->close();
} catch (Exception $e) {
    // Si ocurre un error, deshacer los cambios
    $conn->rollback();
    echo "Hubo un error al realizar la compra: " . $e->getMessage();
}

$conn->close();

?>
