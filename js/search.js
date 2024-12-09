function searchFunction() {
    const searchValue = document.getElementById('search').value.toLowerCase();
    const tableRows = document.querySelectorAll('#userTable tr');

    tableRows.forEach(row => {
        const id = row.cells[0].textContent.toLowerCase();
        const name = row.cells[1].textContent.toLowerCase();
        const email = row.cells[2].textContent.toLowerCase();

        if (id.includes(searchValue) || name.includes(searchValue) || email.includes(searchValue)) {
            row.style.display = '';  // Mostrar la fila si coincide
        } else {
            row.style.display = 'none';  // Ocultar la fila si no coincide
        }
    });
}

// Detectar si se escribe en el campo de búsqueda
document.getElementById('search').addEventListener('input', searchFunction);