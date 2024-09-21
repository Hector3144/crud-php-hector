<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "dam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tipoDocumento = $_POST['tipoDocumento'];
$numeroDocumento = $_POST['numeroDocumento'];
$action = $_POST['action'];

if ($action == 'create') {
    $sql = "INSERT INTO usuarios (nombre, tipoDocumento, numeroDocumento) VALUES ('$nombre', '$tipoDocumento', '$numeroDocumento')";
} elseif ($action == 'update') {
    $sql = "UPDATE usuarios SET nombre='$nombre', tipoDocumento='$tipoDocumento', numeroDocumento='$numeroDocumento' WHERE id=$id";
} elseif ($action == 'delete') {
    $sql = "DELETE FROM usuarios WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Acción realizada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: index.php");
exit();
?>