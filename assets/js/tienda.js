// Función para desplazarse suavemente hacia arriba
function scrollToTop() {
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

// Funciones que dependen del DOM completamente cargado
document.addEventListener('DOMContentLoaded', function() {
  // Filtros responsive - manejo del botón de mostrar/ocultar filtros
  const toggleBtn = document.getElementById('toggleFiltrosBtn');
  const filtroColumna = document.getElementById('filtroColumna');

  if (toggleBtn && filtroColumna) {
      toggleBtn.addEventListener('click', function() {
          filtroColumna.classList.toggle('d-none');
          filtroColumna.classList.toggle('active');
          toggleBtn.textContent = toggleBtn.textContent === "Mostrar Filtros" ? "Ocultar Filtros" : "Mostrar Filtros";
      });
  }
});

//*CARRITO
document.addEventListener('DOMContentLoaded', function() {
  actualizarContadorCarrito();
});

function getCarritoKey() {
  const userId = document.body.getAttribute('data-user-id');
  return `carrito_${userId}`;
}

function actualizarContadorCarrito() {
  const carritoKey = getCarritoKey();
  const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};
  const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
  const contador = document.getElementById('cart-count');
  if (contador) {
      contador.textContent = totalItems;
  }
}

