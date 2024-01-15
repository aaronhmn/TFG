
//VALIDACION DEL LOGIN
  document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("contrasena");

    loginForm.addEventListener("submit", function(event) {
        // Reiniciar mensajes de error
        emailInput.setCustomValidity("");
        passwordInput.setCustomValidity("");

        const email = emailInput.value;
        const password = passwordInput.value;

        // Validación del correo electrónico
        if (!isValidEmail(email)) {
            emailInput.setCustomValidity("Ingrese un correo electrónico válido.");
            event.preventDefault(); // Evitar el envío del formulario
        }

        // Validación de la contraseña
        if (password.length === 0) {
            passwordInput.setCustomValidity("La contraseña no puede estar en blanco.");
            event.preventDefault(); // Evitar el envío del formulario
        }
    });

    function isValidEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }
  });


  // Función para desplazarse suavemente hacia arriba
  function scrollToTop() {
    // Desplazamiento suave hacia arriba
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }

    // Mostrar/ocultar el botón al hacer scroll
    window.onscroll = function() {
      scrollFunction();
    };

    function scrollFunction() {
      const btnSubir = document.getElementById('btnSubir');
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        btnSubir.style.display = 'block';
      } else {
        btnSubir.style.display = 'none';
      }
    }

    // Transform value
  let value = 0
  // trail index number
  let trailValue = 0
  // interval (Duration)
  let interval = 4000