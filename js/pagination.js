document.addEventListener('DOMContentLoaded', function () {
    loadPage(1); // Cargar la primera página al inicio
});

function loadPage(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../data/pagination.php?page=${page}`, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('userTableContainer').innerHTML = this.responseText;
        }
    };
    xhr.send();
}