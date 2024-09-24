// funciones modal crear y editar
function abrirModal(usuario = null) {
  if (usuario) {
      document.getElementById('tituloModal').innerText = 'Editar Usuario';
      document.getElementById('idUsuario').value = usuario.id_usuario;
      document.getElementById('nombre').value = usuario.nombre;
      document.getElementById('tipoDocumento').value = usuario.id_tipo_documento;
      document.getElementById('numeroDocumento').value = usuario.numero_documento;
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
  document.getElementById("difuminado").classList.add("hidden");
  document.getElementById("abrirModal").classList.add("hidden");
}

function abrirModalEliminar(usuario) {
  document.getElementById("idUsuario").value = usuario.id_usuario;
  document.getElementById("accion").value = "eliminar";
  document.getElementById("difuminado").classList.remove("hidden");
  document.getElementById("deleteModal").classList.remove("hidden");
}
// funciones de borrar modal

function cerrarModalEliminar() {
  document.getElementById("difuminado").classList.add("hidden");
  document.getElementById("deleteModal").classList.add("hidden");
}

function eliminarTabla() {
  document.getElementById("formularioModal").submit();
}

document.getElementById('formularioModal').addEventListener('submit', function (event) {
  var tipoDocumento = document.getElementById('tipoDocumento').value;
  if (tipoDocumento == '0') {
      event.preventDefault();
      alert('Por favor, seleccione un tipo de documento válido.');
  }
});
