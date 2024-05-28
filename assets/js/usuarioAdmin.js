document.addEventListener('DOMContentLoaded', function() {
    // Asumiendo que los IDs para el formulario de insertar son diferentes a los de modificar
    const formInsertar = document.querySelector('#insertarUsuarioModal form');
    const formModificar = document.querySelector('#modificarUsuarioModal form');

    // Puedes reutilizar esta función para ambos formularios
    function validateForm(form) {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const telefono = form.querySelector('[name="inputTelefono"]');
            const dni = form.querySelector('[name="inputDNI"]');
            const contrasena = form.querySelector('[name="inputPassword"]');
            const contrasena2 = form.querySelector('[name="inputPassword2"]'); // Asegúrate de ajustar estos selectores al nombre correcto de tus campos.

            // Validación del número de teléfono
            if (!/^\d{9}$/.test(telefono.value)) {
                alert('El número de teléfono debe tener 9 dígitos.');
                isValid = false;
            }

            // Validación del DNI
            if (!/^\d{8}[A-Za-z]$/.test(dni.value)) {
                alert('El DNI debe tener 8 dígitos seguidos de una letra.');
                isValid = false;
            }

            // Validación de la contraseña
            if (contrasena.value.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres.');
                isValid = false;
            }

            // Validación de coincidencia de contraseñas
            if (contrasena.value !== contrasena2.value) {
                alert('Las contraseñas no coinciden.');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevenir la acción por defecto (enviar el formulario) si la validación falla
            }
        });
    }

    // Llamar a la función de validación para ambos formularios
    validateForm(formInsertar);
    validateForm(formModificar);

    const digitOnlyInputs = document.querySelectorAll('input[digitsonly]');
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
});

