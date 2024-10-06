<?php
require_once "Conexion.php";

$conexionDam = new Conexion();
$conexion = $conexionDam->conectar();

$sql = $conexion->prepare("
    SELECT * FROM usuarios  INNER JOIN tipo_documentos ON usuarios.id_tipo_documento = tipo_documentos.id_tipo_documento
    ");
$sql->execute();
$usuarios = $sql->fetchAll();
$sqlTiposDocumentos = $conexion->prepare("
    SELECT * FROM tipo_documentos
    ");
$sqlTiposDocumentos->execute();
$tipo_documentos = $sqlTiposDocumentos->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD HECTOR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>

    <!-- inicio de tabla ordenadores-->
    <div class="mb-3 mt-3 d-flex justify-content-start"></div> <button onclick="abrirModal()" class="bg-green-500 text-white px-4 py-2 rounded">Crear Usuario</button></div>
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>NOMBRE</th>
                        <th>NUMERO DE DOCUMENTO</th>
                        <th>TIPO DE DOCUMENTO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     foreach ($usuarios as $usuario) {
                    ?>
                    <tr>
                        <td><?= $usuario['nombre'] ?></td>
                        <td><?= $usuario['numero_documento'] ?></td>
                        <td><?= $usuario['glosa'] ?></td>
                        <td>
                            <button onclick='abrirModal(<?= json_encode($usuario) ?>)' class="btn btn-primary btn-sm">EDITAR</button>
                            <button onclick='abrirModalEliminar(<?= json_encode($usuario) ?>)' class="btn btn-danger btn-sm">ELIMINAR</button>
                        </td>
                    </tr>

                    </tr>
                    <?php
                    }?>
                </tbody>
        </table>
    </div>
    <!-- fin de tabla ordenadores  -->


        <!-- Tabla para moviles-->
        <div class="table-responsive d-md-none">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>DETALLES</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($usuarios as $usuario) {
                ?>
                    <tr>
                        <td>
                            <strong>Nombre:</strong> <?= $usuario['nombre'] ?><br>
                            <strong>Numero de Documento:</strong> <?= $usuario['numero_documento'] ?><br>
                            <strong>Tipo de Documento:</strong> <?= $usuario['glosa'] ?></td>
                        <td>
                            <button onclick='abrirModal(<?= json_encode($usuario) ?>)' class="btn btn-primary btn-sm">EDITAR</button>
                            <button onclick='abrirModalEliminar(<?= json_encode($usuario) ?>)' class="btn btn-danger btn-sm">ELIMINAR</button>
                        </td>
                    </tr>
                    <?php
                    }?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- fin tabla moviles -->
    <!-- modal de difuminado oscuro en la parte de atrás -->
    <div id="difuminado" class="hidden fixed inset-0 bg-black bg-opacity-50"></div>

    <!-- Modal crear y editar-->
    <div id="abrirModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md mx-auto">
                <h2 id="tituloModal" class="text-xl mb-4"></h2>
                <form id="formularioModal" method="POST" action="crear_usuario.php">
                    <input type="hidden" name="id" id="idUsuario">
                    <input type="hidden" name="accion" id="accion" value="crear">
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="mt-1 block w-full">
                    </div>
                    <div class="mb-4">
                        <label for="tipoDocumento" class="block text-sm font-medium text-gray-700">Tipo de
                            Documento</label>
                        <select name="tipoDocumento" id="tipoDocumento" class="mt-1 block w-full">
                            <option value="0">Seleccione un Tipo de Documento</option>
                            <?php
                            foreach ($tipo_documentos as $tipo_documento) {
                                ?>
                            <option value="<?= $tipo_documento['id_tipo_documento'] ?>"><?= $tipo_documento['glosa'] ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="numeroDocumento" class="block text-sm font-medium text-gray-700">Número de
                            Documento</label>
                        <input type="number" name="numeroDocumento" id="numeroDocumento" class="mt-1 block w-full">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="mr-4" onclick="cerrarModal()">Cancelar</button>
                        <button id type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para borrar -->
    <div id="deleteModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md mx-auto">
                <h2 class="text-xl mb-4">¿Seguro que quiere borrar la tabla?</h2>
                <div class="flex justify-end">
                    <button type="button" class="mr-4" onclick="cerrarModalEliminar()">Cancelar</button>
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded"
                        onclick="eliminarTabla()">Borrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="funciones.js"></script>

</body>

</html>