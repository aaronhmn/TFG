document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        let isValid = true;

        const telefono = document.getElementById('telefono');
        const dni = document.getElementById('dni');
        const contrasena = document.getElementById('contrasena');
        const contrasena2 = document.getElementById('contrasena2');
        const errorTelefono = document.getElementById('errorTelefono');
        const errorDNI = document.getElementById('errorDNI');
        const errorContrasena = document.getElementById('errorContrasena');
        const errorContrasena2 = document.getElementById('errorContrasena2');

        // Limpiar mensajes de error previos
        errorTelefono.textContent = '';
        errorDNI.textContent = '';
        errorContrasena.textContent = '';
        errorContrasena2.textContent = '';

        // Validación del número de teléfono
        if (!/^\d{9}$/.test(telefono.value)) {
            errorTelefono.textContent = 'El número de teléfono debe tener 9 dígitos.';
            telefono.value = '';
            isValid = false;
        }

        // Validación del DNI
        if (!/^\d{8}[A-Za-z]$/.test(dni.value)) {
            errorDNI.textContent = 'El DNI debe tener 8 dígitos seguidos de una letra.';
            dni.value = '';
            isValid = false;
        }

        // Validación de la contraseña
        if (contrasena.value.length < 6) {
            errorContrasena.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            contrasena.value = '';
            isValid = false;
        }

        // Validación de coincidencia de contraseñas
        if (contrasena.value !== contrasena2.value) {
            errorContrasena2.textContent = 'Las contraseñas no coinciden.';
            contrasena2.value = '';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    // Validación para permitir solo dígitos en los inputs especificados
    const digitOnlyInputs = document.querySelectorAll('input[digitsonly]');
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
});
