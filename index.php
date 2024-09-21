<?php
require_once "Conexion.php";

$conexionDam = new Conexion();
$conexion = $conexionDam->conectar();

$sql = $conexion->prepare("
        SELECT * FROM usuarios
    ");
$sql->execute();
$usuarios = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>

    <form action="validar.php" method="post">

        <label for="">Tipos de Documentos</label>
        <select name="tipoDocumento" id="tipoDocumento">
            <option value="0">Seleccione un tipo de documento</option>
            <?php
            foreach ($usuarios as $usuario) {
                ?>
                <option value=""><?= $usuario['nombre'] ?></option>
                <?php
            }
            ?>
        </select>

        <button type="submit">Validar</button>
    </form>

    <script src="validador.js"></script>


    <!-- component -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- ====== Table Section Start -->
    <section class="bg-white py-20 lg:py-[120px]">
        <div class="container">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4">
                    <div class="max-w-full overflow-x-auto">
                        <table class="table-auto w-full">


                            <thead>
                                <tr class="bg-primary text-center">
                                    <th
                                        class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4 border-r border-transparent">
                                        Nombre
                                    </th>
                                    <th
                                        class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4 border-r border-transparent">
                                        Tipo de Documento
                                    </th>
                                    <th
                                        class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4 border-r border-transparent">
                                        Numero de Documento
                                    </th>
                                    <th
                                        class="w-1/6 min-w-[160px] text-lg font-semibold text-white py-4 lg:py-7 px-3 lg:px-4 border-r border-transparent">
                                        Editar datos
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($usuarios as $usuario) {
                                    ?>
                                    <tr>
                                        <td
                                            class="text-center text-dark font-medium text-base py-5 px-2 bg-[#F3F6FF] border-b border-[#E8E8E8]">
                                            <?= $usuario['nombre'] ?>
                                        </td>
                                        <td
                                            class="text-center text-dark font-medium text-base py-5 px-2 bg-[#F3F6FF] border-b border-[#E8E8E8]">
                                            <?= $usuario['tipoDocumento'] ?>
                                        </td>
                                        <td
                                            class="text-center text-dark font-medium text-base py-5 px-2 bg-[#F3F6FF] border-b border-[#E8E8E8]">
                                            <?= $usuario['numeroDocumento'] ?>
                                        </td>

                                        <td
                                            class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-r border-[#E8E8E8]">
                                            <button onclick='openModal(<?= json_encode($usuario) ?>)'
                                                class="border border-primary py-2 px-6 text-primary inline-block rounded hover:bg-primary hover:text-white"
                                                type="button">
                                                Editar
                                            </button>
                                        </td>
                                        <?php
                                }
                                ?>
    </section>

    <!-- ====== Table Section End -->

    <!-- Modal -->
    <div id="editModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded shadow-lg">
                <h2 class="text-xl mb-4">Editar Usuario</h2>
                <form id="editForm" method="POST" action="update_user.php">
                    <input type="hidden" name="id" id="userId">
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="mt-1 block w-full">
                    </div>
                    <div class="mb-4">
                        <label for="tipoDocumento" class="block text-sm font-medium text-gray-700">Tipo de
                            Documento</label>
                        <input type="text" name="tipoDocumento" id="tipoDocumento" class="mt-1 block w-full">
                    </div>
                    <div class="mb-4">
                        <label for="numeroDocumento" class="block text-sm font-medium text-gray-700">Numero de
                            Documento</label>
                        <input type="text" name="numeroDocumento" id="numeroDocumento" class="mt-1 block w-full">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="mr-4" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(usuario) {
            document.getElementById('userId').value = usuario.id;
            document.getElementById('nombre').value = usuario.nombre;
            document.getElementById('tipoDocumento').value = usuario.tipoDocumento;
            document.getElementById('numeroDocumento').value = usuario.numeroDocumento;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
    
    
</body>

</html>