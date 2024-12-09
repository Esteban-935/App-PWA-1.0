// Formulario de creación
document.getElementById('addForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar que se recargue la página

    let formData = new FormData(this);

    // Enviar los datos mediante AJAX
    fetch('../data/create.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire('¡Agregado!', data.message, 'success')
            .then(() => location.reload()); // Recargar la página para actualizar la tabla
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Función para abrir el modal de edición con datos del usuario
function openEditModal(id, name, email) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

// Formulario de edición
document.getElementById('editForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('../data/update.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire('¡Actualizado!', data.message, 'success')
            .then(() => location.reload());
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Manejar la eliminación de usuario con AJAX y SweetAlert
function deleteUser(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`../data/delete.php?id=${id}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('¡Eliminado!', data.message, 'success')
                    .then(() => location.reload());
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
}
