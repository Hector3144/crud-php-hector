<?php
// enlace con servidor xd
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "dam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// almacenar datos en variables
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tipoDocumento = $_POST['tipo_documento'];
$numeroDocumento = $_POST['numero_documento'];
$accion = $_POST['accion'];

// acciones dependiendo lo que el usuario vaya a hacer
if ($accion == 'crear') {
    $sql = "INSERT INTO usuarios (nombre, tipoDocumento, numeroDocumento) VALUES ('$nombre', '$tipoDocumento', '$numeroDocumento')";
} elseif ($accion == 'editar') {
    $sql = "UPDATE usuarios SET nombre='$nombre', tipoDocumento='$tipoDocumento', numeroDocumento='$numeroDocumento' WHERE id=$id";
} elseif ($accion == 'eliminar') {
    $sql = "DELETE FROM usuarios WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Acción realizada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// desconexion
$conn->close();

// vuelta a la vista princiapal
header("Location: index.php");
exit();
?>