// Añade un evento que se ejecuta cuando todo el contenido del DOM ha sido completamente cargado.
document.addEventListener('DOMContentLoaded', function() {
    // Obtiene el formulario con el ID 'recuperarForm'.
    const form = document.getElementById('recuperarForm');
    
    // Añade un controlador de eventos que se activa al intentar enviar el formulario.
    form.addEventListener('submit', function(event) {
        // Obtiene el elemento del campo para la nueva contraseña.
        const contrasenaNueva = document.getElementById('contrasena');
        // Obtiene el elemento del campo para confirmar la nueva contraseña.
        const contrasenaConfirmar = document.getElementById('contrasena2');
        // Selecciona el contenedor donde se mostrarán las alertas.
        const alertContainer = document.querySelector('.alert-container');
        
        // Limpia el contenedor de alertas para eliminar mensajes anteriores.
        alertContainer.innerHTML = '';
        
        // Define una variable para seguir si el formulario es válido.
        let valid = true;

        // Verifica si la longitud de la nueva contraseña es menor a 6 caracteres.
        if (contrasenaNueva.value.length < 6) {
            // Si es así, genera un mensaje de error.
            const errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">La contraseña nueva debe tener al menos 6 caracteres.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            // Añade el mensaje de error al contenedor de alertas.
            alertContainer.innerHTML += errorMessage;
            // Establece la variable 'valid' a falso indicando que el formulario no es válido.
            valid = false;
        }

        // Verifica si las contraseñas ingresadas no coinciden.
        if (contrasenaNueva.value !== contrasenaConfirmar.value) {
            // Si no coinciden, genera otro mensaje de error.
            const errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Las contraseñas no coinciden.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            // Añade este mensaje de error al contenedor de alertas.
            alertContainer.innerHTML += errorMessage;
            // Establece la variable 'valid' a falso indicando que el formulario no es válido.
            valid = false;
        }

        // Si la variable 'valid' es falso, previene el envío del formulario.
        if (!valid) {
            event.preventDefault(); // Evita que el formulario se envíe para permitir al usuario corregir los errores.
        }
    });
});