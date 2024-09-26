<?php

require 'sistema.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$pais = $_POST['pais'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$contraseña = $_POST['contraseña'];

//Verificar el email
$sql_check_email = 'SELECT * FROM clientes WHERE email = ?';
$stmt = $conn->prepare($sql_check_email);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('El email ya está registrado.'); window.history.back();</script>";
    // Si el email ya existe
} else {
    // Si el email no está registrado, insertar el nuevo usuario
    $sql_insert = "INSERT INTO `clientes`(`nombre`, `apellido`, `email`, `telefono`, `direccion`, `contraseña`, `pais`)
                   VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssssss", $nombre, $apellido, $email, $telefono, $direccion, $contraseña, $pais);

    if ($stmt_insert->execute()) {
        // Obtener el ID del nuevo cliente
        $nuevo_id = $conn->insert_id; // Obtener el ID del último registro insertado
        $_SESSION['ID_cliente'] = $nuevo_id; // Guardar el ID en la sesión

        echo "<script>alert('Bienvenido, $nombre.'); window.history.back();</script>"; // Mensaje de bienvenida con el nombre
        header("Location: ../inicio.html");
    } else {
        echo "Error: ". $stmt_insert->error;
    }

    $stmt_insert->close();
}

$stmt->close();
$conn->close();

?>