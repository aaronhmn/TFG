// Añadir un oyente de eventos al documento que se dispare cuando el contenido del DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar el formulario dentro del modal de inserción de almacén usando su id específico
    const formInsertar = document.querySelector('#insertarAlmacenModal form');
    // Seleccionar el formulario dentro del modal de modificación de almacén usando su id específico
    const formModificar = document.querySelector('#modificarAlmacenModal form');

    // Definir una función para validar formularios, que admite dos argumentos: el formulario y si es un formulario de modificación
    function validateForm(form, isModification = false) {
        // Añadir un oyente de eventos al formulario para manejar el evento de envío
        form.addEventListener('submit', function(event) {
            // Establecer un indicador para seguir el estado de la validación del formulario
            let isValid = true;

            // Elegir los selectores de elementos de formulario basándose en si el formulario es de inserción o modificación
            const telefonoSelector = isModification ? '[name="telefono"]' : '[name="inputTelefono"]';
            const codigoPostalSelector = isModification ? '[name="codigo_postal"]' : '[name="inputCP"]';

            // Obtener los elementos del formulario según los selectores definidos
            const telefono = form.querySelector(telefonoSelector);
            const codigoPostal = form.querySelector(codigoPostalSelector);

            // Validar el número de teléfono para asegurar que tenga exactamente 9 dígitos
            if (telefono && !/^\d{9}$/.test(telefono.value)) {
                alert('El número de teléfono debe tener 9 dígitos.');
                isValid = false;
            }

            // Validar el código postal para asegurar que tenga exactamente 5 dígitos
            if (codigoPostal && !/^\d{5}$/.test(codigoPostal.value)) {
                alert('El código postal debe tener 5 dígitos.');
                isValid = false;
            }

            // Si la validación falla, prevenir la acción por defecto del formulario (envío)
            if (!isValid) {
                event.preventDefault();
            }
        });
    }

    // Aplicar la función de validación al formulario de inserción sin marcarlo como modificación
    validateForm(formInsertar);

    // Aplicar la función de validación al formulario de modificación marcándolo como tal
    validateForm(formModificar, true);

    // Seleccionar todos los inputs que deben aceptar solo dígitos
    const digitOnlyInputs = document.querySelectorAll('input[digitsonly]');
    // Añadir un oyente a cada input para limpiar cualquier entrada que no sea dígitos
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Reemplazar cualquier carácter no dígito en el valor del input
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
});
