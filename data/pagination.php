<?php
include('conection.php');

$limit = 5; // Número de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Consulta para obtener el número total de registros
$total_sql = "SELECT COUNT(*) FROM users";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_row()[0];
$total_pages = ceil($total_rows / $limit);

// Consulta para obtener los registros de la página actual
$sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Generar el HTML de la tabla
echo '<table class="table table-bordered table-striped mt-4" id="userTable">'; // Asegúrate de que el ID sea "userTable"
echo '<thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
    </thead>';
echo '<tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['created_at']}</td>
                <td class='d-flex justify-content-center'>
                    <button class='btn btn-warning mx-2' onclick='openEditModal({$row['id']}, \"{$row['name']}\", \"{$row['email']}\")'>
                        <i class='fas fa-edit'></i> Editar
                    </button>
                    <button class='btn btn-danger mx-2' onclick='deleteUser({$row['id']})'>
                        <i class='fas fa-trash-alt'></i> Eliminar
                    </button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay registros</td></tr>";
}

echo '</tbody>';
echo '</table>';

// Generar la paginación
echo '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="#" onclick="loadPage('.($page - 1).')">Anterior</a></li>';
}
for ($i = 1; $i <= $total_pages; $i++) {
    $active = $i == $page ? 'active' : '';
    echo '<li class="page-item '.$active.'"><a class="page-link" href="#" onclick="loadPage('.$i.')">'.$i.'</a></li>';
}
if ($page < $total_pages) {
    echo '<li class="page-item"><a class="page-link" href="#" onclick="loadPage('.($page + 1).')">Siguiente</a></li>';
}
echo '</ul></nav>';
?>