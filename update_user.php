<?php
// update_user.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $numeroDocumento = $_POST['numeroDocumento'];

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'admin', 'admin', 'dam');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Preparar la consulta de actualización
    $query = "UPDATE usuarios SET nombre = ?, tipoDocumento = ?, numeroDocumento = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('sssi', $nombre, $tipoDocumento, $numeroDocumento, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir de vuelta a la página principal
        header('Location: index.php');
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
}
?>