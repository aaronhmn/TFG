document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar los formularios por su contenedor de modal específico
    const formInsertar = document.querySelector('#insertarAlmacenModal form');
    const formModificar = document.querySelector('#modificarAlmacenModal form');

    // Función de validación que se puede aplicar a cualquier formulario
    function validateForm(form, isModification = false) {
        form.addEventListener('submit', function(event) {
            let isValid = true;  // Flag para la validación del formulario

            // Definir selectores basados en si el formulario es de inserción o modificación
            const telefonoSelector = isModification ? '[name="telefono"]' : '[name="inputTelefono"]';
            const codigoPostalSelector = isModification ? '[name="codigo_postal"]' : '[name="inputCP"]';

            // Obtener los elementos del formulario
            const telefono = form.querySelector(telefonoSelector);
            const codigoPostal = form.querySelector(codigoPostalSelector);

            // Validación del número de teléfono
            if (telefono && !/^\d{9}$/.test(telefono.value)) {
                alert('El número de teléfono debe tener 9 dígitos.');
                isValid = false;
            }

            // Validación del código postal
            if (codigoPostal && !/^\d{5}$/.test(codigoPostal.value)) {
                alert('El código postal debe tener 5 dígitos.');
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