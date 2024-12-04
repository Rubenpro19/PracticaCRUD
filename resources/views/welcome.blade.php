<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehículos</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <h1>Vehículos</h1>
    <h2>Agregar Nuevo Vehículo</h2>
    <form id="createForm" method="POST" action="{{ route('vehiculo.store') }}">
        @csrf
        <label>Nombre del vehiculo:</label>
        <input type="text" name="nombre_vehiculo" required>
        <label>Descripcion:</label>
        <input type="text" name="descripcion" required>
        <button type="submit">Crear Vehiculo</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre del Vehiculo</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->nombre_vehiculo }}</td>
                    <td>{{ $vehiculo->descripcion }}</td>
                    <td>
                        <!-- Botón de Actualización -->
                        <button
                            onclick="editarVehiculo({{ $vehiculo->id }}, '{{ $vehiculo->nombre_vehiculo }}', '{{ $vehiculo->descripcion }}')">Editar</button>

                        <!-- Botón de Eliminación -->
                        <form method="POST" action="{{ route('vehiculo.destroy', $vehiculo->id) }}"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('¿Estás seguro de eliminar este vehiculo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Formulario Modal para Actualizar un Producto -->
    <div id="editFormContainer" style="display:none;">
        <h2>Editar Vehiculo</h2>
        <form id="editForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <label>Nombre del Vehiculo:</label>
            <input type="text" name="nombre_vehiculo" id="editNombre" required>
            <label>Descripción:</label>
            <input type="text" name="descripcion" id="editDescripcion" required>
            <button type="submit">Actualizar Vehiculo</button>
            <button type="button" onclick="cancelarEdicion()">Cancelar</button>
        </form>
    </div>

    <script>
        // Función para editar un producto
        function editarVehiculo(id, nombre_vehiculo, descripcion) {
            document.getElementById('editFormContainer').style.display = 'block';
            const editForm = document.getElementById('editForm');

            // Configura la URL de acción con la ruta correcta
            editForm.action = `{{ url('/api/vehiculo') }}/${id}`;
            document.getElementById('editNombre').value = nombre_vehiculo;
            document.getElementById('editDescripcion').value = descripcion;
        }

        // Función para cancelar la edición y ocultar el formulario
        function cancelarEdicion() {
            document.getElementById('editFormContainer').style.display = 'none';
        }
    </script>
</body>

</html>
