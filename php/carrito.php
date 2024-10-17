<?php
require 'sistema.php';
// Obtener los datos enviados por el formulario
$idProducto = $_POST['id_producto'];
$idCLIENTE = $_POST['id_cliente'];

// Insertar los datos en la tabla carrito
$sql = "INSERT INTO carrito (ID_producto, ID_cliente) VALUES ('$idProducto', '$idCLIENTE')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Producto agregado en el carrito.'); window.history.back();</script>";
} else {
    echo "<script>alert('Algo salio mal, intente de neuvo mas tarde.'); window.history.back();</script>";
}

$conn->close()
?>