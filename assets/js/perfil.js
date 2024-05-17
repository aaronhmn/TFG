document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        let isValid = true;
        const mensajeError = [];

        // Validación del DNI
        const dni = document.getElementById('dni').value;
        if (!/^\d{8}[A-Za-z]$/.test(dni)) {
            mensajeError.push("El DNI debe tener 8 dígitos seguidos de una letra.");
            isValid = false;
        }

        // Validación del teléfono
        const telefono = document.getElementById('telefono').value;
        if (!/^\d{9}$/.test(telefono)) {
            mensajeError.push("El número de teléfono debe tener 9 dígitos.");
            isValid = false;
        }

        // Validación del email
        const email = document.getElementById('email').value;
        if (!/\S+@\S+\.\S+/.test(email)) {
            mensajeError.push("Debe ingresar un email válido.");
            isValid = false;
        }

        // Si hay errores, prevenir el envío del formulario y mostrar errores
        if (!isValid) {
            event.preventDefault();
            alert("Errores encontrados:\n" + mensajeError.join("\n"));
        }
    });

    // Asegurarse de que solo se puedan introducir números en los campos marcados como 'digitsonly'
    const digitOnlyInputs = document.querySelectorAll('input[digitsonly="true"]');
    digitOnlyInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
});