<?php
// enlace con servidor xd
$servername = "localhost";
$username = "naomi";
$password = "12345";
$dbname = "dam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// almacenar datos en variables
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tipoDocumento = $_POST['tipoDocumento'];
$numeroDocumento = $_POST['numeroDocumento'];
$accion = $_POST['accion'];

// Verificar los datos recibidos
echo "ID: $id<br>";
echo "Nombre: $nombre<br>";
echo "Tipo Documento: $tipoDocumento<br>";
echo "Número Documento: $numeroDocumento<br>";
echo "Acción: $accion<br>";

// acciones dependiendo lo que el usuario vaya a hacer
if ($accion == 'crear') {
    $sql = "INSERT INTO usuarios (nombre, id_tipo_documento, numero_documento) VALUES ('$nombre', '$tipoDocumento', '$numeroDocumento')";
} elseif ($accion == 'editar') {
    $sql = "UPDATE usuarios SET nombre='$nombre', id_tipo_documento='$tipoDocumento', numero_documento='$numeroDocumento' WHERE id_usuario=$id";
} elseif ($accion == 'eliminar') {
    $sql = "DELETE FROM usuarios WHERE id_usuario=$id";
} else {
    die("Acción no válida: " . $accion);
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