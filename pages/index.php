<?php include('../data/conection.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="manifest" href="../manifest.json">
    <link rel="shortcut icon" href="https://www.etatvasoft.com/public/images/pwa-main-logo-hexa.svg" type="image/x-icon">
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    ?>

        <div class="container">
            <h1 class="text-center my-4">CRUD PWA</h1>
            <div class="text-end mb-3">
                <span>Bienvenido, <?php echo $_SESSION['username']; ?>! <i class="fas fa-user fa-2x"></i></span>
                <a href="../data/validate_logout.php" class="btn btn-danger btn-sm">Cerrar Sesión</a>
        </div>

        <!-- Formulario nuevo registro -->
        <form id="addForm" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
        <br>
        <!-- Campo de búsqueda -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="search" placeholder="Buscar por ID, Nombre o Correo Electrónico">
        </div>

        <!-- Mostrar los registros -->
        <div id="userTableContainer">
            <?php include '../data/pagination.php'; ?>
        </div>
    </div>
    
    <!-- Editar usuario -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                <input type="hidden" id="editId" name="id">
                <div class="mb-3">
                    <label for="editName" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="editName" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="editEmail" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="editEmail" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/alerts.js"></script>
    <script src="../js/worker.js"></script>
    <script src="../js/notification.js"></script>
    <script src="../js/search.js"></script>
    <script src='../js/pagination.js'></script>
</body>
</html>
