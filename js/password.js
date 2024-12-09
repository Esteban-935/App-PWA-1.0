const togglePassword = document.getElementById('toggle-password');
const passwordField = document.getElementById('password');

// agregar evento de clic al ícono
togglePassword.addEventListener('click', function() {
    // cambiar tipo del campo de contraseña entre 'password' y 'text'
    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;

    // cambiar el ícono entre ojo abierto y cerrado
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});