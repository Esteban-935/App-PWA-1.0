// mostrar SweetAlert
function showSuccessMessage() {
    Swal.fire({
        title: '¡Bienvenido!',
        text: 'Inicio de sesión exitoso.',
        icon: 'success',
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../pages/index.php'; // redirige a la página de inicio
        }
    });
}

// mostrar SweetAlert de error (contraseña incorrecta)
function showErrorMessage(message) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        confirmButtonText: 'Intentar nuevamente'
    });
}

// mostrar SweetAlert cuando se cierra sesión
function showLogoutMessage() {
    Swal.fire({
        title: '¡Hasta luego!',
        text: 'Te has cerrado sesión exitosamente.',
        icon: 'success',
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../pages/login.php'; // redirige al login después del cierre
        }
    });
}

// errores pasados desde PHP
window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    if (error === '1') {
        showErrorMessage("Usuario no encontrado.");
    } else if (error === '2') {
        showErrorMessage("Contraseña incorrecta.");
    } else if (error === '0') {
        showSuccessMessage();
    } else if (error === '3') {
        showLogoutMessage(); // mensaje de cierre de sesión
    }
};