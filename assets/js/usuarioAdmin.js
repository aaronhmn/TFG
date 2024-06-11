// Agrega un oyente de eventos que se ejecuta cuando el DOM está completamente cargado.
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona los formularios dentro de modales específicos por su ID.
    const formInsertar = document.querySelector('#insertarUsuarioModal form');
    const formModificar = document.querySelector('#modificarUsuarioModal form');

    // Función que añade validación a cualquier formulario proporcionado.
    function validateForm(form, isModification = false) {
        // Agrega un controlador para el evento 'submit' del formulario.
        form.addEventListener('submit', function(event) {
            let isValid = true;  // Inicializa una bandera para controlar la validez del formulario.

            // Define selectores de campo específicos dependiendo si el formulario es para inserción o modificación.
            const telefonoSelector = isModification ? '[name="telefono"]' : '[name="inputTelefono"]';
            const dniSelector = isModification ? '[name="dni"]' : '[name="inputDNI"]';
            const codigoPostalSelector = isModification ? '[name="codigo_postal"]' : '[name="inputCodigoPostal"]';
            const passwordSelector = isModification ? '[name="contrasenaNueva"]' : '[name="inputPassword"]';
            const confirmPasswordSelector = isModification ? '[name="contrasenaConfirmar"]' : '[name="inputPassword2"]';

            // Validaciones para cada campo utilizando expresiones regulares y condiciones lógicas.
            const telefono = form.querySelector(telefonoSelector);
            const dni = form.querySelector(dniSelector);
            const codigoPostal = form.querySelector(codigoPostalSelector);
            const password = form.querySelector(passwordSelector);
            const confirmPassword = form.querySelector(confirmPasswordSelector);

            // Validación de número de teléfono, DNI, código postal, y contraseñas.
            if (telefono && !/^\d{9}$/.test(telefono.value)) {
                alert('El número de teléfono debe tener 9 dígitos.');
                isValid = false;
            }
            if (dni && !/^\d{8}[A-Za-z]$/.test(dni.value)) {
                alert('El DNI debe tener 8 dígitos seguidos de una letra.');
                isValid = false;
            }
            if (codigoPostal && !/^\d{5}$/.test(codigoPostal.value)) {
                alert('El código postal debe tener 5 dígitos.');
                isValid = false;
            }
            if (password && password.value && password.value.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres.');
                isValid = false;
            }
            if (password && confirmPassword && password.value && confirmPassword.value && password.value !== confirmPassword.value) {
                alert('Las contraseñas no coinciden.');
                isValid = false;
            }

            // Prevenir el envío del formulario si alguna validación falla.
            if (!isValid) {
                event.preventDefault();
            }
        });
    }

    // Aplica la validación a los formularios de inserción y modificación.
    validateForm(formInsertar);
    validateForm(formModificar, true);

    // Agrega controladores a los campos que deben aceptar solo dígitos.
    const digitOnlyInputs = document.querySelectorAll('input[digitsonly]');
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, ''); // Elimina caracteres no numéricos.
        });
    });
});