<?php
session_start();

require 'sistema.php'; // Asegúrate de que aquí se establezca la conexión $conn con mysqli

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Utiliza '?' como marcador de parámetro en mysqli
    $query = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email = ?');
    $query->bind_param('s', $email); // 's' indica que es un parámetro de tipo string
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password == $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../../index.html");
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