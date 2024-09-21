 // funciones modal crear y editar
 function openModal(usuario = null) {
    if (usuario) {
        document.getElementById('modalTitle').innerText = 'Editar Usuario';
        document.getElementById('userId').value = usuario.id;
        document.getElementById('nombre').value = usuario.nombre;
        document.getElementById('tipo_documento').value = usuario.tipoDocumento;
        document.getElementById('numero_documento').value = usuario.numeroDocumento;
        document.getElementById('action').value = 'update';
    } else {
        document.getElementById('modalTitle').innerText = 'Crear Usuario';
        document.getElementById('editForm').reset();
        document.getElementById('userId').value = '';
        document.getElementById('action').value = 'create';
    }
    document.getElementById('modalOverlay').classList.remove('hidden');
    document.getElementById('editModal').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('modalOverlay').classList.add('hidden');
    document.getElementById('editModal').classList.add('hidden');
}

function openDeleteModal(usuario) {
    document.getElementById('userId').value = usuario.id;
    document.getElementById('action').value = 'delete';
    document.getElementById('modalOverlay').classList.remove('hidden');
    document.getElementById('deleteModal').classList.remove('hidden');
}
// funciones de borrar modal

function closeDeleteModal() {
    document.getElementById('modalOverlay').classList.add('hidden');
    document.getElementById('deleteModal').classList.add('hidden');
}

function deleteTable() {
    document.getElementById('editForm').submit();
}