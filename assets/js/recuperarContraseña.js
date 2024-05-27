document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('recuperarForm');
    form.addEventListener('submit', function(event) {
        const contrasenaNueva = document.getElementById('contrasena');
        const contrasenaConfirmar = document.getElementById('contrasena2');
        const alertContainer = document.querySelector('.alert-container');
        alertContainer.innerHTML = ''; // Limpiar mensajes anteriores solo al iniciar el envío
        
        let valid = true;

        if (contrasenaNueva.value.length < 6) {
            const errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">La contraseña nueva debe tener al menos 6 caracteres.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            alertContainer.innerHTML += errorMessage;
            valid = false;
        }

        if (contrasenaNueva.value !== contrasenaConfirmar.value) {
            const errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Las contraseñas no coinciden.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            alertContainer.innerHTML += errorMessage;
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevenir que el formulario se envíe
        }
    });
});