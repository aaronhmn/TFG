//* Función para desplazarse suavemente hacia arriba
function scrollToTop() {
  //* Desplazamiento suave hacia arriba
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

//* Mostrar/ocultar el botón al hacer scroll
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  const btnSubir = document.getElementById("btnSubir");
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    btnSubir.style.display = "block";
  } else {
    btnSubir.style.display = "none";
  }
}

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

