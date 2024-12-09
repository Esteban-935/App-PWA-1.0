<?php
include('conection.php');
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // verificar la contraseña directamente
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // redirige con éxito (parámetro 0)
            header('Location: ../pages/login.php?error=0');
            exit();
        } else {
            // redirige con error de contraseña incorrecta (parámetro 2)
            header('Location: ../pages/login.php?error=2');
            exit();
        }
    } else {
        // redirige con error de usuario no encontrado (parámetro 1)
        header('Location: ../pages/login.php?error=1');
        exit();
    }
}
?>