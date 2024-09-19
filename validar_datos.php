<?php
session_start();

require 'sistema.php'; // Asegúrate de que aquí se establezca la conexión $conn con mysqli

if (!empty($_POST['email']) && !empty($_POST['contraseña'])) {
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    // Utiliza '?' como marcador de parámetro en mysqli
    $query = $conn->prepare('SELECT email, contraseña FROM clientes WHERE email = ?');
    $query->bind_param('s', $email); // 's' indica que es un parámetro de tipo string
    $query->execute();
    $result = $query->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && $contraseña == $usuario['contraseña']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header('Location: inico.html');
        exit();
    } else {
        $message = 'Usuario o contraseña incorrectos';
        echo $message; // Para mostrar el mensaje de error
    }
} else {
    $message = 'Por favor, complete todos los campos';
    echo $message; // Para mostrar el mensaje de error
}
?>