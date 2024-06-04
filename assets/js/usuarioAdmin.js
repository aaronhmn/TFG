document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar los formularios por su contenedor de modal específico
    const formInsertar = document.querySelector('#insertarUsuarioModal form');
    const formModificar = document.querySelector('#modificarUsuarioModal form');

    // Función de validación que se puede aplicar a cualquier formulario
    function validateForm(form, isModification = false) {
        form.addEventListener('submit', function(event) {
            let isValid = true;  // Flag para la validación del formulario

            // Definir selectores basados en si el formulario es de inserción o modificación
            const telefonoSelector = isModification ? '[name="telefono"]' : '[name="inputTelefono"]';
            const dniSelector = isModification ? '[name="dni"]' : '[name="inputDNI"]';
            const passwordSelector = isModification ? '[name="contrasenaNueva"]' : '[name="inputPassword"]';
            const confirmPasswordSelector = isModification ? '[name="contrasenaConfirmar"]' : '[name="inputPassword2"]';

            // Obtener los elementos del formulario
            const telefono = form.querySelector(telefonoSelector);
            const dni = form.querySelector(dniSelector);
            const password = form.querySelector(passwordSelector);
            const confirmPassword = form.querySelector(confirmPasswordSelector);

            // Validación del número de teléfono
            if (telefono && !/^\d{9}$/.test(telefono.value)) {
                alert('El número de teléfono debe tener 9 dígitos.');
                isValid = false;
            }

            // Validación del DNI
            if (dni && !/^\d{8}[A-Za-z]$/.test(dni.value)) {
                alert('El DNI debe tener 8 dígitos seguidos de una letra.');
                isValid = false;
            }

            // Validación de la contraseña (si el campo está presente y no está vacío)
            if (password && password.value && password.value.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres.');
                isValid = false;
            }

            // Validación de coincidencia de contraseñas (solo si se proporciona nueva contraseña y no está vacía)
            if (password && confirmPassword && password.value && confirmPassword.value && password.value !== confirmPassword.value) {
                alert('Las contraseñas no coinciden.');
                isValid = false;
            }

            // Si la validación falla, prevenir la acción por defecto
            if (!isValid) {
                event.preventDefault();
            }
        });
    }

    // Aplicar la validación al formulario de inserción
    validateForm(formInsertar);

    // Aplicar la validación al formulario de modificación
    validateForm(formModificar, true);

    // Validación para asegurarse de que solo se ingresen dígitos donde es necesario
    const digitOnlyInputs = document.querySelectorAll('input[digitsonly]');
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
});