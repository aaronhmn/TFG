// Escucha cuando el contenido del DOM está completamente cargado.
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona el primer formulario encontrado en el documento.
    const form = document.querySelector('form');
    
    // Agrega un escuchador de eventos al formulario para el evento 'submit'.
    form.addEventListener('submit', function(event) {
        let isValid = true; // Variable para controlar la validez del formulario.
        const mensajeError = []; // Array para almacenar mensajes de error.

        // Validación del DNI
        const dni = document.getElementById('dni').value; // Obtiene el valor del campo DNI.
        // Verifica que el DNI tenga 8 dígitos seguidos de una letra.
        if (!/^\d{8}[A-Za-z]$/.test(dni)) {
            mensajeError.push("El DNI debe tener 8 dígitos seguidos de una letra.");
            isValid = false; // Cambia el estado de validez a falso.
        }

        // Validación del teléfono
        const telefono = document.getElementById('telefono').value; // Obtiene el valor del campo teléfono.
        // Verifica que el teléfono tenga 9 dígitos.
        if (!/^\d{9}$/.test(telefono)) {
            mensajeError.push("El número de teléfono debe tener 9 dígitos.");
            isValid = false; // Cambia el estado de validez a falso.
        }

        // Validación del email
        const email = document.getElementById('email').value; // Obtiene el valor del campo email.
        // Verifica que el email tenga un formato válido.
        if (!/\S+@\S+\.\S+/.test(email)) {
            mensajeError.push("Debe ingresar un email válido.");
            isValid = false; // Cambia el estado de validez a falso.
        }

        // Si no es válido, previene el envío del formulario y muestra los errores.
        if (!isValid) {
            event.preventDefault(); // Evita que el formulario se envíe.
            alert("Errores encontrados:\n" + mensajeError.join("\n")); // Muestra una alerta con los errores encontrados.
        }
    });

    // Restringe la entrada en los campos marcados como solo dígitos para que solo acepten números.
    const digitOnlyInputs = document.querySelectorAll('input[digitsonly="true"]');
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, ''); // Elimina cualquier carácter que no sea un dígito.
        });
    });
});
