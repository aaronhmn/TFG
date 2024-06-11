// Función para desplazarse suavemente hacia arriba
function scrollToTop() {
  window.scrollTo({
      top: 0, // Establece el destino del scroll en la parte superior de la página
      behavior: 'smooth' // Realiza el scroll de forma suave
  });
}

// Mostrar/ocultar el botón al hacer scroll
window.onscroll = function() {
  scrollFunction(); // Llama a scrollFunction cada vez que el usuario hace scroll
};

function scrollFunction() {
  const btnSubir = document.getElementById('btnSubir'); // Obtiene el botón para subir por su ID
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      btnSubir.style.display = 'block'; // Muestra el botón si el scroll es mayor a 20px
  } else {
      btnSubir.style.display = 'none'; // Oculta el botón si el scroll es menor a 20px
  }
}

// Funciones que dependen del DOM completamente cargado
document.addEventListener('DOMContentLoaded', function() {
  // Manejo del botón de mostrar/ocultar filtros
  const toggleBtn = document.getElementById('toggleFiltrosBtn'); // Botón para alternar la visibilidad de filtros
  const filtroColumna = document.getElementById('filtroColumna'); // Columna que contiene los filtros

  if (toggleBtn && filtroColumna) {
      toggleBtn.addEventListener('click', function() {
          filtroColumna.classList.toggle('d-none'); // Alterna la clase para ocultar/mostrar
          filtroColumna.classList.toggle('active'); // Alterna la clase 'active' para indicar estado
          toggleBtn.textContent = toggleBtn.textContent === "Mostrar Filtros" ? "Ocultar Filtros" : "Mostrar Filtros"; // Cambia el texto del botón según el estado
      });
  }
});

//*CARRITO
document.addEventListener('DOMContentLoaded', function() {
  actualizarContadorCarrito(); // Actualiza el contador del carrito al cargar la página
});

function getCarritoKey() {
  const userId = document.body.getAttribute('data-user-id'); // Obtiene un identificador de usuario del atributo 'data-user-id' del cuerpo de la página
  return `carrito_${userId}`; // Retorna la clave para almacenar/recuperar el carrito del usuario en Local Storage
}

function actualizarContadorCarrito() {
  const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
  const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Obtiene el carrito de Local Storage o inicializa uno vacío
  const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0); // Calcula el total de ítems en el carrito
  const contador = document.getElementById('cart-count'); // Obtiene el elemento que muestra el contador de ítems en el carrito
  if (contador) {
      contador.textContent = totalItems; // Actualiza el contenido del contador
  }
}

