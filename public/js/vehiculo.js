// Función para editar un producto
function editarVehiculo(id, nombre_vehiculo, descripcion) {
    document.getElementById('editFormContainer').style.display = 'block';
    const editForm = document.getElementById('editForm');

    // Configura la URL de acción con la ruta correcta
    editForm.action = `/api/vehiculo/${id}`;
    document.getElementById('editNombre').value = nombre_vehiculo;
    document.getElementById('editDescripcion').value = descripcion;
}

// Función para cancelar la edición y ocultar el formulario
function cancelarEdicion() {
    document.getElementById('editFormContainer').style.display = 'none';
}
