// Este evento se dispara cuando todo el contenido del DOM ha sido cargado.
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona el primer formulario del documento.
    const form = document.querySelector('form');

    // Agrega un controlador de eventos para el evento de envío del formulario.
    form.addEventListener('submit', function(event) {
        // Inicializa la variable para controlar si el formulario es válido.
        let isValid = true;

        // Obtiene elementos del DOM para los campos y mensajes de error.
        const telefono = document.getElementById('telefono');
        const dni = document.getElementById('dni');
        const contrasena = document.getElementById('contrasena');
        const contrasena2 = document.getElementById('contrasena2');
        const errorTelefono = document.getElementById('errorTelefono');
        const errorDNI = document.getElementById('errorDNI');
        const errorContrasena = document.getElementById('errorContrasena');
        const errorContrasena2 = document.getElementById('errorContrasena2');

        // Limpia los mensajes de error previos para cada campo.
        errorTelefono.textContent = '';
        errorDNI.textContent = '';
        errorContrasena.textContent = '';
        errorContrasena2.textContent = '';

        // Validación del número de teléfono
        if (!/^\d{9}$/.test(telefono.value)) {
            errorTelefono.textContent = 'El número de teléfono debe tener 9 dígitos.';
            telefono.value = ''; // Limpia el campo si no es válido.
            isValid = false; // Marca el formulario como inválido.
        }

        // Validación del DNI
        if (!/^\d{8}[A-Za-z]$/.test(dni.value)) {
            errorDNI.textContent = 'El DNI debe tener 8 dígitos seguidos de una letra.';
            dni.value = ''; // Limpia el campo si no es válido.
            isValid = false; // Marca el formulario como inválido.
        }

        // Validación de la contraseña
        if (contrasena.value.length < 6) {
            errorContrasena.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            contrasena.value = ''; // Limpia el campo si no es válido.
            isValid = false; // Marca el formulario como inválido.
        }

        // Validación de coincidencia de contraseñas
        if (contrasena.value !== contrasena2.value) {
            errorContrasena2.textContent = 'Las contraseñas no coinciden.';
            contrasena2.value = ''; // Limpia el campo si no es válido.
            isValid = false; // Marca el formulario como inválido.
        }

        // Si el formulario no es válido, previene el envío del formulario.
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Validación para permitir solo dígitos en los inputs especificados
    const digitOnlyInputs = document.querySelectorAll('input[digitsonly]');
    // Agrega un controlador para cada input que solo permite dígitos.
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, ''); // Elimina cualquier carácter que no sea un dígito.
        });
    });
});