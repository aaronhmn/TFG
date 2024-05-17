document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.row.g-3'); // Asegúrate de que esta selección coincida con tu formulario
    form.addEventListener('submit', function(event) {
        const contrasenaNueva = document.getElementById('contrasenaNueva');
        const contrasenaConfirmar = document.getElementById('contrasenaConfirmar');
        let valid = true;
        let errorMessages = '';

        // Limpiar mensajes de error anteriores
        const alertContainer = document.getElementById('alertContainer');
        alertContainer.innerHTML = '';

        // Validar longitud de la contraseña nueva
        if (contrasenaNueva.value.length < 6) {
            errorMessages += '<div class="alert alert-danger" role="alert">La contraseña nueva debe tener al menos 6 caracteres.</div>';
            valid = false;
        }

        // Si no es válido, mostrar mensajes de error y prevenir el envío del formulario
        if (!valid) {
            alertContainer.innerHTML = errorMessages;
            event.preventDefault(); // Prevenir que el formulario se envíe
        }
    });
});