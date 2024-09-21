 // funciones modal crear y editar
 function abrirModal(usuario = null) {
    if (usuario) {
        document.getElementById('tituloModal').innerText = 'Editar Usuarioxd';
        document.getElementById('idUsuario').value = usuario.id;
        document.getElementById('nombre').value = usuario.nombre;
        document.getElementById('tipo_documento').value = usuario.tipoDocumento;
        document.getElementById('numero_documento').value = usuario.numeroDocumento;
        document.getElementById('accion').value = 'editar';
    } else {
        document.getElementById('tituloModal').innerText = 'Crear Usuario';
        document.getElementById('formularioModal').reset();
        document.getElementById('idUsuario').value = '';
        document.getElementById('accion').value = 'crear';
    }
    document.getElementById('difuminado').classList.remove('hidden');
    document.getElementById('abrirModal').classList.remove('hidden');
}
function cerrarModal() {
    document.getElementById('difuminado').classList.add('hidden');
    document.getElementById('abrirModal').classList.add('hidden');
}

function abrirModalEliminar(usuario) {
    document.getElementById('idUsuario').value = usuario.id;
    document.getElementById('accion').value = 'eliminar';
    document.getElementById('difuminado').classList.remove('hidden');
    document.getElementById('deleteModal').classList.remove('hidden');
}
// funciones de borrar modal

function cerrarModalEliminar() {
    document.getElementById('difuminado').classList.add('hidden');
    document.getElementById('deleteModal').classList.add('hidden');
}

function eliminarTabla() {
    document.getElementById('formularioModal').submit();
}