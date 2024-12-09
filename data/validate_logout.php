<?php
session_start();
session_unset();  // elimina todas las variables de sesión
session_destroy();  // destruye la sesión

header('Location: ../pages/login.php?error=3');
exit();
?>
